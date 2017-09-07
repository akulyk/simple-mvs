<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model
{
    protected $table = 'users';
    
    public $id;
    public $name;
    public $email;
    
    /*
    * creates new instance of model
    *
    */
    public static function create($params = []){
        $model = new static;
        if(isset($params['id'])){
        $model->id = $params['id'];
        }
        if(isset($params['name'])){
        $model->name = $params['name'];
        }
        if(isset($params['email'])){
        $model->email = $params['email'];
        }
       
        return $model;
    }/**/
    
    
    protected function getParamsForFind($params){
        
      return array('email'=>$params['email']);
        
    }/**/
    
    public function validate(){
        if(!$this->name){
            $this->addError("name","Name field must me set!");
        }
        
        if(!$this->email){
            $this->addError('email',"Email field cannot be empty!");
        }
        
        if ($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
             $this->addError('email',"Email address is incorrect!");
        }      
        
        if(count($this->errors)===0){
            return true;
        }
        
    return false;    
        
    }/**/
     
     /*
    * which fields should be inserted in db
    * return @array
    */
    protected function getParamsForInsert(){
        $params = [
            'name'=>$this->name,
            'email'=>$this->email,
            
        ];
        return $params;
        
    }/**/
     
     
  
   
    
    
}/* end of User */
