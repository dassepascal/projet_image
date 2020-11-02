<?php
echo '<h4>process_auth.php</h4>';
require('../class/User.php');
if (isset($_POST['submitLoginForm'])) {
  // post user
  $user_login = $_POST['login'];

  $user_pass = $_POST['password'];
  //instanciation de la classe User
  $user = new user();
  // utilisation de la methode authUser de la classe User
  $authuser = $user->authUser($user_login, $user_pass);
  if ($authuser['count'] == 0) {
    $msg_error = 'le compte n\'est pas reconnu';
  }
}
