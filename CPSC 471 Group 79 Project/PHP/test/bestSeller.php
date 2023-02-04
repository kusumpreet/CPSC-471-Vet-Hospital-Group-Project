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
       case "GET": //get all items in a client's cart 
           if ($length - 1 - $api_index == 0)
           {
           $sql = "call getBestSeller(5)";
           $result = mysqli_query($con,$sql);
           echo $sql;
           
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                  $post_item = array (
                      'item_name' => $row['name'],
                      'price' => $row['price'],
                      'image' => $row['image'],
                      'category' => $row['category'],
                      'times_purchased' => $row['times_purchased'],
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




