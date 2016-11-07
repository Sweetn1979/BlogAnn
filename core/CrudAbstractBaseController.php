<?php

/**
 * Class CrudAbstractBaseController
 * Шаблон реализующий Create Read Update Delete (CRUD) структуру
 * Это универсальная структура для большенства различных MVC(Model View Controller) фреймворков
 * Данный абстрактный класс неоходимо "экстендить" extends к классу наследнику
 * @example: class ExampleClass extends CrudAbstractBaseController{}
 *
 * @author Diveev Alexey
 */
abstract class CrudAbstractBaseController extends CController{
    /**
     * Данная функция должна реализовать создание новой записи
     * в базе данных
     *
     * @return mixed
     */
    abstract public function actionCreate();

    /**
     * Данная функция должна реализовать считываение записи
     * из базы данных по идентификатору записи
     *
     * @param integer $id - идентификатор записи
     * @return mixed
     */
    abstract public function actionRead($id);

    /**
     * Данная функция должна реализовать обновление записи
     * в базе данных по уникальному идентификатору
     *
     * @param integer $id - уникальный идентификатор а базе данных
     * @return mixed
     */
    abstract public function actionUpdate($id);

    /**
     * Функция удаляет запись из базы данных по уникальному идентификатору
     *
     * @param integer $id - уникальной идентификатор записи
     * @return mixed
     */
    abstract public function actionDelete($id);

    
}