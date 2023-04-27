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
    $sql = "SELECT * FROM checkout";
    $result = $conn->query($sql);
    return $result;
}

function fetch_saved_recipes_data($conn) {
    $sql = "SELECT * FROM saved_recipes";
    $result = $conn->query($sql);
    return $result;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Tables</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Checkout Table</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Recipe Name</th>
            <th>Recipe URL</th>
        </tr>
        <?php
        $checkout_data = fetch_checkout_data($conn);
        while ($row = $checkout_data->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["recipe_name"] . "</td>";
            echo "<td>" . $row["recipe_url"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Saved Recipes Table</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Recipe Name</th>
            <th>Recipe URL</th>
        </tr>
        <?php
        $saved_recipes_data = fetch_saved_recipes_data($conn);
        while ($row = $saved_recipes_data->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["recipe_name"] . "</td>";
            echo "<td>" . $row["recipe_url"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
