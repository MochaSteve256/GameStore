<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
        <title>Purchase - GameStore</title>
    </head>
    <body class="body1">
<?php
include "navbar.html";
include "getIntoDatabase.php";

session_start();

if (isset($_SESSION['username'])) {
    if (isset($_GET['gameID'])) {
        $sql = "SELECT * FROM accounts";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $money = $row['money'];
        $sql = "SELECT price FROM games WHERE gameID='" . $_GET['gameID'] . "'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $price = $row['price'];
        $money = $money - $price;
        if ($money >= 0) {
            $sql = "SELECT * FROM gamesownership WHERE userID='" . $_SESSION['userID'] . "' AND gameID='" . $_GET['gameID'] . "'";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                $sql = "UPDATE accounts SET money='" . $money . "' WHERE username='" . $_SESSION['username'] . "'";
            $result = $conn->query($sql);
            } else {
                echo "<h1>You already own this game!</h1>";
            }
            $sql = "UPDATE accounts SET money='" . $money . "' WHERE username='" . $_SESSION['username'] . "'";
            $result = $conn->query($sql);
            $sql = "SELECT * FROM games WHERE gameID='" . $_GET['gameID'] . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            echo "<h1>You purchased " . $row['name'] . "!</h1>";
        } else {
            echo "<h1>You don't have enough money!</h1>";
        }
        $sql = "INSERT INTO gamesownership (userID, gameID) VALUES ('" . $_SESSION['userID'] . "', '" . $_GET['gameID'] . "')";
        $result = $conn->query($sql);
    } else {
        echo "<h1>Please select a game!</h1>";
    }
} else {
    echo "<h1>You are not logged in!</h1>";
}
$conn->close();
?>
    </body>
</html>