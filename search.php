<!DOCTYPE html>
<html>
<head>
	<title>Recipe Results</title>
	<link rel="stylesheet" type="text/css" href="header.css" />
	<link rel="stylesheet" type="text/css" href="RecipeForm.css" />
</head>
<style> 
	@import url("https://fonts.googleapis.com/css?family=Lato");

	body {
	font-family: "Lato", sans-serif;
	background-color: #c25b5b;
	margin: 0;
	}

	h1 {
	text-align: center;
	color: white;
	font-weight: bolder;
	}

	/* recipe container */
	#recipe-container {
	display: flex;
	flex-direction: column;
	align-items: center;
	}

	/* recipe */
	.recipe {
	margin: 20px;
	padding: 20px;
	border-radius: 5px;
	width: 600px;
	background-color: white;
	}

	/* recipe name */
	.recipe h2 {
	margin-top: 0;
	font-size: 30px;
	font-weight: bolder;
	}

	/* link */
	.recipe a {
	font-size: large;
	font-weight: bolder;
	}

	/* image */
	.recipe img {
	display: block;
	margin: 10px auto;
	/* max-width: 90%; */
	/* height: auto; */
	border-radius: 5px;
	padding: 10px;
	}

	/* ingredients */
	.recipe ul {
	list-style: none;
	margin-top: 0;
	padding: 0;
	}

	/* space between ingredients */
	.recipe ul li {
	margin-bottom: 8px;
	}

	/* recipe time and ingredients title */
	.recipe p {
	display: block;
	margin-top: 20px;
	font-size: 20px;
	font-weight: bolder;
	}

	/* buy ingredients button */
	.recipe button {
	display: inline-block;
	background-color: #7aa874;
	border: none;
	color: white;
	padding: 12px 24px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
	margin: 5px 0 15px 35%;
	border-radius: 5px;
	cursor: pointer;
	}

	.recipe button:hover {
	background-color: #539165;
	}

</style>

<body>
	<div class="container">
      <a href="HomePage.html">
        <img src="images/logo.png" alt="logo" class="logo" />
      </a>
      <h1 style="color: #c25b5b;">Meal Match</h1>
      <div class="header_container">
        <a href="AboutPage.html">About Us</a>
        <a href="ContactPge.html">Contact Us</a>
        <a href="LoginPage.html">Login</a>
        <a href="CheckoutPage.html">
          <img src="images/cart-icon.png" alt="cart" width="50" height="45" />
        </a>
      </div>
    </div>

	<br> <br>
	<div class="form-container">
		<form action="search.php" method="get">
		<label for="ingredients">Ingredients:</label>
		<input type="text" name="ingredients" id="ingredients" />
		<label for="cook-time">Preferred Cook Time (mins):</label>
		<input
			type="number"
			name="cook-time"
			id="cook-time"
			min="1"
			max="120"
			step="1"
		/>
		<div id="submit_button">
			<button type="submit">Search</button>
		</div>
		</form>
	</div>

	<br> <br> 

	<h1 style="margin-top: 20px;">Recipes</h1>
	<br> 
	<?php
		$ingredients_get = $_GET['ingredients'];
		$ingredients = urlencode($ingredients_get);
        $time = $_GET['cook-time'];

        $url = 'https://api.edamam.com/api/recipes/v2?type=public&q=' . $ingredients . '&app_id=fc85d53b&app_key=89554f4f6d55aed33f9dc9b5327f008d&time=' . $time . '&imageSize=REGULAR';


		$response = file_get_contents($url);

		$json_object = json_decode($response, true);

		echo '<div id="recipe-container">';
		foreach ($json_object['hits'] as $hit) {
			$label = $hit['recipe']['label'];
			echo '<div class="recipe">';
			echo '<h2>'. $label . '</h2> <br>';
			echo '<a href="' . $hit['recipe']['url']  . '">Get Recipe</a> <br>';

			$img = $hit['recipe']['images']['REGULAR'];
			$img_url = $img['url'];
			$img_w = $img['width'];
			$img_h = $img['height'];

			// echo '<img src="' . $img_url . '"> <br>';
			echo '<img src="' . $img_url . '" width=' . $img_w . ' height=' . $img_h . '> <br>';
			echo '<p> Ingredients </p> <br> <ul>';

			foreach ($hit['recipe']['ingredientLines'] as $ing) {
				echo '<li>' . $ing . '</li>';
			}
			echo '</ul> <br>';

			echo '<button>Buy Meal</button>';
			echo '<button>Save Recipe</button>';

			echo '</div>';
		}

		echo '</div>';
	?>

	<footer>
		<p>&copy; 2023 Meal Match Inc. All Rights Reserved.</p>
	</footer>
</body>
</html>