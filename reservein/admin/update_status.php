<?php
session_start();
include '../db.php';

if (!isset($_SESSION['restaurant'])) {
  header("Location: login.php");
  exit;
}

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn,
  "UPDATE bookings SET status='$status' WHERE id=$id"
);

header("Location: dashboard.php");
