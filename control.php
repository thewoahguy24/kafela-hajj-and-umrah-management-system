<?php

function hajjee_count($email, $date, object $pdo)   // hajjee count
{
    require_once 'model.php';
    $data = show_hajjee_count_for_trips($email, $date, $pdo);
    return $data;
}

function change_status_of_previous_trip(object $pdo)    // change status of the previous trip
{
    require_once 'model.php';
    change_previous_trip_status($pdo);
}

function get_most_up($email, object $pdo)   // get the most upcoming trip
{
    require_once 'model.php';
    $result = most_upcoming_muallim_trip($email, $pdo);
    return $result;
}

function get_all_trips($email, object $pdo, $flag) // get all the upcoming trip
{
    require_once 'model.php';
    if ($flag == 0) {
        return get_all_upcoming_trips_from_database_for_muallim($email, $pdo, date('Y-m-d'));
    } else {
        return get_all_upcoming_trips_from_database($pdo, date('Y-m-d'), $flag);
    }
}

function get_all_past_trips($email, $year, $month, object $pdo) // get all the past trips
{
    require_once 'model.php';
    if ($year == '' && $month == '') {
        return get_past_trips($email, $year, $month, $pdo, 0);
    } else if ($year == '') {
        return get_past_trips($email, $year, $month, $pdo, 1);
    } else if ($month == '') {
        return get_past_trips($email, $year, $month, $pdo, 2);
    } else {
        return get_past_trips($email, $year, $month, $pdo, 3);
    }
}

function get_a_trip_based_on_date_and_email($email, $trip_date, object $pdo)    // get a particular trip
{
    require_once 'model.php';
    return get_a_trip($email, $trip_date, $pdo);
}

function get_day_count($email, object $pdo) // get the day left for upcoming trip
{
    require_once 'model.php';
    $result = day_count($email, $pdo);
    return $result;
}

function create_trip_for_muallim($email, $trip_type, $trip_cost, $trip_date, object $pdo)   // create a package
{
    require_once 'model.php';
    $result = insert_into_trip_muallim($email, $trip_type, $trip_cost, $trip_date, $pdo);
    return $result;
}

function is_date_available($email, $trip_date, $trip_type, object $pdo) // check if a date for creating package is available
{
    require_once 'model.php';
    $start_date = '';
    $end_date = '';
    if ($trip_type == 'Hajj') {
        $start_date = date('Y-m-d', strtotime($trip_date . ' - 20 days'));
        $end_date = date('Y-m-d', strtotime($trip_date . ' + 50 days'));
    } else {
        $start_date = date('Y-m-d', strtotime($trip_date . ' - 20 days'));
        $end_date = date('Y-m-d', strtotime($trip_date . ' + 20 days'));
    }

    if (find_date_in_the_interval($email, $start_date, $end_date, $pdo)) {        // checking if there is trip in this interval
        return true;
    } else {
        return false;
    }
}

function get_trip_type($trip_date, $email, object $pdo) // get the trip type for muallim
{
    require_once 'model.php';
    return get_trip_type_for_a_date($email, $trip_date, $pdo);
}

function cancel_trip($email, $trip_date, object $pdo)   // cancel a trip for muallim
{
    require_once 'model.php';
    cancel_a_trip($email, $trip_date, $pdo);
}

function update_trip_day($email, $new_trip_date, $old_trip_date, object $pdo)   // update the trip date for muallim
{
    require_once 'model.php';
    day_update($email, $new_trip_date, $old_trip_date, $pdo);
}

function get_hajjee_and_trip_details($email, $trip_date, object $pdo)
{
    require_once 'model.php';
    return get_hajjee_details($email, $trip_date, $pdo);
}

function get_hajjee_details_for_showing($email, object $pdo)
{
    require 'model.php';
    return get_hajjee_details_for_show($email, $pdo);
}

function get_muallim_details_from_database($email, $operation, object $pdo)
{
    require_once 'model.php';
    $result = get_muallim_details($email, $pdo);
    if ($operation == 'name') {
        return $result['fname'] . ' ' . $result['lname'];
    } else if ($operation == 'email') {
        return $result['email'];
    } else if ($operation == 'mobile') {
        return $result['mobile'];
    } else if ($operation == 'address') {
        return get_address($result['post_code'], $pdo);
    } else {
        return $result;
    }
}

function is_date_available_for_booking($hj_email, $trip_date, $trip_type, $pdo)
{
    require_once 'model.php';
    $start_date = '';
    $end_date = '';
    if ($trip_type == 'Hajj') {
        $start_date = date('Y-m-d', strtotime($trip_date . ' - 20 days'));
        $end_date = date('Y-m-d', strtotime($trip_date . ' + 50 days'));
    } else {
        $start_date = date('Y-m-d', strtotime($trip_date . ' - 20 days'));
        $end_date = date('Y-m-d', strtotime($trip_date . ' + 20 days'));
    }

    if (find_date_in_the_interval_for_hajjee($hj_email, $start_date, $end_date, $pdo)) {        // checking if there is trip in this interval
        return true;
    } else {
        return false;
    }
}

function book_trip_for_hajjee($email, $hj_email, $trip_date, object $pdo)
{
    require_once 'model.php';
    insert_into_trip_hajjee($email, $hj_email, $trip_date, $pdo);
}

function get_most_up_for_hajjee($hj_email, object $pdo)
{
    require_once 'model.php';
    $result0 = get_most_up_of_hajjee($hj_email, $pdo);
    if ($result0) {
        return get_result_1($result0['email'], $result0['trip_date'], $pdo);
    } else {
        return null;
    }
}

function get_all_upcoming_trips_of_hajjee($email, object $pdo, $flag)
{
    require_once 'model.php';
    return get_all_upcoming_trips_for_hajjee_from_database($email, $pdo, $flag);
}

function delete_trip_for_hajjee($email, $trip_date, object $pdo)   // delete a particular trip for hajjee
{
    require_once 'model.php';
    return cancel_trip_for_hajjee($email, $trip_date, $pdo);
}

function get_address_for_show($po, object $pdo)
{
    require_once 'model.php';
    $result = get_address($po, $pdo);
    return $result['upazila'] . ' - ' . '(' . $result['post_code'] . '), ' . $result['zila'] . ', ' . $result['bivag'];
}
