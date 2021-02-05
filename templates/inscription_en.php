<?php

$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 
?>
<div id="corps">

<h1 id="title">Sign in</h1>

<div id="formLogin">
<form action="controleur.php" method="GET">
<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" name="login" placeholder=" Pseudo" value="<?php echo $login;?>" /><br />
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" name="passe" placeholder=" Password" value="<?php echo $passe;?>" /><br />
<label for="remember">Remember me</label><input type="checkbox" <?php echo $checked;?> name="remember" id="remember" value="ok"/> <br /><br />

<input id="button2" type="submit" name="action" value="sign in" />
</form>
</div>
<h1 id="title">Register</h1>
<div id="formInscription">
<form action="controleur.php" method="GET">
<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" placeholder=" Pseudo" name="login" /><br />
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" placeholder=" Password" name="passe"/><br />
<input id="button2" type="submit" name="action" value="Sign up" />
</form>
</div>

</div>
<a href="index.php?view=accueil_en">
<img id="return" src="ressources/return.png"></a>
