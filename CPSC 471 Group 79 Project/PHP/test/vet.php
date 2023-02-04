<?php

//questions about what these things should return: PUT, POST, DELETE 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$api_index = 4;

// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

else{

$length = count($uri);
header('Content-Type: application/json; charset=utf-8');

   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET": //gets all vets
           if ($length - 1 - $api_index == 0)
           {
           $sql = "call getVetAll()";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                  $post_item = array (
                      'vet_ID' => $row['vet_ID'],
                      'f_name' => $row['f_name'],
                      'l_name' => $row['l_name'],
                      'type'   => $row['type'],
                      'username'   => $row['username'],
                      'password'   => $row['password'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 vet
           {
           $vet_ID = $uri[$api_index + 1];
           
           $sql = "CALL getVet($vet_ID)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $vet_ID = $row['SIN'];
           $post_item = array (
            'vet_ID' => $row['vet_ID'],
            'f_name' => $row['f_name'],
            'l_name' => $row['l_name'],
            'type'   => $row['type'],
            'username'   => $row['username'],
            'password'   => $row['password'],               
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST": 
           //put automatically generated info 
           echo json_encode ('In the post');
           $f_name = 'First';
           $l_name = 'Last';
           $username = 'VetUsername';
           $password = 'VetPassword';
           $type = 0;
           $sql = "CALL addVet('$f_name', '$l_name', $type, '$username', '$password')";
           $result = mysqli_query($con, $sql);
           break;
       
       case "PUT":
           // Takes raw data from the request
           $json = file_get_contents('php://input');
            // Converts it into a PHP object
            $info = json_decode($json, true);

            $vet_ID = $info['vet_ID'];
            $f_name = $info['f_name'];
            $l_name = $info['l_name'];
            $username = $info['username'];
            $password = $info['password'];

            $sql = "CALL updateVet($vet_ID, '$f_name', '$l_name', '$username', '$password')";
            $result = mysqli_query($con, $sql);

            header('Content-Type: application/json; charset=utf-8');           
            
           break;
       
       case "DELETE":
           $vet_ID = $uri[$api_index + 1];
           $sql = "CALL deleteVet($vet_ID)";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>

