<?php

use DaoAbstractBaseModel as Dao;

 class Posts extends Dao{
     
     public function setTableName()
     {
         $this->tableName="Posts";
     }
     
     public function deleteAllPosts(){
         
         $this->setDelete();
         $this->setWhere(" del=1 ");
         $this->execute();
     }
 }