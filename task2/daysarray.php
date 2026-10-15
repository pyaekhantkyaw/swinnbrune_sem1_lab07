<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Using PHP Variables, Arrays and Operators</title>
</head>
<body>

<h1>PHP Variables, Arrays and Operators</h1>

<?php

// English version
$days = array(
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
);

echo "<p>The days of the week in English are:<br>";
echo implode(", ", $days);
echo ".</p>";

// Update the same array to French
$days[0] = "Dimanche";
$days[1] = "Lundi";
$days[2] = "Mardi";
$days[3] = "Mercredi";
$days[4] = "Jeudi";
$days[5] = "Vendredi";
$days[6] = "Samedi";


echo "<p>The days of the week in French are:<br>";

for ($i = 0; $i < count($days); $i++) {
    echo $days[$i];

    if ($i < count($days) - 1) {
        echo ", ";
    }
}

echo ".</p>";
?>

</body>
</html>