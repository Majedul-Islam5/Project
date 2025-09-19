<?php
    include_once('../../controller/Admin/adDashboardController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/Project/CSS/adDashboard.css">
</head>
<body>
    <div class="main-content">
        <header>
            <a href="adDashboard.php"><h2>ALIDADA</h2></a>
            <nav>
                <a href="userView.php">Customer Information</a>
                <a href="adAddProduct.php">Add Product</a>
                <a href="adProfile.php">Profile</a>
                <a href="../../controller/logout.php">Log Out</a>
            </nav>
        </header>

        <div id="view">
            <?php foreach ($products as $row): ?>
                <div class="product">
                    <img src="/Project/Image/<?php echo($row['image_url']) ?>" alt="notfound"><br>
                    <span><?php echo($row['p_name']) ?></span><br>
                    <span>BDT <?php echo($row['price']) ?></span><br>

                    <?php if ($row['stock'] == 0): ?>
                        <span class="stockout">Stock Out</span><br>
                    <?php else: ?>
                        <span><?php echo($row['stock']) ?> items</span><br>
                    <?php endif; ?>

                    <span>Category: <?php echo($row['category']) ?></span><br>
                    <a href="../../controller/Admin/adUpdateStockController.php?p_id=<?php echo $row['p_id'] ?>">
                        <button type="button" class="button" id="<?php echo $row['p_id']?>">Add Item</button>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <br><br><br>
        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>
