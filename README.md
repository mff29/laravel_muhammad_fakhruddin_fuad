<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About
### Ini adalah hasil test programmer di Terakorp Indonesia
Requirement :
Laravel, jquery, Bootstrap

Buatkan halaman login, login menggunakan username, bukan email:
- Halaman setelah login adalah CRUD. Data Rumah Sakit, struktur tabelnya-nya : ID, Nama Rumah Sakit, Alamat, Email, Telepon
- CRUD berikutnya Data Pasien, struktur tabelnya : ID, Nama Pasien, Alamat, No Telpon, ID Rumah Sakit
- Relasi tabel Data Pasien dengan tabel Rumah Sakit.
- Untuk tombol hapus/delete menggunakan ajax.
- Pada Crud Data Pasien, buatkan Dropdown filter berdasarkan Rumah Sakit, menggunakan ajax.

Sertakan juga script migration dan seed-nya 

## langkah cek
- pastikan requirement sesuai
- clone repo
- jalankan: composer install
- jalankan: php artisan migrate --seed

## Login dummy
username: admin
password: admin123
atau
username: user
password: user123
