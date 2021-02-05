<?php

$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 
?>
<div id="corps">

<h1 id="title" >Connexion</h1>

<div id="formLogin">
<form action="controleur.php" method="GET">

<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" name="login" placeholder=" Pseudo" value="<?php echo $login;?>" /><br /><br/>
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" name="passe" placeholder=" Mot de passe" value="<?php echo $passe;?>" /><br /> <br />
<label id="souvenir" for="remember">Se souvenir de moi </label><input type="checkbox" <?php echo $checked;?> name="remember" id="remember" value="ok"/> <br />

<input id="button" type="submit" name="action" value="Connexion" />
</form>
</div>


</div>
<a href="index.php?view=accueil_fr">
<img id="return" src="ressources/return.png"></a>
<?php
if(valider("connect","SESSION"))
{
	/*echo "<form action=\"controleur.php\" >";
	echo "<input type=\"submit\" name=\"action\" value=\"Logout\" />";
	echo "</form>";*/
	echo "<a id=\"logoutAccueil\" href=\"controleur.php?action=deconnexion\">Déconnexion</a>";
}
?>
