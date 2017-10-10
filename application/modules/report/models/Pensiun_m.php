<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pensiun_m extends MY_Model
{
	public $table = 'identitas'; // you MUST mention the table name
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
	
	//urusan lawan datatable
    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    //urusan lawan ambil data
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->where('deleted_at', NULL);
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function get_peta($id=null)
	{
		$query = $this->db->query("SELECT a.parent_id, a.kode, (CASE WHEN a.parent_id IS NULL THEN a.kode ELSE a.parent_id END) AS sort, a.order_id, a.satker, b.jabatan, b.tmt, b.eselon, b.nip  FROM simpeg_ref_satker a LEFT JOIN simpeg_jabatan_akhir b ON a.kode = b.satker_id where a.unker_id = {$id} ORDER BY a.kode ASC, sort ASC, b.eselon ASC");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			return FALSE;
		}
	}
	
	public function get_tahun()
	{
		$dropdown[''] = 'Pilih Salah Satu Tahun';
		$awal = date('Y')+1;
		$akhir = date('Y')+5;
		
		for ($i=$awal ; $i <= $akhir; $i++)
		{
			$dropdown[$i] = 'Pensiun BUP 58 Tahun - '.$i;
		}
		
		return $dropdown;
	}
	
	public function get_pensiun($tahun=null)
	{
		$query = $this->db->query("select a.nip, a.tglahir, b.unker, b.satker, b.jabatan, b.eselon, TIMESTAMPDIFF(YEAR, a.tglahir, '{$tahun}-12-31') AS umur FROM simpeg_identitas a LEFT JOIN simpeg_jabatan_akhir b ON a.nip = b.nip where status_id in (1,2) and a.deleted_at is null and TIMESTAMPDIFF(YEAR, a.tglahir, '2018-12-31') = 58  
ORDER BY `b`.`unker`  DESC, b.satker ASC, a.tglahir ASC");
		return $query->result();
	}
}