<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'data/jabatan/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jabatan_m', 'data');
		$this->load->helper('identitas_helper');
		$this->load->helper('my_helper');
		signin();
		group(array('1','2','4','5'));
	}
	
	//halaman index
	public function index()
	{
		$data 		= array();
		$this->load->view('template/default', $data);
		redirect('data/jabatan/created');
	}
	
	public function created()
	{
		$data['head'] 		= 'Tambah Data Jabatan';
		$data['record'] 	= $this->data->get_new();
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['instansi']	= $this->data->get_instansi();
		$data['eselon']		= $this->data->get_eselon();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function updated($id=null)
	{
		$id = $this->uri->segment(4);
		
		$data['head'] 		= 'Ubah Data Jabatan';
		$data['record'] 	= $this->data->get_id($id);
		$data['content'] 	= $this->folder.'form';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['instansi']	= $this->data->get_instansi();
		$data['eselon']		= $this->data->get_eselon();
		$data['nip']		= $this->session->userdata('nip');
		
		$this->load->view('template/default', $data);
	}
	
	public function ajax_save()
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'instansi_id' => $this->input->post('instansi_id'),
				'instansi' => $this->input->post('instansi'),
				'unker_id' => $this->input->post('unker_id'),
				'unker' => $this->input->post('unker'),
				'satker_id' => $this->input->post('satker_id'),
				'satker' => $this->input->post('satker'),
				'jenis' => $this->input->post('jenis'),
				'jabatan_id' => $this->input->post('jabatan_id'),
				'jabatan' => $this->input->post('jabatan'),
				'sk' => $this->input->post('sk'),
				'tglsk' => yyyymmdd($this->input->post('tglsk')),
				'tmt' => yyyymmdd($this->input->post('tmt')),
				'eselon' => $this->input->post('eselon'),
				'penetapan' => $this->input->post('penetapan'),
				'created_id' => $this->session->userdata('userID')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Data Jabatan");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'nip' => $this->input->post('nip'),
				'instansi_id' => $this->input->post('instansi_id'),
				'instansi' => $this->input->post('instansi'),
				'unker_id' => $this->input->post('unker_id'),
				'unker' => $this->input->post('unker'),
				'satker_id' => $this->input->post('satker_id'),
				'satker' => $this->input->post('satker'),
				'jenis' => $this->input->post('jenis'),
				'jabatan_id' => $this->input->post('jabatan_id'),
				'jabatan' => $this->input->post('jabatan'),
				'sk' => $this->input->post('sk'),
				'tglsk' => yyyymmdd($this->input->post('tglsk')),
				'tmt' => yyyymmdd($this->input->post('tmt')),
				'eselon' => $this->input->post('eselon'),
				'penetapan' => $this->input->post('penetapan'),
				'updated_id' => $this->session->userdata('userID')
            );
		
        if($this->validation($id)){
            $this->data->update($data, $id);
			helper_log("edit", "Merubah Data Jabatan");
        }
    }
    
    public function ajax_delete($id)
    {
        $this->data->delete($id);
		helper_log("trash", "Menghapus Data Jabatan");
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_delete_all()
    {
        $list_id = $this->input->post('id');
        foreach ($list_id as $id) {
            $this->data->delete($id);
			helper_log("trash", "Menghapus Data Jabatan");
        }
        echo json_encode(array("status" => TRUE));
    }
	
	public function trash()
    {
        $id = $this->uri->segment(5);
		$nip = $this->uri->segment(4);
		$this->data->delete($id);
		helper_log("trash", "Menghapus Data Jabatan");
		$this->session->set_flashdata('flashconfirm','Data Jabatan berhasil di hapus!');
        redirect('data/identitas/'.$nip);
    }
	
	private function validation($id=null)
    {
        //$id = $this->input->post('id');
		$data = array('success' => false, 'messages' => array());
        
		if(!isset($id)){
			$this->form_validation->set_rules("instansi", "Instansi Kerja", "trim|required");
			$this->form_validation->set_rules("unker", "Unit Kerja", "trim|required");
			$this->form_validation->set_rules("satker", "Satuan Kerja", "trim|required");
			$this->form_validation->set_rules("jabatan", "Jabatan", "trim|required");
			$this->form_validation->set_rules("sk", "SK Jabatan", "trim|required");
			$this->form_validation->set_rules("tglsk", "Tanggal SK Jabatan", "trim|required");
			$this->form_validation->set_rules("tmt", "TMT Jabatan", "trim|required");
			$this->form_validation->set_rules("eselon", "Tingkat Jabatan", "trim|required");
			$this->form_validation->set_rules("penetapan", "Pejabat Penetapan", "trim|required");
		}else{
			$this->form_validation->set_rules("instansi", "Instansi Kerja", "trim|required");
			$this->form_validation->set_rules("unker", "Unit Kerja", "trim|required");
			$this->form_validation->set_rules("satker", "Satuan Kerja", "trim|required");
			$this->form_validation->set_rules("jabatan", "Jabatan", "trim|required");
			$this->form_validation->set_rules("sk", "SK Jabatan", "trim|required");
			$this->form_validation->set_rules("tglsk", "Tanggal SK Jabatan", "trim|required");
			$this->form_validation->set_rules("tmt", "TMT Jabatan", "trim|required");
			$this->form_validation->set_rules("eselon", "Tingkat Jabatan", "trim|required");
			$this->form_validation->set_rules("penetapan", "Pejabat Penetapan", "trim|required");
		}
        
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
	
	public function ajax_csfr()
    {
        echo json_encode(array("token" => $this->security->get_csrf_token_name(), "key"=>$this->security->get_csrf_hash()));
    }
	
	public function get_unker(){
		$record = $this->data->get_id($this->uri->segment(4));
		$instansi = $this->input->post('instansi');
        $unker = $this->data->get_unker($instansi);
        if(!empty($unker)){
            //$selected = $record ? set_select('unker_id', $record->unker_id) : set_select('unker_id');
			$selected = set_value('unker_id', $record->unker_id);
            echo form_dropdown('unker_id', $unker, $selected, "class='form-control select2' name='unker_id' id='unker_id'");
        }else{
            echo form_dropdown('unker_id', array(''=>'Pilih Unit Kerja'), '', "class='form-control select2' name='unker_id' id='unker_id'");
        }
    }
	
	public function get_satker(){
        $record = $this->data->get_id($this->uri->segment(4));
        $instansi = $this->input->post('instansi');
		$unker = $this->input->post('unker');
        $satker = $this->data->get_satker($instansi, $unker);
        if(!empty($satker)){
            //$selected = (set_value('parent')) ? set_value('parent') : '';
			$selected = set_value('satker_id', $record->satker_id);
            echo form_dropdown('satker_id', $satker, $selected, "class='form-control select2' name='satker_id' id='satker_id'");
        }else{
            echo form_dropdown('satker_id', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker_id' id='satker_id'");
        }
    }
	
	public function get_jabatan(){
        $record = $this->data->get_id($this->uri->segment(4));
        $instansi = $this->input->post('instansi');
		$unker = $this->input->post('unker');
		$satker = $this->input->post('satker');
		$jenis = $this->input->post('jenis');
        $jabatan = $this->data->get_jabatan($instansi, $unker, $satker, $jenis);
        if(!empty($jabatan)){
            //$selected = (set_value('parent')) ? set_value('parent') : '';
			$selected = set_value('jabatan_id', $record->jabatan_id);
            echo form_dropdown('jabatan_id', $jabatan, $selected, "class='form-control select2' name='jabatan_id' id='jabatan_id'");
        }else{
            echo form_dropdown('jabatan_id', array(''=>'Pilih Jabatan'), '', "class='form-control select2' name='jabatan_id' id='jabatan_id'");
        }
    }
	
	//public function update_satker(){
	//	$query = $this->data->get_record_satker();
	//	
	//	foreach($query as $row){
	//			$satker = $this->data->get_satker_id($row->satker_id);
	//			$data = array(
	//				'satkerx' => $satker
	//			);
	//			$this->data->update($data, $row->id);
	//	}
	//}
	//
	//public function update_jabatan(){
	//	$query = $this->data->get_record_jabatan();
	//	
	//	foreach($query as $row){
	//			$jabatan = $this->data->get_jabatan_id($row->posisi_id);
	//			$data = array(
	//				'jabatan_id' => $jabatan
	//			);
	//			$this->data->update($data, $row->id);
	//	}
	//}
}
