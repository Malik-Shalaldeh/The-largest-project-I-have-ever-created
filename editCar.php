<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <style>
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

$car_name = isset($_POST['car_name']) ? $_POST['car_name'] : '';
$row = null;

if (!empty($car_name)) {
    $sql = "SELECT * FROM data WHERE name = '$car_name'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
    }
}

if ($row):
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <fieldset>
            <legend>Edit Car Information</legend>
            <label for="car_name">Car Name:</label>
            <input type="text" id="car_name" name="car_name" value="<?php echo $row['name']; ?>" readonly><br><br>

            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $row['description']; ?></textarea><br><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $row['price']; ?>"><br><br>

            <label for="image">Image URL:</label>
            <input type="text" id="image" name="image" value="<?php echo $row['image']; ?>"><br><br>

            <button type="submit" name="update">Update Car</button>
        </fieldset>
    </form>
<?php
else:
    echo "<h2>No car selected or car not found.</h2>";
endif;

if (isset($_POST['update'])) {
    $updated_description = $_POST['description'];
    $updated_price = $_POST['price'];
    $updated_image = $_POST['image'];

    $update_sql = "UPDATE data SET 
        description = '$updated_description',
        price = $updated_price,
        image = '$updated_image'
        WHERE name = '$car_name'";

    if (mysqli_query($con, $update_sql)) {
        echo "<h2>Car information has been updated successfully!</h2>";
    } else {
        echo "<h2>Error updating car: " . mysqli_error($con) . "</h2>";
    }
}

mysqli_close($con);
?>
</body>
</html>
