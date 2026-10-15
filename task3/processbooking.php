<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
</head>
<body>

<h1>Rohirrim Tour Booking Confirmation</h1>

<?php
// Array to hold error messages
$errMsg = array();

// Extract input values
$firstname = isset($_POST["firstname"]) ? trim($_POST["firstname"]) : "";   // ? tells if the left side is true (shorten if/else)
$lastname  = isset($_POST["lastname"]) ? trim($_POST["lastname"]) : "";   
$species   = isset($_POST["species"]) ? trim($_POST["species"]) : "";
$age       = isset($_POST["age"]) ? trim($_POST["age"]) : "";
$food      = isset($_POST["food"]) ? trim($_POST["food"]) : "";
$partysize = isset($_POST["partysize"]) ? trim($_POST["partysize"]) : "";
$bookday   = isset($_POST["bookday"]) ? trim($_POST["bookday"]) : "";

// Map species code to name
switch ($species) {
    case "M": $species_name = "Human"; break;
    case "D": $species_name = "Dwarf"; break;
    case "E": $species_name = "Elf"; break;
    case "H": $species_name = "Hobbit"; break;
    default:  $species_name = "Unknown";
}

// ---------------------------------------------------------------------
// Validation Checks 
// ---------------------------------------------------------------------

// 1. Age Validation: Must be numeric and at least 16
if ($age === "") {
    $errMsg[] = "Please enter your age.";
} elseif (!is_numeric($age)) {
    $errMsg[] = "Age must be a number.";
} elseif ($age < 16) {
    $errMsg[] = "You must be at least 16 years old to book.";
}

// 2. Party Size Validation: Must be numeric and greater than 0
if ($partysize === "") {
    $errMsg[] = "Please enter the number of travellers.";
} elseif (!is_numeric($partysize)) {
    $errMsg[] = "Number of travellers must be a number.";
} elseif ($partysize <= 0) {
    $errMsg[] = "Number of travellers cannot be 0 or negative.";
}

// 3. Date Validation: Must be valid and not in the past
if ($bookday === "") {
    $errMsg[] = "Please enter a booking date.";
} else {
    $bookingTimestamp = strtotime($bookday);
    $todayTimestamp   = strtotime("today");

    if (!$bookingTimestamp) {
        $errMsg[] = "Invalid date format. Please enter a valid date (e.g. YYYY-MM-DD).";
    } elseif ($bookingTimestamp < $todayTimestamp) {
        $errMsg[] = "Booking date cannot be in the past.";
    }
}

// Process tour checkboxes
$tours = array();
if (isset($_POST["accom"]))  $tours[] = "Accommodation";
if (isset($_POST["4day"]))   $tours[] = "Four-day tour";
if (isset($_POST["10day"]))  $tours[] = "10-day tour";

if (count($tours) > 0) {
    $booking_text = "You are now booked on the " . implode(" and ", $tours);
} else {
    $booking_text = "You have not selected any tours.";
}

// ---------------------------------------------------------------------
// Display Errors or Output Confirmation
// ---------------------------------------------------------------------
if (count($errMsg) > 0) {
    echo "<h2 style='color: red;'>Error Processing Booking:</h2>";
    echo "<ul>";
    foreach ($errMsg as $error) {
        echo "<li style='color: red;'>$error</li>";
    }
    echo "</ul>";
    echo "<p><a href='register.html'>Go back and fix the form</a></p>";
} else {
    echo "<p>Welcome $firstname $lastname !</p>";
    echo "<p>$booking_text</p>";
    echo "<p>Species: $species_name</p>";
    echo "<p>Age: $age</p>";
    echo "<p>Meal Preference: $food</p>";
    echo "<p>Number of travellers: $partysize</p>";
    echo "<p>Booking Date: $bookday</p>";
}
?>

</body>
</html>