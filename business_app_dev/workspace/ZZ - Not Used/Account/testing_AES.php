<?php

/* This page is for testing only*/
/* @ref: https://gist.github.com/odan/138dbd41a0c5ef43cbf529b03d814d7c & edited by Feeney, K.*/

$entered_password = 'passWORD123';
$key = '3sc3RLrpd17'; //code to lock and unlock password
$method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
/*$key = substr(hash('sha256', $key , true), 0, 32);*/ /* Can't use this, as the key will be used on two different pages, so it would be needed to be known*/
echo "Password: ".$entered_password. "<br>";
echo "Key: " . $key . "<br>"; // key converted into something that is not viewable normally

// IV must be exact 16 chars (128 bit)
$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
$encrypted = base64_encode(openssl_encrypt($entered_password , $method, $key, OPENSSL_RAW_DATA, $iv));

// My secret message 1234
$decrypted = openssl_decrypt(base64_decode($encrypted), $method, $key, OPENSSL_RAW_DATA, $iv);


echo "Encrypted: ".$encrypted.
        "<br> Decrypted :".$decrypted;
        
        


/*echo '<br><br>';
echo 'plaintext=' . $plaintext . "\n";
echo 'cipher=' . $method . "\n";
echo 'encrypted to: ' . $encrypted . "\n";
echo 'decrypted to: ' . $decrypted . "\n\n";*/
?>
<html>
    <head>
        
        <title>Redirect...</title>
        <meta http-equiv="refresh" content="0; URL='/'"/>
        
    </head>
    
    
    
    
</html>
    <body>
        &nbsp;
    </body> 
</html>