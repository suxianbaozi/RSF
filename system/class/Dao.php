<?php
class Dao {
    abstract public function get_table_name ();
    abstract public function get_pk_id();
    abstract public function get_db_name();
    public $pdo;
    final public function __construct($db_type='slave') {
        $db_config = RSF::get_instance()->get_config('db','database');
        $cur_db_config = $db_config[$this->get_db_name()][$db_type];
        if($cur_db_config) {
            $this->dbo = RSF::get_instance()->get_pdo($cur_db_config);
        } else {
            return false;
        }
    }
    public function get_by_id($id) {
        
    }
    public function get_by_where($where) {
        
    }
    public function update_by_id($id) {
        
    }
    public function update_by_where($where) {
        
    }
    public function insert($data) {
        
    }
    public function exeSQL($sql,$data) {
        
    }
}
