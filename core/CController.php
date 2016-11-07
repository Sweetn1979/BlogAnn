<?php
class CController{
    /**
     * Это общая функция для всех занаследованных классов
     * Функция render должна реализовать отрисовку шаблона на клиентской стороне
     *
     * @param string $template шаблон для вывода данных
     * @param array $data ["name1"=>"value1", "name2"=>"value2"] массив данных
     */
    public function render($template, array $data){
        {
            $baseParh="/home/alex/PhpstormProjects/live-monitors/";
            $controller=get_class($this);

            $viewPathName=mb_strtolower(str_replace("Controller", '', $controller));

            $pathView= $baseParh.'/views/'.$viewPathName.'/'.$template.'.php';

            extract($data);

            require($pathView);
        }
    }
}