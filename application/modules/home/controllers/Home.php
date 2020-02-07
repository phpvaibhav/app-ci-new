<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Common_Front_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();
        $this->check_user_session();
     
    }//End Function

    public function index() { 
        $data['title'] = "Login";
        $data['front_scripts']= array('common_assets/user/js/login.js');
        $this->load->login_render('login', $data);
    }//End Function

    public function signup() { 
        $data['title'] = "Sign up";
        $data['front_scripts']= array('common_assets/user/js/login.js');
        $this->load->login_render('signup', $data);
    }//End Function

    public function forgot() { 
        $data['title'] = "Forgot";
        $data['front_scripts']= array('common_assets/user/js/login.js');
        $this->load->login_render('forgot', $data);
    }//End Function

    public function logout() {
        //$this->logout(FALSE);
        unset($_SESSION[USER_SESS_KEY]); 
        $this->session->set_flashdata('success', 'Sign out successfully done! ');
        $response = array('status' => 1);
        redirect(base_url());
        echo json_encode($response);
        die;
    }//End Function
    public function institute() {
      //echo "fgdg";
     $data['title'] = "institute";
     $data['teacher_count']  = $this->common_model->get_total_count('institute_teacher',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
     $data['staff_count']  = $this->common_model->get_total_count('institute_staff',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
     $data['student_count']  = $this->common_model->get_total_count('institute_student',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
     $data['parents_count']  = $this->common_model->get_total_count('institute_parents',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
      $this->load->front_render('dashboard', $data, '');
    }//End Function
   

}//End Class