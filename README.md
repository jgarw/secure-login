# PHP User Authentication and Timetable Management Project

This project is a casual exercise to practice my PHP skills, particularly in user authentication and secure password handling. The objective is to create a user authentication system that allows users to register, log in, and manage their course information. Additionally, the project includes functionality for generating a personalized timetable based on the information provided by the user.

## Features

- **User Registration**: Users can register with an email and password. The password is securely hashed using PHP's `password_hash()` function before being stored in the database.
- **User Login**: Users can log in with their registered credentials. The system verifies the password by comparing the entered password with the stored hashed password using `password_verify()`.
- **Secure Redirection**: Upon successful login or registration, users are redirected to appropriate pages securely.
- **Course Management**: Users can add information about their courses and use the system to organize and store this data.
- **Timetable Generation**: Based on the input course data, users can generate a personalized timetable.

## Requirements

- PHP 7.0 or higher
- MySQL or MariaDB
- A web server (Apache, Nginx, or XAMPP)
