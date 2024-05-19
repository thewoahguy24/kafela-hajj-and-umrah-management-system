<?php

function check_duplicate_email(object $pdo, string $email)
{
    $query = 'SELECT email FROM muallim WHERE email = :email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function check_hj_duplicate_email(object $pdo, string $hj_email)
{
    $query = 'SELECT hj_email FROM hajjee WHERE hj_email = :hj_email;';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':hj_email', $hj_email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function insert_to_database(object $pdo, $email, $fusername, $lusername, $mobile, $po, $aglicense, $pass)
{
    try {
        $query = "INSERT INTO muallim(email, pass, mobile, fname, lname, post_code, agency_regi) VALUES(:email, :pass, :mobile, :fname, :lname, :post_code, :aglicense);";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':fname', $fusername);
        $stmt->bindParam(':lname', $lusername);
        $stmt->bindParam(':post_code', $po);
        $stmt->bindParam(':aglicense', $aglicense);
        $stmt->execute();
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

function insert_hj_to_database(object $pdo, $hj_email, $hj_username, $hj_mobile, $po, $pass)
{
    $query = "INSERT INTO hajjee(hj_user_name, hj_email, hj_pass, hj_post_code, hj_mobile) VALUES(:hj_username, :hj_email, :pass, :post_code, :hj_mobile);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':hj_email', $hj_email);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':hj_mobile', $hj_mobile);
    $stmt->bindParam(':hj_username', $hj_username);
    $stmt->bindParam(':post_code', $po);

    $stmt->execute();
}
