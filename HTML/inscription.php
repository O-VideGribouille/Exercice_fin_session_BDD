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
	<title>Inscription</title>

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

 					<!--<li id="li_acc1" name="li_acc" class="list_nav">

 						<a href="index.php" id="nav_acc1" name="nav_acc" class="a_nav"> Accueil </a>  

 					</li>-->

          <li id="li_login" name="li_login" class="list_nav"> 

              <a href="login.php" id="nav_acc3" name="nav_acc3" class="a_nav"> Connexion </a> 

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

    //$AfficherFormulaire=1;
		?>   
      <form action="" method="post">

         <fieldset>

          <legend>Formulaire d'inscription</legend>
          <!-- Si'il y une erreur de saisie on envoie l'erreur comme paramètre de url -->
          <?php  if(isset($_GET["erreur"])){
            echo "<p style=\"color:red; \">Il y a une erreur</p>";}
            ?>

            <label>Statut :</label> <br/><br/>

            <label for="Professeur">Professeur </label>
            <input type="radio" name="Statut" id="Professeur" value="Professeur"/>

            <label for="Eleve">  Eleve </label>
            <input type="radio" name="Statut" id="Eleve" value="Eleve"/><br/><br/>
            

            <label for="Nom">NOM :</label>
            <input type="text" name="Nom" id="Nom" placeholder="Entrez votre nom" maxlength="50" required="required"/> <br/><br/>

            <label for="Prenom">Prénom :</label>
            <input type="text" name="Prenom" id="Prenom" placeholder="Entrez votre prenom" maxlength="50" required="required"/><br/><br/>

            <label for="Login">Login :</label>
            <input type="text" name="Login" id="Login" placeholder="Entrez votre login pnom" maxlength="50" required="required"/><br/><br/>

            <label for="Passwd">Password :</label>
            <input type="password" name="Passwd" id="Passwd" placeholder="Entrez un mot de passe (numérique uniquement)" minlength="8" maxlength="13" required="required"/><br/><br/>

            <label for="PasswdV">Vérfification du password :</label>
            <input type="password" name="PasswdV" id="PasswdV" placeholder="Entrez votre mot de passe" minlength="8" maxlength="13" required="required"/><br/><br/>

            <input type="submit" name="Envoyer" value="Envoyer"/>

        </fieldset>

      </form>

      <?php
 

        /*Traitement du formulaire après envoi*/
         if(isset($_POST["Envoyer"])){
              //$AfficherFormulaire=1;

                /* authentification */
          
          $statut = $_POST['Statut'];
          $nom = $_POST['Nom'];
          $prenom = $_POST['Prenom'];
          $login = $_POST['Login'];
          $passwd = $_POST['Passwd'];
          $passwdV = $_POST['PasswdV'];

          //Requête pour vérifier si le login est déjà existant dans la base. On comptera s'il y en a déjà un ou plus.
          //Cette requête ne sera pas retenu, car il faudrait faire un foreach et une manipulation suplémantaire
          //$req = 'SELECT COUNT(LOGIN) AS NBlogin FROM etudiant WHERE LOGIN = \''.$login.'\';';
          //Requête pour vérifier si le login est déjà existant dans la base.
          //cette requête se valide avec la fonction rowCount().
          $req = 'SELECT LOGIN FROM etudiant WHERE LOGIN = \''.$login.'\';';

          $sql = $connexionBDD->query($req);
          //var_dump($sql);
        
          //Vérification que les champs soient remplis
          if(empty($nom)||empty($prenom)||empty($login)||empty($passwd)||empty($passwdV)||empty($statut)){
            echo "<p style=\"color:#C60800;font-weight: bold; \">Il y a une erreur, tous les champs sont obligatoires ! Veuillez recommencer. </p>"; //changement de style dans la balise, car refut de la class.
          }elseif($passwd != $passwdV){
          //vérification du mot de passe, si dans les deux champs le mp est inscrit de la même façon

                 echo "<p style=\"color:#C60800; font-weight: bold; \">Le mot de passe est invalide.</p>";

          }elseif(!preg_match("#^[a-z]+$#",$login)){
          //vérification du login, accepte unique les lettres minuscule, sans accent

                 echo "<p style=\"color:#C60800; font-weight: bold; \">Le login doit être renseigné en lettres minuscules sans accents.</p>";

          }elseif(!preg_match("#^[0-9]+$#",$passwd)||!preg_match("#^[0-9]+$#",$passwdV)){
            //vérification du mp et du mpverfi, accepte unique les chiffre, sans accent, ni caractères spéciaux

                 echo "<p style=\"color:#C60800; font-weight: bold; \">Le mot de passe doit être renseigné en numérique, sans caractères spéciaux.</p>";

              }elseif(strlen($login)>50||strlen($nom)>50||strlen($prenom)>50){
              //délimitation du login/NOM/Prénom à 50 caractères, il peut tout de même faire moins que le nombre indiqué
              
                 echo "<p style=\"color:#C60800; font-weight: bold; \">Le login, le nom ou le prénom est trop long, il dépasse 50 caractères.</p>";

               }elseif($sql->rowCount() != 0)/*(!$chk_login == 0)*/{//on vérifie que ce pseudo n'est pas déjà utilisé par un autre membre
                  echo "<p style=\"color:#C60800; font-weight: bold; \">Ce login est déjà utilisé.</p>";
  
              }else{

                //toutes les vérifications sont faites 
                $post = $_POST;
                function AddStudents($connexionBDD, $POST){
  
                    $req = 'INSERT INTO etudiant (STATUT, NOM, PRENOM, LOGIN, MPASSE) VALUES (:STATUT, :NOM, :PRENOM, :LOGIN, :MPASSE)';


                    try{
                      //Requête préparée
                      $stmt= $connexionBDD->prepare($req);

                      //Avec bindValue
                      $stmt->bindValue(':STATUT',$POST['Statut'],  PDO::PARAM_STR);
                      $stmt->bindValue(':NOM',$POST['Nom'],  PDO::PARAM_STR);
                      $stmt->bindValue(':PRENOM',$POST['Prenom'],  PDO::PARAM_STR);
                      $stmt->bindValue(':LOGIN',$POST['Login'],  PDO::PARAM_STR);
                      $stmt->bindValue(':MPASSE',$POST['Passwd'],  PDO::PARAM_STR);

                      //Exécuter la requête
                      $stmt->execute();

                      //On indique que l'insertion s'est bien passée

                      echo "<p style=\"color:#5F9EA0;font-weight: bold; \">Enregistré avec succès ! </p>";
                    }

                    catch(PDOExeption $e){
                      echo "Erreur : ".$e->getMessage();
                    }
                  }
                //Enregistrement dans la base de données:
                
                AddStudents($connexionBDD, $post);


                
              } 
    ?>

    <?php

    //if ($AfficherFormulaire==1){

         }
     }
     /*si l'utilisateur redemande la page inscription.php après authentification on lui affiche un message de bienvenue et le lien déconnexion*/
     else{
     	echo "Bonjour ".$_SESSION["login"]."<br>"."Tu es déjà inscrit.<br> Souhaites-tu te ";
     	echo "<a href=\"logout.php\">déconnecter</a> ?";
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