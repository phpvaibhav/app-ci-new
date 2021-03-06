<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Parents extends Common_Front_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Parents" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Parents';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/user/js/customer.js');
        $this->load->front_render('parents/index', $data, '');
    } //End function
 
}//End Class