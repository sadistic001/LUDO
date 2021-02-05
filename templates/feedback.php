<?php

//C'est la propriété php_self qui nous l'indique : 
// Quand on vient de index : 
// [PHP_SELF] => /chatISIG/index.php 
// Quand on vient directement par le répertoire templates
// [PHP_SELF] => /chatISIG/templates/accueil.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
// Pas de soucis de bufferisation, puisque c'est dans le cas où on appelle directement la page sans son contexte
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php?view=accueil");
	die("");
}
?>
<style>
#feedback {
	position:relative; /*devient un repère pour ses enfants*/
	top: 500px;
	color:black;
	font-style:italic;
	font-weight: bold;
	width:500px;
	border: 1px solid red;

	text-align:center;
	margin: 20px auto;
}

#feedback img {
	position:absolute; 
	top:-10px; right:-10px;
	width:20px;
	z-index:10;
	background-color:white;
	display:none;
}

#feedback:hover img{
	display:inline;
}

#feedback img:hover {
	cursor:pointer;
}
</style>
<?php
if ($msg_feedback) { 
	echo '<div id="feedback">'; 
	echo stripslashes($msg_feedback); 
	echo '<img src="ressources/croix.png" onclick="hideFeedback();" />'; 
	echo '</div>'; 

	?>

	<script>
		function hideFeedback(){
			console.log("cacher feedback");
			var refFeedback = document.getElementById("feedback"); 
			refFeedback.style.display="none";
		}

		window.setTimeout(hideFeedback, 10000);

	</script>

<?php
}
?>





