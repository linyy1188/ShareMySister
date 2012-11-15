<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
*index page of the website
*
*@author cdowen
*
*/

class start extends CI_Controller{

	/**
	*index page and search
	*/


	public function index($page = null, $page_id = null){
		$data_head=null;
		$data_head['csses'] = array('reset.css', 'main.css', 'footer.css', 'home.css');
		$data_head['jses'] = array('searchbar.js', 'shareswitch.js');
		$this->load->model('file_m','', FALSE);//load the model
		$file_most = $this->file_m->get_files_by('view_times', 'DESC', 5);
		$data_head['file_most'] = $file_most;
		$this->load->view('header',$data_head);
		$this->load->view('home');
		$word = $this->input->get('word');
		$type = $this->input->get('type');
		if (!$type||$type == 'all')
			$type = null;
		if (is_numeric($page_id))
			$page_id = $page_id + 0;
		if ($words||($page&&$page_id)){//if it is a page or there exists a query word.
			$pagesize = 7;
			$data = $this->file_m->search_file_name($word, $type, $pagesize, ($page_id-1)*$pagesize);
			$this->load->view('questget', $data);
			//start page using a helper function
			//I don't know whether it is correct.
			$this->load->library('pagination');
			$config['base_url'] = 'index.php/index/';
			$config['total_rows'] = count($data);
			$config['per_page'] = $pagesize;
			$links = $this->pagination->create_links();
			$data['pagination'] = $links;//page
			$this->load->view('questget', $data);
		}
			$this->load->view('footer');
	}
}
?>