# ⚽ Football Field Booking Management System (Web Admin)

## 📌 Introduction

This project is a **Web Admin System** developed using **PHP & MySQL** for managing a football field booking system.
It allows administrators to manage fields, customers, bookings, and monitor system operations efficiently.

---

## 🚀 Features

* 🏟️ Manage football fields (add, update, delete)
* 👤 Manage customers
* 📅 Booking management (create, update, cancel)
* 💰 Price & schedule management
* 📊 View booking statistics
* 🔐 Admin authentication (login/logout)

---

## 🛠️ Technologies Used

* **Backend:** PHP (Core PHP)
* **Database:** MySQL
* **Frontend:** HTML, CSS, JavaScript
* **Server:** Apache (XAMPP)


---

## ⚙️ Installation Guide

### 1. Clone repository

```bash
git clone https://github.com/ngohoaithanh/QuanLyDatSanBong.git
```

### 2. Move project to XAMPP

Copy project folder to:

```
xampp/htdocs/
```

### 3. Setup Database

* Open **phpMyAdmin**
* Create a database (e.g. `football_booking`)
* Import the `.sql` file (if provided)

### 4. Configure Database

Edit file:

```
config/database.php
```

Example:

```php
$conn = new mysqli("localhost", "root", "", "football_booking");
```

### 5. Run project


## 🔑 Demo Account (if available)

```
Username: admin@gmail.com
Password: 12345
```

---



---

## 📌 Notes

* This project is part of a student assignment / internship preparation.
* The system can be extended with mobile app integration (Android).

---

## 🌟 Future Improvements

* RESTful API development
* Role-based access control
* Online payment integration
* Real-time booking updates

---
