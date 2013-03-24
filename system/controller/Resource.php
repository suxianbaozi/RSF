<?php

rsf_require_controller("Controller");

class ResourceController extends Controller {
	public function run() {
		$matchs  = RSF::get_instance()->request->get_matchs();
		$type = $matchs[2];
		$class = $matchs[3];
		$header_type = $type=='css'?'css':'javascript';
		RSF::get_instance()->response->header('Content-Type','text/'.$header_type.'; charset=utf-8');
		
		rsf_require_view($class);
		$class_name = $class.'View';
		$view = new $class_name();
		if($type=='css') {
			echo $view->get_css_content();
		} else if($type=='js') {
			echo $view->get_js_content();
		}
	}
}
