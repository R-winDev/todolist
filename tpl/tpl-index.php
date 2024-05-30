<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
        <a style="text-decoration: none; color: #555;" href="<?= siteUrl() ?>"><li class="<?= isset($_GET['folder_id']) ? '' : 'active' ;?>"> <i class="fa fa-folder-open"></i>All</li></a>

          <?php foreach ($folders as $folder):?>
          <li class="<?php 
          if (isset($_GET['folder_id']))
          {
            if ($_GET['folder_id'] == $folder->id)
            {
              echo "active";
            }
          }else
          {
            echo "";
          }
          ?>">
            <a href="<?= siteUrl("?folder_id=$folder->id") ?>"><i class="fa fa-folder"></i><?=$folder->name?></a>
            <a href="?delete_folder=<?=$folder->id?>"><i class="fa fa-trash" onclick="return confirm('Do you want to delete <?= $folder->name ?> folder?')"></i></a>
          </li>
          <?php endforeach; ?>

        </ul>
        <div>
          <input type="text" id="addFolderInput" placeholder="Add New Folder"/>
          <button class="clickable" id="addFolderBtn">+</button>
        </div>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">
          <input type="text" id="TaskNameInput" placeholder="Add New Task" style="width : 40vw; line-height:30px;"/>
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <?php if(sizeof($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
              <li class="<?= $task->is_done ? 'checked' : 'info' ; ?>"><i data-taskId="<?= $task->id ?>" class="isDone clickable <?= $task->is_done ? 'fa fa-check-square-o' : 'fa fa-square-o' ; ?>"></i><span><?= $task->title ?></span>
                <div class="info">
                  <div data-taskId="<?= $task->id ?>" class="is-inProgress <?= $task->in_progress || $task->is_done ? 'button green' : 'button' ; ?>"><?= $task->is_done ? 'Done!' : ($task->in_progress ? 'In Progress' : 'Pending') ; ?></div><span>Created at <?= $task->created_at ?></span>
                  <a href="?delete_task=<?=$task->id?>"><i class="fa fa-trash" style="color : #555;" onMouseOver="this.style.color='#E57373'" onMouseOut="this.style.color='#555'" onclick="return confirm('Do you want to delete <?= $task->title ?> task?')"></i></a>
                </div>
              </li>
            <?php endforeach; ?>
            <?php else: ?>
              <li>NO Task Here ...</li>
            <?php endif?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="assets/js/script.js"></script>
  <script src="assets/js/script.js"></script>
  <script>
  $(document).ready(function()
  {
    $('.isDone').click(function(e)
    {
      var tid = $(this).attr('data-taskId');
      $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action : "doneSwitch" , taskId : tid},
      success : function(response)
      {
        if (response = 1)
        {
          location.reload();
        }
        else 
        {
          alert(response);
        }
      }
    });
    });

    $('.is-inProgress').click(function(e)
    {
      var tid = $(this).attr('data-taskId');
      $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action : "progressSwitch" , taskId : tid},
      success : function(response)
      {
        if (response = 1)
        {
          location.reload();
        }
        else 
        {
          alert(response);
        }
      }
    });
    });

    $('#addFolderBtn').click(function(e)
  {
    var input = $('input#addFolderInput');
    $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action : "addFolder" , folderName : input.val()},
      success : function(response)
      {
        if (response = "1")
        {
          $('<li> <a href="#"><i class="fa fa-folder"></i>'+input.val()+'</a></li>').appendTo('ul.folder-list');
        }
        else 
        {
          alert(response);
        }
      }
    });
  });
  $('#TaskNameInput').keypress(function(e)
  {
    e.stopPropagation();
    if (e.which == 13)
    {
      var input = $('input#TaskNameInput')
      $.ajax({
      url : "process/ajaxHandler.php",
      method : "post",
      data : {action : "addTask" ,folderId : <?= $_GET['folder_id'] ?? 0 ; ?> , taskTitle : input.val()},
      success : function(response)
      {
        if (response == true)
        {
          location.reload();
        }
        else 
        {
          alert(response);
        }
      }
    });
    }
  });
  $('#TaskNameInput').focus();
  });
  </script>
</body>
</html>
