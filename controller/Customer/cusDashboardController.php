<?php
session_start();
include_once('../../model/model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();

if (isset($_POST['category']) && !empty($_POST['category'])) {
    $products = $model->getProductsByCategory($_POST['category']);
} 
else{
    
    $products = $model->getAllProducts();
}

$categories = $model->getCategories();

if (isset($_POST['reset'])) {
    $products = $model->getAllProducts();
    $categories = $model->getCategories();
    unset($_POST['category']);
    unset($_POST['reset']);
    header("Location: ../../view/Customer/cusDashboard.php");
    exit();
}





