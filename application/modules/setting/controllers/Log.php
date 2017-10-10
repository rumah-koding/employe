<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/log/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('log_m', 'data');
		signin();
		group(array('1','2','3'));
	}
	
	//halaman index
	public function index()
	{
		$data['head'] 		= 'Log Aktivitas Pengguna';
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
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->log_id.'">';
            $col[] = $row->log_user;
			$col[] = $row->log_time;
			$col[] = $row->log_desc;
			$col[] = $row->log_ip;
			
            
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
}
