<?php
session_start();

include_once ('../model/model.php');

function test_input($data) 
{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}


$firstname=isset($_POST['userName']) ? test_input($_POST['userName']) : '';
$email=isset($_POST['email']) ? test_input($_POST['email']) : '';
$mobile=isset($_POST['mobile']) ? test_input($_POST['mobile']) : '';
$address=isset($_POST['address']) ? test_input($_POST['address']) : '';
$password=isset($_POST['password']) ? test_input($_POST['password']) : '';
$userType=isset($_POST['userType']) ? test_input($_POST['userType']) : '';

$errors="";


if(empty($firstname)) 
{
    $_SESSION['Name'] = "Name is empty";
    $errors = "empty";
}
else
{
    if(strlen($firstname) < 3) 
    {
        $_SESSION['Name'] = "Name must be at least 3 characters long";
        $errors = "empty";
    }
}


if(empty($email)) 
{
    $_SESSION['Email'] = "Email is empty";
    $errors = "empty";
}

else
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $_SESSION['Email'] = "Enter a valid email address";
        $errors = "empty";
    }
}


if(empty($mobile)) 
{
    $_SESSION['Mobile'] = "Mobile number is empty";
    $errors = "empty";
}

else
{
    if(strlen($mobile) != 11)
        {
            $_SESSION['Mobile'] = "Mobile number must contain 11 digits";
            $errors = "empty";
        }
        
    elseif(!preg_match("/^(013|014|015|016|017|018|019)/", $mobile))
        {
            $_SESSION['Mobile'] = "Mobile number must be valid";
            $errors = "empty";
        }
}

if(empty($address)) 
{
    $_SESSION['Address'] = "Address is empty";
    $errors = "empty";
}

if(empty($password)) 
{
    $_SESSION['Password'] = "Password is empty";
    $errors = "empty";
}
else
{
    if(strlen($password) < 8) 
    {
        $_SESSION['Password'] = "Password must be at least 8 characters long";
        $errors = "empty";
    }

    elseif(!preg_match('/[A-Z]/', $password)) 
    {
        $_SESSION['Password'] = "Password must contain at least one uppercase letter";
        $errors = "empty";
    }

    elseif(!preg_match('/[a-z]/', $password)) 
    {
        $_SESSION['Password'] = "Password must contain at least one lowercase letter";
        $errors = "empty";
    }

    elseif(!preg_match('/[0-9]/', $password)) 
    {
        $_SESSION['Password'] = "Password must contain at least one digit";
        $errors = "empty";
    }

    elseif(!preg_match('/[!@#$%^&*]/', $password)) 
    {
        $_SESSION['Password'] = "Password must contain at least one special character";
        $errors = "empty";
    }
}

if(empty($userType)) 
{
    $_SESSION['UserType'] = "User type is empty";
    $errors = "empty";
}


if(!empty($errors)) 
{
    header("Location: ../view/index.php");
    exit();
}
else
{
    $model = new Model();

    $row=$model->userExist($firstname);

        if(!empty($row) && $row[0]['user_name']==$firstname)
        {
            $_SESSION['userExist']="User exist";
            header("Location: ../view/index.php");
            exit();
        }
        else
        {
            $model->userCreate($firstname, $password, $userType,$address,$email,$mobile);
            header("Location: ../view/Login.php");
        }

    
}
