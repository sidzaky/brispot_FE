<?php 

	class Sending{
		
		public function __construct() {

			$this->be_url = "http://localhost/brispot_be/";
            $this->getImgUrl = "http://localhost/brispot_content/get.php?";
		}
		 
		public function send($url=null , $data = null){ 
                if ($url != null){
                    if ($data != null) $data = http_build_query(['data'=> $data ]);
                    $context_options = array (
                            'http' => array (
                                'method' => 'POST',
                                'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                                            . "Content-Length: " . strlen($data) . "\r\n",
                                'content' => $data
                                )
                            ); 
                    $context = stream_context_create($context_options);
                    $fp = file_get_contents($this->be_url . $url, false, $context);
                    
                    if ($fp === FALSE) {
                        return 0;
                    }
                    else return $fp;
		    }
        }
		

    public function getImg($url = null){ 
        if ($url != null){
            $data = http_build_query(['img'=> $url ]);
            $context_options = array (
                    'http' => array (
                        'method' => 'POST',
                        'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                        )
                    ); 
            $context = stream_context_create($context_options);
            $fp = file_get_contents($this->getImgUrl . $data, false, $context);
            if ($fp === FALSE) {
                return 0;
            }
            else return $fp;
        }
        else return 0;
    }

}
		
		
	
?>