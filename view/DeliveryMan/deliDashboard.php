<?php
    include_once('../../controller/Deliveryman/deliDashboardController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliveryman Dashboard</title>
    <link rel="stylesheet" href="/Project/CSS/deliDashboard.css">
</head>
<body>
    <div class="main-content">
        <header>
            <a href="deliDashboard.php"><h2>ALIDADA</h2></a>
            <nav>
                <a href="deliDeliveryHistory.php">Delivery History</a>
                <a href="deliDeliveryStatus.php">Delivery Status</a>
                <a href="deliProfile.php">Profile</a>
                <a href="../../controller/logout.php">Log Out</a>
            </nav>
        </header>

        <div class="no-data" style="display: <?= $visi1 ?>;">
            <h1>No Customers order till now to accept</h1>
        </div>

        <div style="display: <?= $visi2 ?>;" class="product">
            <table>
                <tr>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Product Cost</th>
                    <th>Delivery Fee</th>
                    <th style="border:none; background:none;"></th>
                </tr>
                <?php foreach ($cusresult as $row):
                    $order_id = $row['order_id'];
                    $user_name = $row['user_name'];
                    $address = $row['address'];
                    $nid = $row['nid'];
                    $product_cost = $row['product_cost'];
                    $delivery_fee = $row['delivery_fee'];
                ?>
                <tr>
                    <td><?php echo($user_name) ?></td>
                    <td><?php echo( $address) ?></td>
                    <td><?php echo( $nid )?></td>
                    <td>BDT <?php echo($product_cost) ?></td>
                    <td>BDT <?php echo($delivery_fee) ?></td>
                    <td style="border:none;">
                        <a href="../../controller/Deliveryman/deliDashboardController.php?order_id=<?php echo($order_id) ?>">
                            <button type="button" class="button" id="<?php echo($order_id) ?>"> Accept Order</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <footer>
            <hr>
            <p>Copyright &copy; All rights reserved by ALIDADA</p>
        </footer>
    </div>
</body>
</html>
