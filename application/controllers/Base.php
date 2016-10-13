<?php
class BaseController extends Yaf_Controller_Abstract{

	public function returnJson($status,$msg,$data=[]){
      $res= $this->getResponse();
      $res->setHeader("Content-Type","application/json;charset=utf-8");
      $data = Yaf_Registry::get('utils')->returnMsg($status,$msg,$data);
      return $res->setBody($data);
   }

} 
?>