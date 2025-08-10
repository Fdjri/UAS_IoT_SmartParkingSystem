# 🚗 Sistem Parkir Cerdas (UAS IoT)

Selamat datang di repositori proyek Ujian Akhir Semester (UAS) untuk mata kuliah Internet of Things (IoT). Proyek ini adalah implementasi sistem parkir cerdas yang mengintegrasikan perangkat keras (ESP32) dengan dasbor web untuk monitoring secara real-time.

## 🏛️ Arsitektur Proyek

Sistem ini terdiri dari dua komponen utama yang bekerja secara sinergis:

1. **Sistem Parkir (ESP32)**: Perangkat keras yang ditempatkan di pintu masuk parkir untuk mengontrol akses.

2. **Dasbor & API (Laravel)**: Aplikasi web untuk memvisualisasikan data hunian parkir dan menyediakan backend API.

## Hardware: Sistem Parkir (ESP32)

Folder: ``parking system/``

Bagian ini adalah otak dari perangkat fisik di lapangan. Kode di dalam folder ini dirancang untuk mikrokontroler ESP32 dan bertugas mengelola semua komponen perangkat keras.

**1. Fungsi Utama:**

- Membaca kartu akses menggunakan pembaca RFID.

- Mengontrol palang pintu otomatis (menggunakan motor servo).

- Mendeteksi keberadaan kendaraan menggunakan sensor jarak (ultrasonik).

- Mengirimkan data status parkir ke backend API.

**2. Komponen:**

- Mikrokontroler ESP32

- Pembaca RFID RC522

- Motor Servo (untuk palang pintu)

- Sensor Jarak Ultrasonik (HC-SR04)

## 🖥️ Software: Dasbor & API (Laravel)

Folder: ``dashboard parking/``

Ini adalah aplikasi web yang berfungsi sebagai pusat kontrol dan monitoring. Dasbor ini menerima data dari ESP32 dan menampilkannya dalam format yang mudah dibaca.

**1. Fungsi Utama:**

- Menyediakan API untuk menerima data dari perangkat ESP32.

- Menampilkan data hunian parkir secara real-time.

- Memvisualisasikan statistik parkir (misalnya, slot terisi vs. kosong) menggunakan Chart.js.

**2. Teknologi:**

- Backend: Laravel (PHP)

- Frontend: Blade, JavaScript

- Visualisasi Data: Chart.js

## ⚙️ Cara Kerja Sistem
1. Pengguna menempelkan kartu RFID pada pembaca.

2. ESP32 memvalidasi ID kartu melalui API ke server Laravel.

3. Jika valid, ESP32 akan membuka palang pintu dan mengirim data check-in.

4. Sensor jarak mendeteksi jika mobil mengisi slot parkir atau belum.

5. Data hunian parkir diperbarui di server.

6. Dasbor web menampilkan status hunian parkir terbaru menggunakan grafik dari Chart.js.

## 🚀 Panduan Setup
Untuk menjalankan proyek ini, Anda perlu melakukan setup untuk kedua komponen

### 1. Setup Dasbor (Laravel)
#### 1. Masuk ke direktori dasbor:
```
cd dashboard parking
```
#### 2. Instal dependensi Composer:
```
composer install
```
#### 3. Buat file ``.env`` dari ``.env.example`` dan sesuaikan koneksi database Anda.
```
cp .env.example .env
```
#### 4. Generate App Key:
```
php artisan key:generate
```
#### 5. Jalankan Migrasi Database:
```
php artisan migrate
```
#### 6. Instal dependensi NPM:
```
npm install
```
#### 7. Jalankan Server:
```
php artisan serve & npm run dev
```
Dasbor kini bisa diakses di ``http://127.0.0.1:8000.``

### 2. Setup Sistem Parkir (ESP32)
1. Buka kode di dalam folder parking system/ menggunakan Arduino IDE atau PlatformIO (VS Code).
2. Instal Library: Pastikan Anda sudah menginstal semua library yang dibutuhkan untuk komponen (misal: MFRC522, Servo, dll.).
3. Konfigurasi: Buka file kode utama dan sesuaikan:

- Kredensial WiFi: Masukkan SSID dan password jaringan Anda.

- Endpoint API: Arahkan alamat IP ke server tempat aplikasi Laravel Anda berjalan (misal: http://192.168.1.10:8000/api/parking).
4. Upload Kode: Hubungkan ESP32 ke komputer dan unggah programnya.
5. Rakit Komponen: Pastikan semua komponen perangkat keras terhubung ke pin ESP32 yang benar sesuai dengan kode.
