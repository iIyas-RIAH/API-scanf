<?php

    include('sqlConnexion.php');

     $response = array();
     $idprof = $_POST["idprof"];
     $classe = $_POST["classe"];
     $date = $_POST["date"];
     $heure = $_POST["heure"];
     $matiere = $_POST["matiere"];
     
     /*$response = array();
     $idprof = "1";
     $classe = "GI4";
     $date = "2022-05-04";
     $heure = "15:55";
     $matiere = "te";*/
     
     $sql1 = "SELECT IDCLASSE FROM classe WHERE LIBELLE = '$classe'";
     $idclasse = mysqli_fetch_row(mysqli_query($connexion, $sql1))[0];

     $sql2 = "INSERT INTO seance(IDCLASSE, IDPROFESSEUR, DATE, HEURE, MATIERE) VALUES ('$idclasse', '$idprof', '$date', '$heure', '$matiere')";
     $result1 = mysqli_query($connexion,$sql2);

     $sql3 = "SELECT IDSEANCE FROM seance WHERE IDPROFESSEUR = '$idprof' and DATE = '$date' and HEURE = '$heure' and MATIERE = '$matiere'";
     $idseance = mysqli_fetch_row(mysqli_query($connexion, $sql3))[0];
     
     $nom_table = 'seances_'.$classe.'_'.$idprof.'_'.$matiere;
     $sql4 = "CREATE TABLE IF NOT EXISTS $nom_table AS SELECT APOGEE, NOM, PRENOM FROM etudiant WHERE IDCLASSE = '$idclasse' ORDER BY NOM, PRENOM";
     $result2 = mysqli_query($connexion,$sql4);
     
     $nom_col = 'PRESENCE_'.$idseance;
     $sql5 = "ALTER TABLE $nom_table ADD $nom_col int(1) DEFAULT(1)";
     $result3 = mysqli_query($connexion,$sql5);
     
     if($result1 && $result2 && $result3) {
        $response['msg'] = true;
     }
     echo json_encode($response);
     mysqli_close($connexion);
        
?>