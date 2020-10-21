<?php
echo '<h4> contenu.php </h4>';
require('class/Image.php');
require('config.php');
$image = new Image();
// definition du chemin et de l(URL du repertoire image
// chemin (path) du repertoire images
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . '/projet_imagebis/images/';


$image_dir_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projet_imagebis/images/';


// affectation dans la variable $images du resultat de la methode getImages
$images = $image->getImages($image_dir_path);

// affichage;
?>
<?php foreach ($images as $image) : ?>
  <li><img src="<?php echo $image_dir_url  . $image ?>" /></li>

<?php endforeach ?>
