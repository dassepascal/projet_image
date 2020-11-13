<?php
echo '<h4>classe/User</h4>';

class User
{
  public function authUser($login, $password)
  {

    require('connection.php');
    //requete
    $result = $mysqli->query('SELECT COUNT(id),id,login,password FROM user WHERE login ="' . $login . '" AND password = "' . $password . '"');

    if (!$result) {
      echo 'une erreur est survenue lors de la récupération des données dans la base. Message d\'erreur: ' . $mysqli->error;
      return false;
    } else {
      $row = $result->fetch_array();
      $user_data['count'] = $row['COUNT(id)'];
      $user_data['id'] = $row['id'];
      $user_data['login'] = $row['login'];
      $user_data['password'] = $row['password'];
      return $user_data;
    }
    $mysqli->close();
  }
}
