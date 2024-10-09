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
