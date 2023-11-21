<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataProduksiController;
use App\Http\Controllers\KelolaPemasaranController;
use App\Http\Controllers\KelolaPemesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StokBibitController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.main');
// });

// LOGIN
Route::get('/', [LoginController::class, 'index'])->name('login'); // alamat '/' akan mengarahkan ke LoginController masuk ke function index
Route::get('/login', [LoginController::class, 'index'])->name('login'); // alamat '/login' akan mengarahkan ke LoginController masuk ke function index
Route::post('/auth', [LoginController::class, 'authenticate'])->name('auth'); // alamat '/auth' akan mengarahkan ke LoginController masuk ke function authenticate

Route::group(['middleware' => ['auth']], function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashbord'); // alamat '/dashboard' akan mengarahkan ke DashboardController masuk ke function index

    // LOGOUT
    Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout'); // alamat '/logout' akan mengarahkan ke LoginController masuk ke function logout

    //DATA PRODUKSI
    Route::get('/dataproduksi', [DataProduksiController::class, 'index'])->name('dataproduksi.index'); // alamat '/dataproduksi' akan mengarahkan ke DataProduksiController masuk ke function index
    Route::post('/dataproduksiStore', [DataProduksiController::class, 'store'])->name('dataproduksi.store'); // alamat '/dataproduksiStore' akan mengarahkan ke DataProduksiController masuk ke function store
    Route::put('/dataproduksiUpdate/{id}', [DataProduksiController::class, 'update'])->name('dataproduksi.update'); // alamat '/dataproduksiUpdate' akan mengarahkan ke DataProduksiController masuk ke function update
    Route::get('/dataproduksiDelete/{id}', [DataProduksiController::class, 'destroy'])->name('dataproduksi.delete'); // alamat '/dataproduksiDelete' akan mengarahkan ke DataProduksiController masuk ke function destroy

    //KELOLA USER
    Route::get('/kelolauser', [UserController::class, 'index'])->name('kelolauser.index'); // alamat '/kelolauser' akan mengarahkan ke UserController masuk ke function index
    Route::post('/kelolauserStore', [UserController::class, 'store'])->name('kelolauser.store'); // alamat '/kelolauserStore' akan mengarahkan ke UserController masuk ke function store
    Route::put('/kelolauserUpdate/{id}', [UserController::class, 'update'])->name('kelolauser.update'); // alamat '/kelolauserUpdate' akan mengarahkan ke UserController masuk ke function update
    Route::get('/kelolauserDelete/{id}', [UserController::class, 'destroy'])->name('kelolauser.delete'); // alamat '/kelolauserDelete' akan mengarahkan ke UserController masuk ke function destroy

    //KELOLA PEMESANAN
    Route::get('/kelolapemesanan', [KelolaPemesananController::class, 'index'])->name('kelolapemesanan.index'); // alamat '/kelolapemesanan' akan mengarahkan ke KelolaPemesananController masuk ke function index
    Route::post('/kelolapemesananStore', [KelolaPemesananController::class, 'store'])->name('kelolapemesanan.store'); // alamat '/kelolapemesananStore' akan mengarahkan ke KelolaPemesananController masuk ke function store
    Route::post('/kelolapemesanan/validateTask/{id}', [KelolaPemesananController::class, 'validateTask'])->name('kelolapemesanan.validateTask'); // alamat '/kelolapemesanan/validateTask' akan mengarahkan ke KelolaPemesananController masuk ke function validateTask
    Route::put('/kelolapemesananUpdate/{id}', [KelolaPemesananController::class, 'update'])->name('kelolapemesanan.update'); // alamat '/kelolapemesananUpdate' akan mengarahkan ke KelolaPemesananController masuk ke function update
    Route::get('/kelolapemesananDelete/{id}', [KelolaPemesananController::class, 'destroy'])->name('kelolapemesanan.delete'); // alamat '/kelolapemesananDelete' akan mengarahkan ke KelolaPemesananController masuk ke function destroy

    //KELOLA PEMASARAN
    Route::get('/kelolapemasaran', [KelolaPemasaranController::class, 'index'])->name('kelolapemasaran.index'); // alamat '/kelolapemasaran' akan mengarahkan ke KelolaPemasaranController masuk ke function index
    Route::post('/kelolapemasaranStore', [KelolaPemasaranController::class, 'store'])->name('kelolapemasaran.store'); // alamat '/kelolapemasaranStore' akan mengarahkan ke KelolaPemasaranController masuk ke function store
    Route::put('/kelolapemasaranUpdate/{id}', [KelolaPemasaranController::class, 'update'])->name('kelolapemasaran.update'); // alamat '/kelolapemasaranUpdate' akan mengarahkan ke KelolaPemasaranController masuk ke function update
    Route::get('/kelolapemasaranDelete/{id}', [KelolaPemasaranController::class, 'destroy'])->name('kelolapemasaran.delete'); // alamat '/kelolapemasaranDelete' akan mengarahkan ke KelolaPemesananController masuk ke function destroy

    //KELOLA STOK
    Route::get('/stokbibit', [StokBibitController::class, 'index'])->name('stokbibit.index'); // alamat '/stokbibit' akan mengarahkan ke StokBibitController masuk ke function index
    Route::post('/stokbibitStore', [StokBibitController::class, 'store'])->name('stokbibit.store'); // alamat '/stokbibitStore' akan mengarahkan ke StokBibitController masuk ke function store
    Route::put('/stokbibitUpdate/{id}', [StokBibitController::class, 'update'])->name('stokbibit.update'); // alamat '/stokbibitUpdate' akan mengarahkan ke StokBibitController masuk ke function update
    Route::get('/stokbibDelete/{id}', [StokBibitController::class, 'destroy'])->name('stokbibit.delete'); // alamat '/stokbibitDelete' akan mengarahkan ke StokBibitController masuk ke function destroy


    //LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});
