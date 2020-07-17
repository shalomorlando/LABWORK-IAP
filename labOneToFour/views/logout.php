<?php
    include_once '../classes/user.php';
    
    $instance = user::create();
    $instance->logout();
?>