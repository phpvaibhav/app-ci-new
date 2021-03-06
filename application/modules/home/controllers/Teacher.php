<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teacher extends Common_Front_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Teachers" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Teachers';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/user/js/customer.js');
        $this->load->front_render('teacher/index', $data, '');
    } //End function
    public function detail() {
        $data['title'] = "Detail";
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Profile" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $id           = decoding($this->uri->segment(2));

        $data['info'] = $this->common_model->userInfo(array('users.id'=>$id));
        $this->load->front_render('teacher/detail', $data, '');
    }//End Function 
 
}//End Class