<?php
    include_once('../../controller/Customer/viewCartController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Cart</title>
    <link rel="stylesheet" href="/Project/CSS/viewCart.css">
</head>
<body>
<div class="main-content">
    <header>
        <a href="cusDashboard.php"><h2>ALIDADA</h2></a>
        <nav>
            
            <a href="cusProfile.php">Profile</a>
            <a href="history.php">Order History</a>
            <a href="../../controller/logout.php">Log Out</a>
        </nav>
    </header>
    <hr>

    <?php if (empty($cartItems)): ?>
        <div class="no-data">
            <h1>No Data to Show</h1>
        </div>
    <?php else: ?>
        <div class="product">
            <form action="viewCart.php" method="POST">
                <table>
                    <?php foreach($cartItems as $row): ?>
                    <tr>
                        <td><img src="/Project/Image/<?= $row['image_url'] ?>" alt="notfound" width="120" height="120"></td>
                        <td><?= $row['p_name'] ?></td>
                        <td>BDT <?= $row['price'] ?></td>
                        <td>
                            <button type="submit" name="button" value="<?= $row['p_id'] ?>">Remove</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>Subtotal: </td><td></td><td>BDT <?= $total ?></td><td></td>
                    </tr>
                    <tr>
                        <td>Shipping: </td><td></td><td>BDT <?= $delivery ?></td><td></td>
                    </tr>
                    <tr>
                        <td>Total: </td><td></td><td>BDT <?= $total + $delivery ?></td><td></td>
                    </tr>
                </table>

                <select id="paymentMethod" onchange="showPaymentOptions()">
                    <option value="" disabled selected>Select Payment Method</option>
                    <option value="online">Mobile Banking</option>
                    <option value="card">Card</option>
                </select>
                <span id="errorMessage">
                    <?php
                        if (isset($_SESSION['pay'])) {
                            echo $_SESSION['pay'];
                            unset($_SESSION['pay']);
                        }
                    ?>
                </span>

                <div id="onlineOptions" class="hidden">
                    <p>Select one:</p>
                    <label class="payment-option">
                        <input type="radio" name="onlinePayment" value="bkash">
                        <img src="/Project/Image/bkash.png" alt="bKash">
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="onlinePayment" value="nagad">
                        <img src="/Project/Image/nagad.png" alt="Nagad">
                    </label>
                </div>

                <div id="cardOptions" class="hidden">
                    <p>Enter Card/Account Number:</p>
                    <input type="text" name="cardPayment" placeholder="Enter Account Number">
                </div>
                <br>

                <input type="hidden" name="total" value="<?= $total ?>">
                <input type="hidden" name="delivery" value="<?= $delivery ?>">

                <button type="submit" name="button" value="order">Place Order</button>
            </form>
        </div>
    <?php endif; ?>

    <script src="/Project/JS/payment.js"></script>

    <footer>
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</div>
</body>
</html>
