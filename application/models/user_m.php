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

    /**
     * 通过用户ID获得用户信息
     * 
     * @param type $id
     * @return array
     */
    function get_user_by_id($id) {
        $result = $this->mongo_db
                ->where(array('_id' => $id))
                ->get('user');

        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

    /**
     * 通过用户名获取用户信息
     * 
     * @param type $name
     * @return array
     */
    function get_user_by_name($name) {
        $result = $this->mongo_db
                ->where(array('name' => $name))
                ->get('user');

        if (count($result) > 0)
            return $result[0];
        else
            return null;
    }

    /**
     * 设置登录时间并返回
     * 
     * 登录验证用
     * @param type $uid
     * @return \MongoDate|boolean
     */
    function set_logtime($uid) {
        $logtime = new MongoDate(strtotime("now"));
        $result = $this->mongo_db
                ->where(array('_id' => $uid))
                ->set('logtime', $logtime)
                ->update('user');
        if ($result)
            return $logtime;
        else
            return FALSE;
    }

    /**
     * 创建用户
     * @param type $name
     * @param type $origin
     * @param type $pwd
     * @param type $nickname
     * @param type $class
     * @param int $allows
     */
    function create_user($name, $origin = 1, $pwd = "", $nickname = null, $class = null, $allows = null) {
        if (is_null($nickname))
            $nickname = $name;
        if (!is_array($allows))
            $allows = array($allows => 1);
        if ($class == null)
            $class = -1;

        $pwd = sha1($pwd);
        $post = array(
            'name' => $name,
            'origin' => $origin,
            'pwd' => $pwd,
            'nickname' => $nickname,
            'class' => $class,
            'allows' => $allows
        );
        
        $this->mongo_db
                ->insert('user',$post);
    }

}

?>
