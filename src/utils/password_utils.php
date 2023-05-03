<?php

function is_password_strong($password) {
    // Check if password is at least 8 characters long
    if (strlen($password) < 8) {
        return false;
    }
    // Check if password contains at least one digit
    if (!preg_match("/\d/", $password)) {
        return false;
    }
    // Check if password contains at least one uppercase letter
    if (!preg_match("/[A-Z]/", $password)) {
        return false;
    }
    // Check if password contains at least one lowercase letter
    if (!preg_match("/[a-z]/", $password)) {
        return false;
    }
    return true;
}
