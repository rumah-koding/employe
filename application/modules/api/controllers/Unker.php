<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Unker extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //Menampilkan data kontak
    function index_get() {
        $kode = $this->get('kode');
        if ($kode == '') {
            $this->db->select('kode as kode_unker, unker');
            $this->db->where('deleted_at',null);
            $unker = $this->db->get('ref_unker')->result();
        } else {
            $this->db-select('kode as kode_unker, unker');
            $this->db->where('kode',$kode);
            $this->db->where('deleted_at',null);
            $unker = $this->db->get('ref_unker')->result();
        }
        $this->response($unker, 200);
    }
}
?>