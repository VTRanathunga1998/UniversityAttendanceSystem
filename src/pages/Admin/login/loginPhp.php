<?php
session_start();
ob_start();

include "../../../../database.php";

if (isset($_POST["submit"])) {
    $userName = $_POST["username"];
    $pass = $_POST["password"];
    $sql = "SELECT * FROM user WHERE userName = '$userName'";
    $result = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($result);

    echo $userName;

    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row["password"];

        if (password_verify($pass, $hashedPassword)) {
            $_SESSION["loginMessage"] =
                '<span class="success">Welcome ' . $userName . "</span>";
            $_SESSION["userName"] = $userName; //changed by wiraj

            header(
                "location: http://localhost/UniversityAttendanceSystem/src/pages/Admin/admin.php"
            );
            exit();
        } else {
            $_SESSION["status"] = "Password is mismatch";
            $_SESSION["state"] = "danger";
            header(
                "location: http://localhost/UniversityAttendanceSystem/src/pages/admin/login/login.php"
            );
            exit();
        }
    } else {
        $_SESSION["status"] = "User does not exist";
        $_SESSION["state"] = "primary";
        header(
            "location: http://localhost/UniversityAttendanceSystem/src/pages/admin/login/login.php"
        );
        exit();
    }
}
ob_flush();
