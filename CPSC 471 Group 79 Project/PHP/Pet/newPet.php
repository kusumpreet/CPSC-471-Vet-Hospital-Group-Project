<html>
    <body>
        <form action="../Pet/addPet.php?id=<?php $owner_ID=$_GET['id'];echo $owner_ID;?>" method="post">
       Name: <input type="text" name="name"><br>
       Type: <input type="text" name="type"><br>
       Weight (lbs): <input type="text" name="weight"><br>
       Color: <input type="text" name="color"><br>
       <input type="submit" value="add">
    </form>
     
    </body>
    </html>