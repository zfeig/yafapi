<?php
class BaseModel{
  protected $link = null;
  
  public function __construct($db_config=[]) {
     if(empty($db_config)){
       $db_config = Yaf_Application::app()->getConfig()->db;
     }
       $this->connect($db_config);
   }


   public function connect($config){
     $dsn = sprintf("mysql:host=%s;dbname=%s",$config->host,$config->name);
     if(is_null($this->link)){
        try{
            $this->link = new PDO($dsn,$config->user,$config->pwd);
            $this->link->exec("SET NAMES utf8");
        }catch(PDOException $e){
            exit("connection failed,please check");
        }
      }
      return true;
   }

   
   
    public  function query($sql,$params,$fetch = true){
    if(is_null($this->link)){
        exit("<br/>instance pdo first");
    }
    $res = $this->link->prepare($sql);
    foreach($params as $k => $v){
        //echo $k." bind ".$v."<br/>";
        $res->bindValue($k,$v);
    }
    $res->execute();
    if($fetch){
        $retData =array();
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
          array_push($retData,$row);
        }
        return $retData;
      }
    }



    public  function queryOne($sql,$params,$fetch = true){
    if(is_null($this->link)){
        exit("<br/>instance pdo first");
    }
    $sql = $sql." limit 1";
    $res = $this->link->prepare($sql);
    foreach($params as $k => $v){
        //echo $k." bind ".$v."<br/>";
        $res->bindValue($k,$v);
    }
    $res->execute();
    if($fetch){
        $retData =array();
        if($row = $res->fetch(PDO::FETCH_ASSOC)){
          $retData = $row;
        }
        return $retData;
      }
    }










   

}



?>
