<?php

namespace Core;

class Request{

   protected $_post;
   protected $_get;

    public function __construct()
    {
        $this->_post = $_POST;
        $this->_get = $_POST;

    }/**/

    public function post($key){
       if(isset($this->_post[$key])){
           return $this->_post[$key];
       }
    }/**/

    public function get($key){
        if(isset($this->_get[$key])){
            return $this->_get[$key];
        }
    }/**/


}/* end of Class */