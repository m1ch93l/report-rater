<?php

require_once '../config/database.php';

class Admin extends Database
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->getConnection(); // from parent Database class
    }

    public function findStudentUserGroup($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM participant WHERE participant_id = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    public function getStudentGroupBelong()
    {
        $sql  = "SELECT fullname, group_belong FROM participant";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRate()
    {
        $sql  = "SELECT * FROM rate JOIN participant ON rate.participant_id = participant.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}