<?php
class Request {
	private $matchs;
	public $is_debug;
	final public function __construct() {
		$this->is_debug = $this->is_debug();
	}
	
	final public function is_debug() {
		$params = $this->get_params();
		if(isset($params['debug'])) {
			if($params['debug']==1) {
				return true;
			} else {
				return false;
			}
		} else {
			if($this->get_cookie('debug')==1) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	public function get_cookie($key) {
		return $_COOKIE[$key];
	}
	public function get_cookies() {
		return $_COOKIE;
	}
	public function get_params() {
		$params = array();
		foreach($_GET as $key=>$v) {
			$params[$key] = $v;
		}
		foreach($_POST as $key=>$v) {
			$params[$key] = $v;
		}
		return $params;
	}
	public function get_uri_path() {
		return $_SERVER['REDIRECT_URL'];
	}
	public function set_matchs($matchs) {
		$this->matchs = $matchs;
	}
	public function get_matchs() {
		return $this->matchs;
	}
    public $attr = array();
    public function set_attribute($key,$value) {
        $this->attr[$key] = $value;
    }
    public function get_attributes() {
        return $this->attr;
    }
    public function get_attribute($key) {
        return $this->attr[$key];
    }
}

