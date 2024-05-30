<?php 

include "bootstrap/init.php";
$homeUrl = siteUrl();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == 'register')
    {
        $result = register($params);
        if (!$result)
        {
            message("Error: an error in Registration!");
        }else
        {
            message("Registration is Successful. Welcome to ". SITE_TITLE .".<br>
            <a href='{$homeUrl}auth.php'>Please Login</a>
            ",'success');
        }
    }elseif ($action == 'login')
    {
        $result = login($params['email'], $params['password']);
        if (!$result)
        {
            message("Error: email or password is Incorrect!");
        }
    }
}




include "tpl/tpl-auth.php";