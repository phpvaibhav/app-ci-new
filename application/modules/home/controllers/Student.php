<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends Common_Front_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Staff" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Student';
        $data['classes']      = $this->common_model->getAll('institute_classes',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/user/js/customer.js');
        $this->load->front_render('student/index', $data, '');
    } //End function
    public function detail() {
        $data['title'] = "Detail";
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Profile" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $id           = decoding($this->uri->segment(2));

        $data['user'] = $this->common_model->userInfo(array('users.id'=>$id));
        $data['schoolInfo'] = $this->common_model->getsingle('institute_student',array('userId'=>$id));
        $data['classInfo'] = $this->common_model->getsingle('institute_classes',array('classId'=>$data['schoolInfo']['classId']));
        //pr($data);
        $this->load->front_render('student/profile', $data, '');
    }//End Function 
 
}//End Class