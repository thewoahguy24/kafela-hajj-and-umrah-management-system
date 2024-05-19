<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $fusername = $_POST['fname'];
    $lusername = $_POST['lname'];
    $mobile = $_POST['mobnum'];
    $po = $_POST['post_code'];
    $aglicense = $_POST['aglicense'];
    $pass = $_POST['password'];

    try {
        require_once '../comp/connect_to_db.php';
        require_once 'sign_up_mvc/sign_up_controller.php';
        require_once 'sign_up_mvc/sign_up_view.php';

        // basic error handling start
        $error  = array();

        if (is_inserter_empty($email, $fusername, $mobile, $po, $aglicense, $pass)) {
            $error['insertor_empty'] = 'Some data fields might be empty';
        }
        if (is_email_invalid($email)) {
            $error['invalid_email']  = 'Your e-mail is invalid';
        }
        if (is_email_registered($pdo, $email)) {
            $error['email_taken'] = 'E-mail is already registered';
        }

        require_once '../comp/session_config.php';
        if ($error) {
            header('Location: ../muallim_signup_submit.php');
            die();
        }

        insert_into_database($pdo, $email, $fusername, $lusername, $mobile, $po, $aglicense, $pass);

        header('Location: ../index.php?signup=success');
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
