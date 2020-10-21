<?php
echo '<h4> contenu.php </h4>';
require('config.php');
require('class/Image.php');

$image = new Image();
// definition du chemin et de l(URL du repertoire image
// chemin (path) du repertoire images
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . '/projet_imagebis/images/';
var_dump($image_dir_path);

$image_dir_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projet_imagebis/images/';
var_dump($image_dir_url);

// affectation dans la variable $images du resultat de la methode getImages
$images = $image->getImages($image_dir_path);
var_dump($images);
// affichage;
?>
<?php foreach ($images as $image) : ?>
  <li><img src="<?php echo $image_dir_url  . $image ?>" /></li>
  <?php var_dump($image_dir_url . $image); ?>
<?php endforeach ?>
