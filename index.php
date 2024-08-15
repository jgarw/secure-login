<?php 
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the script
require 'script.php'; 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <!-- create a container to hold all items neatly in the center -->
        <div class = "container">
            <form action = "" method = "post">
                <!-- header for login page -->
                <h1>Login</h1>

                <!-- create a table to hold form fields -->
                <table>
                    <!-- table row for username field -->
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" id="username"></td>
                    </tr>

                    <!-- table row for password field -->
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                </table>

                <!-- php for error messages -->
                <?php 
                     
                     if(!empty($messages)): ?>

                         <p class="errors"><?php echo $messages; ?></p>
                     
                 <?php endif; ?>
                    
                <!-- create a container to hold buttons -->
                <div class = "button-container">
                    <td><input type="submit" value="Login" name="login"></td>
                    <td><input type="submit" value="Register" name="register"></td>
                </div><!-- end of button container -->
            </form>
        </div> <!-- end of form container -->
    </body>
</html>