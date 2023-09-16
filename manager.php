<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Parampal Singh">
    <title>Tour Agency</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

  <?php include('header.inc'); ?>

<body>

    <?php

    include 'setting.php';

    try {

        // Establish a database connection
        $db_host = "localhost";
        $db_name = "parampal";
        $db_user = "root";
        $db_password = "";
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to retrieve orders
        $sql = "SELECT * FROM orders";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display the table of orders
        echo "<h2>Order Manager</h2>";
        echo "<table border='1'>";
        echo "<tr><th>#</th><th>Date</th><th>Product</th><th>Cost</th><th>Name</th><th>Status</th></tr>";

        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>{$order['order_id']}</td>";
            echo "<td>{$order['order_date']}</td>";
            echo "<td>{$order['product']}</td>";
            echo "<td>{$order['total_cost']}</td>";
            echo "<td>{$order['fname']} {$order['lname']}</td>";
            echo "<td>{$order['status']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
    ?>

    <!-- Provide options for different queries -->
    <h3>Query Orders:</h3>
    <form action="manager.php" method="get">
        <label for="query">Select query:</label>
        <select id="query" name="query">
            <option value="all">All Orders</option>
            <option value="byname">Orders by Name</option>
            <option value="byproduct">Orders by Product</option>
            <option value="bystatus">Orders by Status</option>
        </select>
        <input type="submit" value="Query">
    </form>

    <?php
    // Handle different queries
    if (isset($_GET['query'])) {
        $query_type = $_GET['query'];

        switch ($query_type) {
            case 'byname':
                // Query orders by customer name
                $customer_name = isset($_GET['customer_name']) ? $_GET['customer_name'] : '';
                if ($customer_name) {
                    $sql = "SELECT * FROM orders WHERE fname LIKE :name OR lname LIKE :name";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':name', "%$customer_name%", PDO::PARAM_STR);
                    $stmt->execute();
                    $filtered_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display filtered orders
                    echo "<h3>Orders by Customer Name: $customer_name</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>#</th><th>Date</th><th>Product</th><th>Cost</th><th>Name</th><th>Status</th></tr>";

                    foreach ($filtered_orders as $order) {
                        echo "<tr>";
                        echo "<td>{$order['order_id']}</td>";
                        echo "<td>{$order['order_date']}</td>";
                        echo "<td>{$order['product']}</td>";
                        echo "<td>{$order['total_cost']}</td>";
                        echo "<td>{$order['fname']} {$order['lname']}</td>";
                        echo "<td>{$order['status']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                break;

            case 'byproduct':
                // Query orders by product
                $product = isset($_GET['product']) ? $_GET['product'] : '';
                if ($product) {
                    $sql = "SELECT * FROM orders WHERE product LIKE :product";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':product', "%$product%", PDO::PARAM_STR);
                    $stmt->execute();
                    $filtered_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display filtered orders
                    echo "<h3>Orders by Product: $product</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>#</th><th>Date</th><th>Product</th><th>Cost</th><th>Name</th><th>Status</th></tr>";

                    foreach ($filtered_orders as $order) {
                        echo "<tr>";
                        echo "<td>{$order['order_id']}</td>";
                        echo "<td>{$order['order_date']}</td>";
                        echo "<td>{$order['product']}</td>";
                        echo "<td>{$order['total_cost']}</td>";
                        echo "<td>{$order['fname']} {$order['lname']}</td>";
                        echo "<td>{$order['status']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                break;

            case 'bystatus':
                // Query orders by status
                $status = isset($_GET['status']) ? $_GET['status'] : '';
                if ($status) {
                    $sql = "SELECT * FROM orders WHERE status = :status";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':status', $status, PDO::PARAM_STR);
                    $stmt->execute();
                    $filtered_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Display filtered orders
                    echo "<h3>Orders by Status: $status</h3>";
                    echo "<table border='1'>";
                    echo "<tr><th>#</th><th>Date</th><th>Product</th><th>Cost</th><th>Name</th><th>Status</th></tr>";

                    foreach ($filtered_orders as $order) {
                        echo "<tr>";
                        echo "<td>{$order['order_id']}</td>";
                        echo "<td>{$order['order_date']}</td>";
                        echo "<td>{$order['product']}</td>";
                        echo "<td>{$order['total_cost']}</td>";
                        echo "<td>{$order['fname']} {$order['lname']}</td>";
                        echo "<td>{$order['status']}</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                break;

            case 'all':
                // Display all orders
                break;
        }
    }
    ?>

    <!-- Link to the receipt page for each order -->
    <h3>View Order Receipt:</h3>
    <form action="receipt.php" method="get">
        <label for="order_id">Enter Order ID:</label>
        <input type="text" id="order_id" name="order_id" required>
        <input type="submit" value="View Receipt">
    </form>
    <?php
    include 'footer.inc';
    ?>
</body>

</html>