<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user_test
 *
 * @author HacRi
 */
class user_test extends CI_Controller {

    function findone() {
        $this->load->model('user_m');
        $tmp = $this->input->get('name');
        var_dump($this->user_m->get_user_by_name($tmp));
    }

    function createuser() {
        $this->load->library('Mongo_db');

        $result = $this->mongo_db
                ->where(array(
                    'name' => 'admin'
                ))
                ->get('user_class');

        var_dump($result[0]['_id']);

        $post = array(
            "name" => "admin",
            "nickname" => "管理员",
            "class" => $result[0]['_id']
        );

        $this->mongo_db->insert('user', $post);
    }

    function creatclass() {
        $m = new Mongo();
        $db = $m->share_test;
        $collection = $db->user_class;

        $post = array(
            "name" => "admin",
            "allows" => array(
                "allow_login" => 1,
                "allow_admin" => 1,
                "allow_nickname" => 1,
                "allow_post" => 1,
                "allow_direct_release" => 1
            )
        );

        $collection->insert($post);
    }

}

?>
