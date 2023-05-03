<?php
    session_start();

    include_once 'database.php';

    if(isset($_SESSION['userName'])){
        if($_SESSION['role'] == 'Admin'){
            header("Location:admin.php");
            exit();
        } elseif ($_SESSION['role'] == 'Student'){
            header("Location:studentProfile.php");
            exit();
        } elseif($_SESSION['role'] == 'Lecturer'){
            header("Location:lecturerProfile.php");
            exit();
        }
    }

    if (isset($_POST['login'])) {
        $userName = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = mysqli_prepare($connect, "SELECT * FROM user WHERE userName = ?");
        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['userName'] = $userName;
                $_SESSION['role'] = $row['role'];
    
                if ($row['role'] == 'Student') {
                    header("Location: studentProfile.php?login=success");
                    exit();
                } elseif ($row['role'] == 'Admin') {
                    header("Location: src/pages/Admin/admin.php?login=success");
                    exit();
                } elseif ($row['role'] == 'Lecturer') {
                    header("Location: lecturerProfile.php?login=success");
                    exit();
                }
            } else {
                header("Location:login.php?showModal=true&status=unsuccess&message=Password is mismatch");
                exit();
            }
        } else {
            header("Location:login.php?showModal=true&status=unsuccess&message=Member does not exist");
            exit();
        }
    }
?>