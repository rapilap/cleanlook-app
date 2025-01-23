# Petunjuk Penggunaan
Tambah branch untuk setiap fitur.

### Clone projek
 Gunakan git bash
```bash
git clone https://github.com/rapilap/cleanlook-app.git
```
Jika menggunakan laragon, simpan folder ke dalam laragon/www.

### Mengambil perubahan projek
```bash
git pull
```
Disclaimer: Wajib lakukan pull sebelum mulai.

### Push perubahan yang dibuat
Cek status perubahan
```bash
git status
```
Tambahkan file yang terdapat perubahan
```bash
git add .
```
Cek status kembali, jika sudah berwarna hijau maka sudah sukses ditambahkan.
Berikan komentar tentang perubahan
```bash
git commit -m 'masukkan pesan di sini'
```
Push perubahan ke github
```bash
git push origin nama_branch
```
Misal branch feat/riwayat
```bash
git push origin feat/riwayat
```
Disclaimer: Sebelum mulai, pastikan git bash berada di branch yang seharusnya. Hindari berada di branch main.
Pindah branch
```bash
git checkout nama_branch
```

# Penggunaan Laravel

### Buat .env ambil dari .env.example, sesuaikan dengan databasenya

### Instalasi composer
``` bash
composer install
```

### Instalasi tailwind
```bash
npm install
```

### Migrasi database
```bash
php artisan migrate
```
### Seed database
```bash
php artisan db:seed
```

### Aktifkan server dan tailwind
Server
```bash
php artisan serve
```
Tailwind
```bash
npm run dev
```

### Klik link dari server yang sudah diaktifkan

# Selamat Mengoding😁
