<?php

namespace app\Models;

use app\Db;
use app\Model;
use app\Helpers;
use app\Models\Gallery;
use app\Models\Settings;

class Page extends Model
{
	public const TABLE = 'pages';

	public $name;
	public $url;
	public $show;
	public $text;
	public $rate;

	public static function adminBreadCrumbs($id) {
		$bread = '';

		$res = Page::findById($id);
		while($res->id) {
			if($bread <> '') $bread .= ",";
			$bread .= $res->id;
			if($res->ids <> 0 ) $res = Page::findById($res->ids);
			else $res->id = false;
		}
		$bread = array_reverse(explode(',',$bread));

		$b = [];
		foreach($bread AS $item) {
			$item = Page::findById($item);
			$b[] = array('name' => $item->name2, 'id' => $item->id, 'url' => '/admin/pages?ids='.$item->id);
		}

		return $b;
	}

	public static function breadCrumbs($id) {
		$bread = '';

		$res = Page::findById($id);
		while($res->id) {
			if($bread <> '') $bread .= ",";
			$bread .= $res->id;
			if($res->ids <> 0 ) $res = Page::findById($res->ids);
			else $res->id = false;
		}
		$bread = array_reverse(explode(',',$bread));

		return $bread;
	}

	public static function getUrl($id) {
		$ids = $url = '';

		$res = Page::findById($id);
		if($id == 1){
			$url = '/';
		}else{
			while($res->id <> false) {
				if($ids <> '') $ids .= ',';
				$ids .= $res->id;
				if($res->ids <> 0) $res = Page::findById($res->ids);
				else $res->id = false;
			}
			if($ids <> '')
			{
				$ids = array_reverse(explode(',',$ids));

				foreach($ids AS $v)
				{
					$res = Page::findById($v);
					if(!empty($res->url)){
						$url .= '/'.$res->url;
					}else{
						$url .= $res->url;
					}
				}
			}
		}

		return $url;
	}

	public static function checkUrl($id,$parameters) {
		$f = 1;
		$obj = Page::findById($id);
		while($obj->ids <> 0) {
			$obj = Page::findById($obj->ids);
			$url = array_pop($parameters);
			if($obj->url != $url) $f = 0;
		}

		return $f;
	}

	public static function check($parameters) {
		$f = 1;
		$ids = 1;
		foreach($parameters AS $item) {
			$obj = Page::findWhere('WHERE ids="'.$ids.'" AND url="'.$item.'"');
			if(!empty($obj)) {
				$ids = $obj[0]->id;
			}
			else {
				$f = 0;
				break;
			}
		}

		return $f;
	}

	public static function getArray() {
		$pages = Page::findAllShow();
		$array = [];
		foreach ($pages AS $page) {
			$id = $page->id;

			$childs = [];
			if (empty($page->parent)) {
				$page_childs = Page::findWhere("WHERE parent='{$id}' AND `show` = 1 ORDER BY `rate` DESC, id ASC");
				if (!empty($page_childs)) {
					foreach ($page_childs AS $child) {
						$child_id = $child->id;
						$childs[$child_id] = $child;
					}
				}
			}
			$page->childs = $childs;

			$array[$id] = $page;
		}
		return $array;
	}
}
