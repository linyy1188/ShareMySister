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
        
        if(!$this->share_auth->is_allow('allow_post'))
            redirect('login');
        
        $csses = array('upload.css');
        $head_data['csses'] = $csses;
        $this->load->view('header', $head_data);
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
