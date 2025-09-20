<?php
session_start();
include_once('../../model/model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();
$userId = $_SESSION['userId'];

$cartItems = $model->getCartItems($userId);

$total = 0;
$delivery = 100;
foreach ($cartItems as $item) {
    $total += $item['price'];
    $delivery += 100;
}

if (isset($_POST['button']) && is_numeric($_POST['button'])) {
    $p_id = intval($_POST['button']);
    $model->removeFromCart($userId, $p_id);
    header("Location: viewCart.php");
    exit();
}

if (isset($_POST['button']) && $_POST['button'] === "order") {

    
    if (empty(trim($_POST['cardPayment'])) && empty($_POST['onlinePayment'])) {
        $_SESSION['pay'] = "Select a payment option";
        header("Location: viewCart.php");
        exit();
    }

    foreach ($cartItems as $item) {
        
        $newStock = $item['stock'] - 1;
        $model->updateProductStock($item['p_id'], $newStock);
    }

    $status = "ordered";
    $model->placeOrder($userId, $total, $delivery);


    $_SESSION['order_success'] = true;

    header("Location: viewCart.php");
    exit();
}




