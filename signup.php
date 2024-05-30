<?php
session_start();
include 'connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['fName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email exists in both client and admin tables
    $checkEmailClient = $conn->prepare("SELECT * FROM client WHERE email = ?");
    $checkEmailClient->bind_param("s", $email);
    $checkEmailClient->execute();
    $resultClient = $checkEmailClient->get_result();

    $checkEmailAdmin = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $checkEmailAdmin->bind_param("s", $email);
    $checkEmailAdmin->execute();
    $resultAdmin = $checkEmailAdmin->get_result();

    if ($resultClient->num_rows > 0 || $resultAdmin->num_rows > 0) {
        echo "<script type= 'text/javascript'>alert('Email Already Existing!');
      window.location.href = 'register&login.html';
      </script>";
    } else {
        // Insert new user into client table
        $stmt = $conn->prepare("INSERT INTO client (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            header("Location: register&login.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

$conn->close();
?>