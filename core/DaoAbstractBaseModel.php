<?php

/**
 * Class DaoAbstractBaseModel
 * 
 * DAO (Data Access Object) этот класс реализует доступ к данным в базе данных
 * в данном случае источником данных у нас будет являтся MySQL 
 * так что будем пилить класс  под нее. Хотя это конесно не совсем правильно класс должен быть универсальным,
 * он должен быть слоем абстракции между данними и приложеним. По хорошему, приложение не интересует откуда берутся данные.
 * 
 * Данный класс так же будет являтся базовым классом для наших моделей
 * и его следует "экстендить" extends
 * 
 * @example
 *  class test extends DaoAbstractBaseModel{
 *       public function setTableName()
 *       {
 *         return 'testTbl';
 *      }
 *  }
 */
abstract class DaoAbstractBaseModel {

    /**
     * @var string - тут будет лежать готовый запрос к базе данных
     */
    public $query;

    /**
     * @var string - это название таблицы с которой мы работаем
     */
    public $tableName;

    /**
     * @var string - часть запоса с селектом
     */
    public $select;
    
    /**
     * @var string - часть запроса с апдейтом
     */
    public $update;
    
    /**
     * @var string - часть запроса с делитом
     */
    public $delete;
    
    /**
     * @var string - условие оно можеть использоваться в любых типах запроса
     */
    public $where;
    
    /**
     * @var string - сортировка так же в любых запросах проканает
     */
    public $orderBy;
    
    /**
     * @var string - ну и соответственно количество записей которое мы хотим получить
     */
    public $limit;


    /**
     * @var bool|string экземпляр подключения к бд
     */
    public $conn;

    /**
     * DaoAbstractBaseModel constructor.
     * 
     * Важная часть нашего класса - конструктор в котором происходит забор названия
     * таблицы из класса наследника. Так же данный конструктор должен инициировать подключение к базе данных
     */
    public function __construct(){

        $this->tableName=$this->setTableName();
        $this->conn = $this->connection('localhost', 'test', 'root', 'password');
    }

    /**
     * Функция непосредственно реализуюшая подключение к базе данных
     *
     * @param $host string адрес хоста
     * @param $dbName string название базы данных
     * @param $username string имя пользователя
     * @param $password string пароль
     * @return bool|string
     */
    public function connection($host, $dbName, $username, $password){
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
        return $conn;
    }

    /**
     * Функция инициирующая разрыв с бд
     *
     */
    public function disconnect(){
        $this->conn=null;
    }
    
    /**
     * Функция записывает в строку значение что то типа SELECT $param
     * 
     * @param $param
     */
    public function setSelect($param){

        $this->select = "SELECT $param FROM $this->tableName";

    }

    /**
     * Функция записывает в строку значение что то типа UPDATE $param
     * 
     * @param $param
     */
    public function setUpdate($param){
        $this->update=" UPDATE $this->tableName SET $param ";
    }

    /**
     * Функция записывает в строку значение что то типа DELETE
     * 
     *
     */
    public function setDelete(){
        $this->delete=" DELETE FROM $this->tableName";
    }

    /**
     * Функция записывает в строку значение что то типа WHERE $param
     * 
     * @param $param
     */
    public function setWhere($param){
        $this->where=" WHERE $param ";
    }

    /**
     * Функция записывает в строку значение что то типа ORDER BY $param
     * 
     * @param $param
     */
    public function setOrderBy($param){
        
        $this->orderBy="ORDER BY $param";
    }

    /**
     * Функция записывает в строку значение что то типа LIMIT $param
     * 
     * @param $param
     */
    public function setLimit($param){
        $this->limit=" LIMIT $param";
    }
    
    /**
     * Выполнене запроса к базе
     * данная функци так же должна возвращать результат от базы
     * 
     * @return mixed
     */
    public function execute(){
        return $this->conn->query($this->query);
    }

    /**
     * Построение запроса на основе данных переданных во вспомогательные функции
     * Данная функция так же может не строить запрос если входной парамметр Query не null
     * в этом случаем запрос берется из входного параметра query
     *
     * эта фугкция будет самой жирной и самой главной в нашем классе
     *
     * @return null|string
     * @throws Exception
     */
    public function queryBuilder(){
        $query=null;
        if(($this->select!=null && $this->update==null && $this->delete==null) ||
            ($this->select==null && $this->update!=null && $this->delete==null) ||
            ($this->select===null && $this->update==null && $this->delete!=null)){
            if($this->select){
                $query=$this->select;
                if($this->where){$query=$query.$this->where;}
                if($this->orderBy){$query=$query.$this->orderBy;}
                if($this->limit){$query=$query.$this->limit;}
            }
            if($this->update){
                $query=$this->update;
                if($this->where){$query=$query.$this->where;}

            }
            if($this->delete){
                $query=$this->delete;
                if($this->where){$query=$query.$this->where;}
            }
        }else{
            throw new Exception('Обноружено совместное использование select update delete');
        }

        $this->query=$query;
    }

    /**
     * Функция обязательная для отпредения в калссе наследнике
     * должна определить название таблицы
     * 
     * @return mixed
     */
    abstract public function setTableName();
}