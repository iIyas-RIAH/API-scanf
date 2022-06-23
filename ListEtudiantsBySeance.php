<?php 

    include('sqlConnexion.php');
	
	$response = array();
	$response['etudiant'] = array();
	$idseance = $_POST["idSeance"];
	
	$sql1 = "SELECT IDPROFESSEUR FROM seance WHERE IDSEANCE = '$idseance'";
    $idprof = mysqli_fetch_row(mysqli_query($connexion,$sql1))[0];
     
    $sql2 = "SELECT MATIERE FROM seance WHERE IDSEANCE = '$idseance'";
    $matiere = mysqli_fetch_row(mysqli_query($connexion,$sql2))[0];
     
    $sql3 = "SELECT LIBELLE FROM classe INNER JOIN seance ON classe.IDCLASSE = seance.IDCLASSE and IDSEANCE = '$idseance'";
    $classe = mysqli_fetch_row(mysqli_query($connexion,$sql3))[0];

	$nom_table = 'seances_'.$classe.'_'.$idprof.'_'.$matiere;
	$stat = 'PRESENCE_'.$idseance;
	
	$sql4 = "SELECT APOGEE, NOM, PRENOM, $stat FROM $nom_table order by nom";
	$stmt = mysqli_query($connexion,$sql4);

    while($row = mysqli_fetch_array($stmt)) {
        
        $etudiant['IDETUDIANT'] = $row['0'];
        $etudiant['NOM'] = $row['1'];
        $etudiant['PRENOM'] = $row['2'];
        $etudiant['STAT'] = $row['3'];

        
        array_push($response['etudiant'], $etudiant);
    }
	
	echo json_encode($response);
	mysqli_close($connexion);

 ?>