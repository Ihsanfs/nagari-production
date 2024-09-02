<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Creator;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Super;

use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SosialmediaController;
use App\Http\Controllers\TransaksiController;
use App\Models\Donwload;
use App\Http\Controllers\AplikasiController;
// use App\Http\Controllers\Super;


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

Route::middleware(['web'])->group(function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    Route::get('/', [FrontController::class, 'beranda'])->name('beranda');
    Route::get('/page/{slug}', [FrontController::class, 'index'])->name('detail');

    Route::get('/halaman/{slug}', [FrontController::class, 'halaman'])->name('halaman');

    Route::get('/layanan/{slug}', [FrontController::class, 'layanan'])->name('layanan');

    Route::get('/search/berita/', [FrontController::class, 'search_berita'])->name('search_berita');
    Route::get('/news', [FrontController::class, 'berita_lengkap'])->name('berita_lengkap');
    Route::get('/category/{slug}', [FrontController::class, 'kategori_tag'])->name('kategori_tag');
    Route::get('/kategori/{category}', [FrontController::class, 'kategori_tampil'])->name('kategori_tampil');
    Route::get('/tag/{tag}', [FrontController::class, 'tag_tampil'])->name('tag_tampil');
    Route::get('/album/galeri/{album}', [Super\FotoController::class, 'album_isi'])
        ->name('album_tampil');

        Route::get('/pengumuman', [ PengumumanController::class, 'pengumuman_nagari'])
        ->name('pengumuman_nagari');
        Route::get('/download', [ DownloadController::class, 'download_nagari'])
        ->name('download_nagari');
});


