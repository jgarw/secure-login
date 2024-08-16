# PHP User Authentication Project

This project is a casual exercise to practice PHP and working with hashed passwords. The main goal is to create a basic user authentication system that includes user registration and login functionality.

## Features

- **User Registration**: Users can register with a username and password. The password is securely hashed using PHP's `password_hash()` function before being stored in the database.
- **User Login**: Users can log in with their credentials. The system verifies the password by comparing the entered password with the stored hashed password using `password_verify()`.
- **Secure Redirection**: Upon successful login or registration, users are redirected to appropriate pages.

## Requirements

- PHP 7.0 or higher
- MySQL or MariaDB
- A web server (Apache, Nginx, or XAMPP)
