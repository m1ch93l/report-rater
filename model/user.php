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
    public function updateStatusToOnline($id)
    {
        $sql  = "UPDATE participant SET online_status = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
    public function create($participant, $password, $fullname, $group_belong, $year_level_section)
    {
        $sql = "INSERT INTO participant (participant_id, password, fullname, group_belong, year_level_section)
                VALUES (:participant, :password, :fullname, :group_belong, :year_level_section)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':participant', $participant);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':fullname', $fullname);
        $stmt->bindValue(':group_belong', $group_belong);
        $stmt->bindValue(':year_level_section', $year_level_section);
        return $stmt->execute();
    }
    public function updateStatusToOffline($id)
    {
        $sql  = "UPDATE participant SET online_status = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}