<?php
require_once 'config/database.php';
class User extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection(); // from parent Database class
    }

    public function findAdminUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function findStudentUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM participant WHERE participant_id = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}