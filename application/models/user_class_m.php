<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user_class_m
 *
 * @author HacRi
 */
class user_class_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('mongo_db');
    }

    function get_userclass_by_id($id) {
        $result = $this->mongo_db
                ->where(array('_id' => $id))
                ->get('user_class');

        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }
    
    function get_all_userclass(){
        $result = $this->mongo_db
                ->get('user_class');
        return $result;
    }
    

}

?>
