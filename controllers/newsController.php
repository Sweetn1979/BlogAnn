<?php
 class  newsController extends  CrudAbstractBaseController
 {

     /**
      * главный экшн в данном контроллере
      */
     public function actionIndex()
     {
         
         $this->render('index',[
             'title'=>'заголовок'
         ]);
     }
     
     public function actionCreate()
     {
         // TODO: Implement actionCreate() method.
     }
     public function actionRead($id)
     {
         // TODO: Implement actionRead() method.
     }
     public function actionDelete($id)
     {
         // TODO: Implement actionDelete() method.
     }
     public function actionUpdate($id)
     {
         // TODO: Implement actionUpdate() method.
     }
 }