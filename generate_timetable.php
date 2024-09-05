<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start session to get logged-in user


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to access this page.");
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

/* Create a connection to the database */
$connection = new mysqli('localhost', 'root', '', 'timetable');
$messages = "";

//create a function for adding course to CLASSES table
function addCourse($connection, $user_id){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //set variables to form field inputs
        if(!empty(trim($_POST["course_code"])) && !empty(trim($_POST["course_name"])) 
            && !empty(trim($_POST["day_of_week"])) && !empty(trim($_POST["start_time"])) 
                && !empty(trim($_POST["end_time"]))){

            $course_code = $_POST['course_code'];
            $course_name = $_POST['course_name'];
            $day_of_week = $_POST['day_of_week'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
        } else {
            $messages = "Please fill out all fields before attempting to add course.";
        }

        //create a statement to enter class information into CLASSES table
        $stmt = $connection->prepare("INSERT INTO CLASSES (course_code, course_name, day_of_week, start_time, end_time, user_id) VALUES (?, ?, ?, ?, ?, ?)");

        // Check if the statement was prepared correctly
        if ($stmt === false) {
            die("Prepare failed: " . $connection->error);
        }

        $stmt->bind_param("sssssi", $course_code, $course_name, $day_of_week, $start_time, $end_time, $user_id);



        if ($stmt->execute()) {
            $messages = "Successfully added " . $course_code;
            //redirect back to tableInput.pohp to add another class
            header("Location: tableInput.php");
            exit();
        } else {
            $messsages = "Error creating class.";
            header("Location: tableInput.php");
        }

        $stmt->close();
    }
}

//craete function that will be called when generate table button is clicked
function generateTable($connection, $user_id){

    //create a prepared sql statement to retrieve all clases associated with logged in user and order by start time
    $stmt = $connection->prepare("SELECT course_code, course_name, day_of_week, start_time, end_time FROM CLASSES WHERE user_id = ? ORDER BY start_time ASC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $rs = $stmt->get_result();

    //print out page header and table headers 
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";
    echo "<div class ='table-container'>";
    echo "<h2>Your Timetable</h2>";
    echo "<table border='1'>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Day of Week</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>";

    //while there are results/rows, print them out into table rows
    while ($row = $rs->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['course_code'] . "</td>
            <td>" . $row['course_name'] . "</td>
            <td>" . $row['day_of_week'] . "</td>
            <td>" . $row['start_time'] . "</td>
            <td>" . $row['end_time'] . "</td>
            </tr>";
        }
        
            $stmt->close();
        

            echo "</table>";
            echo "</div>";
}

// check for post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if register button is pressed
    if(isset($_POST['addCourse'])){   
        addCourse($connection, $user_id);
    }
    // if login button is pressed
    elseif(isset($_POST['generate'])){
        generateTable($connection, $user_id);
    }
}

