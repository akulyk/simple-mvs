<?php

namespace Core;

use App\Models\User;

class Sorter {
    public $sort;
    public $join;
    public $orderBy;
    
     public function __construct()
    {
        if (isset($_GET['sort'])){
            $this->sort = $_GET['sort'];
            $this->prepare();
        }
      
    }/**/
    
    public function prepare(){
        $data = explode(" ",$this->sort);
         $order = $data[1];
        if ($data[0]=="name" || $data[0] == "email"){
            $user = new User();
            $table = $user->getTableName()." u";
            $column = "u.".$data[0];
            $this->join = "INNER JOIN ".$table." ON user_id = u.id";
           
        } elseif($data[0] == "status"){
             $column = "is_completed";
        } else{
             $column = "id";
        }
        if($order !== "asc" && $order !=="desc"){
            $order = "asc";
        }
        
        $this->orderBy = "ORDER BY ".$column." ".mb_strtoupper($order);
    }/**/
    
    public function getSort(){
        return $this->sort;
        
    }/**/
    
    
    
    
    
} /* end of Class */      