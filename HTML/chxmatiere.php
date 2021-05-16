<?php

function ChxMatiere($connexionBDD ,$matr, $login){

    //Afficher les noms des matières et les notes individuelles
    $req = 'SELECT MATIERE, NOTE FROM etudiant WHERE LOGIN = \''.$login.'\'AND MATIERE = \''.$matr.'\';';

    //Afficher les moyennes totales par matières
    $reqMM = 'SELECT AVG(NOTE) AS MOYENNE_M FROM etudiant WHERE LOGIN = \''.$login.'\'AND MATIERE = \''.$matr.'\'GROUP BY MATIERE;';

    //Afficher la moyenne globale de l'élève
    $reqMTT = 'SELECT AVG(NOTE) AS MOYENNE_TT FROM etudiant WHERE LOGIN = \''.$login.'\';';
    


    echo "
  
    <tr>
        <td style=\"border:1px solid black;\" align=\"center\">


            ".$matr."              
        </td>               
        <td style=\"border:1px solid black;\" align=\"center\">";

          foreach ($connexionBDD->query($req) as $row) { 

            echo $row['NOTE']."<br>";
             }

        echo "          
            
            
        </td>       
        <td style=\"border:1px solid black;\" align=\"center\">";


        foreach ($connexionBDD->query($reqMM) as $row) { 

            echo $row['MOYENNE_M']."<br>";
             }

        echo " </td>

        
        </tr>

    

    



    <tr><td style=\"border:1px solid black;\" align=\"center\"></td>
    
    <td style=\"border:1px solid black;\" align=\"center\">Moyenne Générale</td>
    <td style=\"border:1px solid black;\" align=\"center\">";

    foreach ($connexionBDD->query($reqMTT) as $row) { 

            echo $row['MOYENNE_TT']."<br>";
             }

    echo "
    </td>
    </tr>
    

    ";

   



}
?>