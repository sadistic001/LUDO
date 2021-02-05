<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=langage");
	die("");
}

	include_once"libs/maLibUtils.php";
	include_once"libs/maLibForms.php";

echo "<div id=\"blocLang\">";
if ($lang = valider("lang"))
{
	$langueActuelle=$lang;
}
else $langueActuelle="fr";

function charger($view, $l="fr")
{
	switch($l)
	{
		case "en" : 
				$langue="_en";
		break;

		default : 
				$langue =  "_fr";
		break;
	}
	include($view . $langue . ".php"); 	
}
charger("langage",$langueActuelle);
?>
<a id="frEn" href="index.php?view=accueil_fr">Français</a> 
<br />
<br />
 <a id="frEn" href="index.php?view=accueil_en">English</a>
 
</div>
