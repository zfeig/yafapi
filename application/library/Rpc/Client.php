<?php
class Client {
	private static $serverAddress = null;
	private static $rpcConfig = null;
        private static $client = [];

       public static  function initProperty(){
         if(empty(self::$serverAddress)){
           self::$serverAddress = Yaf_Registry::get('conf')['rpc']['address'];
           self::$rpcConfig = explode(',',Yaf_Registry::get('conf')['rpc']['services']);
         }
       }
    
	public static function init($name="IndexService"){
          self::initProperty();
          if(in_array($name, self::$rpcConfig)){
         	if(empty(self::$client[$name])){
         		$serv_addr = sprintf("%s?s=%s",self::$serverAddress,$name);
         		$yar_client = new Yar_Client($serv_addr);
          		$yar_client->SetOpt(YAR_OPT_CONNECT_TIMEOUT, 5000);
          		self::$client[$name] = $yar_client;
         	}
         	return self::$client[$name];
          }
          else{
         	die("<br/>service:".$name." is undefined!<br/>");
          }
	}

}
?>
