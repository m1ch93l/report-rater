<?php
session_start();
//require_once 'includes/database.php';
require_once 'model/user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //for registration of participant
    // if (isset($_POST['register'])) {
    //     $participant        = $_POST['participant'];
    //     $password           = $_POST['password'];
    //     $name               = $_POST['name'];
    //     $group_belong       = $_POST['group_belong'];
    //     $year_level_section = $_POST['year_level_section'];

    //     $sql  = "INSERT INTO participant (participant_id, password, fullname, group_belong, year_level_section) VALUES (:participant, :password, :name, :group_belong, :year_level_section)";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bindParam(':participant', $participant);
    //     $stmt->bindParam(':password', $password);
    //     $stmt->bindParam(':name', $name);
    //     $stmt->bindParam(':group_belong', $group_belong);
    //     $stmt->bindParam(':year_level_section', $year_level_section);

    //     if ($stmt->execute()) {
    //         $_SESSION['registered'] = true;
    //         header('location: index');
    //     } else {
    //         $_SESSION['error'] = 'Registration failed';
    //     }

    // } else {
    //     $_SESSION['error'] = 'Input voter credentials first';
    // }

    // for login of participant
    if (isset($_POST['login'])) {

        $participant = $_POST['participant'];
        $password    = $_POST['password'];

        $student = new User();
        $student = $student->findStudentUser($_POST['participant']);
        if ($student) {
            if ( $student['password'] == $password) {
                $_SESSION['participant']   = $student['id'];
                $_SESSION['fullname']      = $student['fullname'];
                $_SESSION['group_belong']  = $student['group_belong'];
                $_SESSION['online_status'] = $student['online_status'];
                header('location: home');
                exit();
            } else {
                $_SESSION['error'] = 'Incorrect password';
                exit();
            }
        }

        // using admin function class of user from model
        $user  = new User();
        $admin = $user->findAdminUser($_POST['participant']);
        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = $admin['id'];
                header('location: admin/home');
                exit();
            } else {
                $_SESSION['error'] = 'Incorrect password';
                exit();
            }
        } else {
            $_SESSION['error'] = 'Cannot find account with the username';
            exit();
        }

    } else {
        $_SESSION['error'] = 'Input voter credentials first';
        exit();
    }

}