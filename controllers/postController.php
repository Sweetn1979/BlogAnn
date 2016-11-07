<?php
 class  postController extends  CController
 {

     /**
      * главный экшн в данном контроллере
      */
     public function actionIndex()
     {
         
         $this->render('index',[
             'name'=>'anna', 
             'phone'=>'+791520000000'
         ]);
     }
     
     public function actionView()
     {
         // TODO: Implement actionCreate() method.
     }
 }