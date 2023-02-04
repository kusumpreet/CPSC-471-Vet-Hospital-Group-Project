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
           $sql = "call getAllRecType()";
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
                      'type_ID'   => $row['type_ID'],
                      'username'   => $row['username'],
                      'password'   => $row['password'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           break;
       }
       mysqli_close($con);
}
      
?>



