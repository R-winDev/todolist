<?php
/*
* Folder Management Functions
* CRUD Operations
*/
function deleteFolder($folder_id)
{
    global $pdo;
    $sql = "DELETE FROM folders WHERE id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolders(array $data)
{
    global $pdo;
    $sql = "";
}

function getFolders()
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM folders WHERE user_id = $currentUserId;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $records;
}


/*
* Tasks Management Functions
* CRUD Operations
*/

function removeTasks()
{
    return 1;
}
function addTasks()
{
    return 1;
}
function getTasks()
{
    return 1;
}