<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tikets {

	protected $CI;
	function __construct(){
		$this->CI=& get_instance();
	}
    
    function komentar($id){
        $this->CI->db->select('a.id, a.tanggapan, b.nama, c.unitkerja, a.tiket_id, a.created_at ');
        $this->CI->db->from('komentar a');
        $this->CI->db->join('users b','a.user_id = b.id','LEFT');
		$this->CI->db->join('unitkerja c','a.unitkerja_id = c.id','LEFT');
        $this->CI->db->where('a.tiket_id', $id);
		$this->CI->db->order_by('a.id', 'ASC');
		$query = $this->CI->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
	
	function jumlah_komentar($id){
        $this->CI->db->where('tiket_id', $id);
		$query = $this->CI->db->get('komentar');
        if($query->num_rows() > 0){
            return $query->num_rows();
        }else{
            return FALSE;
        }
    }

}