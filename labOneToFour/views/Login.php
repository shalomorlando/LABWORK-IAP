<?php
    include_once '../classes/user.php';

    if(isset($_POST['btn-login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = User::create()->setPassword($password)->setUsername($username);

        if($instance->isPasswordCorrect()){
            //log in user
            $instance->login();
            //set user session
            $instance->createUserSession();
            

        }
        else{
            //when user login is wrong
            echo "Sorry could not find user please try again <br>";
        }

    }

    else{
        echo "Hello from the outside - Login to procede";
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
                <td><input type="password" name="password" placeholder="Enter Password"></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
            </tr>
        </table>
    </form>
</body>
</html>