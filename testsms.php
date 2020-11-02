<?php

    require_once ("bulksms.ini.php");

    $mysms = new BulkSMS24();
    $api_key = "xx";
    $api_secret = "xx";


    $mysms->Setup($api_key,$api_secret);


    $MobileNumber = ["016xxxxxxxx","018xxxxxxxx"];
   $xd =  $mysms->sendMessage($MobileNumber,"hello Sir How are you");
    
   print_r($xd)



?>