<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Plan extends Common_Back_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_admin_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Plan" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Plan';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/plan.js');
        $this->load->admin_render('plan/index', $data, '');
    } //End function
    public function add(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Plan" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Add';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css','common_assets/css/plugins/summernote/summernote.css','common_assets/css/plugins/summernote/summernote-bs3.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/summernote/summernote.min.js','common_assets/admin/js/plan.js');
        $this->load->admin_render('plan/add', $data, '');
    } //End function
    public function edit(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Plan" => ""
        );
         $id           = decoding($this->uri->segment(4));

        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Edit';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css','common_assets/css/plugins/summernote/summernote.css','common_assets/css/plugins/summernote/summernote-bs3.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/summernote/summernote.min.js','common_assets/admin/js/plan.js');
        $data['info'] = $this->common_model->getsingle('pages',array('pageId'=>$id));
        $this->load->admin_render('plan/add', $data, '');
    } //End function
    
 /*   public function detail() {
        $data['title'] = "Detail";
        $breadcrumb         = array(
        "Dashboard" => base_url('dashboard'),
        "Plan" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $id           = decoding($this->uri->segment(2));
        $data['info'] = $this->common_model->getsingle('pages',array('pageId'=>$id));
      
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/page.js');
        $this->load->admin_render('pages/detail', $data, '');
    }//End Function 
 */
}//End Class
