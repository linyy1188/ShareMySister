<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of share_auth
 *
 * @author HacRi
 */
class share_auth {

    function __construct() {
        $this->load->library('session');
    }

    /**
     * 根据session的信息返回用户信息
     */
    function valid_user() {
        
    }

    function set_valid_user($uid, $pwd, $lgtime) {
        $hash = $this->generate_hash($uid, $pwd, $lgtime);
        $this->session->set_userdata('uid', $uid);
        $this->session->set_userdata('hash', $hash);
    }

    function generate_hash($uid, $pwd, $lgtime) {
        $salt1 = $this->config->item('salt1');
        $salt2 = $this->config->item('salt2');
        $hash = $uid + $salt1 + $pwd + $salt2 + $lgtime;
        return sha1($hash);
    }

    function is_logged_in() {
        $user = $this->valid_user();
        return (!empty($user) && !empty($user['uid']));
    }

    function login($uname, $pwd) {
        $this->load->model('user_m');
        $user_data = $this->user_m->get_user_by_name($uname);
        if ($user_data == null) {
            return FALSE; // 用户名不存在
        }
        
        if ($user_data->origin == 1) {
            if (sha1($pwd) == $user_data->pwd) {
                $uid = $user_data->_id;
                
                
            } else {
                return FALSE; // 密码错误
            }
        } else {
            return FALSE; // 非原生用户
        }
    }

    function logout() {
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('hash');
    }

}

