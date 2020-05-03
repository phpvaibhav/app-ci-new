<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends Common_Front_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Payment History" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Payment History';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/user/js/payment.js');
        $this->load->front_render('payment/index', $data, '');
    } //End function
}//End Class

