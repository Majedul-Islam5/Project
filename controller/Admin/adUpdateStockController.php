<?php
session_start();
include_once('../../model/Model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

if (isset($_GET['p_id'])) {
    $p_id = intval($_GET['p_id']); 

    $model = new Model();

    $products = $model->getAllProducts();
    $currentProduct = null;

    foreach ($products as $prod) {
        if ($prod['p_id'] == $p_id) {
            $currentProduct = $prod;
            break;
        }
    }

    if ($currentProduct) {
        $newStock = $currentProduct['stock'] + 1;
        $model->updateProductStock($p_id, $newStock);
    }

    header("Location: ../../view/Admin/adDashboard.php");
    exit();
}
