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

    /**
     * 根据id查找用户组
     * @param type $id
     * @return array
     */
    function get_userclass_by_id($id) {
        $result = $this->mongo_db
                ->where(array('_id' => $id))
                ->get('user_class');

        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

    /**
     * 返回搜索用户组
     * @return array
     */
    function get_all_userclass() {
        $result = $this->mongo_db
                ->get('user_class');
        return $result;
    }

    /**
     * 创建用户组
     * @param type $name
     * @param int $allows
     */
    function create_userclass($name, $allows) {
        if (!is_array($allows))
            $allows = array($allows => 1);

        $post = array(
            'name' => $name,
            'allows' => $allows
        );

        $this->mongo_db
                ->insert('user_class', $post);
    }

}

?>
