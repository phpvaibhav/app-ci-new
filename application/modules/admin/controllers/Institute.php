<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institute extends Common_Back_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();
        $this->check_admin_user_session();
    }//End Function

    public function index() { 
        $data['title'] = "Institute";
		$data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
		$data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/institute.js');
        $this->load->admin_render('institute', $data);
    }//End Function
    public function detail() { 

        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Institute" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title'] = "Detail";
        $data['front_styles']       = array();
        $data['front_scripts']      = array();
        $instituteId             = decoding($this->uri->segment(2));
        $where              = array('institute.instituteId'=>$instituteId);
        $result             = $this->common_model->GetSingleJoinRecord('institute','userId','users','id','institute.instituteId,institute.name,institute.logo,institute.email,institute.phoneNumber,institute.description,institute.status,users.fullName as createdBy',$where);
        $data['info'] = $result;
        $this->load->admin_render('institute/detail', $data);
    }//End Function
    
}//End Class