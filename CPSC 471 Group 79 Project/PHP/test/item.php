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
       case "GET": //get all items 
           if ($length - 1 - $api_index == 0)
           {
           $sql = "call getItemAll()";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                  $post_item = array (
                      'id' => $row['id'],
                      'name' => $row['item_name'],
                      'price' => $row['price'],   
                      'category' => $row['category'],
                      'image' => $row['image'],
                      'times_purchased' => $row['times_purchased'], 
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           } 
           
           else //get 1 item
           {
           $id = $uri[$api_index + 1];
           $sql = "call getItem($id)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $client_ID = $row['id'];
           $post_item = array (
                'id' => $row['id'],
                'name' => $row['item_name'],
                'price' => $row['price'],   
                'category' => $row['category'],
                'image' => $row['image'],
                'times_purchased' => $row['times_purchased'], 
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST":
           //put automatically generated info 
           echo json_encode ('In the post');
           $name = "Post Method test";
           $price = 100;
           $image = "fakeurl.com";
           $times_purchased = 0;
           $category = 1;
           
           $sql = "call addItem('$name',$price,'$image',$times_purchased, $category)";
           echo $sql;
           $result = mysqli_query($con, $sql); 
           
           break;
       case "PUT":
            $id = $uri[$api_index + 1];
       
            // Takes raw data from the request
            $json = file_get_contents('php://input');
            // Converts it into a PHP object
            $info            = json_decode($json, true);
            $name            = $info['name'];
            $price           = $info['price'];
            $image           = $info['image'];
            $times_purchased = $info['times_purchased'];
            $sql             = "CALL updateItem($id, '$name', '$price', '$image', $times_purchased)";
           // echo '('.$sql.')';
            $result = mysqli_query($con, $sql);           
            
           break;
       
       case "DELETE":
           //test if this works 
           echo 'in Delete';
           $id = $uri[$api_index + 1];
           $sql = "CALL deleteItem($id)";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>



