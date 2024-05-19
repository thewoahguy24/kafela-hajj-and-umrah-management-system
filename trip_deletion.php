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
    $date2 = date_create($row['trip_date']);
    $diff = date_diff($date1, $date2);
    $date_diff =  $diff->format('%a');
    if ($date_diff < 5) {
        header('Location: ../show.php?cancel=1');
    }
} else {
    header('Location: ../show.php?cancel=1');
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
    <h1 class="text-center">Do You Want to Cancel this Trip</h1>
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
        <form action="delete.php" method="post">
            <input hidden='true' name='email' value="<?php echo $row['email'] ?>">
            <input hidden='true' name='trip_date' value="<?php echo $row['trip_date'] ?>">
            <button type='submit' name="cancel_button" class="btn btn-Danger">cancel</button>
        </form>
    </div>
    <!-- card -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>