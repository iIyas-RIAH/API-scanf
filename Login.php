<?php 
    include('sqlConnexion.php');
	
	    $response = array();  


		$email = $_POST["email"];
		$password = $_POST["password"];


        $stmt = $connexion->prepare("SELECT IDPROFESSEUR, NOMCOMPLET, EMAIL, MOBILE, PHOTO  FROM professeur WHERE EMAIL = ? AND PASSWORD = ?");  
        $stmt->bind_param("ss",$email, $password);  
        $stmt->execute();  
        $stmt->store_result();
		
		if($stmt->num_rows > 0){
			$stmt->bind_result($id, $username, $email, $mobile, $photo);  
    		$stmt->fetch();  
    		$user = array(  
    			'IDPROFESSEUR'=>$id,   
    			'NOMCOMPLET'=>$username,   
    			'EMAIL'=>$email,  
    			'MOBILE'=>$mobile,
    			'PHOTO'=>base64_encode($photo)
    		);  
    		$response['msg'] = true;
       		$response['professeur'] = $user;
		}else{
  			$response['msg'] = false;
        }
        echo json_encode($response);  
        mysqli_close($connexion);

?>