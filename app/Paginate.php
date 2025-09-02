<?php
namespace app;

class Paginate
{
	function __construct($total, $pnumber) {
		if (empty($pnumber)) $pnumber = self::pnumber();
		$query = self::query();

		$this->total = $total;
		$this->pnumber = $pnumber;
		$this->query = $query;

		$page = (int)!empty($_GET['page']) ? $_GET['page'] : 1;

		$more = (int)$_GET['more'];
		if (!empty($more) && !AJAX) $page = 1;

		$this->page = $page;
	}

	//кол-во элементов на странице
	static function pnumber() {
		return 20;
	}

	static function query() {
        $uri = $_SERVER['REQUEST_URI'];
		$arr_uri = explode('?', $uri);
		$uri = $arr_uri[1];
		$page = (int)$_GET['page'];
		$uri = str_replace('page='.$page, '', $uri);
		$uri = trim($uri, '&');
		if (!empty($uri)) $uri = '&'.$uri;
		return $uri;
	}

	function num_pages() {
		$this->num_pages=ceil($this->total/$this->pnumber);
		return $this->num_pages;
	}

	function start() {
		$this->num_pages=ceil($this->total/$this->pnumber);
		if ($this->page>$this->num_pages)
		{
			$this->page=$this->num_pages;
		}
		if (isset($_GET['last']))
		{
			$this->page=$this->num_pages;
		}
		$this->start=$this->page*$this->pnumber-$this->pnumber;
		if ($this->page > $this->num_pages || $this->page < 1)
		{
			$this->page=$this->num_pages;
		}
		return abs($this->start);
	}

	function links() {

        $URI = strtok($_SERVER["REQUEST_URI"], '?');

		$prev = $next = '';
		if ($this->page > 1) $prev .= "<a href='".$URI."?page=".($this->page-1).$this->query."' class='pagination-link'>‹</a>";
		if ($this->page < $this->num_pages) $next .= "<a href='".$URI."?page=".($this->page+1).$this->query."' class='pagination-link'>›</a>";

		if ($this->num_pages < 2) return;

		$html = '<div class="pagination">';
            $html .= $prev;
			for($pr = "", $i =1; $i <= $this->num_pages; $i++) {
				if($i == 1 || $i == $this->num_pages || abs($i-$this->page) < 4) {
					if($i == $this->page) {
						$pr = "<span class='pagination-item pagination-item-num active' data-i='{$i}'>{$i}</span>";
					}
					else {
						$pr = "<a class='pagination-item pagination-item-num' href='".$URI."?page=".$i.$this->query."' data-i='{$i}'>{$i}</a>";
					}
				}
				else {
					if($pr == "<div class='pagination-item disabled'>...</div>" || $pr == "") {
						$pr = "";
					}
					else {
						$pr = "<div class='pagination-item disabled'>...</div>";
					}
				}
				$html .= $pr;
			}
            $html .= $next;
			$html .= '<div class="pagination-item pagination-item-all">Все</div>';
		$html .= '</div>';
		return $html;
	}
}
