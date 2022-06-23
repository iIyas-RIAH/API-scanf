<?php

    include('sqlConnexion.php');
    
     $response = array(); 

     $id = $_POST["id"];
     $name = $_POST["name"];
     $email = $_POST["email"];
     $mobile = $_POST["mobile"];
     $password = $_POST["password"];
     $image = $_POST["image"];
     
     

     if(!empty($image)) {
         $target_dir = "Media/ProfileImages";
	     $imageStore = $id.".jpeg";
	     $target_dir = $target_dir."/".$imageStore;
         unlink($target_dir);
         file_put_contents($target_dir, base64_decode($image));
     }


     $sql = "UPDATE professeur SET NOMCOMPLET = '$name', EMAIL = '$email', MOBILE = '$mobile', PASSWORD = '$password', PHOTO = '$imageStore' WHERE IDPROFESSEUR = '$id' ";
     
     $result = mysqli_query($connexion,$sql);
     
     if($result){
        $response['msg'] = true;
     }else{
  	  	$response['msg'] = false;
     }
     
     echo json_encode($response);
     mysqli_close($connexion);
     
        
?>