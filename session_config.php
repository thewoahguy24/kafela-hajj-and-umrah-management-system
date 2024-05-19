<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params(['lifetime' => 1800, 'domain' => 'localhost', 'path' => '/', 'secure' => true, 'httponly' => true]);

session_start();


if (isset($_SESSION['user_id'])) {
    if (isset($_SESSION['last_regeneration'])) {
        session_last_regenerate_loggedIn();
    } else {
        $session_time = 1800;
        if (time() - $_SESSION['last_regeneration'] > $session_time) {
            session_last_regenerate_loggedIn();
        }
    }
} else {
    if (isset($_SESSION['last_regeneration'])) {
        session_last_regenerate();
    } else {
        $session_time = 1800;
        if (time() - $_SESSION['last_regeneration'] > $session_time) {
            session_last_regenerate();
        }
    }
}

function session_last_regenerate_loggedIn()
{
    session_regenerate_id(true);
    $userID = $_SESSION['user_id'];
    $newSessionID = session_create_id();
    $sessionID = $newSessionID . '_' . $userID;
    session_id($sessionID);

    $_SESSION['last_regeneration'] = time();
}

function session_last_regenerate()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
