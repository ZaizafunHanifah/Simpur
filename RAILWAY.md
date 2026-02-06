# Panduan Deployment Laravel ke Railway (Simpur System)

Dokumen ini berisi langkah-langkah teknis untuk mendeploy proyek monorepo (backend & frontend) ke Railway.

## 1. Persiapan Teknis (Checklist)
- [ ] Akun GitHub (untuk push repository).
- [ ] Akun Railway yang terhubung ke GitHub.
- [ ] Laravel 12 (Versi saat ini sudah compatible).
- [ ] File `.env` lokal sudah siap sebagai referensi.

---

## 2. Command Konfigurasi
Railway menggunakan **Nixpacks** secara default. Berikut adalah konfigurasi yang tepat:

### Backend Service
- **Root Directory**: `backend`
- **Build Command**: `composer install --optimize-autoloader --no-dev && php artisan config:cache && php artisan route:cache && php artisan view:cache`
- **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

### Frontend Service
- **Root Directory**: `frontend`
- **Build Command**: `composer install --optimize-autoloader --no-dev && php artisan config:cache && php artisan route:cache && php artisan view:cache && npm install && npm run build`
- **Start Command**: `php artisan serve --host=0.0.0.0 --port=$PORT`

---

## 3. Environment Variables (ENV)
Anda perlu mengisi variabel berikut di tab **Variables** pada setiap service di Railway.

### Backend ENV:
- `NIXPACKS_PHP_VERSION`: `8.4` (PENTING: Laravel 12 & Symfony 8 membutuhkan PHP 8.4)
- `APP_ENV`: `production`
- `APP_DEBUG`: `false`

- `APP_KEY`: *(Generate via Railway: `php artisan key:generate --show` atau masukkan manual)*
- `APP_URL`: `https://backend-yourname.up.railway.app`
- `DB_CONNECTION`: `mysql` (atau postgres)
- `DATABASE_URL`: *(Otomatis terisi jika menghubungkan database Railway)*
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, `DB_HOST`: *(Gunakan referensi dari service database Railway)*

### Frontend ENV:
- `NIXPACKS_PHP_VERSION`: `8.4`
- `APP_URL`: `https://frontend-yourname.up.railway.app`
- `API_URL`: `https://backend-yourname.up.railway.app/api` (Arahkan ke URL Backend)


---

## 4. Setup Database
1. Di Railway Dashboard, klik **+ New** -> **MySQL** (atau PostgreSQL).
2. Setelah database dibuat, klik pada service Backend Anda.
3. Masuk ke tab **Variables**, klik **+ New Variable**, pilih **Reference** dan arahkan ke variabel database (contoh: `MYSQL_URL`).
4. Laravel akan menggunakan variabel tersebut melalui `DATABASE_URL`.

---

## 5. Handle Migration & Storage
### Migrations
Agar migrasi berjalan otomatis saat deploy, tambahkan ini di **Start Command** Backend:
`php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT`

### APP_KEY
Railway tidak menyimpan state. Pastikan `APP_KEY` sudah diatur di tab **Variables** agar session dan enkripsi tidak error.

### Storage
Railway menggunakan **Ephemeral File System** (file akan hilang saat restart/redeploy).
- **Solusi**: Gunakan Cloudinary atau AWS S3 untuk menyimpan foto/dokumen.
- Untuk folder `public/storage`, pastikan menjalankan `php artisan storage:link` di build/start command.

---

## 6. Konfigurasi CORS (PENTING)
Karena frontend dan backend beda domain, edit file `backend/config/cors.php`:

```php
'allowed_origins' => [
    'https://frontend-anda.up.railway.app', // Ganti dengan URL frontend Railway
    'http://localhost:3000', // Untuk development
],
```

---

## 7. Best Practice Agar Tidak Error
1. **Optimasi Laravel**: Pastikan menjalankan `config:cache`, `route:cache`, dan `view:cache` di build step.
2. **Logging**: Gunakan `LOG_CHANNEL=errorlog` agar log Laravel muncul di Log Railway.
3. **Session & Cache**: Gunakan `database` atau `redis` service Railway untuk Session dan Cache (Jangan gunakan `file`).
4. **HTTPS**: Railway otomatis menyediakan SSL (HTTPS), pastikan `FORCE_HTTPS=true` di ENV jika diperlukan.
