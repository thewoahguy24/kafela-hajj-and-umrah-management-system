<?php

function get_user_data($email, object $pdo)
{
    $query = 'SELECT * FROM muallim WHERE email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user_data;
}

function get_hj_user_data($email, object $pdo)
{
    $query = 'SELECT * FROM hajjee WHERE hj_email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user_data;
}


function get_user_address($po, object $pdo)
{
    $query = 'SELECT * FROM addresses WHERE post_code = :po;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':po', $po);
    $stmt->execute();

    $add = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = $add['upazila'] . ' - (' . $add['post_code'] . '), ' . $add['zila'] . ', ' . $add['bivag'];

    return $data;
}
