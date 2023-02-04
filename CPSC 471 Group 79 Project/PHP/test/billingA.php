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

else
{

$length = count($uri);
header('Content-Type: application/json; charset=utf-8');
//echo "length=$length";
   $date = $_GET['d'];
   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET": //get all billing history for a client 
           $date = $_GET['d'];
           //if ($length - 1 - $api_index == 1)
           if (!isset ($date))
           {
           $client_ID = $uri[$api_index + 1];
           $sql = "call getAllBillingA($client_ID)";
           //echo $sql;
           $result = mysqli_query($con,$sql);

           
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                          $time = $row['time'];
           
            $pet_ID = $row['pet_ID'];
            $r = mysqli_query($con,"call getPet($client_ID,$pet_ID)");
            $rr = mysqli_fetch_array($r);
            $pet_name = $rr['name'];
            $apType = $row['appType'];
            $s = mysqli_query($con,"call getAppType($apType)");
            $ss = mysqli_fetch_array($s);

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
            $app_name = $ss['name'];
               
                  $post_item = array (
                      'pet_ID' => $pet_ID,
                      'pet_name'=> $row['pet_name'],
                      'appType' => $row['appt_name'],
                      'date' => $row['date'], 
                      'time'=> $time,
                      'cost' => $row['cost'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 specific billing history 
           {
           $client_ID = $uri[$api_index + 1];
           $pet_ID = $uri[$api_index + 2];
           $time = $_GET['t'];
           $sql = "CALL getBillingA($client_ID, '$date', $time)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $client_ID = $row['id'];
           
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
                      'pet_ID' => $row['pet_ID'],
                      'pet_name'=> $row['pet_name'],
                      'appType' => $row['appt_name'],
                      'date' => $row['date'], 
                      'time'=> $time,
                      'cost' => $row['cost'],
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST":
           //put automatically generated info 
           echo json_encode ('In the post');
           $client_ID   = $uri[$api_index + 1];
           $pet_ID      = 4;
           $appType     = 1;
           $date        = "2022-01-30";
           $time = 8;
           
           $sql = "call addBillingA($client_ID,$pet_ID, '$date', $time, $appType)";
           $result = mysqli_query($con,$sql);
           break;
       
       case "DELETE":
//           http://localhost/petstore/PHP/test/billing.php/2?t="2021-12-24 07:06:31"
           echo 'in Delete';
           $client_ID   = $uri[$api_index + 1];
           $pet_ID      = $uri[$api_index + 2];
           $time = $_GET['t'];
           $sql = "CALL deleteBillingAA($client_ID, '$date', $time)";
           echo $sql;
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>



