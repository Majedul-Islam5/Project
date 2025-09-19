<?php

class Model {
    private $conn;

    public function OpenCon() { 
        $db_server = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "e_commerce_management_system";
        $db = "";

        try {
            $db = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        } catch(mysqli_sql_exception $e) {
            echo "<script>alert('MySQL not started in XAMPP');</script>";
        }

        return $db;
    }

    public function __construct() {
        $this->conn = $this->OpenCon();
    }


    //-> funtion for signup to check if user already exists
    public function userExist($firstname) {
        $sql = "SELECT * FROM user_info WHERE user_name=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $firstname);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    //-> function for usersignup
    public function userCreate($firstname, $password, $userType, $address, $email, $mobile) {
        $stmt = $this->conn->prepare("INSERT INTO user_info (user_name,password,type,address,email,nid) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $firstname, $password, $userType, $address, $email, $mobile);
        return $stmt->execute();
    }

    //-> to get userInformation for display in profile edit
    public function getUserById($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    //-> to change user infromation from edit profile
    public function updateUser($userId, $name, $password, $address, $email, $mobile) {
        $stmt = $this->conn->prepare(
            "UPDATE user_info SET user_name = ?, password = ?, address = ?, email = ?, nid = ? WHERE user_id = ?"
        );
        $stmt->bind_param("sssssi", $name, $password, $address, $email, $mobile, $userId);
        return $stmt->execute();
    }

    //-> to delete user infromation from edit profile for customer (using for admin also)
    public function deleteUser($userId) {

        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL WHERE c_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM customer_order WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM order_info WHERE c_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }


    //-> function to show all products
    public function getAllProducts() {
        $sql = "SELECT * FROM product";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to load products according to category
    public function getProductsByCategory($category) {
        $sql = "SELECT * FROM product WHERE category = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> function to get product categories for filter option
    public function getCategories() {
        $sql = "SELECT DISTINCT category FROM product";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to check if user has already the product in cart
    public function isProductInCart($userId, $p_id) {
        $stmt = $this->conn->prepare("SELECT * FROM customer_order WHERE user_id=? AND p_id=?");
        $stmt->bind_param("ii", $userId, $p_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return count($result) > 0;
    }

    //-> insert the product in customer_order
    public function addToCart($userId, $p_id) {
        $stmt = $this->conn->prepare("INSERT INTO customer_order (p_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $p_id, $userId);
        return $stmt->execute();
    }

    //-> to calculate the total price to show 
    public function getCartItems($userId) {
        $stmt = $this->conn->prepare(
            "SELECT co.p_id, p.p_name, p.price, p.image_url, p.stock
             FROM customer_order co
             JOIN product p ON co.p_id = p.p_id
             WHERE co.user_id = ?"
        );
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to reduce product after purchase
    public function updateProductStock($p_id, $stock) {
        $stmt = $this->conn->prepare("UPDATE product SET stock=? WHERE p_id=?");
        $stmt->bind_param("ii", $stock, $p_id);
        return $stmt->execute();
    }

    //-> customer remove items from cart
    public function removeFromCart($userId, $p_id) {
        $stmt = $this->conn->prepare("DELETE FROM customer_order WHERE user_id=? AND p_id=?");
        $stmt->bind_param("ii", $userId, $p_id);
        return $stmt->execute();
    }

    //-> after user clicks the place order
    public function placeOrder($userId, $total, $delivery) {
        $status = "ordered";
        $cartItems = $this->getCartItems($userId);

        //-> reduce stock for each item ordered placed
        foreach ($cartItems as $item) {
            $newStock = $item['stock'] - 1;
            $this->updateProductStock($item['p_id'], $newStock);
        }

        //-> insert into order_info table
        $stmt = $this->conn->prepare(
            "INSERT INTO order_info (c_id, status, product_cost, delivery_fee) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isdd", $userId, $status, $total, $delivery);
        $stmt->execute();

        //-> clear the customer_order table after order placed
        $stmt = $this->conn->prepare("DELETE FROM customer_order WHERE user_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }

    //-> to show users prevoius order history
    public function getUserOrders($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM order_info WHERE c_id = ? ORDER BY order_datetime DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to get user address to show in history
    public function getUserAddress($userId) {
        $stmt = $this->conn->prepare("SELECT address FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['address'];
    }

    //-> to load customers and deliverymen for admin to delete
    public function getAllUsers() {
        $sql = "SELECT * FROM user_info WHERE type IN ('Customer','DeliveryMan')";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to delete deliveryman for admin
    public function deleteDeliveryMan($user_id) {

        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL WHERE d_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM order_info WHERE d_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM user_info WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    //-> to add a new product
    public function addProduct($p_name, $price, $image_url, $stock, $category) {
        $stmt = $this->conn->prepare("INSERT INTO product (p_name, price, image_url, stock, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsis", $p_name, $price, $image_url, $stock, $category);
        return $stmt->execute();
    }

    //-> to keep different name for products
    public function productExists($p_name) {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE p_name=?");
        $stmt->bind_param("s", $p_name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    //-> deliveryMan to see income
    public function getDeliverymanOrders($d_id) {
        $status="delivered";
        $stmt = $this->conn->prepare(
        "SELECT oi.order_id, oi.c_id, oi.status, oi.product_cost, oi.delivery_fee, oi.order_datetime,
                u.user_name AS customer_name, u.address AS customer_address, u.nid
         FROM order_info oi
         JOIN user_info u ON oi.c_id = u.user_id
         WHERE oi.d_id = ? AND status=? ORDER BY oi.order_datetime DESC"
        );
        $stmt->bind_param("is", $d_id,$status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> deliveryMan to see accepted orders
    public function getDeliverymanAcceptedOrders($d_id) {
        $status="accepted";
        $stmt = $this->conn->prepare(
        "SELECT oi.order_id, oi.c_id, oi.status, oi.product_cost, oi.delivery_fee, oi.order_datetime,
                u.user_name AS customer_name, u.address AS customer_address, u.nid
         FROM order_info oi
         JOIN user_info u ON oi.c_id = u.user_id
         WHERE oi.d_id = ? AND status=? ORDER BY oi.order_datetime DESC"
        );
        $stmt->bind_param("is", $d_id,$status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to know which orders have no deliveryman
    public function getPendingOrders() {
        $result = $this->conn->query("SELECT * FROM order_info WHERE d_id IS NULL");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //-> to show orders in deliveryDashboard
    public function getPendingOrderDetails() {
        $sql = "SELECT order_info.order_id, order_info.product_cost, order_info.delivery_fee, user_info.user_name, user_info.address, user_info.nid 
                FROM user_info 
                INNER JOIN order_info ON user_info.user_id = order_info.c_id 
                WHERE order_info.d_id IS NULL";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     //-> for deliveryman to accept a order
    public function acceptOrder($order_id, $deliveryman_id) {
        $status = "accepted";
        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=?, status=? WHERE order_id=?");
        $stmt->bind_param("isi", $deliveryman_id, $status, $order_id);
        return $stmt->execute();
    }

    //-> delete the deliveryman account
    public function deleteDeliverymanProfile($user_id) {
        $status = "received";
        $statusText = "accepted";
        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL WHERE d_id=? AND status=?");
        $stmt->bind_param("is", $user_id,$status);
        $stmt->execute();

        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL, status='ordered' WHERE d_id=? AND status=?");
        $stmt->bind_param("is", $user_id,$statusText);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM user_info WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    //-> deliveryman to confirm product delivery
    public function updateOrderStatus($order_id, $status) {
        $stmt = $this->conn->prepare("UPDATE order_info SET status=? WHERE order_id=?");
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

    //-> deliveryman to cancel a product delivery
    public function cancelOrder($order_id) {
    $stmt = $this->conn->prepare("UPDATE order_info SET status='ordered', d_id=NULL WHERE order_id=?");
    $stmt->bind_param("i", $order_id);
    return $stmt->execute();
}




}

?>
