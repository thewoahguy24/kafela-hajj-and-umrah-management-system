<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hj_email = $_POST['hj_email'];
    $hj_username = $_POST['hj_name'];
    $hj_mobile = $_POST['hj_mobnum'];
    $po = $_POST['hj_post_code'];
    $pass = $_POST['password'];

    try {
        require_once '../comp/connect_to_db.php';
        require_once 'sign_up_mvc/sign_up_controller.php';

        // basic error handling start
        $error  = array();

        if (is_hj_inserter_empty($hj_email, $hj_username, $hj_mobile, $po, $pass)) {
            $error['insertor_empty'] = 'Some data fields might be empty';
        }
        if (is_email_invalid($hj_email)) {
            $error['invalid_email']  = 'Your e-mail is invalid';
        }
        if (is_hj_email_registered($pdo, $hj_email)) {
            $error['email_taken'] = 'E-mail is already registered';
        }

        require_once '../comp/session_config.php';
        if ($error) {
            $_SESSION['errors'] = $error;
            header('Location: ../hajjee_signup_submit.php');
            die();
        }

        insert_hj_into_database($pdo, $hj_email, $hj_username, $hj_mobile, $po, $pass);

        header('Location: ../index.php?signup=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die('Query fialed' . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
    die();
}
