<?php
session_start();
include_once('../../model/model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Customer/Login.php");
    exit();
}

$model = new Model();
$userId = $_SESSION['userId'];


$orders = $model->getUserOrders($userId);
$address = $model->getUserAddress($userId);


?>
