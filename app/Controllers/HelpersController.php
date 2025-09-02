<?php

namespace app\Controllers;

use app\Db;
use app\Model;
use app\Controller;
use app\Helpers;
use WebPConvert\WebPConvert;


class HelpersController extends Controller
{
	protected function handle(...$parameters)
	{
		if (!empty($parameters)) {
			$action = array_shift($parameters);
			call_user_func_array([$this, $action], $parameters);
		}
	}

	function webp() {

		//WebPConvert::convert(ROOT.'/public/src/img/logo.png', ROOT.'/public/src/img/logo.webp', []);	
	}
}

?>

