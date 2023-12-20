<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Auth::routes();
Route::get('/logout', 'HomeController@logout');

// BARIZA : Siswa


// WIDHIANI & SERLY : Admin


// RICI : Guru
Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('guru', 'DashboardGuruController@index');

    // Route Siswa
    Route::get('/index-siswa', 'SiswaController@index')->name('siswa');
    Route::get('/tambah-siswa', 'SiswaController@show')->name('tambah-siswa');
    Route::post('/tambah-siswa', 'SiswaController@store')->middleware('auth');
    Route::get('/update-siswa/{siswa}/edit', 'SiswaController@edit')->name('update-siswa');
    Route::post('/update-siswa/{siswa}/edit', 'SiswaController@update')->name('update-siswa');
    Route::post('/delete-siswa/{id}', 'SiswaController@delete')->name('delete-siswa');

    // Route Mata Pelajaran
    Route::get('/jadwal-mengajar', 'MapelController@index')->name('jadwal');

    // Route Presensi
    Route::get('/index-presensi', 'PresensiController@index')->name('presensi');
    Route::get('tambah-presensi', 'PresensiController@show')->name('tambah-presensi');
    Route::post('tambah-presensi', 'PresensiController@store')->middleware('auth');
    Route::get('/update-presensi/{presensi}/edit', 'PresensiController@edit')->name('update-presensi');
    Route::post('/update-presensi/{presensi}/edit', 'PresensiController@update')->name('update-presensi');
    Route::post('/delete-presensi/{id}', 'PresensiController@delete')->name('index');

    // Route Tugas
    Route::get('/index-tugas', 'TugasController@index')->name('tugas');
    Route::get('tambah-tugas', 'TugasController@show')->name('tambah-tugas');
    Route::post('tambah-tugas', 'TugasController@store')->name('tambah-tugas');
    Route::get('/update-tugas/{tugas}/edit', 'TugasController@edit')->name('update-tugas');
    Route::post('/update-tugas/{tugas}/edit', 'TugasController@update')->name('update-tugas');
    Route::post('/delete-tugas/{id}', 'TugasController@delete')->name('delete');


    // Route Pengumpulan
    Route::get('index-pengumpulan', 'PengumpulanController@index')->name('pengumpulan');
    Route::get('tambah-pengumpulan', 'PengumpulanController@show')->name('tambah-pengumpulan');
    Route::post('tambah-pengumpulan', 'PengumpulanController@store')->name('tambah-pengumpulan');
    Route::get('update-pengumpulan/{pengumpulan}/edit', 'PengumpulanController@edit')->name('update-pengumpulan');
    Route::post('/update-pengumpulan/{pengumpulan}/edit', 'PengumpulanController@update')->name('update-pengumpulan');

    // Route Nilai
    Route::get('/index-nilai', 'NilaiController@index')->name('nilai');
    Route::get('tambah-nilai', 'NilaiController@show')->name('tambah-nilai');
    Route::post('tambah-nilai', 'NilaiController@store')->name('tambah-nilai');
    Route::get('/update-nilai/{nilai}/edit', 'NilaiController@edit')->name('update-nilai');
    Route::post('/delete-nilai/{id}', 'NilaiController@delete')->name('delete-nilai');

    // Route Profil
    Route::get('/index-profil', 'ProfilController@index')->name('profil');
    Route::post('update-profile', 'ProfilController@update')->name('update-profile');
});

// FAHRI : Orangtua
