<?php

function show_hajjee_count_for_trips($email, $trip_date, object $pdo)
{
    try {
        $query = 'SELECT COUNT(hj_email) AS hajjee_count FROM trip_hajjee WHERE email = :email AND trip_date = :trip_date;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':trip_date', $trip_date);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['hajjee_count'];
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function change_previous_trip_status(object $pdo)
{
    try {
        $curr_date = date('Y-m-d');
        $query = 'UPDATE trip_muallim SET trip_status = \'Past\' WHERE trip_status = \'Upcoming\' AND DATEDIFF(:curr_date, trip_date) >= 1;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->execute();
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function most_upcoming_muallim_trip($email, object $pdo)
{
    try {
        $curr_date = date('Y-m-d');
        $result1 = day_count($email, $pdo);
        $query = 'SELECT * FROM trip_muallim WHERE DATEDIFF(trip_date, :curr_date) = :result1;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->bindParam(':result1', $result1);
        $stmt->execute();
        $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result2;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_all_upcoming_trips_from_database_for_muallim($email, object $pdo, $curr_date)
{
    try {
        $query = 'SELECT * FROM trip_muallim WHERE email = :email AND trip_date > :curr_date ORDER BY trip_date ASC;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_all_upcoming_trips_from_database(object $pdo, $curr_date, $flag)
{
    try {
        $query = '';
        if ($flag == 1) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_date > :curr_date ORDER BY trip_date ASC;';     // date ascending
        } else if ($flag == 2) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_date > :curr_date ORDER BY trip_date DESC;';    // date descending
        } else if ($flag == 3) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_date > :curr_date ORDER BY trip_cost DESC;';    // cost descending
        } else if ($flag == 4) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_date > :curr_date ORDER BY trip_cost ASC;';     // cost ascending
        }
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function day_count($email, object $pdo)
{
    try {
        $curr_date = date('Y-m-d');
        $query = 'SELECT MIN(DATEDIFF(trip_date, :curr_date)) AS min_diff FROM trip_muallim WHERE trip_date > :curr_date AND email = :email;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['min_diff'];
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function insert_into_trip_muallim($email, $trip_type, $trip_cost, $trip_date, object $pdo)
{
    try {
        $query = 'INSERT INTO trip_muallim VALUES(:email, :trip_cost, :trip_date, \'Upcoming\', :trip_type);';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':trip_cost', $trip_cost);
        $stmt->bindParam(':trip_date', $trip_date);
        $stmt->bindParam(':trip_type', $trip_type);
        $stmt->execute();
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function find_date_in_the_interval($email, $start_date, $end_date, object $pdo)
{
    try {
        $query = 'SELECT trip_date FROM trip_muallim WHERE email = :email AND trip_date >= :start_date AND trip_date <= :end_date;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['trip_date'];
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_trip_type_for_a_date($email, $trip_date, object $pdo)
{
    try {
        $query = 'SELECT trip_type FROM trip_muallim WHERE email = :email AND trip_date = :trip_date';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam('trip_date', $trip_date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['trip_type'];
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_a_trip($email, $trip_date, object $pdo)
{
    try {
        $query = 'SELECT * FROM trip_muallim WHERE email = :email AND trip_date = :trip_date';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam('trip_date', $trip_date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function cancel_a_trip($email, $trip_date, object $pdo)
{
    try {
        $query = 'DELETE FROM trip_muallim WHERE email = :email AND trip_date = :trip_date;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':trip_date', $trip_date);
        $stmt->execute();
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function day_update($email, $new_trip_date, $old_trip_date, object $pdo)
{
    try {
        $query = 'UPDATE trip_muallim SET trip_date = :new_trip_date WHERE trip_date = :old_trip_date AND email = :email;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':new_trip_date', $new_trip_date);
        $stmt->bindParam(':old_trip_date', $old_trip_date);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_past_trips($email, $year, $month, object $pdo, $flag)
{
    try {
        $query = '';
        $stmt = null;
        if ($flag == 0) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_status = \'Past\';';
            $stmt = $pdo->prepare($query);
        } else if ($flag == 1) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_status = \'Past\' AND MONTH(trip_date) = :month;';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':month', $month);
        } else if ($flag == 2) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_status = \'Past\' AND YEAR(trip_date) = :year;';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':year', $year);
        } else if ($flag == 3) {
            $query = 'SELECT * FROM trip_muallim WHERE trip_status = \'Past\' AND MONTH(trip_date) = :month AND YEAR(trip_date) = :year;';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':month', $month);
            $stmt->bindParam(':year', $year);
        }
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_hajjee_details($email, $tirp_date, object $pdo)
{
    try {

        $query = 'SELECT * FROM hajjee WHERE hj_email IN (SELECT hj_email FROM trip_hajjee WHERE email = :email AND trip_date = :trip_date);';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':trip_date', $tirp_date);
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_hajjee_details_for_show($email, object $pdo)
{
    try {
        $query = 'SELECT * FROM hajjee WHERE hj_email = :email;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam('email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (\Throwable $th) {
        //throw $th;
    }
}


function get_muallim_details($email, object $pdo)
{
    try {
        $query = 'SELECT * FROM muallim WHERE email = :email;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_address($po, object $pdo)
{
    try {
        $query = 'SELECT * FROM addresses WHERE post_code = :po;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':po', $po);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function find_date_in_the_interval_for_hajjee($hj_email, $start_date, $end_date, object $pdo)
{
    try {
        $query = 'SELECT trip_date FROM trip_hajjee WHERE hj_email = :hj_email AND trip_date >= :start_date AND trip_date <= :end_date;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':hj_email', $hj_email);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['trip_date'];
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function insert_into_trip_hajjee($email, $hj_email, $trip_date, object $pdo)
{
    try {
        $query = 'INSERT INTO trip_hajjee VALUES(:email, :hj_email, :trip_date);';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':hj_email', $hj_email);
        $stmt->bindParam(':trip_date', $trip_date);
        $stmt->execute();
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_most_up_of_hajjee($hj_email, object $pdo)
{
    try {
        $curr_date = date('Y-m-d');
        $min_diff = day_count_for_hajjee($hj_email, $pdo);
        $query = 'SELECT * FROM trip_hajjee WHERE hj_email = :hj_email AND DATEDIFF(trip_date, :curr_date) = :min_diff;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':hj_email', $hj_email);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->bindParam(':min_diff', $min_diff);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_result_1($email, $trip_date, object $pdo)
{
    try {
        $query = 'SELECT * FROM trip_muallim WHERE email = :email AND trip_date = :trip_date;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':trip_date', $trip_date);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}


function day_count_for_hajjee($email, object $pdo)
{
    try {
        $curr_date = date('Y-m-d');
        $query = 'SELECT MIN(DATEDIFF(trip_date, :curr_date)) AS min_diff FROM trip_hajjee WHERE trip_date > :curr_date AND hj_email = :email;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['min_diff'];
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function get_all_upcoming_trips_for_hajjee_from_database($email, object $pdo, $flag)
{
    try {
        $curr_date = date('Y-m-d');
        $query = '';
        if ($flag == 1) {
            $query = 'SELECT * FROM trip_muallim NATURAL JOIN trip_hajjee WHERE trip_date > :curr_date AND hj_email = :email;';
        } else if ($flag == 2) {
            $query = 'SELECT * FROM trip_muallim NATURAL JOIN trip_hajjee WHERE trip_date <= :curr_date AND hj_email = :email;';
        }
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':curr_date', $curr_date);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}

function cancel_trip_for_hajjee($email, $trip_date, object $pdo)
{
    try {
        $query = 'DELETE FROM trip_hajjee WHERE hj_email = :email AND trip_date = :trip_date;';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':trip_date', $trip_date);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        die('Query failed' . $e->getMessage());
    }
}
