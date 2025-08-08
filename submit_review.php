<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $trip_id = $_POST['trip_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    
    $stmt = $conn->prepare("INSERT INTO reviews (user_id, trip_id, rating, comment) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $trip_id, $rating, $comment]);
    header("Location: dashboard.php");
}
?>
