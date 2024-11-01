<?php 
session_start();
include "db_conn.php";  // Include the database connection

// Check if the user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Initialize the score in the session if not already set
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }

    // If the button is pressed (via POST request), increment the session score
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['score']++;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOME - Button Game</title>
        <link rel="icon" href="Button.png" type="image/x-icon"> 
        <link rel="stylesheet" type="text/css" href="stylehome.css">
    </head>
    <body>

     <div class="main-container"> 
        <div class="game-container">
            <h1>Button Game!</h1>
            <img src="Button.png" alt="Button Image missing." class="responsive-image">
            <p>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            <p>Score: <span id="score"><?php echo $_SESSION['score']; ?></span></p>
            <form method="POST">
                <button type="submit" id="score-btn">Press Me!</button>
                <button type="button" onclick="window.location.href='logout.php';">Logout</button>
            </form>
        </div>
        
     </div> 

        <div class="leaderboard-container">
            <h2>Top 10 Leaderboard</h2>
            <?php
            // Query to get the top 10 scores         
            $sql = "SELECT username, MAX(score) AS high_score 
                    FROM game_scores 
                    GROUP BY username 
                    ORDER BY high_score DESC 
                    LIMIT 10";
            
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>   <tr>

                                <th>    Rank            </th>
                                <th>    Username        </th>
                                <th>    Highest Score   </th>

                                </tr>";
                $rank = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$rank}</td><td>{$row['username']}</td><td>{$row['high_score']}</td></tr>";
                    $rank++;
                }
                echo "</table>";
            } else {
                echo "<p>No scores yet!</p>";
            }
            ?>
        </div>
    </body>
    </html>
    <?php 
} else {
    header("Location: index.php");
    exit();
}
?>
