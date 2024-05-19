<?php
require "comp/navigation.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trip_date = $_POST['trip_date'];
    require_once 'comp/connect_to_db.php';
    require_once 'dbhandlers/trip_mvc/control.php';
    $details = get_hajjee_and_trip_details($_SESSION['user_id'], $trip_date, $pdo);
    $most_up = get_a_trip_based_on_date_and_email($_SESSION['user_id'], $trip_date, $pdo);
} else {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KAFELA - Hajj & Omrah Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- CARD -->
    <div class="card text-center" style="background-color:beige">
        <div class="card-header" style="background-color:#D3D3D3">
            <?php echo $most_up['trip_status']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $most_up['trip_type'] . '_' . $most_up['trip_date']; ?></h5>
            <p class="card-text">
                Hajjee count : <?php echo hajjee_count($most_up['email'], $most_up['trip_date'], $pdo); ?>
            </p>
            <p class="card-text">
                Trip Cost : <?php echo $most_up['trip_cost']; ?>
            </p>
        </div>
        <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
            <?php echo get_day_count($most_up['email'], $pdo); ?> days left
        </div>
    </div>
    <!-- CARD -->

    <div class='container mt-5'>
        <table class="table table-responsive table-borderd border-dark table-hover text-center">
            <tr class="table-dark table-active text-uppercase text-white">
                <td>Hajjee name</td>
                <td>hajjee email</td>
                <td>Hajjee details</td>
            </tr>
            <?php
            while ($row = $details->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['hj_user_name'] ?></td>
                    <td><?php echo $row['hj_email'] ?></td>
                    <td><a id="<?php echo $row['hj_email'] ?>" class="btn btn-primary" href="show_profile.php?id=<?php echo $row['hj_email'] ?>" target="_blank">view</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>