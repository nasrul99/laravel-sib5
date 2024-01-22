<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//--------------halaman frontend------------------
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/home', function () {
    return view('frontend.home');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/portfolio', function () {
    return view('frontend.portfolio');
});

Route::get('/services', function () {
    return view('frontend.services');
});

Route::get('/cp', function () {
    return view('frontend.contact');
});

Route::get('/after-register', function () {
    return view('frontend.after_register');
});

Route::get('/team', [TeamController::class, 'index']);

//-------------lataihan dasar2 route----------------
Route::get('/salam', function () {
    return '<h3>Selamat Belajar Laravel Framework</h3>';
});

Route::get('/staff/{nama}/{divisi}', function ($nama,$divisi) {
    return 'Nama Pegawai:'.$nama.'<br/>Divisi: '.$divisi;
});

Route::get('/person', function () {
    return view('data_person');
});

Route::get('/nilai', function () {
    return view('nilai');
});

Route::get('/staff',[StaffController::class,'dataStaff']);

//--------------halaman backend------------------
/*
Route::get('/dashboard', function () {
    return view('backend.dashboard');
});
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/contact', function () {
    return view('backend.contact');
})->middleware('auth');

Route::get('/profile', function () {
    return view('backend.profile');
})->middleware('auth');

//groupping berdasarkan peran
Route::middleware(['peran:manager-staff'])->group(function() {
    Route::resource('/asset',AssetController::class);
    Route::delete('asset/{id}', [AssetController::class, 'delete'])->name('asset.delete');
    Route::get('/generate-pdf', [AssetController::class, 'generatePDF']);
    Route::get('/asset-pdf', [AssetController::class, 'assetPDF'])->name('asset.pdf');
    Route::get('/asset-excel', [AssetController::class, 'assetExcel'])->name('asset.excel');

    Route::resource('/kategori',KategoriController::class);
    Route::resource('/history',HistoryController::class);
    Route::resource('/divisi',DivisiController::class);
    Route::resource('/mutasi',MutasiController::class);
});


//Route::resource('/user',UserController::class)->middleware('peran:admin');
Route::resource('/user',UserController::class)->middleware('auth');

Route::get('/access-denied', function () {
    return view('backend.access_denied');
})->middleware('auth');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//-----Rest API----
Route::get('/api-users', [UserController::class, 'apiUsers']);
Route::get('/api-user/{id}', [UserController::class, 'apiUserDetail']);
