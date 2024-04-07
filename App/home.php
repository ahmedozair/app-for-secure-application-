<!--   here is my nav bar --> 
<nav>
<!--   my pages --> 
        <ul class="links">
            <li><a href="xssPage.html">xss</a></li><br> </br>
            <li><a href="login.php">Login</a></li><br> </br>
            <li><a href="index.html">sign up</a></li><br> </br>
            <li><a href="home.php">home</a></li><br> </br>


        <label for="" class="bar">
            <span class="fas fa-times" id="times"></span>
        </label>
    </nav>

<?php
// db 
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "app"; // my db name 

// connecting
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("not connected: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // here i used escape which it prevents from sql injection 
    $userName = mysqli_real_escape_string($conn, $_POST["name"]);
    $userAge = mysqli_real_escape_string($conn, $_POST["age"]);

    // input the name and age 
    $sql = "INSERT INTO user (name, age) VALUES ('$userName', '$userAge')";
    if ($conn->query($sql) === TRUE) {
        echo "Here are all new user";
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
}

// sql selecting from user 
$sql = "SELECT name, age FROM user";
$result = $conn->query($sql);

// Checking the user entered and rows name and age 
if ($result->num_rows > 0) {
    
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["name"] . " - Age: " . $row["age"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No users found";
}

// Closing connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>TODO List</title>
		<!-- link to style sheet   -->

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to TODO List</h1>
    <form method="POST" action="home.php">
	<!-- enter the name and age  -->

        <input type="text" id="name" name="name" placeholder="Enter Name"><br></br>
        <input type="number" id="age" name="age" placeholder="Enter Age"><br></br>
        <button type="submit">Add User</button>
    </form>
</body>
</html>
