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

      /* $image_data['id'] = $row['id'];

      $image_data['title'] = $row['title'];

      $image_data['description'] = $row['description'];

      $image_data['filename'] = $row['filename'];*/
      return (is_null($row)) ? ['title' => '', 'description' => ''] : $row;


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
    var_dump($upload_dir);
    foreach ($files['upload']['error'] as $key => $error) {
      $error = 0;
      //controle de l'extension de l'image et de la taille
      $type = $files['upload']['type'][$key];
      if ($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
        $sizes = $_FILES['upload']['size'];
        foreach ($sizes as $size) {
          if ($size > 100000 == true) {
            $error++;
          }
        }
      }
    }
    //  var_dump($error);
    // if($error  == UPLOAD_ERR_OK) verifie si aucune erreur est survenue
    if ($error == UPLOAD_ERR_OK) {
      $upload_dir = IMAGE_DIR_PATH;
      echo '116';
      var_dump($upload_dir);
      $tmp_name = $_FILES['upload']['tmp_name'][$key];
      $filename = $_FILES['upload']['name'][$key];
      var_dump($filename);
      //$filename = $files['upload']['name'][$key];
      $filename = $this->cleantText($filename);

      if (move_uploaded_file($tmp_name, $upload_dir . $filename) === false) {
        var_dump('result');
        var_dump(move_uploaded_file($tmp_name, $upload_dir . $filename));
        $error++;
      } else {
        var_dump('chargement');
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
  public function createThumbnail($filename)
  {
    var_dump(('thumbnails'));
    //1. definition des chemins des images et des vignettes
    $image            = IMAGE_DIR_PATH . $filename;
    // var_dump($image);
    $vignette        = THUMB_DIR_PATH . $filename;
    //var_dump($vignette);

    // 2.recuperation des dimensions de l'image source
    $size = getimagesize($image);

    $width = $size[0];

    $height = $size[1];

    //3 definition des valeurs souhaitees pour les vignettes
    // ce sont des valeurs max
    $max_width = 200;
    $max_height = 200;

    // creation de l'image source avec imagecreatefromjpeg
    $image_src = imagecreatefromjpeg($image);
    var_dump($image_src);
    // imagejpeg($image_src, 'dir_test/vague.jpg');

    // 4.1
    if ($width > $max_width || $height > $max_height) {
      if ($height <= $width) {
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
      return $msg_error;
    } else {

      return true;
    }
  }
  public function cleantText($filename)
  {
    $special = array(' ', '\'', 'á', 'à', 'â', 'ã', 'ä', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'î', 'í', 'ï', 'ò', 'ó', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'É', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý',);
    $normal = array('_', '', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'A', 'A', 'A', 'A', 'U', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'U', 'Y');
    $mixed = "' ' '\''áàâãäæçèéêëìîíïòóóôõöùúûüýÿÀÁÂÃÄÅÆÇÈÉÉËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ";
    $filename = str_replace($special, $normal, $filename);
    $filename = strtolower($filename);
    return $filename;
  }
}
