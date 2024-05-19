<?php
require "comp/navigation.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
$flag = $_GET['id'];
require_once 'comp/connect_to_db.php';
require_once 'dbhandlers/trip_mvc/control.php';
$all_trips = get_all_trips('', $pdo, $flag);
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
    <h1 class="text-center">SHOWING ALL AVAILABLE UPCOMING TRIP </h1>

    <div class="container">
        <div class='row d-flex justify-content-center' style="background-color: grey;">
            <?php while ($row = $all_trips->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-lg-3">
                    <br>
                    <!-- card -->
                    <div class="card text-center" style="background-color:beige">
                        <div class="card-header" style="background-color:deepskyblue">
                            <?php echo $row['trip_status']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['trip_type'] . '_' . $row['trip_date']; ?></h5>
                            <p class="card-text">
                                Muallim : <?php echo get_muallim_details_from_database($row['email'], 'name', $pdo); ?>
                            </p>
                            <p class="card-text">
                                Hajjee count : <?php echo hajjee_count($row['email'], $row['trip_date'], $pdo); ?>
                            </p>
                            <p class="card-text">
                                Package cost : <?php echo $row['trip_cost'] . ' BDT'; ?>
                            </p>
                            <form action="dbhandlers/book_trip_for_hajjee.php" method="post">
                                <input hidden name="trip_type" value="<?php echo $row['trip_type'] ?>">
                                <input hidden name="trip_date" value="<?php echo $row['trip_date'] ?>">
                                <input hidden name="email" value="<?php echo $row['email'] ?>">
                                <input hidden name="hj_email" value="<?php echo $_SESSION['user_id'] ?>">
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                        <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
                            <?php
                            $date1 = date_create((date('Y-m-d')));
                            $date2 = date_create($row['trip_date']);
                            $diff = date_diff($date1, $date2);
                            echo $diff->format('%a'); ?> days left
                        </div>
                    </div>
                    <!-- card -->
                </div>

            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>