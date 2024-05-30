<?php 

include "constants.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";



try 
{
    $pdo = new PDO("mysql:dbname={$databaseConfig->db};host={$databaseConfig->host}", $databaseConfig->user, $databaseConfig->pass);
} 
catch (PDOException $e)
{
    diePage('Connection Failed: ' . $e->getMessage());
}


include BASE_PATH . "libs/lib-auth.php";
include BASE_PATH . "libs/lib-tasks.php";