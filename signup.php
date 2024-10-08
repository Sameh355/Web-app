<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Choose Option</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F4F4F9;
        }
        .signup-container {
            width: 100%;
            max-width: 350px;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .signup-container h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }
        .signup-btn {
            background-color: #BE6DB7;
            color: white;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-decoration: none;
            display: block; 
        }
        .signup-btn:hover {
            background-color: #C04A82;
        }
        .back-btn {
            background-color: #6c757d;
            color: white;
            padding: 12px;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
            text-decoration: none;
            display: block; 
            margin-top: 15px; 
        }
        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h2>Sign Up Options</h2>
    <a href="signup_driver.php" class="signup-btn">Sign Up as Driver</a>
    <a href="customer_signup.php" class="signup-btn">Sign Up as Customer</a>
    <a href="index.php" class="back-btn">Back to Home</a>
</div>

</body>
</html>
