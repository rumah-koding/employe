<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapkin extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'report/lapkin/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('lapkin_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','3'));
	}
	
	public function index()
	{
		$data['head'] 		= 'Laporan E-Lapkin';
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
			

			
			$file = file_lapkin($row->kode);
			$doc = array();
			if($file){
			foreach($file as $y){
				$doc[]= '<a class="btn btn-xs btn-flat btn-success" href="'.base_url('document/e-lapkin/'.$y->dokumen).'" download><i class="fa fa-file-text"></i> '.$y->tahun.'</a> ';
				}
			}
            //add html for action
            $col[] = $doc ? implode(" ", $doc) : '-';
			

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
		
		$data['head'] 		= $satker ? 'E-LAPKIN - '.$satker->satker : 'E-LAPKIN';
		$data['record'] 	= $this->data->get_lapkin($satker->kode);
		$data['content'] 	= $this->folder.'detail';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	// public function analisa($id)
	// {
		
	// 	$satker = $this->data->get_satker($id);
		
	// 	$data['head'] 		= $satker ? 'ANALISA JABATAN - '.$satker->satker : 'ANALISA JABATAN';
	// 	$data['record'] 	= $this->data->get_lapkin($id);
	// 	$data['content'] 	= $this->folder.'analisa';
	// 	$data['style'] 		= $this->folder.'style';
	// 	$data['js'] 		= $this->folder.'js';
		
	// 	$this->load->view('template/default', $data);
	// }
}
