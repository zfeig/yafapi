<?php
class UserModel extends BaseModel{

  public function  findOne($id=0){
   $data = $this->queryOne("select * from article where id = :id",[":id"=>$id]);
   return $data;
   //return ['name'=>'lisi','age'=>20, 'sex'=>'男'];
  }


}


?>
