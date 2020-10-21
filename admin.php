<?php
echo 'hello';
require('contenu.php');
$image = new Image();
$images = $image->getImages(IMAGE_DIR_PATH);
