<?php

	include_once"libs/maLibUtils.php";
	include_once"libs/maLibForms.php";
	include_once"libs/modele.php";
if(! valider("connect","SESSION"))
	header("Location:index.php?view=connexion_en");
	$DataJ=getUser($_SESSION["idUser"]);
	//tprint($DataJ);	
	echo "<h3 id=\"nameJou\">Player's name : $_SESSION[pseudo]</h3>";
	echo "<br />";
	echo "<div id=\"bodyJou\">";
	echo "<h4>Player Stats: ";
	echo "<br />";
	echo "Number of game : $DataJ[nb_parties]";
	echo "<br />";
	echo "Win Ratio : ";
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
	echo "New password : "; 
	echo "<br />";
	mkInput("password","passe");
	echo "<br />";
	mkInput("submit","action","Change password"); 
	echo "</div>";

?>
<a href="index.php?view=connexion_en"><img id="return" src="ressources/return.png"></a>
<?php
if(valider("connect","SESSION"))
{
	/*echo "<form action=\"controleur.php\" >";
	echo "<input type=\"submit\" name=\"action\" value=\"Logout\" />";
	echo "</form>";*/
	echo "<a id=\"logout\" href=\"controleur.php?action=Logout\">Logout</a>";
}
?>
<html id="corpsProfil">

</html>
