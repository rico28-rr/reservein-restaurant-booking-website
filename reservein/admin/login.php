<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = mysqli_query($conn,
    "SELECT * FROM restaurants WHERE email='$email' AND password='$password'"
  );

  if (mysqli_num_rows($query) === 1) {
    $_SESSION['restaurant'] = mysqli_fetch_assoc($query);
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Invalid email or password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Restaurant Login | Reservein</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<div class="admin-login-wrapper">
  <div class="admin-card">
    <h2>Reservein</h2>
    <p class="subtitle">Restaurant Partner Login</p>

    <?php if (isset($error)) { ?>
      <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
      <input name="email" type="email" placeholder="Restaurant Email" required>
      <input name="password" type="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</div>

</body>
</html>
