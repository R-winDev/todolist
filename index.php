<?php 

include "bootstrap/init.php";

// use delete functions before the get functions because we do not want to see the deleted items any more!
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder']))
{
    $count = deleteFolder($_GET['delete_folder']);
    // echo "$count folders has been deleted!";
}



// connect to db and get the data
$folders = getFolders();
$tasks = getTasks();

include "tpl/tpl-index.php";