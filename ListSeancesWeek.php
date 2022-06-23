<?php 

    include('sqlConnexion.php');
	
	$response = array();
	$response['seance'] = array();
	$id = $_POST["IDPROFESSEUR"];
	$today = date("Y-m-d");
	$stop_date = date("Y-m-d", strtotime('next Sunday', strtotime($today)));

	
	$sql = "SELECT IDSEANCE, LIBELLE, IDPROFESSEUR, DATE, HEURE, MATIERE FROM seance, classe WHERE IDPROFESSEUR = '$id' AND seance.IDCLASSE = classe.IDCLASSE AND DATE between '$today' AND '$stop_date' order by IDSEANCE";  
    $stmt = mysqli_query($connexion,$sql);  

    while($row = mysqli_fetch_array($stmt)) {
        
        $seance['IDSEANCE'] = $row['0'];
        $seance['LIBELLE'] = $row['1'];
        $seance['IDPROFESSEUR'] = $row['2'];
        $seance['DATE'] = $row['3'];
        $seance['HEURE'] = $row['4'];
        $seance['MATIERE'] = $row['5'];
        
        array_push($response['seance'], $seance);
    }

	echo json_encode($response);
	mysqli_close($connexion);

 ?>