<?php
session_start();
include '../db.php';

if (!isset($_SESSION['restaurant'])) {
  header("Location: login.php");
  exit;
}

$restaurant = $_SESSION['restaurant'];
$id = $restaurant['id'];

$bookings = mysqli_query($conn,
  "SELECT * FROM bookings WHERE restaurant_id=$id ORDER BY booking_date, booking_time"
);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard | Reservein</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<header class="admin-header">
  <h1><?php echo $restaurant['name']; ?></h1>
  <a href="logout.php">Logout</a>
</header>

<div class="admin-container">

<h2>Reservations</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Date</th>
    <th>Time</th>
    <th>Guests</th>
    <th>Status</th>
    <th>Action</th>
  </tr>

  <?php while ($b = mysqli_fetch_assoc($bookings)) { ?>
  <tr>
    <td><?php echo $b['name']; ?></td>
    <td><?php echo $b['booking_date']; ?></td>
    <td><?php echo $b['booking_time']; ?></td>
    <td><?php echo $b['people']; ?></td>
    <td>
  <span class="status <?php echo $b['status']; ?>">
    <?php echo $b['status']; ?>
  </span>
</td>
<td class="actions">
  <a class="confirm" href="update_status.php?id=<?php echo $b['id']; ?>&status=Confirmed">
    Confirm
  </a>
  <a class="cancel" href="update_status.php?id=<?php echo $b['id']; ?>&status=Cancelled">
    Cancel
  </a>
</td>

  </tr>
  <?php } ?>

</table>

</div>
</body>
</html>
