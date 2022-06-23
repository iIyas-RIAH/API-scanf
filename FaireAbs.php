<?php

    include('sqlConnexion.php');
    
     $response = array(); 
     $output = array();
     $array = array();
     $output = array();

     $idseance = $_POST["idSeance"];
     $image = $_POST["image"];
     
     $target_dir = "Media/AbsImage/PreAbs";
	 $imageStore = $idseance.".png";
	 $target_dir = $target_dir."/".$imageStore;
	 file_put_contents($target_dir, base64_decode($image));

     $sql1 = "SELECT LIBELLE, IDPROFESSEUR, MATIERE FROM seance, classe WHERE classe.IDCLASSE = seance.IDCLASSE and IDSEANCE = '$idseance'";
     $result = mysqli_fetch_row(mysqli_query($connexion,$sql1));
     
     $nom_table = 'seances_'.$result[0].'_'.$result[1].'_'.$result[2];
     $nom_col = 'PRESENCE_'.$idseance;

     $sql2 = "SELECT NOM, PRENOM FROM $nom_table";
     $result1 = mysqli_query($connexion, $sql2);
     
     while($row = mysqli_fetch_assoc($result1)){
        $new_row = implode(" ",$row);
        array_push($array, $new_row);
     }
     
     $list = implode(";",$array);

     
     $link = 'python ScriptPython/load_model_image.py '.$result[0].' '.$imageStore.' '.$list;
     exec($link, $output);

     foreach($output as $e){
         $row = explode (" ", $e);
         $nom = $row['0'];
         $prenom = $row['1'];
         $sql = "UPDATE $nom_table SET $nom_col = '0' WHERE NOM = '$nom' and PRENOM = '$prenom' ";
     
         $result = mysqli_query($connexion,$sql);
     }

     
     if($result){
        $response['msg'] = true;
     }else{
  	  	$response['msg'] = false;
     }
     
     echo json_encode($response);
     mysqli_close($connexion);
     
        
?>
