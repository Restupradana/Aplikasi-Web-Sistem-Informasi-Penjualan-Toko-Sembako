<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ProdukController extends Controller
{
    private $baseUri;

    public function __construct()
    {
        $this->baseUri = 'http://localhost:8000/api/';
    }

    public function index()
    {
        try {
            // Fetch kategori
            $responseKategori = Http::timeout(5)->get($this->baseUri . 'kategori');
            $dataKategori = json_decode($responseKategori->body(), true);

            // Fetch produk
            $responseProduk = Http::timeout(5)->get($this->baseUri . 'produk');
            $dataProduk = json_decode($responseProduk->body(), true);

            // Fetch distributor
            $responseDistributor = Http::timeout(5)->get($this->baseUri . 'distributor');
            $dataDistributor = json_decode($responseDistributor->body(), true);

            if ($responseKategori->successful() && $dataKategori['status'] &&
                $responseProduk->successful() && $dataProduk['status'] &&
                $responseDistributor->successful() && $dataDistributor['status']) {

                $kategoriMap = collect($dataKategori['data'])->keyBy('id');
                $produkMap = collect($dataProduk['data'])->keyBy('id');
                $distributorMap = collect($dataDistributor['data'])->keyBy('id');

                return view('produk.index', [
                    'kategoriMap' => $kategoriMap,
                    'produkMap' => $produkMap,
                    'distributorMap' => $distributorMap,
                ]);
            } else {
                Log::error('Failed to fetch data', [
                    'kategori_response' => $responseKategori->body(),
                    'produk_response' => $responseProduk->body(),
                    'distributor_response' => $responseDistributor->body()
                ]);
                return view('produk.index', [
                    'kategoriMap' => collect(),
                    'produkMap' => collect(),
                    'distributorMap' => collect(),
                    'error' => 'Failed to fetch data'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching data', ['error' => $e->getMessage()]);
            return view('produk.index', [
                'kategoriMap' => collect(),
                'produkMap' => collect(),
                'distributorMap' => collect(),
                'error' => 'Error fetching data'
            ]);
        }
    }

    public function create()
    {
        try {
            // Fetch kategori for dropdown
            $responseKategori = Http::timeout(5)->get($this->baseUri . 'kategori');
            $dataKategori = json_decode($responseKategori->body(), true);

            // Fetch distributor for dropdown
            $responseDistributor = Http::timeout(5)->get($this->baseUri . 'distributor');
            $dataDistributor = json_decode($responseDistributor->body(), true);

            if ($responseKategori->successful() && $dataKategori['status'] &&
                $responseDistributor->successful() && $dataDistributor['status']) {

                $kategoriMap = collect($dataKategori['data']);
                $distributorMap = collect($dataDistributor['data']);

                return view('produk.create', [
                    'kategoriMap' => $kategoriMap,
                    'distributorMap' => $distributorMap,
                ]);
            } else {
                Log::error('Failed to fetch kategori or distributor data', [
                    'kategori_response' => $responseKategori->body(),
                    'distributor_response' => $responseDistributor->body()
                ]);
                return back()->with('error', 'Failed to fetch kategori or distributor data');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching data for create form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error fetching data for create form');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|integer',
            'distributor_id' => 'required|integer'
        ]);

        try {
            $response = Http::timeout(5)->post($this->baseUri . 'produk', $validatedData);

            $responseData = json_decode($response->body(), true);

            if ($response->successful() && $responseData['status']) {
                return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
            } else {
                Log::error('Failed to store produk', [
                    'response' => $response->body(),
                    'request' => $validatedData
                ]);
                return back()->with('error', 'Gagal menambahkan produk');
            }
        } catch (\Exception $e) {
            Log::error('Error storing produk', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error menyimpan produk');
        }
    }

    public function edit($id)
    {
        try {
            // Fetch produk by ID
            $response = Http::timeout(5)->get($this->baseUri . 'produk/' . $id);
            $data = json_decode($response->body(), true);
    
            if ($response->successful() && $data['status']) {
                $produk = $data['data'];
    
                // Fetch kategori for dropdown
                $responseKategori = Http::timeout(5)->get($this->baseUri . 'kategori');
                $dataKategori = json_decode($responseKategori->body(), true);
    
                // Fetch distributor for dropdown
                $responseDistributor = Http::timeout(5)->get($this->baseUri . 'distributor');
                $dataDistributor = json_decode($responseDistributor->body(), true);
    
                if ($responseKategori->successful() && $dataKategori['status'] &&
                    $responseDistributor->successful() && $dataDistributor['status']) {
    
                    $kategoriMap = collect($dataKategori['data']);
                    $distributorMap = collect($dataDistributor['data']);
    
                    return view('produk.edit', [
                        'produk' => $produk,
                        'kategoriMap' => $kategoriMap,
                        'distributorMap' => $distributorMap,
                    ]);
                } else {
                    Log::error('Failed to fetch kategori or distributor data', [
                        'kategori_response' => $responseKategori->body(),
                        'distributor_response' => $responseDistributor->body()
                    ]);
                    return back()->with('error', 'Failed to fetch kategori or distributor data');
                }
            } else {
                Log::error('Failed to fetch produk data', [
                    'response' => $response->body(),
                    'produk_id' => $id
                ]);
                return back()->with('error', 'Failed to fetch produk data');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching produk data for edit form', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error fetching produk data for edit form');
        }
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|integer',
            'distributor_id' => 'required|integer'
        ]);
    
        try {
            $response = Http::timeout(5)->put($this->baseUri . 'produk/' . $id, $validatedData);
    
            $responseData = json_decode($response->body(), true);
    
            if ($response->successful() && $responseData['status']) {
                return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
            } else {
                Log::error('Failed to update produk', [
                    'response' => $response->body(),
                    'request' => $validatedData
                ]);
                return back()->with('error', 'Produk Gagal Diperbaharui');
            }
        } catch (\Exception $e) {
            Log::error('Error updating produk', ['error' => $e->getMessage()]);
            return back()->with('error', 'Error memperbarui produk');
        }
    }
    

    public function destroy(string $id)
    {
        try {
            $response = Http::timeout(5)->delete("http://127.0.0.1:8000/api/produk/{$id}");
            $data = json_decode($response->body(), true);
    
            if ($response->successful() && $data['status']) {
                return response()->json(['success' => true]);
            } else {
                Log::error('Failed to delete produk data', ['response' => $response->body()]);
                return response()->json(['success' => false, 'message' => 'Gagal menghapus data produk'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting produk data', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data produk'], 500);
        }
    }
    



    public function beliStokForm($id)
    {
        try {
            $response = Http::timeout(5)->get($this->baseUri . "produk/{$id}");
            $data = json_decode($response->body(), true);

            if ($response->successful() && $data['status']) {
                $produk = $data['data'];
                return view('produk.beliStokForm', compact('produk'));
            } else {
                Log::error('Failed to fetch produk data', ['response' => $response->body()]);
                return redirect()->route('produk.index')->withErrors(['msg' => 'Gagal mengambil data produk']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching produk data', ['error' => $e->getMessage()]);
            return redirect()->route('produk.index')->withErrors(['msg' => 'Gagal mengambil data produk']);
        }
    }

    public function beliStokProcess(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        try {
            $response = Http::timeout(5)->post($this->baseUri . "produk/{$id}/beli", $validatedData);

            $responseData = json_decode($response->body(), true);

            if ($response->successful() && $responseData['message'] === 'Pembelian berhasil') {
                return redirect()->route('produk.index')->with('success', 'Berhasil membeli stok produk');
            } else {
                Log::error('Failed to buy product stock', ['response' => $response->body()]);
                return redirect()->back()->withErrors(['msg' => 'Gagal membeli stok produk']);
            }
        } catch (\Exception $e) {
            Log::error('Error buying product stock', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['msg' => 'Gagal membeli stok produk']);
        }
    }
}
