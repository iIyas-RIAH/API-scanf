<?php

    include('sqlConnexion.php');
    
     $response = array();
     $result1 = $result2 = $result3 = $result4 = false;

    
     $idseance = $_POST["idseance"];
     $idprof = $_POST["idprof"];
     $classe = $_POST["classe"];
     $date = $_POST["date"];
     $heure = $_POST["heure"];
     $matiere = $_POST["matiere"];
     
     $sql1 = "SELECT LIBELLE, IDPROFESSEUR, MATIERE FROM seance, classe WHERE classe.IDCLASSE = seance.IDCLASSE and IDSEANCE = '$idseance'";
     $result = mysqli_fetch_row(mysqli_query($connexion,$sql1));
     
     $sql2 = "SELECT IDCLASSE FROM classe WHERE LIBELLE = '$classe'";
     $idclasse = mysqli_fetch_row(mysqli_query($connexion, $sql2))[0];

     $old_nom_table = 'seances_'.$result[0].'_'.$result[1].'_'.$result[2];
     $new_nom_table = 'seances_'.$classe.'_'.$idprof.'_'.$matiere;
     $nom_col = 'PRESENCE_'.$idseance;

     $sql3 = "UPDATE seance SET IDCLASSE = '$idclasse', MATIERE = '$matiere', DATE = '$date', HEURE = '$heure' WHERE IDSEANCE = '$idseance'";
     $result1 = mysqli_query($connexion,$sql3);
     
     if($classe != $result[0] || $matiere != $result[2]){
        $sql4 = "CREATE TABLE IF NOT EXISTS $new_nom_table AS SELECT APOGEE, NOM, PRENOM FROM etudiant WHERE IDCLASSE = '$idclasse' ORDER BY NOM, PRENOM";
        $result2 = mysqli_query($connexion,$sql4);
            

        $sql5 = "ALTER TABLE $new_nom_table ADD $nom_col int(1)";
        $result3 = mysqli_query($connexion,$sql5);


        $sql6 = "ALTER TABLE $old_nom_table DROP COLUMN $nom_col";
        $result4 = mysqli_query($connexion,$sql6);

     }else{
        $result2 = $result3 = $result4 = true;
     }
     
     if($result1 && $result2 && $result3 && $result4){
        $response['msg'] = true;
	 }else{
  		$response['msg'] = false;
     }
     echo json_encode($response);
     mysqli_close($connexion);
     


?>