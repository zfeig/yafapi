<?php

class IndexController extends BaseController {
   public function init(){
      Yaf_Dispatcher::getInstance()->disableView();
   }

   public function indexAction() {//默认Action
       return $this->returnJson(200,"返回成功",['info'=>'hello,world']);
   }


   public function testAction(){
      Yaf_loader::import(APP_MODEL.'Service/Service.php');//调用自定义服务类
      $serv=  new Service();
      $query["service"] = $serv->list();

      $cache = Yaf_Registry::get("cache");     
      $userK = $cache->exists("user:5");
      if($userK){
        $query["user"] = $cache->hgetall("user:5");
      }else{
        $userModel = new UserModel();
        $query["user"] = $userModel->findOne(5);
        $cache->hmset("user:5",$query["user"]);
      }

      $common = new Common();
      $query["common"] = $common->init();

      $arrHelper = new Common_ArrayHelper();
      $query["sort"] = $arrHelper->sort(["address"=>"湖北孝感"]); 
      return $this->returnJson(200,'返回成功',$query);
   }

   public function userAction($num="v1",$id=1){
      //$id = $this->getRequest()->getParam("id",1);
      SeaLog::debug('传递的用户名id：{id}',['{id}'=>$id]);
      $ver = substr(strtolower($num),1);
      $cache = Yaf_Registry::get("cache");     
      $userK = $cache->exists("user:$id");
      $query =  [];
      if($userK){
        $query = $cache->hgetall("user:$id");
      }else{
        $userModel = new UserModel();
        $query = $userModel->findOne($id);
        if(empty($query)){
          return $this->returnJson(400,"用户不存在！");
        }
        $cache->hmset("user:$id",$query);
      }
      $query['version'] = $ver;
      return $this->returnJson(200,"获取成功",$query);
   }

   public function demoAction(){
      $query = $this->getRequest()->getQuery();
      $conf = Yaf_Registry::get("conf");
      $query["config"] = $conf;
      return $this->returnJson(200,"返回成功",$conf);
   }

}
?>
