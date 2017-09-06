<?php

namespace Core;

class Paginator extends \JasonGrimes\Paginator{
    
     public function __construct($totalItems, $itemsPerPage, $currentPage, $urlPattern = 'page=(:num)')
    {
       parent::__construct($totalItems, $itemsPerPage, $currentPage);
        $this->urlPattern = $urlPattern;

        $this->updateNumPages();
    }
    
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
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->getPrevUrl() . '">&laquo; '. $this->previousText .'</a></li>';
        }

        foreach ($this->getPages() as $page) {
           
            if ($page['url']) {
                $html .= '<li class="page-item ' . ($page['isCurrent'] ? ' active' : '') . '">';
                if(!$page['isCurrent']){
                $html .='<a class="page-link" href="' . $page['url'] . '">' . $page['num'] . '</a>';
                } else{
                     $html .='<span class="page-link">' . $page['num'] . '</span>';
                }
                $html .='</li>';
            } else {
                $html .= '<li class="disabled"><span>' . $page['num'] . '</span></li>';
            }
        }

        if ($this->getNextUrl()) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->getNextUrl() . '">'. $this->nextText .' &raquo;</a></li>';
        }
        $html .= '</ul>';
        $html .= '</nav>';

        return $html;
    }/**/
    
}       