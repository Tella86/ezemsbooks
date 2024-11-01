<?php
// db.php - Your database connection
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $role = 'user'; // Default role

    // Check if username or email already exists
    $checkUser = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already taken.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: login.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $checkUser->close();
    $conn->close();
}
?>
