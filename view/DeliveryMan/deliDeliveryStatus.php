<?php
    include_once('../../controller/Deliveryman/deliDeliveryStatusController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Status</title>
    <link rel="stylesheet" href="/Project/CSS/deliDeliveryStatus.css">
</head>
<body>
<div class="main-content">
    <header>
        <a href="deliDashboard.php"><h2>ALIDADA</h2></a>
        <nav>
            
            <a href="deliDeliveryHistory.php">Delivery History</a>
            <a href="deliProfile.php">Profile</a>
            <a href="../../controller/logout.php">Log Out</a>
        </nav>
    </header>
    <hr>

    <?php if (empty($acceptedOrders)): ?>
        <div class="no-data">
            <h1>No Orders Accepted Yet</h1>
        </div>
    <?php else: ?>
        <div class="product">
            <table>
                <tr>
                    <th>User Name</th>
                    <th>Address</th>
                    <th>Upload Picture</th>
                    <th>Number</th>
                    <th style="border:none; background:none;"></th>
                </tr>

                <?php foreach ($acceptedOrders as $order): ?>
                    <tr>
                        <form action="deliDeliveryStatus.php" method="POST" enctype="multipart/form-data">
                            <td><?php echo($order['user_name']) ?></td>
                            <td><?php echo($order['address']) ?></td>
                            <td>
                                <input type="file" name="product" class="form_input file-input"><br>
                                <span class="error2">
                                    <?php
                                        if (isset($_SESSION['product'])) 
                                        {
                                            echo $_SESSION['product'];
                                            unset($_SESSION['product']);
                                        }
                                    ?>
                                </span>
                            </td>
                            <td><?php echo($order['nid'] ?? '') ?></td>
                            <td style="border:none;">
                                <button type="submit" class="button" name="accept" value="<?php echo($order['order_id']) ?>">Delivered</button>
                                <button type="submit" class="button" name="cancel" value="<?php echo($order['order_id']) ?>" style="background-color: red; margin-left:12px;">Cancel</button>
                            </td>
                        </form>
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
