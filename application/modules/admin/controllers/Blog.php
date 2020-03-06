<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class blog extends Common_Back_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_admin_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Blogs" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Blogs';
        $this->load->admin_render('blog/index', $data, '');
    } //End function
    public function add(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Pages" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Add';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css','common_assets/css/plugins/summernote/summernote.css','common_assets/css/plugins/summernote/summernote-bs3.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/summernote/summernote.min.js','common_assets/admin/js/page.js');
        $this->load->admin_render('blog/add', $data, '');
    } //End function
    public function edit(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Pages" => ""
        );
         $id           = decoding($this->uri->segment(4));

        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Edit';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css','common_assets/css/plugins/summernote/summernote.css','common_assets/css/plugins/summernote/summernote-bs3.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/js/plugins/summernote/summernote.min.js','common_assets/admin/js/page.js');
        $data['info'] = $this->common_model->getsingle('pages',array('pageId'=>$id));
        $this->load->admin_render('blog/add', $data, '');
    } //End function
    
    public function detail() {
        $data['title'] = "Blog";
        $breadcrumb         = array(
        "Dashboard" => base_url('dashboard'),
        "Blogs" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
       // $id           = decoding($this->uri->segment(2));
      
      
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/page.js');
        $this->load->admin_render('blog/detail', $data, '');
    }//End Function 
 
}//End Class
