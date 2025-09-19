<?php
session_start();
include_once('../../model/Model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();
$userId = $_SESSION['userId'];

$orders = $model->getDeliverymanOrders($userId);

$total = 0;
foreach ($orders as $order) {
    $total += $order['delivery_fee'];
}

?>
