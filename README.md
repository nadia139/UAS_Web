<img width="1899" height="884" alt="Screenshot 2026-01-12 220523" src="https://github.com/user-attachments/assets/586e2521-aa88-486c-b139-5102c138577f" />


Antarmuka login yang bersih dan modern
Validasi form dengan username dan password
Kredensial akun demo tersedia
Tautan "Daftar di sini" untuk pengguna baru
Desain responsif dengan spacing yang tepat


<img width="1919" height="864" alt="Screenshot 2026-01-12 220544" src="https://github.com/user-attachments/assets/1a4da330-643c-4d00-a422-8b58be37c52a" />


Dashboard Overview: Menampilkan metrik utama dalam kartu
Statistik Cepat:
Total Produk: 15 item
Total Stok: 708 unit
Nilai Inventori: Rp 55.540.000
Kategori: 2 (Skincare & Makeup)
Navigasi Sidebar: Dashboard, Kelola Produk, Tambah Produk
Panel Aksi Cepat: Tambah Produk, Lihat Semua Produk, Laporan, Kelola User
Tampilan Tanggal & Waktu: Tanggal dan waktu saat ini




<img width="1919" height="856" alt="Screenshot 2026-01-12 220616" src="https://github.com/user-attachments/assets/3f6d0d42-f414-405d-bb32-e5e0481c9c9d" />


Antarmuka Manajemen Produk: Daftar produk lengkap
Sistem Pencarian & Filter:
Kolom pencarian dengan placeholder "Cari produk..."
Filter kategori (Semua, Skincare, Makeup)
Tombol Filter dan Reset
Tabel Produk dengan kolom:
Nama Produk & Deskripsi
Badge kategori
Harga (diformat dalam Rupiah)
Stok dengan indikator status
Preview gambar produk
Tombol aksi (Edit/Hapus)
Dukungan Pagination: Menampilkan total 15 produk




<img width="1919" height="879" alt="Screenshot 2026-01-12 220645" src="https://github.com/user-attachments/assets/8547c088-4c1c-4f35-8ce5-c19a3afb91ae" />



Kartu Produk Individual menampilkan:
Thumbnail gambar produk
Nama produk dan deskripsi detail
Kategori dengan badge berwarna
Harga dalam format mata uang yang tepat
Kuantitas stok dengan satuan "pcs"
Organisasi Berbasis Kategori: Produk dikelompokkan berdasarkan Skincare/Makeup
Kolom Aksi: Ikon Edit dan Hapus untuk setiap produk




<img width="1919" height="874" alt="Screenshot 2026-01-12 220659" src="https://github.com/user-attachments/assets/35058cef-f1cc-4eba-a079-c2f038267505" />



Form Pembuatan Produk dengan validasi
Field Wajib (ditandai dengan asterisk):
Nama Produk
Pilihan kategori
Harga dalam Rupiah
Bagian Upload Gambar:
Upload file dengan batasan format (JPG, PNG, GIF)
Ukuran file maksimal: 2MB
Preview langsung gambar yang dipilih
Layout Form: Desain dua kolom dengan info produk dan upload gambar


# TEKNOLOGI YANG DIGUNAKAN
Backend
PHP 7.4+ dengan arsitektur OOP
Database MySQL dengan koneksi PDO
Implementasi Pattern MVC
Manajemen Session untuk autentikasi pengguna

# Frontend
Bootstrap 5 untuk desain responsif
CSS3 dengan styling kustom
Font Awesome untuk ikon
JavaScript untuk validasi form dan interaktivitas


# STRUKTUR PROYEK
PROJECT_UAS/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
├── config/
│   └── database.php
├── controllers/
│   ├── AdminController.php
│   ├── AuthController.php
│   ├── ProductController.php
│   └── UserController.php
├── images/          # Gambar produk
│   ├── sunscreen.png
│   ├── serum.png
│   └── ... (15+ gambar)
├── models/
│   ├── Database.php
│   ├── Product.php
│   └── User.php
├── views/
│   ├── admin/
│   │   ├── dashboard.php
│   │   ├── product_add.php
│   │   ├── product_edit.php
│   │   ├── product_list.php
│   │   └── sidebar.php
│   ├── auth/
│   │   ├── login.php
│   │   └── register.php
│   ├── layouts/
│   │   ├── footer.php
│   │   └── header.php
│   └── user/
│       ├── home.php
│       └── products.php
├── .htaccess
├── autoload.php
└── index.php


# SISTEM AUTENTIKASI
Peran Pengguna
1. Admin (role = 'admin')
Akses penuh ke semua fitur
Operasi CRUD produk
Melihat statistik dashboard
Mengelola inventaris
2. Pengguna/Pelanggan (role = 'user')
Menjelajahi produk
Melihat detail produk
Menambah ke keranjang (fitur masa depan)
Melakukan pemesanan (fitur masa depan)
# Kredensial Login Default
Admin: admin / password
User: user1 / password
