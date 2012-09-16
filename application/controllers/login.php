<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of login
 *
 * @author HacRi
 */
class login extends CI_Controller {

    function index() {
        $this->share_auth->login('admin', 'admin');
        echo 'ok';
    }

}
