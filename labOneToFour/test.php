<?php
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=myDB", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }
    try{
        $sql = "INSERT INTO persons (first_name, last_name, email) VALUES (:first_name, :last_name, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $first_name = "Hermione";
        $last_name = "Granger";
        $email = "hermionegranger@mail.com";
        $stmt->execute();    
        echo "Records inserted successfully.";
    } catch(PDOException $e){
        die("ERROR: Could not prepare/execute query: $sql. " . $e->getMessage());
    }
    unset($stmt);
    unset($pdo);
?>