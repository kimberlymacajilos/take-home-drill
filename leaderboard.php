<?php
include "connection.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
</head>
<body>
    <h1>Leaderboard</h1>

    <form method="GET" action="">
        <label for="startdate">Start Date:</label>
        <input type="date" id="start" name="start" required>
        <label for="enddate">End Date:</label>
        <input type="date" id="end" name="end" required>
        <button type="submit">Filter</button>
    </form>
</body>
</html>
