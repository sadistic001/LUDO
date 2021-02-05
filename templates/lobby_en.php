<?php
if(! valider("connect","SESSION"))
	header("Location:index.php?view=accueil_en");
if(valider("player1"))
	$player1=valider("player1");
else
	$player1="";
	
?>
<div id="corps">
<h3 id="title"> List of connected players</h1>

<img id="loginConnex" src="ressources/pseudo.jpg">
<input id="liste" type="text" name="player1" value="<?= $player1 ?>" />
<br />
<br />
<img id="loginConnex" src="ressources/pseudo.jpg">
<input id="liste" type="text" name="joueur2"/>
<br />

<h1 id="title">Connection</h1>

<div id="formLogin">
<form action="controleur.php" method="GET">
<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="hidden" name="J_id1" value="<?= $_SESSION["idUser"];?>" />
<input type="hidden" name="joueur1" value="<?= $player1;?>" />
<input type="text" id="login" placeholder=" Pseudo" name="login"/><br />
<img id="loginConnex" src="ressources/password.jpg">
<input type="password" id="passe" placeholder=" Password" name="passe"/><br /><br />
<input type="submit" id="button2" name="action" value="play" />
</form>
</div>

</div>
<a href="index.php?view=inscription_en">
<img id="return" src="ressources/return.png"></a>
