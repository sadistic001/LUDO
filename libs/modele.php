<?php

include_once("maLibSQL.pdo.php");

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL="SELECT J_id FROM Joueurs WHERE pseudo='$login' AND password='$passe'";

	return SQLGetChamp($SQL);
}

function MakeGame($J_id1,$J_id2){
	$SQL="INSERT INTO Parties(J_id1, J_id2) VALUES('$J_id1','$J_id2')";
	return SQLInsert($SQL);
}

function mkUser($pseudo, $passe)
{
	// Cette fonction crée un nouvel utilisateur 
	// et renvoie l'identifiant de l'utilisateur créé
	$SQL = "INSERT INTO Joueurs(pseudo,password) VALUES('$pseudo','$passe')"; 
	return SQLInsert($SQL);
}

function DeconnectAll()
{
	$SQL="UPDATE Joueurs SET connect=0";
	SQLUpdate($SQL);
}

function AddGame($J_id)
{
	$SQL="UPDATE Joueurs SET nb_parties=nb_parties+1 WHERE J_id='$J_id'";
	SQLUpdate($SQL);
}

function RefreshScore($score,$J_id)
{
	$SQL="UPDATE Joueurs SET score=score+'$score' WHERE J_id='$J_id'";
	SQLUpdate($SQL);
}

function AddVictory($J_id)
{
	$SQL="UPDATE Joueurs SET victoires=victoires+1 WHERE J_id='$J_id'";
	SQLUpdate($SQL);
}


function getUser($idUser) {
	$SQL = "SELECT * FROM Joueurs WHERE J_id='$idUser'";
	$tab = parcoursRs(SQLSelect($SQL));
	// $tab contient au plus UNE SEULE CASE  
	if (count($tab) ==1) return $tab[0];
	else return false;
}
function getUserByLogin($login) {
	$SQL = "SELECT * FROM Joueurs WHERE pseudo='$login'";
	$tab = parcoursRs(SQLSelect($SQL));
	// $tab contient au plus UNE SEULE CASE  
	if (count($tab) ==1) return $tab[0];
	else return false;
}

function connectUser($idUser)
{
	// cette fonction affecte le booléen "connecte" à vrai pour l'utilisateur concerné 
	$SQL ="UPDATE Joueurs SET connect='1' WHERE J_id='$idUser'"; 
	SQLUpdate($SQL);
}

function deconnectUser($idUser)
{
	// cette fonction affecte le booléen "connecte" à faux pour l'utilisateur concerné 
	$SQL ="UPDATE Joueurs SET connect='0' WHERE J_id='$idUser'"; 
	SQLUpdate($SQL);
}

function changePassword($idUser,$passe)
{
	// cette fonction modifie le mot de passe d'un utilisateur
	$SQL ="UPDATE Joueurs SET password='$passe' WHERE J_id='$idUser'"; 
// NEVER TRUST USER INPUT
// Attention aux injections SQL, exemple si passe="toto' WHERE id=1; drop table users;" 
	SQLUpdate($SQL);
}

function changePseudo($idUser,$pseudo)
{
	// cette fonction modifie le pseudo d'un utilisateur
	$SQL ="UPDATE Joueurs SET pseudo='$pseudo' WHERE id='$idUser'"; 
	SQLUpdate($SQL);
}


function listerUtilisateursConnectes()
{
	// Liste les utilisteurs connectes
	$SQL = "SELECT * FROM Joueurs  WHERE connecte='1'";
	return parcoursRs(SQLSelect($SQL)); 
}

?>
