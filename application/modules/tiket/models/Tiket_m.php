<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tiket_m extends MY_Model
{
    public $table = 'tiket';
    public $primary_key = 'id';
    public $timestamps = TRUE;
    public $protected = array('id');
    
    public function __construct()
    {
        $this->soft_deletes = TRUE;
        parent::__construct();
    }
    
    public function get_new()
    {
        $record = new stdClass();
        $record->id = '';
        $record->kategori = '';
        $record->judul = '';
        $record->informasi = '';
        return $record;
    }
    
    public function get_record()
    {
        $level = $this->session->userdata('level');
        
        $this->db->select('a.id, a.kode, a.subjek, a.informasi, a.file, d.kategori, a.status, b.fullname, c.satker, a.created_at');
        $this->db->from('tiket a');
        $this->db->join('users b','a.user_id = b.id','LEFT');
        $this->db->join('ref_satker c','a.satker_id = c.kode','LEFT');
        $this->db->join('kategori d','a.kategori_id = d.id','LEFT');
        if($level == 2) {
            $this->db->where('a.satker_id', $this->session->userdata('satker'));
        }
        $this->db->order_by('a.id','DESC');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }
    
    public function get_tiket($id)
    {
        $level = $this->session->userdata('level');
        
        $this->db->select('a.id, a.kode, a.subjek, a.informasi, a.file, d.kategori, a.status, b.nama, c.unitkerja, a.created_at');
        $this->db->from('tiket a');
        $this->db->join('users b','a.user_id = b.id','LEFT');
        $this->db->join('unitkerja c','a.unitkerja_id = c.id','LEFT');
        $this->db->join('kategori d','a.kategori_id = d.id','LEFT');
        if($level == 2) {
            $this->db->where('a.unitkerja_id', $this->session->userdata('unitkerja'));
        }
        $this->db->where('a.id',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }
    
    function insert_tiket($data)
    {
      $this->db->insert('tiket',$data);
      return $this->db->insert_id();
    }

    function insert_komentar($data)
    {
      $this->db->insert('komentar',$data);
      return $this->db->insert_id();
    }

    function close_tiket($id)
    {
    $this->db->where('id', $id);
    $this->db->update('tiket', array('status'=>'0'));
    return $this->db->affected_rows();
    }

    public function get_emails()
    {
      $this->db->where('email !=', $this->session->userdata('login_email'));
      $this->db->where('level', 1);
      $this->db->where('deleted_at',NULL);
      $query = $this->db->get('users');
      if($query->num_rows() > 0){
       return $query->result();
    }else{
       return FALSE;
    }
    }

    public function get_email($id)
    {
      $this->db->select('a.id, a.kode, a.subjek, b.email');
      $this->db->from('tiket a');
      $this->db->join('users b','a.user_id = b.id','LEFT');
      $this->db->where('email !=', $this->session->userdata('login_email'));
      $this->db->where('a.id', $id);
      $this->db->where('a.deleted_at',NULL);
      $query = $this->db->get();
      if($query->num_rows() > 0){
       return $query->result();
    }else{
       return FALSE;
    }
    }

    public function get_kategori()
	{
		$this->db->where('deleted_at', NULL);
        $query = $this->db->order_by('id', 'ASC')->get('kategori');
		if($query->num_rows() > 0){
            $dropdown[''] = 'Pilih Salah Satu';
        foreach ($query->result() as $row)
		{
			$dropdown[$row->id] = $row->kategori;
		}
        }else{
            $dropdown[''] = 'Belum Ada Data Kategori';    
        }
		return $dropdown;
	}

    public function kode_tiket() {
      $query = $this->db->query("SELECT MAX(RIGHT(kode,5)) AS kode FROM simpeg_tiket");
      $kode = "";
    
      if($query->num_rows() > 0){ 
            foreach($query->result() as $k){
                $tmp = ((int)$k->kode)+1;
                $kode = sprintf("%05s", $tmp);
            }
       }else{
        $kode = "00001";
      }
      $id = "T"; 
      return $id.$kode;
    }
}