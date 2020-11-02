<?php

class BulkSMS24 { 
    protected $api_key;
    protected $api_secret;
    private $ch = null;

    function Setup($api_key,$api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->ch = null;
    }

  
    
    /**
	 * Creates a Send Message from your account to a specified Number.<br />
	 * @param recipients The number of the user.
	 * @param text The Text Message.
	 * @param senderid The Sender ID if have.  
	 */
    function sendMessage($recipients,$text,$senderid="rand"){

            if(is_array($recipients)){
                $recipients = implode(",",$recipients);
            } 

            $req = array(
                "api_key"       => $this->api_key,
                "api_secret"    => $this->api_secret,
                "type"          => "sendsms",
                "recipients"    => $recipients,
                "text"          => $text,
                "senderid"      => $senderid, 
            );

            return $this->api_call($req);

    }

    function getBalance(){
 
        $req = array(
            "api_key"       => $this->api_key,
            "api_secret"    => $this->api_secret,
            "type"          => "balance", 
        );

        return $this->api_call($req);

}

    private function is_setup() {
		return (!empty($this->api_key) && !empty($this->api_secret));
    }

    private function api_call($req = array()) {
        if (!$this->is_setup()) {
			return array('error' => 'You have not called the Setup function with your API KEY and API SECRET!');
        }

        $post_data = http_build_query($req, '', '&');

        
        if ($this->ch === null) {
			$this->ch = curl_init('http://128.199.236.220/api.php');
			curl_setopt($this->ch, CURLOPT_FAILONERROR, TRUE);
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		} 
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_data);
	    
		$data = curl_exec($this->ch);                
		if ($data !== FALSE) {
			if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
				// We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
				$dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
			} else {
				$dec = json_decode($data, TRUE);
			}
			if ($dec !== NULL && count($dec)) {
				return $dec;
			} else {
				// If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
				return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
			}
		} else {
			return array('error' => 'cURL error: '.curl_error($this->ch));
        }
        
    } 
  
     
  }

?>