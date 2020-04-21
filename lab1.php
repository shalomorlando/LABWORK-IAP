<?php

include_once 'user.php';

function saveUser ($first_name, $last_name, $city){
    $user = new User($first_name,$last_name,$city);
    $res = $user->save();

    if($res){
        echo "added record successfully";
    }else{
        echo "added nothing";
    }
}

if(isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    
    saveUser($first_name, $last_name, $city);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAB 1</title>
</head>
<body>
    <form method="post">
        <table style = "align:center">
            <tr>
                <td>
                    <input type="text" name = "first_name" required placeholder = "Fisrt Name">
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
                    <button type = "submit" name = "btn-save">
                        <strong>SAVE</strong>
                    </button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>