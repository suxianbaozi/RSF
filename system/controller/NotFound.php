<?php
rsf_require_controller("Controller");
class NotFoundController extends Controller {
	public function run() {
		RSF::get_instance()->response->not_found();
		return false;
	}
}
