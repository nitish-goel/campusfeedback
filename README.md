🎓 CampusFeedback – Dynamic Feedback Management System

A dynamic feedback management system built using Core PHP, MySQL, JWT Authentication, and Bootstrap 5.

CampusFeedback allows administrators to create and manage feedback forms, while students can submit responses to the currently active form.

🚀 Features
👨‍💼 Admin Panel

Secure JWT-based authentication (HttpOnly cookie)

Create multiple feedback forms

Only one form can be active at a time

Add dynamic fields:

Text

Textarea

Radio (with options)

Checkbox (with options)

Edit / Delete fields

Manage all forms

Activate / Deactivate forms

View submissions (if implemented)

Clean responsive admin layout

🎓 Student Side

Automatically loads the active form

Dynamic form rendering

Supports radio & checkbox options

Stores submissions in database

Anonymous response system

🛠 Tech Stack

Backend: Core PHP (OOP)

Database: MySQL

Authentication: Firebase JWT

Frontend: Bootstrap 5

Architecture: API-based structure

Security: Middleware protected routes

📂 Project Structure
/config
    Database.php

/api
    login.php
    create_form.php
    add_field.php
    get_forms.php
    get_fields.php
    update_field.php
    delete_field.php
    set_active_form.php
    submit.php

/helper
    AuthMiddleware.php
    JWTService.php

/views
    /admin
        /layout
            header.php
            sidebar.php
            footer.php
        dashboard.php
        manage_forms.php
        manage_fields.php
        login.php
    /site
        form.php

/assets
    /css
        style.css

/vendor
composer.json
🔐 Authentication Flow

Admin logs in

JWT token is generated

Token stored in HttpOnly cookie

All protected APIs use AuthMiddleware

Unauthorized users redirected to login page

🗄 Database Schema
forms
Column	Type
id	INT (PK)
title	VARCHAR
description	TEXT
is_active	TINYINT(1)
created_at	TIMESTAMP
fields
Column	Type
id	INT (PK)
form_id	INT
label	VARCHAR
type	VARCHAR
options	TEXT
submissions
Column	Type
id	INT
form_id	INT
submitted_at	TIMESTAMP
submission_answers
Column	Type
id	INT
submission_id	INT
field_id	INT
answer	TEXT
⚙ Installation Guide
1️⃣ Clone Repository
git clone https://github.com/yourusername/CampusFeedback.git
2️⃣ Install Dependencies
composer install
3️⃣ Configure Database

Create a MySQL database

Update /config/Database.php with your credentials

4️⃣ Import Database Tables

Run SQL scripts to create required tables.

5️⃣ Start Project

Place project inside:

htdocs/ (XAMPP)

Open in browser:

http://localhost/CampusFeedback/views/admin/login.php
🎯 How It Works

Admin creates forms.

Admin adds dynamic fields.

Admin sets one form as active.

Student opens form page.

System loads active form automatically.

Student submits response.

Data stored in submissions tables.

🔒 Security Features

JWT authentication

Middleware route protection

HttpOnly cookie storage

Input validation

Prepared statements (PDO)

📸 Screenshots

(Add screenshots here)

Example:

/screenshots/dashboard.png
/screenshots/manage-forms.png
/screenshots/student-form.png
🧠 Future Improvements

Form scheduling (start & end date)

Analytics dashboard

CSV export

Drag & drop field ordering

Role-based access control

Email notification system

👨‍💻 Author

Nitish Goel
Backend Developer (PHP, CodeIgniter, Laravel)

📄 License

This project is developed for educational and learning purposes.
