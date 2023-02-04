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

$date = $_GET['d'];

   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET": //gets all upcoming appointments on a date 
           if (isset($date))
           {
           $sql = "call getAppointmentt('$date')";
           echo $sql;
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {

                  $time = $row['time'];
   
                 $type = "PM";
                 if ($time < 12)
                 {
                     $type = "AM";
                 }
                 else if ($time > 12)
                 {
                     $time = $time - 12;
                 }   
                $time = $time . ":00 $type";
               
                  $post_item = array (
                      'date' => $date,
                      'time' => $time,
                      'appointment_name' => $row['appointment_name'],
                      'pet_ID' => $row['pet_ID'],
                      'pet_name' => $row['pet_name'],
                      'client_ID' => $row['client_ID'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get all upcoming appointments for a client 
           {
           $client_ID = $uri[$api_index + 1];
           $sql = "CALL getAppt($client_ID)";
           //echo $sql;
           $result = mysqli_query($con,$sql);
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {

                  $time = $row['time'];
   
                 $type = "PM";
                 if ($time < 12)
                 {
                     $type = "AM";
                 }
                 else if ($time > 12)
                 {
                     $time = $time - 12;
                 }   
                $time = $time . ":00 $type";
               
                  $post_item = array (
                      'date' => $row['date'],
                      'time' => $time,
                      'appointment_name' => $row['appointment_name'],
                      'pet_ID' => $row['pet_ID'],
                      'pet_name' => $row['pet_name'],
                      'client_ID' => $row['client_ID'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
  
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($post_arr);
           }
           break;
           
       case "POST":
           //put automatically generated info 
           $client_ID = $uri[$api_index + 1];
           $pet_ID = $uri[$api_index + 2];
           $date = '2022-01-23';
           $time = 8;
           $v_ID = 2;
           $apType = 1;
           
           $sql = "call addAppt($client_ID, $pet_ID, '$date', $time, $apType, $v_ID)";
           $result = mysqli_query($con,$sql);
           
           break;
       case "PUT":
            $client_ID = $uri[$api_index + 1];
            $pet_ID = $uri[$api_index + 2];
       
            // Takes raw data from the request
            $json = file_get_contents('php://input');
            // Converts it into a PHP object
            $info = json_decode($json, true);
            //$info = (array) $data;
            //echo "the PUT json for client $client_ID is: ($json)";
            var_dump ($info);
//            echo 'the data name is: ('.$data['name'].')';
           // echo 'the name is: ('.$info['name'].')';
            //change this to a stored procedure
            $sql = "update pet set name='".$info['name']. "' where owner_id='$client_ID' and id = '$pet_ID'";
            //echo '('.$sql.')';
            $result = mysqli_query($con, $sql);
                    
            
           break;
       
       case "DELETE":
           $client_ID = $uri[$api_index + 1];
           $pet_ID = $uri[$api_index + 2];
           $time = $_GET['t'];
           $sql = "CALL deleteAppt($client_ID, $pet_ID,'$date',$time)";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>

