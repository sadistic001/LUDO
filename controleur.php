<?php
session_start();

	include_once"libs/maLibUtils.php";
	include_once "libs/maLibSQL.pdo.php";
	include_once "libs/maLibSecurisation.php"; 
	include_once "libs/modele.php"; 

	$addArgs = "";
	if ($action = valider("action"))
	{
		ob_start ();
		echo "Action = '$action' <br />";
		switch($action)
		{
			case 'Connexion' : 
			case 'Sign in' : 
			$feedback=false;
			if ($login = valider("login")) {
				if ($passe = valider("passe"))
				{
					if (verifUser($login,$passe)) {
						if (valider("remember")) {
								setcookie("login",$login , time()+60*60*24*30);
								setcookie("passe",$password, time()+60*60*24*30);
								setcookie("remember",true, time()+60*60*24*30);
							} else {
								setcookie("login","", time()-3600);
								setcookie("passe","", time()-3600);
								setcookie("remember",false, time()-3600);
							}
						} else {
							if(($action=="Connexion")){
							$feedback = "Identifiants incorrects";
							}else 
							$feedback = "login or password incorrect";
						}
					} else {
						// pas de mot de passe 
						if(($action=="Connexion")){
							$feedback = "Mot de passe absent"; 
							}else 
							$feedback = "password absent"; 
					}
				} else {
					// pas de login 
					if(($action=="Connexion")){
							$feedback = "login absent"; 
							}else 
							$feedback = "login absent"; 
				}

				// On redirigera vers la page index automatiquement
				if(($action=="Connexion")){
					if ($feedback) {
						$addArgs = "?view=connexion_fr&msg_feedback=".urlencode($feedback);
					} else {
						$addArgs = "?view=profil_fr";
					}
				}
				else
				{
					if ($feedback) {
						$addArgs = "?view=connexion_en&msg_feedback=".urlencode($feedback);
					} else {
						$addArgs = "?view=profil_en";	
					}
				}
			break;
			case 'deconnexion' :
			case 'Logout' : 
				// traitement métier
				if(valider("connect","SESSION"))
				{
					deconnectUser($_SESSION["idUser"]);
					session_destroy();
					if($action=="deconnexion")
					$addArgs="?view=connexion_fr&msg_feedback=". urlencode("vous n'êtes pas connecté");	
					else
					$addArgs="?view=connexion_en&msg_feedback=". urlencode("your aren't connected");
				}
			break;
			case 'Changer passe' : 
			case 'Change password' : 
				if(valider("connect","SESSION"))
				{
					if(($idUser=valider("idUser","SESSION")))
					if(($passe=valider("passe"))){
						changePassword($idUser,$passe);
						session_destroy();
						deconnectUser($idUser);
					}
				}	
			if(($action=="Changer passe"))
				$addArgs="?view=connexion_fr&msg_feedback=". urlencode("vous n'êtes pas connecté");	
			else
				$addArgs="?view=connexion_en&msg_feedback=". urlencode("your aren't connected");
			break;
			case 'connexion' : 
			case 'sign in' : 
			$feedback=false;
			if ($login = valider("login")) {
				if ($passe = valider("passe"))
				{
					if (verifUser($login,$passe)) {
						if (valider("remember")) {
								setcookie("login",$login , time()+60*60*24*30);
								setcookie("passe",$password, time()+60*60*24*30);
								setcookie("remember",true, time()+60*60*24*30);
							} else {
								setcookie("login","", time()-3600);
								setcookie("passe","", time()-3600);
								setcookie("remember",false, time()-3600);
							}
						} else {
							if(($action=="connexion")){
							$feedback = "Identifiants incorrects";
							}else 
							$feedback = "login or password incorrect"; 
						}
					} else {
						// pas de mot de passe 
						if(($action=="connexion")){
							$feedback = "Mot de passe absent"; 
							}else 
							$feedback = "password absent"; 
					}
				} else {
					// pas de login 
					if(($action=="connexion")){
							$feedback = "login absent"; 
							}else 
							$feedback = "login absent"; 
				}

				// On redirigera vers la page index automatiquement
				if(($action=="connexion"))
				if ($feedback) {
					$addArgs = "?view=inscription_fr&msg_feedback=".urlencode($feedback);
				} else {
					$addArgs = "?view=lobby_fr&joueur1=$login";
				}
				else
				{
					if ($feedback) {
						$addArgs = "?view=inscription_en&msg_feedback=".urlencode($feedback);
					} else {
						$addArgs = "?view=lobby_en&player1=$login";
					}
				}
			break;

			case 'jouer' : 
			if(($joueur1=valider("joueur1"))){
			if (($login = valider("login"))) {
				if ($passe = valider("passe"))
				{
					if (verifUser($login,$passe)) {
						if(($J_id1=valider("J_id1")))
						if(($joueur1!=$login)){
						MakeGame($J_id1,$_SESSION["idUser"]);
						$addArgs = "?view=partie_fr&joueur1=$joueur1";
						}
						else
						$feedback = "Dèja connecté";
					} else {
						$feedback = "Identifiants incorrects"; 
					}
				} else {
						// pas de mot de passe 
					$feedback = "Mot de passe absent"; 
				}
			} else {
				// pas de login 
				$feedback = "Login absent"; 
			}
			}else
			$feedback="y a pas le joueur 1";
				if ($feedback) {
					$addArgs = "?view=lobby_fr&joueur1=$joueur1&msg_feedback=".urlencode($feedback);
				}
			break;
			case 'play' :
			if(($joueur1=valider("joueur1"))){
			if (($login = valider("login"))) {
				if ($passe = valider("passe"))
				{
					if (verifUser($login,$passe)) {
						if(($J_id1=valider("J_id1")))
						if(($joueur1!=$login)){
						MakeGame($J_id1,$_SESSION["idUser"]);
						$addArgs = "?view=partie_en&joueur1=$joueur1";
						//TODO: changer
						}
						else
						$feedback = "already connected";
					} else {
						$feedback = "login or password incorrects"; 
					}
				} else {
						// pas de mot de passe 
					$feedback = "password absent"; 
				}
			} else {
				// pas de login 
				$feedback = "Login absent"; 
			}
			}else
			$feedback="there isn't player 1";
				if ($feedback) {
					$addArgs = "?view=lobby_en&player1=$joueur1&msg_feedback=".urlencode($feedback);
				}
			break;
					
			case 'inscription':
			case 'Sign up':	
				if ($login = valider("login"))
				if ($passe = valider("passe"))
					mkUser($login, $passe);	
			if(($action=="inscription"))
				$addArgs = "?view=inscription_fr";
			else
				$addArgs = "?view=inscription_en";
			break;
			case 'Commencer':
				DeconnectAll();
				$addArgs = "?view=inscription_fr";
			break;
			case 'start':
				DeconnectAll();
				$addArgs = "?view=inscription_en";
			break;
			case 'Gagner':
				if(($id_G=valider("gagnant")))
				if(($id_L=valider("loser")))
				{
					$dataG=getUser($id_G);
					$dataL=getUser($id_L);
					if(($dataG["connect"]) && ($dataL["connect"]))
					{
						AddVictory($id_G);
						RefreshScore(20,$id_G);
						RefreshScore(10,$id_L);				
						$addArgs = "?view=fin_fr&gagnant=$id_G&loser=$id_L&action=gagner";
					}		
				}
				if(! $addArgs)
					$addArgs = "?view=inscription_fr";
				
			break;
			case 'win':
				if(($id_G=valider("gagnant")))
				if(($id_L=valider("loser")))
				{
					$dataG=getUser($id_G);
					$dataL=getUser($id_L);
					if(($dataG["connect"]) && ($dataL["connect"]))
					{
						AddVictory($id_G);
						RefreshScore(20,$id_G);
						RefreshScore(10,$id_L);				
						$addArgs = "?view=fin_en&gagnant=$id_G&loser=$id_L&action=win";
					}		
				}
				if(! $addArgs)
					$addArgs = "?view=inscription_en";
				
			break;
			case 'quitter':
				if(($joueur1=valider("joueur1")))
				if(($id_G=valider("gagnant")))
				if(($id_L=valider("loser")))
				{
					$dataG=getUser($id_G);
					$dataL=getUser($id_L);
					if(($dataG["connect"]) && ($dataL["connect"]))
					{
						AddVictory($id_G);
						RefreshScore(20,$id_G);
						RefreshScore(0,$id_L);				
						$addArgs = "?view=fin_fr&gagnant=$id_G&loser=$id_L&action=quitter&joueur1=$joueur1";
					}		
				}
				if(! $addArgs)
					$addArgs = "?view=inscription_fr";
			break;
			case 'leave':
				if(($joueur1=valider("joueur1")))
				if(($id_G=valider("gagnant")))
				if(($id_L=valider("loser")))
				{
					$dataG=getUser($id_G);
					$dataL=getUser($id_L);
					if(($dataG["connect"]) && ($dataL["connect"]))
					{
						AddVictory($id_G);
						RefreshScore(20,$id_G);
						RefreshScore(0,$id_L);				
						$addArgs = "?view=fin_en&gagnant=$id_G&loser=$id_L&action=leave&joueur1=$joueur1";
					}		
				}
				if(! $addArgs)
					$addArgs = "?view=inscription_en";
			break;
		}
			
	}
	$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
	header("Location:" . $urlBase . $addArgs);
	ob_end_flush();
?>

