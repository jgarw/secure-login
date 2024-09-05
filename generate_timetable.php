<?php
session_start(); // Start session to get logged-in user

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to access this page.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

/* Create a connection to the database */
$connection = new mysqli('localhost', 'root', '', 'timetable');
$messages = "";

//set variables to form field inputs
$course_code = $_POST['course_code'];
$course_name = $_POST['course_name'];
$day_of_week = $_POST['day_of_week'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

