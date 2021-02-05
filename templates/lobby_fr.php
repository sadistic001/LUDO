<?php
if(! valider("connect","SESSION"))
	header("Location:index.php?view=accueil_fr");

$joueur1=valider("joueur1");
if(! $joueur1)
	header("Location:index.php?view=inscription_fr");

?>
<div id="corps">
<h2 id="title"> Liste des joueurs connectés</h2>
<img id="loginConnex" src="ressources/pseudo.jpg">
<input id="liste" type="text" name="joueur1" value="<?= $joueur1 ?>" />
<br />
<br />
<img id="loginConnex" src="ressources/pseudo.jpg">
<input id="liste" type="text" name="joueur2"/>
<br />
<br />
<h1 id="title">Connexion</h1>

<div id="formLogin">
<form action="controleur.php" method="GET">
<img id="loginConnex" src="ressources/pseudo.jpg">
<input type="text" id="login" placeholder=" Pseudo" name="login"/><br />
<img id="loginConnex" src="ressources/password.jpg">
<input type="hidden" name="J_id1" value="<?= $_SESSION["idUser"];?>" />
<input type="hidden" name="joueur1" value="<?= $joueur1;?>" />
<input type="password" id="passe" placeholder=" Mot de passe" name="passe"/><br /><br />
<input type="submit" id="button2" name="action" value="jouer" />
</form>
</div>

</div>
<a href="index.php?view=inscription_fr">
<img id="return" src="ressources/return.png"></a>
