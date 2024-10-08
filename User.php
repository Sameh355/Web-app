<?php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function resetPassword($email, $newPassword)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->execute([':password' => password_hash($newPassword, PASSWORD_BCRYPT), ':email' => $email]);
    }
}
?>
