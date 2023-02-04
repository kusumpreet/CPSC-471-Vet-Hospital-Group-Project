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
           if ($length - 1 - $api_index == 1)
           {
           $client_ID = $uri[$api_index + 1];
           $sql = "call getCartw($client_ID)";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
                  $price = $row['price'];
                  $quantity = $row['quantity'];
                  $total = $price * $quantity;
                  $post_item = array (
                      'item_ID' => $row['item_ID'],
                      'item_name' => $row['name'],
                      'quantity' => $row['quantity'],  
                      'price' => $row['price'],
                      'times_purchased' => $row['times_purchased'],
                      'image' => $row['image'],
                      'category' => $row['category_name'],
                      'category_ID' => $row['category_ID'],
                      'price/quantity' => $total,
                      
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 item in a person's cart 
           {
           $client_ID = $uri[$api_index + 1];
           $item_ID = $uri[$api_index + 2];
           $sql = "CALL getCart($client_ID, $item_ID)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);

            $price = $row['price'];
            $quantity = $row['quantity'];
            $total = $price * $quantity;
            $post_item = array (
                'item_ID' => $row['item_ID'],
                'item_name' => $row['name'],
                'quantity' => $row['quantity'],  
                'price' => $row['price'],
                'times_purchased' => $row['times_purchased'],
                'image' => $row['image'],
                'category' => $row['category_name'],
                'category_ID' => $row['category_ID'],
                'price/quantity' => $total,
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST": 
            $client_ID = $uri[$api_index + 1];
            $item_ID   = $uri[$api_index + 2];
            $sql = "call getQuantity ($client_ID,$item_ID)";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $num_rows = mysqli_num_rows($result);
            mysqli_next_result($con);
            if ($num_rows == 0) 
                {
                $quantity = 1;
                $sql = "call addToCart($client_ID, $item_ID, $quantity)";
                } 
            else 
                {
                $quantity = $row['quantity'] + 1;
                $sql = "call updateCart($client_ID, $item_ID, $quantity)";
                }
            echo $sql;
            $result = mysqli_query($con,$sql);
           break;
           
        case "PUT": 
            $client_ID = $uri[$api_index + 1];
            $item_ID   = $uri[$api_index + 2];
            $json = file_get_contents('php://input');
            // Converts it into a PHP object
            $info            = json_decode($json, true);
            $quantity        = $info['quantity'];
            $sql             = "CALL updateCart($client_ID, $item_ID, $quantity)";
            $result = mysqli_query($con, $sql);            
            break;
       
       //CART SHOULD NOT HAVE AN UPDATE
       case "DELETE":
           if ($length - 1 - $api_index == 1)
           {
           //Delete all items in cart associated with a specific client ID
           echo 'in Delete';
           $client_ID = $uri[$api_index + 1];
           $sql = "CALL deleteCart($client_ID)";
           $result = mysqli_query($con,$sql);
           break;  
           }
           else if ($length - 1 - $api_index == 2)//delete one item in cart 
           {
           $client_ID = $uri[$api_index + 1];
           $item_ID   = $uri[$api_index + 2];
           $sql       = "CALL deleteCartItem($client_ID,$item_ID)";
           $result    = mysqli_query($con,$sql);               
           }
       }
       mysqli_close($con);
}
?>



