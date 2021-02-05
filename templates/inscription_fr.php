<?php

$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 
?>
<div id="corps">

<h1 id="title">Connexion</h1>

<div id="formLogin">
<form action="controleur.php" method="GET">
<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" name="login" placeholder=" Pseudo" value="<?php echo $login;?>" /><br />
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" name="passe" placeholder=" Mot de passe" value="<?php echo $passe;?>" /><br /><br />
<label for="remember">Se souvenir de moi </label>
<input type="checkbox" <?php echo $checked;?> name="remember" id="remember" value="ok"/> <br />
<br />
<input id="button2" type="submit" name="action" value="connexion" />
<br /><br />
</form>
</div>
<h1 id="title">Inscription</h1>
<div id="formInscription">
<form action="controleur.php" method="GET">
<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" placeholder=" Pseudo" name="login" /><br />
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" placeholder=" Mot de passe" name="passe"/><br /><br />
<input id="button2" type="submit" name="action" value="inscription" />
</form>
</div>

</div>
<a href="index.php?view=accueil_fr">
<img id="return" src="ressources/return.png"></a>
