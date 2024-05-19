<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $trip_date = $_POST['trip_date'];

    try {
        require_once '../comp/connect_to_db.php';
        require_once 'trip_mvc/control.php';
        cancel_trip($email, $trip_date, $pdo);
        header('Location: ../dashboard_muallim.php?trip_deletion=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
