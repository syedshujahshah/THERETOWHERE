<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theretowhere - Travel & Explore</title>
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
            font-weight: bold;
        }
        nav a:hover {
            color: #f1c40f;
        }
        .hero {
            background: url('https://source.unsplash.com/random/1600x900/?travel') no-repeat center;
            background-size: cover;
            padding: 100px 20px;
            text-align: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        .destinations {
            display: flex;
            justify-content: space-around;
            padding: 50px;
            flex-wrap: wrap;
        }
        .destination-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin: 20px;
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .destination-card:hover {
            transform: scale(1.05);
        }
        .destination-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .destination-card h3, .destination-card p {
            padding: 10px;
        }
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Theretowhere</h1>
        <nav>
            <a href="javascript:navigate('index.php')">Home</a>
            <a href="javascript:navigate('search.php')">Search Trips</a>
            <a href="javascript:navigate('guide.php')">Travel Guides</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="javascript:navigate('dashboard.php')">Dashboard</a>
                <a href="javascript:navigate('logout.php')">Logout</a>
            <?php else: ?>
                <a href="javascript:navigate('login.php')">Login</a>
                <a href="javascript:navigate('signup.php')">Sign Up</a>
            <?php endif; ?>
        </nav>
    </header>
    <section class="hero">
        <h2>Explore the World with Theretowhere</h2>
        <p>Discover amazing destinations and book your dream trip today!</p>
    </section>
    <section class="destinations">
        <div class="destination-card">
            <img src="https://source.unsplash.com/random/300x200/?paris" alt="Paris">
            <h3>Paris</h3>
            <p>From $599 - 5 Days</p>
        </div>
        <div class="destination-card">
            <img src="https://source.unsplash.com/random/300x200/?bali" alt="Bali">
            <h3>Bali</h3>
            <p>From $799 - 7 Days</p>
        </div>
        <div class="destination-card">
            <img src="https://source.unsplash.com/random/300x200/?newyork" alt="New York">
            <h3>New York</h3>
            <p>From $499 - 4 Days</p>
        </div>
    </section>
    <footer>
        <p>&copy; 2025 Theretowhere. All rights reserved.</p>
    </footer>
    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
