<?php

rsf_require_view('View');

abstract class Plugin extends View{
	final public function __construct($data=array()) {
	    RSF::get_instance()->debug("import plugin");
		$this->include_template($this->get_content(),'plugin');
	}
}


?>