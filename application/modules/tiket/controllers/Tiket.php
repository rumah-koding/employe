<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {
	public $folder 	= 'tiket/';
	public $page	= 'tiket/';
	public $table	= 'tiket';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tiket_m');
		$this->load->helper('my_helper');
		$this->load->library('tikets');
		signin();
		group(array('1','2','3'));
	}
	
	public function index()
	{
		$data['head'] 		= 'Layanan Informasi dan Pengaduan Sistem Kepegawaian';
		$data['record']	 	= $this->tiket_m->get_record();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view('template/default', $data);
	}
	
	public function created()
	{
		$this->load->library('upload');
        $namafile = "file_".time(); //nama file + fungsi time
        $config['upload_path'] = './uploads/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|doc|docx|xls|xlsx'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '51200'; //maksimum besar file 10M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $namafile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        
        //if (isset($_FILES['files']) && !empty($_FILES['files']['name']))
        if (isset($_FILES['files']) && !empty($_FILES['files']['name']))
        {
        	if ($this->upload->do_upload('files'))
        	{
        		$gambar = $this->upload->data();
        		$data = array(
        			'kode' => $this->tiket_m->kode_tiket(),
        			'subjek' => $this->input->post('subjek'),
        			'kategori_id' => $this->input->post('kategori'),
        			'informasi' => $this->input->post('informasi',FALSE),
        			'file' => $gambar['file_name'],
        			'status' => '1',
        			'user_id' => $this->session->userdata('login_id'),
        			'unitkerja_id' => $this->session->userdata('unitkerja'),
        			'created_at' => date('Y-m-d H:i:s')
				);

        		if($this->_compose()){
        			$insert = $this->tiket_m->insert_tiket($data);
        			if($insert)
        			{
						$config = array(); 
						$config['charset'] 	= 'utf-8'; 
						$config['protocol'] 	= 'smtp';  
						$config['smtp_host'] 	= 'ssl://palapa4.lazeon.com';  
						$config['smtp_user'] 	= 'info@simpel.kalselprov.go.id';  
						$config['smtp_pass'] 	= 'pdehumas@)!^';  
						$config['smtp_port'] 	= 465; 
						$config['mailtype']	= "html"; 
        				$config['crlf']		= "\r\n";
        				$config['newline']	= "\r\n";
        				$config['wordwrap'] 	= TRUE; 
						
						$this->load->library('email', $config);
						
						$broadcast = $this->tiket_m->get_emails();
						if($broadcast){
							foreach($broadcast as $row){
								$this->email->clear();
								$this->email->to($row->email);
								$this->email->from($this->session->userdata('login_email'));
								$this->email->subject('Tiket [#'.$data['kode'].']-'.$this->input->post('subjek'));
								$this->email->message('PDE HUMAS'.'<br>'.$this->input->post('informasi'));
								$this->email->send();
							}
						}
						$this->session->set_flashdata('flashconfirm','Tiket berhasil di kirim');
						redirect($this->page);
					}else{
						$this->session->set_flashdata('flashconfirm','Ada kesalahan dalam pengeolahan data, hubungi administrator');
						redirect($this->page);
					}
				}
			}else{
                $this->session->set_flashdata('flashconfirm','Ada kesalahan dalam pengeolahan data, hubungi administrator');
                redirect('tiket/created'); //jika gagal maka akan ditampilkan form upload
            }
        }else{

        	$data = array(
					'kode' => $this->tiket_m->kode_tiket(),
					'subjek' => $this->input->post('subjek'),
					'kategori_id' => $this->input->post('kategori'),
					'informasi' => $this->input->post('informasi',FALSE),
					'file' => '',
					'status' => '1',
					'user_id' => $this->session->userdata('login_id'),
					'unitkerja_id' => $this->session->userdata('unitkerja'),
					'created_at' => date('Y-m-d H:i:s')
        	);

        	if($this->_compose()){
        		$insert = $this->tiket_m->insert_tiket($data);
        		if($insert)
        		{
							$config = array(); 
	        				$config['charset'] 	= 'utf-8'; 
							$config['protocol'] 	= 'smtp';  
							$config['smtp_host'] 	= 'ssl://palapa4.lazeon.com';  
							$config['smtp_user'] 	= 'info@simpel.kalselprov.go.id';  
							$config['smtp_pass'] 	= 'pdehumas@)!^';  
							$config['smtp_port'] 	= 465; 
							$config['mailtype']	= "html"; 
	        				$config['crlf']		= "\r\n";
	        				$config['newline']	= "\r\n";
	        				$config['wordwrap'] 	= TRUE;
						
						$this->load->library('email', $config);
						
						$broadcast = $this->tiket_m->get_emails();
						if($broadcast){
							foreach($broadcast as $row){
								$this->email->clear();
								$this->email->to($row->email);
								$this->email->from($this->session->userdata('login_email'));
								$this->email->subject('Tiket [#'.$data['kode'].']-'.$this->input->post('subjek'));
								$this->email->message('PDE HUMAS'.'<br>'.$this->input->post('informasi'));
								$this->email->send();
							}
						}
						
						$this->session->set_flashdata('flashconfirm','Tiket berhasil di kirim');
						redirect($this->page);
					}else{
						$this->session->set_flashdata('flashconfirm','Ada kesalahan dalam pengeolahan data, hubungi administrator');
						redirect($this->page);
					}
				}
			}

			$data['head'] 		= 'Buka Tiket Layanan Informasi dan Pengaduan Sistem Kepegawaian';
			$data['content']	= $this->folder.'form';
			$data['js']			= $this->folder.'js';
            $data['kategori']	= $this->tiket_m->get_kategori();

			$this->load->view('template/default', $data);
		}

		public function read($id)
		{
		//ini_set('max_execution_time', 150);

			$record = $this->tiket_m->get_tiket($id);
			if(!$record){
				redirect($this->page);
			}

			$tanggapan = $this->input->post('tanggapan');
			if(isset($tanggapan) && $tanggapan != ''){
				$data = array(
					'tanggapan' => $tanggapan,
					'user_id' => $this->session->userdata('login_id'),
					'unitkerja_id'=> $this->session->userdata('unitkerja'),
					'tiket_id' => $id,
					'created_at' => date('y-m-d H:i:s')
					);
				$insert = $this->tiket_m->insert_komentar($data);
				if($insert)
				{
				//konfigurasi email
				$config = array(); 
				$config['charset'] 	= 'utf-8'; 
				$config['protocol'] 	= 'smtp';  
				$config['smtp_host'] 	= 'ssl://palapa4.lazeon.com';  
				$config['smtp_user'] 	= 'info@simpel.kalselprov.go.id';  
				$config['smtp_pass'] 	= 'pdehumas@)!^';  
				$config['smtp_port'] 	= 465; 
				$config['mailtype']	= "html"; 
				$config['crlf']		= "\r\n";
				$config['newline']	= "\r\n";
				$config['wordwrap'] 	= TRUE;
				
				$this->load->library('email', $config);
				
				$broadcast = $this->tiket_m->get_email($id);
				if($broadcast){
					foreach($broadcast as $row){
						$this->email->clear();
						$this->email->to($row->email);
						$this->email->from($this->session->userdata('login_email'));
						$this->email->subject('Re Tiket [#'.$row->kode.']-'.$row->subjek);
						$this->email->message('PDE HUMAS'.'<br>'.$this->input->post('tanggapan'));
						$this->email->send();
					}
				}
				$this->session->set_flashdata('flashconfirm','Tiket berhasil di komentari');
				//redirect($this->page);
				redirect($this->page.'read/'.$id);
			}else{
				$this->session->set_flashdata('flashconfirm','Ada kesalahan dalam pengeolahan data, hubungi administrator');
				//redirect($this->page);
				redirect($this->page.'read/'.$id);
			}
		}
		
		$data['title']		= 'Data '.$this->title;
		$data['content']	= $this->folder.'read';
		$data['js']			= $this->folder.'js';
		$data['record']		= $this->tiket_m->get_tiket($id);
		$data['komentar']	= $this->tikets->komentar($id);
		
		$this->load->view('template', $data);
	}
	
	public function close($id)
	{
		$record = $this->tiket_m->get_tiket($id);
		if(!$record){
			redirect($this->page);
		}else{
			$update = $this->tiket_m->close_tiket($id);
			if($update){
				//redirect($this->page);
				redirect($this->page.'read/'.$id);
			}else{
				redirect($this->page.'read/'.$id);
			}
		}
	}
	
	private function _compose(){
		$rules = array(
			'kategori' => array(
				'field' => 'kategori',
				'label' => 'Kategori',
				'rules' => 'trim|required'
				),
			'subjek' => array(
				'field' => 'subjek',
				'label' => 'Subjek',
				'rules' => 'trim|required|min_length[4]|max_length[100]'
				),
			'informasi' => array(
				'field' => 'informasi',
				'label' => 'Informasi',
				'rules' => 'trim|required'
				)
			
			);
		
		$this->form_validation->set_rules($rules);
		return $this->form_validation->run();
	}
}
