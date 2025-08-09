<?php
session_start();
include 'db.php';
$trips = $conn->query("SELECT * FROM trips")->fetchAll();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $trip_id = $_POST['trip_id'];
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, trip_id) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $trip_id]);
    // Simulate email confirmation
    echo "Booking confirmed! Check your email.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Trips - Theretowhere</title>
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
        .search-container {
            padding: 50px;
        }
        .search-container form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .search-container input, .search-container select {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-container button {
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container button:hover {
            background: #f1c40f;
        }
        .trip-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .trip-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin: 20px;
            width: 300px;
            padding: 20px;
        }
        .trip-card button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .trip-card button:hover {
            background: #f1c40f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Search Trips</h1>
        <nav>
            <a href="javascript:navigate('index.php')">Home</a>
            <a href="javascript:navigate('guide.php')">Travel Guides</a>
            <a href="javascript:navigate('dashboard.php')">Dashboard</a>
            <a href="javascript:navigate('logout.php')">Logout</a>
        </nav>
    </header>
    <section class="search-container">
        <form>
            <input type="text" placeholder="Destination">
            <select>
                <option>Price Range</option>
                <option>$0 - $500</option>
                <option>$500 - $1000</option>
            </select>
            <select>
                <option>Travel Type</option>
                <option>Flight</option>
                <option>Hotel</option>
                <option>Package</option>
            </select>
            <button type="submit">Search</button>
        </form>
        <div class="trip-list">
            <?php foreach ($trips as $trip): ?>
                <div class="trip-card">
                    <h3><?php echo $trip['destination']; ?></h3>
                    <p>$<?php echo $trip['price']; ?> - <?php echo $trip['duration']; ?> Days</p>
                    <p><?php echo $trip['description']; ?></p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form method="POST">
                            <input type="hidden" name="trip_id" value="<?php echo $trip['id']; ?>">
                            <button type="submit">Book Now</button>
                        </form>
                    <?php else: ?>
                        <p><a href="javascript:navigate('login.php')">Login to book</a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
