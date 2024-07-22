<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ExternalTransaksiPenjualanController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8000/api/']);
    }

    public function index()
    {
        $response = $this->client->get('transaksi-penjualan');
        $data = json_decode($response->getBody(), true);

        if ($response->getStatusCode() == 200 && $data['status'] == true) {
            return view('transaksi_penjualan.index', ['transaksis' => $data['data']]);
        } else {
            return view('transaksi_penjualan.index', ['transaksis' => [], 'error' => 'Failed to fetch data']);
        }
    }

    public function create()
    {
        // Mengambil data produk dari API
        $responseProduk = $this->client->get('produk');
        $dataProduk = json_decode($responseProduk->getBody(), true);

        if ($responseProduk->getStatusCode() == 200 && $dataProduk['status'] == true) {
            $produkList = $dataProduk['data'];
        } else {
            $produkList = [];
        }

        // Mengambil data kasir dari API
        $responseKasir = $this->client->get('kasir');
        $dataKasir = json_decode($responseKasir->getBody(), true);

        if ($responseKasir->getStatusCode() == 200 && $dataKasir['status'] == true) {
            $kasirList = $dataKasir['data'];
        } else {
            $kasirList = [];
        }

        return view('transaksi_penjualan.create', [
            'produkList' => $produkList,
            'kasirList' => $kasirList
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $request->validate([
            'kasir_id' => 'required|exists:kasirs,id',
            'produk' => 'required|array',
            'produk.*.produk_id' => 'required|exists:produks,id',
            'produk.*.quantity' => 'required|integer|min:1',
        ]);

        // Mengirim data ke API
        $response = $this->client->post('transaksi-penjualan', [
            'json' => [
                'kasir_id' => $request->kasir_id,
                'produk' => $request->produk
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if ($data['status']) {
            return redirect()->route('transaksi_penjualan.index')->with('success', 'Transaction created successfully.');
        }

        return redirect()->back()->withErrors($data['errors']);
    }
}
