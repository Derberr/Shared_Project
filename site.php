<?php

    include_once 'connFile.php'; 
    
            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options   = 0;
            $iv = random_bytes(16);
            $encryption_key = "covidKey";


        //hashing the password   
            $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);


        //encrypting


            $userName = openssl_encrypt($_POST['username'], $ciphering, $encryption_key, $options, $iv);
            $name = openssl_encrypt($_POST['name'], $ciphering, $encryption_key, $options, $iv);
            $address = openssl_encrypt($_POST['address'], $ciphering, $encryption_key, $options, $iv);
            $dob = openssl_encrypt($_POST['DOB'], $ciphering, $encryption_key, $options, $iv);
            $phoneNumber = openssl_encrypt($_POST['phoneNo'], $ciphering, $encryption_key, $options, $iv);

//converting to hexidecimal

            $iv_hex = bin2hex($iv);
            $name_hex = bin2hex($name);
            $userName_hex = bin2hex($userName);
            $dob_hex = bin2hex($dob);
            $phoneNumber_hex = bin2hex($phoneNumber);
            $address_hex = bin2hex($address);

//encrypting image

            $image_data = file_get_contents($_FILES['picture']['tmp_name']);
            $img_name = $_FILES['picture']['name'];
            $image= openssl_encrypt($image_data, $ciphering, $encryption_key, $options, $iv);   

            $sql = "INSERT INTO users (userId,userName,name,iv,password,dob,phoneNumber,address,image) VALUES (NULL,'$userName_hex','$name_hex','$iv_hex','$hashedPassword','$dob_hex','$phoneNumber_hex','$address_hex','\"". addslashes($image)."\"')";

            if( mysqli_query($conn, $sql))
            {
                echo "<script>location.href = 'contacts.html';</script>";
            }

        mysqli_close($conn); 


?>


