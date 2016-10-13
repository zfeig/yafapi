<?php
class RedisCache{
  private $redis = null;

  public function __construct(){
    if(!extension_loaded("redis")){
        die("redis extension required!");
    }
    if(is_null($this->redis)){
       $this->connect();
    }
  }

  public function connect(){
   $redis = new Redis();
   $conf = Yaf_Registry::get("conf")["redis"];
    try {
       $ret = $redis->connect($conf["ip"],$conf["port"]);
       if($ret){
         $this->redis = $redis;
        }else{
          die("redis connect failed!");
        }
    }catch(Exception $e){
       die("redis connect error!");
    }
  }


  public function __call($method,$arguments){
      $funcArr = array($this->redis,$method);
      if(!method_exists($this->redis,$method)){
         die("<br/>Error::method:".$method." is not exist!");
        }
       return call_user_func_array($funcArr,$arguments);
  }
  

  public function getRedis(){
  	return $this->redis;
  }


}

?>
