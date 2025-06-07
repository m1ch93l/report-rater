<?php

require_once 'config/database.php';

class Rating extends Database
{
    private $conn;
    public function __construct()
    {
        $this->conn = $this->getConnection(); // from parent Database class
    }
    public function findRatingParticipant($participant_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM rating WHERE participant_id = :participant_id");
        $stmt->bindValue(':participant_id', $participant_id);
        $stmt->execute();
        return $stmt;
    }
    public function getActiveParticipantsInAGroup()
    {
        $sql  = "SELECT participant.id as id, participant.fullname as fullname, rating.content as content, rating.organization as organization, rating.presentation as presentation, rating.delivery as delivery FROM rating JOIN participant ON rating.participant_id = participant.id JOIN `groups` ON participant.group_belong = `groups`.id WHERE participant.group_belong != :group_belong AND groups.status = 1 ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':group_belong', $_SESSION['group_belong']);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}