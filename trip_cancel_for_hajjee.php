<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hj_email = $_POST['hj_email'];
    $trip_date = $_POST['trip_date'];

    try {
        require_once '../comp/connect_to_db.php';
        require_once 'trip_mvc/control.php';
        delete_trip_for_hajjee($hj_email, $trip_date, $pdo);
        header('Location: ../dashboard_hajjee.php?trip_canceletion=success');
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
