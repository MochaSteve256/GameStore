<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
        <title>Games - GameStore</title>
    </head>
    <?php 
    include "navbar.html"; 
    include "getIntoDatabase.php"; 
    ?>
    <body class="body1">
        <h1>Games</h1>
    </body>
</html>
<?php

$sql = "SELECT games.name as gamename, price, gameID, studios.name as studioname, genres.name as genrename, games.description as gamedescription FROM games JOIN genres ON games.genreID = genres.genreID JOIN studios ON games.studioID = studios.studioID ORDER BY games.name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row in a table
    echo '<table class="table-style">
        <tr>
            <th>Game Name</th>
            <th>Price</th>
            <th>Studio</th>
            <th>Genre</th>
            <th>Description</th>
            <th>Purchase</th>
        </tr>';
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["gamename"]."</td>
            <td>".$row["price"]."$</td>
            <td>".$row["studioname"]."</td>
            <td>".$row["genrename"]."</td>
            <td>".$row["gamedescription"]."</td>
            <td><a href='purchase.php?gameID=".$row["gameID"]."'>Buy now!</a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
