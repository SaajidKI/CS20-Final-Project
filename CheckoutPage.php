<?php
	session_start();
	include "config.php";

	if (!isset($_SESSION["user_id"])) {
		header("Location: l4.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<link rel="stylesheet" type="text/css" href="header.css" />
	<link rel="stylesheet" type="text/css" href="CheckoutPage.css" />
</head>

<body>
<div class="container">
      <a href="HomePage.html">
        <img src="images/logo.png" alt="logo" class="logo" />
      </a>
      <h1 style="color: #c25b5b;">Meal Match</h1>
      <div class="header_container">
        <a href="AboutPage.html">About Us</a>
        <a href="ContactPage.html">Contact Us</a>
		<a href="FavoritesPage.php">Favorites</a>
        <a href="CheckoutPage.php">
          <img src="images/cart-icon.png" alt="cart" width="50" height="45" />
        </a>
      </div>
    </div>

	<br> <br>

  <h1 style="margin-top: 20px;">Checkout</h1>

    <table>
      <colgroup>
        <col span="1" style="width: 77%" />
        <col span="1" style="width: 18%" />
        <col span="1" style="width: 5%" />
        <col span="1" style="width: 0%" />
      </colgroup>
	<?php 

        $servername = 'localhost';
        $username = "uladm0eoqjfqm";
        $password = "hqiv4ygh9gw5";
        $dbname = 'dbdjja4azcjgpf';

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        function fetch_checkout_data($conn) {
            $sql = "SELECT * FROM checkout WHERE user_id = " . $_SESSION["user_id"];
            $result = $conn->query($sql);
            return $result;
        }

        $checkout_data = fetch_checkout_data($conn);
        $items = 0;
        while ($row = $checkout_data->fetch_assoc()) {
            echo '<tr>';
            echo '<td>';
            echo '<h2> ' . $row["recipe_name"] . ' </h1> <br>';
            // echo $row["image_url"] ;
            echo '<img src="'. $row["image_url"] . ' class="item-image"">' . $row["recipe_name"] . '<br>';
            echo '<td>$20.00</td>';
            echo '<td> <div class="remove-button">';
            echo '<form action="CheckoutPage.php" method="POST">';
            echo '<button type="submit" name="rem' . $items . '">Remove</button>';
            echo '</form>';
            echo '</div>';
            echo '</td>';
            echo "</tr>";
            $items++;
        } 

        $subtotal = $items * 20;

        echo '<div id="subtotal">Subtotal: $' . $subtotal . '.00 </div>';
	
	?>
  </table>

  <?php
        for ($i = 0; $i < 50; $i++) {
            $rem_fun_call='rem' . $i;
            if (isset($_POST[$rem_fun_call])) {
              // Call the function to add the JSON object to the database
              remFromDatabase($i);
            }
        }


		function remFromDatabase($button_id) {

			$servername = 'localhost';
			$username = "uladm0eoqjfqm";
			$password = "hqiv4ygh9gw5";
			$dbname = 'dbdjja4azcjgpf';
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$remdata = fetch_checkout_data($conn);

			$items = 0; 
			while ($row = $remdata->fetch_assoc()) {
            
				if ($items == $button_id) {	

					$sql = "DELETE from checkout where user_id=". $_SESSION["user_id"] . " AND id=" . $row["id"]; 
					mysqli_query($conn, $sql);
					mysqli_close($conn);

				}
	
				$items++;
			} 

		}


  ?>


</body>

<footer>
		<p>&copy; 2023 Meal Match Inc. All Rights Reserved.</p>
	</footer>
</html>