<?php

class Pagination {

    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page=1, $per_page=20, $total_count=0) {
        $this->current_page = (int) $page;
        $this->per_page = (int) $per_page;
        $this->total_count = (int) $total_count;

    }

    public function offset() {
        return $this->per_page * ($this->current_page - 1);
    }

    public function total_pages() {
        return ceil($this->total_count / $this->per_page);
    }

    public function next_page() {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : false;
    }

    public function previous_page() {
        $prev = $this->current_page - 1;
        return ($prev > 0) ? $prev : false;
    }

    public function previous_link($url="") {
        $link = "";
        if($this->previous_page() != false) {
            $link .=  "<a href=\"{$url}?page={$this->previous_page()}\">";
            $link .= "&laquo; Previous</a>";
        }
        return $link;
    }

    public function next_link($url="") {
        $link = "";
        if($this->next_page() != false) {
            $link .= "<a href=\"{$url}?page={$this->next_page()}\">";
            $link .= "Next &raquo;</a>";
        }
        return $link;
    }
}