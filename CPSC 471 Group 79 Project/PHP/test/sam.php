<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
?>

<html>
    <body>
<?php
   for ($i = 0; $i < count($uri); $i++)
   {
   echo '<p>'.$i. '&nbsp;'.$uri[$i].'</p>';
   }
   
   switch ($_SERVER['REQUEST_METHOD'])
   {
       case "GET":
           echo 'In the get';
           break;
       case "POST":
           echo 'In the post';
           break;
       case "PUT":
           echo 'In the put';
           break;
       case "DELETE":
           echo 'In the delete';
           break;       
   }
      
?>
    </body>
</html>