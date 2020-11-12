<?php
echo '<h4> process_delete</h4>';
require('../class/Image.php');
require('../process/config.php');
if (isset($_GET['delete'])) {
  var_dump(isset($_GET['delete']));
  var_dump(($_GET['delete']));
  $filename = $_GET['delete'];
  // $image = new Image();
  // $deleteImage = $image->deleteImage($filename);
  //var_dump($filename);
}
