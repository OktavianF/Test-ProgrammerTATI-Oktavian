# Question 02 — Indonesian Provinces REST API

REST API untuk CRUD operasi data provinsi Indonesia menggunakan Laravel.

## Requirements

- PHP >= 8.2
- Composer
- MySQL / SQLite (default: SQLite)

## Project Setup

### 1. Install Dependencies

```bash
cd question-02
composer install
```

### 2. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration

**SQLite (Default):**
```bash
touch database/database.sqlite
```

**MySQL:**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=provinsi_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Run Migrations

```bash
php artisan migrate
```

### 5. Seed Database (Fetch from wilayah.id API)

```bash
php artisan db:seed --class=ProvinceSeeder
```

### 6. Run Development Server

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

---

## API Endpoints

Base URL: `http://localhost:8000/api`

| Method | Endpoint | Description | Response Code |
|--------|----------|-------------|---------------|
| GET | `/api/provinsi` | List all provinces | 200 |
| GET | `/api/provinsi/{id}` | Show province detail | 200 / 404 |
| POST | `/api/provinsi` | Create new province | 201 / 422 |
| PUT | `/api/provinsi/{id}` | Update province | 200 / 404 / 422 |
| DELETE | `/api/provinsi/{id}` | Delete province | 200 / 404 |

---

## API Usage Examples

### 1. Get All Provinces

```bash
curl -X GET http://localhost:8000/api/provinsi
```

**Response:**
```json
{
  "success": true,
  "message": "List of provinces",
  "data": [
    {
      "id": 1,
      "code": "11",
      "name": "ACEH",
      "created_at": "2025-12-27T00:00:00.000000Z",
      "updated_at": "2025-12-27T00:00:00.000000Z"
    }
  ]
}
```

### 2. Get Province by ID

```bash
curl -X GET http://localhost:8000/api/provinsi/1
```

**Response (200):**
```json
{
  "success": true,
  "message": "Province detail",
  "data": {
    "id": 1,
    "code": "11",
    "name": "ACEH"
  }
}
```

**Response (404):**
```json
{
  "success": false,
  "message": "Province not found"
}
```

### 3. Create New Province

```bash
curl -X POST http://localhost:8000/api/provinsi \
  -H "Content-Type: application/json" \
  -d '{"code": "99", "name": "TEST PROVINCE"}'
```

**Response (201):**
```json
{
  "success": true,
  "message": "Province created successfully",
  "data": {
    "id": 35,
    "code": "99",
    "name": "TEST PROVINCE"
  }
}
```

**Response (422 - Validation Error):**
```json
{
  "success": false,
  "message": "Validation error",
  "errors": {
    "code": ["The code has already been taken."]
  }
}
```

### 4. Update Province

```bash
curl -X PUT http://localhost:8000/api/provinsi/1 \
  -H "Content-Type: application/json" \
  -d '{"name": "ACEH UPDATED"}'
```

**Response (200):**
```json
{
  "success": true,
  "message": "Province updated successfully",
  "data": {
    "id": 1,
    "code": "11",
    "name": "ACEH UPDATED"
  }
}
```

### 5. Delete Province

```bash
curl -X DELETE http://localhost:8000/api/provinsi/1
```

**Response (200):**
```json
{
  "success": true,
  "message": "Province deleted successfully"
}
```

---

## Project Structure

```
question-02/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProvinceController.php   # CRUD Controller
│   ├── Models/
│   │   └── Province.php                 # Eloquent Model
│   └── Services/
│       └── WilayahService.php           # External API Service
├── database/
│   ├── migrations/
│   │   └── *_create_provinces_table.php # Database Schema
│   └── seeders/
│       └── ProvinceSeeder.php           # Data Seeder
├── routes/
│   └── api.php                          # API Routes
└── README.md
```

---

## Data Source

Data provinsi di-fetch dari:
- **URL:** https://wilayah.id/api/provinces.json
- **Format:** JSON dengan struktur `{ "data": [...] }`

---

## HTTP Response Codes

| Code | Description |
|------|-------------|
| 200 | OK - Request berhasil |
| 201 | Created - Resource berhasil dibuat |
| 404 | Not Found - Resource tidak ditemukan |
| 422 | Unprocessable Entity - Validation error |
