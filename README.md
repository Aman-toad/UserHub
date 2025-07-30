# 🚀 UserHub – PHP User Management System

![PHP](https://img.shields.io/badge/PHP-8.x-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![License](https://img.shields.io/badge/license-MIT-green)
![Status](https://img.shields.io/badge/status-Active-brightgreen)

UserHub is a secure and feature-rich **User Management System** built with **PHP + MySQL + Bootstrap**. It includes authentication, role-based dashboards, CRUD functionality, file uploads, and optional modules like PDF generation and CSV export. Ideal for admin panels, event portals, or user directories.

---

## 📁 Folder Structure

```
userhub/
├── config/
│ └── config.php    # DB connection
│
├── includes/
│ ├── header.php    # Bootstrap header
│ ├── footer.php    # Footer HTML
│ └── auth.php      # Session auth guard
│
├── auth/
│ ├── register.php  # User registration
│ ├── login.php     # Login page
│ ├── logout.php    # Logout logic
│
├── dashboard/
│ ├── index.php     # Main dashboard
│ ├── profile.php   # Profile view/edit
│ ├── users.php     # Admin user list + CRUD
│
├── actions/
│ ├── insert_user.php   # Register new user
│ ├── update_user.php   # Update profile/user
│ ├── delete_user.php   # Delete user
│ ├── export_csv.php    # Export users to CSV
│ ├── generate_pdf.php  # Generate PDF
│ └── send_email.php    # Optional: Send email
│
├── uploads/
│ └── profile_pics/     # Uploaded user images
│
├── assets/
│ ├── css/
│ │ └── style.css       # Custom styles
│ ├── js/
│ │ └── script.js       # Custom JS (if needed)
│ └── img/
│ └── logo.png          # Project logo
│
├── index.php           # Landing page or redirect
└── README.md           
```


---

## ⚙️ Tech Stack

- **PHP 8.x**
- **MySQL**
- **Bootstrap 5**
- **PHPMailer** (for email)
- **TCPDF / DomPDF** (for PDF generation)
- **JavaScript** (for form UX, optional)
- **XAMPP** for local server

---

## ✨ Features

- 🔐 Login & Registration with `password_hash()`
- 🧑 User Dashboard
- 👮 Role-Based Access (Admin/User)
- 🧾 CRUD: Add, Edit, Delete Users
- 🖼 File Upload: Profile Pictures
- 📄 Export Data as CSV
- 📤 PDF Generation for Reports/Users
- 📧 Email Sending on Register *(optional)*
- 🔍 Search + Sort + Pagination *(in users table)*

---

## 🛠 Setup Instructions

1. Clone or download this repo into `htdocs/` folder
2. Import `userhub.sql` DB (I'll add when ready)
3. Update `config/config.php` with your DB credentials
4. Start Apache & MySQL via XAMPP
5. Visit: `http://localhost/userhub/`

---

## 📌 To-Do (in progress)
- [x] Register + Login with session
- [ ] Role-based dashboard
- [ ] CRUD for admin
- [ ] File upload handling
- [ ] CSV/PDF/Email features
- [ ] Polish UI with Bootstrap 5

---

## 💬 Contribute / Feedback

If you like this or have ideas, feel free to fork or suggest features 😄
