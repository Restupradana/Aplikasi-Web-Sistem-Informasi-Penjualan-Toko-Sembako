<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class StokProdukController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:8000/api/']);
    }

    public function index()
    {
        // Fetch products
        $responseProduk = $this->client->get('produk');
        $dataProduk = json_decode($responseProduk->getBody(), true);

        // Fetch categories
        $responseKategori = $this->client->get('kategori');
        $dataKategori = json_decode($responseKategori->getBody(), true);

        // Fetch distributors
        $responseDistributor = $this->client->get('distributor');
        $dataDistributor = json_decode($responseDistributor->getBody(), true);

        if ($responseProduk->getStatusCode() == 200 && $dataProduk['status'] == true &&
            $responseKategori->getStatusCode() == 200 && $dataKategori['status'] == true &&
            $responseDistributor->getStatusCode() == 200 && $dataDistributor['status'] == true) {
            
            $kategoriMap = collect($dataKategori['data'])->keyBy('id');
            $distributorMap = collect($dataDistributor['data'])->keyBy('id');
            $produks = $dataProduk['data'];

            return view('stok.index', [
                'produks' => $produks,
                'kategoriMap' => $kategoriMap,
                'distributorMap' => $distributorMap,
            ]);
        } else {
            return view('stok.index', ['produks' => [], 'kategoriMap' => collect(), 'distributorMap' => collect(), 'error' => 'Failed to fetch data']);
        }
    }
}
