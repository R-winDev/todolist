<?php defined("BASE_PATH") OR die("Access Denied!");
/*
* Auth Functions
* validation the user!
*/

function isLoggedIn()
{
    return false;
}

function getCurrentUserId()
{
    // Get login user id
    return 1;
}

function login($email, $password)
{
    return 1;
}

function register($userData)
{
    global $pdo;
    # validation of $userData here (isValidEmail,isValidUserName,isValidPassword)
    $passHash = password_hash($userData['password'],PASSWORD_BCRYPT);
    $sql = "INSERT INTO `users` (name,email,password) VALUES (:name,:email,:pass);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name'=>$userData['name'],':email'=>$userData['email'],':pass'=>$passHash]);
    return $stmt->rowCount() ? true : false;
}