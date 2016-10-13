<?php
class MemCache{
  private $memcache = null;

  public function __construct(){
    if(!extension_loaded("memcache")){
        die("memcache extension required!");
    }
    if(is_null($this->memcache)){
       $this->connect();
    }
  }

  public function connect(){
   $memcache = new Memcache();
   $conf = Yaf_Registry::get("conf")["memcache"];
    try {
       $ret = $memcache->connect($conf["ip"],$conf["port"]);
       if($ret){
         $this->memcache = $memcache;
        }else{
          die("memcache connect failed!");
        }
    }catch(Exception $e){
       die("memcache connect error!");
    }
  }


  public function __call($method,$arguments){
      $funcArr = array($this->memcache,$method);
      if(!method_exists($this->memcache,$method)){
         die("<br/>Error::method:".$method." is not exist!");
        }
       return call_user_func_array($funcArr,$arguments);
  }
  

  public function getMemcache(){
  	return $this->memcache;
  }

}

?>
