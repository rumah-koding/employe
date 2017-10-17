<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkat_m extends MY_Model
{
	public $table = 'pangkat'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
	//ajax datatable
    public $column_order = array(null); //set kolom field database pada datatable secara berurutan
    public $column_search = array(); //set kolom field database pada datatable untuk pencarian
    public $order = array('id' => 'asc'); //order baku 
	
	public function __construct()
	{
		$this->timestamps = TRUE;
		$this->soft_deletes = FALSE;
		parent::__construct();
	}
	
    public function get_record($id=null)
	{
		$query = $this->db->query('SELECT a.nip, a.tglahir, b.gol, b.tmt as tmtgol, c.eselon, c.tmt as tmtjab, d.ktpu, d.tanggal FROM simpeg_identitas a LEFT JOIN simpeg_pangkat_akhir b ON a.nip = b.nip LEFT JOIN simpeg_jabatan_akhir c ON a.nip = c.nip LEFT JOIN simpeg_pendidikan_akhir d ON a.nip = d.nip WHERE a.status_id IN (1,2) ORDER BY c.eselon ASC, c.tmt ASC, b.gol DESC, b.tmt ASC, d.ktpu DESC, d.tanggal ASC');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return FALSE;
		}
	}
}