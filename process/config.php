<?php

echo '<h4> config.php </h4>';
// ficchier de configuration

define('WEB_DIR_NAME', 'projet_imagebis');

define('IMAGE_DIR_NAME', 'images');

define('IMAGE_DIR_PATH', $_SERVER['DOCUMENT_ROOT'] . '/' . WEB_DIR_NAME . '/' . IMAGE_DIR_NAME . '/');

define('IMAGE_DIR_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . WEB_DIR_NAME . '/' . IMAGE_DIR_NAME . '/');

define('WEB_TITLE', 'Projet Image');

define('WEB_DIR_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . WEB_DIR_NAME . '/');

//$constants = get_defined_constants(true);
//print_r($constants['user']) . '<br>';