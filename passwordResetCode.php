<?php

    session_start();

    include 'database.php';
    include 'src/utils/password_utils.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //location of email template file

    function send_password_reset($userName, $token, $email) {
        $mail = new PHPMailer(true);
    
        try {
            // SMTP configuration
            $mail->isSMTP(); 
            $mail->SMTPAuth = true; 
            $mail->Host = 'smtp.gmail.com';                                                 
            $mail->Username = 'studentattendancesystem.susl@gmail.com';                   
            $mail->Password = 'ojunvwupiyzejcno';   
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         
            $mail->Port = 465; 
    
            // Sender and recipient settings
            $mail->setFrom('no-reply@sas.susl.com', "Student Attendance System");
            $mail->addReplyTo('no-reply@sas.susl.com', "Student Attendance System");
            $mail->addAddress($email);
    
            // Email content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Password Reset Request from Student Attendance System';
            $email_template = "
                <html>
                <head>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Reset Password</title>
                </head>
                <body style='font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; color: #444; max-width: 600px; margin: 0 auto;'>
                    <div style='background-color: #f2f2f2; padding: 40px;'>
                        <div style='background-color: #fff; border-radius: 5px; padding: 40px;'>
                            <h1 style='text-align: center; margin: 0;'>Reset Password</h1>
                            <hr style='border-top: 1px solid #f2f2f2;'>
                            <p>Hello $userName,</p>
                            <p>You have requested to reset your password for your account.</p>
                            <p style='text-align: center;'>
                                <a href='http://localhost/attendanceSystem/resetpassword.php?token=$token&email=$email' style='display: inline-block; background-color: #007bff; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 4px;'>Reset Password</a>
                            </p>
                            <p>If you did not request a password reset, please ignore this email.</p>
                        </div>
                        <div style='text-align: center; margin-top: 20px;'>
                            <p style='font-size: 12px; color: #999;'>This email was sent from the Student Attendance System. &copy; ".date("Y")."</p>
                        </div>
                    </div>
                </body>
                </html>
            "; 
            $mail->Body = $email_template;
    
            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            header("Location:login.php?showModal=true&status=unsuccess&message=Email not sent! " . $e->getMessage());
        }
    }

    if(isset($_POST['password_reset_link'])){
        $userName= mysqli_real_escape_string($connect,$_POST['userName']);
        $token = md5(rand());

        $check_username = "SELECT * FROM user WHERE userName = '$userName' LIMIT 1";
        $check_username_run = mysqli_query($connect,$check_username);

        

        if(mysqli_num_rows($check_username_run) > 0) {
            $row = mysqli_fetch_array($check_username_run);
            $userName = $row['userName'];
            $role = strtolower($row['role']);
            $find_email = "SELECT email FROM $role WHERE userName = '$userName'";
            $find_email_run = mysqli_query($connect,$find_email);
            
            $email = mysqli_fetch_array($find_email_run)['email'];

            $update_token = "UPDATE user SET verify_token = '$token' WHERE userName = '$userName' LIMIT 1";
            $update_token_run = mysqli_query($connect,$update_token);

            if($update_token_run){
                send_password_reset($userName,$token,$email);
                header("Location:forgotpassword.php");
                exit();
            } else {
                header("Location:forgotpassword.php?showModal=true&status=unsuccess&message=Something went wrong");
                exit();
            }
        } else {
            header("Location:forgotpassword.php?showModal=true&status=unsuccess&message=User does not exist");
            exit();
        }
    }


    if(isset($_POST['password_update'])){
        $new_password = mysqli_real_escape_string($connect,$_POST['pwd']);
        $new_confirm_password = mysqli_real_escape_string($connect,$_POST['confirmpwd']);
        $token = mysqli_real_escape_string($connect,$_POST['pwd_token']);

        if(!empty($token)){
            if(!empty($token) && !empty($new_password) && !empty($new_confirm_password)){
                $check_token = "SELECT verify_token FROM user WHERE verify_token='$token' LIMIT 1";
                $check_token_run = mysqli_query($connect,$check_token);

                if(mysqli_num_rows($check_token_run) > 0){
                    if($new_password == $new_confirm_password){


                        if(is_password_strong($new_password)){
                            header("Location:resetPassword.php?showModal=true&status=unsuccess&message=Password is too weak " . $e->getMessage());
                            exit();
                        } else {
                            $hashed_new_password = password_hash($new_password,PASSWORD_DEFAULT);
                            $update_password = "UPDATE user SET password = '$hashed_new_password' WHERE verify_token = '$token' LIMIT 1";
                            $update_password_run = mysqli_query($connect,$update_password);

                            if($update_password_run){
                                $new_token = md5(rand());
                                $update_to_new_token = "UPDATE user SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1";
                                $update_to_new_token_run = mysqli_query($connect,$update_to_new_token);

                                header("Location:login.php?showModal=true&status=success&message=Password changed successful ");
                                exit();
                            } else {

                                header("Location:forgotpassword.php?showModal=true&status=unsuccess&message=Password changed unsuccessful ");
                                exit();
                            }

                        }
                    } else {

                        header("Location:resetPassword.php?showModal=true&status=unsuccess&message=Password is mismatch ");
                                exit();
                    }
                } else {

                    header("Location:resetPassword.php?showModal=true&status=unsuccess&message=Password changed unsuccessful ");
                    exit();
                }

            } else {

                header("Location:resetPassword.php");
                exit();
            }
        } else {

            header("Location:resetPassword.php");
            exit();
        }
    }
?>








