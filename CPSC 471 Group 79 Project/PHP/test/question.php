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
       case "GET": //gets all questions for a client 
           if ($length - 1 - $api_index == 1)
           {
           $client_ID = $uri[$api_index + 1];
           $sql = "call getQuestions($client_ID)";
           $result = mysqli_query($con,$sql);
    
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
               $question_ID = $row['id'];
               $vet_ID = $row['vet_ID'];
               $answer = $row['answer'];
               if ($vet_ID == -1)
               {
                   $vet_ID = '---------';
                   $answer = 'Question Not Answered Yet';
                   $vet_fname = '---------';
                   $vet_lname = '---------';
               }
                else 
                { 
                mysqli_next_result($con);
                $sql = "call getAnsweredQuestion($client_ID, $question_ID)";
                $r = mysqli_query($con,$sql);
                $vet = mysqli_fetch_array($r);
                $vet_fname = $vet['f_name'];
                $vet_lname = $vet['l_name'];
                }
               
                  $post_item = array (
                      'question_ID' => $row['id'],
                      'question' => $row['question'],
                      'vet_ID' => $vet_ID,
                      'vet_fname' => $vet_fname,
                      'vet_lname' => $vet_lname,
                      'answer' => $answer,
                  );
                 array_push($post_arr['data'], $post_item);
                }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
         
           }  
           else //get 1 question
           {
           $client_ID   = $uri[$api_index + 1];
           $question_ID = $uri[$api_index + 2];
           
           $sql = "CALL getQuestion($client_ID, $question_ID)";
           $result = mysqli_query($con,$sql);
           $post_arr = array();
           $post_arr ['data'] = array();
           while($row = mysqli_fetch_array($result))
                {
               $question_ID = $row['id'];
               $vet_ID = $row['vet_ID'];
               $answer = $row['answer'];
               if ($vet_ID == -1)
               {
                   $vet_ID = '---------';
                   $answer = 'Question Not Answered Yet';
                   $vet_fname = '---------';
                   $vet_lname = '---------';
               }
                else 
                { 
                mysqli_next_result($con);
                $sql = "call getAnsweredQuestion($client_ID, $question_ID)";
                $r = mysqli_query($con,$sql);
                $vet = mysqli_fetch_array($r);
                $vet_fname = $vet['f_name'];
                $vet_lname = $vet['l_name'];
                }
               
                  $post_item = array (
                      'question_ID' => $row['id'],
                      'question' => $row['question'],
                      'vet_ID' => $vet_ID,
                      'vet_fname' => $vet_fname,
                      'vet_lname' => $vet_lname,
                      'answer' => $answer,
                  );
                 array_push($post_arr['data'], $post_item);
                }
            header('Content-Type: application/json; charset=utf-8');
             echo json_encode($post_item);
           }
           break;
           
       case "POST": 
           $client_ID = $uri[$api_index + 1];
           //put automatically generated info 
           $question = 'Post Method Test';
           $sql = "CALL addQuestion($client_ID, '$question')";
           $result = mysqli_query($con, $sql);
           break;
//       
//       case "PUT":
//            $client_ID   = $uri[$api_index + 1];
//            $question_ID = $uri[$api_index + 2];
//            $json = file_get_contents('php://input');
//            $info = json_decode($json, true);
//            $question = $info['question'];
//            $answer = $info['answer'];
//            $vet_ID = $info['vet_ID'];
//            mysqli_next_result($con);
//            $sql = "CALL updateQuestion($client_ID, $question_ID, '$question', '$answer', $vet_ID)";
//            echo $sql;
//            $result = mysqli_query($con, $sql);
//            header('Content-Type: application/json; charset=utf-8');         
//            break;
       
       case "DELETE":
           //test if this works 
           $client_ID   = $uri[$api_index + 1];
           $question_ID = $uri[$api_index + 2];
           $sql = "CALL deleteQuestion($client_ID, $question_ID)";
           $result = mysqli_query($con,$sql);
           break;       
       }
       mysqli_close($con);
}
      
?>

