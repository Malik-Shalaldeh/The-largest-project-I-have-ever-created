<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Cars</title>
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
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #575757;
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
    die("Failed to Connect: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $car_name = $_POST['name'];

    $query = "DELETE FROM data WHERE name = '$car_name'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<h2>Car: $car_name deleted successfully.</h2>";
    } else {
        echo "<h2>Failed to delete car: " . mysqli_error($con) . "</h2>";
    }
}

$query = "SELECT * FROM data";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<form action='' method='POST'>";
    echo "<table>";
    echo "<tr>
            <th>Select</th>
            <th>Car Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><input type='radio' name='name' value='" . $row['name'] . "'></td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>$" . $row['price'] . "</td>";
        echo "<td><img src='" . $row['image'] . "' alt='Car Image' style='width: 100px; height: 70px;'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
    echo "<input type='submit' value='Delete Selected Car'>";
    echo "</form>";
} else {
    echo "<h2>No cars found or query failed: " . mysqli_error($con) . "</h2>";
}

mysqli_close($con);
?>
</body>
</html>
