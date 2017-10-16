<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata_m extends MY_Model
{
	public $table = 'identitas'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array('id','kode','satker',null); //set kolom field database pada datatable secara berurutan
    public $column_search = array('kode','satker'); //set kolom field database pada datatable untuk pencarian
    public $order = array('satker' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = FALSE;
		parent::__construct();
	}
	
    public function get_satker($id=null)
	{
		$query = $this->db->get_where('ref_satker',array('id'=>$id));
		if($query->num_rows() > 0)
		{
			return $query->row();
		}else{
			return FALSE;
		}
	}
}