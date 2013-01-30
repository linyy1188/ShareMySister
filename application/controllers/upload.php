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

//        if (!$this->share_auth->is_allow('allow_post'))
//            redirect('login');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('filename', 'File Name', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        $this->form_validation->set_rules('fileinfo', 'File Infomation', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fileaddr', 'File Address', 'trim|required|xss_clean');
        
	$data_head['csses'] = array('reset.css', 'main.css', 'footer.css', 'upload.css');
        $this->load->view('header', $data_head);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('upload_index');
        } else {
            $this->load->view('upload_success');
            _submit();
        }
        $this->load->view('footer');
    }

    function _submit() {
	$this->load->model('file_m','',FALSE);
	$file_name = $this->input->post('filename',TRUE);
	$file_info = $this->input->post('fileinfo', TRUE);
	$file_addr = $this->input->post('fileaddr', TRUE);
	$this->file_m->create_file($file_name,'','', $file_addr, $file_info,'', $upload_user);
    }

}

?>
