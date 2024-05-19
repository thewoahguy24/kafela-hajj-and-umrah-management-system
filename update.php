<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $old_trip_date = $_POST['old_trip_date'];
    $new_trip_date = $_POST['new_trip_date'];
    try {
        require_once '../comp/connect_to_db.php';
        require_once 'trip_mvc/control.php';

        // error handlers
        $date1 = date_create($old_trip_date);
        $date2 = date_create($new_trip_date);
        $date3 = date_create(date('Y-m-d'));
        $diff = date_diff($date1, $date2);
        $diff2 = date_diff($date1, $date3);
        if ($diff->format('%a') > 4 || $diff->format('%a') < -4 || $diff2->format('%a') < 5) {
            header('Location: trip_update.php?error_invalid_date_set');
            die();
        }

        update_trip_day($email, $new_trip_date, $old_trip_date, $pdo);
        header('Location: ../show.php?update=1&trip_update=success');
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
