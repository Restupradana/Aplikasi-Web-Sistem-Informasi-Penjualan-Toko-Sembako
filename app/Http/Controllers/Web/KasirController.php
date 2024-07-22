<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    // Menampilkan semua kasir
    public function index()
    {
        try {
            $response = Http::timeout(5)->get('http://127.0.0.1:8000/api/kasir');
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                $kasirs = $data['data'];
                return view('kasir.index', compact('kasirs'));
            } else {
                Log::error('Failed to fetch kasir data', ['response' => $response->body()]);
                return view('kasir.index')->withErrors(['msg' => 'Gagal mengambil data kasir']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching kasir data', ['error' => $e->getMessage()]);
            return view('kasir.index')->withErrors(['msg' => 'Gagal mengambil data kasir']);
        }
    }

    // Menampilkan detail kasir
    public function show(string $id)
    {
        try {
            $response = Http::timeout(5)->get("http://127.0.0.1:8000/api/kasir/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                $kasir = $data['data'];
                return view('kasir.show', compact('kasir'));
            } else {
                Log::error('Failed to fetch kasir data', ['response' => $response->body()]);
                return redirect()->route('kasir.index')->withErrors(['msg' => 'Gagal mengambil data kasir']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching kasir data', ['error' => $e->getMessage()]);
            return redirect()->route('kasir.index')->withErrors(['msg' => 'Gagal mengambil data kasir']);
        }
    }

    // Menampilkan form tambah kasir
    public function create()
    {
        return view('kasir.create');
    }

    // Menyimpan kasir baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:kasirs',
            'password' => 'required'
        ]);

        // Hash the password before sending it to the API
        $validatedData['password'] = Hash::make($validatedData['password']);

        try {
            $response = Http::timeout(5)->post('http://127.0.0.1:8000/api/kasir', $validatedData);
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                return redirect()->route('kasir.index')->with('success', 'Kasir berhasil ditambahkan');
            } else {
                Log::error('Failed to add kasir', ['response' => $response->body()]);
                return redirect()->route('kasir.create')->withErrors(['msg' => 'Gagal menambah kasir']);
            }
        } catch (\Exception $e) {
            Log::error('Error adding kasir', ['error' => $e->getMessage()]);
            return redirect()->route('kasir.create')->withErrors(['msg' => 'Gagal menambah kasir']);
        }
    }

    // Menampilkan form edit kasir
    public function edit(string $id)
    {
        try {
            $response = Http::timeout(5)->get("http://127.0.0.1:8000/api/kasir/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                $kasir = $data['data'];
                return view('kasir.edit', compact('kasir'));
            } else {
                Log::error('Failed to fetch kasir data', ['response' => $response->body()]);
                return redirect()->route('kasir.index')->withErrors(['msg' => 'Gagal mengambil data kasir']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching kasir data', ['error' => $e->getMessage()]);
            return redirect()->route('kasir.index')->withErrors(['msg' => 'Gagal mengambil data kasir']);
        }
    }

    // Memperbarui data kasir
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable'
        ]);

        // Hash the password only if it is present
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        try {
            $response = Http::timeout(5)->put("http://127.0.0.1:8000/api/kasir/{$id}", $validatedData);
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                return redirect()->route('kasir.index')->with('success', 'Kasir berhasil diperbarui');
            } else {
                Log::error('Failed to update kasir data', ['response' => $response->body()]);
                return redirect()->route('kasir.edit', $id)->withErrors(['msg' => 'Gagal memperbarui data kasir']);
            }
        } catch (\Exception $e) {
            Log::error('Error updating kasir data', ['error' => $e->getMessage()]);
            return redirect()->route('kasir.edit', $id)->withErrors(['msg' => 'Gagal memperbarui data kasir']);
        }
    }

    // Menghapus kasir
    public function destroy(string $id)
    {
        try {
            $response = Http::timeout(5)->delete("http://127.0.0.1:8000/api/kasir/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                return redirect()->route('kasir.index')->with('success', 'Kasir berhasil dihapus');
            } else {
                Log::error('Failed to delete kasir data', ['response' => $response->body()]);
                return redirect()->route('kasir.index')->withErrors(['msg' => 'Gagal menghapus data kasir']);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting kasir data', ['error' => $e->getMessage()]);
            return redirect()->route('kasir.index')->withErrors(['msg' => 'Gagal menghapus data kasir']);
        }
    }
}
