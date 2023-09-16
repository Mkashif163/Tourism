<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Parampal Singh">
  <title>Tour Agency</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <link rel="stylesheet" type="text/css" href="./styles/enquire.css">
</head>

<body>

<?php include('header.inc'); ?>

  <main>
    <h2>Please Provide your Info</h2>
    <form method="post" action="./process_order.php" id="enquiry-form" name="enquiry-form">
      <br>
      <hr>
      <center>
        <legend>Personal Details</legend>
      </center>
      <br>
      <div class="enquire-fields-marg">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="first-name" maxlength="25" pattern="[A-Za-z]+" /><br /><br />
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="last-name" maxlength="25" pattern="[A-Za-z]+" /><br /><br />
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required /><br /><br />
        <label>Address:</label><br />
        <label for="street-address">Street Address:</label>
        <input type="text" id="street-address" name="street-address" maxlength="40"  /><br /><br />
        <label for="suburb-town">Town:</label>
        <input type="text" id="suburb-town" name="suburb-town" maxlength="25"  /><br /><br />
        <label for="state">State:</label>
        <select id="state" name="state" required>
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
      </div>
      <center>
        <legend>Contact Data</legend>
      </center>

      <br /><br />
      <div class="enquire-fields-marg">
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" maxlength="10" placeholder="e.g. 0477677741"  />
      </div>
      <br /><br />
      <hr>
      <center><label>Prefer to Contact:</label></center>

      <br /><br />
      <div class="enquire-fields-marg">
        <br /><label><input style="width: auto;" type="radio" class="customradio" name="contact-method"
            value="email" />Email</label>
        <label><input style="width: auto;" type="radio" class="customradio" name="contact-method" value="phone"
            checked />Phone</label>
      </div>
      <br /><br />
      <hr>
      <center>
        <legend>Product</legend>
      </center>

      <br /><br />
      <br /><br />
      <div class="enquire-fields-marg">
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
        <input type="number" min="1" value="1" id="qty" name="qty" />
      </div>
      <br /><br />

      <hr>
      <legend>Product Enquiry</legend>
      <div class="enquire-fields-marg">
        <br /><br />
        <label for="product-name">Product Name:</label>
        <input type="text" id="product-name" name="product-name"/>
        <br /><br />
        <label for="product-code">Product Code:</label>
        <input type="text" id="product-code" name="product-code" />
        <br /><br />
        <label for="enquiry-details">Enquiry Details:</label>
        <textarea id="enquiry-details" name="enquiry-details" rows="5" required></textarea>
        <br /><br />
      </div>
      <div class="center-align">
        <button type="submit" value="Submit">Pay Now</button>
        <button type="reset" value="Reset">Reset</button>
      </div>
    </form>
  </main>

  <?php include('footer.inc'); ?>

</body>

</html>