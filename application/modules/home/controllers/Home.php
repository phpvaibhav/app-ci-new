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

    public function logout_home() {
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
     $chart_Data = array();
     if($_SESSION[USER_SESS_KEY]['roleId']==1){
        $chart_Data[] = array('label'=>'Teachers','link'=>'teachers','icon'=>'fa fa-vcard','count'=> $this->common_model->get_total_count('institute_teacher',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId'])));
        $chart_Data[] = array('label'=>'Staff','link'=>'staff','icon'=>'fa fa-group','count'=> $this->common_model->get_total_count('institute_staff',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId'])));
        $chart_Data[] = array('label'=>'Students','link'=>'students','icon'=>'fa fa-child','count'=> $this->common_model->get_total_count('institute_student',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId'])));
        $chart_Data[] = array('label'=>'Parents','link'=>'parents','icon'=>'fa fa-home','count'=> $this->common_model->get_total_count('institute_parents',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId'])));
        $chart_Data[] = array('label'=>'Class','link'=>'institute-class','icon'=>'fa fa-folder-o','count'=> $this->common_model->get_total_count('institute_classes',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId'])));
     }
     $data['count_list'] = $chart_Data;
      $this->load->front_render('dashboard', $data, '');
    }//End Function
   

}//End Class