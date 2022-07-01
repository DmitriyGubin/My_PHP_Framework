<?php

namespace application\lib;

class Pagination {
    
    private $max = 3;//number of page numbers displayed (odd number!!!)
    private $route;
    private $current_page;
    private $total;//total entries
    private $limit;//number of records per page
    private $amount;//number of pages

    public function __construct($route, $total, $limit = 10) {
        $this->route = $route;
        $this->total = $total;
        $this->limit = $limit;
        $this->amount = $this->amount();
        $this->setCurrentPage();
    }
   
    public function get() 
    {
        $links = null;
        $limits = $this->limits();
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) 
        {
            if ($page == $this->current_page) 
            {
                $links .= '<li class="active">'.$page.'</li>';
            } 
            else 
            {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) 
        {
            if ($this->current_page > 1) 
            {
                $links = $this->generateHtml(1, 'Forward').$links;
            }
            if ($this->current_page < $this->amount) 
            {
                $links .= $this->generateHtml($this->amount, 'Back');
            }
        }
        $html .= $links.' </ul></nav>';
        return $html;
    }

    private function generateHtml($page, $text = null)
    {
        if (!$text) 
        {
            $text = $page;
        }
        
        if ($this->route['action'] == 'sorting')
        {
            return '<li><a href="/'.$this->route['controller'].'/posts/'.$this->route['parameter'].'/'.$this->route['type'].'/'.$page.'">'.$text.'</a></li>';
        }
        else
        {
            return '<li><a href="/'.$this->route['controller'].'/'.$this->route['action'].'/'.$page.'">'.$text.'</a></li>';
        }
    }

    private function limits()//to move through pages sequentially
    {
        $left = $this->current_page - ($this->max - 1)/2;
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max - 1 <= $this->amount) 
        {
            $end = $start + $this->max - 1;
        }
        else 
        {
            $end = $this->amount;
        }
        return array($start, $end);
    }

    private function setCurrentPage() 
    {
        if (isset($this->route['page'])) 
        {
            $currentPage = $this->route['page'];
        } 
        else 
        {
            $currentPage = 1;
        }
        $this->current_page = $currentPage;
        if ($this->current_page > 0) 
        {
            if ($this->current_page > $this->amount) 
            {
                $this->current_page = $this->amount;
            }
        } 
        else 
        {
            $this->current_page = 1;
        }
    }

    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
} 