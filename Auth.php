<?php
class Auth
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function getRole()
    {
        return $_SESSION['role'] ?? null;
    }
}
?>
