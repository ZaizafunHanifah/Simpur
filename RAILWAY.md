# Panduan Deployment Laravel ke Railway (Metode Docker)

Karena Railway mengalami kesulitan mendeteksi folder monorepo secara otomatis, kita beralih menggunakan **Docker**. Ini adalah cara paling stabil.

## 1. Persiapan di Railway
Pastikan Anda memiliki **dua Service** (Backend & Frontend) yang keduanya terhubung ke repository GitHub yang sama.

---

## 2. Konfigurasi Service

### Backend Service
1.  **Settings > Build > Root Directory**: Isi dengan `backend`.
2.  **Settings > Build > Builder**: Pastikan Railway mendeteksi **Docker** secara otomatis (karena ada file `Dockerfile` di folder backend).
3.  **Settings > Networking > Target Port**: Isi dengan **8080**.
4.  **Variables**: Tambahkan `APP_KEY`, `DATABASE_URL`, dll.

### Frontend Service
1.  **Settings > Build > Root Directory**: Isi dengan `frontend`.
2.  **Settings > Build > Builder**: Pastikan terdeteksi sebagai **Docker**.
3.  **Settings > Networking > Target Port**: Isi dengan **8081**.
4.  **Variables**: Tambahkan `APP_KEY`, `API_URL`, dll.

---

## 3. Environment Variables (PENTING)

### Backend ENV:
- `PORT`: `8080`
- `APP_ENV`: `production`
- `APP_KEY`: (Dari .env lokal)
- `FRONTEND_URL`: `https://frontend-anda.up.railway.app`

### Frontend ENV:
- `PORT`: `8081`
- `APP_KEY`: (Dari .env lokal)
- `API_URL`: `https://backend-anda.up.railway.app/api`

---

## 4. Troubleshooting
Jika build gagal:
1.  Cek **Settings > Build > Custom Build Command**. Kosongkan saja karena Docker sudah menangani semuanya.
2.  Cek **Settings > Deploy > Start Command**. Kosongkan saja karena Docker sudah memiliki perintah start sendiri.
3.  Klik **Redeploy** dengan opsi **Clear Cache**.

---
Metode Docker ini akan menginstal PHP 8.4 dan semua library yang dibutuhkan secara otomatis di dalam "container", sehingga error mismatch versi PHP tidak akan terjadi lagi.
