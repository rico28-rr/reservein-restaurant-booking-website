<?php
include 'db.php';

$name  = $_POST['name'];
$email = $_POST['email'];
$date  = $_POST['date'];
$time  = $_POST['time'];
$people= $_POST['people'];
$restaurant = $_POST['restaurant'];

$sql = "INSERT INTO bookings 
(name, email, restaurant, booking_date, booking_time, people)
VALUES 
('$name','$email','$restaurant','$date','$time','$people')";

mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reservation Confirmed | Reservein</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <nav>
    <h1>Reservein</h1>
    <div>
      <a href="index.php">Home</a>
      <a href="restaurants.php">Restaurants</a>
    </div>
  </nav>
</header>

<div class="confirmation-wrapper">
  <div class="confirmation-card">

    <div class="icon">✓</div>

    <h2>Reservation Confirmed!</h2>
    <p>Thank you, <strong><?php echo $name; ?></strong></p>
    <p>Your table at <strong><?php echo $restaurant; ?></strong> is successfully booked.</p>

    <div class="confirmation-details">
      <p><strong>Date:</strong> <?php echo $date; ?></p>
      <p><strong>Time:</strong> <?php echo $time; ?></p>
      <p><strong>Guests:</strong> <?php echo $people; ?> people</p>
      <p><strong>Email:</strong> <?php echo $email; ?></p>
    </div>

    <a href="index.php">Back to Home</a>
  </div>
</div>

<footer>
  © 2026 Reservein. All rights reserved.
</footer>

</body>
</html>
