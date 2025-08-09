<?php
$host = "localhost";
$username = "uac1gp3zeje8t";
$password = "hk8ilpc7us2e";
$dbname = "dbdlq3ona5inla";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
