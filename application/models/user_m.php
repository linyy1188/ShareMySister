<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user
 *
 * @author HacRi
 */
class user_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('mongo_db');
    }

    function get_user_by_id($id) {
        $result = $this->mongo_db
                ->where(array('_id' => $id))
                ->get('user');

        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

    function get_user_by_name($name) {
        $result = $this->mongo_db
                ->where(array('name' => $name))
                ->get('user');

        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

    function creat_user($name, $origin = 1, $pwd = "", $nickname = null, $class = null, $allows = null) {
        if(is_null($nickname))
            $nickname = $name;
        
    }

}

?>
