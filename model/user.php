<?php

require_once 'config/database.php';

class User extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection();
    }
    public function findAdminUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findStudentUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}