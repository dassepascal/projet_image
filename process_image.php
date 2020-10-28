<?php

echo '<h4>process_image.php </h4>';
require('config.php');
//require('class/Image.php');

if (!isset($_POST['formImageSubmit'])) {


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

    if (isset($_POST['update'])) {
      $image = new Image();
      $insertImage = $image->updateImageData($title, $descr, $filename);
      var_dump($insertImage); //true
      if (true === $insertImage) {
        header('location:' . WEB_DIR_URL . 'admin.php?insertImage=ok');
      } else {
        $error_msg = '<br><a href="' . WEB_DIR_URL . 'admin.php"></a>';
      }
    } else {
      //enregistrement dans la base de donnees
      $image = new Image();
      $insertImage = $image->insertImage($title, $descr, $filename);
      var_dump($insertImage);
      if (true === $insertImage) {
        header('location:' . WEB_DIR_URL . 'admin.php?insertImage=ok');
      } else {
        $error_msg = '<br><a href="' . WEB_DIR_URL . 'admin.php"></a>';
      }
    }
  }
}
