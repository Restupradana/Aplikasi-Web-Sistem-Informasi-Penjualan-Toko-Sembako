<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     return view('home');
// });

use App\Http\Controllers\HomeController;
Route::get('login', [HomeController::class, 'showLoginForm'])->name('login');
Route::post('login', [HomeController::class, 'login']);
Route::post('logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');


use App\Http\Controllers\Web\ProdukController;
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/${id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/produk/${id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/${id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/${id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
Route::resource('produk', ProdukController::class);
Route::get('produk/{id}/beliStok', [ProdukController::class, 'beliStokForm'])->name('produk.beliStokForm');
Route::post('produk/{id}/beliStok', [ProdukController::class, 'beliStokProcess'])->name('produk.beliStokProcess');


use App\Http\Controllers\Web\TransaksiKasirController;
Route::get('/transaksi_kasir', [TransaksiKasirController::class, 'index']);
Route::get('/transaksi_kasir/create', [TransaksiKasirController::class, 'create'])->name('transaksi_kasir.create');
Route::resource('transaksi_kasir', TransaksiKasirController::class);





use App\Http\Controllers\Web\DistributorController;
Route::get('/distributor', [DistributorController::class, 'index'])->name('distributor.index');
Route::get('/distributor/create', [DistributorController::class, 'create'])->name('distributor.create');
Route::get('/distributor/{id}', [DistributorController::class, 'show'])->name('distributor.show');
Route::get('/distributor/{id}/edit', [DistributorController::class, 'edit'])->name('distributor.edit');
Route::put('/distributor/{id}', [DistributorController::class, 'update'])->name('distributor.update');
Route::delete('/distributor/{id}', [DistributorController::class, 'delete'])->name('distributor.delete');
Route::resource('distributor', DistributorController::class);


use App\Http\Controllers\Web\KategoriController;
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::resource('kategori', KategoriController::class);


use App\Http\Controllers\Web\KasirController;
Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
Route::get('/kasir/create', [KasirController::class, 'create'])->name('kasir.create');
Route::get('/kasir/{id}', [KasirController::class, 'show'])->name('kasir.show');
Route::get('/kasir/{id}/edit', [KasirController::class, 'edit'])->name('kasir.edit');
Route::put('/kasir/{id}', [KasirController::class, 'update'])->name('kasir.update');
Route::delete('/kasir/{id}', [KasirController::class, 'destroy'])->name('kasir.destroy');
Route::resource('kasir', KasirController::class);

use App\Http\Controllers\ExternalTransaksiPenjualanController;
Route::get('/transaksi_penjualan', [ExternalTransaksiPenjualanController::class, 'index']);
Route::get('/transaksi_penjualan/create', [ExternalTransaksiPenjualanController::class, 'create'])->name('transaksi_penjualan.create');
Route::get('/transaksi_penjualan/{id}', [ExternalTransaksiPenjualanController::class, 'show'])->name('transaksi_penjualan.show');
Route::get('/transaksi_penjualan/{id}/edit', [ExternalTransaksiPenjualanController::class, 'edit'])->name('transaksi_penjualan.edit');
Route::put('/transaksi_penjualan/{id}', [ExternalTransaksiPenjualanController::class, 'update'])->name('transaksi_penjualan.update');
Route::delete('/transaksi_penjualan/{id}', [ExternalTransaksiPenjualanController::class, 'destroy'])->name('transaksi_penjualan.destroy');
Route::resource('transaksi_penjualan', ExternalTransaksiPenjualanController::class);

use App\Http\Controllers\StokProdukController;
Route::get('/stok', [StokProdukController::class, 'index'])->name('stok.index');

use App\Http\Controllers\Web\Barang_MasukController;
Route::get('/barang_masuk', [Barang_MasukController::class, 'index'])->name('barang_masuk.index');

use App\Http\Controllers\PembelianController;
Route::get('/pembelian', [PembelianController::class, 'tampilkanPembelian'])->name('pembelian.index');

use App\Http\Controllers\PenjualanController;
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');

use App\Http\Controllers\Web\KeuntunganController;
Route::get('/keuntungan', [KeuntunganController::class, 'index'])->name('keuntungan.index');


use App\Http\Controllers\Web\UserController;

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');


