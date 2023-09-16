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
    $error_messages = array();
    function sanitizeInput($input)
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    $error_messages = [];
    if (isset($_POST['checkout'])) {
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
        $productcode = isset($_POST['product-code']) ? sanitizeInput($_POST['product-code']) : '';
        $secureCreditCard = '';

        if (!$fname) {
            $error_messages['firstname'] = "Invalid first name.";
        }
        if (!$lname) {
            $error_messages['lastname'] = "Invalid last name.";
        }
        if (!$email) {
            $error_messages['email'] = "Invalid email.";
        }
        if (!$street) {
            $error_messages['street'] = "Invalid street name.";
        }
        if (!$town) {
            $error_messages['town'] = "Invalid town.";
        }
        if (!$state) {
            $error_messages['State'] = "Invalid State.";
        }
        if (!$postcode) {
            $error_messages['postcode'] = "Invalid postcode";
        }
        if (!$phonenum) {
            $error_messages['phonenum'] = "Invalid phonenum";
        }
        if (!$preferredContact) {
            $error_messages['Preferred'] = "Invalid Preferred";
        }
        if (!$quantity) {
            $error_messages['quantity'] = "Invalid quantity";
        }
        if (!$price) {
            $error_messages['price'] = "Invalid price";
        }
        if (!$comments) {
            $error_messages['Comments'] = "Invalid Comments";
        }
    }

?>
     <main>
        <section>
        <div class="SectionClass">
        <form id="paymentForm" action="process_order.php" method="post" class="SectionClass">
            <label for="first-name">First Name:</label>
            <input type="text" id="first-name" name="firstname" maxlength="25" pattern="[A-Za-z]+" value="<?php echo $fname; ?>" /><br /><br />
            <?php if (isset($error_messages['firstname'])) echo '<p style="color: red;">' . $error_messages['firstname'] . '</p>'; ?>
            <label for="last-name">Last Name:</label>
            <input type="text" id="last-name" name="lastname" maxlength="25" pattern="[A-Za-z]+" value="<?php echo $lname; ?>"/><br /><br />
            <?php if (isset($error_messages['lastname'])) echo '<p style="color: red;">' . $error_messages['lastname'] . '</p>'; ?>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>"/> <br/><br/>
            <?php if (isset($error_messages['email'])) echo '<p style="color: red;">' . $error_messages['email'] . '</p>'; ?>
            <label>Address:</label><br />
            <label for="street-address">Street Address:</label>
            <input type="text" id="street-address" name="street" maxlength="40" value="<?php echo $street; ?>"/><br /><br />
            <?php if (isset($error_messages['street'])) echo '<p style="color: red;">' . $error_messages['street'] . '</p>'; ?>
            <label for="suburb-town">Town:</label>
            <input type="text" id="suburb-town" name="town" maxlength="25" value="<?php echo $town; ?>"/><br /><br />
            <?php if (isset($error_messages['town'])) echo '<p style="color: red;">' . $error_messages['town'] . '</p>'; ?>
            <label for="state">State:</label>
            <select id="state" name="State">
            <option value="VIC" <?php if ($state == 'VIC') echo 'selected'; ?>>VIC</option>
                <option value="NSW" <?php if ($state == 'NSW') echo 'selected'; ?>>NSW</option>
                <option value="QLD" <?php if ($state == 'QLD') echo 'selected'; ?>>QLD</option>
                <option value="NT" <?php if ($state == 'NT') echo 'selected'; ?>>NT</option>
                <option value="WA" <?php if ($state == 'WA') echo 'selected'; ?>>WA</option>
            </select><br /><br />
            <label for="postcode">Postcode:</label>
            <input type="text" id="postcode" name="postcode" minlength="4" maxlength="4" pattern="\d{4}" value="<?php echo $postcode; ?>"/>
            <?php if (isset($error_messages['postcode'])) echo '<p style="color: red;">' . $error_messages['postcode'] . '</p>'; ?>
            <br /><br />
            <hr>

            <br /><br />
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phonenum" maxlength="10" placeholder="e.g. 0477677741" value="<?php echo $phonenum; ?>" />
            <?php if (isset($error_messages['phonenum'])) echo '<p style="color: red;">' . $error_messages['phonenum'] . '</p>'; ?>
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
                <option value="5"<?php if ($product == 'Bike Ride - $5 per Kilometer') echo 'selected'; ?>>Bike Ride - $5 per Kilometer</option>
                <option value="20"<?php if ($product == 'Car Ride - $20 per Kilometer') echo 'selected'; ?>>Car Ride - $20 per Kilometer</option>
                <option value="10"<?php if ($product == 'Bus Ride - $10 Per Kilometer') echo 'selected'; ?>>Bus Ride - $10 Per Kilometer</option>
                <option value="100"<?php if ($product == 'Air Plane - $100 Per Hour') echo 'selected'; ?>>Air Plane - $100 Per Hour</option>
                <option value="120"<?php if ($product == 'Helicopter - $120 Per Hour') echo 'selected'; ?>>Helicopter - $120 Per Hour</option>
                <option value="150"<?php if ($product == 'Business Class Plane - $150 Per Hour') echo 'selected'; ?>>Business Class Plane - $150 Per Hour</option>
                <option value="800"<?php if ($product == 'Cruise Ship - $800 Per Hour') echo 'selected'; ?>>Cruise Ship - $800 Per Hour</option>
                <option value="500"<?php if ($product == 'Submarine - $500 Per Hour') echo 'selected'; ?>>Submarine - $500 Per Hour</option>
                <option value="700"<?php if ($product == 'Sailing ship - $700 Per Hour') echo 'selected'; ?>>Sailing ship - $700 Per Hour</option>
            </select>
            <br /><br />
            <label for="price">Price</label>
            <input type="text" id="price" name="price" value="<?php echo $price; ?>"/>
            <br /><br />
            <label for="qty">Quantity</label>
            <input type="number" min="1" value="1" id="qty" name="qunatity" value="<?php echo $quantity; ?>"/>
            <br /><br />

            <hr>
            <br /><br />
            <label for="product-name">Product Name:</label>
            <input type="text" id="productname" name="productname"value="<?php echo $product; ?>" />
            <br /><br />
            <label for="product-code">Product Code:</label>
            <input type="text" id="productcode" name="productcode" value="<?php echo $productcode; ?>"/>
            <br /><br />
            <label for="enquiry-details">Enquiry Details:</label>
            <textarea id="enquiry-details" name="Comments" rows="5" value="<?php echo $comments; ?>"></textarea>
            <br /><br />
            <button type="submit" value="Resubmit" name="resubmit">Resubmit</button>
            </form>
        </div>
      </section>
    </main>

    <?php include('footer.inc'); ?>

</body>

</html>