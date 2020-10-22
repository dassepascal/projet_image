<?php

echo '<h4>admin</h4>';
require('config.php');
require('class/Image.php');
//require('contenu.php');
var_dump(('#z'));
$image = new Image();
var_dump('#z2');
$images = $image->getImages(IMAGE_DIR_PATH);

var_dump(('#z3'))
?>


<?php $image_dir_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projet_imagebis/images/';
var_dump('#z5'); ?>

<h1><?php echo WEB_TITLE ?></h1>
<?php var_dump('#z6'); ?>
<ul>
  <?php foreach ($images as $image) : ?>

    <li><img src="<?php echo $image_dir_url  . $image['filename'] ?>" />
      <form method="post" action="process_image.php">
        <p> Titre :<input type="text" name="title" ?></p>
        <input type="hidden" name="filename" value="<?php echo $image['filename']; ?>" />
        <p>Description <br><textarea name="descr" cols="50" rows=5><?php echo $image['description']; ?></textarea></p>
        <p><input type="submit" name="formImageSubmit" value="validez" /></p>
      </form>
    </li>
  <?php endforeach ?>
</ul>
