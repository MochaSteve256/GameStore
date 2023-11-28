<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
        <title>Database Test - GameStore</title>
    </head>
    <?php include "navbar.html"; ?>
    <body class="body1">
        <h1>Database Test</h1>
        <p>Table with database contents</p>
    </body>
</html>

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "gamestore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM accounts ORDER BY birthday";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row in a table
    echo '<table class="table-style">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Birthday</th>
            <th>Money</th>
            <th>Password</th>
        </tr>';
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["userID"]."</td>
            <td>".$row["username"]."</td>
            <td>".$row["email"]."</td>
            <td>".$row["birthday"]."</td>
            <td>".$row["money"]."</td>
            <td>".$row["password"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();