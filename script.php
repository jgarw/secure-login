<?php 

session_start();

/* Create a connection to the database */
$connection = new mysqli('localhost', 'root', '', 'timetable');
$messages = "";


    /* create a method that registers a user with a hashed password */
    function registerUser($connection){
        
        //check that username and password were set and are not empty
        if(!empty(trim($_POST['password'])) && !empty(trim($_POST['email']))){
            
            //create variables to hold username and password
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            //hash the password 
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //insert the username and hashed password into table
            $stmt = $connection->prepare("INSERT INTO USERS (email, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $hashed_password);
            $stmt->execute();

            //check if insert was successful or not
            if($connection->affected_rows > 0){
                $messages =  "registered successfully!";
                header("Location: index.php");
            }else{
                $messages = "failed to register!";
            }

            $stmt->close();
        }

        else{
            $messages = "email and password must not be blank!";
        }

    }

    /* create a function to login as an existing user */
    function loginUser($connection){
        
        // check that username and password are not empty
        if(!empty(trim($_POST["email"])) && !empty(trim($_POST["password"]))){

            // store username and password entered into variables
            $email = trim($_POST["email"]);   
            $password = trim($_POST["password"]);

            // create a SELECT statement based on entered username and password
            $stmt = $connection->prepare("SELECT id,password FROM USERS WHERE email = ?");
            $stmt->bind_param("s", $email); 
            $stmt->execute();

            // store the results from the select statement into a variable
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                // get the ropw from the result
                $row = $result->fetch_assoc();
                //retrieve the hashed password from the matching user in the database
                $stored_password = $row['password'];
                $user_id = $row['id']; // Get the user's id from the database

                // check that the entered password and unhashed password are equal
                if(password_verify($password, $stored_password)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['email'] = $email;
                    header("Location: tableInput.php");
                }else{
                    $messages = "Invalid email or password! Please try again.";
                }
            }

        }
    }


/* check if the username and password are in the database */


// check for post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if register button is pressed
    if(isset($_POST['register'])){   
        registerUser($connection);
    }
    // if login button is pressed
    elseif(isset($_POST['login'])){
        loginUser($connection);
    }
}