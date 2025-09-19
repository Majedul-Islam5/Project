<?php
    include_once('../../controller/Customer/historyController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="/Project/CSS/viewCart.css">
</head>
<body>
<div class="main-content">
    <header>
        <a href="cusDashboard.php"><h2>ALIDADA</h2></a>
        <nav>
            
            <a href="viewCart.php">View Cart</a>
            <a href="cusProfile.php">Profile</a>
            <a href="../../controller/logout.php">Logout</a>
        </nav>
    </header>
    <hr>

    <?php if (empty($orders)): ?>
        <div class="no-data">
            <h1>No purchase history</h1>
        </div>
    <?php else: ?>
        <div class="product">
            <table>
                <tr>
                    <th>Reference Number</th>
                    <th>Order Date and Time</th>
                    <th>Order Status</th>
                    <th>Delivery Address</th>
                    <th>Total Amount Paid</th>
                </tr>
                <?php foreach ($orders as $row): 
                    $order_id = $row['order_id'];
                    $prefix = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                    $suffix = str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT);
                    $reference = $prefix . str_pad($order_id, 2, '0', STR_PAD_LEFT) . $suffix;
                    if($row['status']==="ordered")
                    {
                        $statusText="Product Ordered";
                    }
                    if($row['status']==="delivered")
                    {
                        $statusText="Product Received";
                    }
                    if($row['status']==="accepted")
                    {
                        $statusText="Out for Delivery";
                    }
                ?>
                <tr>
                    <td><?php echo($reference) ?></td>
                    <td><?php echo($row['order_datetime']) ?></td>
                    <td><?php echo($statusText) ?></td>
                    <td><?php echo($address) ?></td>
                    <td>BDT <?php echo($row['product_cost'] + $row['delivery_fee']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>

    <footer>
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</div>
</body>
</html>
