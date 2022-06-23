<?php 

    include('sqlConnexion.php');
	
	$response = array();
	$response['classe'] = array();
	$id = $_POST["IDPROFESSEUR"];
	
	$sql = "SELECT DISTINCT classe.IDCLASSE, classe.LIBELLE FROM classe, seance WHERE classe.IDCLASSE = seance.IDCLASSE and seance.IDPROFESSEUR = '$id'";    
	$stmt = mysqli_query($connexion,$sql);

    while($row = mysqli_fetch_array($stmt)) {
        
        $classe['IDCLASSE'] = $row['0'];
        $classe['LIBELLE'] = $row['1'];
        
        array_push($response['classe'], $classe);
    }
	
	echo json_encode($response);
	mysqli_close($connexion);

 ?>