<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Project/CSS/style.css">
</head>
<body>
    <div class="main-content">
    <header>
    <h2>ALIDADA</h2>
    <nav>
        <a href="../index.php">Home</a>
        <a href="Login.php">Login</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
    </nav>
</header>

    <hr>
    </div>
<img src="/Project/Image/LOGINSIGNUP.jpg" alt="signup" >

<form action="/Project/controller/signupValidation.php" method="POST" onsubmit="return validation()">

        <div class="container">
            <h1>Sign Up</h1>
            
        </div>

        <div class="container">
            
            <input type="text" id="name" name="userName" autocomplete="off" placeholder=" " class="form_input" >
            <label for="name"> <strong>Name</strong></label>
            <span id="nameerr"></span>
            <span id="userex">
                <?php
                    if (isset($_SESSION['userExist'])) 
                    {
                        echo $_SESSION['userExist'];

                        unset($_SESSION['userExist']);
                    }
                ?>
            </span>

            <span id="naerr">
                <?php
                    if (isset($_SESSION['Name'])) 
                    {
                        echo $_SESSION['Name'];
                        unset($_SESSION['Name']);
                    }
                ?>
            </span>
        </div>

        <div class="container">
            
            <input type="email" id="email" name="email" autocomplete="off" placeholder=" " class="form_input" >
            <label for="email"> <strong>Email</strong></label>
            <span id="emailerr"></span>

            <span id="emerr">
                <?php
                    if (isset($_SESSION['Email'])) 
                    {
                        echo $_SESSION['Email'];
                        unset($_SESSION['Email']);
                    }
                ?>
            </span>
        </div>

        <div class="container">
            <select id="userType" name="userType" class="form_input" style="width:338px; height: 45px;">
                <option value="" disabled selected>Select a Type</option>
                <option value="Customer">Customer</option>
                <option value="DeliveryMan">Delivery Man</option>
            </select>
            <label for="userType"><strong>User Type</strong></label>
            <span id="typeerr"></span>

            <span id="usertypeerr">
                <?php
                    if (isset($_SESSION['UserType'])) {
                        echo $_SESSION['UserType'];
                        unset($_SESSION['UserType']);
                    }
                ?>
            </span>
        </div>


        <div class="container">
            
            <input type="number" id="mobile" name="mobile" autocomplete="off" placeholder=" " class="form_input" >
            <label for="number"> <strong>Mobile</strong></label>
            <span id="mobileerr"></span>
            <span id="moberr">
                <?php
                    if (isset($_SESSION['Mobile'])) {
                        echo $_SESSION['Mobile'];
                        unset($_SESSION['Mobile']);
                    }
                ?>
            </span>
        </div>

        <div class="container">
            
            <input type="text" id="address" name="address"  autocomplete="off" placeholder=" " class="form_input">
            <label for="address"> <strong>Address</strong></label>
            <span id="addresserr"></span>
            <span id="adderr">
                <?php
                    if (isset($_SESSION['Address'])) {
                        echo $_SESSION['Address'];
                        unset($_SESSION['Address']);
                    }
                ?>
            </span>
        </div>

        <div class="container">
            <input type="password" id="password" name="password" autocomplete="off" placeholder=" " class="form_input" >
            <label for="password"><strong>Password</strong></label>
            <span id="passworderr"></span>

            <span id="passerr">
                <?php
                    if (isset($_SESSION['Password'])) {
                        echo $_SESSION['Password'];
                        unset($_SESSION['Password']);
                    }
                ?>
            </span>
        </div>

        <div id="vehicleDiv" style="display:none;">
            <div class="container">
                <input type="text" id="license" name="license" autocomplete="off" placeholder=" " class="form_input" >
                <label for="license"><strong>License Number</strong></label>
                <span id="licenseerr"></span>

                <span id="lierr">
                    <?php
                        if (isset($_SESSION['License'])) {
                            echo $_SESSION['License'];
                            unset($_SESSION['License']);
                        }
                    ?>
                </span>
            </div>

            <div class="container">
                <select id="vehicleType" name="vehicleType" class="form_input" style="width:338px; height: 45px;">
                    <option value="" disabled selected>Select Vehicle Type</option>
                    <option value="Bike">Bike</option>
                    <option value="Van">Van</option>
                </select>
                <label for="vehicleType"><strong>Vehicle Type</strong></label>
                <span id="vehicleTypeErr"></span>

                <span id="vehicletypeerr">
                    <?php
                        if (isset($_SESSION['VehicleType'])) {
                            echo $_SESSION['VehicleType'];
                            unset($_SESSION['VehicleType']);
                        }
                    ?>
                </span>
            </div>


        </div>

        <div class="form-group">
            <button type="submit" name="sign_up" class="btn">Sign Up</button>
        </div>
 
        
    </form>
    

    <footer>
        
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
    <script src="/Project/JS/signupValidation.js"></script>
</body>
</html>