<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/folder/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('folder_m', 'data');
		signin();
		group(array('1'));
		//if(!isset($_SESSION)) session_start();
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		$data['head'] 		= 'Manajemen File';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		//$_SESSION["RF"]["subfolder"] ="folder1";
		//$_SESSION["RF"]["subfolder"] ="folder1";
		$array = array("RF"=>array(
			  "subfolder"=>"folder1"
			)
		  );
		$this->session->set_userdata($array);
		var_dump($_SESSION);
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		ini_set('memory_limit', '-1');
		$record = $this->data->get_all();
		foreach($record as $row){
			$path = 'source/'.$row->nip;
			$user_name = 'www-data';
			if (!file_exists($path)) {
				mkdir($path, 0755, true);
				chown($path, $user_name);
			}	
		}
		redirect('setting/folder');
	}
}
