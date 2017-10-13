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
            $this->db->select('unker_id as kode_unker, kode as kode_satker, parent_id as parent, satker, upt, level, name_level1 as level1, name_level2 as level2, name_level3 as level3,name_level4 as level4, name_level5 as level5, name_level6 as level6, path');
            $satker = $this->db->get('view_satker')->result();
        } else {
            $this->db->select('unker_id as kode_unker, kode as kode_satker, parent_id as parent, satker, upt, level, name_level1 as level1, name_level2 as level2, name_level3 as level3,name_level4 as level4, name_level5 as level5, name_level6 as level6, path');
            $this->db->where('kode',$kode);
            $satker = $this->db->get('view_satker')->result();
        }
        $this->response($satker, 200);
    }
}
?>