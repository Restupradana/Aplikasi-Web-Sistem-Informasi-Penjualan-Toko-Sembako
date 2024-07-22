<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8000/api/']);
    }

    public function index()
    {
        try {
            $responseDistributor = $this->client->get('distributor');
            $dataDistributor = json_decode($responseDistributor->getBody(), true);

            if ($responseDistributor->getStatusCode() == 200 && isset($dataDistributor['status']) && $dataDistributor['status']) {
                $distributorMap = collect($dataDistributor['data'])->keyBy('id');

                return view('distributor.index', [
                    'distributorMap' => $distributorMap,
                ]);
            } else {
                Log::error('Failed to fetch distributor data', ['response' => $responseDistributor->getBody()->getContents()]);
                return view('distributor.index', ['distributorMap' => collect(), 'error' => 'Failed to fetch distributor data']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching distributor data', ['error' => $e->getMessage()]);
            return view('distributor.index', ['distributorMap' => collect(), 'error' => 'Error fetching distributor data']);
        }
    }

    public function create()
    {
        return view('distributor.create');
    }

    public function store(Request $request)
    {
        try {
            $response = $this->client->post('distributor', [
                'json' => $request->all(),
            ]);

            if ($response->getStatusCode() == 201) {
                return redirect()->route('distributor.index')->with('success', 'Distributor created successfully.');
            } else {
                Log::error('Failed to create distributor', ['response' => $response->getBody()->getContents()]);
                return back()->withInput()->with('error', 'Failed to create distributor.');
            }
        } catch (\Exception $e) {
            Log::error('Error creating distributor', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Error creating distributor.');
        }
    }

    public function edit($id)
    {
        try {
            $response = $this->client->get("distributor/{$id}");
            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200 && isset($data['status']) && $data['status']) {
                return view('distributor.edit', ['distributor' => $data['data']]);
            } else {
                Log::error('Failed to fetch distributor for editing', ['response' => $response->getBody()->getContents()]);
                return back()->with('error', 'Failed to fetch distributor for editing.');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching distributor for editing', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error fetching distributor for editing.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $response = $this->client->put("distributor/{$id}", [
                'json' => $request->all(),
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('distributor.index')->with('success', 'Distributor updated successfully.');
            } else {
                Log::error('Failed to update distributor', ['response' => $response->getBody()->getContents()]);
                return back()->withInput()->with('error', 'Failed to update distributor.');
            }
        } catch (\Exception $e) {
            Log::error('Error updating distributor', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Error updating distributor.');
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->client->delete("distributor/{$id}");

            if ($response->getStatusCode() == 204) {
                return redirect()->route('distributor.index')->with('success', 'Distributor deleted successfully.');
            } else {
                Log::error('Failed to delete distributor', ['response' => $response->getBody()->getContents()]);
                return back()->with('error', 'Failed to delete distributor.');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting distributor', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error deleting distributor.');
        }
    }
}
