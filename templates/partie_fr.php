<?php

	include_once"libs/maLibUtils.php";
	include_once"libs/maLibForms.php";
	include_once"libs/modele.php";
if(! valider("connect","SESSION"))
	header("Location:index.php?view=inscription_fr");
$joueur1=valider("joueur1");
$datajoueur=getUserByLogin($joueur1);

//tprint($datajoueur);
if(! $datajoueur["connect"])
	header("Location: index.php?view=inscription_fr");
$jouer=$_SESSION["pseudo"];
AddGame($_SESSION["idUser"]);
AddGame($datajoueur["J_id"]);
?>
<style>
#tour{
	position: absolute;
	top: 0;
	 left: 50%;
  	transform: translate(-50%, -50%);
	font-size: 30px;
	border: 1px solid black;
	padding: 10px;
}
#des1{
	height: 50px;
	width: 50px;
}

#des2{
	height: 50px;
	width: 50px;
}
#croix1{
    height: 50px;
    width: 50px;
    position: absolute;
    left: 23%;
    bottom: 7%;
}

#croix2{
    height: 50px;
    width: 50px;
    position: absolute;
    left: 75%;
    top: 26.5%;
}

.case{

	width: 40px;
	height: 40px;
	border: 1px solid black;
	background-color: white;
	display: inline-block;

}
.cote_case{
	display: block;
	width: 40px;
	height: 40px;
	border: 1px solid black;
	background-color: white;
}
.pionrouge{
	height: 30px;
	width: 28px;
}
.pionjaune{
	height: 30px;
	width: 28px;
}
#fin{
    	display: none;
    	position: absolute;
    	top: 50%;
    	left: 50%;
    	font-size: 50px;
    	transform: translate(-50%,-50%);
}

</style>
<script>
/*déclaration des variables*/

var dés=[
   {
      "description":"1",
      "url":"ressources/un.png"
   },
   {
      "description":"2",
      "url":"ressources/deux.png"
   },
   {
      "description":"3",
      "url":"ressources/trois.png"
   },
   {
      "description":"4",
      "url":"ressources/quatre.png"
   },
   {
      "description":"5",
      "url":"ressources/cinq.png"
   },
   {
      "description":"6",
      "url":"ressources/six.png"
   }
]

var play=0;
var pos_rouge=-1;
var pos_jaune=-1;
var refgrille;
var reffin;




function init() {
nb=0;
play=0;
	refgrille=document.getElementById('grille');
	refgrille.innerHTML="";
	reffin=document.getElementById("fin");
	for(i=0;i<15;i++)
	{
		next="<div class=\"case\">";
		for(j=0;j<15;j++){
			next+="<div class=\"cote_case\" id="+nb+">"+"<img src=\"ressources/pionrouge.jpg\" class=\"pionrouge\" id=\"pionrouge"+nb+"\" style=\"display: none;\"/>"+"<img src=\"ressources/pionjaune.jpg\" class=\"pionjaune\" id=\"pionjaune"+nb+"\" style=\"display: none;\"/>"+"</div>";
			nb++;		
		}
		refgrille.innerHTML+=next;
	}
	console.log(refgrille);
	for(i=0;i<6;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="blue";}
	for(i=0;i<76;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="blue";}
	for(i=75;i<81;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="blue";}
	for(i=5;i<81;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="blue";}
	refcase0=document.getElementById(21);
	refcase0.style.backgroundColor="blue";
	for(i=22;i<98;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="blue";}


	for(i=135;i<211;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="yellow";}
	for(i=211;i<216;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="yellow";}
	for(i=136;i<141;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="yellow";}
	for(i=155;i<201;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="yellow";}
	refcase0=document.getElementById(121);
	refcase0.style.backgroundColor="yellow";
	for(i=106;i<112;i++){
	refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="yellow";}

	for(i=9;i<15;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="red";}
	for(i=9;i<85;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="red";}
	for(i=84;i<90;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="red";}
	for(i=14;i<90;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="red";}
	refcase0=document.getElementById(103);
	refcase0.style.backgroundColor="red";
	for(i=113;i<119;i++){
	refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="red";}

	for(i=144;i<220;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="green";}
	for(i=220;i<225;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="green";}
	for(i=145;i<150;i++)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="green";}
	for(i=164;i<210;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="green";}
	refcase0=document.getElementById(203);
	refcase0.style.backgroundColor="green";
	for(i=127;i<203;i=i+15)
	{refcase0=document.getElementById(i);
	refcase0.style.backgroundColor="green";}	
}




