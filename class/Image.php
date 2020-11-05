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


          //appel avec $this de la mehode au sein d'une meme classe
          $this->createThumbnail($filename);
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

  public function createThumbnail($filename)
  {
    //1. definition des chemins des images et des vignettes
    $image = 'C:/wamp64/www/projet_imagebis/images/vague.jpg';
    var_dump($image);
    $vignette = 'C:/wamp64/www/projet_imagebis/images/thumbnails/vague.jpg';
    var_dump($vignette);

    // 2.recuperation des dimensions de l'image source
    $size = getimagesize($image);
    var_dump($size);
    $width = $size[0];
    var_dump($width);
    $height = $size[1];
    var_dump($height);
  }
}
$test = new Image;
$test->createThumbnail($filename);
