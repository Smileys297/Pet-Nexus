<?php
session_start();

// Include the database connection file
include("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Appointment Form | Noel's Arf</title>
    <link rel="stylesheet" href="Appointment.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
    body {
        background: url("images/bglog.png");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .back-btn {
        font-size: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Set an Appointment</h1>
        <form id="appointment-form" action="appointment.php" method="post">
            <label for="owner-name">Owner's Name</label>
            <input type="text" id="owner-name" name="ownerName" required />

            <label for="pet-name">Pet's Name</label>
            <input type="text" id="pet-name" name="petName" required />

            <label for="service">Type of Service</label>
            <input type="text" id="service" name="service" required />

            <label for="appointment-date">Preferred Date</label>
            <input type="date" id="appointment-date" name="Date" required />

            <label for="appointment-time">Preferred Time</label>
            <input type="time" id="appointment-time" name="Time" required />

            <label for="contact">Phone Number</label>
            <input type="tel" id="contact" name="contact" required maxlength="11" pattern="\d{11}"
                placeholder="Phone number" title="Please enter exactly 11 digits"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);" />

            <button type="submit">Schedule Appointment</button>
        </form>
        <a href="index2.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>
    </div>
</body>

</html>