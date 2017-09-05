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
    
    
    
    
}/* end of Model */
