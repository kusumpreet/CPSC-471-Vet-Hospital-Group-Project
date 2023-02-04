<?php
$ques_ID = $_GET['ques_ID'];
$vet_ID = $_GET['vet_ID'];
$answer = $_POST['answer'];

    // Create connection
    //echo 'before connection <br/>';
    $con = mysqli_connect("localhost","root","alishalalani", "animalHospital");

    // Check connection
    //echo 'check connection <br/>';
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    else
    {
    if (isset($answer))
        {
        $sql = "UPDATE question SET vet_ID=$vet_ID, answer='$answer' WHERE id=$ques_ID";
        //echo '<br> '.$sql;
        $result = mysqli_query($con,$sql);
        $url= "refresh:0; url=../Employee/getEmployee.php?id=$vet_ID";
        echo '<br> '.$url;
        header($url);
        }
    }

?> 

<form action="updateQuestion.php?job=update&ques_ID=<?php echo $ques_ID;?>&vet_ID=<?php echo $vet_ID;?>" method="post">
   Answer: <input type="text" name="answer" value="";?><br>
   <input type="submit" value="Update">
</form>

