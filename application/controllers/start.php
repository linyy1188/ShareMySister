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


	public function index(){
		$data_head=null;
		$data_head['csses'] = array('reset.css', 'main.css', 'footer.css', 'home.css');
		$data_head['jses'] = array('jquery-1.8.1.min.js', 'searchbar.js', 'shareswitch.js', 'custom_search.js');
		
		$this->load->model('file_m','', FALSE);//load the model
		$file_most = $this->file_m->get_files_by('view_times', 'DESC', 5);
		$data_head['file_most'] = $file_most;

		$this->load->view('header',$data_head);
		$this->load->view('searchbar',$data_head);
		$this->load->view('footer');
	}
	public function search($word, $type, $page_id){
		$data_head=null;
		$data_head['csses'] = array('reset.css', 'main.css', 'footer.css','get.css');


		$this->load->view('header',$data_head);
		if (!$type||$type == '全部')
			$type = null;
		if (is_numeric($page_id))
			$page_id = $page_id + 0;
		else
		{
			show_error('Wrong URI');
			die();
		}
		if ($word&&$page_id){
			$pagesize = 7;
			$this->load->model('file_m','',FALSE);
			$query_result = $this->file_m->search_file_name($word, $type, $pagesize, ($page_id-1)*$pagesize);
			//start page using a helper function
			//I don't know whether it is correct.
			$this->load->library('pagination');
			$config['base_url'] = '/index.php/start/search';
			$config['total_rows'] = count($query_result);
			$config['per_page'] = $pagesize;
			$links = $this->pagination->create_links();
			//$query_result['pagination'] = $links;//page
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