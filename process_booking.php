<?php
$servername = "localhost";
$username = "username";
$password = "password";
$database = "hotel_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$customerName = $_POST['customerName'];
$checkInDate = $_POST['checkInDate'];
$totalDays = $_POST['totalDays'];
$totalPersons = $_POST['totalPersons'];
$advanceAmount = $_POST['advanceAmount'];
$additionalCharges = $_POST['additionalCharges'];

// Calculate total cost
$totalCost = ($totalDays * $totalPersons * 100) + $additionalCharges;

// Calculate balance
$balance = $totalCost - $advanceAmount;

// Insert data into MySQL database
$sql = "INSERT INTO bookings (customer_name, checkin_date, total_days, total_persons, advance_amount, additional_charges, total_cost, balance)
VALUES ('$customerName', '$checkInDate', $totalDays, $totalPersons, $advanceAmount, $additionalCharges, $totalCost, $balance)";

if ($conn->query($sql) === TRUE) {
    echo "Booking successful. Total cost: $totalCost, Balance: $balance";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

