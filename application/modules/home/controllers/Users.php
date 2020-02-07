<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends Common_Front_Controller {

    public $data = "";

    function __construct() {
       parent::__construct();
       $this->check_user_session();
    }
    public function userDetail(){
        $userId             = decoding($this->uri->segment(2));
        //pr($userId);
        $data['title']      = "Profile";
        $where              = array('id'=>$userId);
        $result             = $this->common_model->userInfo($where);
        $data['userData']   = $result;
        $data['front_styles'] = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css');
        $data['front_scripts'] = array('common_assets/js/plugins/jasny/jasny-bootstrap.min.js');
        $this->load->front_render('profile/userDetail', $data, '');
    } //End function
    public function changePassword(){
        
        $userId             = decoding($this->uri->segment(2));
        $data['title']      = "Change Password";
        $where              = array('id'=>$userId);
        $result             = $this->common_model->getsingle('admin',$where);
        $data['userData']   = $result;
        $this->load->front_render('profile/changePassword', $data, '');
    }//End function  
     public function instituteInfo() {
        //($_SESSION[USER_SESS_KEY]['instituteId']);
        $data['title'] = "instituteInfo";
        $data['info'] = $this->common_model->getsingle('institute',array('instituteId'=>$_SESSION[USER_SESS_KEY]['instituteId']));
        $data['front_styles'] = array('common_assets/css/plugins/jasny/jasny-bootstrap.min.css');
        $data['front_scripts'] = array('common_assets/js/plugins/jasny/jasny-bootstrap.min.js','common_assets/user/js/institute.js');
        $this->load->front_render('schoolInfo', $data, '');
    }//End Function 
}//End Class