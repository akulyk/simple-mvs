<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 *
 */
abstract class Model
{
    protected $db; 
    protected $table;
    protected $tablePrefix;
    public $id;
    public $errors = [];
    protected $safeAttributes = [];

    
    public function __construct(){
         if ($this->db === null) {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            $this->db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

            // Throw an Exception when an error occurs
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        if ($this->tablePrefix === null) {
        $this->tablePrefix = Config::DB_PREFIX;
        }
              
    }/**/
    
    
         
    public function getTableName(){
         return $this->tablePrefix.$this->table;
         
    }/**/
    
    public static function countAll(){
          $class = new static;
       return $class->db->query('SELECT COUNT(*) FROM '.$class->getTableName())->fetchColumn();
        
    }/**/
    
    /*
    *  finds all records in db accordind to criteria
    * @param $criteria = []
    */
    public static function findAll($criteria =[])
    {
        $class = new static;
        $models = [];
        $bind = [];
        $sql =  'SELECT * FROM '.$class->getTableName();
        if(isset($criteria['join']) && $criteria['join']){
            $sql .= " ".$criteria['join']." ";
        }
         if(isset($criteria['order_by']) && $criteria['order_by']){
            $sql .= " ".$criteria['order_by']." ";
        }
        if(isset($criteria['limit'])){
          $sql .= " LIMIT :limit ";  
          $bind[':limit'] = $criteria['limit'];
        }
        if(isset($criteria['offset'])){
          $sql .= " OFFSET :offset "; 
          $bind[':offset'] = $criteria['offset'];          
        }
        
         $query = $class->db->prepare($sql);
        if (count($bind)>0){
            foreach ($bind as $k => $value){
           
               $query->bindValue($k,$value,$class->getPdoParam($value));  
            }
            
        }
       
       try{
        $query->execute();
       } catch (\PDOException $e){
           var_dump($query->debugDumpParams());
            echo $e->getMessage();
          die;
           
       }
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
       
       if(count($rows)>0){
        foreach ($rows as $row){
            $models[] = static::create($row);
        }
       }
        
        return $models;
        
    }/**/
    
    /*
    * get a single record from bd
    */   
    public static function findOne($id){
        $class = new static();
        $sql =  'SELECT * FROM '.$class->getTableName().' WHERE id =:id';
        $query = $class->db->prepare($sql);
        $query->execute(array(':id'=>$id));
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row){
        return static::create ($row);
        }
        
        return false;
    }/**/
    
    /*
    * some wrapper for PDO::PARAM_
    * return @mixed
    */
    protected function getPdoParam($value){
             if(is_int($value)) {
                $param = PDO::PARAM_INT; 
            } elseif(is_bool($value)) {
                $param = PDO::PARAM_BOOL;
            } elseif(is_null($value)) {
                $param = PDO::PARAM_NULL;
            } elseif(is_string($value)) {
                $param = PDO::PARAM_STR;
            } else {
                $param = FALSE;
            }
        return $param;
    }/**/
    
    /*
    * saves data from model to db
    */
    public function save(){
        if($this->validate()){
         if($this->id){
             return $this->update();
         }
         
         return $this->insert($this->getParamsForInsert());
        } 
        return false;
     }/**/
    
    public function getErrors(){
        return $this->errors;
        
    }/**/
    
    /*
    * insert in db a new record
    */
    
    public function insert(array $params){
       
        $sql = "INSERT INTO ".$this->getTableName();
        $sql .=$this->prepareParamsForInsert($params);
        $query = $this->db->prepare($sql);
        
        foreach($params as $k=>$v){
             $query->bindValue(":{$k}", $v);
        }
       
       try{
        $result = $query->execute();
       } catch(\PDOException $e){
           
            echo $e->getMessage();
          
       }
        if($result){
        $this->id = $this->db->lastInsertId();
        }
        
        return $result;
        
    }/**/
    
    protected function prepareParamsForInsert($params){
        $insert = "";
        $columns = '';
        $values ='';
        if(count($params) > 0){
            $i = 1;
            foreach ($params as $k=>$v){
                $columns .= "`{$k}`";
                $values .= ":{$k}";
                if($i < count($params)){
                    $columns .= ",";
                $values .= ",";
                    
                }
             $i++;   
            }
          $insert .= " ({$columns}) VALUES ({$values}) ";  
        }
        return $insert;
        
    }/**/
    
    /*
    * function in development
    */
    public function update(){
        
        
    }
    
    /*
    * set an error for model
    */
    public function addError($field,$error){
        $this->errors[$field] = $error;
        
    }/**/
    
    /* function returns specific error for model
    * @return string
    */
     public function getError($field){
         if(isset($this->errors[$field]) && $this->errors[$field]){
        return $this->errors[$field];
         }
        
    }/**/
    
    public function clearErrors($error){
        $this->errors = array();
        
    }/**/
    
    /*
    * clear each value, which is not in safeAttributes array from a mess
    * or html tags and encode html entities
    */
    protected function clearParams(array $params){
        if(count ($params) > 0){
         foreach($params as $k =>$v){
             if(!in_array($k,$this->safeAttributes)){
            $params[$v] = strip_tags($v);
            $params[$v] = htmlentities($v);
            $params[$v] = trim($v);
             }
         }   
            
        }
        
        return $params;
    }/**/
    
     /*
    * checks if such record already exists in db
    * if not creates a new record
    *
    * @return self
    */
    public static function findOrCreate($params = []){
        $class = new static;
        
        // clear params from unwanted code
        $params = $class->clearParams($params);
       
         $data = $class->findByAttributes($class->getParamsForFind($params));
        
         if ($data && isset($data['id'])){
              $model = static::create($data);
         } else{
             
             $model = static::create($params);
             $model->save();
         }
         
         return $model;
        
        
    }/**/
    
    /*
    * find a record in db by array of attributes
    * 
    * return @array || false
    */
     public function findByAttributes(array $attributes){
        $where = '';
        $bind = [];
        if(count($attributes)){
            $i = 1;
            foreach($attributes as $n =>$v){
                $where .= " {$n} = :{$n} ";
                $bind[":{$n}"] = $v;
                if ($i < count($attributes)){
                  $where .= "AND";  
                }
                $i++;
            }
        }
        
        $sql = "SELECT * FROM ".$this->getTableName()." WHERE {$where}";
     
        $query = $this->db->prepare($sql);
        $query->execute($bind);
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if(isset($row['id'])){
            return $row;
        }
        
        return false;
        
     }/**/
     
    
    
    
}/* end of Model */
