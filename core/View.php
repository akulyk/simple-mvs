<?php

namespace Core;

/**
 * View
 *
 * 
 */
class View
{

    /**
     * Render a view file
     *
     * @param string $view  The view file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public function render($view, $_params = [])
    {
      
        $output = '';
        $file = dirname(__DIR__) . "/app/views/{$view}.php";  // relative to Core directory
 
        if (is_readable($file)) {
           
		 $output .=	$this->renderPhpFile($file,$_params);
            
        } else {
            throw new \Exception("$file not found");
        }
        
        return $output;
    }/**/
    
     public function renderPhpFile($_file_, $_params_ = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        require($_file_);

        return ob_get_clean();
    }/**/

    public function createUrl($route = '',$params=[]){
        $url = '/';

       if($route){
           $url .=$route;
       }
       if(count($params>0)){
           $url .='?';
           $i=1;
           foreach($params as $k =>$v){
               $url .=$k."=".$v;
               if($i < count($params)){
                   $url .='&';
               }

           }
       }
       return $url;

    }/**/


   
}
