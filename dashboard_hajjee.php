<?php
require "comp/navigation.php";
if (!isset($_SESSION['user_id'])) {
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
    <h1 class="text-center">DASHBOARD</h1>
    <!-- accordion -->

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    My Trips
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    require_once 'dbhandlers/trip_mvc/control.php';
                    require_once 'comp/connect_to_db.php';
                    change_status_of_previous_trip($pdo);
                    $most_up = get_most_up_for_hajjee($_SESSION['user_id'], $pdo);
                    if ($most_up) {
                    ?>
                        <!-- card -->
                        <div class="card text-center" style="background-color:beige">
                            <div class="card-header" style="background-color:deepskyblue">
                                <?php echo $most_up['trip_status']; ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $most_up['trip_type'] . '_' . $most_up['trip_date']; ?></h5>
                                <p class="card-text">
                                    Muallim : <?php echo get_muallim_details_from_database($most_up['email'], 'name', $pdo); ?>
                                </p>
                                <p class="card-text">
                                    Hajjee count : <?php echo hajjee_count($most_up['email'], $most_up['trip_date'], $pdo); ?>
                                </p>
                                <p class="card-text">
                                    Package cost : <?php echo $most_up['trip_cost'] . ' BDT'; ?>
                                </p>
                            </div>
                            <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
                                <?php
                                $date1 = date_create((date('Y-m-d')));
                                $date2 = date_create($most_up['trip_date']);
                                $diff = date_diff($date1, $date2);
                                echo $diff->format('%a'); ?> days left
                            </div>
                        </div>
                        <!-- card -->

                        <ul class="pagination justify-content-center">
                            <a class="page-item" href="show_all_trip_of_hajjee.php?id=1">view all</a>
                        </ul>
                    <?php } else { ?>
                        <div class="card text-center" style="background-color:beige">
                            <div class="card-header" style="background-color:#D3D3D3">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">No Trips to Show</h5>
                            </div>
                            <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>



        <!-- flagger 1 -->

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    View Packages
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="d-grid gap-2 col-6 mx-auto justify-content-center">
                        <a href='show_all_trip_to_hajjee.php?id=1' class="btn btn-Primary">View by Date Ascending</a>
                        <a href='show_all_trip_to_hajjee.php?id=2' class="btn btn-Primary">View by Date Descending</a>
                        <a href='show_all_trip_to_hajjee.php?id=4' class="btn btn-Primary">View by cost Ascending </a>
                        <a href='show_all_trip_to_hajjee.php?id=3' class="btn btn-Primary">View by cost Descending</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Trip History
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="d-grid gap-2 col-6 mx-auto justify-content-center">
                        <a href='show_all_trip_of_hajjee.php?id=2' class="btn btn-Primary">View trip archive</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>