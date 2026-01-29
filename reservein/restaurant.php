<?php
// Get restaurant name from URL
$restaurant = isset($_GET['name']) ? $_GET['name'] : "Unknown Restaurant";

/* Map restaurant names to images */
$restaurantImages = [
  "Sky Dining Jakarta" => "images/resto1.jpg",
  "Bali Ocean Grill" => "images/resto2.jpg",
  "Bandung Bistro" => "images/resto3.jpg",
  "Jakarta Steakhouse" => "images/resto4.jpg",
  "Surabaya Spice" => "images/resto5.jpg",
  "Ubud Garden Cafe" => "images/resto6.jpg",
  "Solo Cafe" => "images/resto7.jpg",
  "Makassar Seafood Hub" => "images/resto8.jpg",
  "Yogyakarta Heritage Dine" => "images/resto9.jpg",
  "Semarang Noodle Bar" => "images/resto10.jpg",
  "Balikpapan Grill House" => "images/resto11.jpg",
  "Manado Ocean Kitchen" => "images/resto12.jpg"
];

// Pick correct image or fallback
$image = isset($restaurantImages[$restaurant]) 
        ? $restaurantImages[$restaurant] 
        : "images/resto1.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $restaurant; ?> | Reservein</title>
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

<section class="section">
  <div class="hero" style="grid-template-columns: 1fr 1fr;">
    <img src="<?php echo $image; ?>" 
         style="width:100%; border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,0.15);">

    <div>
      <h2><?php echo $restaurant; ?></h2>
      <p style="margin:12px 0; color:#666;">
        Reserve your table at <?php echo $restaurant; ?> quickly and easily with Reservein.
      </p>

      <form class="search-box" action="confirm.php" method="POST">
        <input type="hidden" name="restaurant" value="<?php echo $restaurant; ?>">

        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="date" name="date" id="date" required>
        <select name="time" id="time" required>
        <option value="" disabled selected>Select time</option>
        </select>
        <input type="number" name="people" min="1" max="20" placeholder="Guests" required>

        <button type="submit">Reserve Now</button>
      </form>
    </div>
  </div>
</section>

<footer>
  © 2026 Reservein. All rights reserved.
</footer>

<script>
const dateInput = document.getElementById("date");
const timeSelect = document.getElementById("time");

const today = new Date();
const nextMonth = new Date();
nextMonth.setMonth(today.getMonth() + 2);

dateInput.min = today.toISOString().split("T")[0];
dateInput.max = nextMonth.toISOString().split("T")[0];
dateInput.value = today.toISOString().split("T")[0]; // auto-select today

function generateTimeSlots() {
  timeSelect.innerHTML = `<option value="" disabled selected>Select time</option>`;

  const now = new Date();
  const selectedDate = new Date(dateInput.value);
  const isToday = selectedDate.toDateString() === now.toDateString();

  for (let h = 10; h <= 22; h++) {
    for (let m = 0; m < 60; m += 15) {
      const slot = new Date(selectedDate);
      slot.setHours(h, m, 0, 0);

      if (!isToday || slot > now) {
        const time = slot.toTimeString().slice(0, 5);
        const option = document.createElement("option");
        option.value = time;
        option.textContent = time;
        timeSelect.appendChild(option);
      }
    }
  }
}

dateInput.addEventListener("change", generateTimeSlots);
window.onload = generateTimeSlots;
</script>
