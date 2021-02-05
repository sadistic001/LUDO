<?php

	include_once"libs/maLibUtils.php";
	include_once"libs/maLibForms.php";
	include_once"libs/modele.php";
if(! valider("connect","SESSION"))
	header("Location:index.php?view=connexion_fr");
	$DataJ=getUser($_SESSION["idUser"]);
	//tprint($DataJ);	
	echo "<h3 id=\"nameJou\">Nom du joueur : $_SESSION[pseudo]</h3>";
	echo "<br />";
	echo "<div id=\"bodyJou\">";
	echo "<h4>Stats du joueur:";
	echo "<br />";
	echo "Parties jouées : $DataJ[nb_parties]";
	echo "<br />";
	echo "Ratio de victoires : ";
	if($DataJ["nb_parties"]==0)
		echo "0";
	else
		echo ($DataJ["victoires"]/$DataJ["nb_parties"])*100;
	echo "<br />";
	echo "Score : $DataJ[score]";
	echo "<br />";
	mkForm("controleur.php");
	echo "<br />";
	echo "</div>";

	echo "<div id=\"newPwd\">";
	echo "Nouveau mot de passe:"; 
	echo "<br />";
	mkInput("password","passe");
	echo "<br />";
	mkInput("submit","action","Changer passe"); 
	echo "</div>";

?>
<a href="index.php?view=connexion_fr"><img id="return" src="ressources/return.png"></a>
<?php
if(valider("connect","SESSION"))
{
	/*echo "<form action=\"controleur.php\" >";
	echo "<input type=\"submit\" name=\"action\" value=\"Logout\" />";
	echo "</form>";*/
	echo "<a id=\"logout\" href=\"controleur.php?action=deconnexion\">Déconnexion</a>";
}
?>
<html id="corpsProfil">

</html>
