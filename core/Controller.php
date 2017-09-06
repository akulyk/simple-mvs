<?php

use Core\View;

namespace Core;

/**
 * Core Controller
 *
 */
abstract class Controller
{
     /**
     * Class view
     * @var object
     */
    protected $_view;
    public $layout = 'main';
    
    
    /**
     * Parameters from the matched route
     * @var array
     */
    protected $route_params = [];

    /**
     * Class constructor
     *
     * @param array $route_params  Parameters from the route
     *
     * @return void
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name  Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';
       
      
        if (method_exists($this, $method)) {
            
        $args = array_merge($args,$this->getMethodArgs($method));
            
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }/**/
    
    /*
    * check if method has parameters with the same name as $_GET
    * return @array
    */
    protected function getMethodArgs($method){
        $args = [];
        $ReflectionMethod =  new \ReflectionMethod($this, $method);
        $params = $ReflectionMethod->getParameters();

        $paramNames = array_map(function( $item ){
        return $item->getName();
        }, $params);
        foreach($paramNames as $k => $name){
            if(isset($_GET[$name])){
                $args[$k] = $_GET[$name];
            }
        }
        
     return $args;
    }/**/
    
    
    /*
    * redirects to controller/action?paramName=paramValue
    */
    public function redirect($url,$params = [], $statusCode = 302){
        $host = $_SERVER['HTTP_HOST'];    
        $location = $host . '/'. $url;
       
        $location .=$this->prepareQueryString($params);
        
        header("Location: http://{$location}",true,$statusCode);
        exit;
    }
    /**
     * Prepare string params for redirect.
     *
     * @return string
     */
    protected function prepareQueryString($params){
         $queryString = '';
        if(count($params)>0){
            $i = 1;
             $queryString .="?";
            foreach ($params as $k => $v){
                $queryString .= "{$k}={$v}";
                if($i< count($params)){
                   $queryString .="&"; 
                }
            }
            
        }
        return $queryString;
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }/**/

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }/**/
	
	protected function render($view,$params = []){
		$content = $this->getView()->render($view,$params,$this);
        echo $this->renderContent($content);
	}/**/
    
   
    public function renderContent($content)
    {
        $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== false) {
            return $this->getView()->renderPhpFile($layoutFile, ['content' => $content], $this);
        } else {
            return $content;
        }
    }/**/
    
    protected function getView(){
         if ($this->_view === null) {
            $this->_view = new View();
        }
        return $this->_view;
        
    }/**/
    
     
    public function findLayoutFile($view,$ext = 'php')
    {
      
        if (is_string($this->layout)) {
            $layout = $this->layout;
        } 

        if (!isset($layout)) {
            return false;
        }

    
            $file = $this->getLayoutPath() . DIRECTORY_SEPARATOR . $layout .'.'.$ext;
      
      if(!is_file($file)){
          
         
            throw new \Exception("The layout file - $layout.$ext not found in layouts folder");
    
          
      }

        if (pathinfo($file, PATHINFO_EXTENSION) !== '') {
            return $file;
        }
      
       
    }/**/
    
    protected function getLayoutPath(){
        
        return APP.'/views/layouts';
        
    }/**/
	
	
	
}/* end of Controller */
