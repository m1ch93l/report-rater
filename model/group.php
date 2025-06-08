<?php

require_once '../config/database.php';

class Group extends Database
{
    private $conn;
    public function __construct()
    {
        $this->conn = $this->getConnection(); // from parent Database class
    }
    public function findGroupBelong($group_belong)
    {
        $sql  = "SELECT * FROM participant WHERE group_belong = :group_belong";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':group_belong', $group_belong);
        $stmt->execute();
        return $stmt;
    }
    public function findActiveGroup()
    {
        $sql  = "SELECT * FROM `groups` WHERE status = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}