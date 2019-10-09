# Presensi QR Code API

Presensi QR Code adalah sebuah projek aplikasi presensi siswa dari IT Club SMA Negeri 6 Depok. Repository ini merupakan bagian backend.

## Requirement

- PHP >=7.3
- MySQL >=5.7 / MariaDB >=10.1

## Requirement for development

Untuk mengembangkan aplikasi ini, minimal dikomputer kalian harus terinstall:

- PHP 7.3
- MySQL 5.7 / MariaDB 10.1
- Apache 2.4
- Git
- Composer
- PostMan

Untuk PHP, MySQL/MariaDB, dan Apache bisa mendownload XAMPP karena XAMPP sudah mencakup 3 item tersebut. Kemudian untuk **Git** bisa mendownload [Github for Desktop](https://desktop.github.com) atau [Git CLI](https://git-scm.com/downloads) (**recommended**) dan untuk Composer bisa mendownload di [https://getcomposer.org/](https://getcomposer.org/).

## Instalasi

- Clone repository ini dengan cara mengetikkan perintah pada Terminal (Linux) atau Git Bash (Windows) `git clone https://github.com/cybersixclub/presensi-api`

- Kemudian ubah working directory ke folder antipsen-api dengan mengetikkan perintah `cd presensi-api`

- Setelah itu jalankan perintah `composer install` untuk mendownload dan menginstall dependencies yang dibutuhkan (koneksi internet dibutuhkan).

## Menjalankan API

Setelah semua dependencies terinstall dan sukses kalian bisa mengetikkan perintah `php artisan serve` untuk menjalankan local server pada komputer kalian dan kemudian buka `localhost:8000` pada browser kalian.

Jika terdapat tulisan _**Lumen (6.1.0) (Laravel Components ^6.0)**_ maka API sudah siap dan sukses terinstall.

## Configuration

Setelah sukses terinstall, ketikan perintah `copy .env.example .env` di CMD. Kemudian buka file .env dan setting sesuai konfigurasi server

- `APP_KEY` kunci private untuk enkripsi
- `DB_DATABASE` nama database yang digunakan
- `DB_USERNAME` username untuk terhubung ke database
- `DB_PASSWORD` password untuk masuk ke database
- `JWT_KEY` kunci private untuk token otentikasi

**JANGAN MENGHAPUS FILE .env.example**


## Fitur

- [ ] Presensi otomatis menggunakan QR Code
- [ ] Laporan harian presensi siswa
- [ ] Laporan bulanan presensi siswa
- [ ] Laporan per semester presensi siswa
- [ ] Pengajuan izin untuk absen/tidak hadir secara online
- [ ] Konfigurasi akses untuk user