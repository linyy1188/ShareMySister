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
		$data_head['jses'] = array('jquery-1.8.1.min.js', 'searchbar.js', 'shareswitch.js');

		$this->load->model('file_m','', FALSE);//load the model
		$file_most = $this->file_m->get_files_by('view_times', 'DESC', 5);
		$data_head['file_most'] = $file_most;
		$this->load->view('header',$data_head);
		$this->load->view('searchbar');
		$word = $this->input->get('word');
		$type = $this->input->get('type');
		if (!$type||$type == 'all')
			$type = null;
		if (is_numeric($page_id))
			$page_id = $page_id + 0;
		if ($word||($page&&$page_id)){//if it is a page or there exists a query word.
			$pagesize = 7;
			$query_result = $this->file_m->search_file_name($word, $type, $pagesize, ($page_id-1)*$pagesize);
			echo var_dump($query_result);
			//start page using a helper function
			//I don't know whether it is correct.
			$this->load->library('pagination');
			$config['base_url'] = 'index.php/index/';
			$config['total_rows'] = count($query_result);
			$config['per_page'] = $pagesize;
			$links = $this->pagination->create_links();
			$query_result['pagination'] = $links;//page
			//
			if ($config['total_rows'] == 0)
				echo 404;
			else
				foreach ($query_result as $result) {
					$this->load->view('questget', $result);
				}
		}
			$this->load->view('footer');
	}
}
?>