<?php
include_once 'DBConnector.php';
include_once 'user.php';

if (!isset($_POST['btn-login'])){
    $username = "";
    $password = "";
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }  
    
    $instance = User::create();
    $instance->setPassword($password);
    $instance->setUsername($username);


    if($instance->isPasswordCorrect()){
        $instance->login();
        $instance->createUserSession();
    }else{
        $header("Location:Login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="validate.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" name="login" id="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    
        <table style="align: center">
            <tr>
                <td><input type="text" name="username" placeholder="Username" required></td>
            </tr>
            <tr>
                <td><input type="text" name="username" placeholder="Username" required></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
            </tr>
        </table>
    </form>
</body>
</html>