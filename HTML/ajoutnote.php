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
  <title>Ajout note</title>

  <meta charset="utf-8">

  <link rel="shortcut icon" type="image/x-icon" href="../img/logo/icone.png">

  <link rel="stylesheet" type="text/css" href="../CSS/index_template.css">
  <link rel="stylesheet" type="text/css" href="../CSS/Exercice_Formulaire.css">
  <style>

  <?php if($_SESSION["statut"] == 'Professeur'){ ?>


  
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

          <li id="li_login" name="li_login" class="list_nav">
          <a href="inscription.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Inscription </a>  

          </li>

          <li id="li_login" name="li_login" class="list_nav"> 

              <a href="login2.php" id="nav_acc3" name="nav_acc3" class="a_nav"> Connexion </a> 

            </li> 

            
          <li id="li_login" name="li_login" class="list_nav"> 

              <a href="deconnexion.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Déconnexion </a> 

            </li> 

                        <li id="li_login" name="li_login" class="list_nav"> 

              <a href="userpage2.php" id="nav_acc2" name="nav_acc2" class="a_nav"> Accueil </a> 

            </li> 
          



      
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
  <?php if($_SESSION["statut"] == 'Professeur'){

    
    ?>   
      
<form action="" method="post">

         <fieldset>

          <legend>Formulaire ajout note</legend>
          <!-- Si'il y une erreur de saisie on envoie l'erreur comme paramètre de url -->
                <?php  if(isset($_GET["erreur"])){
                  echo '<p style=\'color:red; \'>Il y a une erreur</p>';}
                  ?>
                  <?php
                  $reqP= 'SELECT DISTINCT STATUT, NOM, PRENOM, LOGIN, MPASSE
                     FROM etudiant
                     WHERE STATUT = "Eleve"
                     GROUP BY NOM
                     ORDER BY NOM ASC';

                  include ('chxeleve.php'); ?>

                  <label for="Matiere">Etudiants :</label><br>
                  <select name="std" id="std" size="4">
                    <option value="No_data_found" selected>Sélectionner un élève</option> 


                    <?php foreach ($connexionBDD->query($reqP) as $row) {
                  //echo $row['NOM'].", ".$row['PRENOM']."<br>"; 
                  echo '<option value=\''.$row['NOM'].'\'>'.$row['NOM'].' '.$row['PRENOM'].'</option>'; 

                  ///--- Fin foreach ---///
                    }

                   ?>


                    </select> <br><br>



                    <label for="Matiere">Matière :</label><br>
                    <label for="Algorithme">  ALGORITHME </label>
                    <input type="radio" name="Matiere" id="Algorithme" value="ALGORITHME"/><br>
                   
                    <label for="Game_design">  GAME DESIGN </label>
                    <input type="radio" name="Matiere" id="Game_design" value="GAME DESIGN"/><br>
                  
                    <label for="Web">  WEB </label>
                    <input type="radio" name="Matiere" id="Web" value="WEB"/><br><br>
                  
                  

                  <label for="Note">Note:</label>
                  <input type="number" name="Note" id="Note" placeholder="Entrez votre note" min="0" max="20" maxlength="2" required="required"/><br/><br/>

                  <input type="submit" name="Envoyer" value="Envoyer"/>

        </fieldset>

      </form>

      <?php 
        if(isset($_POST["Envoyer"])){

          if(empty($_POST['Note'])){
            //Vérification que les champs soient remplis
            //changement de style dans la balise, car refut de la class.
            echo '<p style=\'color:#C60800;font-weight: bold; \'>Il y a une erreur, tous les champs sont obligatoires ! Veuillez recommencer. </p>';

          }else{

                //toutes les vérifications sont faites 
                $POST = $_POST;
                function AddNote($connexionBDD, $POST){

                  ///--- Récupération des données de l'élève ---///
                  
                   $req3 = 'SELECT DISTINCT STATUT, NOM, PRENOM, LOGIN, MPASSE FROM etudiant WHERE NOM = \''.$POST['std'].'\';';

                    foreach ($connexionBDD->query($req3) as $row) {

                  ///--- Insertion des données de l'élève ---///
  
                    $reqInsert = 'INSERT INTO etudiant (STATUT, NOM, PRENOM, MATIERE, NOTE, LOGIN, MPASSE) VALUES (:STATUT, :NOM, :PRENOM, :MATIERE, :NOTE, :LOGIN, :MPASSE)';


                    try{
                        //Requête préparée
                        $stmt= $connexionBDD->prepare($reqInsert);

                        //Avec bindValue
                        $stmt->bindValue(':STATUT',$row['STATUT'], PDO::PARAM_STR);
                        $stmt->bindValue(':NOM',$row['NOM'], PDO::PARAM_STR);
                        $stmt->bindValue(':PRENOM',$row['PRENOM'], PDO::PARAM_STR);
                        $stmt->bindValue(':MATIERE',$POST['Matiere'], PDO::PARAM_STR);
                        $stmt->bindValue(':NOTE',$POST['Note'], PDO::PARAM_STR);
                        $stmt->bindValue(':LOGIN',$row['LOGIN'], PDO::PARAM_STR);
                        $stmt->bindValue(':MPASSE',$row['MPASSE'], PDO::PARAM_STR);

                        ///--- fin foreach ---///
                        //}

                        //Exécuter la requête
                        $stmt->execute();

                        //On referme la base
                        //$stmt->closerCursor();

                        //On indique que l'insertion s'est bien passée
                        echo '<p style=\"color:#5F9EA0;font-weight: bold; \">Enregistré avec succès ! </p>';
                      }

                    catch(PDOExeption $e){
                      echo 'Erreur : '.$e->getMessage();
                    }
                  }
                ///--- fin function AddNotes ---///
                }
                //Enregistrement dans la base de données:
                 
                AddNote($connexionBDD, $_POST);

                ///--- fin else ---///
              } 
      ?>


<?php 
    ///--- if(isset($_POST["Envoyer"])) ---///
      }

    ///--- Fin if($_SESSION["statut"] == 'Professeur') ---///
    } ?> 


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