<?php
	public function getListeStudent($connexionBDD){
		$student=[];

		$req= 'SELECT NOM, PRENOM, DATE_NAISSANCE, CIVILITE, email, ID
			   FROM etudiant
			   ORDER BY NOM ASC';

		try{
			//préparer et Executer la requête
			$stmt= $connexionBDD->query($req);

			//On récupère les données sous forme d'un tableau
			while($donnees = $stmt->fetch(PDO::FETCH_ASSOC)){
				$student[]=$donnees;
			}

			//on préfère la base
			$stmt->closerCursor();

			return $student;

		}
		catch(PDOException $e){
			echo "Erreur : ".$e->getMessage();
		}
	}


//Récupérer 1 étudiant à partir de son ID (et non un ensemble d'étudiants)
	//$ID provient du formulaire soumis
	//Dans notre exercice, l'étudiant ne voit que ses notes : on passera donc la requête le $_SESSION['login']

	public function getStudentById($ID,$connexionBDD){
		$req = 'SELECT NOM, PRENOM, DATE_NAISSANCE, CIVILITE, email, ID
			   FROM etudiant
			   WHERE ID= '.$ID;

		$req= $connexionBDD->query($req);

		$client=$stmt->fetch(PDO::FETCH_ASSOC);

		//On referme la base
		$stmt->closureCursor();

		return $client;
	}

?>