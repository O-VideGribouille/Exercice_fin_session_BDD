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
	<title>Page utilisateur </title>

	<meta charset="utf-8">

	<link rel="shortcut icon" type="image/x-icon" href="../img/logo/icone.png">

	<link rel="stylesheet" type="text/css" href="../CSS/index_template.css">
	 <link rel="stylesheet" type="text/css" href="../CSS/Exercice_Formulaire.css">
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

         
          			<li id="li_login" name="li_login" class="list_nav"> 

             			 <a href="deconnexion.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Déconnexion </a> 

           			 </li> 
         
			
				</ul> 

			</div>


		</nav>

	</header>


	<div id="divPrincipal" name="divPrincipal" class="divArticle">
<?php  

	//si $_SESSION["admin"] est vide donc l'utilisateur est un élève
if($_SESSION["statut"]=='Eleve'){ ?>
	<p>Votre connexion en tant qu'élève est un succès.</p>
	<?php

	$req = 'SELECT DISTINCT NOM, PRENOM, LOGIN FROM etudiant WHERE LOGIN = \''.$_SESSION['login'].'\';';


           //afficher nom et prénom étudiant connecté
            //création d'un tableau
            foreach ($connexionBDD->query($req) as $row) { 

				echo "<p>Bonjour ".$row["NOM"]." ".$row['PRENOM']."</p>";
				///---//

				echo "<p> Votre connexion est réussit : </p>";

?>
	<!-- Profil étudiant -->	
    <table class="table table-striped">
        <tbody>

        	<tr>
		        <?php


		        	echo "<th style=\"border:1px solid black; width:100px;\"><img src=\"../img/Im_ge/".$_SESSION["login"].".jpg\" alt=\"photo_étudiant\" style=\"width:150px;height:180px;\"></th>";


		            echo  "<td style=\"border:1px solid black\"><h3>".$row["NOM"]." ".$row['PRENOM']."</h3></td>"; 

		         ?>
		    </tr>

		    <tr>

		        <?php
		        	echo  "<td style=\"border:1px solid black\"> Login : </td>";

		            echo  "<td style=\"border:1px solid black\">".$row["LOGIN"]."</td>";
		         //fermeture foreach   
		         }	         

		 		?>              

        </tr>      
        
    </tbody></table>



<?php


include ('chxmatiere.php');



		

///---///

        ?>

        <form method ="POST" action ="">
			
			<select name="chxmatiere" size=1>
 				 <option value="NOT">-- Selectionnez une matière --</option>
 				 <option value="WEB">WEB</option>
 				 <option value="GAME DESIGN">GAME DESIGN</option>
 				 <option value="ALGORITHME">ALGORITHME</option>
 			</select> 
 			  
 			<input type="submit" name="valider" value="Valider"/>
		</form>

	<?php
	if (isset($_POST['valider'])){
		    $matr =$_POST['chxmatiere'];
          //  $verdict_final=ChxTrimestre($trim, $_SESSION['login']);
        

     ?>

     <table class="table table-striped">
    <tbody>
    	<tr>
		    <th style="border:1px solid black;">Matière</th>
		    <th style="border:1px solid black;">Notes </th>
		    <th style="border:1px solid black;">Moyenne</th>
		    
		</tr>




<?php
	$verdict_final=ChxMatiere($connexionBDD, $matr, $_SESSION['login']);

?>
	</tbody></table>

    <?php

        ///--- Fin formulaire trimestre ---///   
        }
   

    ///--- Fin session élève ---///    

	}


	?>

	<!-- -->
	<!-- -->
	<!-- -->

	<?php  

	//Si l'utilisateur est un professeur
	if($_SESSION["statut"] == 'Professeur'){
	?>

	<p>Votre connexion en tant que professeur est un succès.</p>
	<p> Que souhaitez-vous faire ?</p>
	<a href="ajouteleve.php">Ajouter un élève</a><br>
	<a href="ajoutnote.php">Ajouter une note</a>

	<?php

	    $req = 'SELECT DISTINCT NOM, PRENOM, LOGIN FROM etudiant WHERE LOGIN = \''.$_SESSION['login'].'\';';


           //afficher nom et prénom étudiant connecté
            //création d'un tableau
            foreach ($connexionBDD->query($req) as $row) { 



				echo "<p>Bonjour ".$row["NOM"]." ".$row['PRENOM']."</p>";
				///---//
				?>
	<!-- Profil professeur -->	
    <table class="table table-striped">
        <tbody>

        	<tr>
		        <?php


		        	echo "<th style=\"border:1px solid black; width:100px;\"><img src=\"../img/Im_ge/".$_SESSION["login"].".jpg\" alt=\"photo_étudiant\" style=\"width:150px;height:180px;\"></th>";


		            echo  "<td style=\"border:1px solid black\"><h3>".$row["NOM"]." ".$row['PRENOM']."</h3></td>"; 

		         ?>
		    </tr>

		    <tr>

		        <?php
		        	echo  "<td style=\"border:1px solid black\"> Login : </td>";

		            echo  "<td style=\"border:1px solid black\">".$row["LOGIN"]."</td>";
		         //fermeture foreach   
		         }	         

		 		?>              

        </tr>      
        
    </tbody></table>



<?php  ///---/// 

$reqP= 'SELECT DISTINCT NOM, PRENOM, MATIERE, NOTE
         FROM etudiant
         WHERE STATUT = "Eleve"
         GROUP BY NOM
         ORDER BY NOM ASC';

include ('chxeleve.php');

$reqP2= 'SELECT NOM, PRENOM, MATIERE, NOTE, AVG(NOTE) AS MOYENNE_ELEVE FROM etudiant WHERE NOM = \''.$_SESSION['login'].'\';';

?>

<!-- Selectionner un élève afin d'afficher ses résultats -->	
<form method="POST" action="">
  <select name="std" id="std" size="4">
    <option value="No data" selected>Sélectionner un élève</option> 


    <?php foreach ($connexionBDD->query($reqP) as $row) {
  //echo $row['NOM'].", ".$row['PRENOM']."<br>"; 
  echo "<option value=\"".$row['NOM']."\">".$row['NOM']." ".$row['PRENOM']."</option>"; 

  ///--- Fin foreach ---///
		}

	 ?>


    </select> <br>
    <input type="submit" name="valid">
</form>

<!-- Affiche une partie du tableau après validation -->
<?php
	if (isset($_POST['valid'])){
		    $stud = $_POST['std'];

		    //var_dump($stud);
?>

	 <table class="table table-striped">
    <tbody>
    	<!-- Concerne l'identité de l'étudiant, son nom, prénom et login doivent y figurer -->
    	<tr>
		    <th style="border:1px solid black;">ELEVE :</th>
		    <th style="border:1px solid black;"> 
		    	<?php
					$verdict_final=ChxEleve($connexionBDD, $stud);

				?>

		    </th>
		    
		    
		</tr>
		<!-- Concerne les notes de l'étudiant, les maières et les notes doivent y figurer -->
    	<tr>
		    <th style="border:1px solid black;">Matière</th>
		    <th style="border:1px solid black;">Notes </th>
		    <th style="border:1px solid black;">Moyenne</th>
		    
		</tr>



		<?php

		//pour affivher les notes
		$verdict_final=rlvNote($connexionBDD, $stud);

		?>



</tbody></table>


<?php	
	///--- Fin if isset($_POST['valider']) ---///
	        }

	///--- Fin session professeur ---///  

	}


	?>


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