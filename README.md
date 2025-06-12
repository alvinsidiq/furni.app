# ✅ Langkah Menjalankan Project Laravel

## 1. Persyaratan Sistem
Pastikan kamu sudah meng-install:
- PHP ≥ 8.2 (lihat composer.json)
- Composer
- MySQL / MariaDB / PostgreSQL (tergantung config .env)
- Node.js + npm (jika pakai frontend seperti Vite atau Laravel Mix)
- Laravel CLI (opsional, tapi membantu)

## 2. Clone / Ekstrak Proyek

```bash
git clone https://github.com/username/project-name.git
cd project-name
```
## 3.cd nama-folder-proyek


## 4. Install Dependency
```
composer install
```
```
npm install
```
## 5. Buat File .env
```
cp .env.example .env
```

Kemudian ubah pengaturan database di .env:

```
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD= (atau sesuai setting lokal)
```

## 6. Generate APP_KEY
```
php artisan key:generate
```

## 7. Migrasi & Seed Database
```
php artisan migrate
php artisan db:seed
```

## 8. jalankan project 
```
composer run dev
```


