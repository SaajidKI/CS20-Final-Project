<?php
session_start();
include "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$saved_searches = [];

$sql = "SELECT search_query, search_date FROM searches WHERE user_id = ? ORDER BY search_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$stmt->bind_result($search_query, $search_date);

while ($stmt->fetch()) {
    $saved_searches[] = ["search_query" => $search_query, "search_date" => $search_date];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Saved Searches</title>
</head>
<body>
    <h1>Saved Searches</h1>
    <table>
        <thead>
            <tr>
                <th>Search Query</th>
                <th>Search Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($saved_searches as $search): ?>
                <tr>
                    <td><?php echo htmlspecialchars($search["search_query"]); ?></td>
                    <td><?php echo htmlspecialchars($search["search_date"]); ?></td>
                    <td><a href="search_recipes.php?query=<?php echo urlencode($search["search_query"]); ?>">View Results</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="search_recipes.php">Go back to search recipes</a>
</body>
</html>
