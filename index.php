<?php
  include_once 'includes/dbConnection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestor de tareas goventure</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <header id="task_manager">
    <h1>Goventure task manager</h1>
  </header>
  <hr>
  <div class="container">
    <div id="task_form">
      <form action="index.php" method="POST">
        <input type="text" id="task" name="task" placeholder="Añade una nueva tarea">
        <input type="checkbox" id="tech1" name="tech[]" value="PHP">
        <label for="tech1">PHP</label>
        <input type="checkbox" id="tech2" name="tech[]" value="Javascript">
        <label for="tech2">Javascript</label>
        <input type="checkbox" id="tech3" name="tech[]" value="CSS">
        <label for="tech3">CSS</label>
        <input type="submit" id="btn" name="add" value="Añadir">
      </form>
      <?php
        if (isset($_POST['add'])) {
          //se inserta la tarea en la tabla maestra
          $task = $_POST['task'];
          $query = "INSERT INTO task_manager.tasks (description) VALUES ('$task');";
          $result = mysqli_query($connection, $query);

          // se obtiene el id de la tarea
          $query = "SELECT id_task FROM task_manager.tasks WHERE description = '".$task."';";
          $result = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($result)):
              if (isset($_POST['tech'])) {
                  $categories = $_POST['tech'];
                  for ($i=0; $i<count($categories); $i++){
                    //se obtiene el id de las categorias seleccionadas
                    $query = "SELECT id_category FROM task_manager.categories WHERE name = '".$categories[$i]."';";
                    $result = mysqli_query($connection, $query);
                    while($row2 = mysqli_fetch_assoc($result)):
                      $query2 = "INSERT INTO task_manager.new_task VALUES ('".$row['id_task']."', '".$row2['id_category']."');";
                      $result2 = mysqli_query($connection, $query2);
                    endwhile;
                   }
              }
          endwhile;
        }
      ?>
    </div>
    <div id="task_table">
      <table id="all_tasks">
        <tr>
          <th>Tarea</th>
          <th>Categorias</th>
          <th>Acciones</th>
        </tr>
        <tr>
          <?php
          $query = "SELECT 
                        t.description AS task_description,
                        GROUP_CONCAT(DISTINCT c.name SEPARATOR ' ') AS category_name
                    FROM
                        tasks t,
                        categories c,
                        new_task n
                    WHERE
                        t.id_task = n.id_new_task AND c.id_category = n.id_category
                    GROUP BY
                        task_description;";
          $result = mysqli_query($connection, $query);
          $resultCheck = mysqli_num_rows($result);

          //control de errores
          if ($resultCheck > 0){
            // imprimir el resultado hasta que no queden filas
              while($row = mysqli_fetch_assoc($result)):
          ?>
          <td><?php echo $row['task_description']; ?> </td>
          <td><?php echo $row['category_name']; ?> </td>
          <td>Borrar</td>
        </tr>
        <?php endwhile; 
              } ?>
      </table>
    </div>
  </div>



</body>

</html>