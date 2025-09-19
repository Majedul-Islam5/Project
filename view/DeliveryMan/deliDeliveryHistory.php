<?php
    include_once('../../controller/Deliveryman/deliDeliveryHistoryController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliveryman Delivery History</title>
    <link rel="stylesheet" href="/Project/CSS/deliDeliveryHistory.css">
</head>
<body>
    <div class="main-content">
        <header>
            <a href="deliDashboard.php"><h2>ALIDADA</h2></a>
            <nav>
                
                <a href="deliDeliveryStatus.php">Delivery Status</a>
                <a href="deliProfile.php">Profile</a>
                <a href="../../controller/logout.php">Log Out</a>
            </nav>
        </header>

        <hr>

        <?php if (empty($orders)): ?>
            <div class="no-data">
                <h1>Nothing Delivered Yet</h1>
            </div>
        <?php else: ?>
            <div class="product">
                <table>
                    <tr>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Delivery Fee</th>
                    </tr>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo($order['user_name']) ?></td>
                            <td><?php echo($order['address']) ?></td>
                            <td>BDT <?php echo($order['delivery_fee']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td><strong>Total earnings</strong></td>
                        <td>BDT <?= $total ?></td>
                    </tr>
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
