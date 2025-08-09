<?php
session_start();
include 'db.php';
$guides = $conn->query("SELECT * FROM guides")->fetchAll();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $trip_id = $_POST['trip_id'];
    $stmt = $conn->prepare("INSERT INTO saved_destinations (user_id, trip_id) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $trip_id]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Guides - Theretowhere</title>
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
        .guide-container {
            padding: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .guide-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin: 20px;
            width: 300px;
            padding: 20px;
        }
        .guide-card button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .guide-card button:hover {
            background: #f1c40f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Travel Guides</h1>
        <nav>
            <a href="javascript:navigate('index.php')">Home</a>
            <a href="javascript:navigate('search.php')">Search Trips</a>
            <a href="javascript:navigate('dashboard.php')">Dashboard</a>
            <a href="javascript:navigate('logout.php')">Logout</a>
        </nav>
    </header>
    <section class="guide-container">
        <?php foreach ($guides as $guide): ?>
            <div class="guide-card">
                <h3><?php echo $guide['title']; ?></h3>
                <p><?php echo substr($guide['content'], 0, 100); ?>...</p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST">
                        <input type="hidden" name="trip_id" value="<?php echo $guide['id']; ?>">
                        <button type="submit">Save Guide</button>
                    </form>
                <?php else: ?>
                    <p><a href="javascript:navigate('login.php')">Login to save</a></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>
    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
