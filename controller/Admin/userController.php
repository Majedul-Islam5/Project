<?php
session_start();
include_once('../../model/Model.php');

$model = new Model();

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$users = $model->getAllUsers();

if (isset($_GET['delete_id'])) {
    $user_id = intval($_GET['delete_id']);
    $user = $model->getUserById($user_id);

    if ($user) {
        if ($user['type'] === 'Customer') {
            $model->deleteUser($user_id);
        } elseif ($user['type'] === 'DeliveryMan') {
            $model->deleteDeliveryMan($user_id);
        }
    }

    header("Location: userView.php"); // refresh
    exit();
}



?>
