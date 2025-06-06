<?php

session_start();
require_once 'includes/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // for registration of participant
    if (isset($_POST['register'])) {
        $participant = $_POST['participant'];
        $password    = $_POST['password'];
        $name        = $_POST['name'];
        $group_belong = $_POST['group_belong'];
        $year_level_section = $_POST['year_level_section'];

        $sql  = "INSERT INTO participant (participant_id, password, fullname, group_belong, year_level_section) VALUES (:participant, :password, :name, :group_belong, :year_level_section)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':participant', $participant);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':group_belong', $group_belong);
        $stmt->bindParam(':year_level_section', $year_level_section);
        
        if ($stmt->execute()) {
            $_SESSION['registered'] = true;
            header('location: index');
        } else {
            $_SESSION['error'] = 'Registration failed';
        }

    } else {
        $_SESSION['error'] = 'Input voter credentials first';
    }

    // for login of participant
    if (isset($_POST['login'])) {
        $participant = $_POST['participant'];
        $password    = $_POST['password'];

        $sql  = "SELECT * FROM participant WHERE participant_id = :participant";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':participant', $participant);
        $stmt->execute();

        if ($stmt->rowCount() < 1) {
            $_SESSION['error'] = 'Cannot find account with the username';
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['password'] == $password) {
                $_SESSION['participant'] = $row['id'];
                $_SESSION['fullname']    = $row['fullname'];
                $_SESSION['hide'] = false;
                $_SESSION['group_belong'] = $row['group_belong'];
                header('location: home');
            } else {
                $_SESSION['error'] = 'Incorrect password';
            }
        }

        $sql  = "SELECT * FROM admin WHERE username = :participant";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':participant', $participant);
        $stmt->execute();

        if ($stmt->rowCount() < 1) {
            $_SESSION['error'] = 'Cannot find account with the username';
        } else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin'] = $row['id'];
                header('location: admin/home');
            } else {
                $_SESSION['error'] = 'Incorrect password';
            }
        }

    } else {
        $_SESSION['error'] = 'Input voter credentials first';
    }

    header('location: home');

}