<?php
  $dbServer = "localhost";
  $dbUser = "root";
  $dbPassword ="";
  $dbName = "task_manager";

  $connection = new mysqli($dbServer, $dbUser, $dbPassword, $dbName);

  // control de errores
  if ($connection -> connect_errno) {
    echo "Conexión fallida: " . $connection -> connect_error;
  exit();
  }
?>