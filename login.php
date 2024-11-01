<?php 
session_start();
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['username']);
    $pass = validate($_POST['password']);

    // Input validation
    if (empty($uname)) {
        header("Location: index.php?error=User Name is required!");
        exit();
    } 
    else if (empty($pass)) {
        header("Location: index.php?error=Password is required!");
        exit();
    }

    // Use a prepared statement to fetch the user by username
    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($pass, $row['password'])) {
            // Set session variables and redirect to home page
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['name'] = $row['name'] ?? 'Guest';  // Handle null name field
            $_SESSION['id'] = $row['id'];

            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=Incorrect User Name or Password");
            exit();
        }
    } else {
        header("Location: index.php?error=Incorrect User Name or Password");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
