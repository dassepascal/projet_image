<?php

echo '<h4>process_image.php </h4>';
require('config.php');

if (!isset($_POST['formImageSubmit'])) {
  var_dump($_POST['formImageSubmit']);

  $error_msg = 'Aucune donnée n\'est fournie.<a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
  var_dump(WEB_DIR_URL . 'admin.php');
}
if (isset($_POST['formImageSubmit'])) {
  $title        = $_POST['title'];
  $descr        = $_POST['descr'];
  $filename     = $_POST['filename'];
  if ((empty($title)) || (empty($descr)) || (empty($filename))) {

    $error_msg = ' une des informations est manquante.<a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
  } else {
    //enregistrement dans la base de donnees

  }
}
