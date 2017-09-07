<?php

namespace App\Models;

use PDO;

/**
 * Admin model
 *
 */
class Admin extends \Core\Model
{
    protected $table = 'admins';
    
    public $id;
    public $login;
    public $password;
    public $password_hash;
    public $user_id;


    /*
     * check if admin enter valid and password
     * @return boolean
     */

    public function login(){
        $row = $this->findByAttributes(['login'=>$this->login]);
        if($row){
            if($this->checkPassword($this->password,$row['password_hash'])){
                $this->id = $row['id'];

                return true;
            }
        }
        return false;
    }/**/

    /*
    * creates new instance of model
    *
    */
    public static function create($params = []){
        $model = new static;
        if(isset($params['id'])){
        $model->id = $params['id'];
        }
        if(isset($params['login'])){
        $model->login = $params['login'];
        }
        if(isset($params['password'])){
        $model->password = $params['password'];
        }
       
        return $model;
    }/**/
    
    
    protected function getParamsForFind($params){
        
      return array('login'=>$params['login']);
        
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
            'login'=>$this->name,
            'password_hash'=>$this->encryptPassword($this->password),
            
        ];
        return $params;
        
    }/**/

    protected function encryptPassword($password){

        return password_hash($password,PASSWORD_BCRYPT);

    }/**/

    protected function checkPassword($password,$hash){

        return password_verify ($password , $hash );

    }
     
     
  
   
    
    
}/* end of User */
