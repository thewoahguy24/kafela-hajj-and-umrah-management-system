<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    try {
        require_once '../comp/connect_to_db.php';
        require_once 'login_mvc/login_controller.php';
        require_once 'login_mvc/login_model.php';


        // error handlers

        $errors = array();

        if (check_fields($email, $pass)) {
            $errors['fields'] = 'fields are empty';
        }

        if (check_email_validity($email)) {
            $errors['email_validity'] = 'email is invalid';
        }

        $user = get_hj_user_data($email, $pdo);

        if (empty($user)) {
            $errors['email_existence'] = 'email is not registered';
        }

        if ($errors) {
            header('Location: ../hajjee_login_submit.php');
            die();
        }

        if ($user['hj_pass'] != $pass) {
            $erros['password'] = 'invalid password';
            header('Location: ../hajjee_login_submit.php');
            die();
        }


        require_once '../comp/session_config.php';

        $newSessionID = session_create_id();
        $sessionID = $newSessionID . '_' . $user['hj_email'];
        session_id($sessionID);

        // session attributes.

        $_SESSION['user_id'] = $user['hj_email'];
        $_SESSION['user_fname'] = htmlspecialchars($user['hj_user_name']);
        $_SESSION['user_mobile'] = htmlspecialchars($user['hj_mobile']);
        $_SESSION['user_address'] = get_user_address($user['hj_post_code'], $pdo);
        $_SESSION['user_type'] = 'Hajjee';

        $_SESSION['last_regeneration'] = time();

        header('Location: ../dashboard_hajjee.php?login=success');
        $pdo = null;
        $stmt = null;
        die();
    } catch (PDOException $e) {
        die('Query fialed' . $e->getMessage());
    }
} else {
    header('Location: ../index.php');
}
