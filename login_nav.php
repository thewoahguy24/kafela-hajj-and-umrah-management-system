<?php
require "comp/navigation.php";
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_type'] == 'Hajjee') {
        header('Location: dashboard_hajjee.php');
    } else if ($_SESSION['user_type'] == 'Muallim') {
        header('Location: dashboard_muallim.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login_nav</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <h1 class="text-center">LOGIN</h1>
    <br><br><br>
    <div class='text-center'>

        <a href='hajjee_login_submit.php'> <button type="button" class="btn btn-primary btn-lg">Hajjee</button> </a>
        <a href='muallim_login_submit.php'> <button type="button" class="btn btn-primary btn-lg">Muallim</button> </a>

    </div>
    <br><br>
    <div class='text-center'>
        <button type="button" class="btn btn-secondary btn-lg">Own This Business?</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>