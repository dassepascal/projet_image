<?php
echo '<h4> contenu.php </h4>';
require('../process/config.php');
require('../class/Image.php');
$image = new Image();
// definition du chemin et de l(URL du repertoire image
// chemin (path) du repertoire images
//$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . '/projet_imagebis/images/';


//$image_dir_url = 'http://' . $_SERVER['HTTP_HOST'] . '/projet_imagebis/images/';


// affectation dans la variable $images du resultat de la methode getImages
$images = $image->getImages(IMAGE_DIR_PATH);

// affichage;
?>
<?php require('header.php'); ?>
<?php foreach ($images as $image) : ?>


  <li>
    <p><img src="<?php echo IMAGE_DIR_URL . $image['filename']  ?>" /> </p>
    <p><?php echo $image['title'] ?></p>
    <p><?php echo $image['description'] ?></p>
  </li>

<?php endforeach ?>
