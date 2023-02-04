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

$date = $_GET['d'];
$start_time = "8:00am";
$end_time = "5:00pm";

   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET": //gets all vets
           if (isset($date))
           {
           $sql = "call getShiftAll('$date')";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           
           while($row = mysqli_fetch_array($result))
                {
                  $post_item = array (
                      'date' => $row['date'],
                      'start_time' => $start_time,
                      'end_time' => $end_time,
                      'vet_ID'   => $row['vet_ID'],
                      'vf_name'   => $row['vf_name'],
                      'vl_name'   => $row['vl_name'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
           }  
           
           else //get upcoming Employee shift 
           {
           $vet_ID = $uri[$api_index + 1];
           
           $sql = "CALL getShiftVet($vet_ID)";
           $result = mysqli_query($con,$sql);
           $post_arr = array();
           $post_arr ['data'] = array();
           
           while($row = mysqli_fetch_array($result))
           {
           
           $post_item = array (
            'date' => $row['date'],
            'start_time' => $start_time,
            'end_time' => $end_time,
            'vet_ID'   => $row['vet_ID'],
            'vf_name'   => $row['vf_name'],
            'vl_name'   => $row['vl_name'],             
            );
           array_push($post_arr['data'], $post_item);
           }
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_arr);
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
       
       case "DELETE":
           $vet_ID = $uri[$api_index + 1];
           $sql = "CALL deleteShiftVet($vet_ID,'$date')";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>


