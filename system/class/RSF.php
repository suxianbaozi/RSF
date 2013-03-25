<?php
rsf_require_class('Request');
rsf_require_class('Response');

class RSF {
	public $request;
	private $debug_list = array();
	public function __construct() {
		$this->debug('rsf loaded');
	}
	public static $my;
	public static function get_instance() {
		if(!self::$my) {
			self::$my = new RSF();
		}
		return self::$my;
	}
	public function run() {
		
		$this->debug("request");
		if(!$this->request) {
			$this->request = new Request();
		}
		$this->debug("response");
		if(!$this->response) {
			$this->response = new Response();
		}
		
		$this->debug("get router");
		$uri = $this->request->get_uri_path();
		$this->debug($uri);
		$this->debug("get controller");
		$controller = $this->get_controller($uri);
		$this->debug($controller);
		rsf_require_controller($controller);
		$controller .= 'Controller';
		$ctl = new $controller();
		$this->debug("controller run");
		$view = $ctl->run();
		if($view) {
			rsf_require_view($view);
			$view_name = $view.'View';
			$view = new $view_name();
			$this->debug("build html");
			$view->build_container();	
		}
		
		$this->show_debug_message();
	}
	public function setRequest($request) {
		$this->request = $request;
	}
	
	private function get_controller($uri) {
		$router = $this->get_config('router','router');
		
		foreach($router as $k=>$v) {
			foreach($v as $reg) {
				$reg = '/'.$reg.'/';
				if(preg_match_all($reg, $uri,$result)) {
					$matchs = array();
					foreach($result as $m) {
						foreach($m as $ma) {
							$matchs[] = $ma;
						}
					}
					$this->request->set_matchs($matchs);
					return $k;
				}
				
			}
		}
		return 'NotFound';
	}
	
	public function get_config($key,$file='common') {
		global $CONFIG_PATH;
		foreach($CONFIG_PATH as $k=>$v) {
			$config_path = $v.'/'.$file.'.php';
			if(file_exists($config_path)) {
				require $config_path;
			}
		}
		return $config[$key];
	}
	public function setResponse($response) {
		$this->response = $response;
	}
	public function debug($str) {
		$this->debug_list[] = $str;
	}
	
	public function show_debug_message() {
		if($this->request->is_debug) {
			$t_head = '<table border=1 style="font-size:12px; margin-top:20px;">';
            $t_head.='<tr><td>RSF Debug Message:</td></tr>';
			foreach($this->debug_list as $str) {
				$t_head .= '<tr><td>'.$str.'</td></tr>';
			}
			$t_end = '</table>';
			$t_head.=$t_end;
			echo $t_head;
		}
	}
    private $pdo_list = array();
    public function get_pdo($config) {
        $key = md5($config['db'].$config['host'].$config['port'].$config['user']);
        if($this->pdo_list[$key]) {
            return $this->pdo_list[$key];
        } else {
            $db_string = 'mysql:host='.$config['host'].';port='.$config['port'].';dbname='.$config['db'];
            $this->debug($db_string);
            $pdo  =  new PDO($db_string, $config['user'], $config['pass']);
            $pdo->exec("SET CHARACTER SET utf8");
            $this->pdo_list[$key] = $pdo;
            return $pdo;
        }
    }
}
?>
