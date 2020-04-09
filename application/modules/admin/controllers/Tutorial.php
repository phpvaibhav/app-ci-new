<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tutorial extends Common_Back_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_admin_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Tutorial" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Tutorial';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css','common_assets/css/plugins/select2/select2.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/select2/select2.full.min.js','common_assets/admin/js/tutorial.js');
        $data['users']      = $this->common_model->getAll('tutorial');
        $this->load->admin_render('tutorial/index', $data, '');
    } //End function
   
    public function detail() {
        $data['title'] = "Support";
        $breadcrumb         = array(
        "Dashboard" => base_url('dashboard'),
        "Tutorial" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
       // $id           = decoding($this->uri->segment(2));
        $id           = decoding($this->uri->segment(2));
        $data['info'] = $this->common_model->getsingle('support_tickets',array('supportId'=>$id));
        $data['replies'] = $this->common_model->supportReply($data['info']['supportId']);
         $data['title'] = "Support(#". $data['info']['ticketNumber'].")";
       $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css','common_assets/css/plugins/select2/select2.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/select2/select2.full.min.js','common_assets/admin/js/support.js');
        $this->load->admin_render('support/detail', $data, '');
    }//End Function 
 
}//End Class
