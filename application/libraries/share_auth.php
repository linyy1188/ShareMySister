<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of share_auth
 *
 * @author HacRi
 */
class share_auth {

    protected $_CI;
    private $user_data;

    function __construct() {
        $this->_CI = & get_instance();
        $this->_CI->load->library('session');
        $this->_CI->load->model('user_m');
    }

    /**
     * 根据session的信息返回/验证用户信息
     */
    function valid_user() {
        if (!$this->_CI->session->userdata('uid')
                || !$this->_CI->session->userdata('hash'))
            return FALSE;

        $uid = new MongoId($this->_CI->session->userdata('uid'));
        $hash = $this->_CI->session->userdata('hash');

        $user_data = $this->_CI->user_m->get_user_by_id($uid);

        if ($user_data == null) {
            return FALSE;
        }
        $valid_hash = $this
                ->generate_hash($uid->{'$id'}, $user_data['pwd'], $user_data['logtime']->sec);

        if ($hash != $valid_hash) {
            $this->logout();
            return FALSE;
        }

        $this->user_data = $user_data;
        return true;
    }

    function set_valid_user($uid, $pwd, $lgtime) {
        $hash = $this->generate_hash($uid->{'$id'}, $pwd, $lgtime->sec);
        $sess_data = array(
            'uid' => $uid->{'$id'},
            'hash' => $hash
        );
        $this->_CI->session->set_userdata($sess_data);
    }

    /**
     * 根据相关信息生成验证hash
     * 
     * @param type $uid
     * @param type $pwd
     * @param type $lgtime
     * @return type
     */
    function generate_hash($uid, $pwd, $lgtime) {
        $salt1 = $this->_CI->config->item('salt1');
        $salt2 = $this->_CI->config->item('salt2');
        $hash = $uid + $salt1 + $pwd + $salt2 + $lgtime;
        return sha1($hash);
    }

    function is_logged_in() {
        if ($this->valid_user()) {
            if ($this->is_allow("allow_login"))
                return TRUE;
            else
                return FALSE;
        }else {
            return FALSE;
        }
    }

    /**
     * 判断权限
     * 
     * 如果不使用is_logged_in，则不会判断当前登录用户是否有登录权限
     * @param type $item
     * @return boolean
     */
    function is_allow($item) {
        if (is_null($this->user_data))
            if (!$this->valid_user()) // 若没有userdata则判断session信息
                return FALSE;

        // 判断用户权限
        if (array_key_exists($item, $this->user_data['allows'])) {
            if ($this->user_data['allows'][$item] == 1) {
                return TRUE;
            } else if ($this->user_data['allows'][$item] == 0) {
                return FALSE;
            }
        }

        // 判断用户组权限
        $this->_CI->load->model('user_class_m');
        $user_class_data =
                $this->_CI->user_class_m
                ->get_userclass_by_id($this->user_data['class']);

        if (array_key_exists($item, $user_class_data['allows'])) {
            if ($user_class_data['allows'][$item] == 1)
                return TRUE;
            else
                return FALSE;
        }else {
            return FALSE;
        }
    }

    function login($uname, $pwd, $sess_expira_time = 7200) {
        $this->logout();

        $user_data = $this->_CI->user_m->get_user_by_name($uname);
        if ($user_data == null)
            return FALSE; // 用户名不存在

        $this->user_data = $user_data;

        if ($user_data['origin'] == 1) {
            if (!$this->is_allow("allow_login")) {
                return FALSE; // 用户被禁止登录
            }
            if (sha1($pwd) == $user_data['pwd']) {
                $uid = $user_data['_id'];
                $newlogtime = $this->_CI->user_m->set_logtime($uid);
                if ($newlogtime != FALSE) {
                    $this->_CI->session->set_expiretime($sess_expira_time);
                    $this->set_valid_user($uid, $pwd, $newlogtime);
                    return TRUE;
                } else {
                    return FALSE; // 登记登录错误
                }
            } else {
                return FALSE; // 密码错误
            }
        } else {
            return FALSE; // 非原生用户
        }
    }

    function logout() {
        $this->_CI->session->unset_userdata('uid');
        $this->_CI->session->unset_userdata('hash');
    }

}

