<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
        <title>Account - GameStore</title>
    </head>
    <body class="body1">
<?php
include "navbar.html";
include "getIntoDatabase.php";

session_start();

if (isset($_SESSION['username'])) {
    echo "<h1>Welcome, " . $_SESSION['username'] . "!</h1>";
    echo "<a href='logout.php'>Logout</a>";
    $sql = "SELECT * FROM accounts WHERE username='" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);
    echo "<p>Money: " . $result->fetch_assoc()['money'] . "$</p>";
    echo "<h3>Your games:</h3>";
    $sql = "SELECT * FROM games JOIN gamesownership ON games.gameID=gamesownership.gameID WHERE userID='" . $_SESSION['userID'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table-style">
            <tr>
                <th>Game Name</th>
                <th>Description</th>
            </tr>';
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".$row["name"]."</td>
                <td>".$row["description"]."</td>
            </tr>";
        }
    } else {
        echo "<p>You have no games!</p>";
    }
} else {
    header("Location: index.php");
}
$conn->close();
?>
    </body>
</html>