<?php 
		//Démarrer la session
		session_start();
  ///---///
  //Ecriture du code de connexion dans une autre page 
  include "connexion.php";
  $connexionBDD = connect_bd(); // permet l'utilisation au fil de la page

?>



<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>

	<meta charset="utf-8">

	<link rel="shortcut icon" type="image/x-icon" href="../img/logo/icone.png">

	<link rel="stylesheet" type="text/css" href="../CSS/index_template.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Exercice_Formulaire.css">
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

 					<li id="li_acc1" name="li_acc" class="list_nav">

 						<a href="inscription.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Inscription </a>  

 					</li>

          <?php if(isset($_SESSION["login"])){ ?>
          <li id="li_login" name="li_login" class="list_nav"> 

              <a href="deconnexion.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Déconnexion </a> 

            </li> 

                        <li id="li_login" name="li_login" class="list_nav"> 

              <a href="userpage.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Accueil </a> 

            </li> 
          <?php } ?>
			
				</ul> 

			</div>


		</nav>

	</header>
		<!-- -->
		<!-- -->
		<!-- -->

<div id="divPrincipal" name="divPrincipal" class="divArticle">


		<!-- -->
		<!-- -->
		<!-- -->

	
  <!-- Si l'utilisateur n'est pas encore authentifier on affiche le formulaire -->
	<?php if(!isset($_SESSION["login"])){
		?>
     <div class="login_cr">
     	<form action="" method="post">
     		<fieldset>
     			<legend>Formulaire d'authentification</legend>
          <!-- Si'il y une erreur de saisie on envoie l'erreur comme paramètre de url -->
     			<?php if(isset($_GET["erreur"]))
     				echo "<p style=\"color:red; \">login ou mot de passe incorrect</p>";
     				?>

     			<label for="login">Login :</label>
     			<input type="text" name="Login" id="Login" placeholder="Entrez votre login pnom" maxlength="50" required/>

     			<label for="passwd">Password :</label>
     			<input type="password" name="Passwd" id="Passwd" maxlength="13" placeholder="Entrez votre mot de passe" required>

     			<input type="submit" name="Envoyer" value="Envoyer"/>
     		</fieldset>
     	</form>
     </div>
     <?php
          
        /*Traitement du formulaire après envoi*/
         if(isset($_POST["Envoyer"])){

          $login = $_POST['Login'];
          $passwd = $_POST['Passwd'];

        //réutilisation de la requête de l'inscription, cette fois-ci pour validé l'existence du login et du mp dans la base de donnée et validée la connexion.
        $req = 'SELECT LOGIN AS NBlogin, STATUT FROM etudiant WHERE LOGIN = \''.$login.'\' AND MPASSE = \''.$passwd.'\';';

        //connexion à la base de données, afin de récupérer les données nécessère aux requêtes
        $sql = $connexionBDD->query($req);
        //$sql2 = $connexionBDD->query($reqEle);
        //$sql3 = $connexionBDD->query($reqProf);

              if($sql->rowCount()!=0){
                $_SESSION["login"]=$login;
                foreach ($sql as $key => $value) {
                  $_SESSION["statut"]=$value['STATUT'];
                }
                
                header("Location:userpage.php");
              }else{
                header("Location:login.php?erreur=1");

                echo "<p style=\"color:#C60800; font-weight: bold; \">Le login ou le mot de passe est incorrect.</p>";
              }

         }
     }
     /*si l'utilisateur redemande la page login.php après authentification on lui affiche un message de bienvenue et le lien déconnexion*/
     else{
     	echo "Bonjour ".$_SESSION["login"]."<br>";
     	echo "<a href=\"logout.php\">Déconnection</a>";
     }
     ?>

</div>


	<footer id="BBody" name="BBody">
		
		<div id="dF1" name="dF1" class="divFooter">
		
			<img src="../img/logo/signature.png" id="logo2" name="signature" class="logo">

			<p id="pF1" name="pF1" class="FooterP"> Oriane VICECONTE (F2) - 2020 </p>
			
			<p id="pF2" name="pF2" class="FooterP"> Contact : o.viceconte@ludus-academie.com </p>

		</div>
	
	</footer>


</body>
</html>