function changer(refthis) {
	console.log(refthis.id);
	reftour=document.getElementById("tour");
	refpionjaune=document.getElementById("pionjaune");
	refpionrouge=document.getElementById("pionrouge");

	if(play%2==0 && pos_rouge==-1 && refthis.id == "des1"){
		
		nb=spindice(refthis)+1;
		if (nb==6) {
			pos_rouge=0;
			deplacer_rouge(pos_rouge);
		}
		else play++;
	}
	else if(play%2==1 && pos_jaune==-1 && refthis.id == "des2"){
			reftour.innerHTML="Tour de <?= $jouer ?>";		
		nb=spindice(refthis)+1;
		if (nb==6) {
			pos_jaune=0;
			deplacer_jaune(pos_jaune);
		}
		else play++;
	}
	else if(play%2==0 && refthis.id == "des1"){
		reftour.innerHTML="Tour de <?= $joueur1 ?>";		
		deplacer_rouge(pos_rouge);
		nb=spindice(refthis)+1;
		pos_rouge+=nb;
		testfin();		
		deplacer_rouge(pos_rouge);
		if (nb!=6)
			play++;
	}	
	else if(play%2==1 && refthis.id == "des2"){
	reftour.innerHTML="Tour de <?= $jouer ?>";
	    deplacer_jaune(pos_jaune);
	    nb=spindice(refthis)+1;
	    pos_jaune+=nb;
	    testfin();	
	    deplacer_jaune(pos_jaune);
	    if (nb!=6)
	    	play++;
	}
	if((refthis.id=="des1") && (nb!=6))
		reftour.innerHTML="Tour de <?= $joueur1 ?>";
	if((refthis.id=="des1") && (nb==6))
		reftour.innerHTML="Tour de <?= $jouer ?>";
	if((refthis.id=="des2") && (nb!=6))
		reftour.innerHTML="Tour de <?= $jouer ?>";
	if((refthis.id=="des2") && (nb==6))
		reftour.innerHTML="Tour de <?= $joueur1 ?>";
}









