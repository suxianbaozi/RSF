<?php
rsf_require_view("view");
rsf_require_view("Frame");

class Web_IndexView extends FrameView {

	public function get_content(){
        $attrs = RSF::get_instance()->request->get_attributes();
        $this->set_data('params', $attrs);
		return 'Web_Index';
	}
	
	public static function get_css_list() {
		return array_merge(parent::get_css_list(), 
		array(
			'Web_Index'
		));
	}
	
	public static function get_js_list() {
		return array_merge(
		parent::get_js_list(),
		array(
			'Web_Index'
		));
	}
}
