# 🧺 Cleansy Laundry - POS & Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)

**Cleansy Laundry** adalah platform Point of Sales (POS) dan Sistem Manajemen Operasional terintegrasi yang dirancang khusus untuk memodernisasi, mengoptimalkan, dan mengamankan alur kerja bisnis laundry retail. Proyek ini dibangun dengan fokus pada arsitektur yang aman untuk meminimalkan *human error* kasir, mencegah kecurangan keuangan (*fraud*), serta menyajikan dasbor analitik real-time bagi manajemen.

---

> [!IMPORTANT]
> **⚠️ DISCLAIMER: STATUS PROTOTYPE (PURWARUPA)**
> Proyek ini saat ini berstatus sebagai **Prototype** yang sedang dikembangkan secara aktif untuk keperluan pengujian konsep, tugas akademik, dan demonstrasi fungsional. Seluruh komponen antarmuka (UI), struktur tabel *database*, relasi model, serta aturan logika bisnis di dalamnya dapat berubah, diperbarui, atau dirombak sewaktu-waktu seiring berjalannya proses pengembangan.

---

## 🚀 Fitur Utama & Keunggulan Ekosistem

Aplikasi ini memisahkan hak akses secara ketat menjadi 2 aktor utama (**Owner/Admin** dan **Staf Kasir**) dengan pembagian fungsi sebagai berikut:

### 1. 🛒 Modul POS Kasir & Alur Antrean Visual
* **Cashier Session (Shift Kerja) & Security Lock:** Kasir wajib memulai sesi dengan membuka shift. Fitur *logout* akan **terkunci otomatis** selama shift aktif untuk memastikan akuntabilitas laci kasir dan mencegah staf meninggalkan pos tanpa merekonsiliasi kas (tutup buku).
* **Input Pesanan Kilat (Fast-Tap):** Input data pesanan pelanggan (Nama, No WhatsApp, Tipe Pelanggan) dikombinasikan dengan pencatatan berat pakaian dan variasi sub-layanan (*Reguler* vs *Express*).
* **Limit Kapasitas Cerdas:** Sistem akan menolak pesanan *Express* jika sudah mencapai batas maksimal kuota harian yang ditetapkan oleh Owner.
* **Antrean Visual Aktif:** Tabel monitoring visual yang menyaring seluruh cucian aktif di *workshop*. Sistem memisahkan status pencucian secara real-time (Cuci -> Setrika -> Selesai -> Sudah Diambil).
* **Cetak Struk Thermal:** Layout struk belanja yang dioptimalkan menggunakan CSS `@media print` sehingga siap dicetak ke printer struk thermal (*Thermal Receipt Printer*).

### 2. 💳 Manajemen Pembayaran & Kalkulasi Cerdas
* **Dual Payment Method:** Mendukung metode pembayaran instan **Cash (Tunai)** dan **QR Code (QRIS)**.
* **Smart Deficit Tolerance (Toleransi Receh):** Logika sistem bawaan yang mengizinkan transaksi tunai tetap disubmit jika pelanggan kekurangan uang dalam batas toleransi wajar (misal: kurang Rp1.000). Selisih ini akan ditanggung dan dicatat otomatis pada sistem.
* **Perhitungan Kembalian Otomatis:** Antarmuka kasir secara dinamis menghitung uang kembalian pelanggan berdasarkan total berat dan harga per kilogram.

### 3. 📊 Manajerial & Dashboard Analitik (Owner Panel)
* **Visual Dashboard (Chart.js):** Grafik tren produktivitas staf (total pendapatan per kasir) yang bisa di-toggle (*switch*) secara dinamis antara data **Harian** dan **Mingguan** tanpa perlu *reload* halaman.
* **Log Audit & Rekonsiliasi Kasir:** Laporan riwayat selisih kas fisik (yang diinput kasir saat tutup shift) vs kas sistem. Dilengkapi fitur *sorting* rentang waktu dan filter status temuan (*Matched* / *Unmatched*).
* **Ekspor Laporan (CSV):** Fitur *download* laporan audit keuangan dalam format `.csv` dengan sekali klik, siap diolah di Microsoft Excel.
* **Pusat Notifikasi & Alarm Lembur:** Sistem otomatis mendeteksi jika ada staf kasir yang masih membuka shift melewati batas jam operasional reguler (Potensi lembur tanpa izin).

### 4. ⚙️ Konfigurasi Aturan Toko Dinamis
Owner dapat mengendalikan parameter bisnis secara mandiri melalui *Settings Panel*:
* Mengubah batas kuota maksimal layanan **Express**.
* Mengubah **Jam Masuk** dan **Jam Keluar** operasional toko.
* Menetapkan batas maksimal nominal **Toleransi Selisih Kasir**.
* Mengatur batas waktu pakaian berstatus **Cucian Telantar**.

---

## 🛠️ Tech Stack yang Digunakan

* **Backend Framework:** [Laravel 10 / 11](https://laravel.com/) (PHP)
* **Frontend Design:** Vanilla HTML dengan [Tailwind CSS via CDN](https://tailwindcss.com/) (Desain UI/UX modern bertema Dark Mode dengan aksen *Teal-Neon*).
* **Database:** MySQL RDBMS
* **Data Visualization:** [Chart.js via CDN](https://www.chartjs.org/)

---

## ⚙️ Panduan Setup Project di Localhost

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek **Cleansy Laundry** di localhost Anda.

### 📋 Prasyarat (Prerequisites)
Pastikan komputer Anda sudah terinstal tools berikut:
* **PHP >= 8.1** (disarankan menggunakan bundle [Laragon](https://laragon.org/) atau [XAMPP](https://www.apachefriends.org/))
* **Composer** (untuk dependensi PHP)
* **MySQL Database Server**
* **Koneksi Internet** (Sangat penting karena Tailwind CSS dan Chart.js di-load melalui CDN).

---

### 💻 Langkah Instalasi

#### 1. Clone / Copy Source Code
Buka terminal dan *clone repository* ini:
```bash
git clone [https://github.com/USERNAME_ANDA/cleansy-laundry.git](https://github.com/USERNAME_ANDA/cleansy-laundry.git)
cd cleansy-laundry
