<?php

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

Route::get('/', 'LoginController@loadIndex');
Route::get('/login', 'LoginController@loadLogin');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

//default
//--user
Route::get('/public', 'PeminjamanController@loadPublic');
//--admin
Route::get('/app', 'PeminjamanController@loadApp');

Route::get('/user', 'UserController@loadUser');
Route::get('/user/add', 'UserController@loadAddUser');
Route::post('/user/add', 'UserController@storeAddUser');
Route::get('/user/edit/{id}', 'UserController@loadEditUser');
Route::post('/user/edit/{id}', 'UserController@storeEditUser');
Route::get('/user/delete/{id}', 'UserController@deleteEditUser');

// Buku
Route::get('/buku', 'BukuController@loadBuku');
Route::get('/buku/add', 'BukuController@loadAddBuku');
Route::post('/buku/add', 'BukuController@storeAddBuku');
Route::get('/buku/edit/{id}', 'BukuController@loadEditBuku');
Route::post('/buku/edit/{id}', 'BukuController@storeEditBuku');
Route::get('/buku/delete/{id}', 'BukuController@deleteBuku');

// Stok Buku
Route::get('/stokbuku', 'BukuController@loadStokBuku');
Route::get('/stokbuku/add', 'BukuController@loadAddStokBuku');
Route::post('/stokbuku/add', 'BukuController@storeAddStokBuku');
Route::get('/stokbuku/edit/{id}', 'BukuController@loadEditStokBuku');
Route::post('/stokbuku/edit/{id}', 'BukuController@storeEditStokBuku');
Route::get('/stokbuku/delete/{id}', 'BukuController@deleteStokBuku');

//Booking
//user
Route::get('/peminjaman/booking/add', 'PeminjamanController@loadAddBooking');
Route::post('/peminjaman/booking/add', 'PeminjamanController@storeAddBooking');
//admin
Route::get('/peminjaman/booking', 'PeminjamanController@loadBooking');
Route::get('/peminjaman/booking/konfirmasi/{id}', 'PeminjamanController@konfirmasiBooking');
Route::get('/peminjaman/booking/cancel/{id}', 'PeminjamanController@cancelBooking');

//pinjam
Route::get('/peminjaman/pinjam', 'PeminjamanController@loadPinjam');
Route::get('/peminjaman/pinjam/konfirmasi/{id}', 'PeminjamanController@konfirmasiPinjam');

//selesai
Route::get('/peminjaman/selesai', 'PeminjamanController@loadSelesai');

//denda
Route::get('/peminjaman/denda', 'PeminjamanController@loadDenda');
Route::get('/peminjaman/denda/konfirmasi/{id}', 'PeminjamanController@konfirmasiDenda');