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

// Route::get('/', function () {
//     return view('auth/login');
// });
// Route::get('/','LoginController@index');is

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

  Route::get('index_admin.html', 'PecahTemplateAdminController@index');
  Route::resource('admin_user', 'AdminUserController');

//MASTER ===================================================================================================================================

//  ================================================ BARANG ==========================================================
  Route::resource('barang', 'BarangController');
  Route::get('data_barang', 'BarangController@listData')->name('data_barang');
//  ================================================ END BARANG ==========================================================

//  ================================================ DETAIL HARGA BARANG ==========================================================
  Route::resource('detail_harga_barang', 'DetailHargaBarangController');
  Route::get('data_detail_harga_barang/{barang_id}', 'DetailHargaBarangController@listData');
//  ================================================ END DETAIL HARGA BARANG ==========================================================

//  ================================================ STOK ==========================================================
  Route::resource('stok', 'StokController');
  Route::get('data_stok', 'StokController@listData')->name('data_stok');
//  ================================================ END STOK ==========================================================

//  ================================================ LOG STOK ==========================================================
  Route::resource('log_stok', 'LogStokController');
//  ================================================ END LOG STOK ==========================================================

//  ================================================ SATUAN ==========================================================
  Route::resource('satuan', 'SatuanController');
  Route::get('data_satuan', 'SatuanController@listData')->name('data_satuan');
//  ================================================ END SATUAN ==========================================================


//  ================================================ SUPPLIER ==========================================================
  Route::resource('supplier', 'SupplierController');
  Route::get('data_supplier', 'SupplierController@listData')->name('data_supplier');
//  ================================================ END SUPPLIER ==========================================================

//END MASTER ===================================================================================================================================



//MANAJEMEN USER ===================================================================================================================================

//  ================================================ GROUP ==========================================================
  Route::resource('group', 'GroupController');
  Route::get('data_group', 'GroupController@listData')->name('data_group');
//  ================================================ END GROUP ==========================================================

//  ================================================ MASTER USER ==========================================================
  Route::resource('master_user', 'MasterUserController');
  Route::get('data_master_user', 'MasterUserController@listData')->name('data_master_user');
//  ================================================ END MASTER USER ==========================================================

//  ================================================ MENU ==========================================================
  Route::resource('menu', 'MenuController');
  Route::get('data_menu', 'MenuController@listData')->name('data_menu');
//  ================================================ END MENU ==========================================================

//  ================================================ T USER ==========================================================
  Route::resource('t_user', 'TUserController');
//  ================================================ END T USER ==========================================================

//  ================================================ PEMBELIAN ==========================================================
  Route::get('data_pembelian', 'PembelianController@listData')->name('data_pembelian');
  Route::post('update_total_pembelian', 'PembelianController@totalBarang')->name('total_pembelian');
  Route::resource('pembelian', 'PembelianController');
//  ================================================ END PEMBELIAN ==========================================================

//  ================================================ DETAIL PEMBELIAN ==========================================================
  Route::get('get_data_barang/{id}', 'DetailPembelianController@getDataBarang')->name('get_pembelian');
  Route::get('detail_data_pembelian', 'DetailPembelianController@listData')->name('detail_data_pembelian');
  Route::resource('detail_pembelian', 'DetailPembelianController');
//  ================================================ END DETAIL PEMBELIAN ==========================================================

//  ================================================ DETAIL PEMBELIAN2 ==========================================================
Route::resource('detail_pembelian2', 'DetailPembelian2Controller');
//  ================================================ END DETAIL PEMBELIAN ==========================================================

//END MANAJEMEN USER ===================================================================================================================================


//  ================================================ AKUN ==========================================================
  Route::resource('akun', 'AkunController');
  Route::get('data_akun', 'AkunController@listData')->name('data_akun');
//  ================================================ END AKUN ==========================================================












});
