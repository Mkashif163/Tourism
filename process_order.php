<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Parampal Singh">
    <title>Tour Agency</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="stylesheet" type="text/css" href="./styles/payment.css">
    <link rel="stylesheet" type="text/css" href="./styles/enquire.css">
</head>

<body>

<?php include('header.inc'); 

include 'setting.php';

function sanitizeInput($input)
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

    if(isset($_POST['resubmit'])){
        $fname = isset($_POST['firstname']) ? sanitizeInput($_POST['firstname']) : '';
        $lname = isset($_POST['lastname']) ? sanitizeInput($_POST['lastname']) : '';
        $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
        $street = isset($_POST['street']) ? sanitizeInput($_POST['street']) : '';
        $town = isset($_POST['town']) ? sanitizeInput($_POST['town']) : '';
        $state = isset($_POST['State']) ? sanitizeInput($_POST['State']) : '';
        $postcode = isset($_POST['postcode']) ? sanitizeInput($_POST['postcode']) : '';
        $phonenum = isset($_POST['phonenum']) ? sanitizeInput($_POST['phonenum']) : '';
        $preferredContact = isset($_POST['Preferred']) ? sanitizeInput($_POST['Preferred']) : '';
        $product = isset($_POST['productname']) ? sanitizeInput($_POST['productname']) : '';
        $quantity = isset($_POST['quantity']) ? sanitizeInput($_POST['quantity']) : '';
        $price = isset($_POST['price']) ? sanitizeInput($_POST['price']) : '';
        $comments = isset($_POST['Comments']) ? sanitizeInput($_POST['Comments']) : '';

        $totalCost = intval($price) * intval($quantity);
        $secureCreditCard = substr($cardNumber, -4);

        $db_host = "localhost";
        $db_name = "parampal";
        $db_user = "root";
        $db_password = "";

        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $tableCheckSQL = "SHOW TABLES LIKE 'orders'";
        $tableExists = $pdo->query($tableCheckSQL)->rowCount() > 0;

        if (!$tableExists) {
            $createTableSQL = "CREATE TABLE orders (
                order_id INT AUTO_INCREMENT PRIMARY KEY,
                order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                fname VARCHAR(255) NOT NULL,
                lname VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                street VARCHAR(255) NOT NULL,
                town VARCHAR(255) NOT NULL,
                state VARCHAR(255) NOT NULL,
                postcode VARCHAR(10) NOT NULL,
                phonenum VARCHAR(15) NOT NULL,
                preferred_contact VARCHAR(255) NOT NULL,
                product VARCHAR(255) NOT NULL,
                quantity INT NOT NULL,
                price INT NOT NULL,
                comments TEXT,
                total_cost INT NOT NULL,
                secure_credit_card VARCHAR(4) NOT NULL,
                status VARCHAR(255) NOT NULL
            )";

            $pdo->exec($createTableSQL);
        }
        $insertOrderSQL = "INSERT INTO orders (fname, lname, email, street, town, state, postcode, phonenum, preferred_contact, product, quantity,price, comments, total_cost, secure_credit_card, status)
        VALUES (:fname, :lname, :email, :street, :town, :state, :postcode, :phonenum, :preferred_contact, :product, :quantity,:price, :comments, :total_cost, :secure_credit_card, 'pending')";
        $insertOrderStmt = $pdo->prepare($insertOrderSQL);
        $insertOrderStmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':lname', $lname, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':street', $street, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':town', $town, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':state', $state, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':phonenum', $phonenum, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':preferred_contact', $preferredContact, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':product', $product, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $insertOrderStmt->bindParam(':price', $price, PDO::PARAM_INT);
        $insertOrderStmt->bindParam(':comments', $comments, PDO::PARAM_STR);
        $insertOrderStmt->bindParam(':total_cost', $totalCost, PDO::PARAM_INT);
        $insertOrderStmt->bindParam(':secure_credit_card', $secureCreditCard, PDO::PARAM_STR);
        $insertOrderStmt->execute();
        $order_id = $pdo->lastInsertId();
        header("Location: receipt.php?order_id=$order_id");
        exit;
    }

