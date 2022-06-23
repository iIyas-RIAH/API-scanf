<?php 

    include('sqlConnexion.php');
	
	$response = array();
	$arr = array();
	$response['etudiant'] = array();
	$response['abs'] = array();
	$idclasse = $_POST["idClasse"];
	//$idclasse = "1";
	
	$sql1 = "SELECT IDPROFESSEUR FROM seance WHERE IDCLASSE = '$idclasse'";
    $idprof = mysqli_fetch_row(mysqli_query($connexion,$sql1))[0];
     
    $sql2 = "SELECT MATIERE FROM seance WHERE IDCLASSE = '$idclasse'";
    $matiere = mysqli_fetch_row(mysqli_query($connexion,$sql2))[0];
     
    $sql3 = "SELECT IDSEANCE FROM seance WHERE IDCLASSE = '$idclasse'";
    $idseance = mysqli_fetch_row(mysqli_query($connexion,$sql3))[0];

    $sql4 = "SELECT LIBELLE FROM classe WHERE IDCLASSE = '$idclasse'";
    $classe = mysqli_fetch_row(mysqli_query($connexion,$sql4))[0];
    
	$nom_table = 'seances_'.$classe.'_'.$idprof.'_'.$matiere;
	$stat = 'PRESENCE_'.$idseance;
	
	$sql4 = "SELECT APOGEE, NOM, PRENOM FROM $nom_table order by nom, prenom";
	$stmt = mysqli_query($connexion,$sql4);
	
	$sql5 = "SELECT * FROM $nom_table order by nom, prenom";
	$totalAbs = mysqli_query($connexion,$sql5);

    while($row = mysqli_fetch_array($stmt)) {
        
        $etudiant['IDETUDIANT'] = $row['0'];
        $etudiant['NOM'] = $row['1'];
        $etudiant['PRENOM'] = $row['2'];
        
        array_push($response['etudiant'], $etudiant);
    }


    while($row = mysqli_fetch_assoc($totalAbs)){
        $array[] = $row;
    }

    for($i = 0, $length = count($array); $i < $length; $i++){
        unset($array[$i]['APOGEE']);
        unset($array[$i]['NOM']);
        unset($array[$i]['PRENOM']);
    }
    
    foreach ($array as $inner) {
        $a = 0;
        foreach ($inner as $value) {
            $a += $value;
        }
        array_push($response['abs'], $a);
    }


	echo json_encode($response);
	mysqli_close($connexion);

 ?>