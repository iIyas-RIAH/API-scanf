<?php 
    include('sqlConnexion.php');

    
	/*
	
	    $response = [[1,2,3],[4,5,6]];  
	    

$arr = array();

    foreach ($response as $inner) {
        $a = 0;
        foreach ($inner as $value) {
            $a += $value;
        }
        array_push($arr, $a);
    }
    
    


        echo json_encode($arr);  */

$arr = array("Welcome","to", "GeeksforGeeks", 
    "A", "Computer","Science","Portal");  
    
$t = implode(" ",$arr);
 echo $t;
        
        
       // mysqli_close($connexion);

?>