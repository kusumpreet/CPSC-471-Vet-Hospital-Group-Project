<?php 
$vet_ID = $_GET['vet_ID'];
$pet_ID = $_GET['pet_ID'];
$client_ID = $_GET['client_ID'];
?>

<form action="../pet/viewPet.php?job=update&vet_ID=<?php echo $vet_ID;?>" method="post">
   <input name="vet_ID" type="hidden" value=<?php echo $vet_ID;?>>
   <input name="pet_ID" type="hidden" value=<?php echo $pet_ID;?>>
   <input name="client_ID" type="hidden" value=<?php echo $client_ID;?>>
   Description: <textarea name="description" rows="5" cols="50" value=""></textarea><br>
   <input type="submit" value="Update">
</form>
