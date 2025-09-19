<?php
session_start();
include_once('../../model/Model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();
$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['accept'])) {

        $order_id = $_POST['accept'];
        if (!isset($_FILES['product']) || $_FILES['product']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['product'] = "Please upload an image to confirm delivery.";
            header("Location: ../../view/DeliveryMan/deliDeliveryStatus.php");
            exit();
        }

        $model->updateOrderStatus($order_id, 'delivered');

        header("Location: ../../view/DeliveryMan/deliDeliveryStatus.php");
        exit();
    }

    if (isset($_POST['cancel'])) {
        $order_id = $_POST['cancel'];

        $model->cancelOrder($order_id);

        header("Location: ../../view/DeliveryMan/deliDeliveryStatus.php");
        exit();
    }
}

$acceptedOrders = $model->getDeliverymanAcceptedOrders($userId);

?>
