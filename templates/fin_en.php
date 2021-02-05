<?php

	include_once"libs/maLibUtils.php";
	include_once"libs/maLibForms.php";
	include_once"libs/modele.php";
	$id_G=valider("gagnant");
	$id_L=valider("loser");
	$joueur1=valider("joueur1");
	$action=valider("action");
	$dataG=getUser($id_G);
	$dataL=getUser($id_L);
	if((! $dataG["connect"]) || (! $dataL["connect"]) || (! $action))
		header("Location:index.php?view=accueil_en");
	echo "<h1 id=\"winner\" >The winner is $dataG[pseudo]</h1>";
	if(($action=="win")){
	echo "<h4 id=\"score\">Score $dataG[pseudo] :   20</h4>"; 
	echo "<h4 id=\"score\">Score $dataL[pseudo] :   10</h4>"; 
	}
	else
	{
		echo "<h2 id=\"loser\">the player $dataL[pseudo] has surrendered</h2>";
		echo "<h4 id=\"score\" >Score $dataG[pseudo] :   20</h4>"; 
		echo "<h4 id=\"score\" >Score $dataL[pseudo] :   0</h4>"; 
	}
	if(($action=="leave"))
	echo "<a href=index.php?view=partie_en&joueur1=$joueur1><img id=\"restart\" src=ressources/recommencer.png></a>";
	else
	echo "<a href=index.php?view=partie_en&joueur1=$dataG[pseudo]><img id=\"restart\" src=ressources/recommencer.png></a>";
	echo "<a href=index.php?view=accueil_en><img id=\"croixfin\" src=ressources/croix.png></a>";				
?>	
