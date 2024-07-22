<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8000/api/']);
    }

    public function index()
    {
        try {
            $responseUser = $this->client->get('users');
            $dataUser = json_decode($responseUser->getBody(), true);

            if ($responseUser->getStatusCode() == 200 && isset($dataUser['status']) && $dataUser['status']) {
                $userMap = collect($dataUser['data'])->keyBy('id');

                return view('user.index', [
                    'userMap' => $userMap,
                ]);
            } else {
                Log::error('Failed to fetch user data', ['response' => $responseUser->getBody()->getContents()]);
                return view('user.index', ['userMap' => collect(), 'error' => 'Failed to fetch user data']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching user data', ['error' => $e->getMessage()]);
            return view('user.index', ['userMap' => collect(), 'error' => 'Error fetching user data']);
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        try {
            $response = $this->client->post('users', [
                'json' => $validatedData,
            ]);

            if ($response->getStatusCode() == 201) {
                return redirect()->route('user.index')->with('success', 'User created successfully.');
            } else {
                Log::error('Failed to create user', ['response' => $response->getBody()->getContents()]);
                return back()->withInput()->with('error', 'Failed to create user.');
            }
        } catch (\Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Error creating user.');
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->get("users/{$id}");
            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200 && isset($data['status']) && $data['status']) {
                return view('user.edit', ['user' => $data['data']]);
            } else {
                Log::error('Failed to fetch user for editing', ['response' => $response->getBody()->getContents()]);
                return back()->with('error', 'Failed to fetch user for editing.');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching user for editing', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error fetching user for editing.');
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'role' => 'required',
        ]);

        try {
            $response = $this->client->put("users/{$id}", [
                'json' => $validatedData,
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('user.index')->with('success', 'User updated successfully.');
            } else {
                Log::error('Failed to update user', ['response' => $response->getBody()->getContents()]);
                return back()->withInput()->with('error', 'Failed to update user.');
            }
        } catch (\Exception $e) {
            Log::error('Error updating user', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Error updating user.');
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->client->delete("users/{$id}");

            if ($response->getStatusCode() == 204) {
                return redirect()->route('user.index')->with('success', 'User deleted successfully.');
            } else {
                Log::error('Failed to delete user', ['response' => $response->getBody()->getContents()]);
                return back()->with('error', 'Failed to delete user.');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting user', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error deleting user.');
        }
    }
}
