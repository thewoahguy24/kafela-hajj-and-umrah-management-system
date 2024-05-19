<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $trip_date = $_POST['trip_date'];
    $hj_email = $_POST['hj_email'];
    $trip_type = $_POST['trip_type'];

    try {
        require '../comp/connect_to_db.php';
        require_once 'trip_mvc/control.php';

        $error = array();
        if (is_date_available_for_booking($hj_email, $trip_date, $trip_type, $pdo)) {
            $error['trip_date'] = 'date not available';
        }
        if ($error) {
            header('Location: ../dashboard_hajjee.php?trip_booking=failed');
            die();
        }
        book_trip_for_hajjee($email, $hj_email, $trip_date, $pdo);

        header('Location: ../dashboard_hajjee.php?trip_booking=success');
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
