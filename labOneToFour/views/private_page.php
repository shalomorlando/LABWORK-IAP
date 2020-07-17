<?php

include_once '../classes/DBConnector.php';



session_start();
if(!isset($_SESSION['username'])){
    header("Location:Login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="validate.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/apikey.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="container">
        <br>
        <p style ="display:inline;" display="inline">Private page</p>

        <p style = "display:inline" align="right"><a href="logout.php">Logout</a></p>

        <hr>
        <h3>Here we create an api to allow Users/Developer to order items from external systems</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

        <button class="btn btn-primary" id="api-key-btn">
            Generate API key
        </button> 

        <!--Area to hold API key-->
        <br><br>
        <strong>Your API Key:</strong> <p>Note if your API key is already in use by an already running application, generating a new key will stop the application from functioning</p><br>

        <textarea name="api_key" id="api_key" cols="100" rows="2" readonly><?php echo fetchUserApiKey();?></textarea>

        <h3 >
            Service description
        </h3>

        We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it
    </div>


</body>
</html>