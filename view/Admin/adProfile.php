<?php
    include_once('../../controller/Admin/adProfileController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="../../CSS/adProfile.css">
</head>
<body>
    <div class="main-content">
        <header>
            <a href="adDashboard.php"><h2>ALIDADA</h2></a>
            <nav>
                
                <a href="userView.php">Customer Information</a>
                <a href="adAddProduct.php">Add Product</a>
                <a href="../../controller/logout.php">Log Out</a>
            </nav>
        </header>

        <hr>
        
        <div class="profile-container">
            <div class="left-panel">
                <h2>Admin / Edit Profile</h2>
                <div class="profile-image">
                    <img src="../../Image/<?= $image ?>" alt="Admin Picture">
                </div>
            </div>

            <div class="profile-form">
                <form action="adProfile.php" method="POST">
                    <label for="name"><strong>Name</strong></label><br>
                    <input type="text" id="name" value="<?php echo($userName) ?>" name="userName" class="form_input">
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
                    <input type="email" id="email" value="<?php echo($email) ?>" name="email" class="form_input">
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
                    <input type="text" id="mobile" value="<?php echo($mobile) ?>" name="mobile" class="form_input">
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
                    <input type="text" id="address" value="<?php echo($address) ?>" name="address" class="form_input">
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
                    <input type="text" id="password" value="<?php echo($password) ?>" name="password" class="form_input">
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
            </div>
        </div>
        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>
