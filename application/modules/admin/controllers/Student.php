<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends Common_Back_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_admin_user_session();
    }
    public function index(){
        $breadcrumb         = array(
        "Dashboard" => base_url(),
        "Students" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Student';
        $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/user/js/customer.js');
        $this->load->admin_render('student/index', $data, '');
    } //End function
    public function detail() {
        $data['title'] = "Detail";
        $breadcrumb         = array(
        "Dashboard" => base_url('dashboard'),
        "Profile" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $id           = decoding($this->uri->segment(2));
        $data['info'] = $this->common_model->userInfo(array('users.id'=>$id));
        $data['teacher_list'] = $this->common_model->getAll('users',"(`roleId`=2 AND `roleId`!=1 AND `roleId`!=4 AND `roleId`!=3 AND `roleId`!=5) AND `id` NOT IN (SELECT `userId` FROM `institute_teacher`)");
         $assign = $this->common_model->getsingle('personal_student_assign_teacher',array('studentId'=>$id));
      /// lq();
      //  pr( $assign);
        if($assign){
            $data['teacher'] = $this->common_model->userInfo(array('users.id'=>$assign['teacherId']));
        }
          $data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
        $data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/user/js/customer.js');
        $this->load->admin_render('student/profile', $data, '');
    }//End Function 
 
}//End Class
