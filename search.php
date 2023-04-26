<!DOCTYPE html>
<html>
<head>
	<title>Recipe Results</title>
</head>
<body>
	<h1>Recipe Results</h1>
	<?php
		$ingredients = $_GET['ingredients'];
        $time = $_GET['cook-time'];

        $url = 'https://api.edamam.com/api/recipes/v2?type=public&q=' . $ingredients . '&app_id=fc85d53b&app_key=89554f4f6d55aed33f9dc9b5327f008d&time=' . $time . '&imageSize=REGULAR';


		$response = file_get_contents($url);

		$json_object = json_decode($response, true);

		foreach ($json_object['hits'] as $hit) {
			$label = $hit['recipe']['label'];
			echo $label . '<br>';
			echo '<a href="' . $hit['recipe']['url']  . '">Get Recipe </a> <br>';

			$img = $hit['recipe']['images']['REGULAR'];
			$img_url = $img['url'];
			$img_w = $img['width'];
			$img_h = $img['height'];

			echo '<img src="' . $img_url . '" width=' . $img_w . ' height=' . $img_h . '> <br>';
			

			foreach ($hit['recipe']['ingredientLines'] as $ing) {
				echo $ing . '<br>';
			}
			echo '<br>';
		}
	?>
</body>
</html>