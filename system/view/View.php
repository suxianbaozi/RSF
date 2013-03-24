<?php
abstract class View {
	public function get_title() {
	    $rsf = RSF::get_instance();
		return $rsf->get_config('name').$rsf->get_config('version');
	}
	
	public function build_container() {
	    RSF::get_instance()->debug('build_html_container');
		$this->include_template($this->get_container());
	}
	
	public function build_content() {
	    RSF::get_instance()->debug('build_html_content');
		$this->include_template($this->get_content());
	}
	
	abstract public function get_content();
	
	public function get_container(){
		
	}
	public function get_description() {
		return 'reco frame work';
	}
    
	public function include_template($name,$view='view',$type='phtml') {
	    extract($this->data);
		$path  = rsf_build_path($name,$view);
		$path = CUR_PATH.$path.'.'.$type;
        if(file_exists($path)) { 
            require $path;
        }
	}
    public $data = array();
	public function set_data($key,$value) {
	    $this->data[$key] = $value;
	}
    public function get_class_name() {
        $called = get_called_class();
        return str_replace('View', '', $called);
    }
	public function build_css_url() {
		$source_url = RSF::get_instance()->get_config("source");
		$location = RSF::get_instance()->get_config("location");
		$real_url = $source_url.$location.'/resource/css/'.$this->get_class_name().'.css';
		return $real_url;
	}
	
	public function build_js_url() {
		$source_url = RSF::get_instance()->get_config("source");
		$location = RSF::get_instance()->get_config("location");
		$real_url = $source_url.$location.'/resource/js/'.$this->get_class_name().'.js';
		return $real_url;
	}
	public static function get_css_list() {
		return array();
	}
	public static function get_js_list() {
		return array();
	}
    public static function get_plugin() {
        return array();
    }
	
	public function get_css_content() {
	    $called = get_called_class();
		$css_list = $called::get_css_list();
		foreach($css_list as $v) {
			$this->include_template($v,'view','css');
		}
        
        //插件内的css
        $called = get_called_class();
        $plugin_list = $called::get_plugin();
        
        foreach ($plugin_list as $key => $plugin) {
            $real_name = $plugin.'Plugin';
            $css_list = $real_name::get_css_list();
            foreach($css_list as $v) {
                $this->include_template($v,'plugin','css');
            }
        }
	}
	
	public function get_js_content() {
	    $called = get_called_class();
        $js_list = $called::get_js_list();
		foreach($js_list as $v) {
			$this->include_template($v,'view','js');
		}
        
        //插件内的js
        $called = get_called_class();
        $plugin_list = $called::get_plugin();
        
        foreach ($plugin_list as $key => $plugin) {
            $real_name = $plugin.'Plugin';
            $js_list = $real_name::get_js_list();
            foreach($js_list as $v) {
                $this->include_template($v,'plugin','js');
            }
        }
        
	}
	
	
}