Route::middleware(['auth', 'verified', 'role:1'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {
        Route::get('/Dashboard', [Super\SuperadminController::class, 'index'])
            ->name('dashboard');


        //kategori
        Route::get('/kategori', [Super\SuperadminController::class, 'kategori'])
            ->name('kategori');
        Route::get('/kategori/create', [Super\SuperadminController::class, 'kategori_add'])
            ->name('kategori_add');
        Route::post('/kategori/store', [Super\SuperadminController::class, 'kategori_store'])
            ->name('kategori_store');
        Route::get('/kategori/edit/{id}', [Super\SuperadminController::class, 'kategori_show'])
            ->name('edit_kategori');
        Route::delete('/kategori/hapus/{id}', [Super\SuperadminController::class, 'kategori_hapus'])
            ->name('hapus_kategori');
        Route::put('/kategori/update/{id}', [Super\SuperadminController::class, 'kategori_update'])
            ->name('kategori_update');


     //berita
     Route::post('/berita/upload', [Super\SuperadminController::class, 'berita_upload'])
     ->name('berita_upload');
        Route::get('/berita', [Super\SuperadminController::class, 'berita'])
            ->name('berita');
        Route::get('/berita/search', [Super\SuperadminController::class, 'berita_search'])
            ->name('berita_search');
        Route::get('/berita/search/{slug}', [Super\SuperadminController::class, 'berita_detail'])
            ->name('berita_detail');
        Route::post('/berita/store', [Super\SuperadminController::class, 'berita_store'])
            ->name('berita_store');
        Route::get('/berita/{id}/edit', [Super\SuperadminController::class, 'berita_edit'])
            ->name('berita_edit');
        Route::get('/berita/create', [Super\SuperadminController::class, 'berita_add'])
            ->name('berita_add');
        Route::put('/berita/{id}/update', [Super\SuperadminController::class, 'berita_update'])
            ->name('berita_update');
        Route::delete('/berita/{id}/delete', [Super\SuperadminController::class, 'berita_delete'])
            ->name('berita_delete');



        //slide video
        Route::get('/video', [Super\SlideController::class, 'index'])
            ->name('video');
        Route::get('/video/create', [Super\SlideController::class, 'create'])
            ->name('video_add');
        Route::post('/video/store', [Super\SlideController::class, 'store'])
            ->name('video_store');
        Route::get('/video/{id}/edit', [Super\SlideController::class, 'edit'])
            ->name('video_edit');
        Route::put('/video/{id}/update', [Super\SlideController::class, 'update'])
            ->name('video_update');
        Route::delete('/video/{id}/delete', [Super\SlideController::class, 'destroy'])
            ->name('video_delete');



        //gallery
        Route::get('/gallery', [Super\FotoController::class, 'index'])
            ->name('galery');
        Route::get('/gallery/create', [Super\FotoController::class, 'create'])
            ->name('galery_create');
        Route::get('/gallery/{id}/edit', [Super\FotoController::class, 'edit'])
            ->name('galery_edit');
        Route::post('/gallery/store', [Super\FotoController::class, 'store'])
            ->name('galery_store');
        Route::put('/gallery/{id}/update', [Super\FotoController::class, 'update'])
            ->name('galery_update');
        Route::delete('/gallery/{id}/delete', [Super\FotoController::class, 'destroy'])
            ->name('galery_destroy');

        //pengumuman
        Route::get('/pengumuman', [ PengumumanController::class, 'index'])
        ->name('pengumuman');
        Route::get('/pengumuman/create', [ PengumumanController::class, 'create'])
        ->name('pengumuman_create');
        Route::post('/pengumuman', [ PengumumanController::class, 'store'])
        ->name('pengumuman_store');
        Route::put('/pengumuman/update/{id}', [ PengumumanController::class, 'update'])
        ->name('pengumuman_update');
        Route::delete('/pengumuman/{id}', [ PengumumanController::class, 'delete'])
        ->name('pengumuman_delete');

        //donwload
        Route::get('/download', [ DownloadController::class, 'index'])
        ->name('download');
        Route::get('/download/create', [ downloadController::class, 'create'])
        ->name('download_create');
        Route::post('/download', [ downloadController::class, 'store'])
        ->name('download_store');
        Route::put('/download/update/{id}', [ downloadController::class, 'update'])
        ->name('download_update');
        Route::delete('/download/{id}', [ downloadController::class, 'delete'])
        ->name('download_delete');

        //album
        Route::get('/album/create', [Super\FotoController::class, 'album_create'])
            ->name('album_create');

        Route::post('/album/store', [Super\FotoController::class, 'album_store'])
            ->name('album_store');

        Route::get('/album/data/{id}', [Super\FotoController::class, 'album_galeri'])
            ->name('album_isi');

        Route::get('/album/data/edit/{id}', [Super\FotoController::class, 'album_edit'])
            ->name('album_edit');

        Route::put('/album/data/update/{id}', [Super\FotoController::class, 'album_update'])
            ->name('album_update');

        Route::delete('/album/data/delete/{id}', [Super\FotoController::class, 'album_delete'])
            ->name('album_delete');


        //pegawai
        Route::get('/pegawai', [PegawaiController::class, 'index'])
            ->name('pegawai');
            Route::get('/pegawai/create', [PegawaiController::class, 'create'])
            ->name('pegawai_create');
            Route::post('/pegawai/store', [PegawaiController::class, 'store'])
            ->name('pegawai_store');
            Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])
            ->name('pegawai_update');
            Route::delete('/pegawai/destroy/{id}', [PegawaiController::class, 'destroy'])
            ->name('pegawai_destroy');




        //instansi
        Route::get('/instansi', [Super\InstansiController::class, 'index'])
            ->name('instansi');
        Route::put('/instansi/{id}/update', [Super\InstansiController::class, 'update'])
            ->name('instansi_update');
        Route::get('/instansi/create', [Super\InstansiController::class, 'create'])
            ->name('instansi_create');

        Route::post('/instansi/store', [Super\InstansiController::class, 'store'])
            ->name('instansi_store');

        Route::get('/instansi/{id}/edit', [Super\InstansiController::class, 'edit'])
            ->name('instansi_edit');
            Route::get('/instansi/{id}/remove', [Super\InstansiController::class, 'remove'])
            ->name('instansi_media_remove');
        //media sosial
        Route::get('/mediasosial', [SosialmediaController::class, 'index'])
            ->name('media');
        Route::get('/mediasosial/create', [SosialmediaController::class, 'create'])
            ->name('media_create');
        Route::post('/mediasosial/store', [SosialmediaController::class, 'store'])
            ->name('media_store');
        Route::put('/mediasosial/update/{id}', [SosialmediaController::class, 'update'])
            ->name('media_update');
        Route::delete('/mediasosial/delete/{id}', [SosialmediaController::class, 'delete'])
            ->name('media_delete');

        //pelayanan
        Route::get('/pelayanan', [PelayananController::class, 'index'])
        ->name('pelayanan');
        Route::get('/pelayanan/create', [PelayananController::class, 'create'])
        ->name('pelayanan_create');
        Route::get('/pelayanan/edit/{id}', [PelayananController::class, 'edit'])
        ->name('pelayanan_edit');
        Route::post('/pelayanan/store', [PelayananController::class, 'store'])
        ->name('pelayanan_store');
        Route::put('/pelayanan/update/{id}', [PelayananController::class, 'update'])
        ->name('pelayanan_update');
        Route::delete('/pelayanan/delete/{id}', [PelayananController::class, 'destroy'])
        ->name('pelayanan_destroy');

        //slider foto
        Route::get('/slider', [SliderController::class, 'index'])->name('slider_index');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider_create');
        Route::post('/slider/store', [SliderController::class, 'store'])->name('slider_store');
        Route::delete('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider_delete');
        Route::put('/slider/update/{id}', [SliderController::class, 'update'])->name('slider_update');



        //sumber dana
        Route::get('/sumber-dana', [TransaksiController::class, 'index'])
        ->name('sumber_dana');
        Route::get('/sumber-dana/create', [TransaksiController::class, 'create_dana'])
        ->name('sumber_create');
        Route::post('/sumber-dana', [TransaksiController::class, 'store_dana'])
        ->name('sumber_store');
        Route::put('/sumber-dana/update/{id}', [TransaksiController::class, 'update_dana'])
        ->name('sumber_update');
        Route::delete('/sumber-dana/{id}', [TransaksiController::class, 'delete_dana'])
        ->name('sumber_delete');
        Route::get('/transaksimasuk/{tahun}', [TransaksiController::class, 'transaksimasuk'])
        ->name('transaksimasuk');
        //transaksi
        Route::get('/transaksi', [TransaksiController::class, 'transaksi'])
        ->name('transaksi');
        Route::get('/transaksi/create', [TransaksiController::class, 'create_transaksi'])
        ->name('transaksi_create');
        Route::post('/transaksi', [TransaksiController::class, 'store_transaksi'])
        ->name('transaksi_store');
        Route::put('/transaksi/update/{id}', [TransaksiController::class, 'update_transaksi'])
        ->name('transaksi_update');
        Route::delete('/transaksi/{id}', [TransaksiController::class, 'delete_transaksi'])
        ->name('transaksi_delete');

        Route::get('/transaksitahunan/{tahun}', [TransaksiController::class, 'transaksitahunan'])
        ->name('transaksi_tahunan');


        ///users
        Route::get('/users/profile', [Super\UsersController::class, 'index'])
            ->name('users');
        Route::get('/users/all', [Super\UsersController::class, 'tampil_user'])
            ->name('users_all');
        Route::delete('/users/{id}/delete', [Super\UsersController::class, 'hapus_user'])
            ->name('users_hapus');
        Route::get('/users/create', [Super\UsersController::class, 'create'])
            ->name('users_create');
        Route::post('/users/store', [Super\UsersController::class, 'store'])
            ->name('users_store');
        Route::put('/users/{id}/update', [Super\UsersController::class, 'update'])
            ->name('users_update');
        Route::get('/users/status/{id}', [Super\UsersController::class, 'status'])
            ->name('users_status');
        Route::get('/users/edit_user/{id}', [Super\UsersController::class, 'edit_user'])
            ->name('users_edit_data');
        Route::put('/users/edit_user/{id}/update', [Super\UsersController::class, 'update_user'])
            ->name('users_edit_data_update');

        Route::get('/users/password', [Super\UsersController::class, 'password'])
            ->name('users_password');
        Route::put('/users/password/{id}', [Super\UsersController::class, 'password_update'])
            ->name('users_password_update');
        Route::get('/users/{id}/update', [Super\UsersController::class, 'edit'])
            ->name('users_edit');


        //nama_aplikasi
        Route::get('/apps/nama', [AplikasiController::class, 'index'])
        ->name('apps');
        Route::post('/apps/nama', [AplikasiController::class, 'store'])
        ->name('apps_store');
        Route::put('/apps/nama/{id}/update', [AplikasiController::class, 'update'])
        ->name('apps_update');
        Route::delete('/apps/nama/{id}/delete', [AplikasiController::class, 'delete'])
        ->name('apps_delete');

        //halaman
        Route::get('/halaman', [Super\HalamanController::class, 'index'])
            ->name('halaman');
        Route::post('/halaman/store', [Super\HalamanController::class, 'store'])
            ->name('halaman_store');
        Route::get('/halaman/{id}/edit', [Super\HalamanController::class, 'edit'])
            ->name('halaman_edit');
        Route::put('/halaman/update/{id}', [Super\HalamanController::class, 'update'])
            ->name('halaman_update');
        Route::delete('/halaman/destroy/{id}', [Super\HalamanController::class, 'destroy'])
            ->name('halaman_delete');
        Route::get('/halaman/create', [Super\HalamanController::class, 'create'])
            ->name('halaman_create');

        Route::get('/halaman/cekstatus/{id}', [Super\HalamanController::class, 'status'])
            ->name('halaman_cek');
        //menu static
        Route::post('/halaman/store/static', [Super\HalamanController::class, 'halaman_static'])
            ->name('halaman_static');
        //menu
        Route::get('/menu', [MenuController::class, 'index'])
            ->name('menu');
        Route::get('/menu/create', [MenuController::class, 'create'])
            ->name('menu_create');

        Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])
            ->name('menu_edit');
        Route::put('/menu/update/{id}', [MenuController::class, 'update'])
            ->name('menu_update');
        Route::delete('/menu/destroy/{id}', [MenuController::class, 'delete'])
            ->name('menu_delete');
        Route::post('/menu/store', [MenuController::class, 'store'])
            ->name('menu_store');

        //tag
        Route::get('/tag', [Super\TagController::class, 'index'])
            ->name('tag.index');

        Route::post('/tag/store', [Super\TagController::class, 'store'])
            ->name('tag.store');
        Route::delete('/tag/{id}/delete', [Super\TagController::class, 'destroy'])
            ->name('tag.delete');

        Route::patch('/tag/{id}/update', [Super\TagController::class, 'update'])
            ->name('tag.update');
    });

