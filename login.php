<!DOCTYPE html>
<html>

<head>
  <title>login</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>


  <div id="login">




    <form action="process/process_auth.php" method="post">
      <p> login:<br />
        <input type="text" name="login" /></p>
      <p>Mot de passe :<br />
        <input type="password" name="password"></br></p>
      <input type="submit" name="submitLoginForm">
    </form>
  </div>
</body>

</html>
