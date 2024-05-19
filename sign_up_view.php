<?php

function check_errors_at_signup(){
    if (isset($_SESSION['errors'])) {
        $showerror = $_SESSION['errors'];
        echo '<br>';
        foreach ($showerror as $er) {
            echo $er.'<br>';
        }
        unset($_SESSION['errors']);
    } else if (isset($_GET['signup']) && $_GET['signup'] == 'success'){
        echo 'signup success';
    }
}