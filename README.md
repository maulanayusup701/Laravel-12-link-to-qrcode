# 📷 Laravel QR Code Generator with Logo & Database

Proyek ini adalah sistem Laravel 12 untuk membuat QR Code dari input URL, dengan opsi menyisipkan logo ke tengah QR. Semua QR dan logo yang dihasilkan disimpan ke storage Laravel, dan metadatanya disimpan ke database. QR Code akan ditampilkan setelah dibuat, dengan tampilan antarmuka modern menggunakan Tailwind CSS dan FilePond.

---

## 🚀 Fitur Utama

-   ✅ Input URL dengan validasi Laravel (`required|url`)
-   ✅ Upload logo (opsional), maksimal 2MB, format: jpeg/png/jpg/svg/gif
-   ✅ Generate QR Code dari URL (menggunakan `endroid/qr-code`)
-   ✅ Tempel logo di tengah QR (menggunakan `intervention/image`)
-   ✅ Simpan QR dan logo ke Laravel Storage
-   ✅ Simpan metadata ke database
-   ✅ Preview hasil QR setelah submit
-   ✅ UI interaktif (Tailwind CSS, FilePond, SweetAlert2)

---

## 🧱 Teknologi yang Digunakan

| Komponen               | Keterangan                               |
| ---------------------- | ---------------------------------------- |
| Laravel 12             | Framework utama                          |
| Endroid QR Code v5     | Membuat QR Code dari string/link         |
| Intervention Image v3  | Memanipulasi dan menempelkan gambar logo |
| Tailwind CSS           | Desain antarmuka responsif               |
| FilePond               | Upload logo dengan preview               |
| SweetAlert2            | Notifikasi validasi dan sukses/gagal     |
| Laravel Storage        | Menyimpan file QR/Logo ke `storage/app`  |
| MySQL / SQLite / PgSQL | Database untuk simpan metadata QR        |

---

## 📁 Struktur Direktori File

```
storage/app/public/
├── logos/     ← Hasil upload logo
└── qrcodes/   ← Hasil generate QR
```

---

## 🗃️ Struktur Tabel Database: `qrcodes`

```php
Schema::create('qrcodes', function (Blueprint $table) {
    $table->id();
    $table->string('link');
    $table->string('logo_path')->nullable();
    $table->string('qr_path');
    $table->timestamps();
});
```

Contoh data:

| ID  | Link                  | Logo            | QR Path         | Dibuat     |
| --- | --------------------- | --------------- | --------------- | ---------- |
| 1   | https://example.com   | logos/logo1.png | qrcodes/qr1.png | 2025-07-09 |
| 2   | https://tokowarung.id | null            | qrcodes/qr2.png | 2025-07-09 |

---

## ⚙️ Alur Sistem

```
1. User isi form (link + logo opsional)
2. Validasi Laravel dijalankan
3. QR Code dibuat dari URL
4. Logo ditambahkan ke QR (jika ada)
5. QR & logo disimpan ke storage
6. Metadata disimpan ke database
7. Hasil QR ditampilkan di view
```

---

# ▶️ Cara Menjalankan Project

## 1. 🔁 Clone Repository

```bash
git clone https://github.com/maulanayusup701/laravel-qr-code-generator.git
cd laravel-qr-code-generator
```

## 2. 📦 Install Dependensi

```bash
composer install
npm install
```

## 3. ⚙️ Setup Environment

Salin `.env` dan generate key:

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` untuk atur koneksi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qr_generator
DB_USERNAME=root
DB_PASSWORD=
```

## 4. 🗃️ Jalankan Migrasi

```bash
php artisan migrate
```

## 5. 🔗 Buat Symbolic Link ke Storage

```bash
php artisan storage:link
```

## 6. 🖼️ Build Frontend (jika pakai FilePond via npm)

```bash
npm run build
# atau untuk development:
npm run dev
```

> Jika kamu menggunakan CDN untuk Tailwind dan FilePond, langkah ini bisa dilewati.

## 7. 🚀 Jalankan Laravel

```bash
php artisan serve
```

Akses aplikasimu di browser:

```
http://localhost:8000/link
```

---

## 📌 Rencana Fitur Tambahan

-   [ ] Fix bug logo not display

---

## 👤 Kontributor

**Maulana Yusup**  
IT Support @ Nuparis  
📧 [Email](mailto:maulana.yusup8989@gmail.com.com) | 💼 [LinkedIn](https://linkedin.com) | 💻 [GitHub](https://github.com/maulanayusup701)

---

## 📄 Lisensi

MIT License © 2025
