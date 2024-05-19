<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require "../comp/navigation.php";
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
    }
    $trip_date = $_GET['id'];
    require_once '../comp/connect_to_db.php';
    require_once 'trip_mvc/control.php';
    $row = get_a_trip_based_on_date_and_email($_SESSION['user_id'], $trip_date, $pdo);
    $date1 = date_create((date('Y-m-d')));
    $date2 = date_create($trip_date);
    $diff = date_diff($date1, $date2);
    $date_diff =  $diff->format('%a');
    if ($date_diff < 5) {
        header('Location: ../show.php?update=1');
    }
} else {
    header('Location: ../show.php?update=1');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <h1 class="text-center">Do You Want to Update this Trip</h1>
    <!-- card -->
    <div class="card text-center">
        <div class="card-header">
            <?php echo $row['trip_status']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['trip_type'] . '_' . $row['trip_date']; ?></h5>
            <p class="card-text">
                Hajjee count : <?php echo hajjee_count($row['email'], $row['trip_date'], $pdo); ?>
            </p>
        </div>
        <div class="card-footer text-body-secondary">
            <?php
            echo $date_diff; ?> days left
        </div>
        <!-- Update -->
        <div class='justify-content-center'>
            <button type='button' class="btn btn-Success" data-bs-toggle="modal" data-bs-target="#modal">Update</button>
        </div>
    </div>
    <!-- card -->

    <!-- Update form Modal -->
    <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Trip</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update.php" method="post">
                    <div class="modal-body">
                        <!-- email -->
                        <div class="mb-2 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" readonly class="form-control-plaintext" id="staticEmail" name='email' value="<?php echo $_SESSION['user_id']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="mb-3"><!-- old date -->
                            <label class="col-sm-2 col-form-label">Old date : </label>
                            <input readonly name='old_trip_date' value="<?php echo $trip_date ?>">
                        </div>
                        <div class="mb-3"><!-- new date -->
                            <label class="col-sm-2 col-form-label">New date : </label>
                            <input type="date" name="new_trip_date" value="<?php echo $trip_date ?>">
                        </div>
                        <div class="mb-3 form-check"><!--check box-->
                            <input type="checkbox" class="form-check-input" id="Check" name="Check">
                            <label class="form-check-label" for="Check">The above information is correct</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-Success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>