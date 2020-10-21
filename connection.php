<?php
$mysqli = new mysqli('localhost', 'root', '', 'projet_image');
$mysqli->set_charset('utf8');

//verification de la connection

if ($mysqli->connect_errno) {
  echo 'echec de la connection' . $mysqli->connect_error;
  exit();
}
