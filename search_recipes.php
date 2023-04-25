<?php
session_start();
include "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST["search_query"];

    // Save the search query to the searches table
    $sql = "INSERT INTO searches (user_id, search_query) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $_SESSION["user_id"], $search_query);
    $result = $stmt->execute();

    if ($result) {
        // Perform the recipe search and display the results
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipe Search</title>
</head>
<body>
    <h1>Recipe Search</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="search_query" placeholder="Search for recipes..." required>
        <input type="submit" value="Search">
    </form>
    <!-- Display the search results here -->
</body>
</html>
