<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>upload</title>
</head>

<body>
  <?php print_r($_FILES); ?>
  <form id="uploadForm" action="" method="post" enctype="multipart/form-data">
    <p>Ajouter des images</p>
    <input type="file" value="" name="upload[]" multiple="multiple">

    <input id="uploadFormSubmit" name="uploadFormSubmit" type="submit">
  </form>
  <?php
  $upload_dir = 'c:\wamp64/www/projet_imagebis/images/';
  var_dump($upload_dir);

  foreach ($_FILES['upload']['error'] as $key => $error) {
    var_dump($_FILES['upload']['error']);

    if ($error == UPLOAD_ERR_OK) //aucune erreur
      var_dump($error); {
      $tmp_name = $_FILES['upload']['tmp_name'][$key];
      var_dump($tmp_name);
      $name = $_FILES['upload']['name'][$key];
      var_dump($name);
      move_uploaded_file($tmp_name, $upload_dir . $name); //deplacement
      var_dump(move_uploaded_file($tmp_name, $upload_dir . $name));
    }
  }
  ?>

</body>

</html>
