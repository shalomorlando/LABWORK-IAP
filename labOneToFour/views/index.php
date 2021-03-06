<?php
include_once '../classes/user.php';
include_once '../classes/fileUploader.php';

if(isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $utc_timestamp = $_POST['utc_timestamp'];
    $timezone = $_POST['time_zone_offset'];
    $imageData = $_FILES['fileToUpload'];

    
    $user = User::create()->createNewUser($first_name, $last_name, $city, $username, $password, $imageData['name'], $utc_timestamp, $timezone);
    $fileUploader = new FileUploader();

    $fileUploader->setOriginalName($imageData['tmp_name']);
    $fileUploader->setFinalFileName($imageData['name']);
    $fileUploader->setFileType($imageData['type']);
    $fileUploader->setFileSize($imageData['size']);

    if(!$user->validateForm()){
        $user->createFormErrorSessions();   
        header("Refresh:0");
        die(); 
    }
    elseif(!$user->isUserExist()){
        $user->createUserNameAlreadyExistsError();  
        $delay = '8'; 
        header("Refresh: $delay");
        die(" Try using a different User name");  
    }
    else{

        $isUploadOk = $fileUploader->uploadFile();

        if($isUploadOk){
            $res = $user->save();
            if($res){
                echo "added record successfully";
            } else {
                echo "added nothing";
            }
        } else {
            echo "upload failed nothing added to db";
        }
      
    } 
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAB 1</title>
    <script type="text/javascript" src="../scripts/validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script type="text/javascript" src="../scripts/timezone.js"></script>


    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <form method="post" name="user_details" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
        <table style = "align:center">
            <tr>
                <td>
                    <div id="form-errors">
                        <?php
                            
                            if(!empty($_SESSION['form_errors'])){
                                echo " ".$_SESSION['form_errors'];
                                unset($_SESSION['form_errors']);
                            }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name = "first_name" placeholder = "First Name" >
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name = "last_name" placeholder = "Last Name">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name = "city_name" placeholder = "City">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name = "username" placeholder = "Username">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name = "password" placeholder = "Password">
                </td>
            </tr>
            <tr>
                <td>
                    Profile Image:
                    <input type="file" name = "fileToUpload"  id= "fileToUpload">
                </td>
            </tr>
            <!--Create hidden form controls to store client utc_date and time_zone-->
            <input type = "hidden" name="utc_timestamp" id = "utc_timestamp" value = "" />
            <input type = "hidden" name = "time_zone_offset" id = "time_zone_offset" value = "" />

            <tr>
                <td>
                    <button type = "submit" name = "btn-save">
                        <strong>SAVE</strong>
                    </button>
                </td>
            </tr>
            <tr>
                <td><a href="login.php">Login</a></td>
            </tr>
        </table>
    </form>
</body>
</html>