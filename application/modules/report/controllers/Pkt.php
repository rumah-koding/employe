<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkt extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */

	public $folder = 'report/pkt/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pkt_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','3'));
	}
	
	public function index()
	{
		$data['head'] 		= 'Daftar Nominatif Pangkat SOPD';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_list()
    {
        $record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
            $col[] = $row->kode;
			$col[] = $row->satker;
			
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="edit_data();" href="'.site_url('report/pkt/detail/'.$row->id).'" data-toggle="tooltip" title="Lihat" target="_blank"><i class="fa fa-file-text"></i></a>
                  ';
            $data[] = $col;
		}
		
        $output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->data->count_all(),
			"recordsFiltered" => $this->data->count_filtered(),
			"data" => $data,
        );
        
		echo json_encode($output);
    }
	
	public function detail($id)
	{
		$satker = $this->data->get_satker($id);
		$data['head'] 		= $satker ? $satker->satker : 'Daftar Nominatif Pangkat';
		$data['record'] 	= $this->data->get_record($satker->kode);
		$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$this->load->view($data['content'], $data);
	}
	
	// public function analisa($id)
	// {
	// 	$satker = $this->data->get_satker($id);
	// 	$data['head'] 		= $satker ? 'ANALISA JABATAN - '.$satker->satker : 'ANALISA JABATAN';
	// 	$data['record'] 	= $this->data->get_pkt($id);
	// 	$data['content'] 	= $this->folder.'analisa';
	// 	$data['style'] 		= $this->folder.'style';
	// 	$data['js'] 		= $this->folder.'js';
	// 	$this->load->view('template/default', $data);
	// }
}