<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of upload
 *
 * @author HacRi
 */
class upload extends CI_Controller {

    function index() {

        if (!$this->share_auth->is_allow('allow_post'))
            redirect('login');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        
        $csses = array('upload.css');
        $head_data['csses'] = $csses;
        $this->load->view('header', $head_data);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('upload_index');
        } else {
            $this->load->view('upload_success');
        }
        $this->load->view('footer');
    }

    function submit() {
        $m = new Mongo();

        $db = $m->test;
        $collection = $db->blog;

        $obj = array('title' => "c and i", "author" => "bill", "date" => new MongoDate());

        $collection->insert($obj);

        $cursor = $collection->find();

        foreach ($cursor as $obj) {
            echo $obj['title'] . "\n";
        }
    }

}

?>
