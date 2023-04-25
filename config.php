<?php
$servername = 'localhost';
$username = "uladm0eoqjfqm";
$password = "hqiv4ygh9gw5";
$dbname = 'dbdjja4azcjgpf';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
