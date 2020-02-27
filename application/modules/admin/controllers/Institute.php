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
        $teacher_count = $this->common_model->get_total_count('institute_teacher',array('instituteId'=>$instituteId));
        $staff_count = $this->common_model->get_total_count('institute_staff',array('instituteId'=>$instituteId));
        $student_count = $this->common_model->get_total_count('institute_student',array('instituteId'=>$instituteId));

        $data['info'] = $result;
        $data['teacher_count']  = $teacher_count;
        $data['staff_count']    = $staff_count;
        $data['student_count']  = $student_count;
        $data['front_scripts']    = array('common_assets/admin/js/load_more.js');
        $this->load->admin_render('institute/detail', $data);
    }//End Function
    function teacherList(){
        $row = $this->input->post('row');
        $instituteId = $this->input->post('instituteId');

        $rowperpage = 3;
        $column_sel = array('users.id','users.fullName','users.firstName','users.lastName','users.email','users.contactNumber','users.bio','users.status','institute_teacher.joinStatus','(case when (users.status = 0) 
        THEN "Inactive" when (users.status = 1) 
        THEN "Active"  ELSE
        "Unknown" 
        END) as statusShow','(case when (institute_teacher.joinStatus = 0) 
        THEN "Pending" when (institute_teacher.joinStatus = 1) 
        THEN "Approved"  ELSE
        "Unknown" 
        END) as joinShow','(case when (users.profileImage = "") 
            THEN "common_assets/img/avatars/1.png" ELSE
            concat("uploads/user/",users.profileImage) 
            END) as profileImage'); //set column field database for datatable 
        $sel_fields = implode(",",array_filter($column_sel)); 
        $where = array('institute_teacher.instituteId'=>$instituteId);
        $data['result'] = $this->common_model->GetJoinRecord('users','id','institute_teacher', 'userId',$sel_fields,$where,'','users.id','desc',$rowperpage,$row);
         //lq();
        $this->load->view('institute/record',$data);
    }//ENd Function
    function staffList(){
        $row = $this->input->post('row');
        $instituteId = $this->input->post('instituteId');

        $rowperpage = 3;
        $column_sel = array('users.id','users.fullName','users.firstName','users.lastName','users.email','users.contactNumber','users.bio','users.status','institute_staff.joinStatus','(case when (users.status = 0) 
        THEN "Inactive" when (users.status = 1) 
        THEN "Active"  ELSE
        "Unknown" 
        END) as statusShow','(case when (institute_staff.joinStatus = 0) 
        THEN "Pending" when (institute_staff.joinStatus = 1) 
        THEN "Approved"  ELSE
        "Unknown" 
        END) as joinShow','(case when (users.profileImage = "") 
            THEN "common_assets/img/avatars/1.png" ELSE
            concat("uploads/user/",users.profileImage) 
            END) as profileImage'); //set column field database for datatable 
        $sel_fields = implode(",",array_filter($column_sel)); 
        $where = array('institute_staff.instituteId'=>$instituteId);
        $data['result'] = $this->common_model->GetJoinRecord('users','id','institute_staff', 'userId',$sel_fields,$where,'','users.id','desc',$rowperpage,$row);

        $this->load->view('institute/record',$data);
    }//ENd Function
    function studentList(){
        $row = $this->input->post('row');
        $instituteId = $this->input->post('instituteId');

        $rowperpage = 3;
        $column_sel = array('users.id','users.fullName','users.firstName','users.lastName','users.email','users.contactNumber','users.bio','users.status','institute_student.joinStatus','(case when (users.status = 0) 
        THEN "Inactive" when (users.status = 1) 
        THEN "Active"  ELSE
        "Unknown" 
        END) as statusShow','(case when (institute_student.joinStatus = 0) 
        THEN "Pending" when (institute_student.joinStatus = 1) 
        THEN "Approved"  ELSE
        "Unknown" 
        END) as joinShow','(case when (users.profileImage = "") 
            THEN "common_assets/img/avatars/1.png" ELSE
            concat("uploads/user/",users.profileImage) 
            END) as profileImage'); //set column field database for datatable 
        $sel_fields = implode(",",array_filter($column_sel)); 
        $where = array('institute_student.instituteId'=>$instituteId);
        $data['result'] = $this->common_model->GetJoinRecord('users','id','institute_student', 'userId',$sel_fields,$where,'','users.id','desc',$rowperpage,$row);

        $this->load->view('institute/record',$data);
    }//ENd Function
    
    
}//End Class