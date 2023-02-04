
<?Php
$client_ID = $_GET['id'];
$month = $_POST['month'];
$day   = $_POST['day'];
$year  = $_POST['year'];

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

    $date = $year.'-'.
            ($month < 10 ? '0'.$month : $month).'-'.
            ($day < 10 ? '0'.$day : $day);
    
    echo "Date Selected: $date <br>";
    echo '<br>';
    
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
  
  echo "<input type=hidden value=$month  id='month' name='month'>";
  echo "<input type=hidden value=$day  id='month' name='day'>";
  echo "<input type=hidden value=$year  id='month' name='year'>";
  echo '<input type=submit value=Submit>';
  echo '</form>';
   }
   
   }


?> 









