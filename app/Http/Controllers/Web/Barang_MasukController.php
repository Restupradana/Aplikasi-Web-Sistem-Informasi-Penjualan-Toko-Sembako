<?php

namespace App\Http\Controllers\Web;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Barang_MasukController extends Controller
{
    // Menampilkan semua produk
    public function index(Request $request)
    {
        try {
            $produkResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/produk');
            $kategoriResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/kategori');
            $distributorResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/distributor');
            $barangmasukResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/pembelian-stok-produk');

            $produkData = json_decode($produkResponse->body(), true);
            $kategoriData = json_decode($kategoriResponse->body(), true);
            $distributorData = json_decode($distributorResponse->body(), true);
            $barangmasukData = json_decode($barangmasukResponse->body(), true);

            if (
                $produkResponse->successful() && $kategoriResponse->successful() && $distributorResponse->successful() &&
                $produkData['status'] && $kategoriData['status'] && $distributorData['status'] && $barangmasukData['status']
            ) {

                $produk = collect($produkData['data']);
                $kategoris = collect($kategoriData['data'])->keyBy('id');
                $distributors = collect($distributorData['data'])->keyBy('id');
                $pembelian_stok_produk = collect($barangmasukData['data'])->groupBy('produk_id');

                // DataTables parameters
                $draw = $request->get('draw');
                $start = $request->get('start', 0);
                $length = $request->get('length', 10);

                // Ensure length is never zero to avoid division by zero
                $length = max($length, 10);

                // Calculate pagination parameters
                $currentPage = (int)($start / $length) + 1;

                // Get the slice of items for the current page
                $currentItems = $produk->slice($start, $length)->values()->map(function ($item) use ($kategoris, $distributors, $pembelian_stok_produk) {
                    $item['kategori_name'] = $kategoris[$item['kategori_id']]['name'] ?? 'Tidak Diketahui';
                    $item['distributor_name'] = $distributors[$item['distributor_id']]['name'] ?? 'Tidak Diketahui';

                    $stokProduk = $pembelian_stok_produk->get($item['id']);
                    $item['quantity'] = $stokProduk ? $stokProduk->sum('quantity') : 'N/A'; // Mengambil total quantity dari pembelian_stok_produk
                    $item['harga_beli'] = $stokProduk ? $stokProduk->avg('harga_beli') : 'N/A'; // Mengambil rata-rata harga_beli dari pembelian_stok_produk

                    return $item;
                })->all();

                if ($request->ajax()) {
                    return response()->json([
                        'draw' => $draw,
                        'recordsTotal' => $produk->count(),
                        'recordsFiltered' => $produk->count(),
                        'data' => $currentItems,
                    ]);
                }

                $paginatedItems = new LengthAwarePaginator($currentItems, $produk->count(), $length, $currentPage, [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]);

                return view('barang_masuk.index', compact('paginatedItems', 'kategoris', 'distributors'));
            } else {
                Log::error('Failed to fetch produk, kategori, or distributor data', [
                    'produkResponse' => $produkResponse->body(),
                    'kategoriResponse' => $kategoriResponse->body(),
                    'distributorResponse' => $distributorResponse->body(),
                    'barangmasukResponse' => $barangmasukResponse->body()
                ]);
                return view('barang_masuk.index')->withErrors(['msg' => 'Gagal mengambil data produk, kategori, atau distributor']);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching produk, kategori, or distributor data', ['error' => $e->getMessage()]);
            return view('barang_masuk.index')->withErrors(['msg' => 'Gagal mengambil data produk, kategori, atau distributor']);
        }
    }
}
