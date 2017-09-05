<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Post extends \Core\Model
{
    protected $table = 'posts';
    /**
     * Get all the users as an associative array
     *
     * @return array
     */
     
     protected function getTableName(){
         return $this->tablePrefix.$this->table;
         
    }/**/
     
    public function getAll()
    {
       
        $result = $this->db->query('SELECT id, name FROM '.$this->getTableName());
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }/**/
    
    public function getOne($id){
        $sql =  'SELECT id, name FROM '.$this->getTableName().' WHERE id =:id';
        $this->db->prepare($sql);
        $this->db->execute(array(':id'=>$id));
        return $this->db->fetch(PDO::FETCH_ASSOC);
    }
    
    
}/* end of User */
