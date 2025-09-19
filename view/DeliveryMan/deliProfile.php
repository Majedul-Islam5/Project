<?php
    include_once('../../controller/Deliveryman/deliProfileController.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliveryman Profile</title>
    <link rel="stylesheet" href="/Project/CSS/deliProfile.css">
</head>
<body>
<div class="main-content">
    <header>
        <a href="deliDashboard.php"><h2>ALIDADA</h2></a>
        <nav>
            <a href="deliDeliveryHistory.php">Delivery History</a>
            <a href="deliDeliveryStatus.php">Delivery Status</a>
            <a href="../../controller/logout.php">Log Out</a>
        </nav>
    </header>
    <hr>

    <h2>Deliveryman / Edit Profile</h2>
    <form action="deliProfile.php" method="POST">
        <label for="name"><strong>Name</strong></label><br>
        <input type="text" id="name" name="userName" class="form_input" value="<?php echo($userName) ?>">
        <span class="error">
                <?php
                    if (isset($_SESSION['Name'])) 
                    {
                        echo $_SESSION['Name'];
                        unset($_SESSION['Name']);
                    }
                ?>
        </span>
        <br>

        <label for="email"><strong>Email</strong></label><br>
        <input type="email" id="email" name="email" class="form_input" value="<?php echo($email) ?>">
        <span class="error">
                <?php
                    if (isset($_SESSION['Email'])) 
                    {
                        echo $_SESSION['Email'];
                        unset($_SESSION['Email']);
                    }
                ?>
        </span>
        <br>

        <label for="mobile"><strong>Mobile</strong></label><br>
        <input type="text" id="mobile" name="mobile" class="form_input" value="<?php echo($mobile) ?>">
        <span class="error">
                <?php
                    if (isset($_SESSION['Mobile'])) {
                        echo $_SESSION['Mobile'];
                        unset($_SESSION['Mobile']);
                    }
                ?>
        </span>
        <br>

        <label for="address"><strong>Address</strong></label><br>
        <input type="text" id="address" name="address" class="form_input" value="<?php echo($address) ?>">
        <span class="error">
                <?php
                    if (isset($_SESSION['Address'])) {
                        echo $_SESSION['Address'];
                        unset($_SESSION['Address']);
                    }
                ?>
        </span>
        <br>

        <label for="password"><strong>Password</strong></label><br>
        <input type="text" id="password" name="password" class="form_input" value="<?php echo($password) ?>">
        <span class="error">
                <?php
                    if (isset($_SESSION['Password'])) {
                        echo $_SESSION['Password'];
                        unset($_SESSION['Password']);
                    }
                ?>
        </span>
        <br>

        <button type="submit" name="action" value="change">Save Changes</button>
        <button type="submit" name="action" value="delete">Delete Account</button>
    </form>

    <footer>
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</div>
</body>
</html>
