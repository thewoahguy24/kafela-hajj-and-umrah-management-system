<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $trip_type = $_POST['trip_type'];
    $trip_cost = $_POST['cost'];
    $trip_date = $_POST['trip_date'];

    try {
        require '../comp/connect_to_db.php';
        require_once 'trip_mvc/control.php';

        // error handlers
        $error = array();
        if ($trip_type != 'Hajj' && $trip_type != 'Omrah') {
            $error['trip_type'] = 'Please select a trip type';
        }

        if ($trip_cost < 70000) {
            $error['cost'] = 'cannot make a trip below 70,000';
        }

        if (is_date_available($email, $trip_date, $trip_type, $pdo)) {
            $error['trip_date'] = 'date not available';
        }

        if ($error) {
            header('Location: ../dashboard_muallim.php?trip_creation=failed');
            die();
        }
        create_trip_for_muallim($email, $trip_type, $trip_cost, $trip_date, $pdo);

        header('Location: ../dashboard_muallim.php?trip_creation=success');
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
