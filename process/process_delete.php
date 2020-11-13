<?php
echo '<h4> process_delete</h4>';
require('../class/Image.php');
require('../process/config.php');
if (isset($_GET['delete'])) {

  $filename = $_GET['delete'];
  $image = new Image();
  $deleteImage = $image->deleteImage($filename);
  if (true == $filename) {
    $msg_success = 'L\'image ' . $filename . ' a bien été effacer' . '';
  }

  if (isset($msg_success)) {

    echo $msg_success;
  }
}
