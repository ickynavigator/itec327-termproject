<?php
session_start();

if (!$_SESSION['login_user']) {
    header("location:./login.php");
    die();
}

function my_function_session_check()
{
    $user_check = $_SESSION['login_user'];
    if ($user_check) {
        $sql = "SELECT * FROM `users` WHERE `email`='$user_check'";
        $res = $GLOBALS["conn"]->query($sql);
        if ($res->num_rows === 1) {
            $row = $res->fetch_assoc();
            return [$row['email'], $row['name']];
        } else {
            header("location:./login.php");
            die();
        }
    }
}

$user_check = my_function_session_check(); {
    $login_mail = $user_check[0];
    $login_name = $user_check[1];
}
