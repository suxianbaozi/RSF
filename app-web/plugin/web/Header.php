<?php
rsf_require_plugin('Plugin');
class Web_HeaderPlugin extends Plugin {
	public function get_content() {
	    $this->set_data('user', '我是一个变量');
		return 'Web_Header';
	}
    public static function get_css_list() {
        return array(
            'Web_Header'
        );
    }
    public static function get_js_list() {
        return array(
            'Web_Header'
        );
    }
}
