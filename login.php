<?php

	session_start();

    
    include_once 'connFile.php'; 
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    $encryption_key = "covidKey";
    $hashedPassword =$_POST['password'];


    $sql = 'SELECT userName,password,iv FROM users';
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        
        $iv = hex2bin($row['iv']); //encrypting username with the iv
        $userName = openssl_encrypt($_POST['userName'], $ciphering, $encryption_key, $options, $iv);
        
//        to prove if details are the same as database
        if($userName == hex2bin($row['userName'])&&password_verify($hashedPassword,$row['password']))
        {
        echo "<script>location.href = 'loggedInDetails.php';</script>";
            $_SESSION['userName'] = bin2hex($userName);
        }
        else
        {
            echo "incorrect login credentials, please try again";
        }
         
    }
    mysqli_close($conn);








?>