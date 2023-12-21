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
Route::group(['middleware' => ['auth', 'role:']], function () {
    Route::get('siswa', 'DashboardSiswaController@index');

    // Route Presensi
    Route::get('presensi-siswa', 'PresensiSiswaController@index');

    // Route Mata Pelajaran
    Route::get('jadwal-siswa', 'MapelSiswaController@index');

    // Route Nilai
    Route::get('nilai-siswa', 'NilaiSiswaController@index');

    // Route Tugas
    Route::get('tugas-siswa', 'TugasSiswaController@index');
    Route::get('tambah-tugas-siswa/{id}', 'TugasSiswaController@show')->name('tambah-tugas-siswa');
    Route::get('edit-tugas-siswa/{id}', 'TugasSiswaController@edit')->name('edit-tugas-siswa');
    Route::post('tambah-tugas-siswa/', 'TugasSiswaController@store')->name('submit-tugas');
    Route::post('edit-tugas-siswa/', 'TugasSiswaController@update')->name('edit-tugas');

    Route::get('/index-profilsiswa', 'ProfilController@indexsiswa')->name('profilsiswa');
    Route::post('update-profilesiswa', 'ProfilController@updatesiswa')->name('update-profilesiswa');
});

// WIDHIANI & SERLY : Admin
Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('admin', function () {
        return view('dashboard-admin');
    });

    // Role Akses
    Route::get('/index-roleaksesadm', 'RoleaksesController@indexadm')->name('roleaksesadm');
    Route::get('/update-roleaksesadm/{user}/edit', 'RoleaksesController@editadm')->name('update-roleaksesadm');
    Route::post('/update-roleaksesadm/{user}/edit', 'RoleaksesController@updateadm')->name('update-roleaksesadm');
    Route::post('/delete-roleaksesadm/{id}', 'RoleaksesController@deleteadm')->name('delete-roleaksesadm');

    // Route Profil
    Route::get('/index-profiladmin', 'ProfilController@indexadm')->name('profiladmin');
    Route::post('update-profileadmin', 'ProfilController@updateadm')->name('update-profileadmin');

    // Route Siswa
    Route::get('/index-siswaadm', 'SiswaController@indexadm')->name('siswaadm');
    Route::get('/tambah-siswaadm', 'SiswaController@showadm')->name('tambah-siswaadm');
    Route::post('/tambah-siswaadm', 'SiswaController@storeadm')->middleware('auth');
    Route::get('/update-siswaadm/{siswa}/edit', 'SiswaController@editadm')->name('update-siswaadm');
    Route::post('/update-siswaadm/{siswa}/edit', 'SiswaController@updateadm')->name('update-siswaadm');
    Route::post('/delete-siswaadm/{id}', 'SiswaController@deleteadm')->name('delete-siswaadm');

    // Route Guru
    Route::get('/index-guruadm', 'GuruController@indexadm')->name('guruadm');
    Route::get('/tambah-guruadm', 'GuruController@showadm')->name('tambah-guruadm');
    Route::post('/tambah-guruadm', 'GuruController@storeadm')->middleware('auth');
    Route::get('/update-guruadm/{guru}/edit', 'GuruController@editadm')->name('update-guruadm');
    Route::post('/update-guruadm/{guru}/edit', 'GuruController@updateadm')->name('update-guruadm');
    Route::post('/delete-guruadm/{id}', 'GuruController@deleteadm')->name('delete-guruadm');

    // Route Orang Tua
    Route::get('/index-ortuadm', 'OrtuController@indexadm')->name('ortuadm');
    Route::get('/tambah-ortuadm', 'OrtuController@showadm')->name('tambah-ortuadm');
    Route::post('/tambah-ortuadm', 'OrtuController@storeadm')->middleware('auth');
    Route::get('/update-ortuadm/{ortu}/edit', 'OrtuController@editadm')->name('update-ortuadm');
    Route::post('/update-ortuadm/{ortu}/edit', 'OrtuController@updateadm')->name('update-ortuadm');
    Route::post('/delete-ortuadm/{id}', 'OrtuController@deleteadm')->name('delete-ortuadm');

    // Route Mata Pelajaran
    Route::get('/index-mapeladm', 'MapelController@indexadm')->name('mapeladm');
    Route::get('/tambah-mapeladm', 'MapelController@showadm')->name('tambah-mapeladm');
    Route::post('/tambah-mapeladm', 'MapelController@storeadm')->middleware('auth');
    Route::get('/update-mapeladm/{mapel}/edit', 'MapelController@editadm')->name('update-mapeladm');
    Route::post('/update-mapeladm/{mapel}/edit', 'MapelController@updateadm')->name('update-mapeladm');
    Route::post('/delete-mapeladm/{id}', 'MapelController@deleteadm')->name('delete-mapeladm');


    // Route Kelas
    Route::get('/index-kelasadm', 'KelasController@indexadm')->name('kelasadm');
    Route::get('tambah-kelasadm', 'KelasController@showadm')->name('tambah-kelasadm');
    Route::post('tambah-kelasadm', 'KelasController@storeadm')->middleware('auth');
    Route::get('/update-kelasadm/{kelas}/edit', 'KelasController@editadm')->name('update-kelasadm');
    Route::post('/update-kelasadm/{kelas}/edit', 'KelasController@updateadm')->name('update-kelasadm');
    Route::post('/delete-kelasadm/{id}', 'KelasController@deleteadm')->name('delete-kelasadm');

    // Route Jadwal Mengajar
    Route::get('/index-jadwaladm', 'JadwalController@indexadm')->name('jadwaladm');

    // Route Presensi
    Route::get('/index-presensiadm', 'PresensiController@indexadm')->name('presensiadm');
    Route::get('tambah-presensiadm', 'PresensiController@showadm')->name('tambah-presensiadm');
    Route::post('tambah-presensiadm', 'PresensiController@storeadm')->middleware('auth');
    Route::get('/update-presensiadm/{presensi}/edit', 'PresensiController@editadm')->name('update-presensiadm');
    Route::post('/update-presensiadm/{presensi}/edit', 'PresensiController@updateadm')->name('update-presensiadm');
    Route::post('/delete-presensiadm/{id}', 'PresensiController@deleteadm')->name('delete-presensiadm');

    // Route Nilai
    Route::get('/index-nilaiadm', 'NilaiController@indexadm')->name('nilaiadm');
    Route::get('tambah-nilaiadm', 'NilaiController@showadm')->name('tambah-nilaiadm');
    Route::post('tambah-nilaiadm', 'NilaiController@storeadm')->middleware('auth');
    Route::get('/update-nilaiadm/{nilai}/edit', 'NilaiController@editadm')->name('update-nilaiadm');
    Route::post('/update-nilaiadm/{nilai}/edit', 'NilaiController@updateadm')->name('update-nilaiadm');
    Route::post('/delete-nilaiadm/{id}', 'NilaiController@deleteadm')->name('delete-nilaiadm');

    // Route Tugas
    Route::get('/index-tugasadm', 'TugasController@indexadm')->name('tugasadm');
    Route::get('tambah-tugasadm', 'TugasController@showadm')->name('tambah-tugasadm');
    Route::post('tambah-tugasadm', 'TugasController@storeadm')->name('tambah-tugasadm');
    Route::get('/update-tugasadm/{tugas}/edit', 'TugasController@editadm')->name('update-tugasadm');
    Route::post('/update-tugasadm/{tugas}/edit', 'TugasController@updateadm')->name('update-tugasadm');
    Route::post('/delete-tugasadm/{id}', 'TugasController@deleteadm')->name('delete-tugasadm');

    // Route Pengumpulan Tugas
    Route::get('/index-pengumpulanadm', 'PengumpulanController@indexadm')->name('pengumpulanadm');
    Route::get('tambah-pengumpulanadm', 'PengumpulanController@showadm')->name('tambah-pengumpulanadm');
    Route::post('tambah-pengumpulanadm', 'PengumpulanController@storeadm')->name('tambah-pengumpulanadm');
    Route::get('/update-pengumpulanadm/{pengumpulan}/edit', 'PengumpulanController@editadm')->name('update-pengumpulanadm');
    Route::post('/update-pengumpulanadm/{pengumpulan}/edit', 'PengumpulanController@updateadm')->name('update-pengumpulanadm');
    Route::post('/delete-pengumpulanadm/{id}', 'PengumpulanController@deleteadm')->name('delete-pengumpulanadm');
});


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
Route::group(['middleware' => ['auth', 'role:3']], function () {
    Route::get('orangtua', 'DashboardOrangTuaController@index');

    Route::get('/index-profilortu', 'ProfilController@indexortu')->name('profilortu');
    Route::post('update-profilortu', 'ProfilController@updateortu')->name('update-profileortu');

    // Route Presensi
    Route::get('view-presensi', 'PresensiOrangTuaController@index');

    // Route Jadwal
    Route::get('view-jadwal', 'MapelOrangTuaController@index');

    // Route Transkrip
    Route::get('view-transkrip', 'NilaiOrangTuaController@index');
});
