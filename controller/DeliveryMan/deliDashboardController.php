<?php
session_start();
include_once('../../model/model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();

$pendingOrders = $model->getPendingOrders();


if (count($pendingOrders) == 0) {
    $visi1 = "block";
    $visi2 = "none";
    $cusresult = [];
} 
else {
    $visi1 = "none";
    $visi2 = "block";
    $cusresult = $model->getPendingOrderDetails();
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $deliveryman_id = $_SESSION['userId'];

    $model = new Model();
    $model->acceptOrder($order_id, $deliveryman_id);

    header("Location: ../../view/Deliveryman/deliDashboard.php");
    exit();
}

?>
