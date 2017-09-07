<?php

namespace Core;

class Session{

    //private $_instance;

    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }

    }/**/

    public function get($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
    }/**/

    public function set($key,$value){
        $_SESSION[$key] = $value;
    }/**/

    public function setSecure($key,$value){
        session_regenerate_id();
       $this->set($key,$value);
    }/**/

    public function unsetVal($key){
        if(isset($_SESSION[$key])){
            unset ($_SESSION[$key]);
        }
    }

    public function setFlash($key,$value){
        if(!isset($_SESSION['flash'])){
            $_SESSION['flash'] = [];
        }
        $_SESSION['flash'][$key] = $value;

    }/**/

    public function getFlash($key){
        if(isset ($_SESSION['flash'][$key])){
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $value;
        }
    }/**/

    public function renderAlert($key){
        if($message = $this->getFlash($key)){
            $output = '';
            $output .= '<div class="alert alert-'.$key.' alert-dismissible fade show" role="alert">';
            $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            $output .= '<span aria-hidden="true">&times;</span>';
            $output .= '</button>';
            $output .= $message;
            $output .= '</div>';

         return $output;
        }
    }/**/

    public static function getFlashStatic($key){

        return static::getInstance()->getFlash($key);

    }/**/

    public static function renderAlertStatic($key){
        return static::getInstance()->renderAlert($key);

    }/**/

    public static function renderAlertsStatic(){
            if(isset($_SESSION['flash']) && count($_SESSION['flash'])>0){
                $_instance = static::getInstance();
                    $content = '';
                foreach ($_SESSION['flash'] as $key =>$value){
                   $content .=  $_instance->renderAlert($key);
                }
                return $content;
            }

    }/**/

    public static function getInstance(){
        return new static;
    }

}/* end of Class */