<?php//créer une fiche élève : seul le prof peut accéder à ce type de fonctionnalité
	function AddStudents($connexionBDD, $POST){
	
		$req = 'INSERT INTO etudiant (NOM, PRENOM, LOGIN, MPASSE) VALUES (:NOM, :PRENOM, :LOGIN, :MPASSE)';


		try{
			//Requête préparée
			$stmt= $connexionBDD->prepare($req);

			//Avec bindValue
			$stmt->bindValue(':NOM',$POST['Nom'],	PDO::PARAM_STR);
			$stmt->bindValue(':PRENOM',$POST['Prenom'],	PDO::PARAM_STR);
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