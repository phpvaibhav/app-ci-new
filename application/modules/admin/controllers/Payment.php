<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends Common_Back_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_admin_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Payment History" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Payment History';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/payment.js');
        $this->load->admin_render('payment/index', $data, '');
    } //End function
}//End Class
