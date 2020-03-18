<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Instrument extends Common_Back_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_admin_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url('dashboard'),
        "Instrument" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Instrument';
        $data['front_styles']    = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css','common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/jasny/jasny-bootstrap.min.js','common_assets/admin/js/instrument.js');
       
   
        $this->load->admin_render('instrument/index', $data, '');
    } //End function
}//End Class