function deplacer_rouge(pos){
    switch (pos){
        case 0:
        refpionrouge=document.getElementById("pionrouge103");
        refpionjaune=document.getElementById("pionjaune103");
                                  
        break;                                                 


        case 1 :    
        refpionrouge=document.getElementById("pionrouge102");
        refpionjaune=document.getElementById("pionjaune102");
   
        break;  

        case 2 :                                                                  
         refpionrouge=document.getElementById("pionrouge101");
        refpionjaune=document.getElementById("pionjaune101");
                                                                                                        
        break;         
        case 3 :  
           refpionrouge=document.getElementById("pionrouge100");
        refpionjaune=document.getElementById("pionjaune100");
     
        break;         
        case 4 : 
         refpionrouge=document.getElementById("pionrouge99");
        refpionjaune=document.getElementById("pionjaune99");
        
        break;         
        case 5 :  
         refpionrouge=document.getElementById("pionrouge98");
        refpionjaune=document.getElementById("pionjaune98");
       
        break;         
        case 6 :  
         refpionrouge=document.getElementById("pionrouge83");
        refpionjaune=document.getElementById("pionjaune83");
       
        break;         
        case 7 :  
         refpionrouge=document.getElementById("pionrouge68");
        refpionjaune=document.getElementById("pionjaune68");
      
        break;         
        case 8 :    
         refpionrouge=document.getElementById("pionrouge53");
        refpionjaune=document.getElementById("pionjaune53");
    
        break;         
        case 9 :    
         refpionrouge=document.getElementById("pionrouge38");
        refpionjaune=document.getElementById("pionjaune38");
    
        break;         
        case 10 : 
         refpionrouge=document.getElementById("pionrouge23");
        refpionjaune=document.getElementById("pionjaune23");
      
        break;         
        case 11 :    
         refpionrouge=document.getElementById("pionrouge8");
        refpionjaune=document.getElementById("pionjaune8");
   
        break;         
        case 12 :     
         refpionrouge=document.getElementById("pionrouge7");
        refpionjaune=document.getElementById("pionjaune7");
  
        break;         
        case 13 :   
         refpionrouge=document.getElementById("pionrouge6");
        refpionjaune=document.getElementById("pionjaune6");
    
        break;         
        case 14 :    
         refpionrouge=document.getElementById("pionrouge21");
        refpionjaune=document.getElementById("pionjaune21");
   
        break;         
        case 15 :  refpionrouge=document.getElementById("pionrouge36");
        refpionjaune=document.getElementById("pionjaune36");
      
        break;         
        case 16 : refpionrouge=document.getElementById("pionrouge51");
        refpionjaune=document.getElementById("pionjaune51");
       
        break;         
        case 17 :    refpionrouge=document.getElementById("pionrouge66");
        refpionjaune=document.getElementById("pionjaune66");
    
        break;         
        case 18 :      refpionrouge=document.getElementById("pionrouge81");
        refpionjaune=document.getElementById("pionjaune81");
  
        break;         
        case 19 :     refpionrouge=document.getElementById("pionrouge96");
        refpionjaune=document.getElementById("pionjaune96");
   
        break;         
        case 20 :      refpionrouge=document.getElementById("pionrouge95");
        refpionjaune=document.getElementById("pionjaune95");

        break;         
        case 21 :  refpionrouge=document.getElementById("pionrouge94");
        refpionjaune=document.getElementById("pionjaune94");
    
        break;         
        case 22 :     refpionrouge=document.getElementById("pionrouge93");
        refpionjaune=document.getElementById("pionjaune93");
 
        break;         
        case 23 :            refpionrouge=document.getElementById("pionrouge92");
        refpionjaune=document.getElementById("pionjaune92");
                                                                          
        break; 

        case 24 :     refpionrouge=document.getElementById("pionrouge91");
        refpionjaune=document.getElementById("pionjaune91");
 
        break;         
        case 25 :      refpionrouge=document.getElementById("pionrouge90");
        refpionjaune=document.getElementById("pionjaune90");

        break;         
        case 26 :      refpionrouge=document.getElementById("pionrouge105");
        refpionjaune=document.getElementById("pionjaune105");

        break;         
        case 27 :           refpionrouge=document.getElementById("pionrouge120");
        refpionjaune=document.getElementById("pionjaune120");
                                                                                                                                                            
        break;         
        case 28 :      refpionrouge=document.getElementById("pionrouge121");
        refpionjaune=document.getElementById("pionjaune121");
  
        break;         
        case 29 :    refpionrouge=document.getElementById("pionrouge122");
        refpionjaune=document.getElementById("pionjaune122");
    
        break;         
        case 30 :  refpionrouge=document.getElementById("pionrouge123");
        refpionjaune=document.getElementById("pionjaune123");
      
        break;         
        case 31 :      refpionrouge=document.getElementById("pionrouge124");
        refpionjaune=document.getElementById("pionjaune124");
  
        break;         
        case 32 :    refpionrouge=document.getElementById("pionrouge125");
        refpionjaune=document.getElementById("pionjaune125");
    
        break;         
        case 33 :    refpionrouge=document.getElementById("pionrouge126");
        refpionjaune=document.getElementById("pionjaune126");
    
        break;         
        case 34 :   refpionrouge=document.getElementById("pionrouge141");
        refpionjaune=document.getElementById("pionjaune141");
     
        break;         
        case 35 :   refpionrouge=document.getElementById("pionrouge156");
        refpionjaune=document.getElementById("pionjaune156");
     
        break;         
        case 36 : refpionrouge=document.getElementById("pionrouge171");
        refpionjaune=document.getElementById("pionjaune171");
       
        break;         
        case 37 :   refpionrouge=document.getElementById("pionrouge186");
        refpionjaune=document.getElementById("pionjaune186");
     
        break;         
        case 38 :      refpionrouge=document.getElementById("pionrouge201");
        refpionjaune=document.getElementById("pionjaune201");
  
        break;         
        case 39 :    refpionrouge=document.getElementById("pionrouge216");
        refpionjaune=document.getElementById("pionjaune216");
    
        break;         
        case 40 :     refpionrouge=document.getElementById("pionrouge217");
        refpionjaune=document.getElementById("pionjaune217");
   
        break;         
        case 41 :     refpionrouge=document.getElementById("pionrouge218");
        refpionjaune=document.getElementById("pionjaune218");
   
        break;         
        case 42 :    refpionrouge=document.getElementById("pionrouge203");
        refpionjaune=document.getElementById("pionjaune203");
    
        break;         
        case 43 :    refpionrouge=document.getElementById("pionrouge188");
        refpionjaune=document.getElementById("pionjaune188");
    
        break;         
         
        case 44 : refpionrouge=document.getElementById("pionrouge173");
        refpionjaune=document.getElementById("pionjaune173");
  

        break; 

        case 45 :      refpionrouge=document.getElementById("pionrouge158");
        refpionjaune=document.getElementById("pionjaune158");
  
        break;         
        case 46 :   refpionrouge=document.getElementById("pionrouge143");
        refpionjaune=document.getElementById("pionjaune143");
     
        break;         
        case 47 :    refpionrouge=document.getElementById("pionrouge128");
        refpionjaune=document.getElementById("pionjaune128");
    
        break;         
        case 48 :       refpionrouge=document.getElementById("pionrouge129");
        refpionjaune=document.getElementById("pionjaune129");
 
        break;         
        case 49 :   refpionrouge=document.getElementById("pionrouge130");
        refpionjaune=document.getElementById("pionjaune130");
     
        break;         
        case 50 :   refpionrouge=document.getElementById("pionrouge131");
        refpionjaune=document.getElementById("pionjaune131");
     
        break;         
        case 51 :            refpionrouge=document.getElementById("pionrouge132");
        refpionjaune=document.getElementById("pionjaune132");
                                                                                                                                                             
        break;         
        case 52 :      refpionrouge=document.getElementById("pionrouge133");
        refpionjaune=document.getElementById("pionjaune133");
  
        break;         
        case 53 :   refpionrouge=document.getElementById("pionrouge134");
        refpionjaune=document.getElementById("pionjaune134");
     
        break;         
        case 54 :         refpionrouge=document.getElementById("pionrouge119");
        refpionjaune=document.getElementById("pionjaune119");
                                                                                                                                                                
        break;                    

        case 55 :      refpionrouge=document.getElementById("pionrouge118");
        refpionjaune=document.getElementById("pionjaune118");

        break;         
        case 56 :       refpionrouge=document.getElementById("pionrouge117");
        refpionjaune=document.getElementById("pionjaune117");
                                                                                                                                                                
        break;         
        case 57 :     refpionrouge=document.getElementById("pionrouge116");
        refpionjaune=document.getElementById("pionjaune116");
 
        break;         
        case 58 :      refpionrouge=document.getElementById("pionrouge115");
        refpionjaune=document.getElementById("pionjaune115");

        break;         
        case 59 :    refpionrouge=document.getElementById("pionrouge114");
        refpionjaune=document.getElementById("pionjaune114");
   
        break;         
        case 60 :     refpionrouge=document.getElementById("pionrouge113");
        refpionjaune=document.getElementById("pionjaune113");

        break;         
        case 61 :    refpionrouge=document.getElementById("pionrouge112");
        refpionjaune=document.getElementById("pionjaune112");

        break;         
      
    }
            if(refpionrouge.style.display=="block")
        refpionrouge.style.display="none";
        else refpionrouge.style.display="block";


        if(refpionjaune.style.display=="block"){
        refpionjaune.style.display="none";
        pos_jaune=0;
        deplacer_jaune(pos_jaune);

    }


}






