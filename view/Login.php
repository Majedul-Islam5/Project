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
        <a href="index.php">Sign Up</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
        
    </nav>
</header>

    <hr>
    </div>
<img src="/Project/Image/LOGINSIGNUP.jpg" alt="signup" >
<form action="/Project/controller/loginValidation.php"  method="POST" onsubmit="return validation()">


        <div class="container">
            <h1>Log In</h1>
            
        </div>

        <div class="container">
            
            <input type="text" id="name" name="userName" autocomplete="off" placeholder=" " class="form_input" value="<?php echo(isset($_COOKIE['name']))?$_COOKIE['name']:''?>">
            <label for="name"> <strong>Name</strong></label>
            <span id="nameerr"></span>
            <span id="use">
                <?php
                    if (isset($_SESSION['nameError'])) 
                    {
                        echo $_SESSION['nameError'];

                        unset($_SESSION['nameError']);
                    }
                ?>
            </span>
            <span id="uk">
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
            <input type="password" id="password" name="password" autocomplete="off" placeholder=" " class="form_input" value="<?php echo(isset($_COOKIE['password']))?$_COOKIE['password']:''?>">
            <label for="password"><strong>Password</strong></label>
            <span id="passworderr"></span>
            <span id="pass">
                <?php
                    if (isset($_SESSION['passError'])) 
                    {
                        echo $_SESSION['passError'];

                        unset($_SESSION['passError']);
                    }
                ?>
            </span>
            <span id="pk">
                <?php
                    if (isset($_SESSION['Password'])) 
                    {
                        echo $_SESSION['Password'];

                        unset($_SESSION['Password']);
                    }
                ?>
            </span>
        </div>

         <div class="container">
            
            <input type="checkbox" id="remember" name="remember">
            <strong>Remember me</strong>
            
        </div>

        <div class="form-group">
            <button type="submit" class="btn">Log In</button>
        </div>


        

        
        
    </form>
    

    <footer>
        
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
    <script src="/Project/JS/loginValidation.js"></script>
</body>
</html>