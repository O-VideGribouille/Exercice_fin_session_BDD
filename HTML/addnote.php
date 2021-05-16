<?php//créer une fiche élève : seul le prof peut accéder à ce type de fonctionnalité
	function AddNote($connexionBDD, $POST){
	
		$reqInsert = 'INSERT INTO etudiant (STATUT, NOM, PRENOM, MATIERE, NOTE, LOGIN, MPASSE) VALUES (:STATUT, :NOM, :PRENOM, :MATIERE, :NOTE, :LOGIN, :MPASSE)';


		try{
			//Requête préparée
			$stmt= $connexionBDD->prepare($reqInsert);

			//Avec bindValue
			$stmt->bindValue(':STATUT',$POST['Statut'],	PDO::PARAM_STR);
			$stmt->bindValue(':NOM',$POST['Nom'],	PDO::PARAM_STR);
			$stmt->bindValue(':PRENOM',$POST['Prenom'],	PDO::PARAM_STR);
			$stmt->bindValue(':MATIERE',$POST['Matiere'],	PDO::PARAM_STR);
			$stmt->bindValue(':NOTE',$POST['Note'],	PDO::PARAM_STR);
			$stmt->bindValue(':LOGIN',$POST['Login'],	PDO::PARAM_STR);
			$stmt->bindValue(':MPASSE',$POST['Passwd'],	PDO::PARAM_STR);

			//Exécuter la requête
			$stmt->execute();

			//On referme la base
			//$stmt->closerCursor();

			//On indique que l'insertion s'est bien passée
			echo "<p style=\"color:#5F9EA0;font-weight: bold; \">Enregistré avec succès ! </p>";
		}

		catch(PDOExeption $e){
			echo "Erreur : ".$e->getMessage();
		}
	}
?>