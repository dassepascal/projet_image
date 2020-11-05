<?php

echo '<h4> config.php </h4>';
// ficchier de configuration
define('WEB_TITLE', 'Projet Image');
define('WEB_DIR_NAME', 'projet_imagebis');
define('WEB_DIR_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . WEB_DIR_NAME . '/');


define('IMAGE_DIR_NAME', 'images');

define('IMAGE_DIR_PATH', $_SERVER['DOCUMENT_ROOT'] . '/' . WEB_DIR_NAME . '/' . IMAGE_DIR_NAME . '/');
echo 'image dir path:' . IMAGE_DIR_PATH . '';
var_dump(IMAGE_DIR_PATH);
define('IMAGE_THUMB_NAME', 'thumbnails');
var_dump(IMAGE_THUMB_NAME);

define('IMAGE_DIR_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . WEB_DIR_NAME . '/' . IMAGE_DIR_NAME . '/');

define('THUMB_DIR_PATH', $_SERVER['DOCUMENT_ROOT'] . '/' . WEB_DIR_NAME . '/' . IMAGE_DIR_NAME . '/' . IMAGE_THUMB_NAME . '/');
var_dump(THUMB_DIR_PATH);

//$constants = get_defined_constants(true);
//print_r($constants['user']) . '<br>';
