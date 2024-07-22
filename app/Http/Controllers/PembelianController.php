<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PembelianController extends Controller
{
    // Fungsi untuk menampilkan data pembelian
public function tampilkanPembelian()
{
    try {
        // Ambil data produk dari API
        $produkResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/produk');
        $produkData = json_decode($produkResponse->body(), true);

        if (!$produkResponse->successful() || !$produkData['status']) {
            Log::error('Failed to fetch product data', ['response' => $produkResponse->body()]);
            return redirect()->back()->withErrors(['msg' => 'Gagal mengambil data produk dari API']);
        }

        // Ambil data pembelian dari database
        $pembelians = DB::table('pembelian_stok_produk')->get();

        // Ambil data kategori dari API
        $kategoriResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/kategori');
        $kategoriData = json_decode($kategoriResponse->body(), true);

        if (!$kategoriResponse->successful() || !$kategoriData['status']) {
            Log::error('Failed to fetch category data', ['response' => $kategoriResponse->body()]);
            return redirect()->back()->withErrors(['msg' => 'Gagal mengambil data kategori dari API']);
        }

        // Ambil data distributor dari API
        $distributorResponse = Http::timeout(5)->get('http://127.0.0.1:8000/api/distributor');
        $distributorData = json_decode($distributorResponse->body(), true);

        if (!$distributorResponse->successful() || !$distributorData['status']) {
            Log::error('Failed to fetch distributor data', ['response' => $distributorResponse->body()]);
            return redirect()->back()->withErrors(['msg' => 'Gagal mengambil data distributor dari API']);
        }

        // Gabungkan data pembelian dengan data produk, distributor, dan kategori
        $pembelianList = $pembelians->map(function ($pembelian) use ($produkData, $kategoriData, $distributorData) {
            // Cari data produk yang sesuai dengan produk_id
            $produk = collect($produkData['data'])->firstWhere('id', $pembelian->produk_id);
            $kategori = collect($kategoriData['data'])->firstWhere('id', $produk['kategori_id']);
            $distributor = collect($distributorData['data'])->firstWhere('id', $produk['distributor_id']);

            // Hitung total harga
            $totalHarga = $pembelian->quantity * $pembelian->harga_beli;

            // Buat objek baru dengan informasi lengkap
            return [
                'name' => $produk['name'] ?? 'Produk Tidak Ditemukan',
                'nama_kategori' => $kategori['name'] ?? 'Kategori Tidak Ditemukan',
                'nama_distributor' => $distributor['name'] ?? 'Distributor Tidak Ditemukan',
                'quantity' => $pembelian->quantity,
                'harga_beli' => $pembelian->harga_beli,
                'total_harga' => $totalHarga,
                'formatted_harga_beli' => $this->formatRupiah($pembelian->harga_beli),
                'formatted_total_harga' => $this->formatRupiah($totalHarga),
                'tanggal_pembelian' => $pembelian->created_at,
            ];
        });

        return view('ownerpembelian.index', compact('pembelianList'));

    } catch (\Exception $e) {
        Log::error('Error fetching purchase data', ['error' => $e->getMessage()]);
        return redirect()->back()->withErrors(['msg' => 'Gagal mengambil data pembelian']);
    }
}

// Fungsi untuk format mata uang Rupiah
private function formatRupiah($number)
{
    return 'Rp ' . number_format($number, 0, ',', '.');
}
}