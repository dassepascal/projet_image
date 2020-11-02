<?php

echo '<h4>admin</h4>';
//require('config.php');
//require('class/Image.php');
require('../process/process_image.php');
//require('contenu.php');


$image = new Image();

$images = $image->getImages(IMAGE_DIR_PATH);


?>


<?php IMAGE_DIR_URL; ?>
<!DOCTYPE html>
<html>

<head>
  <title>admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <div class="container">

    <h1><?php echo WEB_TITLE ?></h1>

    <ul>

      <?php foreach ($images as $image) : ?>
        <div class="container-image">


          <p>
            <div class="item">
              <li><img class="img " src="<?php echo IMAGE_DIR_URL . $image['filename'] ?>" />
            </div>
          </p>
          <p> <?php require('menu.php'); ?></p>
        </div>

        <div id="form">
          <form method="post" action="../process/process_image.php">

            <?php if (!empty($image['title'])) : ?>
              <input type="hidden" name="update" value="1" />

            <?php endif ?>
            <p>Nom du fichier image :</p>
            <p>Ajoutez ou modifiez des informations pour cette image </p>
            <p> Titre :<input type="text" name="title" value="<?php echo $image['title']  ?>"></p>

            <input type="hidden" name="filename" value="<?php echo $image['filename']; ?>" />
            <p>Description <br><textarea name="descr" cols="50" rows=5><?php echo $image['description']; ?></textarea></p>
            <div id="btn">
              <p><input type="submit" name="formImageSubmit" value="validez" /></p>
            </div>

          </form>
        </div>
        </li>
      <?php endforeach ?>

    </ul>
  </div>
</body>

</html>
