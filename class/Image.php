<?php
echo '<h4>class/Image.php </h4>';

class Image
{
  //CONCTRUCTEUR
  public function __construct()
  {
    //LE CONSTRUCTEUR EST VIDE POUR CE PROJET

  }
  //METHODE
  /*METHODE RETOURNANT LES FICHIERS PRESENTS DANS LE REPERTOIRE OU NOUS AVONS PLACE NOS IMAGES ET QUE NOUS DEFINISSONT AU MOYEN DE LA VARIABLE $image_dir */

  public function getImages($image_dir)
  {
    //iterator
    $i = 0;
    if ($handle = opendir($image_dir)) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          $i++;

          $images[$i]['filename'] = ($entry);
          //utilisation de $this pour appeler la methode getImageData
          $image_data = $this->getImageData($entry);


          $images[$i]['title'] = $image_data['title'];
          $images[$i]['description'] = $image_data['description'];
        }
      }


      closedir($handle);

      return $images;
    }
  }

  public function insertImage($title, $descr, $filename)
  {
    require('../process/connection.php');
    //requete
    if (!$mysqli->query('INSERT INTO image (title,description,filename) VALUES("' . $title . '","' . $descr . '","' . $filename . '")')) {
      $msg_error = 'une erreur est survenue lors de l\'insertion des données dans la base.<br /> Message d\'erreur de MySQL est: ' . $mysqli->error;
      $msg_error .= '<br/>Aucune information n\'a été enregistrée.';
      return $msg_error;
      // echo 'une erreur est survenue lors de l\'insertion des données dans la base. Message d\'erreur : ' . $mysqli->error;
      // return false;
    } else {
      return true;
      $mysqli->close();
    }
  }
  public function getImageData($filename)
  {
    require('../process/connection.php');
    //requete

    $result = $mysqli->query('SELECT id,title,description,filename FROM image WHERE filename = "' . $filename . '"');
    if (!$result) {
      echo 'une erreur est survenue lors de la recuperation des données dans la base. Message d\'errreur : ' . $mysqli->error;
      return false;
    } else {
      $row = $result->fetch_array();

      $image_data['id'] = $row['id'];

      $image_data['title'] = $row['title'];

      $image_data['description'] = $row['description'];

      $image_data['filename'] = $row['filename'];


      return $image_data;
    }
  }
  public function updateImageData($title, $descr, $filename)
  {
    require('../process/connection.php');
    //requete
    if (!$mysqli->query('UPDATE image SET title = "' . $title . '", description = "' . $descr . '", filename = "' . $filename . '" WHERE title ="' . $title . '" ')) {
      // echo 'une erreur est survenue lors de la mise à jour des données dans la base. Message d\'erreur: ' . $mysqli->error;
      //var_dump($mysqli);
      // return false;
      $msg_error = 'une erreur est survenue lors de la mise à jour des données dans la base.<br /> Message d\'erreur de MySQL est: ' . $mysqli->error . '<br/>Aucune information n\'a été enregistrée.';
      return $msg_error;
    } else {
      return true;
      $mysqli->close();
    }
  }

  public function upload($files)
  {
    $upload_dir = IMAGE_DIR_PATH;
    foreach ($files['upload']['error'] as $key => $error) {
      $error = 0;

      $error = 0;

      //$type = $files['upload']['type'][$key];
      // if ($type == 'image/jpeg') {

      // if ($_FILES['upload']['size'] > 10000000) {
      //  $error++;
      //  var_dump($error);

      if ($error == UPLOAD_ERR_OK) {

        $tmp_name = $_FILES['upload']['tmp_name'][$key];

        $filename = $_FILES['upload']['name'][$key];


        if (move_uploaded_file($tmp_name, $upload_dir . $filename) === false) {
          $error++;
        } else {

          var_dump('chargement');
          //appel avec $this de la mehode au sein d'une meme classe
          //  $this->createThumbnail($filename);
          //  var_dump(createThumbnail($filename));
        }


        if ($error == 0) {

          return true;
        } else {
          return false;
        }
      }
    }
  }

  /* public function createThumbnail($filename)
  {
<<<<<<< HEAD
    //1 definition des chemins des images et des vignettes
    $image =  'C:/wamp64/www/projet_imagebis/images/vague.jpg';
    var_dump('#1');
    $vignette = 'C:/wamp64/www/projet_imagebis/images/thumbnails/vague.jpg';
    var_dump('#2');
    //2 récupération des dimensions de l'image source
    $size = getimagesize($image);
    var_dump('#3');
=======
    var_dump(('thumbnails'));
    //1. definition des chemins des images et des vignettes
    $image            = IMAGE_DIR_PATH . $filename;
    // var_dump($image);
    $vignette        = THUMB_DIR_PATH . $filename;
    //var_dump($vignette);

    // 2.recuperation des dimensions de l'image source
    $size = getimagesize($image);
    var_dump($filename);
    var_dump('#1');
>>>>>>> flux-image.php
    var_dump($size);
    $width = $size[0];

    $height = $size[1];

    //3 definition des valeurs souhaitees pour les vignettes
    // ce sont des valeurs max
    $max_width = 200;
    $max_height = 200;

    // creation de l'image source avec imagecreatefromjpeg
    $image_src = imagecreatefromjpeg($image);
<<<<<<< HEAD

    /*---------------------------------------------------------------*/
  /*traitement en cas d'echec ajouter a voir avec le prof */
  /* if (!$image_src) {
      /* Création d'une image vide */
  /*  $image_src  = imagecreatetruecolor(150, 30);
      $bgc = imagecolorallocate($image_src, 255, 255, 255);
      $tc  = imagecolorallocate($image_src, 0, 0, 0);

      imagefilledrectangle($image_src, 0, 0, 150, 30, $bgc);

      /* On y affiche un message d'erreur */
  /*   imagestring($image_src, 1, 5, 5, 'Erreur de chargement ' . $image, $tc);*/
  /*}
    var_dump('#1');
    return $image_src;*/
  /*--------------------------------------------------------------------------*/
  //header('Content-Type:image/jpeg');
  //4.1 on crée un ratio (une proportion)
  //et on vérifir que l'image source ne soit pas plus petit que l'image de destination
  /* if ($width > $width_max || $height > $height_max) {
=======
    var_dump($image_src);
    // imagejpeg($image_src, 'dir_test/vague.jpg');
>>>>>>> flux-image.php

    // 4.1
    if ($width > $max_width || $height > $max_height) {
      if ($height <= $width) {
<<<<<<< HEAD

        $ratio = $height_max / $width;
      } else {

        $ratio = $height_max / $height;
      }
    } else {


      $ratio = 1; //l'image crée sera identique à l'originale

    }
    // 4. creation de l'image noire de destination avec imagecreatetruecolor
    $image_destination = imagecreatetruecolor(round($width * $ratio), round($height * $ratio)) or die('impossible de creer un flux d\'image GD');



    //5. fabrication de la vignette avec les dimensions souyhaitées

    imagecopyresampled($image_destination, $image_src, 0, 0, 0, 0, round($width * $ratio), round($height * $ratio), $width, $height);




    // 6. Envoi de la nouvelle image JPEG dans le fichier
    if (!imagejpeg($image_destination)) {

      $msg_error = 'la création de la vignettte a échou" pour l\'image ' . $image;
=======
        var_dump('hauteur<=largeur');
        $ratio = $max_width / $width;
      } else {
        $ratio = $max_height / $height;
      }
    } else {
      $ratio = 1;
      var_dump('image=original');
    }
    $image_destination = imagecreatetruecolor(round($width * $ratio), round($height * $ratio));
    var_dump($image_destination);
    imagecopyresampled($image_destination, $image_src, 0, 0, 0, 0, round($width * $ratio), round($height * $ratio), $width, $height);
    var_dump(imagecopyresampled($image_destination, $image_src, 0, 0, 0, 0, round($width * $ratio), round($height * $ratio), $width, $height));
    if (!imagejpeg($image_destination, $vignette)) {
      $msg_error = ' La création de la vignette a échou pour l\'image ' . $image;
>>>>>>> flux-image.php
      return $msg_error;
    } else {

      return true;
    }
  }*/
}
