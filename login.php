<?php
session_start();
include 'connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['fName'];
    $password = $_POST['password'];
    
    // First check in the client table
    $stmt = $conn->prepare("SELECT * FROM client WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'client';
        header("Location: index2.php");
        exit();
    } else {
        // If not found in client, check in admins table
        $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            header("Location: index2.php");
            exit();
        } else {
            echo "<script type= 'text/javascript'>alert('Username or Password does not match');
      window.location.href = 'register&login.html';
      </script>";
        }
    }
}

$conn->close();
?>