<?php

echo '<h4>process_image.php </h4>';
require('config.php');

if (!isset($_POST['formImageSubmit'])) {
  var_dump($_POST['formImageSubmit']);

  $error_msg = 'Aucune donnée n\'est fournie.<a href="' . WEB_DIR_URL . 'admin.php">retour</a>';
  var_dump(WEB_DIR_URL . 'admin.php');
}
