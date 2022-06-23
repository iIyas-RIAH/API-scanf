<?php 

    include('sqlConnexion.php');
	
	$response = array();
	$response['classe'] = array();

	$sql = "SELECT LIBELLE FROM classe";    
	$stmt = mysqli_query($connexion,$sql);

    while($row = mysqli_fetch_array($stmt)) {
        
        $classe['LIBELLE'] = $row['0'];
        
        array_push($response['classe'], $classe);
    }
	
	echo json_encode($response);
	mysqli_close($connexion);

 ?>