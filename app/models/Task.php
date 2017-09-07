<?php

namespace App\Models;

use PDO;
use App\traits\ImageTrait;
use App\Models\User;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Task extends \Core\Model
{
    // use image trait for manipulating with
    // uploaded image
    use ImageTrait;
    protected $table = 'tasks';
    protected $tableAlias = 't';
    
    public $id;
    public $text;
    public $hashString;
    public $image;
    public $user_id;
    public $is_completed;
    public $user;
    
    
    /* return status of Task
    * @return string
    */
    public function getStatus(){
       
       if($this->is_completed){
           return "Complete";
       }
       
       return "In work";
       
    }/**/


    public function getImage(){
        return '/images/'.$this->image;
    }/**/
    
    public static function create($params = []){
        $model = new static;
        if(isset($params['id'])){
        $model->id = (int)$params['id'];
        }
        if(isset($params['text'])){
        $model->text = $params['text'];
        }
        if(isset($params['user_id'])){
        $model->user_id = (int)$params['user_id'];
        }
        if(isset($params['is_completed'])){
        $model->is_completed = (int)$params['is_completed'];
        }
        
        if($model->text && !$model->hashString){
            $model->hashString = md5($model->text);
          
        }
        
        if($model->user_id){
            $model->user = User::findOne($model->user_id);
        }
        if(isset($params['image'])){
            $model->image = $params['image'];
        }
        if(!$model->image) {
            $model->image = $model->getUploadedImage();
        }
        
        
        return $model;
    }/**/
    
    protected function getParamsForFind($params){
        
      return array('hashString'=>$this->makeHash($params['text']));
        
    }/**/
    
    protected function makeHash($text){
        
        return md5($text);
        
    }/**/
    
    public function validate(){
        if(!$this->user_id){
            $this->addError("user_id","User fields must me set!");
        }
        
        if(!$this->text){
            $this->addError('text',"Text field cannot be empty!");
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
            'text'=>$this->text,
            'hashString'=>$this->hashString,
            'image'=> $this->image,
            'user_id'=>$this->user_id,
            'is_completed'=> $this->is_completed,
        ];
        return $params;
        
    }/**/
    
   
     
   
    
    
}/* end of User */
