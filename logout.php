<?php
session_start();
session_unset();
session_destroy();

header("Location: muallim_login_submit.php");
die();
