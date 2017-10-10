<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation{

    public function id_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0)
            : FALSE;
    }
	
	public function unique_deleted($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id, 'deleted_at'=>null))->num_rows() === 0)
            : FALSE;
    }
	
	public function nip_unique($str, $field)
    {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'nip !=' => $id))->num_rows() === 0)
            : FALSE;
    }
}