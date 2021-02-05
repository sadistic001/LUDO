<?php

$login = valider("login", "COOKIE");
$passe = valider("passe", "COOKIE"); 
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 
?>
<div id="corps">

<h1 id="title" >Sign in</h1>

<div id="formLogin">
<form action="controleur.php" method="GET">

<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" name="login" placeholder=" Pseudo" value="<?php echo $login;?>" /><br /><br/>
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" name="passe" placeholder=" Password" value="<?php echo $passe;?>" /><br /> <br />
<label id="souvenir" for="remember">Remember me</label><input type="checkbox" <?php echo $checked;?> name="remember" id="remember" value="ok"/> <br />

<input id="button" type="submit" name="action" value="Sign in" />
</form>
</div>


</div>
<a href="index.php?view=accueil_en">
<img id="return" src="ressources/return.png"></a>
<?php
if(valider("connect","SESSION"))
{
	/*echo "<form action=\"controleur.php\" >";
	echo "<input type=\"submit\" name=\"action\" value=\"Logout\" />";
	echo "</form>";*/
	echo "<a id=\"logoutAccueil\" href=\"controleur.php?action=Logout\">Logout</a>";
}

?>
