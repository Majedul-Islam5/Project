<?php
session_start();
include_once('../../model/model.php');

if (!isset($_SESSION['userId'])) {
    header("Location: ../../view/Login.php");
    exit();
}

$model = new Model();

$products = $model->getAllProducts();

function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $p_name   = test_input($_POST['p_name']);
    $price    = test_input($_POST['price']);
    $stock    = test_input($_POST['stock']);
    $category = test_input($_POST['category']);

    $errors = false;

    if (empty($p_name)){
        $_SESSION['p_name'] = "Product name is empty";
        $errors = true;
    } 
    elseif (strlen($p_name) < 4){
        $_SESSION['p_name'] = "Product name must be at least 4 letters";
        $errors = true;
    } 
    else{
        foreach ($products as $row){
            if ($row['p_name'] === $p_name){
                $_SESSION['p_name'] = "This product already exists";
                $errors = true;
            }
        }
    }

    if (empty($price)) {
        $_SESSION['price'] = "Add the price of product";
        $errors = true;
    } 
    elseif (!preg_match("/^-?\d+$/", $price) || $price < 1) {
        $_SESSION['price'] = "Price must be a valid integer greater than 0";
        $errors = true;
    }

    if (empty($stock)) {
        $_SESSION['stock'] = "Add the quantity of product";
        $errors = true;
    } 
    elseif (!preg_match("/^-?\d+$/", $stock) || $stock < 1) {
        $_SESSION['stock'] = "Quantity must be a valid integer greater than 0";
        $errors = true;
    }

    if (empty($category)) {
        $_SESSION['category'] = "Category is empty";
        $errors = true;
    } 
    elseif (!preg_match("/^[a-zA-Z]+$/", $category) || strlen($category) < 2) {
        $_SESSION['category'] = "Category must be at least 2 letters and only letters";
        $errors = true;
    }

    if (!isset($_FILES['product']) || $_FILES['product']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['product'] = "Please upload a product image.";
        $errors = true;
    } 
    else {
        $fileName = basename($_FILES["product"]["name"]);
        $folder = "../../Image/" . $fileName;

        if (file_exists($folder)) {
            $_SESSION['product'] = "This file already exists. Rename your file.";
            $errors = true;
        }

        foreach ($products as $row) {
            if ($row['image_url'] === $fileName) {
                $_SESSION['product'] = "This file already exists. Rename your file.";
                $errors = true;
            }
        }
    }

    if ($errors) {
        header("Location: ../../view/Admin/adAddProduct.php");
        exit();
    } 
    else {
        move_uploaded_file($_FILES["product"]["tmp_name"], $folder);
        $model->addProduct($p_name, $price, $fileName, $stock, $category);
        header("Location: ../../view/Admin/adAddProduct.php");
        exit();
    }
}
