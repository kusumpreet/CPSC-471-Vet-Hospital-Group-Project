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
       case "GET": //gets all pets for a client 
           if ($length - 1 - $api_index == 0)
           {
           $sql = "SELECT * From pet";
           $result = mysqli_query($con,$sql); 
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {

                  $post_item = array (
                      'id' => $row['id'],
                      'name' => $row['name'],
                      'type' => $row['type'],
                      'weight' => $row['weight'],
                      'color' => $row['color'],
                      'owner_ID' => $row['owner_id'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);           
           }
           else if ($length - 1 - $api_index == 1)
           {
           $client_ID = $uri[$api_index + 1];
           $sql = "call getPetForClient($client_ID)";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {

                  $post_item = array (
                      'id' => $row['id'],
                      'name' => $row['name'],
                      'type' => $row['type'],
                      'weight' => $row['weight'],
                      'color' => $row['color'],
                      'owner_ID' => $row['owner_id'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 pet
           {
           $client_ID = $uri[$api_index + 1];
           $pet_ID = $uri[$api_index + 2];
           $sql = "CALL getPet($client_ID, $pet_ID)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $client_ID = $row['id'];
           $post_item = array (
            'id' => $row['id'],
            'name' => $row['name'],
            'type' => $row['type'],
            'weight' => $row['weight'],
            'color' => $row['color'],
            'owner_ID' => $row['owner_id'],
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST":
           //put automatically generated info 
           echo json_encode ('In the post');
           $owner_ID = $uri[$api_index + 1];
           $name = 'Post Method Test';
           $type = 'Dog';
           $weight = '10';
           $color = 'Blue';
           $sql = "CALL addPet('$name','$type', $weight, '$color',$owner_ID)";
           $result = mysqli_query($con, $sql);
           break;
       
       case "PUT":
            $client_ID = $uri[$api_index + 1];
            $pet_ID = $uri[$api_index + 2];
            // Takes raw data from the request
            $json = file_get_contents('php://input');
            // Converts it into a PHP object
            $info = json_decode($json, true);
            $name = $info['name'];
            $weight = $info['weight'];
            $type = $info['type'];
            $color = $info['color'];
            $sql = "call updatePet($pet_ID, $client_ID, '$name', '$type', $weight, '$color')";
            $result = mysqli_query($con, $sql);
            break;
       
       case "DELETE":
           $client_ID = $uri[$api_index + 1];
           $pet_ID = $uri[$api_index + 2];
           $sql = "CALL deletePet($client_ID, $pet_ID)";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>

