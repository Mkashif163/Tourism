<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Parampal Singh">
    <title>Tour Agency</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="stylesheet" type="text/css" href="./styles/product.css">
</head>

<?php include('header.inc'); ?>

<body>
    <?php
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
if (!$order_id) {
    echo "Invalid order ID.";
    exit;
}
try {
    $db_host = "localhost";
    $db_name = "parampal";
    $db_user = "root";
    $db_password = "";
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM orders WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        echo "Order not found.";
        exit;
    }
    echo "<h2>Order Receipt</h2>";
    echo "<p><strong>Order ID:</strong> {$order['order_id']}</p>";
    echo "<p><strong>Product:</strong> {$order['product']}</p>";
    echo "<p><strong>Quantity:</strong> {$order['quantity']}</p>";
    echo "<p><strong>Total Cost:</strong> {$order['total_cost']}</p>";
    $masked_credit_card = '**** **** **** ' . substr($order['secure_credit_card'], -4);
    echo "<p><strong>Credit Card:</strong> $masked_credit_card</p>";
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
<a href="manager.php">View All Orders</a>
 
</body>
<?php include('footer.inc'); ?>

</body>

</html>