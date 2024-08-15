<?php 

/* Create a connection to the database */
$connection = new mysqli('localhost', 'root', '', 'camera-server');

/* hash the password */
// check for post request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

if(isset($_POST['register'])){
    
    //check that username and password were set and are not empty
    if(!empty(trim($_POST['password'])) && !empty(trim($_POST['username']))){
        
        //create variables to hold username and password
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        //hash the password 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //insert the username and hashed password into table
        $stmt = $connection->prepare("INSERT INTO USERS (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();

        //check if insert was successful or not
        if($connection->affected_rows > 0){
            $messages =  "registered successfully!";
        }else{
            $messages = "failed to register!";
        }

        $stmt->close();
    }
    else{
        $messages = "Username and password must not be blank!";
    }

    }
}

/* check if the username and password are in the database */
