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
		$this->load->library('session');
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
			$col[] = $row->unker;
			$col[] = $row->instan;
            
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="" href="#" data-toggle="tooltip" title="Lihat"><i class="fa fa-sitemap"></i></a>
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
		
		$nunker = $this->data->get_nunker($id);
		
		$data['head'] 		= $nunker ? 'SOTK - '.$nunker : 'SOTK';
		$data['record'] 	= $this->data->get_all();
		$data['satker'] 	= $this->data->get_nested();
		$data['content'] 	= $this->folder.'tree';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
}
