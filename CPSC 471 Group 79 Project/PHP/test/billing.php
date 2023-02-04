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
   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET": //get all billing history for a client 
           $timeStamp = $_GET['t'];
           //if ($length - 1 - $api_index == 1)
           if (!isset ($timeStamp))
           {
           $client_ID = $uri[$api_index + 1];
           $sql = "call getAllBilling($client_ID)";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                  $post_item = array (
                      'cost' => $row['cost'],
                      'name' => $row['name'],
                      'timeStamp' => $row['timeStamp'], 
                      'quantity'=> $row['quantity'],
                      'itemPrice' => $row['itemPrice'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 specific billing history 
           {
           $client_ID = $uri[$api_index + 1];
           //$timeStamp = $uri[$api_index + 2];
           $sql = "CALL getBilling($client_ID, $timeStamp)";
           //echo $sql;
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $client_ID = $row['id'];
           $post_item = array (
                'cost' => $row['cost'],
                'name' => $row['name'],
                'timeStamp' => $row['timeStamp'], 
                'quantity'=> $row['quantity'],
                'itemPrice' => $row['itemPrice'],
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST":
           //put automatically generated info 
           echo json_encode ('In the post');
           $client_ID   = $uri[$api_index + 1];
           $name = "Post Method Test";
           $quantity = 1;
           $cost = 10;
           $itemPrice = 10;
           
           $sql = "call addBilling($client_ID,'$name',$quantity,$cost,$itemPrice)";
           $result = mysqli_query($con,$sql);
           break;
       
       case "DELETE":
//           http://localhost/petstore/PHP/test/billing.php/2?t="2021-12-24 07:06:31"
           echo 'in Delete';
           $client_ID   = $uri[$api_index + 1];
           $timeStamp = $_GET['t'];
           $sql = "CALL deleteBilling($client_ID, $timeStamp)";
           echo $sql;
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>


