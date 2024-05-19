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
                    Upcoming Trips
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <?php
                    require_once 'dbhandlers/trip_mvc/control.php';
                    require_once 'comp/connect_to_db.php';
                    change_status_of_previous_trip($pdo);
                    $most_up = get_most_up($_SESSION['user_id'], $pdo);
                    if ($most_up) {
                    ?>
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
                                <form action="view_muallim_trip_details.php" method="post">
                                    <input hidden name="trip_date" value="<?php echo $most_up['trip_date'] ?>">
                                    <button type="submit" class="btn btn-primary">View Details</button>
                                </form>
                            </div>
                            <div class="card-footer text-body-secondary" style="background-color:#D3D3D3">
                                <?php echo get_day_count($most_up['email'], $pdo); ?> days left
                            </div>
                        </div>
                        <!-- CARD -->

                        <ul class="pagination justify-content-center">
                            <a class="page-item" href="show.php">view all</a>
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
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Manage Trips
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <!-- button 1 -->
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modal1">Create Trip</button>

                        <!-- Modal 1 -->
                        <div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Trip</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="dbhandlers/trip_creation_insert.php" method="post">
                                        <div class="modal-body">
                                            <!-- email -->
                                            <div class="mb-2 row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" readonly class="form-control-plaintext" id="staticEmail" name='email' value="<?php echo $_SESSION['user_id']; ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <!-- trip type -->
                                            <select class="form-select" aria-label="Default select example" name="trip_type">
                                                <option selected>Select trip type</option>
                                                <option value="Hajj">Hajj</option>
                                                <option value="Omrah">Omrah</option>
                                            </select>
                                            <div class="mb-3"><!-- Cost -->
                                                <label for="cost" class="form-label">cost</label>
                                                <input type="number" class="form-control" id="cost" name="cost">
                                            </div>
                                            <div class="mb-3"><!-- date -->
                                                <label class="col-sm-2 col-form-label">Trip date : </label>
                                                <input type="date" name="trip_date">
                                            </div>
                                            <div class="mb-3 form-check"><!--check box-->
                                                <input type="checkbox" class="form-check-input" id="Check" name="Check">
                                                <label class="form-check-label" for="Check">The above information is correct</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">create</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- button 2 -->
                        <a href="show.php?update=1" class="btn btn-primary" type="button">Update Trip</a>

                        <!-- button 3 -->
                        <a href="show.php?cancel=1" class="btn btn-primary" type="button">Cancel Trip</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    View Past Trips
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form class='text-center' action='show_past.php' method='get'>
                        <div class="col-auto">
                            <label class="col-sm-2 col-form-label">Year</label>
                            <input type="number" name='past_trip_year' value=''>
                        </div>

                        <div class="col-auto">
                            <label class="col-sm-2 col-form-label">Month</label>
                            <input type="number" name='past_trip_month' value=''>
                        </div> <br>

                        <div class='col-auto'>
                            <button type="submit" class="btn btn-primary">SEARCH</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>