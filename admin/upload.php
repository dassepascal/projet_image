<?php
echo 'upload';
require('menu.php');
$upload_errors = array(

  UPLOAD_ERR_OK             => "No errors.",
  UPLOAD_ERR_INI_SIZE       => "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE      => "Larger than form MAX_FILE_SIZE.",
  UPLOAD_ERR_PARTIAL        => " Partial upload",
  UPLOAD_ERR_NO_FILE        => "No file.",
  UPLOAD_ERR_NO_TMP_DIR     => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE     => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION       => "File upload stopped by extension."
);
var_dump('#1');

if (isset($_POST['submit'])) {
  var_dump('#2');
  $tmp_file = $_FILES['file_upload']['tmp_name'];

  var_dump($tmp_file);
  $target_file = basename($_FILES['file_upload']['name']);
  var_dump($target_file);
  $upload_dir = 'c:\wamp64/www/projet_imagebis/images/';
  var_dump($upload_dir);
  if (move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)) {
    $message = "File uploaded successfully.";
  } else {
    $error = $_FILES['file_upload']['error'];
    $message = $upload_errors[$error];
  }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>upload</title>
</head>

<body>
  <div id="container">
    <?php if (!empty($message)) {
      echo "<p>{$message}</p>";
    } ?>
    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
      <p>Ajouter des images</p>
      <input type="file" value="" name="file_upload" multiple="multiple">

      <input id="uploadFormSubmit" name="submit" type="submit">
    </form>

  </div>
</body>

</html>
