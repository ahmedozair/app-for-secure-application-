<?php
// my email and password ready to input and post 
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

// verifying the pass and email
if (!empty($email) && !empty($password)) {
	// connection to database 
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "app"; // my database name
    
	//connection back to database
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // i create table in my database called login which contains email and password 
    $sql = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
    // creating user
    if ($conn->query($sql) === TRUE) {
        echo "you have created a user";
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
} else {
    // if they user input empty field 
    $emptyFields = [];
 // verifying empty fields 
    if (empty($email)) {
        $emptyFields[] = "mail";
    }
    if (empty($password)) {
        $emptyFields[] = "pass";
    }
    echo "empty fields: " . implode(', ', $emptyFields);
}
?>
