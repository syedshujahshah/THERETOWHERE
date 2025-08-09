<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
$user_id = $_SESSION['user_id'];
$bookings = $conn->query("SELECT b.*, t.destination, t.price FROM bookings b JOIN trips t ON b.trip_id = t.id WHERE b.user_id = $user_id")->fetchAll();
$saved = $conn->query("SELECT s.*, t.destination FROM saved_destinations s JOIN trips t ON s.trip_id = t.id WHERE s.user_id = $user_id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Theretowhere</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
        nav a:hover {
            color: #f1c40f;
        }
        .dashboard {
            padding: 50px;
        }
        .dashboard h2 {
            color: #2c3e50;
        }
        .dashboard table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .dashboard table th, .dashboard table td {
            padding: 15px;
            border: 1px solid #ccc;
        }
        .dashboard table th {
            background: #2c3e50;
            color: white;
        }
        .review-form {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        .review-form input, .review-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .review-form button {
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .review-form button:hover {
            background: #f1c40f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Theretowhere Dashboard</h1>
        <nav>
            <a href="javascript:navigate('index.php')">Home</a>
            <a href="javascript:navigate('search.php')">Search Trips</a>
            <a href="javascript:navigate('guide.php')">Travel Guides</a>
            <a href="javascript:navigate('logout.php')">Logout</a>
        </nav>
    </header>
    <section class="dashboard">
        <h2>Your Bookings</h2>
        <table>
            <tr>
                <th>Destination</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?php echo $booking['destination']; ?></td>
                    <td>$<?php echo $booking['price']; ?></td>
                    <td><?php echo $booking['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Saved Destinations</h2>
        <table>
            <tr>
                <th>Destination</th>
            </tr>
            <?php foreach ($saved as $save): ?>
                <tr>
                    <td><?php echo $save['destination']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2>Add a Review</h2>
        <div class="review-form">
            <form method="POST" action="submit_review.php">
                <select name="trip_id" required>
                    <?php foreach ($bookings as $booking): ?>
                        <option value="<?php echo $booking['trip_id']; ?>"><?php echo $booking['destination']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)" required>
                <textarea name="comment" placeholder="Your review"></textarea>
                <button type="submit">Submit Review</button>
            </form>
        </div>
    </section>
    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
