<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Identitas extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //Menampilkan data kontak
    function index_get() {
        $nip = $this->get('nip');
        if ($nip == '') {
            $this->db->select('a.nip, a.nama, a.gelar1 as gelar_depan, a.gelar2 as gelar_belakang, d.golongan, b.jabatan, b.satker_id as kode_satker, b.satker as satker, b.unker_id as kode_unker, b.unker as unker, b.instansi');
            $this->db->from('identitas a');
            $this->db->join('jabatan_akhir b','a.nip = b.nip','LEFT');
            $this->db->join('pangkat_akhir c','a.nip = c.nip','LEFT');
            $this->db->join('ref_pangkat d','c.gol = d.kode');
            $this->db->where_in('a.status_id', array(1,2));
            $this->db->where('a.deleted_at',null);
            $identitas = $this->db->get()->result();
        } else {
            $this->db->select('a.nip, a.nama, a.gelar1 as gelar_depan, a.gelar2 as gelar_belakang, d.golongan, b.jabatan, b.satker_id as kode_satker, b.satker as satker, b.unker_id as kode_unker, b.unker as unker, b.instansi');
            $this->db->from('identitas a');
            $this->db->join('jabatan_akhir b','a.nip = b.nip','LEFT');
            $this->db->join('pangkat_akhir c','a.nip = c.nip','LEFT');
            $this->db->join('ref_pangkat d','c.gol = d.kode');
            $this->db->where_in('a.status_id', array(1,2));
            $this->db->where('a.nip',$nip);
            $this->db->where('a.deleted_at',null);
            $identitas = $this->db->get()->result();
        }
        $this->response($identitas, 200);
    }
}
?>