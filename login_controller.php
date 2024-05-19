<?php

function check_fields($email, $pass)
{
    if (empty($email) || empty($pass)) {
        return true;
    } else {
        return false;
    }
}

function check_email_validity($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function check_email_existence($email, object $pdo)
{
    require_once 'login_model.php';
    $user_data = get_user_data($email, $pdo);
    if ($user_data) {
        return false;
    } else {
        return true;
    }
}

function password_match(object $pdo, $email, $pass)
{
    require_once 'login_model.php';
    if (check_email_existence($email, $pdo)) {
        return;
    }
    $user_data = get_user_data($email, $pdo);
    if ($user_data['pass'] == $pass) {
        return false;
    } else {
        return true;
    }
}

function is_loggedIN()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}
