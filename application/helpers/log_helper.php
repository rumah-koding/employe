<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function helper_log($tipe = "", $str = ""){
    
	$CI =& get_instance();
	
    if (strtolower($tipe) == "login"){
        $log_tipe   = 1;
    }
    elseif(strtolower($tipe) == "logout")
    {
        $log_tipe   = 0;
    }
    elseif(strtolower($tipe) == "add"){
        $log_tipe   = 2;
    }
    elseif(strtolower($tipe) == "edit"){
        $log_tipe  = 3;
    }
    elseif(strtolower($tipe) == "trash"){
        $log_tipe  = 4;
    }
	
    elseif(strtolower($tipe) == "restore"){
        $log_tipe  = 5;
    }
    else{
        $log_tipe  = 6;
    }
    // paramter
    $param['log_user']      = $CI->session->userdata('username');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;
	$param['log_ip']        = $CI->input->ip_address();
    //load model log
    $CI->load->model('m_log');
    //save to database
    $CI->m_log->save_log($param);
}

function level($id=null)
{
	if($id == 1){
		$level = 'Administrator';
	}elseif($id == 2){
		$level = 'Manager';
	}elseif($id == 3){
		$level = 'Pengawas';
	}elseif($id == 4){
		$level = 'SKPD';
	}elseif($id == 5){
		$level = 'Pegawai';
	}else{
		$level = 'Unknown';
	}
	
	return $level;
}

function signin()
{
	
	$CI =& get_instance();
	
	if(!$CI->session->userdata('signin')){
		$CI->session->set_flashdata('flasherror','Anda Harus Login Terlebih Dahulu.');
		redirect('login');
	}
}

function admin()
{
	
	$CI =& get_instance();
	
	if(!$CI->session->userdata('signin')){
		$CI->session->set_flashdata('flasherror','Anda Harus Login Terlebih Dahulu.');
		redirect('login');
	}
	
	if($CI->session->userdata('level') != 1){
		$CI->session->set_flashdata('flasherror','Anda Tidak Memiliki Hak Akses Untuk Modul Tersebut.');
		redirect('dashboard');
	}
}

function group($group)
{
	
	$CI =& get_instance();
	
	if(!in_array($CI->session->userdata('level'), $group)){
		$CI->session->set_flashdata('flasherror','Anda Tidak Memiliki Hak Akses Untuk Modul Tersebut.');
		redirect('dashboard');
	}
}

//function manager()
//{
//	$CI =& get_instance();
//	if(!$CI->session->userdata('signin')){
//		$CI->session->set_flashdata('flasherror','Anda Harus Login Terlebih Dahulu.');
//		redirect('login');
//	}
//	
//	if($CI->session->userdata('level') != 2 || $CI->session->userdata('level') != 1){
//		$CI->session->set_flashdata('flasherror','Anda Tidak Memiliki Hak Akses Untuk Modul Tersebut.');
//		redirect('dashboard');
//	}
//}
//
//function pengawas()
//{
//	$CI =& get_instance();
//	if(!$CI->session->userdata('signin')){
//		$CI->session->set_flashdata('flasherror','Anda Harus Login Terlebih Dahulu.');
//		redirect('login');
//	}
//	
//	if($CI->session->userdata('level') != 3){
//		$CI->session->set_flashdata('flasherror','Anda Tidak Memiliki Hak Akses Untuk Modul Tersebut.');
//		redirect('dashboard');
//	}
//}
//
//function skpd()
//{
//	$CI =& get_instance();
//	if(!$CI->session->userdata('signin')){
//		$CI->session->set_flashdata('flasherror','Anda Harus Login Terlebih Dahulu.');
//		redirect('login');
//	}
//	
//	if($CI->session->userdata('level') != 4){
//		$CI->session->set_flashdata('flasherror','Anda Tidak Memiliki Hak Akses Untuk Modul Tersebut.');
//		redirect('dashboard');
//	}
//}
//
//function pegawai()
//{
//	$CI =& get_instance();
//	if(!$CI->session->userdata('signin')){
//		$CI->session->set_flashdata('flasherror','Anda Harus Login Terlebih Dahulu.');
//		redirect('login');
//	}
//	
//	if($CI->session->userdata('level') != 5){
//		$CI->session->set_flashdata('flasherror','Anda Tidak Memiliki Hak Akses Untuk Modul Tersebut.');
//		redirect('dashboard');
//	}
//}