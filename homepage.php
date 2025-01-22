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
        .filter {
            text-align: center;
            margin: 20px 0;
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
    </style>
</head>
<body>
<div class="navbar">
    <a href="homepage.php">Home</a>
    <a href="insertCar.php">Insert Car</a>
    <a href="firstPage.php">Update Car</a>
    <a href="deleteCars.php">DeleteCars</a>
</div>

    <div class="filter">
        <form method="POST">
            <label for="min-price">Min Price:</label>
            <select id="min-price" name="min_price">
                <option value="0">0</option>
                <option value="5000">5000</option>
                <option value="10000">10000</option>
                <option value="20000">20000</option>
            </select>

            <label for="max-price">Max Price:</label>
            <select id="max-price" name="max_price">
                <option value="0">No Limit</option>
                <option value="10000">10000</option>
                <option value="20000">20000</option>
                <option value="30000">30000</option>
                <option value="40000">40000</option>
                <option value="50000">50000</option>
                <option value="60000">60000</option>
                <option value="70000">70000</option>
                <option value="80000">80000</option>
                <option value="90000">90000</option>
                <option value="100000">100000</option>
            </select>

            <button type="submit">Filter</button>
        </form>
    </div>

    <?php
    $con = mysqli_connect("localhost:3306", "root", "", "cars");
    if (!$con) {
        die("<h2>Failed to Connect: " . mysqli_connect_error() . "</h2>");
    }

    $min_price = isset($_POST['min_price']) ? (int)$_POST['min_price'] : 0;
    $max_price = isset($_POST['max_price']) && (int)$_POST['max_price'] > 0 ? (int)$_POST['max_price'] : PHP_INT_MAX;

    $query = "SELECT * FROM data WHERE price >= $min_price AND price <= $max_price";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<div class='container'>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<div class='card'>";
            echo "<img src='{$row['image']}' alt='Car Image' style='width: 100%; height: 150px;'>";
            echo "<h3>{$row['name']}</h3>";
            echo "<p>{$row['description']}</p>";
            echo "<p class='price'>\${$row['price']}</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<h2>Query Failed: " . mysqli_error($con) . "</h2>";
    }

    mysqli_close($con);
    ?>
</body>
</html>
