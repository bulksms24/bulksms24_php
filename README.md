# BULKSMS24 SMS GATEWAY API

Here we are providing bulksms service currently only Bangladesh
 

## Setup and Run

```python

    require_once ("bulksms.ini.php");

    $mysms = new BulkSMS24();
    $api_key = "xx";
    $api_secret = "xx";


    $mysms->Setup($api_key,$api_secret);


    $MobileNumber = ["016xxxxxxxx","018xxxxxxxx"];
    $sendMessage =  $mysms->sendMessage($MobileNumber,"hello Sir How are you");
    
   print_r($sendMessage);
   
   
   $getBalance =  $mysms->getBalance();
    
   print_r($getBalance); 

```
## License
[MIT](https://choosealicense.com/licenses/mit/)
