<?php

    include('sqlConnexion.php');
    
     $idseance = $_POST["idSeance"];

     $sql1 = "SELECT IDPROFESSEUR FROM seance WHERE IDSEANCE = '$idseance'";
     $idprof = mysqli_fetch_row(mysqli_query($connexion,$sql1))[0];
     
     $sql2 = "SELECT MATIERE FROM seance WHERE IDSEANCE = '$idseance'";
     $matiere = mysqli_fetch_row(mysqli_query($connexion,$sql2))[0];
     
     $sql3 = "SELECT LIBELLE FROM classe INNER JOIN seance ON classe.IDCLASSE = seance.IDCLASSE and IDSEANCE = '$idseance'";
     $classe = mysqli_fetch_row(mysqli_query($connexion,$sql3))[0];

     $nom_table = 'seances_'.$classe.'_'.$idprof.'_'.$matiere;
     $nom_col = 'PRESENCE_'.$idseance;

     $sql4 = "ALTER TABLE $nom_table DROP COLUMN $nom_col";
     $result1 = mysqli_query($connexion,$sql4);

     //$sql = "ALTER TABLE $nom_table ADD $nom_col int(1)";

     $sql5 = "DELETE FROM seance WHERE IDSEANCE='$idseance'";
     $result2 = mysqli_query($connexion,$sql5);
     
     if($result1 && $result2){
         echo "Data Deleted";
     }
     mysqli_close($connexion);
     


?>