<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapkin extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'lapkin/lapkin/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('lapkin_m', 'data');
		signin();
	}
	
	public function index()
	{
		$data['head'] 		= 'E-Lapkin';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Upload Dokumen E-Lapkin';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['unker'] 		= $this->data->get_unker();
		$data['tahun'] 		= $this->data->get_tahun();
		
		$this->load->view('template/default', $data);
	}
	
	public function get_satker(){
        $record = $this->data->get_id($this->uri->segment(4));
		$unker = $this->input->post('unker');
        $satker = $this->data->get_satker($unker);
        if(!empty($satker)){
            //$selected = (set_value('parent')) ? set_value('parent') : '';
			$selected = set_value('satker', $record->satker_id);
            echo form_dropdown('satker', $satker, $selected, "class='form-control select2' name='satker' id='satker'");
        }else{
            echo form_dropdown('satker', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker' id='satker'");
        }
    }
}
