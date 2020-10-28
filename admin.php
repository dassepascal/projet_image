<?php

echo '<h4>admin</h4>';
//require('config.php');
//require('class/Image.php');
require('process_image.php');
//require('contenu.php');

$image = new Image();

$images = $image->getImages(IMAGE_DIR_PATH);

?>


<?php $image_dir_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projet_imagebis/images/'; ?>
<!DOCTYPE html>
<html>

<head>
  <title>admin</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
</head>

<body>



  <h1><?php echo WEB_TITLE ?></h1>

  <ul>

    <?php foreach ($images as $image) : ?>
      <ul class="menu">
        <li><a href="admin.php">Administration</a></li>
        <li><a href="upload.php"> Upload</a></li>
        <li><a href="index.php">Site web</a></li>
      </ul>
      <li><img class="img" src="<?php echo $image_dir_url  . $image['filename'] ?>" />
        <form method="post" action="process_image.php">

          <?php if (!empty($image['title'])) : ?>
            <input type="hidden" name="update" value="1" />

          <?php endif ?>
          <p> Titre :<input type="text" name="title" value="<?php echo $image['title']  ?>"></p>

          <input type="hidden" name="filename" value="<?php echo $image['filename']; ?>" />
          <p>Description <br><textarea name="descr" cols="50" rows=5><?php echo $image['description']; ?></textarea></p>
          <p><input type="submit" name="formImageSubmit" value="validez" /></p>
        </form>
      </li>
    <?php endforeach ?>

  </ul>
</body>

</html>
