<?php

echo 'hello';
require('config.php');
require('class/Image.php');
//require('contenu.php');

$image = new Image();

$images = $image->getImages(IMAGE_DIR_PATH);
?>
<h1><?php echo WEB_TITLE ?></h1>
<?php $image_dir_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projet_imagebis/images/';
?>
<?php foreach ($images as $image) : ?>
  <li><img src="<?php echo $image_dir_url  . $image ?>" /></li>


  <form method="post" action="process_image.php">
    <p> Titre :<input type="text" name="title" /></p>
    <input type="hidden" name="filename" value="<?php echo $image ?>" />

  </form>
<?php endforeach ?>
