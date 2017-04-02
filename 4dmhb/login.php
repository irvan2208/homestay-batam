<?php
session_start();
$token = md5(uniqid(rand(), TRUE));
$_SESSION['logtoken'] = $token;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="dist/css/styles.css">
<title>
</title>
  <body>
  <div class="login-page">
    <div class="form">
    <div class="logo">
      Logo
    </div>
      <form class="login-form" action="pages/prc/logscpin.php" method="post">
        <input type="hidden" name="logtoken" placeholder="username" value="<?php echo $token;?>" />
        <input type="text" name="usernm" placeholder="username"/>
        <input type="password" name="pass" placeholder="password"/>
        <button type="submit">login</button>
      </form>
    </div>
  </div>
  </body>
</html>