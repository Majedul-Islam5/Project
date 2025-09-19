<?php
session_start();
include_once('../../model/model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();

if (isset($_GET['p_id'])) {
    $p_id = intval($_GET['p_id']);
    $userId = $_SESSION['userId'];

    
    if (!$model->isProductInCart($userId, $p_id)) {
        $model->addToCart($userId, $p_id);
    }

    header("Location: ../../view/Customer/cusDashboard.php");
    exit();
}
?>
