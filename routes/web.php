<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\otherController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
});


Route::get('/auth/login', [LoginRegisterController::class, 'login'])->name('auth.login');
Route::get('/auth/register', [LoginRegisterController::class, 'register'])->name('auth.register');


//===== UNTUK ADMIN =====
Route::group(['middleware' => ['auth', 'checklevel:admin']], function () {
    Route::get('/admin/home', [LoginRegisterController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/tambah', [AdminController::class, 'tambah'])->name('admin.tambah');
    Route::get('/editAdmin/{id}', [AdminController::class, 'editAdmin'])->name('editAdmin');
    Route::get('/deleteAdmin/{id}', [AdminController::class, 'deleteAdmin'])->name('deleteAdmin');

    Route::get('/admin/buku', [AdminController::class, 'adminBuku'])->name('admin.buku');
    Route::get('/admin/tambahBuku', [AdminController::class, 'tambahBuku'])->name('admin.tambahBuku');
    Route::get('/admin/editBuku/{id}', [AdminController::class, 'editBuku'])->name('admin.editBuku');
    Route::get('/admin/deleteBuku/{id}', [AdminController::class, 'deleteBuku'])->name('admin.deleteBuku');

    Route::get('/admin/peminjaman', [AdminController::class, 'adminPeminjaman'])->name('admin.peminjaman');
    Route::get('/admin/tambahPeminjaman', [AdminController::class, 'tambahPeminjaman'])->name('admin.tambahPeminjaman');
    Route::get('/admin/editPeminjaman/{id}', [AdminController::class, 'editPeminjaman'])->name('admin.editPeminjaman');
    Route::get('/admin/deletePeminjaman/{id}', [AdminController::class, 'deletePeminjaman'])->name('admin.deletePeminjaman');
    Route::get('/admin/detailPeminjaman/{id_peminjaman}/{id_user}/{id_buku}', [AdminController::class, 'detailPeminjaman'])->name('admin.detailPeminjaman');
    Route::get('/admin/cetakPeminjaman', [AdminController::class, 'cetakDataPeminjaman'])->name('admin.cetakDataPeminjaman');

    Route::get('/admin/berita', [AdminController::class, 'adminberita'])->name('admin.berita');
    Route::get('/admin/inputberita', [AdminController::class, 'inputberita'])->name('admin.inputberita');
    Route::get('/admin/editberita/{id}', [AdminController::class, 'editberita'])->name('admin.editberita');
    Route::get('/admin/deleteberita/{id}', [AdminController::class, 'deleteberita'])->name('admin.deleteberita');

    Route::get('/admin/dosen', [otherController::class, 'adminDosen'])->name('admin.dosen');
    Route::get('/admin/tambahDosen', [otherController::class, 'tambahDosen'])->name('admin.tambahDosen');
    Route::get('/admin/editDosen/{id}', [otherController::class, 'editDosen'])->name('admin.editDosen');
    Route::get('/admin/deleteDosen/{id}', [otherController::class, 'deleteDosen'])->name('admin.deleteDosen');

    Route::get('/admin/lulusan', [otherController::class, 'adminLulusan'])->name('admin.lulusan');
    Route::get('/admin/tambahLulusan', [otherController::class, 'tambahLulusan'])->name('admin.tambahLulusan');
    Route::get('/admin/editLulusan/{id}', [otherController::class, 'editLulusan'])->name('admin.editLulusan');
    Route::get('/admin/deleteLulusan/{id}', [otherController::class, 'deleteLulusan'])->name('admin.deleteLulusan');

});
Route::post('/admin/tambah', [AdminController::class, 'postTambahAdmin'])->name('postTambahAdmin');
Route::post('/postEditAdmin/{id}', [AdminController::class, 'postEditAdmin'])->name('postEditAdmin');

Route::post('/postTambahBuku', [AdminController::class, 'postTambahBuku'])->name('postTambahBuku');
Route::post('/postEditBuku/{id}', [AdminController::class, 'postEditBuku'])->name('postEditBuku');

Route::post('/postTambahPeminjaman', [AdminController::class, 'postTambahPeminjaman'])->name('postTambahPeminjaman');
Route::post('/postEditPeminjaman/{id}', [AdminController::class, 'postEditPeminjaman'])->name('postEditPeminjaman');

Route::post('/postBerita', [AdminController::class, 'postBerita'])->name('postBerita');
Route::post('/posteditberita/{id}', [AdminController::class, 'posteditberita'])->name('posteditberita');

Route::post('/postTambahDosen', [otherController::class, 'postTambahDosen'])->name('postTambahDosen');
Route::post('/postEditDosen/{id}', [otherController::class, 'postEditDosen'])->name('postEditDosen');

Route::post('/postTambahLulusan', [otherController::class, 'postTambahLulusan'])->name('postTambahLulusan');
Route::post('/postEditLulusan/{id}', [otherController::class, 'postEditLulusan'])->name('postEditLulusan');

//-------UNTUK USER
Route::group(['middleware' => ['auth', 'checklevel:user']], function () {
    Route::get('/user/home', [LoginRegisterController::class, 'userHome'])->name('user.home');
    Route::get('/user/lihatBerita', [otherController::class, 'userBerita'])->name('user.lihatBerita');
    Route::get('/user/lihatDosen', [otherController::class, 'userDosen'])->name('user.lihatDosen');

    Route::get('/user/berita', [otherController::class, 'berita'])->name('user.berita');
    Route::get('/user/lulusan', [otherController::class, 'lulusan'])->name('user.lulusan');
    Route::get('/user/aktifitas', [otherController::class, 'aktifitas'])->name('user.aktifitas');
});

Route::get('/home', [otherController::class, 'home'])->name('home');
Route::get('/biodata', [otherController::class, 'biodata'])->name('biodata');

Route::post('/postRegister', [LoginRegisterController::class, 'postRegister'])->name('postRegister');
Route::post('/postLogin', [LoginRegisterController::class, 'postLogin'])->name('postLogin');


Route::post('/postlulusan', [otherController::class, 'postlulusan'])->name('postlulusan');

Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');
Route::get('/profile', [othercontroller::class, 'profile'])->name('profile');