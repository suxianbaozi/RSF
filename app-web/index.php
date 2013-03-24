<?php
error_reporting(E_ALL & ~E_NOTICE);
define(ROOT_PATH,dirname(dirname(__FILE__)).'/');
define(SYS_PATH,'../system');
define(CUR_PATH,ROOT_PATH.'app-web');

require_once(SYS_PATH.'/functions.php');

$INCLUDE_PATH = array(
	CUR_PATH,
	ROOT_PATH.'app-core'
);
$CONFIG_PATH = array(
	CUR_PATH.'/config',
	ROOT_PATH.'config',
);

rsf_require_class('RSF');
RSF::get_instance()->run();
