<?php
    include_once('../../controller/Customer/cusDashboardController.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="/Project/CSS/cusDashboard.css">
</head>
<body>
    <header>
        <a href="cusDashboard.php"><h2>ALIDADA</h2></a>
        <nav>
            <a href="viewCart.php">View Cart</a>
            <a href="cusProfile.php">Profile</a>
            <a href="history.php">Order History</a>
            <a href="../../controller/logout.php">Logout</a>
        </nav>
    </header>
    <hr>

    <form class="search-form" action="cusDashboard.php" method="POST">
        <select name="category" onchange="this.form.submit()">
            <option value="" disabled selected>Choose a Product Type</option>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category'] ?>">
                        <?= $cat['category'] ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <button type="submit" name="reset">Reset</button>
    </form>

    <div id="view">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $row): ?>
                <div class="product">
                    <img src="../../Image/<?= $row['image_url'] ?>" alt="notfound"><br>
                    <span><?= $row['p_name'] ?></span><br>
                    <span>BDT <?= $row['price'] ?></span><br>
                    <a href="../../controller/Customer/holdCartController.php?p_id=<?= $row['p_id'] ?>">
                        <button type="button" class="button">Add to Cart</button>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
