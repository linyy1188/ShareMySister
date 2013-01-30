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
        $result = $this->share_auth->login('admin', 'admin');
        if ($result)
	  $this->load->view('login_success');
	else
	  $this->load->view('login');
    }

}
