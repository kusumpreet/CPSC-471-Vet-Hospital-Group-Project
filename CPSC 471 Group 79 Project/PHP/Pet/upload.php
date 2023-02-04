<?php
$id = $_GET['pet_ID'];
$client_ID = $_GET['client_ID'];
echo '<br> pet id: '.$id;
echo '<br> client id: '.$client_ID;
if (isset($_POST['submit']))
{
    $file          = $_FILES['file'];
    $fileName      = $_FILES['file']['name'];
    $fileTmpName   = $_FILES['file']['tmp_name'];
    $fileSize      = $_FILES['file']['size'];
    $fileError     = $_FILES['file']['error'];
    $fileType      = $_FILES['file']['type'];
    $fileExt       = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','png','jfif');
    
    if (in_array($fileActualExt, $allowed))
        {
        if ($fileError == 0)
            {
            if ($fileSize < 1000000)
                {
                $sql = "SELECT * from petprofileimg WHERE user_ID=$id";
                echo '<br>'.$sql;
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($result);
                $profile_img = $row['image'];
                //$profile_img = "uploads/pet$id.jpg";
                echo '<br> profile img: '.$profile_img;
                if (file_exists($profile_img))
                    {
                    if (unlink($profile_img))
                        {
                        echo '<br> file was deleted';
                        }
                    else
                        {
                        echo '<br> error in deleting file';
                        }
                    }
                
                $fileNameNew = "pet" .$id.".". $fileActualExt;
                $fileDestination = '../Client/uploads/' . $fileNameNew;
                echo '<br> file destination: '.$fileDestination;
                move_uploaded_file($fileTmpName, $fileDestination);
                mysqli_next_result($con);
                $sql = "DELETE FROM petprofileimg WHERE user_ID=$id";
                echo '<br>'.$sql;
                mysqli_query($con, $sql);
                mysqli_next_result($con);
                $sql = "call addPetImg ($id,'$fileDestination')";
                echo '<br>'.$sql;
                
                $sql_return = mysqli_query($con, $sql);
                echo '<br> return: ('. mysqli_error($con).')';
                //$sql = "UPDATE profileimg SET status=0 WHERE user_ID=$id";
                //$result = mysqli_query($con, $sql);
                header("Location: updatePet.php?pet_ID=$id&owner_ID=$client_ID");
                }
            else
                {
                echo "Your file is too big!";
                }
            }
        else
            {
            echo "There was an error uploading your file!";
            }
            
        }
    else
        {
        echo "You cannot upload files of this type!";
        }
}
?>


