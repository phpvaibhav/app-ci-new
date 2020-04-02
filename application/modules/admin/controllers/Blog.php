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
        $data['front_styles']    = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css','common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/blog.js');
        $this->load->admin_render('blog/index', $data, '');
    } //End function
    public function add(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Pages" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Add';
        $data['front_styles']    = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css','common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/blog.js');
         $data['instruments'] = $this->common_model->getAll('instrument');
        $this->load->admin_render('blog/add', $data, '');
    } //End function
    public function edit(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Pages" => ""
        );
         $id           = decoding($this->uri->segment(4));
//pr($id );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Edit';
        $data['front_styles']    = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css','common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/blog.js');
        $data['instruments'] = $this->common_model->getAll('instrument');
        $data['info'] = $this->common_model->getsingle('blogs',array('blogId'=>$id));
        $this->load->admin_render('blog/add', $data, '');
    } //End function
    
    public function detail() {
        $data['title'] = "Blog";
        $breadcrumb         = array(
        "Dashboard" => base_url('dashboard'),
        "Blogs" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $id           = decoding($this->uri->segment(4));
       // $id           = decoding($this->uri->segment(2));
        $info = $this->common_model->getsingle('blogs',array('blogId'=>$id));
        $data['info'] = $info;
        if($info['userId']):
            $data['userBy'] = $this->common_model->getsingle('users',array('id'=>$info['userId']));
        else:
             $data['userBy'] = $this->common_model->getsingle('admin',array('id'=>1));
        endif;
        $data['instrument'] = $this->common_model->getsingle('instrument',array('instrumentId'=>$info['instrumentId']));
        $data['front_styles']    = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css','common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/blog.js');
        $this->load->admin_render('blog/detail', $data,'');
    }//End Function 
 
}//End Class
