<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'setting/user/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_m', 'data');
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
		$data['content'] 	= $this->folder.'form_edit';
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
            $col[] = $row->fullname;
			$col[] = $row->username;
			$col[] = $row->email;
			$col[] = $row->unker;
			$col[] = $row->satker;
			$col[] = level($row->level);
			$col[] = $row->active;
            
            //add html for action
            $col[] = '<a class="btn btn-xs btn-flat btn-info" onclick="edit_data();" href="'.site_url('setting/password/updated/'.$row->id).'" data-toggle="tooltip" title="Ganti Password"><i class="fa fa-key"></i></a> <a class="btn btn-xs btn-flat btn-warning" onclick="edit_data();" href="'.site_url('setting/user/updated/'.$row->id).'" data-toggle="tooltip" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
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
                'username' => $this->input->post('username'),
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'telpon' => $this->input->post('telpon'),
				'unker_id' => $this->input->post('unker'),
				'satker_id' => $this->input->post('satker'),
				'level' => $this->input->post('level'),
				'active' => $this->input->post('active')
            );
        
        if($this->validation()){
            $insert = $this->data->insert($data);
			helper_log("add", "Menambah Pengaturan Pengguna");
        }
    }
    
    public function ajax_update($id)
    {
        $data = array(
                'username' => $this->input->post('username'),
				'fullname' => $this->input->post('fullname'),
				'email' => $this->input->post('email'),
				'telpon' => $this->input->post('telpon'),
				'unker_id' => $this->input->post('unker'),
				'satker_id' => $this->input->post('satker'),
				'level' => $this->input->post('level'),
				'active' => $this->input->post('active')
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
        
		if(!isset($id)){
			$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[users.username]");
			$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]|max_length[18]");
			$this->form_validation->set_rules("repassword", "Ulangi Password", "trim|required|matches[password]");
		}else{
			$this->form_validation->set_rules("username", "Username", "trim|required");
		}
        
		$this->form_validation->set_rules("fullname", "Nama Lengkap", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("telpon", "Telpon", "trim|is_natural");
		$this->form_validation->set_rules("unker", "Unit Kerja", "trim");
		$this->form_validation->set_rules("satker", "Satuan Kerja", "trim");
		$this->form_validation->set_rules("level", "Tingkat Pengguna", "trim|required");
		$this->form_validation->set_rules("active", "Status Pengguna", "trim|required");
		
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
