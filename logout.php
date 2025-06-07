<?php session_start();
require_once 'model/user.php';

$studentOffline = new User();
$studentOffline->updateStatusToOffline($_SESSION['participant']);

if ($studentOffline) {
    
    session_destroy();
    session_unset();
    header('location: index');
}