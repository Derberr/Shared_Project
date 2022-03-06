<html>

    <body>
   
        <div style = "background-color: lightgoldenrodyellow" align="center"><img src="covidBanner.jpg" alt="Covid Banner" width="600" height="300">
            </div>

<?php

	session_start();
//<img src="covidBanner.jpg" alt="Covid Banner" width="600" height="300">
    echo '<div style = "background-color: lightgoldenrodyellow" align = "center">';
    include_once 'connFile.php'; 
    $ciphering = "AES-128-CTR";
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    $encryption_key = "covidKey";
    $loggedUser = $_SESSION['userName'];
   
    $sql = "SELECT userName,name,dob,phoneNumber,address,image,iv FROM users WHERE userName ='$loggedUser'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) 
    {
        
        $iv = hex2bin($row['iv']); 
        $name = hex2bin($row['name']);
        $userName= hex2bin($row['userName']);
        $dob = hex2bin($row['dob']);
        $phoneNumber= hex2bin($row['phoneNumber']);
        $address= hex2bin($row['address']);
        $picture = ($row['image']);

        //decrypting data to output plaintext to screen
        $decrypted_name = openssl_decrypt($name, $ciphering, $encryption_key, $options, $iv);
        $decrypted_dob = openssl_decrypt($dob, $ciphering, $encryption_key, $options, $iv);
        $decrypted_phoneNumber = openssl_decrypt($phoneNumber, $ciphering, $encryption_key, $options, $iv);
        $decrypted_address = openssl_decrypt($address, $ciphering, $encryption_key, $options, $iv);
        $decrypted_image = openssl_decrypt($picture, $ciphering, $encryption_key, $options, $iv);
        
    	
            
         echo '<div style = "background-color: lightgoldenrodyellow" align = "center"><img src="data:image/jpeg;base64,'.base64_encode($decrypted_image).'" height="300" width="300"/>
        <br>
          Your Personal details are: 
         <br>
         <br>
         Name is: '.$decrypted_name.'
         <br>
         Date of birth is: '.$decrypted_dob.'
         <br>
         Phone Number is: '.$decrypted_phoneNumber.'
         <br>
         Address is:  '.$decrypted_address.'<br>
         <a href= "coverPage.html"><button onclick="session_destroy()">Log Out</button></a>
         </div><br><br><br><br><br><br><br><br><br><br><br>'; 
       
        echo'</div>';
        
    }
    mysqli_close($conn);
?>

    </body>
    
</html>
