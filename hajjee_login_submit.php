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
    <title>hajjee login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class='container'>
        <h1 class='text-center'>HAJJEE LOGIN</h1>
        <hr>
    </div>

    <div class="h-10 d-flex align-items-center justify-content-center">
        <form action="dbhandlers/hajjee_login_insert.php" method="post">
            <div class="mb-3" class="align-center"><!--E-mail-->
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="Enter Your e-mail">
            </div>

            <div class="mb-3"><!--password-->
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 form-check"><!--check box-->
                <input type="checkbox" class="form-check-input" id="Check" name="Check">
                <label class="form-check-label" for="Check">The above information is correct</label>
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button><br><br>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>