<?php
// Connection details
$host = "localhost";
$user = "Nyabunyana";
$pass = "esther";
$database = "virtual_diversity_and_inclusion_training_platform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>