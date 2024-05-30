<?php
session_start();

// Include the database connection file
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve form data
    $Ownername = $_POST['ownerName'];
    $Petname = $_POST['petName'];
    $Service = $_POST['service'];
    $Appointmentdate = $_POST['Date'];
    $Appointmenttime = $_POST['Time'];
    $Contact = $_POST['contact'];


    $query = "INSERT INTO appointments (ownerName, petName, service, Date, Time, contact) VALUES ('$Ownername', '$Petname', '$Service', '$Appointmentdate', '$Appointmenttime', '$Contact')";
    $result = mysqli_query($con, $query);

    if ($result) {

        echo "<script type= 'text/javascript'>alert('Successfully Booked')
        window.location.href = 'Appointment1.php'</script>";
        
       
        exit();
    } else {
        echo "Error: " . mysqli_error($con); 
    }
}
?>