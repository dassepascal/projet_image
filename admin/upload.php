<?php
echo 'uploads';
require('../process/config.php');
require('../admin/menu.php');
//require('../process/process_image.php');
require('../class/Image.php');
//require('admin.php');




$uploads_dir = 'c:\wamp64/www/projet_imagebis/images/';





if (!empty($_FILES)) {
  $image = new Image();
  var_dump($image);

  $images = $image->upload($_FILES);
  var_dump($_FILES);
  if ($images === true) {
    var_dump('#1');
    var_dump($images);
    $msg_success = 'Le chargement a réussi';
    var_dump($msg_success);
  } else {
    $msg_error = 'Le chargement a échoué';
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <title>admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <div class="container">
    <form id="uploadForm" action="" method="post" enctype="multipart/form-data">

      <?php if (isset($msg_success)) : ?>
        <p class="msg_success"><?= $msg_success ?> </p>
      <?php endif ?>
      <?php if (isset($msg_error)) : ?>
        <p class="msg_error"><?= $msg_error ?> </p>
      <?php endif ?>



      <p>Ajouter des images</p>
      <input type="file" value="" name="upload[]" multiple="mutilple">
      <input id="uploadFormSubmit" name="uploadFormSubmit" type="submit">
    </form>
  </div>

</body>

</html>
