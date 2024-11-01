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
        header("Location: registerpage.php?error=User Name is required");
        exit();
    } 
    else if (empty($pass)) {
        header("Location: registerpage.php?error=Password is required");
        exit();
    } 

    // Check if the username is already taken
    $sql = "SELECT * FROM users WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: registerpage.php?error=User Name already taken");
        exit();
    } else {
        // Hash the password
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        // Insert the new user into the database
        $sql2 = "INSERT INTO users(user_name, password) VALUES(?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('ss', $uname, $hashedPassword);

        if ($stmt2->execute()) {
            header("Location: registerpage.php?success=Your account has been created successfully");
            exit();
        } else {
            header("Location: registerpage.php?error=Something went wrong. Please try again");
            exit();
        }
    }
} else {
    header("Location: registerpage.php");
    exit();
}
?>
