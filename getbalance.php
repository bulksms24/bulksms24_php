<?php

    require_once ("bulksms.ini.php");

    $mysms = new BulkSMS24();
    $api_key = "xx";
    $api_secret = "xx";


    $mysms->Setup($api_key,$api_secret);
 
   $xd =  $mysms->getBalance();
    
   print_r($xd)



?>