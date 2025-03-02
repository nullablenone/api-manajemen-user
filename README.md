# API Manajemen User

API Manajemen User adalah RESTful API sederhana untuk mengelola data pengguna. API ini mendukung operasi CRUD (Create, Read, Update, Delete) untuk membantu proses pengelolaan user.

---

## Fitur
- **Create User**: Tambahkan pengguna baru.
- **Read User**: Lihat data pengguna (semua atau spesifik).
- **Update User**: Perbarui informasi pengguna.
- **Delete User**: Hapus pengguna yang tidak diperlukan.

---

## Teknologi yang Digunakan
- **Framework**: Laravel 11
- **Database**: MySQL (bisa disesuaikan dengan database lain)
- **Bahasa Pemrograman**: PHP

---

## Instalasi dan Setup

### Prasyarat
1. **PHP** >= 8.2
2. **Composer**
3. **MySQL** atau database lain yang kompatibel
4. **Postman** atau tool lain untuk pengujian API

### Langkah-Langkah
1. Clone repository ini:
   ```bash
   git clone https://github.com/nullablenone/api-manajemen-user.git
   cd api-manajemen-user
   ```

2. Install dependensi:
   ```bash
   composer install
   ```

3. Salin file `.env.example` menjadi `.env` dan konfigurasi database:
   ```bash
   cp .env.example .env
   ```
   Lalu atur konfigurasi database di file `.env`.

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Migrasi database:
   ```bash
   php artisan migrate
   ```

6. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
   API akan tersedia di `http://localhost:8000`.

---

## Dokumentasi Endpoint

### 1. **Buat Pengguna Baru**
**Endpoint**: `POST /api/users`

**Request Body**:
```json
{
  "name": "muhamad yesa",
  "email": "mhmdyesa@example.com"
}
```

**Response** (201 Created):
```json
{
  "success": true,
  "message": "Pengguna berhasil dibuat",
  "data": {
    "id": 1,
    "name": "muhamad yesa",
    "email": "mhmdyesa@example.com",
    "created_at": "2025-03-02T10:00:00.000000Z",
    "updated_at": "2025-03-02T10:00:00.000000Z"
  }
}
```

---

### 2. **Lihat Semua Pengguna**
**Endpoint**: `GET /api/users`

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Data pengguna berhasil diambil",
  "data": [
    {
      "id": 1,
      "name": "muhamad yesa",
      "email": "mhmdyesa@example.com"
      "created_at": "2025-03-02T10:00:00.000000Z",
      "updated_at": "2025-03-02T10:00:00.000000Z"
    }
  ]
}
```

---

### 3. **Lihat Pengguna Spesifik**
**Endpoint**: `GET /api/users/{id}`

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Pengguna ditemukan",
  "data": {
    "id": 1,
    "name": "muhamad yesa",
    "email": "mhmdyesa@example.com"
    "created_at": "2025-03-02T10:00:00.000000Z",
    "updated_at": "2025-03-02T10:00:00.000000Z"
  }
}
```

**Response** (404 Not Found):
```json
{
  "success": false,
  "message": "Pengguna tidak ditemukan"
}
```

---

### 4. **Perbarui Pengguna**
**Endpoint**: `PUT /api/users/{id}`

**Request Body**:
```json
{
  "name": "nullablenone",
  "email": "nullablenone@example.com"
}
```

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Pengguna berhasil diperbarui",
  "data": {
    "id": 1,
    "name": "nullablenone",
    "email": "nullablenone@example.com"
    "created_at": "2025-03-02T10:00:00.000000Z",
    "updated_at": "2025-03-03T20:00:00.000000Z"
  }
}
```

---

### 5. **Hapus Pengguna**
**Endpoint**: `DELETE /api/users/{id}`

**Response** (200 OK):
```json
{
  "success": true,
  "message": "Pengguna berhasil dihapus"
}
```

**Response** (404 Not Found):
```json
{
  "success": false,
  "message": "Pengguna tidak ditemukan"
}
```

---


## Pengujian
Gunakan Postman atau tool sejenis untuk menguji semua endpoint. Pastikan setiap request memiliki header berikut:
```
Content-Type: application/json
Accept: application/json
```

---
