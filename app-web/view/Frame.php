<?php
rsf_require_plugin("Web_Header");

abstract class FrameView extends View {
	
	public function get_container() {
		return 'Frame';
	}
	public static function get_css_list() {
		return array(
			'Frame'
		);
	}
	public static function get_js_list() {
		return array(
			'Frame'
		);
	}
    public static function get_plugin() {
        return array(
            'Web_Header'
        );
    }
}
