<?php

session_start();

include 'database.php';
include 'src/utils/password_utils.php';

if(!isset($_SESSION['userName'])){
    header("Location: src/pages/Admin/login/login.php");
    exit();
}

$userName = $_SESSION['userName'];

if (isset($_POST['password_update'])) {
    $new_password = mysqli_real_escape_string($connect, $_POST['pwd']);
    $new_confirm_password = mysqli_real_escape_string($connect, $_POST['confirmpwd']);

    if (!empty($new_password) && !empty($new_confirm_password)) {
        if ($new_password == $new_confirm_password) {
            if (!is_password_strong($new_password)) {
                header("Location: resetPassword.php?showModal=true&status=unsuccess&message=Password is too weak");
                exit();
            } else {
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Corrected this line to concatenate the session variable into the query
                $update_password = "UPDATE user SET password = '$hashed_new_password' WHERE userName = '$userName'";
                $update_password_run = mysqli_query($connect, $update_password);

                if ($update_password_run) {
                    unset($_SESSION['userName']);

                    $update_verification = "UPDATE user SET verified = 1 WHERE userName = '$userName'";
                    $update_verification_run = mysqli_query($connect, $update_verification);

                    if($update_verification_run){
                        header("Location: src/pages/Admin/login/login.php?showModal=true&status=success&message=Password changed successfully");
                        exit();
                    }
                } else {
                    header("Location: src/pages/Admin/login/login.php?showModal=true&status=unsuccess&message=Password change unsuccessful");
                    exit();
                }
            }
        } else {
            header("Location: resetPassword.php?showModal=true&status=unsuccess&message=Passwords do not match");
            exit();
        }
    }
}
?>







