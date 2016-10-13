<?php
  class Utils {
  	private static $_instance = null;
        
        public static function getInstance(){
	   if(is_null(self::$_instance)){
	       self::$_instance = new self();
	   }
           return self::$_instance;
	}
       
        
        public function P($arr){
           if(is_array($arr) || is_object($arr)){
             echo "<pre/>";
             print_r($arr);
           }else if(is_string($arr)){
             echo $arr."<br/>";
           }
        }

        public function returnMsg($status=400,$msg="",$data=null){
           $ret = [];
           $ret["status"] = $status;
           $ret["msg"] = $msg;
           if(!!$data){
             $ret["result"] = $data;
           }
           return json_encode($ret,JSON_UNESCAPED_UNICODE);
        }

        public  function array2object($arr){
		if(!is_array($arr)) return;
		foreach($arr as $k=>$v){
			if(is_array($v) || is_object($v))
				$arr[$k]= (object) self::array2object($v);
		}
		return (object) $arr;
	}

	public function object2array($obj){
		$obj = (array) $obj;
		foreach($obj as $k=>$v){
			if(is_resource($v)) return;
			if(is_object($v) || is_array($v))
				$obj[$k]=(array) self::object2array($v);
		}
		return $obj;
	}



	public  function httpGet($url){
	    $ch = curl_init();
	    curl_setopt($ch,CURLOPT_URL,$url);
	    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	    curl_setopt($ch,CURLOPT_TIMEOUT,1000);
	    curl_setopt($ch,CURLOPT_HEADER,0);
	    $res = "";
	    $res = curl_exec($ch);
	    curl_close($ch);
	    return $res;
	}


	public  function httpPost($url,$query=array(),$header=array("Content-Type" =>"application/x-www-form-urlencoded")) {
	    $ch =curl_init();
	    $query = http_build_query($query);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
	    curl_setopt($ch, CURLOPT_POST, true );
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    curl_setopt($ch, CURLOPT_SSLVERSION, 1);
	    $ret = curl_exec($ch);
	    curl_close($ch);
	    return $ret;
	}



 } 


?>
