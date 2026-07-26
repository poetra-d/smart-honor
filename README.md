# Smart Honor

Smart Honor adalah aplikasi berbasis Laravel yang digunakan untuk mengelola proses pembayaran honor dosen berdasarkan pertemuan perkuliahan.

Aplikasi ini memudahkan bagian akademik dalam mengelola jadwal dan pertemuan, dosen dalam mengisi pertemuan, serta bagian keuangan dalam menghasilkan dan mengelola pembayaran honor secara otomatis.

---

## Features

### Authentication

- Login
- Role Based Access Control (Spatie Permission)

### Admin Akademik

- Employee Management
- Employment Status Management
- Lecturer Management
- Course Management
- Class Management
- Academic Year Management
- Semester Management
- Course Offering Management
- Schedule Management
- Generate Meeting

### Lecturer

- My Meeting
- Complete Meeting
- View My Honor
- Honor Detail

### Finance

- Honor Rate Management
- Generate Honor Payment
- Honor Payment Detail
- Pay Honor
- Cancel Payment
- Export Summary Excel
- Export Detail Excel

---

## User Roles

| Role | Description |
|------|-------------|
| Admin Akademik | Mengelola data akademik |
| Dosen | Mengisi pertemuan dan melihat honor |
| Keuangan | Mengelola pembayaran honor |

---

## Tech Stack

- Laravel 13
- PHP 8.3+
- PostgreSQL
- Bootstrap 5
- Laravel Blade
- Spatie Laravel Permission
- Laravel Excel (Maatwebsite)
- Carbon

---

## Installation

Clone repository

```bash
git clone https://github.com/poetra-d/smart-honor.git
```

Masuk ke folder project

```bash
cd smart-honor
```

Install dependency

```bash
composer install
```

Copy environment

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Atur konfigurasi database pada file `.env`

Kemudian jalankan migration

```bash
php artisan migrate
```

Jalankan seeder

```bash
php artisan db:seed
```

Jalankan aplikasi

```bash
php artisan serve
```

---

## Project Structure

```
app
├── Http
├── Models
├── Exports
├── Imports
└── Providers

resources
├── views
├── css
└── js

routes
└── web.php
```

---

## Main Workflow

### Academic

1. Input Employee
2. Input Lecturer
3. Input Course
4. Input Course Offering
5. Create Schedule
6. Generate Meeting

### Lecturer

1. Login
2. Open My Meeting
3. Complete Meeting
4. View Honor

### Finance

1. Input Honor Rate
2. Generate Honor Payment
3. Review Detail
4. Mark as Paid
5. Export Excel

---

## Database

Main tables

- employees
- lecturers
- employment_statuses
- courses
- class_rooms
- academic_years
- semesters
- course_offerings
- schedules
- meetings
- honor_rates
- honor_payments
- honor_payment_details

---

## Honor Calculation

Honor dihitung menggunakan rumus berikut:

```
Honor = SKS × Rate per SKS
```

Contoh:

```
SKS = 3

Rate = Rp100.000

Honor = Rp300.000
```

Setiap meeting menghasilkan satu detail honor.

---

## Export

Tersedia dua jenis export:

- Honor Payment Summary
- Honor Payment Detail

Format file:

```
.xlsx
```

---

## Screenshots

<!-- ```
docs/
    login.png
    dashboard-admin.png
    dashboard-finance.png
    dashboard-lecturer.png
    meeting.png
    honor-payment.png
``` -->

---

## Future Improvements

- PDF Export
- Dashboard Charts
- Email Notification
- Attendance Integration
- Payroll Integration

---

## Author

**Dewangga Pramana Putra**

Universitas Siber Asia

---

## License

This project is intended for educational purposes.
