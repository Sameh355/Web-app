<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f7ff;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 400px; 
            transition: transform 0.2s;
            text-align: center; 
        }

        .login-container:hover {
            transform: scale(1.02); 
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 26px; 
            color: #333;
        }

        .login-container input[type="email"],
        .login-container input[type="password"],
        .login-container select {
            width: 100%;
            padding: 12px;
            margin: 10px 0; 
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s; 
        }

        .login-container input:focus,
        .login-container select:focus {
            border-color: #6f42c1; 
            outline: none;
        }

        .login-container button {
            width: 100%;
            background-color: #6f42c1;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-top: 10px; 
        }

        .login-container button:hover {
            background-color: #5a3799; 
        }

        .login-container a {
            color: #6f42c1;
            text-decoration: none;
            margin: 10px 0; 
            display: block;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .login-container .back-home {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 15px; 
        }

        .login-container .back-home:hover {
            background-color: #0056b3; 
        }
        footer {
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            margin-top: 20px; 
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="login_action.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="driver">Driver</option>
                <option value="client">Client</option>
            </select>
            <button type="submit">Login</button>
            <a href="signup.php">Sign Up</a>
            <a href="forgot_password.php" class="forgot-password">Forgot Password?</a>
        </form>
        <a href="index.php" class="back-home">Home</a>
        <footer>
        <p>&copy; 2024 Fast Delivery Service. All rights reserved.</p>
    </footer>
    </div>
</body>
</html>
