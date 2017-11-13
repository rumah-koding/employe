<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sopd extends CI_Controller {

	/**
	 * code by rifqie rusyadi
	 * email rifqie.rusyadi@gmail.com
	 */
	
	public $folder = 'registrasi/sopd/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sopd_m', 'data');
	}
	
	//halaman index
	public function index()
	{
		ini_set('memory_limit', '-1');
		$this->load->helper('captcha');
		$config_captcha = array(
			'img_path'  => './captcha/',
			'img_url'  => base_url('captcha/'),
			'img_width'  => '320',
			'img_height' => 30,
			'word_length' => 4,
			'font_size'   => 30,
			'border' => 1,
			'expiration' => 7200,
			'pool'=> '0123456789',
			'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(210, 214, 222),
                'text' => array(0, 0, 0),
                'grid' => array(255, 190, 190)
        	)
		);
		  
		// create captcha image
		$cap = create_captcha($config_captcha);
		// store image html code in a variable
		$data['img'] = $cap['image'];
		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);
		
		$data['head'] 		= 'Pengaturan Pengguna';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'default';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		$data['unker'] 		= $this->data->get_unker();
		
		$this->load->view($data['content'], $data);
	}
	
	public function daftar()
    {
		$secutity_code = $this->input->post('security_code');
		$mycaptcha = $this->session->userdata('mycaptcha');
			
		if($this->validation()){
			// $insert = $this->data->insert($data);
			// helper_log("add", "Registrasi Pengguna SOPD");
			// $this->session->set_flashdata('flashconfirm','Anda Sudah Terdaftar, Mohon Cek Email Secara Berkala Jika Sudah Kami Aktivasi.');
			// redirect('registrasi/sopd');
			$this->upload_file();
			if($_FILES['file']['name'])
			{
				if ($secutity_code == $mycaptcha) {
					if ($this->upload->do_upload('file')){
						$dokumen = $this->upload->data();
						$data = array(
							'ip_address' => $this->input->ip_address(),
							'nip' => $this->input->post('nip', TRUE),
							'username' => $this->input->post('username', TRUE),
							'fullname' => $this->input->post('nama', TRUE),
							'email' => $this->input->post('email', TRUE),
							'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
							'telpon' => $this->input->post('telpon', TRUE),
							'unker_id' => $this->input->post('unker'),
							'satker_id' => $this->input->post('satker'),
							'dokumen' => $dokumen['file_name'],
							'level' => 4,
							'active' => 0,
							'created_id' => '0',
							'created_at' => date('Y-m-d H:i:s')
						);

						$insert = $this->data->insert($data);
						helper_log("add", "Registrasi Pengguna SOPD");
						// pesan akan muncul jika captcha benar
						$this->session->set_flashdata('flashconfirm','Anda Sudah Terdaftar, Mohon Cek Email Secara Berkala Jika Sudah Kami Aktivasi.');
						//$this->session->unset_userdata('mycaptcha');
						$this->send_mail($data['fullname'], $data['nip'], $data['email'], $this->input->post('password'));
						redirect('registrasi/sopd');
					}else{
						$this->session->set_flashdata('flasherror', $this->upload->display_errors());
						$this->index();
					}
				} else {
					// pesan akan muncul jika captcha salah
					//$this->session->unset_userdata('mycaptcha');
					$this->session->set_flashdata('flasherror','Kode Security Anda Salah :(');
					//redirect('registrasi/sopd');
					$this->index();
				}
			}else{
				$this->session->set_flashdata('flasherror','Mohon untuk mengupload dokumen penunjukan :)');
				$this->index();
			}
		}else{
			$this->index();
		}
    }
	
	private function validation()
    {
        //$data = array('success' => false, 'messages' => array());
        
		$this->form_validation->set_rules("nip", "NIP", "trim|required|is_unique[users.nip]|max_length[18]");
		$this->form_validation->set_rules("nama", "Nama Lengkap", "trim|required");
		$this->form_validation->set_rules("username", "Username", "trim|required|is_unique[users.username]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[6]|max_length[18]");
		$this->form_validation->set_rules("repassword", "Ulangi Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("telpon", "Telpon", "trim|is_natural|required");
		$this->form_validation->set_rules("unker", "Unit Kerja", "trim|required");
		$this->form_validation->set_rules("satker", "Satuan Kerja", "trim|required");
		$this->form_validation->set_rules("security_code", "Security Code", "trim|required");
		
        return $this->form_validation->run();
	}
	
	public function nip($str=null)
	{
		$id = $this->uri->segment(4);
		$query = $this->db->get_where('users', array('nip'=>$str, 'id !='=>$id));
		if($query->num_rows() > 0){
			$this->form_validation->set_message('nip', '{field} sudah tersedia atau telah digunakan orang lain.');
			return FALSE;
		}else{
		 	return TRUE;
		}
	}

	public function username($str=null)
	{
		$id = $this->uri->segment(4);
		$query = $this->db->get_where('users', array('username'=>$str, 'id !='=>$id));
		if($query->num_rows() > 0){
			$this->form_validation->set_message('username', '{field} sudah tersedia atau telah digunakan orang lain.');
			return FALSE;
		}else{
		 	return TRUE;
		}
	}

	public function email($str=null)
	{
		$id = $this->uri->segment(4);
		$query = $this->db->get_where('users', array('email'=>$str, 'id !='=>$id));
		if($query->num_rows() > 0){
			$this->form_validation->set_message('email', '{field} sudah tersedia atau telah digunakan orang lain.');
			return FALSE;
		}else{
		 	return TRUE;
		}
	}
	
	public function get_satker(){
        $unker = $this->input->post('unker');
        $satker = $this->data->get_satker($unker);
        if(!empty($satker)){
           $selected = set_value('satker');
            echo form_dropdown('satker', $satker, $selected, "class='form-control select2' name='satker' id='satker'");
        }else{
            echo form_dropdown('satker', array(''=>'Pilih Satuan Kerja'), '', "class='form-control select2' name='satker' id='satker'");
        }
	}
	
	public function reset_password()
	{
		$data['head'] 		= 'Reset Password';
		$data['record'] 	= $this->data->get_all();
		$data['content'] 	= $this->folder.'password';
		$data['style'] 		= $this->folder.'style';
		$data['js'] 		= $this->folder.'js';
		
		$this->load->view($data['content'], $data);
	}

	public function send_password()
    {
		if($this->email_validation()){
			$find = $this->db->get_where('users', array('email'=>$this->input->post('email'), 'deleted_at'=> NULL))->row();
			if(!$find){
				$this->session->set_flashdata('flasherror','Alamat Email Yang Anda Masukan Tidak Terdapat Dalam Database Kami.');
				redirect('registrasi/sopd/reset_password');
			}else{
				$password = $this->random_password();
				$data = array(
					'ip_address' => $this->input->ip_address(),
					'password' => password_hash($password, PASSWORD_BCRYPT),
					'updated_id' => '0',
					'updated_at' => date('Y-m-d H:i:s')
				);
				$this->data->update($data, $find->id);
				$this->session->set_flashdata('flashconfirm','Password Anda Sudah Terkirim, Mohon Cek Email Anda Secara Berkala.');
				$this->send_mail_password($this->input->post('email'), $password);
				redirect('registrasi/sopd/reset_password');
			}
		}else{
			$this->index();
		}
    }

	private function email_validation()
    {
        //$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
        return $this->form_validation->run();
	}

	private function random_password() 
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$password = array(); 
		$alpha_length = strlen($alphabet) - 1; 
		for ($i = 0; $i < 8; $i++) 
		{
			$n = rand(0, $alpha_length);
			$password[] = $alphabet[$n];
		}
		return implode($password); 
	}

	private function send_mail($nama=null, $nip=null,  $email=null, $password=null)
	{
		//Load email library
		$this->load->library('email');
		$this->load->library('encrypt');

		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'rifqie@gmail.com',
			'smtp_pass' => 'Handaktahuaj4',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h3>Data Registrasi SOPD SIMPEG KALSEL</h3>';
		$htmlContent .= '<p>Anda telah mendaftarkan diri anda atas nama '.$nama.' dengan nip '.$nip.' pada SIMPEG KALSEL dengan password anda : '.$password.'</p>';
		$htmlContent .= '<p>Jika anda belum dapat melakukan akses pada halaman login https://simpeg.kalselprov.go.id kemungkinan akun anda belum dapat diverifikasi atau diaktifkan oleh administrator.</p>';

		$this->email->to($email);
		$this->email->from('rifqie.rusyadi@gmail.com','SIMPEG KALSEL');
		$this->email->subject('Data Registrasi SOPD SIMPEG KALSEL');
		$this->email->message($htmlContent);
		//Send email
		$this->email->send();
	}

	private function send_mail_password($email=null, $password=null)
	{
		//Load email library
		$this->load->library('email');
		$this->load->library('encrypt');

		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'rifqie@gmail.com',
			'smtp_pass' => 'Handaktahuaj4',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h3>Permohonan Password Baru SIMPEG KALSEL</h3>';
		$htmlContent .= '<p>Password SIMPEG KALSEL Anda Adalah : '.$password.'</p>';

		$this->email->to($email);
		$this->email->from('rifqie.rusyadi@gmail.com','SIMPEG KALSEL');
		$this->email->subject('Permohonan Password Baru SIMPEG KALSEL');
		$this->email->message($htmlContent);
		//Send email
		$this->email->send();
	}

	private function upload_file(){
		$this->load->library('upload');
        $nmfile = "lapkin_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './document/e-lapkin/'; //path folder
        $config['allowed_types'] = 'pdf|jpg|png'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '3000'; //lebar maksimum 1288 px
        $config['max_height']  = '3000'; //tinggi maksimu 768 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);
	}
}