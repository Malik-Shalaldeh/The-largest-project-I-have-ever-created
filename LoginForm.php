<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }
        .header {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.9);
            width: 320px;
        }
        .form-fieldset {
            border: none;
            padding: 0px;
            margin: 0px;
        }
        .form-legend {
            font-size: 29px;
            color: #f39c12;
            margin-bottom: 10px;
            text-align: center;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #f39c12;
            border-radius: 4px;
            background-color: #222;
            color: #fff;
            box-sizing: border-box;
        }
        .form-submit {
            background-color: #f39c12;
            color: #000;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .form-submit:hover {
            background-color: #e67e22;
        }
        .form-error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header">Welcome to CarZone</header>
    <h5>This website is dedicated to cars, through which you can view prices, pictures and specifications of cars. I hope you have a good experience
    </h5>
    <?php 
    $msg = "";

    $arr = array(
        "Ahmad" => "Ahmad123",
        "Ali" => "Ali123",
        "Malik" => "Malik123"
    );

    if (isset($_POST['submit'])) {
        $u = $_POST["user"];
        $p = $_POST["pass"];
        foreach ($arr as $user => $pass) {
            if ($u == $user && $p == $pass) {
                header("location: http://localhost/web/ProjectPHP/homepage.php");
                exit;
            }
        }
        $msg = "The UserName Or Password is wrong!";
    }
    ?>

    <form class="form-container" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <fieldset class="form-fieldset">
            <legend class="form-legend">Car Login</legend>

            <label class="form-label" for="user">User Name:</label>
            <input class="form-input" type="text" name="user" id="user" required>

            <label class="form-label" for="pass">Password:</label>
            <input class="form-input" type="password" name="pass" id="pass" required>

            <input class="form-submit" type="submit" name="submit" value="Login">
        </fieldset>
            <div class="form-error"> <?php echo $msg; ?> </div>
    </form>
</body>
</html>
