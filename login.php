<?php
include "navbar.html";

// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    // If the user is already logged in, redirect to the home page
    header("Location: welcome.php");
    exit();
}

// Check if the login form was submitted
if (isset($_POST['login'])) {
    // Get the email/username and password from the form
    $email_username = $_POST['email_username'];
    $passwordy = $_POST['password'];

    // Connect to the database
    include "getIntoDatabase.php";

    // Query the database to check if the email/username and password combination exists
    $query = "SELECT * FROM accounts WHERE email='$email_username' OR username='$email_username'";
    $result = $conn->query($query);

    // Check if a row was returned
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($passwordy == $row['password']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['userID'] = $row['userID'];
            header("Location: welcome.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid email/username.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
        <title>Login - GameStore</title>
    </head>
    <body class="body1">
        <h1>Login</h1>
        <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post">
            <label for="email_username">Email/Username:</label><br>
            <input type="text" name="email_username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br>
            <input type="submit" name="login" value="Login">
        </form>
    </body>
</html>
