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
       case "GET": //gets all clients 
           if ($length - 1 - $api_index == 0)
           {
           $sql = "call getClientAll";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {

                  $post_item = array (
                      'id' => $row['id'],
                      'name' => $row['name'],
                      'username' => $row['username'],
                      'password' => $row['password'],
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 client
           {
           $id = $uri[$api_index + 1];
           
           $sql = "CALL getClient($id)";
           $result = mysqli_query($con,$sql);
           $row = mysqli_fetch_array($result);
           $client_ID = $row['id'];
           $post_item = array (
            'id' => $row['id'],
            'name' => $row['name'],
            'username' => $row['username'],
            'password' => $row['password'],
            );
  
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST": 
           //put automatically generated info 
           echo json_encode ('In the post');
           $name = 'Post Method Test';
           $username = 'username';
           $password = 'password';
           $sql = "CALL addClient('$name','$username','$password')";
           $result = mysqli_query($con, $sql);
           break;
       
       case "PUT":
           // Takes raw data from the request
            $json = file_get_contents('php://input');
            // Converts it into a PHP object
            $info = json_decode($json, true);
            $id = $info['id'];
            $name = $info['name'];
            $username = $info['username'];
            $password = $info['password'];
            //change this to a stored procedure
            $sql = "CALL updateClient($id, '$name', '$username', '$password')";
            $result = mysqli_query($con, $sql);

            header('Content-Type: application/json; charset=utf-8');         
            break;
       
       case "DELETE":
           //test if this works 
           $id = $uri[$api_index + 1];
           $sql = "CALL deleteClient($id)";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>
