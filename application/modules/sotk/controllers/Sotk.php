<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sotk extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	public $folder = 'sotk/sotk/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sotk_m', 'data');
		signin();
	}
	
	public function index()
	{
		$data['head'] 		= 'Susunan Organisasi Tata Kerja';
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
			$col[] = '';
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="" href="'.site_url('sotk/tree/'.$row->kode).'" data-toggle="tooltip" title="Lihat"><i class="fa fa-sitemap"></i></a>
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
	
	public function tree($id)
	{
		
		//$satker = $this->data->get_satker($id);
		// $data['head'] 		= $satker ? 'SOTK - '.$satker : 'SOTK';
		// $data['record'] 	= $this->data->get_all();
		// $data['satker'] 	= $this->data->get_nested($id);
		$data['content'] 	= $this->folder.'tree';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		//$data['struktur'] 	= $this->data->get_record_by($id);
		$data['struktur']	= $this->data->get_struktur($id);
		//var_dump($data['struktur']);
		$this->load->view('template/default', $data);
	}
}
