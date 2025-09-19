<?php
    include_once('../../controller/Admin/userController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Information</title>
    <link rel="stylesheet" href="/Project/CSS/customerInfo.css">
</head>
<body>
<div class="main-content">
    <header>
        <a href="adDashboard.php"><h2>ALIDADA</h2></a>
        <nav>

            <a href="adAddProduct.php">Add Product</a>
            <a href="adProfile.php">Profile</a>
            <a href="../../controller/logout.php">Log Out</a>
        </nav>
    </header>

    <hr>

    <table>
        <tr>
            <th>User Name</th>
            <th>User Type</th>
            <th>Address</th>
            <th>Email</th>
            <th>Number</th>
            <th></th>
        </tr>

        <?php if(!empty($users)): ?>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo ($user['user_name']); ?></td>
                    <td><?php echo ($user['type']); ?></td>
                    <td><?php echo ($user['address']); ?></td>
                    <td><?php echo ($user['email']); ?></td>
                    <td><?php echo ($user['nid']); ?></td>
                    <td>
                        <a href="../../controller/Admin/userController.php?delete_id=<?php echo $user['user_id']; ?>" >
                           <button type="button" class="button">Delete</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">No users found</td>
            </tr>
        <?php endif; ?>
    </table>

    <footer>
        <hr>
        <p>Copyright &copy; All rights reserved by ALIDADA</p>
    </footer>
</div>
</body>
</html>
