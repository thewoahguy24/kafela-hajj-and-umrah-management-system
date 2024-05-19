<?php
require "comp/navigation.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
$year = $_GET['past_trip_year'];
$month = $_GET['past_trip_month'];
$counter = 0;
if ($month > 12 && $month < 1) {
    header("Location: dashboard_muallim.php?error=!month");
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
    <h1 class='text-center'>SHOW ALL PAST TRIP</h1>
    <?php
    require_once 'comp/connect_to_db.php';
    require_once 'dbhandlers/trip_mvc/control.php';
    $all_trips = get_all_past_trips($_SESSION['user_id'], $year, $month, $pdo);
    ?>

    <br><br>
    <div class="container">
        <div class='row d-flex justify-content-center'>
            <?php while ($row = $all_trips->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-lg-3" style="background-color:#DAF7A6">

                    <!-- card -->
                    <div class="card text-center" style="background-color:beige">
                        <div class="card-header" style="background-color:#D3D3D3">
                            <?php echo $row['trip_status']; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['trip_type'] . '_' . $row['trip_date']; ?></h5>
                            <p class="card-text">
                                Hajjee count : <?php echo hajjee_count($row['email'], $row['trip_date'], $pdo); ?>
                            </p>
                            <a href="#" class="btn btn-primary">View Details</a>
                            <?php if (isset($_GET['cancel'])) { ?>
                                <a href='dbhandlers/trip_deletion.php?id=<?php echo $row['trip_date'] ?>' class="btn btn-Danger">Cancel</a>
                            <?php } else if (isset($_GET['update'])) { ?>
                                <a href='dbhandlers/trip_update.php?id=<?php echo $row['trip_date'] ?>' class="btn btn-Success">Update</a>
                            <?php } ?>
                        </div>
                        <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
                            -/-
                        </div>
                    </div>
                    <!-- card -->

                </div>
        </div>
    </div>
<?php $counter++;
            }
            if ($counter == 0) { ?>
    <!-- card -->
    <div class="card text-center" style="background-color:beige">
        <div class="card-header" style="background-color:#D3D3D3">
        </div>
        <div class="card-body">
            <h5 class="card-title">No Trips to Show</h5>
        </div>
        <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
        </div>
    </div>
    <!-- card -->

    </div>
<?php } ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>