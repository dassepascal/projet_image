<?php
echo '<h4>process_auth.php</h4>';
require('../class/User.php');
if (isset($_POST['submitLoginForm'])) {
  // post user
  $user_login = $_POST['login'];
  var_dump($user_login);
  $user_pass = $_POST['password'];
  var_dump($user_pass);
  //instanciation de la classe User
  $user = new User();
  // utilisation de la methode authUser de la classe User
  $authuser = $user->authUser($user_login, $user_pass);
  if ($authuser['count'] == 0) {
    var_dump($authuser);
    $msg_error = 'le compte n\'est pas reconnu';
    echo $msg_error;
  }
}
