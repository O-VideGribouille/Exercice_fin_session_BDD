<?php

function ChxEleve($connexionBDD ,$stud){


    $reqStd = 'SELECT DISTINCT NOM, PRENOM, LOGIN FROM etudiant WHERE NOM = \''.$stud.'\';';
    


          foreach ($connexionBDD->query($reqStd) as $row) { 

            echo $row['NOM']." ".$row['PRENOM']." (".$row['LOGIN'].")";
             }


}

///--- Affichage des notes ---///

function rlvNote($connexionBDD ,$stud){


    $reqMatr = 'SELECT DISTINCT MATIERE FROM etudiant WHERE NOM = \''.$stud.'\';';

    $reqMTT = 'SELECT AVG(NOTE) AS MOYENNE_TT FROM etudiant WHERE NOM =\''.$stud.'\';';
    

    foreach ($connexionBDD->query($reqMatr) as $row) { 
    echo "
            
    <tr>
        <td style=\"border:1px solid black;\" align=\"center\">


            ".$row['MATIERE']."              
        </td> "; 

        echo "             
        <td style=\"border:1px solid black;\" align=\"center\">";

        $reqNote = 'SELECT  NOTE FROM etudiant WHERE NOM = \''.$stud.'\' AND MATIERE = \''.$row['MATIERE'].'\' ;';
            
          foreach ($connexionBDD->query($reqNote) as $row2) { 
            echo $row2['NOTE']."<br> ";
            //fermeture foreah reqNote
             }

             echo "</td>";
        

    

               
            
            
         

        echo "
        <td style=\"border:1px solid black;\" align=\"center\">";

       
        ///--- Concerne la moyenne par matière ---///
        $reqMM = 'SELECT AVG(NOTE) AS MOYENNE_M FROM etudiant WHERE NOM =\''.$stud.'\'AND MATIERE = \''.$row['MATIERE'].'\'GROUP BY MATIERE;';

        foreach ($connexionBDD->query($reqMM) as $row3) { 

            echo $row3['MOYENNE_M']."<br>";
            //fermeture foreach reqMM
             }

    

       echo " </td>

        
        </tr>";

        //fermeture foreach reqMatr
        }

        ///--- Concerne la moyenne général (toute les moyennes réunies) ---///
        echo "<tr><td style=\"border:1px solid black;\" align=\"center\"></td>
    
        <td style=\"border:1px solid black;\" align=\"center\">Moyenne Générale</td>
        <td style=\"border:1px solid black;\" align=\"center\">";

             foreach ($connexionBDD->query($reqMTT) as $row4) { 

                 echo $row4['MOYENNE_TT']."<br>";
             }

    echo "
    </td>
    </tr>
    

    ";

   



}

?>