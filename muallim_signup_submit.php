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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KAFELA - Hajj & Omrah Mangement System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <br><br>
    <div class="container">
        <h1 class="text-center">SIGN UP</h1>
        <hr>
    </div>


    <div class="h-10 d-flex align-items-center justify-content-center">
        <form action="dbhandlers/muallim_sign_up_insert.php" method="post">
            <div class="mb-3" class="align-center"><!--E-mail-->
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="Enter Your e-mail">
            </div>
            <div class="mb-3" class="align-center"><!--first name-->
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="Enter Your First Name">
            </div>
            <div class="mb-3" class="align-center"><!--last name-->
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="Enter Your Last Name">
            </div>
            <div class="mb-3" class="align-center"><!--Mobile Number-->
                <label for="mobnum" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobnum" name="mobnum" aria-describedby="+8801XXXXXXXXX">
            </div>

            <div class="mb-3" class="align-center">
                <br>
                <h3>ADDRES</h3>
                <div class="mb-3" class="align-center"><!--Division-->
                    <label for="division" class="form-label">Division</label>
                    <input type="text" class="form-control" id="division" name="division" aria-describedby="Enter Your Division">
                </div>
                <div class="mb-3" class="align-center"><!--Zila-->
                    <label for="zila" class="form-label">Zila</label>
                    <input type="text" class="form-control" id="Zila" name="Zila" aria-describedby="Enter Your Zila">
                </div>
                <div class="mb-3" class="align-center"><!--Upazila-->
                    <label for="upazila" class="form-label">Upazila</label>
                    <input type="text" class="form-control" id="upazila" name="upazila" aria-describedby="Enter Your upazila">
                </div>
                <div class="mb-3" class="align-center"><!--Post code-->
                    <label for="post_code" class="form-label">Postal Code</label>
                    <input type="number" class="form-control" id="post_code" name="post_code" aria-describedby="0000">
                </div>
            </div>

            <div class="mb-3" class="align-center">
                <br>
                <h3>AGENCY INFORMATION</h3>
                <div class="mb-3" class="align-center"><!--Agency license-->
                    <label for="aglicense" class="form-label">Agency License</label>
                    <input type="text" class="form-control" id="aglicense" name="aglicense" aria-describedby="X-0000">
                </div>
                <br>
                <br>
            </div>

            <div class="mb-3"><!--password-->
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 form-check"><!--check box-->
                <input type="checkbox" class="form-check-input" id="Check" name="Check">
                <label class="form-check-label" for="Check">The above information is correct</label>
            </div>
            <button type="submit" class="btn btn-primary">SIGN UP</button><br><br>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>