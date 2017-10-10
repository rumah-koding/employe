<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pensiun extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/pensiun/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pensiun_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','3'));
	}
	
	public function index()
	{
		$data['head'] 		= 'Daftar Jaga Pensiun';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['tahun'] 		= $this->data->get_tahun();
		
		$this->load->view('template/default', $data);
	}
	
	public function get_pensiun()
	{
		$tahun = $this->input->post('tahun');
		$data['record']		= $this->data->get_pensiun($tahun);
		$this->load->view('report/pensiun/detail', $data);
	}
}
