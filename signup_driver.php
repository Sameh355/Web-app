<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'driver'; 
    $driverId = $_POST['driver_id'];
    $vehicleModel = $_POST['vehicle_model'];

    $idPicture = $_FILES['id_picture']['name'];
    $licensePicture = $_FILES['license_picture']['name'];

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $idPictureTarget = $targetDir . basename($idPicture);
    $licensePictureTarget = $targetDir . basename($licensePicture);
    if (move_uploaded_file($_FILES['id_picture']['tmp_name'], $idPictureTarget) &&
        move_uploaded_file($_FILES['license_picture']['tmp_name'], $licensePictureTarget)) {
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO drivers (name, email, password, role, driver_id, vehicle_model, id_picture, license_picture) 
                                VALUES (:name, :email, :password, :role, :driver_id, :vehicle_model, :id_picture, :license_picture)");
        $result = $stmt->execute([
            ':name' => $fullName,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':role' => $role,
            ':driver_id' => $driverId,
            ':vehicle_model' => $vehicleModel,
            ':id_picture' => $idPicture,
            ':license_picture' => $licensePicture
        ]);

        if ($result) {
            header('Location: login.php');
            exit;
        } else {
            echo "Error: Could not register driver.";
        }
    } else {
        echo "Error: Failed to upload files.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Sign Up</title>
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
            max-width: 450px;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .signup-btn, .home-btn {
            padding: 12px;
            width: 100%;
            font-size: 18px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .signup-btn {
            background-color: #BE6DB7;
            color: white;
        }
        .signup-btn:hover {
            background-color: #C04A82;
        }
        .home-btn {
            background-color: #6c757d;
            color: white;
        }
        .home-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <h1>Driver Sign Up Page</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="driver_id">Driver ID:</label>
            <input type="text" name="driver_id" id="driver_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_picture">Upload ID Picture:</label>
            <input type="file" name="id_picture" id="id_picture" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="license_picture">Upload Driver's License:</label>
            <input type="file" name="license_picture" id="license_picture" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="vehicle_model">Vehicle Model:</label>
            <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" required>
        </div>
        <button type="submit" class="signup-btn" name="signup">Sign Up</button>
    </form>
    <a href="index.php" class="home-btn btn">Back to Home</a>
</div>

</body>
</html>
