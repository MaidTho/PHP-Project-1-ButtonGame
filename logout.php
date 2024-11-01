<?php 
session_start();
include "db_conn.php";  // Include the database connection

// Check if the user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];
    $score = $_SESSION['score'];

    // Insert the final score into the database
    $sql = "INSERT INTO game_scores (username, score) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $score);
    $stmt->execute();
    
    // Clear the session and log out
    session_unset();
    session_destroy();

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
