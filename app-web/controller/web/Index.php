<?php
rsf_require_controller('Controller');
class Web_IndexController extends Controller {
	
	public function run() {
		$params = RSF::get_instance()->request->get_params();
        foreach($params as $k=>$v) {
            RSF::get_instance()->request->set_attribute($k,$v);
        }
		return 'Web_Index';
	}
}
