<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
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
        .form-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container textarea, .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
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

<div class="form-container">
    <h2>Add New Car</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Car Name:</label>
        <input type="text" name="name" required>

        <label for="description">Car Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label for="price">Car Price:</label>
        <input type="number" name="price" required>

        <label for="image">Car Image:</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" name="submit">Add Car</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    $target_dir = "uploads/";
    $target_file = $target_dir . $_FILES["image"]["name"];

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $con = mysqli_connect("localhost:3306", "root", "", "cars");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "INSERT INTO data (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<h2>Car added successfully!</h2>";
        } else {
            echo "<h2>Failed to add car: " . mysqli_error($con) . "</h2>";
        }

        mysqli_close($con);
    } else {
        echo "<h2>Failed to upload image.</h2>";
    }
}
?>
</body>
</html>
