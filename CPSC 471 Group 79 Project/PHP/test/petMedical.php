<?php

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
       case "GET": //gets all medical history additions for a pet  
           if ($length - 1 - $api_index == 2)
           {
           $client_ID = $uri[$api_index + 1];
           $pet_ID    = $uri[$api_index + 2];
           $sql = "SELECT * From petMedical where client_id=$client_ID and pet_ID=$pet_ID";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                  $post_item = array (
                      'client_ID' => $row['client_ID'],
                      'pet_ID' => $row['pet_ID'],
                      'description' => $row['description'],
                      'date' => $row['date'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
 
           else //get medical history for 1 pet for a client
           {
           $client_ID = $uri[$api_index + 1];
           $pet_ID = $uri[$api_index + 2];
           $sql = "CALL getPetMedical($client_ID, $pet_ID)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $client_ID = $row['id'];
           $post_item = array (
                      'client_ID' => $row['client_ID'],
                      'pet_ID' => $row['pet_ID'],
                      'day' => $row['day'],
                      'month' => $row['month'],
                      'year' => $row['year'],
                      'description' => $row['description'],
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST":
            $client_ID = $uri[$api_index + 1];
            $pet_ID = $uri[$api_index + 2];
            $description = 'Postman Method Test';
            $sql = "call addPetMedical($client_ID, $pet_ID, '$description')";
            $result = mysqli_query($con,$sql);
            echo $sql;
           //echo json_encode ('In the post');
           break;
         
       }
       mysqli_close($con);
}
?>


