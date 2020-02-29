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
        "Students" => ""
        );
        $data['breadcrumb'] = $breadcrumb;
        $data['title']      = 'Student';
        $data['classes']      = $this->common_model->getAll('institute_classes',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
        $data['teachers']      = $this->common_model->GetJoinRecord('users','id','institute_teacher','userId','id,fullName',array('institute_teacher.instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
      //  pr( $data['teachers']);
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

        $data['info'] = $this->common_model->userInfo(array('users.id'=>$id));
        $data['schoolInfo'] = $this->common_model->getsingle('institute_student',array('userId'=>$id));
        $data['classInfo'] = $this->common_model->getsingle('institute_classes',array('classId'=>$data['schoolInfo']['classId']));
        $assign = $this->common_model->getsingle('student_assign_teacher',array('studentId'=>$id,'instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
      /// lq();
      //  pr( $assign);
        if($assign){
            $data['teacher'] = $this->common_model->userInfo(array('users.id'=>$assign['teacherId']));
        }
        
        //pr($data);
        $this->load->front_render('student/profile', $data, '');
    }//End Function 
 
}//End Class