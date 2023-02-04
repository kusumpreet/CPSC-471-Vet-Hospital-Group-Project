<?php
$id = $_GET['client_ID'];
$client_ID = $id;
$START_TIME = 8;
$END_TIME = 17;
$HOURS_OPEN = $END_TIME - $START_TIME;


// Create connection
$con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

else
    {
echo '<br> <br> <br> <br> <br> <br>Book An Appointment';
mysqli_next_result($con);
$sql = "SELECT * FROM client WHERE id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$user = $row['username'];
//echo 'test';
//echo '<br>username: '.$user;

?>
<html>
    <head>
    <link rel ="stylesheet" href="calendar.css">
    <link rel ="stylesheet" href="login.css">
    <script src="calendar.js?<?php echo rand();?>">
        var page_id = <?php echo $id;?>;
        var page_user = '<?php echo $user;?>';
    </script>
    </head>    
    <body>

    <nav class="nav">
        <div class="logo">
            <h4><a href="Home.html">Norman Hospital</a></h4>
        </div>
        <ul class="nav-links">
            <li><a href="../main/login.php">Logout</a></li>
            <li><a href="../user/check.php?id=<?php echo $id;?>&user=<?php echo $user;?>">Go Back to My Profile</a></li>
        </ul>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        
    </nav>
        <p> <p> <p> 
        <div style="width:90%;text-align:center;">
            <div id = "calendar_div" style="margin-left:35px;"> </div>
        </div>
            <div id = "main"> 
<?php


$date = $_GET['date'];
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$index = strpos($current_url, '?');

if ($index > 0)
    {
    $current_url = substr($current_url, 0, $index);
    }

if (isset ($date))
    {
    echo '<br> The date selected is: (' .$date.') <br>';

    mysqli_next_result($con);
    $sql = "SELECT time From appointment WHERE date = '$date'";
    $result = mysqli_query($con, $sql);
    
    for ($i = $START_TIME; $i < $END_TIME; $i++)
    {
        $available[$i] = true;
    }
    
    $totalAppointments = 0;
    
    while ($row = mysqli_fetch_array($result))
    {
        $available [$row['time']] = false;
        $totalAppointments++;
    }
  
  if ($totalAppointments >= $HOURS_OPEN)
  {
      echo 'No available appointments on this date';
  }
  else
  {
    echo "<form method=post name=selectTime action='addAppt.php?client_ID=$client_ID'>";

    echo '<table border="0" cellspacing="0" > <tr> <td>';
    echo 'Available Times <br>';
    echo'<select id="hours" name="times">Select Time';


    for ($i = $START_TIME; $i < $END_TIME; $i++)
    {
        if ($available[$i])
        {
            $j = $i;
            $type = 'PM';
            if ($i < 12)
            {
                $type = 'AM';
            }
            else if ($i > 12)
              {
                $j = $i - 12;
              }

        echo "<option value='$i'>$j:00 $type</option>";
        }
    }
    echo '</select> </td> </tr> <tr> <td>';

    echo 'Select a Pet <br>';
    echo'<select id="pets" name="petSelect">';
     $result = mysqli_query($con,"SELECT * From pet WHERE owner_ID=$client_ID");

    while ($row = mysqli_fetch_array($result))
      {
      $name = $row['name'];
      $pet_ID = $row['id'];
      echo "<option value='$pet_ID'> $name </option>";
      }
    echo '</select> </td> </tr> <tr> <td>';


    echo 'Select an Appointment Type <br>';
    echo'<select id="appointments" name="appSelect">';
    $result = mysqli_query($con,"SELECT * From appType");
    while ($row = mysqli_fetch_array($result))
      {
      $app_name = $row['name'];
      $app_ID = $row['id'];
      echo "<option value='$app_ID'> $app_name </option>";
      }

      echo '</select> </td> </tr> <tr> <td>';

    echo "<input type=hidden value=$date  id='date' name='date'>";
    echo '<input type=submit value=Submit>';
    echo '</form>';
     }

        }
    else
    {
        echo '<br> Select a Date to Book an Appointment! <br>';
    }
        
    }


?>
</div>

<script>
   var calendar = new Calendar ('<?php echo $current_url;?>',<?php echo $id;?>,'<?php echo $user;?>');
   calendar.display();
    </script>
    </body>
</html>

