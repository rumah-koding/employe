<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Satker extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //Menampilkan data kontak
    function index_get() {
        $kode = $this->get('kode');
        if ($kode == '') {
            $this->db->select('unker_id as kode_unker, kode as kode_satker, parent_id as parent, satker');
            $this->db->where('deleted_at',null);
            $satker = $this->db->get('ref_satker')->result();
        } else {
            $this->db->select('unker_id as kode_unker, kode as kode_satker, parent_id as parent, satker');
            $this->db->where('kode',$kode);
            $this->db->where('deleted_at',null);
            $satker = $this->db->get()->result();
        }
        $this->response($satker, 200);
    }
}
?>