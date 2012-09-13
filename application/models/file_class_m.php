<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user_class_m
 *
 * @author HacRi
 */
class file_class_m extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('mongo_db');
    }

}

?>
