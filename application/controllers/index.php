<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
*index page of the website
*
*@author cdowen
*
*/

class index extends CI_Controller{

	/**
	*index page and search
	*/
	function index($page = null, $page_id = null){
		$data_head=null;
		$data_head['csses'] = array('reset.css', 'main.css', 'footer.css', 'home.css');
		$data_head['jses'] = array('searchbar.js', 'shareswitch.js');
		$this->load->model('file_m', '', TRUE);
		$file_most = $this->file_m->get_file_by('view_times', 'DESC', 5);
		$data_head['file_most'] = $file_most;
		$this->load->view('header',$data_head);
		$this->load->view('home');
		$word = $this->input->get('word');
		$type = $this->input->get('type');
		if (!$type)
			$type = null;
		if ($words||($page&&is_numeric($page_id)){
			$data = $this->file_m->search_file_name($word, $type, 8, ($page_id-1)*8);
			$this->load->view('questget',$data);

			$this->load->library('pagination');
			$config['base_url'] = 'index.php/index/'
			$config['total_rows'] = count($data);
			$config['per_page'] = 8;
			echo $this->pagination->create_links();
		}
		$this->load->view('footer');
	}
}
?>