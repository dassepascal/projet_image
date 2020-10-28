<?php

echo '<h4>process_image.php </h4>';
require('config.php');
require('class/Image.php');

if (!isset($_POST['formImageSubmit'])) {


  $msg_error = 'Aucune donnée n\'est fournie.<a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
}
if (isset($_POST['formImageSubmit'])) {
  $title        = $_POST['title'];
  $descr        = $_POST['descr'];
  $filename     = $_POST['filename'];
  if ((empty($title)) || (empty($descr)) || (empty($filename))) {

    $msg_error = ' une des informations est manquante.<a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
  } else {

    if (isset($_POST['update'])) {
      $image = new Image();
      $insertImage = $image->updateImageData($title, $descr, $filename);
      var_dump($insertImage); //true
      if (true === $insertImage) {
        header('location:' . WEB_DIR_URL . 'admin.php?insertImage=ok');
      } else {
        $msg_error = '<br><a href="' . WEB_DIR_URL . 'admin.php"></a>';
      }
    } else {
      //enregistrement dans la base de donnees
      $image = new Image();
      $insertImage = $image->insertImage($title, $descr, $filename);
      var_dump($insertImage);
      if (true === $insertImage) {
        //header('location:' . WEB_DIR_URL . 'admin.php?insertImage=ok');
        $msg_sucess = 'les informations ont bien été enregistrées dans la base de données.<a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
      } else {
        $msg_error = $insertImage;
      }
    }
  }
}

if (isset($msg_error)) echo $msg_error;
if (isset($msg_sucess)) echo $msg_sucess;
