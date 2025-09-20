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
    $password=isset($_POST['password']) ? test_input($_POST['password']) : '';

    $errors="";

    if(empty($firstname)) 
    {
        $_SESSION['Name']="Name is empty";
        $errors="Name is empty";
    }

    if(empty($password)) 
    {   
        $_SESSION['Password']="Password is empty";
        $errors="Password is empty";
    }

    if (!empty($errors)) 
    {
        header("Location:../view/Login.php");
        exit();
    }
    else
    {
        $model = new Model();
        $row=$model->userExist($firstname);

        if(empty($row))
        {
            $_SESSION['nameError']="User does not exist";
            header("Location:../view/Login.php");
            exit();
        }
        if(!empty($row) && $row[0]['password']!=$password)
        {
            $_SESSION['passError']="Password does not match";
            header("Location:../view/Login.php");
            exit();
        }
        else
        {
            $_SESSION['userId']=$row[0]['user_id'];
            if(isset($_POST['remember']))
            {
                setcookie("name",$firstname,time()+86400,"/");
                setcookie("password",$password,time()+86400,"/");
            }
            
            if($row[0]['type']=="Customer")
            {
                header("Location: ../view/Customer/cusDashboard.php");
                exit();

            }

            if($row[0]['type']=="Admin")
            {
                header("Location: ../view/Admin/adDashboard.php");
                exit();
            }

            if($row[0]['type']=="DeliveryMan")
            {
                header("Location: ../view/DeliveryMan/deliDashboard.php");
                exit();
            }
            
        }

}
?>

