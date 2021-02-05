<?php
session_start();

	include_once "libs/maLibUtils.php";
	
	$view = valider("view"); 
	if (!$view) $view = "langage";
	include("templates/header.php");
	$msg_feedback = valider("msg_feedback"); 
	if ($msg_feedback) {
		include("templates/feedback.php");
	}
	switch($view)
	{		
		default :
			if (file_exists("templates/$view.php"))
				include("templates/$view.php");
	}
	//include("templates/footer.php");
?>
