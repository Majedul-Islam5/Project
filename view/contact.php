<?php
    session_start();

    $name = $number = $email = "";
    $nameError = $numberError = $emailError = "";
    $successMsg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameError = "Name cannot be empty";
        } elseif (strlen($_POST["name"]) < 3) {
            $nameError = "Name must be at least 3 characters";
        } elseif (preg_match('/\d/', $_POST["name"])) {
            $nameError = "Name cannot contain numbers";
        } else {
            $name = htmlspecialchars($_POST["name"]);
        }

        if (empty($_POST["number"])) {
            $numberError = "Number cannot be empty";
        } elseif (!preg_match("/^(013|014|015|016|017|018|019)[0-9]{8}$/", $_POST["number"])) {
            $numberError = "Invalid number (must start with 013–019 and be 11 digits)";
        } else {
            $number = htmlspecialchars($_POST["number"]);
        }

        if (empty($_POST["email"])) {
            $emailError = "Email cannot be empty";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        } else {
            $email = htmlspecialchars($_POST["email"]);
        }

        if ($name && $number && $email && !$nameError && !$numberError && !$emailError) {
            $successMsg = "Thank you $name, your deatils has been submitted successfully!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../CSS/contact.css">
</head>
<body>
<header>
    <h2>ALIDADA</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="index.php">Sign Up</a>
        <a href="Login.php">Login</a>
        <a href="about.php">About</a>
        
    </nav>
</header>

<hr>

<div class="info-section">
    <h2>Our Information</h2>
    <p><strong>Mobile:</strong> 01796984411</p>
    <p><strong>Website:</strong> <a href="index.php">Alidada.com</a></p>
    <p><strong>WhatsApp:</strong> 01796984411</p>
</div>

<div class="contact-form">
    <h2>Contact Us</h2>
    <?php if ($successMsg): ?>
        <p class="success"><?php echo $successMsg; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
            <span class="error"><?php echo $nameError; ?></span>
        </div>

        <div class="form-group">
            <input type="text" name="number" value="<?php echo $number; ?>" placeholder="Enter your number">
            <span class="error"><?php echo $numberError; ?></span>
        </div>

        <div class="form-group">
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Enter your email">
            <span class="error"><?php echo $emailError; ?></span>
        </div>

        <div class="form-group" style="text-align:center;">
            <button type="submit" class="btn">Submit</button>
        </div>
    </form>
</div>

<br><br>
<footer>
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</body>
</html>
