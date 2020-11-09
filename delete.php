<?php 
include "includes/dbConnection.php";

$task_id = $_POST['id'];

if ($task_id > 0) {
  // Verificamos que la tarea existe
  $checkTask = mysqli_query($connection,"SELECT * FROM task_manager.tasks WHERE id_task =".$task_id);
  $numrows = mysqli_num_rows($checkTask);

  if($numrows > 0){
    // Borrado del registro
    $query = "DELETE FROM task_manager.tasks WHERE id_task =".$task_id;
    mysqli_query($connection,$query);
    echo 1;
    exit;
  }else{
    echo 0;
    exit;
  }
}
echo 0;
exit;