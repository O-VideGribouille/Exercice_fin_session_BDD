<?php 
session_start();
  ///---///
  //Ecriture du code de connexion dans une autre page 
  include "connexion.php";
  $connexionBDD = connect_bd(); // permet l'utilisation au fil de la page
?>


  	<!DOCTYPE html>
<html>
<head>
	<title>Déconnexion </title>

	<meta charset="utf-8">

	<link rel="shortcut icon" type="image/x-icon" href="../img/logo/icone.png">

	<link rel="stylesheet" type="text/css" href="../CSS/index_template.css">
	<link rel="stylesheet" type="text/css" href="../CSS/Im_ge.css">

	<style>

	<?php  if($_SESSION["statut"] == 'Eleve'){ ?>

		
  
     body{
     	background-color: #71a6d2;
     }
     


	<?php } elseif($_SESSION["statut"] == 'Professeur'){ ?>


  
     body{
     	background-color: seagreen;
     }
     
	

	<?php } ?>

	</style>



		<!-- -->
		<!-- -->
		<!-- -->
</head>
<body>
	<header id="HBody" name="HBody" class="header__bg">
		<img src="../img/logo/Carte_visite.png" id="logo1" name="icone" class="logo">
		<!-- -->
		<!-- -->
		<!-- -->

		<nav id="Nav" name="Nav" class="navigation">
			
			<div id="DivList" name="Hdr">
				 
			 	<ul id="Ul_nav" name="Ul_nav">

			 		<li id="li_login" name="li_login" class="list_nav">
 					<a href="inscription.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Inscription </a>  

 					</li>

 					<li id="li_login" name="li_login" class="list_nav"> 

              			<a href="login.php" id="nav_acc3" name="nav_acc3" class="a_nav"> Connexion </a> 

           			 </li> 

 					<li id="li_acc1" name="li_acc" class="list_nav">

 						<a href="userpage.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Accueil </a>  

 					</li>
			
				</ul> 

			</div>


		</nav>

	</header>

	<div id="divPrincipal" name="divPrincipal" class="divArticle">
<?php  

	//si $_SESSION["admin"] est vide donc l'utilisateur est un élève
if(isset($_SESSION["login"])){

	$req = 'SELECT DISTINCT NOM, PRENOM, LOGIN FROM etudiant WHERE LOGIN = \''.$_SESSION['login'].'\';';


           //afficher nom et prénom étudiant connecté
            //création d'un tableau
            foreach ($connexionBDD->query($req) as $row) { 


				echo "<p>Au revoir ".$row["NOM"]." ".$row['PRENOM']."<p>";

			} ?>

			<p>A très bientôt !</p>

		<?php

		///--- Fin $_SESSION["login"]) ---///
        }

	?>



	<a href="logout.php">Deconnection</a>

</div>

		<!-- -->
		<!-- -->
		<!-- -->

	<footer id="BBody" name="BBody">
		
		<div id="dF1" name="dF1" class="divFooter">
		
			<img src="../img/logo/signature.png" id="logo2" name="signature" class="logo">

			<p id="pF1" name="pF1" class="FooterP"> Oriane VICECONTE (F2)  2020 - 2021 </p>
			
			<p id="pF2" name="pF2" class="FooterP"> Contact : o.viceconte@ludus-academie.com </p>

		</div>
	
	</footer>


</body>
</html>