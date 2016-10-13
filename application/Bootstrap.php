<?php
class Bootstrap extends Yaf_Bootstrap_Abstract{
  public function _initConfig(){
    $conf = Yaf_Application::app()->getConfig()->toArray();
    Yaf_Registry::set("conf",$conf);
  }

  public function _initDefaultName(Yaf_Dispatcher $dispatcher) {
    $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
  }

  public function _initRedisCache(){
    Yaf_Loader::import("Cache/RedisCache.php");
    $cache = new RedisCache();
    Yaf_Registry::set("cache",$cache);
 }


  public function _initLib(){
     Yaf_Loader::import("Common/Utils.php");
     Yaf_Registry::set("utils",Utils::getInstance());
  }

  public function _initLog(){
    Yaf_Loader::import("Log/SeaLog.php");
    SeaLog::setBasePath();
    SeaLog::setLogger();
  }

  public function _initRoute(Yaf_Dispatcher $dispatcher){
    $router = Yaf_Dispatcher::getInstance()->getRouter();

    $route1 = new Yaf_Route_Rewrite('/:num/user/:id',['controller'=>'index','action'=>'user']);
    $router->addRoute('user',$route1);

    $route2 = new Yaf_Route_Rewrite('/:num/test',['controller'=>'index','action'=>'test']);
    $router->addRoute('test',$route2);

    $route3 = new Yaf_Route_Rewrite('/:num/demo',['controller'=>'index','action'=>'demo']);
    $router->addRoute('demo',$route3);
  }

}

?>
