<?php
session_start();

include 'model/user.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //for registration of participant
    if (isset($_POST['register'])) {
        $participant        = $_POST['participant'];
        $password           = $_POST['password'];
        $fullname           = $_POST['name'];
        $group_belong       = $_POST['group_belong'];
        $year_level_section = $_POST['year_level_section'];

        
        $stmt    = $user->create($participant, $password, $fullname, $group_belong, $year_level_section);

        if ($stmt) {
            $_SESSION['registered'] = true;
            header('location: index');
            exit();
        } else {
            $_SESSION['error'] = true;
            header('location: index');
        }

    } else {
        $_SESSION['error'] = true;
        header('location: index');
    }

    // for login of participant
    if (isset($_POST['login'])) {

        $participant = $_POST['participant'];
        $password    = $_POST['password'];

        $student = $user->findStudentUser($participant);
        if ($student) {
            if ($student['password'] == $password) {
                $_SESSION['participant']   = $student['id'];
                $_SESSION['fullname']      = $student['fullname'];
                $_SESSION['group_belong']  = $student['group_belong'];
                $_SESSION['online_status'] = $student['online_status'];

                // change or update the online status of participants in the database table
                $studentOnline->updateStatusToOnline($student['id']);

                header('location: home');
                exit();

            } else {
                $_SESSION['error'] = true;
                header('location: index');
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
                $_SESSION['error'] = true;
                header('location: index');
                exit();
            }
        } else {
            $_SESSION['error'] = true;
            header('location: index');
            exit();
        }

    } else {
        $_SESSION['error'] = true;
        header('location: index');
        exit();
    }
}