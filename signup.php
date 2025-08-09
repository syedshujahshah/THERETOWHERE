<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Theretowhere</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .signup-container h2 {
            text-align: center;
            color: #2c3e50;
        }
        .signup-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .signup-container button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .signup-container button:hover {
            background: #f1c40f;
        }
        .signup-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #2c3e50;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
            <a href="javascript:navigate('login.php')">Already have an account? Login</a>
        </form>
    </div>
    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
