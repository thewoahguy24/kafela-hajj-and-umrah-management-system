<?php
function is_inserter_empty($email, $fusername, $mobile, $po, $aglicense, $pass)
{
    if (empty($email) || empty($fusername) || empty($mobile) || empty($po) || empty($aglicense) || empty($pass)) {
        return true;
    } else {
        return false;
    }
}

function is_hj_inserter_empty($hj_email, $hj_username, $hj_mobile, $po, $pass)
{
    if (empty($hj_email) || empty($hj_username) || empty($hj_mobile) || empty($po) || empty($pass)) {
        return true;
    } else {
        return false;
    }
}

function is_email_invalid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function is_email_registered(object $pdo, string $email)
{
    require_once 'sign_up_model.php';
    if (check_duplicate_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_hj_email_registered(object $pdo, $hj_email)
{
    require_once 'sign_up_model.php';
    if (check_hj_duplicate_email($pdo, $hj_email)) {
        return true;
    } else {
        return false;
    }
}


function insert_into_database(object $pdo, $email, $fusername, $lusername, $mobile, $po, $aglicense, $pass)
{
    require_once 'sign_up_model.php';
    insert_to_database($pdo, $email, $fusername, $lusername, $mobile, $po, $aglicense, $pass);
}

function insert_hj_into_database(object $pdo, $hj_email, $hj_username, $hj_mobile, $po, $pass)
{
    require_once 'sign_up_model.php';
    insert_hj_to_database($pdo, $hj_email, $hj_username, $hj_mobile, $po, $pass);
}
