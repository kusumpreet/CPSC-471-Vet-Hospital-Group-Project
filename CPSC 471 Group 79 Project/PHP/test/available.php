<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$api_index = 4;
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

else{

$length = count($uri);
header('Content-Type: application/json; charset=utf-8');
$date = $_GET['d'];
   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET": //get all items 
           if (isset($date))
           {
            $sql = "call getAppointmentt('$date')";
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

           $post_arr = array();
           $post_arr ['data'] = array();
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

                $time = $j.':00'. $type;
                $post_item = array (
                      'time' => $time
                  );
                 array_push($post_arr['data'], $post_item);
                }
            }
              header('Content-Type: application/json; charset=utf-8');
              echo json_encode($post_arr);
          }
           } 
           break;
       }
       mysqli_close($con);
}
      
?>



