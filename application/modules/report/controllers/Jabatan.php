<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/jabatan/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','3'));
	}
	
	public function index()
	{
		ini_set('memory_limit', '-1');
		$data['head'] 		= 'Daftar Nominatif Pegawai Berdasarkan Tingkat Jabatan';
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['record']		= $this->data->get_record();

		$this->load->view($data['content'], $data);
	}

	public function sopd($kode=null)
	{
		$data['head'] 		= 'Daftar Nominatif Pegawai Berdasarkan Tingkat Jabatan';
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['nip']		= $this->uri->segment(3);

		$this->load->view($data['content'], $data);
	}

	public function barcode($kode)
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode($kode);
	}
	
	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
}
