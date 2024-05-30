<?php defined("BASE_PATH") OR die("Access Denied!");
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

function doneSwitch($task_id){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "Update `tasks` set is_done = 1 - is_done where user_id = :userID and id = :taskID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskID'=>$task_id,':userID'=>$current_user_id]);
    return $stmt->rowCount();
}
function progressSwitch($task_id){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "Update `tasks` set in_progress = 1 - in_progress where user_id = :userID and id = :taskID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskID'=>$task_id,':userID'=>$current_user_id]);
    return $stmt->rowCount();
}
function addFolder($folder_name)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO folders (name, user_id) VALUES (:folderName, :userId)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folderName' => $folder_name , ':userId' => $currentUserId]);
    return $stmt->rowCount();
}

function getFolders()
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM folders WHERE user_id = $currentUserId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $records;
}


/*
* Tasks Management Functions
* CRUD Operations
*/

function deleteTask($task_id)
{
    global $pdo;
    $sql = "DELETE FROM tasks WHERE id = $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
function addTask($taskTitle, $folderId)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO tasks (title, user_id, folder_id) VALUES (:taskTitle, :userId, :folderId)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':taskTitle' => $taskTitle , ':userId' => $currentUserId, ':folderId' => $folderId]);
    return $stmt->rowCount();
}
function getTasks()
{
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;

    if (isset($folder) && is_numeric($folder))
    {
        $folderCondition = " AND folder_id = $folder";
    }else 
    {
        $folderCondition = "";
    }
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM tasks WHERE user_id = $currentUserId $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);

    return $records;
}