function deplacer_jaune(pos){
    switch (pos){
        case 0:
        refpionjaune=document.getElementById("pionjaune121");
        refpionrouge=document.getElementById("pionrouge121");
                                 
        break;                                                 


        case 1 :    
        refpionjaune=document.getElementById("pionjaune122");
        refpionrouge=document.getElementById("pionrouge122");
  
        break;  

        case 2 :                                                                  
         refpionjaune=document.getElementById("pionjaune123");
        refpionrouge=document.getElementById("pionrouge123");
                                                                                                       
        break;         
        case 3 :  
           refpionjaune=document.getElementById("pionjaune124");
        refpionrouge=document.getElementById("pionrouge124");
    
        break;         
        case 4 : 
         refpionjaune=document.getElementById("pionjaune125");
        refpionrouge=document.getElementById("pionrouge125");
       
        break;         
        case 5 :  
         refpionjaune=document.getElementById("pionjaune126");
        refpionrouge=document.getElementById("pionrouge126");
      
        break;         
        case 6 :  
         refpionjaune=document.getElementById("pionjaune141");
        refpionrouge=document.getElementById("pionrouge141");
      
        break;         
        case 7 :  
         refpionjaune=document.getElementById("pionjaune156");
        refpionrouge=document.getElementById("pionrouge156");
     
        break;         
        case 8 :    
         refpionjaune=document.getElementById("pionjaune171");
        refpionrouge=document.getElementById("pionrouge171");
   
        break;         
        case 9 :    
         refpionjaune=document.getElementById("pionjaune186");
        refpionrouge=document.getElementById("pionrouge186");
   
        break;         
        case 10 : 
         refpionjaune=document.getElementById("pionjaune201");
         refpionrouge=document.getElementById("pionrouge201");
     
        break;         
        case 11 :    
         refpionjaune=document.getElementById("pionjaune216");
        refpionrouge=document.getElementById("pionrouge216");
  
        break;         
        case 12 :     
         refpionjaune=document.getElementById("pionjaune217");
        refpionrouge=document.getElementById("pionrouge217");
 
        break;         
        case 13 :   
         refpionjaune=document.getElementById("pionjaune218");
        refpionrouge=document.getElementById("pionrouge218");
   
        break;         
        case 14 :    
         refpionjaune=document.getElementById("pionjaune203");
        refpionrouge=document.getElementById("pionrouge203");
  
        break;         
        case 15 :  refpionjaune=document.getElementById("pionjaune188");
        refpionrouge=document.getElementById("pionrouge188");
     
        break;         
        case 16 : refpionjaune=document.getElementById("pionjaune173");
        refpionrouge=document.getElementById("pionrouge173");
      
        break;         
        case 17 :    refpionjaune=document.getElementById("pionjaune158");
        refpionrouge=document.getElementById("pionrouge158");
   
        break;         
        case 18 :      refpionjaune=document.getElementById("pionjaune143");
        refpionrouge=document.getElementById("pionrouge143");
 
        break;         
        case 19 :     refpionjaune=document.getElementById("pionjaune128");
        refpionrouge=document.getElementById("pionrouge128");
  
        break;         
        case 20 :      refpionjaune=document.getElementById("pionjaune129");
        refpionrouge=document.getElementById("pionrouge129");
        break;         
        case 21 :  refpionjaune=document.getElementById("pionjaune130");
        refpionrouge=document.getElementById("pionrouge130");
   
        break;         
        case 22 :     refpionjaune=document.getElementById("pionjaune131");
        refpionrouge=document.getElementById("pionrouge131");

        break;         
        case 23 :            refpionjaune=document.getElementById("pionjaune132");
        refpionrouge=document.getElementById("pionrouge132");
                                                                         
        break; 

        case 24 :     refpionjaune=document.getElementById("pionjaune133");
        refpionrouge=document.getElementById("pionrouge133");

        break;         
        case 25 :      refpionjaune=document.getElementById("pionjaune134");
        refpionrouge=document.getElementById("pionrouge134");

        break;         
        case 26 :      refpionjaune=document.getElementById("pionjaune119");
        refpionrouge=document.getElementById("pionrouge119");

        break;         
        case 27 :           refpionjaune=document.getElementById("pionjaune104");
        refpionrouge=document.getElementById("pionrouge104");
                                                                                                                                                           
        break;         
        case 28 :     refpionjaune=document.getElementById("pionjaune103");
        refpionrouge=document.getElementById("pionrouge103");
  
        break;         
        case 29 :      refpionjaune=document.getElementById("pionjaune102");
        refpionrouge=document.getElementById("pionrouge102");
 
        break;         
        case 30 :    refpionjaune=document.getElementById("pionjaune101");
        refpionrouge=document.getElementById("pionrouge101");
   
        break;         
        case 31 :  refpionjaune=document.getElementById("pionjaune100");
        refpionrouge=document.getElementById("pionrouge100");
     
        break;         
        case 32 :      refpionjaune=document.getElementById("pionjaune99");
        refpionrouge=document.getElementById("pionrouge99");
 
        break;         
        case 33 :    refpionjaune=document.getElementById("pionjaune98");
        refpionrouge=document.getElementById("pionrouge98");
   
        break;         
        case 34 :    refpionjaune=document.getElementById("pionjaune83");
        refpionrouge=document.getElementById("pionrouge83");
   
        break;         
        case 35 :   refpionjaune=document.getElementById("pionjaune68");
        refpionrouge=document.getElementById("pionrouge68");
    
        break;         
        case 36 :   refpionjaune=document.getElementById("pionjaune53");
        refpionrouge=document.getElementById("pionrouge53");
    
        break;         
        case 37 : refpionjaune=document.getElementById("pionjaune38");
        refpionrouge=document.getElementById("pionrouge38");
      
        break;         
        case 38 :   refpionjaune=document.getElementById("pionjaune23");
        refpionrouge=document.getElementById("pionrouge23");
    
        break;         
        case 39 :      refpionjaune=document.getElementById("pionjaune8");
        refpionrouge=document.getElementById("pionrouge8");
 
        break;         
        case 40 :    refpionjaune=document.getElementById("pionjaune7");
        refpionrouge=document.getElementById("pionrouge7");
   
        break;         
        case 41 :     refpionjaune=document.getElementById("pionjaune6");
        refpionrouge=document.getElementById("pionrouge6");
  
        break;         
        case 42 :     refpionjaune=document.getElementById("pionjaune21");
        refpionrouge=document.getElementById("pionrouge21");
  
        break;         
        case 43 :    refpionjaune=document.getElementById("pionjaune36");
        refpionrouge=document.getElementById("pionrouge36");
   
        break;         
        case 44 :    refpionjaune=document.getElementById("pionjaune51");
        refpionrouge=document.getElementById("pionrouge51");
   
        break;         
        case 45 :    refpionjaune=document.getElementById("pionjaune66");
        refpionrouge=document.getElementById("pionrouge66");
   
        break;         
        case 46 : refpionjaune=document.getElementById("pionjaune81");
        refpionrouge=document.getElementById("pionrouge81");
 

        break; 

        case 47 :      refpionjaune=document.getElementById("pionjaune96");
        refpionrouge=document.getElementById("pionrouge96");
 
        break;         
        case 48 :   refpionjaune=document.getElementById("pionjaune95");
        refpionrouge=document.getElementById("pionrouge95");
    
        break;         
        case 49 :    refpionjaune=document.getElementById("pionjaune94");
        refpionrouge=document.getElementById("pionrouge94");
   
        break;         
        case 50 :       refpionjaune=document.getElementById("pionjaune93");
        refpionrouge=document.getElementById("pionrouge93");

        break;         
        case 51 :   refpionjaune=document.getElementById("pionjaune92");
        refpionrouge=document.getElementById("pionrouge92");
    
        break;         
        case 52 :   refpionjaune=document.getElementById("pionjaune91");
        refpionrouge=document.getElementById("pionrouge91");
    
        break;         
        case 53 :            refpionjaune=document.getElementById("pionjaune90");
        refpionrouge=document.getElementById("pionrouge90");
                                                                                                                                                            
        break;         
        case 54 :      refpionjaune=document.getElementById("pionjaune105");
        refpionrouge=document.getElementById("pionrouge105");
 
        break;         
        case 55 :   refpionjaune=document.getElementById("pionjaune106");
        refpionrouge=document.getElementById("pionrouge106");
    
        break;         
        case 56 :         refpionjaune=document.getElementById("pionjaune107");
        refpionrouge=document.getElementById("pionrouge107");
                                                                                                                                                               
        break;                    

        case 57 :      refpionjaune=document.getElementById("pionjaune108");
        refpionrouge=document.getElementById("pionrouge108");

        break;         
        case 58 :       refpionjaune=document.getElementById("pionjaune109");
        refpionrouge=document.getElementById("pionrouge109");
                                                                                                                                                               
        break;         
        case 59 :     refpionjaune=document.getElementById("pionjaune110");
        refpionrouge=document.getElementById("pionrouge110");

        break;         
        case 60 :      refpionjaune=document.getElementById("pionjaune111");
        refpionrouge=document.getElementById("pionrouge111");

        break;         
        case 61 :    refpionjaune=document.getElementById("pionjaune112");
        refpionrouge=document.getElementById("pionrouge112");
  
        break;  
         
             
      
    }
        if(refpionjaune.style.display=="block")
        refpionjaune.style.display="none";
        else refpionjaune.style.display="block";

        if(refpionrouge.style.display=="block")
        {
            refpionrouge.style.display="none";
            pos_rouge=0;
            deplacer_rouge(pos_rouge);
        }
}










