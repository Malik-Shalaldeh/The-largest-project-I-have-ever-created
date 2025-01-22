<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: center;
            padding: 10px 0;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
            text-align: center;
        }
        .navbar a:hover {
            background-color: #575757;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .card img {
            width: 100%;
            height: 150px;
            border-radius: 5px;
        }
        .card h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .card p {
            font-size: 1em;
            color: #555;
        }
        .card .price {
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
        }
        .select-form {
            text-align: center;
            margin: 30px 0;
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="homepage.php">Home</a>
    <a href="insertCar.php">Insert Car</a>
    <a href="firstPage.php">Update Car</a>
    <a href="deleteCars.php">DeleteCars</a>
</div>

<?php
$con = mysqli_connect("localhost:3306", "root", "", "cars");
if (!$con) {
    die("<h2>Failed to Connect: " . mysqli_connect_error() . "</h2>");
}

$query = "SELECT * FROM data";
$result = mysqli_query($con, $query);

if ($result) {
    echo "<form class='select-form' action='editCar.php' method='POST'>";
    echo "<div class='container'>";
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<div class='card'>";
        echo "<img src='{$row['image']}' alt='Car Image'>";
        echo "<h3>{$row['name']}</h3>";
        echo "<p>{$row['description']}</p>";
        echo "<p class='price'>\${$row['price']}</p>";
        echo "<input type='radio' name='car_name' value='{$row['name']}' required> Select";
        echo "</div>";
    }
    echo "</div>";
    echo "<br><button type='submit' name='submit'>Edit Selected Car</button>";
    echo "</form>";
} else {
    echo "<h2>Query Failed: " . mysqli_error($con) . "</h2>";
}

if(isset($_POST['submit'])){
    header("locatiom : http://localhost/web/projectPHP/firstPage.php");
}
mysqli_close($con);
?>
</body>
</html>
