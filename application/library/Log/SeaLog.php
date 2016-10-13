<?php
class SeaLog{

  public  static  function getIpUri(){
      return $_SERVER['REMOTE_ADDR'].' | '.$_SERVER['REQUEST_URI'].' | '.$_SERVER['REQUEST_METHOD'].' | ';
  }


  public static function setBasePath($basePath='')
  {
     if(empty($basePth)){
       $basePath = Yaf_Registry::get('conf')['seaslog']['basepath'];
     }
      SeasLog::setBasePath($basePath);
  }



  public static function getBasePath()
  {
      return SeasLog::getBasePath();
  }



   public static function setLogger($module='')
   {
       if(empty($module)){
         $module = Yaf_Registry::get('conf')['seaslog']['module'];
       }
       SeasLog::setLogger($module);
   }



   public static  function getLastLogger()
   {
       return SeasLog::getLastLogger();
   }

  

   public static function analyzerCount($level = 'all',$log_path = '*',$key_word = NULL)
   {
        return array();
   }



   public static function analyzerDetail($level = SEASLOG_INFO, $log_path = '*', $key_word = NULL, $start = 1, $limit = 20, $order = SEASLOG_DETIAL_ORDER_ASC)
   {
        return SeasLog::analyzerDetail($level, $log_path = '*', $key_word = NULL, $start = 1, $limit = 20, $order = SEASLOG_DETIAL_ORDER_ASC);
   }


   public static function getBuffer()
   {
        return array();
   }


   public static function flushBuffer()
   {
        return TRUE;
   }


   public static function debug($message,array $content = array(),$module = '')
   {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::debug($message,$content,$module);
   }

   
   public static function info($message,array $content = array(),$module = '')
   {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::info($message,$content,$module);
   }

   
   public  static  function notice($message,array $content = array(),$module = '')
    {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::notice($message,$content,$module);
    }

   
   public static function warning($message,array $content = array(),$module = '')
   {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::warning($message,$content,$module);
   }


   public static function error($message,array $content = array(),$module = '')
   {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::error($message,$content,$module);
   }

   


   public static function critical($message,array $content = array(),$module = '')
   {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::critical($message,$content,$module);
   }

   
   public static function alert($message,array $content = array(),$module = '')
   {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::alert($message,$content,$module);
    }



    public static function emergency($message,array $content = array(),$module = '')
    {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::emergency($message,$content,$module);
    } 
   


    public static  function log($level,$message,array $content = array(),$module = '')
    {
        $message = self::getIpUri().$message;
        if($module !== ''){
            $module = $_SERVER['SERVER_NAME'].'/'.$module;
        }
        SeasLog::log($level,$message,$content,$module);
    }

}


?>
