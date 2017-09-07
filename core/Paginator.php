<?php

namespace Core;

class Paginator extends \JasonGrimes\Paginator{

    protected $qs;

     public function __construct($totalItems, $itemsPerPage, $currentPage, $urlPattern = 'page=(:num)')
    {
       parent::__construct($totalItems, $itemsPerPage, $currentPage);
        $this->urlPattern = $urlPattern;
        $this->qs = &$_SERVER['QUERY_STRING'];


        $this->updateNumPages();
    }

    /**
     * @param int $pageNum
     * @return string
     */
    public function getPageUrl($pageNum)
    {
        /*
        $qs = $_SERVER['QUERY_STRING'];
     //   $this->fixQueryString();
        $qs = preg_replace('/\&page=\d+/','',$qs);

        if($qs){
            if(strpos($qs,'?')==false){
                $this->qs .= '?';
            } else {
                $this->qs .= "&";
            }
        }
*/
        return  str_replace(self::NUM_PLACEHOLDER, $pageNum, $this->urlPattern);
    }/**/

    protected function prepareUrl($url){
        $string = "";
        if(strpos($this->qs,'?')===false && $this->qs) {
            $string .= '?';
        }
        $string .= $this->qs;
        $string = preg_replace('/(\&|\?)page=\d+/','',$string) ;
        if($url) {
            if (strpos($string, '?') === false) {
                $string .= '?';
            } else {
                $string .= '&';
            }
        }
        $string.= $url;
      
        return $string;
    }/**/
    
    /**
     * Render an HTML pagination control.
     *
     * @return string
     */
    public function toHtml()
    {
        if ($this->numPages <= 1) {
            return '';
        }
        $html =  '<nav aria-label="Page navigation">';
        $html .= '<ul class="pagination">';
        if ($this->getPrevUrl()) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->prepareUrl($this->getPrevUrl() ) . '">&laquo; '. $this->previousText .'</a></li>';
        }

        foreach ($this->getPages() as $page) {

            if ($page['url']) {
                $html .= '<li class="page-item ' . ($page['isCurrent'] ? ' active' : '') . '">';
                if(!$page['isCurrent']){
                $html .='<a class="page-link" href="' . $this->prepareUrl($page['url'] ) . '">' . $page['num'] . '</a>';
                } else{
                     $html .='<span class="page-link">' . $page['num'] . '</span>';
                }
                $html .='</li>';
            } else {
                $html .= '<li class="disabled"><span>' . $page['num'] . '</span></li>';
            }
        }

        if ($this->getNextUrl()) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->prepareUrl($this->getNextUrl() ) . '">'. $this->nextText .' &raquo;</a></li>';
        }
        $html .= '</ul>';
        $html .= '</nav>';

        return $html;
    }/**/


    
}/* end of Class */