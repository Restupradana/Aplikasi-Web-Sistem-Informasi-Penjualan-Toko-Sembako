<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8000/api/']);
    }

    public function index()
    {
        try {
            $responseKategori = $this->client->get('kategori');
            $dataKategori = json_decode($responseKategori->getBody(), true);

            if ($responseKategori->getStatusCode() == 200 && isset($dataKategori['status']) && $dataKategori['status']) {
                $kategoriMap = collect($dataKategori['data'])->keyBy('id');

                return view('kategori.index', [
                    'kategoriMap' => $kategoriMap,
                ]);
            } else {
                Log::error('Failed to fetch kategori data', ['response' => $responseKategori->getBody()->getContents()]);
                return view('kategori.index', ['kategoriMap' => collect(), 'error' => 'Failed to fetch kategori data']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching kategori data', ['error' => $e->getMessage()]);
            return view('kategori.index', ['kategoriMap' => collect(), 'error' => 'Error fetching kategori data']);
        }
    }

    // Menampilkan detail kategori
    public function show(string $id)
    {
        try {
            $response = Http::timeout(5)->get("http://127.0.0.1:8000/api/kategori/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                $kategori = $data['data'];
                return view('kategori.show', compact('kategori'));
            } else {
                Log::error('Failed to fetch kategori data', ['response' => $response->body()]);
                return redirect()->route('kategori.index')->withErrors(['msg' => 'Gagal mengambil data kategori']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching kategori data', ['error' => $e->getMessage()]);
            return redirect()->route('kategori.index')->withErrors(['msg' => 'Gagal mengambil data kategori']);
        }
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        try {
            $response = Http::timeout(5)->post('http://127.0.0.1:8000/api/kategori', $validatedData);
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                return redirect()->route('kategori.index')->with('success', 'Distributor berhasil ditambahkan');
            } else {
                Log::error('Failed to add kategori', ['response' => $response->body()]);
                return redirect()->route('kategori.create')->withErrors(['msg' => 'Gagal menambah kategori']);
            }
        } catch (\Exception $e) {
            Log::error('Error adding kategori', ['error' => $e->getMessage()]);
            return redirect()->route('kategori.create')->withErrors(['msg' => 'Gagal menambah kategori']);
        }
    }

    // Menampilkan form edit kategori
    public function edit(string $id)
    {
        try {
            $response = Http::timeout(5)->get("http://127.0.0.1:8000/api/kategori/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                $kategori = $data['data'];
                return view('kategori.edit', compact('kategori'));
            } else {
                Log::error('Failed to fetch kategori data', ['response' => $response->body()]);
                return redirect()->route('kategori.index')->withErrors(['msg' => 'Gagal mengambil data kategori']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching kategori data', ['error' => $e->getMessage()]);
            return redirect()->route('kategori.index')->withErrors(['msg' => 'Gagal mengambil data kategori']);
        }
    }

    // Memperbarui data kategori
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        try {
            $response = Http::timeout(5)->put("http://127.0.0.1:8000/api/kategori/{$id}", $validatedData);
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                return redirect()->route('kategori.index')->with('success', 'Distributor berhasil diperbarui');
            } else {
                Log::error('Failed to update kategori data', ['response' => $response->body()]);
                return redirect()->route('kategori.edit', $id)->withErrors(['msg' => 'Gagal memperbarui data kategori']);
            }
        } catch (\Exception $e) {
            Log::error('Error updating kategori data', ['error' => $e->getMessage()]);
            return redirect()->route('kategori.edit', $id)->withErrors(['msg' => 'Gagal memperbarui data kategori']);
        }
    }

    // Menghapus kategori
    public function destroy(string $id)
    {
        try {
            $response = Http::timeout(5)->delete("http://127.0.0.1:8000/api/kategori/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                return redirect()->route('kategori.index')->with('success', 'Distributor berhasil dihapus');
            } else {
                Log::error('Failed to delete kategori data', ['response' => $response->body()]);
                return redirect()->route('kategori.index')->withErrors(['msg' => 'Gagal menghapus data kategori']);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting kategori data', ['error' => $e->getMessage()]);
            return redirect()->route('kategori.index')->withErrors(['msg' => 'Gagal menghapus data kategori']);
        }
    }
}