function spindice(dice){
	rndm=Math.floor(Math.random() * 10)%6;
	console.log(rndm);
		if(play>0)
			console.log(rndm);
		dice.src=dés[rndm].url;
	return rndm;
}


function testfin(){
	if(pos_jaune>=61){
		pos_jaune=61;	
		document.location.href="controleur.php?action=Gagner&gagnant="+<?php echo $datajoueur["J_id"];?>+"&loser="+<?php echo $_SESSION["idUser"];?>;
	}	

	else if(pos_rouge>=61){
		pos_rouge=61;
		document.location.href="controleur.php?action=Gagner&gagnant="+<?php echo $_SESSION["idUser"];?>+"&loser="+<?php echo $datajoueur["J_id"];?>;
	}
}

function recommencer() {
	window.location.reload();
}
</script>

<body onload="init();" id="bd">
<div id="grille">
</div>
<?php
echo "<h5 id=\"player1\">$_SESSION[pseudo]</h5>";
?>
<img id="des1"src="ressources/un.png" onclick="changer(this);" />
<img id="des2"src="ressources/un.png" onclick="changer(this);" />
<?php
echo "<h5 id=\"player2\">$joueur1</h5>";
?>
<h3 id="tour">Tour de <?php echo $_SESSION["pseudo"] ?></h3>
<?php echo "<a href=\"controleur.php?action=quitter&loser=$_SESSION[idUser]&gagnant=$datajoueur[J_id]&joueur1=$joueur1\"><img class=\"croix\" id=\"croix1\" src=\"ressources/croix.png\"></a>";
 echo "<a href=\"controleur.php?action=quitter&loser=$datajoueur[J_id]&gagnant=$_SESSION[idUser]&joueur1=$joueur1\"><img class=\"croix\" id=\"croix2\" src=\"ressources/croix.png\"></a>";
?>

</body>
