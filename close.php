<?php
 
    include_once 'connFile.php'; 
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    $encryption_iv = '5915487632154218';
    $encryption_key = "covidKey";


    $hashedName = openssl_encrypt($_POST['name'], $ciphering, $encryption_key, $options, $encryption_iv);
    $hashedPhone = openssl_encrypt($_POST['phoneNo'], $ciphering, $encryption_key, $options, $encryption_iv);

    $sql = "INSERT INTO closecontacts (userId,name,phoneNumber) VALUES (NULL,'$hashedName','$hashedPhone')";


 echo "contact added ";

    if(mysqli_query($conn, $sql)) 
    {
    echo "imported";
   echo "<script>location.href = 'contacts.html';</script>";
    } 
    else 
    {
       echo $sql;
    }
    mysqli_close($conn);



?>
