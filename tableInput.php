<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Timetable Creator</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div class="container">
            <h1>Enter Timetable Information!</h1>

                <!-- Create a form for user to enter class information -->
                <form action="generate_timetable.php" method="post">

                <!-- Create table to hold all form input fields -->
                <table>

                <!-- create table row to hold course code input -->
                <tr>
                    <td>
                        <label for="course_code">Course Code:</label>
                        <input type="text" id="course_code" name="course_code" required>
                    </td>
                </tr>

                <!-- create table row to hold course code input -->
                <tr>
                    <td>
                        <label for="course_name">Course Name:</label>
                        <input type="text" id="course_name" name="course_name" required>
                    </td>
                </tr>

                <!-- create table row to hold course code input -->
                <tr>
                    <td>
                        <label for="day_of_week">Day of Week:</label>
                        <select id="day_of_week" name="day_of_week" required>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </td>
                </tr>

                <!-- create table row to hold course code input -->
                <tr>
                    <td>
                        <label for="start_time">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" required>
                    </td>
                </tr>

                <!-- create table row to hold course code input -->
                <tr>
                    <td>
                        <label for="end_time">End Time:</label>
                        <input type="time" id="end_time" name="end_time" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"> <!-- Hidden field for user ID -->
                        <input type="submit" value="Generate Timetable">
                    </td>
                </tr>
                </table>
            </form>

        </div>
    </body>
</html>