<?php
$id = $_GET['id'];
$user = $_GET['user'];
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
            <li><a href="About.html">About</a></li>
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

echo '<br> Select a Date to See All Booked Appointments On This Date! <br>';
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

    // Create connection
    $con=mysqli_connect("localhost","root","alishalalani", "animalHospital");

    // Check connection
    if (mysqli_connect_errno($con))
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
  
    else
        {
        echo '<br>';
        $sql = "call getAppointments('$date')";
        //echo $sql.'<br>';
        $result = mysqli_query($con,$sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0)
            {
            echo "<table border='1'>
            <tr>
            <th>Time</th>
            <th>Appointment Type</th>
            <th>Client Name</th>
            <th>Client ID</th>
            <th>Pet Name</th>
            <th>Pet ID</th>
            </tr>";

            while ($row = mysqli_fetch_array($result))
                {
                $time = $row['time'];
                $type = "PM";
                 if ($time < 12)
                    {
                        $type = "AM";
                    }
                 else if ($time > 12)
                    {
                        $time = $time - 12;
                    }      

                echo "<tr>";
                echo "<td>" .$time . ":00 $type</td>";
                echo "<td>" . $row['appt_name'] . "</td>";
                echo "<td>" . $row['client_name'] . "</td>";
                echo "<td>" . $row['client_ID'] . "</td>";
                echo "<td>" . $row['pet_name'] . "</td>";
                echo "<td>" . $row['pet_ID'] . "</td>";
                echo "</tr>";            
                }
               echo' </table>';
               echo '<br>';
            }
        else
            {
            echo '<br> No Appointments On This Date<br>';
            }
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

