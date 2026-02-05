# Deployment notes (Vercel)

Masalah: Vercel build runtime tidak menyediakan PHP, sehingga skrip `build.sh` yang menjalankan Composer akan gagal (`php: command not found`).

Anda punya dua solusi utama:

1) Commit `backend/vendor/` ke repo (paling sederhana)

- Jalankan lokal: `composer install --no-dev --optimize-autoloader` di folder `backend/`.
- Commit folder `backend/vendor/` dan `composer.lock` ke repo.
- Vercel akan melakukan build tanpa membutuhkan PHP.

Kelebihan: cepat dan mudah. Kekurangan: vendor/ jadi bagian dari repo (ukuran bertambah).

2) Jalankan Composer di CI (rekomendasi untuk workflow lebih bersih)

- Buat workflow GitHub Actions untuk menjalankan Composer (memerlukan PHP) sebelum deploy ke Vercel.
- Contoh `/.github/workflows/deploy.yml` (ringkas):

```yaml
name: Build & Deploy
on:
  push:
    branches: [ main ]

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'

      - name: Install Composer dependencies
        working-directory: backend
        run: composer install --no-dev --optimize-autoloader

      - name: Upload built backend
        uses: actions/upload-artifact@v3
        with:
          name: backend-artifact
          path: backend/

  deploy:
    runs-on: ubuntu-latest
    needs: build
    steps:
      - uses: actions/checkout@v4
      - name: Download artifact
        uses: actions/download-artifact@v3
        with:
          name: backend-artifact

      - name: Deploy to Vercel
        uses: amondnet/vercel-action@v20
        with:
          vercel-token: ${{ secrets.VERCEL_TOKEN }}
          vercel-org-id: ${{ secrets.VERCEL_ORG_ID }}
          vercel-project-id: ${{ secrets.VERCEL_PROJECT_ID }}
          working-directory: ./
        env:
          VERCEL_TOKEN: ${{ secrets.VERCEL_TOKEN }}
```

- Anda perlu menambahkan secrets di GitHub repository settings: `VERCEL_TOKEN`, `VERCEL_ORG_ID`, dan `VERCEL_PROJECT_ID`.

Catatan tambahan:
- Saya sudah memperbarui `build.sh` agar memberikan pesan jelas bila PHP tidak tersedia dan untuk melewati pemasangan bila `vendor/` sudah ada.
- Jika butuh bantuan menyiapkan GitHub Action atau ingin saya menambahkan file workflow ke repo, beri tahu saya dan saya bisa menambahkannya.
