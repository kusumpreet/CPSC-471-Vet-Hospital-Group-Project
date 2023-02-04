<?php
$id = $_GET['id'];

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

    $allowed = array('jpg');
    
    if (in_array($fileActualExt, $allowed))
        {
        if ($fileError == 0)
            {
            if ($fileSize < 1000000)
                {
                $profile_img = "uploads/client$id.jpg";
                echo '<br> profile img: '.$profile_img;
                if (file_exists($profile_img))
                    {
                    if (unlink($profile_img))
                        {
                        echo 'file was deleted';
                        }
                    else
                        {
                        echo 'error in deleting file';
                        }
                    
                    }
                
                $fileNameNew = "client" .$id.".". $fileActualExt;
                $fileDestination = 'uploads/' . $fileNameNew;
                echo '<br> file destination: '.$fileDestination;
                move_uploaded_file($fileTmpName, $fileDestination);
                //$sql = "UPDATE profileimg SET status=0 WHERE user_ID=$id";
                //$result = mysqli_query($con, $sql);
                header("Location: updateClient.php?id=$id");
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

