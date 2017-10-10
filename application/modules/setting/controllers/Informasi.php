<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/informasi/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('informasi_m', 'data');
		$this->load->helper('my_helper');
		signin();
		group(array('1'));
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		$data['head'] 		= 'Pengaturan Pengguna';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Pengaturan Pengguna';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['unker'] 		= $this->data->get_unker();
		$data['group'] 		= $this->data->get_group();
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id)
	{
		$data['head'] 		= 'Ubah Pengaturan Pengguna';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['unker'] 		= $this->data->get_unker();
		$data['group'] 		= $this->data->get_group();
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_list()
    {
        ini_set('memory_limit', '-1');
		$record	= $this->data->get_datatables();
        $data 	= array();
        $no 	= $_POST['start'];
		
        foreach ($record as $row) {
            $no++;
            $col = array();
            $col[] = '<input type="checkbox" class="data-check" value="'.$row->id.'">';
            $col[] = $row->judul;
			$col[] = $row->informasi;
			$col[] = ddmmyyyy($row->tanggal);
            
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('setting/informasi/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" title="Hapus" onclick="deleted('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
 
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
	
	public function ajax_save()
    {
        $data = array(
                'judul' => $this->input->post('judul'),
				'informasi' => $this->input->post('informasi'),
				'tanggal' => $this->input->post('tanggal'),
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Pengaturan Pengguna");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'judul' => $this->input->post('judul'),
				'informasi' => $this->input->post('informasi'),
				'tanggal' => $this->input->post('tanggal'),
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Pengaturan Pengguna");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Pengaturan Pengguna");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Pengaturan Pengguna");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation($id=null)
    {
        $data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("judul", "Judul Informasi", "trim|required");
		$this->form_validation->set_rules("informasi", "Informasi", "trim|required");
		$this->form_validation->set_rules("tanggal", "Tanggal", "trim|required");
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if($this->form_validation->run()){
            $data['success'] = true;
        }else{
            foreach ($_POST as $key => $value) {
                $data['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($data);
        return $this->form_validation->run();
    }
}