?>

   
    <br>
    <br>
    <main>
        <section>
        <div class="SectionClass">
        <form id="paymentForm" action="fix_order.php" method="post">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="firstname" maxlength="25" pattern="[A-Za-z]+" /><br /><br />
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="lastname" maxlength="25" pattern="[A-Za-z]+" /><br /><br />
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" /><br /><br />
            <label>Address:</label><br />
            <label for="street-address">Street Address:</label>
            <input type="text" id="street-address" name="street" maxlength="40" /><br /><br />
            <label for="suburb-town">Town:</label>
            <input type="text" id="suburb-town" name="town" maxlength="25" /><br /><br />
            <label for="state">State:</label>
            <select id="state" name="State">
                <option value="">Please select</option>
                <option value="VIC">VIC</option>
                <option value="NSW">NSW</option>
                <option value="QLD">QLD</option>
                <option value="NT">NT</option>
                <option value="WA">WA</option>
            </select><br /><br />
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" name="postcode" minlength="4" maxlength="4" pattern="\d{4}" />
            <br /><br />
            <hr>

            <br /><br />
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phonenum" maxlength="10" placeholder="e.g. 0477677741" />
            <br /><br />
            <hr>

            <br /><br />
            <br /><label><input style="width: auto;" type="radio" class="customradio" name="Preferred" value="email" />Email</label>
            <label><input style="width: auto;" type="radio" class="customradio" name="Preferred" value="phone" checked />Phone</label>
            <br /><br />
            <hr>

            <br /><br />
            <br /><br />
            <label for="product">Select product or service</label>
            <select name="product" id="product">
                <option value="0"> - Please Select - </option>
                <option value="5">Bike Ride - $5 per Kilometer</option>
                <option value="20">Car Ride - $20 per Kilometer</option>
                <option value="10">Bus Ride - $10 Per Kilometer</option>
                <option value="100">Air Plane - $100 Per Hour</option>
                <option value="120">Helicopter - $120 Per Hour</option>
                <option value="150">Business Class Plane - $150 Per Hour</option>
                <option value="800">Cruise Ship - $800 Per Hour</option>
                <option value="500">Submarine - $500 Per Hour</option>
                <option value="700">Sailing ship - $700 Per Hour</option>
            </select>
            <br /><br />
            <label for="price">Price</label>
            <input type="text" id="price" name="price" />
            <br /><br />
            <label for="qty">Quantity</label>
            <input type="number" min="1" value="1" id="qty" name="qunatity" />
            <br /><br />

            <hr>
            <br /><br />
            <label for="product-name">Product Name:</label>
            <input type="text" id="productname" name="productname" />
            <br /><br />
            <label for="product-code">Product Code:</label>
            <input type="text" id="productcode" name="productcode" />
            <br /><br />
            <label for="enquiry-details">Enquiry Details:</label>
            <textarea id="enquiry-details" name="Comments" rows="5" ></textarea>
            <br /><br />
            
                <label for="cardType">Card Type:</label>
                <select id="cardType" name="cardType">
                    <option value="">-- Select a card type --</option>
                    <option value="Visa">Visa</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="American Express">American Express</option>
                </select>
                <span id="cardTypeError" class="error"></span>
                <br>
        
                <label for="cardName">Name on Card:</label>
                <input type="text" id="cardName" name="cardName" maxlength="40">
                <span id="cardNameError" class="error"></span>
                <br>
        
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber">
                <span id="cardNumberError" class="error"></span>
                <br>
        
                <label for="expiryDate">Expiry Date:</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="mm-yy">
                <span id="expiryDateError" class="error"></span>
                <br>
        
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" maxlength="3">
                <span id="cvvError" class="error"></span>
                <br>
        
                <input style="background-color: green;" type="submit" value="Check Out" name="checkout">
                <button style="background-color: red;" onclick="cancelOrder()">Cancel Order</button>
            </form>
        </div>
      </section>
    </main>
  <br>
  <br>
  
  <?php include('footer.inc'); ?>

</body>

</html>