Route::middleware(['auth', 'verified', 'role:2'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/Dashboard', [Super\SuperadminController::class, 'index'])
            ->name('dashboard');


        //nama_aplikasi
        Route::get('/apps/nama', [AplikasiController::class, 'index'])
        ->name('apps');
        Route::post('/apps/nama', [AplikasiController::class, 'store'])
        ->name('apps_store');
        Route::put('/apps/nama/{id}/update', [AplikasiController::class, 'update'])
        ->name('apps_update');
        Route::delete('/apps/nama/{id}/delete', [AplikasiController::class, 'delete'])
        ->name('apps_delete');

        //kategori
        Route::get('/kategori', [Super\SuperadminController::class, 'kategori'])
            ->name('kategori');
        Route::get('/kategori/create', [Super\SuperadminController::class, 'kategori_add'])
            ->name('kategori_add');
        Route::post('/kategori/store', [Super\SuperadminController::class, 'kategori_store'])
            ->name('kategori_store');
        Route::get('/kategori/edit/{id}', [Super\SuperadminController::class, 'kategori_show'])
            ->name('edit_kategori');
        Route::delete('/kategori/hapus/{id}', [Super\SuperadminController::class, 'kategori_hapus'])
            ->name('hapus_kategori');
        Route::put('/kategori/update/{id}', [Super\SuperadminController::class, 'kategori_update'])
            ->name('kategori_update');


       //berita
       Route::post('/berita/upload', [Super\SuperadminController::class, 'berita_upload'])
       ->name('berita_upload');

        Route::get('/berita', [Super\SuperadminController::class, 'berita'])
            ->name('berita');
        Route::get('/berita/search', [Super\SuperadminController::class, 'berita_search'])
            ->name('berita_search');
        Route::get('/berita/search/{slug}', [Super\SuperadminController::class, 'berita_detail'])
            ->name('berita_detail');
        Route::post('/berita/store', [Super\SuperadminController::class, 'berita_store'])
            ->name('berita_store');
        Route::get('/berita/{id}/edit', [Super\SuperadminController::class, 'berita_edit'])
            ->name('berita_edit');
        Route::get('/berita/create', [Super\SuperadminController::class, 'berita_add'])
            ->name('berita_add');
        Route::put('/berita/{id}/update', [Super\SuperadminController::class, 'berita_update'])
            ->name('berita_update');
        Route::delete('/berita/{id}/delete', [Super\SuperadminController::class, 'berita_delete'])
            ->name('berita_delete');



        //slide video
        Route::get('/video', [Super\SlideController::class, 'index'])
            ->name('video');
        Route::get('/video/create', [Super\SlideController::class, 'create'])
            ->name('video_add');
        Route::post('/video/store', [Super\SlideController::class, 'store'])
            ->name('video_store');
        Route::get('/video/{id}/edit', [Super\SlideController::class, 'edit'])
            ->name('video_edit');
        Route::put('/video/{id}/update', [Super\SlideController::class, 'update'])
            ->name('video_update');
        Route::delete('/video/{id}/delete', [Super\SlideController::class, 'destroy'])
            ->name('video_delete');



        //gallery
        Route::get('/gallery', [Super\FotoController::class, 'index'])
            ->name('galery');
        Route::get('/gallery/create', [Super\FotoController::class, 'create'])
            ->name('galery_create');
        Route::get('/gallery/{id}/edit', [Super\FotoController::class, 'edit'])
            ->name('galery_edit');
        Route::post('/gallery/store', [Super\FotoController::class, 'store'])
            ->name('galery_store');
        Route::put('/gallery/{id}/update', [Super\FotoController::class, 'update'])
            ->name('galery_update');
        Route::delete('/gallery/{id}/delete', [Super\FotoController::class, 'destroy'])
            ->name('galery_destroy');

        //instansi
        Route::get('/instansi', [Super\InstansiController::class, 'index'])
            ->name('instansi');
        Route::put('/instansi/{id}/update', [Super\InstansiController::class, 'update'])
            ->name('instansi_update');
        Route::get('/instansi/create', [Super\InstansiController::class, 'create'])
            ->name('instansi_create');

        Route::post('/instansi/store', [Super\InstansiController::class, 'store'])
            ->name('instansi_store');

        Route::get('/instansi/{id}/edit', [Super\InstansiController::class, 'edit'])
            ->name('instansi_edit');
            Route::get('/instansi/{id}/remove', [Super\InstansiController::class, 'remove'])
            ->name('instansi_media_remove');



        ///users
        Route::get('/users/profile', [Super\UsersController::class, 'index'])
            ->name('users');
        Route::delete('/users/{id}/delete', [Super\UsersController::class, 'hapus_user'])
            ->name('users_hapus');
        Route::get('/users/create', [Super\UsersController::class, 'create'])
            ->name('users_create');
        Route::post('/users/store', [Super\UsersController::class, 'store'])
            ->name('users_store');
        Route::put('/users/{id}/update', [Super\UsersController::class, 'update'])
            ->name('users_update');

        Route::get('/users/status/{id}', [Super\UsersController::class, 'status'])
            ->name('users_status');


        Route::get('/users/password', [Super\UsersController::class, 'password'])
            ->name('users_password');
        Route::put('/users/password/{id}', [Super\UsersController::class, 'password_update'])
            ->name('users_password_update');
        Route::get('/users/{id}/update', [Super\UsersController::class, 'edit'])
            ->name('users_edit');

        //halaman
        Route::get('/halaman', [Super\HalamanController::class, 'index'])
            ->name('halaman');
        Route::post('/halaman/store', [Super\HalamanController::class, 'store'])
            ->name('halaman_store');
        Route::get('/halaman/{id}/edit', [Super\HalamanController::class, 'edit'])
            ->name('halaman_edit');
        Route::put('/halaman/update/{id}', [Super\HalamanController::class, 'update'])
            ->name('halaman_update');
        Route::delete('/halaman/destroy/{id}', [Super\HalamanController::class, 'destroy'])
            ->name('halaman_delete');
        Route::get('/halaman/create', [Super\HalamanController::class, 'create'])
            ->name('halaman_create');

        Route::get('/halaman/cekstatus/{id}', [Super\HalamanController::class, 'status'])
            ->name('halaman_cek');
        //menu static
        Route::post('/halaman/store/static', [Super\HalamanController::class, 'halaman_static'])
            ->name('halaman_static');

        //menu
        Route::get('/menu', [MenuController::class, 'index'])
            ->name('menu');
        Route::get('/menu/create', [MenuController::class, 'create'])
            ->name('menu_create');

        Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])
            ->name('menu_edit');
        Route::put('/menu/update/{id}', [MenuController::class, 'update'])
            ->name('menu_update');
        Route::delete('/menu/destroy/{id}', [MenuController::class, 'delete'])
            ->name('menu_delete');
        Route::post('/menu/store', [MenuController::class, 'store'])
            ->name('menu_store');
        //album
        Route::get('/album/data/{id}', [Super\FotoController::class, 'album_galeri'])
            ->name('album_isi');
        Route::get('/album/create', [Super\FotoController::class, 'album_create'])
            ->name('album_create');
        Route::get('/album/data/edit/{id}', [Super\FotoController::class, 'album_edit'])
            ->name('album_edit');
        Route::put('/album/data/update/{id}', [Super\FotoController::class, 'album_update'])
            ->name('album_update');

        Route::delete('/album/data/delete/{id}', [Super\FotoController::class, 'album_delete'])
            ->name('album_delete');
        //tag
        Route::get('/tag', [Super\TagController::class, 'index'])
            ->name('tag.index');

        Route::post('/tag/store', [Super\TagController::class, 'store'])
            ->name('tag.store');
        Route::delete('/tag/{id}/delete', [Super\TagController::class, 'destroy'])
            ->name('tag.delete');

        Route::patch('/tag/{id}/update', [Super\TagController::class, 'update'])
            ->name('tag.update');

        //media sosial
        Route::get('/mediasosial', [SosialmediaController::class, 'index'])
            ->name('media');
        Route::get('/mediasosial/create', [SosialmediaController::class, 'create'])
            ->name('media_create');
        Route::post('/mediasosial/store', [SosialmediaController::class, 'store'])
            ->name('media_store');
        Route::put('/mediasosial/update/{id}', [SosialmediaController::class, 'update'])
            ->name('media_update');
        Route::delete('/mediasosial/delete/{id}', [SosialmediaController::class, 'delete'])
            ->name('media_delete');
        //slider foto
        Route::get('/slider', [SliderController::class, 'index'])->name('slider_index');
        Route::get('/slider/create', [SliderController::class, 'create'])->name('slider_create');
        Route::post('/slider/store', [SliderController::class, 'store'])->name('slider_store');
        Route::delete('/slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider_delete');
        Route::put('/slider/update/{id}', [SliderController::class, 'update'])->name('slider_update');

        //pengumuman
        Route::get('/pengumuman', [ PengumumanController::class, 'index'])
        ->name('pengumuman');
        Route::get('/pengumuman/create', [ PengumumanController::class, 'create'])
        ->name('pengumuman_create');
        Route::post('/pengumuman', [ PengumumanController::class, 'store'])
        ->name('pengumuman_store');
        Route::put('/pengumuman/update/{id}', [ PengumumanController::class, 'update'])
        ->name('pengumuman_update');
        Route::delete('/pengumuman/{id}', [ PengumumanController::class, 'delete'])
        ->name('pengumuman_delete');

           //donwload
           Route::get('/download', [ DownloadController::class, 'index'])
           ->name('download');
           Route::get('/download/create', [ downloadController::class, 'create'])
           ->name('download_create');
           Route::post('/download', [ downloadController::class, 'store'])
           ->name('download_store');
           Route::put('/download/update/{id}', [ downloadController::class, 'update'])
           ->name('download_update');
           Route::delete('/download/{id}', [ downloadController::class, 'delete'])
           ->name('download_delete');

            //pegawai
        Route::get('/pegawai', [PegawaiController::class, 'index'])
        ->name('pegawai');
        Route::get('/pegawai/create', [PegawaiController::class, 'create'])
        ->name('pegawai_create');
        Route::post('/pegawai/store', [PegawaiController::class, 'store'])
        ->name('pegawai_store');
        Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])
        ->name('pegawai_update');
        Route::delete('/pegawai/destroy/{id}', [PegawaiController::class, 'destroy'])
        ->name('pegawai_destroy');

            //sumber dana
        Route::get('/sumber-dana', [TransaksiController::class, 'index'])
        ->name('sumber_dana');
        Route::get('/sumber-dana/create', [TransaksiController::class, 'create_dana'])
        ->name('sumber_create');
        Route::post('/sumber-dana', [TransaksiController::class, 'store_dana'])
        ->name('sumber_store');
        Route::put('/sumber-dana/update/{id}', [TransaksiController::class, 'update_dana'])
        ->name('sumber_update');
        Route::delete('/sumber-dana/{id}', [TransaksiController::class, 'delete_dana'])
        ->name('sumber_delete');

        //transaksi
        Route::get('/transaksi', [TransaksiController::class, 'transaksi'])
        ->name('transaksi');
        Route::get('/transaksi/create', [TransaksiController::class, 'create_transaksi'])
        ->name('transaksi_create');
        Route::post('/transaksi', [TransaksiController::class, 'store_transaksi'])
        ->name('transaksi_store');
        Route::put('/transaksi/update/{id}', [TransaksiController::class, 'update_transaksi'])
        ->name('transaksi_update');
        Route::delete('/transaksi/{id}', [TransaksiController::class, 'delete_transaksi'])
        ->name('transaksi_delete');
        Route::get('/transaksimasuk/{tahun}', [TransaksiController::class, 'transaksimasuk'])
        ->name('transaksimasuk');

        Route::get('/transaksitahunan/{tahun}', [TransaksiController::class, 'transaksitahunan'])
        ->name('transaksi_tahunan');
        //pelayanan
        Route::get('/pelayanan', [PelayananController::class, 'index'])
        ->name('pelayanan');
        Route::get('/pelayanan/create', [PelayananController::class, 'create'])
        ->name('pelayanan_create');
        Route::get('/pelayanan/edit/{id}', [PelayananController::class, 'edit'])
        ->name('pelayanan_edit');
        Route::post('/pelayanan/store', [PelayananController::class, 'store'])
        ->name('pelayanan_store');
        Route::put('/pelayanan/update/{id}', [PelayananController::class, 'update'])
        ->name('pelayanan_update');
        Route::delete('/pelayanan/delete/{id}', [PelayananController::class, 'destroy'])
        ->name('pelayanan_destroy');
    });



require __DIR__ . '/auth.php';
