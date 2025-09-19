<?php
session_start();
include_once('../../model/Model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();
$userId = $_SESSION['userId'];

$userData = $model->getUserById($userId);

$userName = $userData['user_name'] ;
$email    = $userData['email'] ;
$mobile   = $userData['nid'] ;
$address  = $userData['address'] ;
$password = $userData['password'] ;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['action']) && $_POST['action'] === "change") {
        $name = isset($_POST['userName']) ? test_input($_POST['userName']) : '';
        $email = isset($_POST['email']) ? test_input($_POST['email']) : '';
        $mobile = isset($_POST['mobile']) ? test_input($_POST['mobile']) : '';
        $address = isset($_POST['address']) ? test_input($_POST['address']) : '';
        $password = isset($_POST['password']) ? test_input($_POST['password']) : '';

        $errors = false;

        if (empty($name) || strlen($name) < 3) {
            $_SESSION['Name'] = "Name must be at least 3 characters";
            $errors = true;
        } 
        else {
            $existing = $model->userExist($name);
            if (!empty($existing) && $existing[0]['user_id'] != $userId) {
                $_SESSION['Name'] = "Username already taken";
                $errors = true;
            }
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['Email'] = "Enter a valid email";
            $errors = true;
        }

        if (empty($mobile) || strlen($mobile) != 11) {
            $_SESSION['Mobile'] = "Mobile must be 11 digits";
            $errors = true;
        }

        if (empty($address)) {
            $_SESSION['Address'] = "Address cannot be empty";
            $errors = true;
        }

        if (empty($password) || strlen($password) < 8) {
            $_SESSION['Password'] = "Password must be at least 8 characters";
            $errors = true;
        }

        if ($errors) {
            header("Location: ../../view/DeliveryMan/deliProfile.php");
            exit();
        }

        $model->updateUser($userId, $name, $password, $address, $email, $mobile);

        header("Location: ../../view/DeliveryMan/deliProfile.php");
        exit();
        }

    if (isset($_POST['action']) && $_POST['action'] === "delete") {
        $model->deleteDeliverymanProfile($userId);
        session_destroy();
        header("Location: ../../view/Login.php");
        exit();
    }

}

?>


