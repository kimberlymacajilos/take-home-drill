<?php
include "connection.php";

$leaderboard = [];

if (isset($_GET['start']) && isset($_GET['end'])){
    $startdate = $_GET['start'];
    $enddate = $_GET['end'];

    $query = "SELECT name, score, date_taken FROM leaderboard WHERE date_taken BETWEEN ? AND ?
              ORDER BY score DESC, date_taken ASC LIMIT 10";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $startdate, $enddate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $leaderboard = $result->fetch_all(MYSQLI_ASSOC);
    }
}
else{
    $query = "SELECT name, score, date_taken FROM leaderboard ORDER BY score DESC, date_taken ASC LIMIT 10";
    $result = mysqli_query($conn, $query);

    if ($result){
        $leaderboard = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

if (!$result){
    die("Error fecthing leaderboard data: ". mysqli_error($conn));
}
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
    <br>

    <?php if ($leaderboard): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Date Taken</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rank =1;
                foreach ($leaderboard as $row): ?>
                    <tr>
                        <td><?php echo $rank++; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo $row['score']; ?></td>
                        <td><?php echo $row['date_taken']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>There are no scores to display for the selected date range.</p>
    <?php endif; ?>

    <a href="index.php">Back to Quiz</a>

</body>
</html>
