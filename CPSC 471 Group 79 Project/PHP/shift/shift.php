<html>
    <head>
    <link rel ="stylesheet" href="calendar.css">
    <script src="calendar.js">
        
    </script>
    </head>    
    <body>
        <div id = "calendar_div"> </div>
        <div id = "main"> 

<?php
$date = $_GET['date'];
$id = $_GET['id'];
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$index = strpos($current_url, '?');
echo '<a href="../admin/getAdmin.php?id=1">Go Back to My Profile</a> <br>';
echo '<br> <a href="../main/login.php">Logout</a> <br>';
echo '<br>';
echo 'Select a Date to Add a Shift <br>';
echo '<br>';

//echo "index: ($index)";
if ($index > 0)
    {
    $current_url = substr($current_url, 0, $index);
    }
//echo "current url is: ($current_url)";

if (isset ($date))
    {
    echo 'The date selected is: (' .$date.') <br>';
    echo 'Shift start time: 8:00am <br>';
    echo 'Shift end time: 5:00pm <br>';
    // Create connection
    $con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
  
    else
        {

        echo "<form method=post name=selectTime action='addShift.php?id=$id'>";
        echo '<table border="0" cellspacing="0" > <tr> <td>';
        echo '<br>';
        
        echo 'Select a Vet <br>';
        echo'<select id="vet" name="vet">';
        $result = mysqli_query($con,"SELECT * From vet where type=0");

        while ($row = mysqli_fetch_array($result))
          {
          $fname = $row['f_name'];
          $lname = $row['l_name'];
          $vet_ID = $row['vet_ID'];
          echo "<option value='$vet_ID'> $fname $lname</option>";
          }
        echo '</select> </td> </tr> <tr> <td>';
        
        echo '<br>';
        echo 'Select a Receptionist <br>';
        echo'<select id="rec" name="rec">';
        $result = mysqli_query($con,"SELECT * From vet WHERE type=1");

        while ($row = mysqli_fetch_array($result))
          {
          $fname = $row['f_name'];
          $lname = $row['l_name'];
          $rec_ID = $row['vet_ID'];
          echo "<option value='$rec_ID'> $fname $lname</option>";
          }
        echo '</select> </td> </tr> <tr> <td>';

        echo "<input type=hidden value=$date    id='date' name='date'>";
//        echo "<input type=hidden value=$vet_ID  id='vet' name='vet'>";
//        echo "<input type=hidden value=$rec_ID  id='rec' name='rec'>";
        echo '<input type=submit value=Submit>';
        echo '</form>';
        }
        
    }
    
?>
</div>

<script>
   var calendar = new Calendar ('<?php echo $current_url;?>',<?php echo $id; ?>,'admin');
   calendar.display();
    </script>
    </body>
</html>
