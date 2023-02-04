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

echo '<br> Select a Date to See who is working! <br>';
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
        $sql = "call getWorkers('$date')";
        //echo $sql.'<br>';
        $result = mysqli_query($con,$sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0)
            {
            echo "<table border='1'>
            <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            </tr>";

            while ($row = mysqli_fetch_array($result))
                {
                $start_time = $row['start_time'];
                $start_type = "PM";
                 if ($start_time < 12)
                    {
                        $start_type = "AM";
                    }
                 else if ($start_time > 12)
                    {
                        $start_time = $start_time - 12;
                    }      

                 $end_time = $row['end_time'];
                 $end_type = "PM";
                 if ($end_time < 12)
                    {
                        $end_type = "AM";
                    }
                 else if ($end_time > 12)
                    {
                        $end_time = $end_time - 12;
                    }   

                echo "<tr>";
                echo "<td>" . $row['f_name'] . "</td>";
                echo "<td>" . $row['l_name'] . "</td>";
                echo "<td>" .$start_time . ":00 $start_type</td>";
                echo "<td>" .$end_time . ":00 $end_type</td>";
                echo "</tr>";            
                }
               echo' </table>';
               echo '<br>';
            }
        else
            {
            echo '<br> No one is working on this date currently <br>';
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
