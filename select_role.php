<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F4F4F9;
        }
        .role-container {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .role-btn {
            background-color: #BE6DB7;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .role-btn:hover {
            background-color: #C04A82;
        }
    </style>
</head>
<body>
<div class="role-container">
    <h2>Select Your Role</h2>
    <form action="signup_driver.php" method="get">
        <button class="role-btn" type="submit">Sign Up as Driver</button>
    </form>
    <form action="signup_customer.php" method="get">
        <button class="role-btn" type="submit">Sign Up as Customer</button>
    </form>
</div>
</body>
</html>
