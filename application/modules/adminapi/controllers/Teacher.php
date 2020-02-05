<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Teacher extends Common_Admin_Controller{  
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function addTeacher_post(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',
            array('is_unique' => 'Email already exist')
        );
        $this->form_validation->set_rules('fristName', 'frist name', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('lastName', 'last name', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
     
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|min_length[10]|max_length[20]');
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));       
        }
        else{
                $authtoken                  = $this->common_model->generate_token();
                $passToken                  = $this->common_model->generate_token();
                $userData['fristName']       = $this->post('fristName');
                $userData['lastName']       = $this->post('lastName');
                $userData['fullName']       = $this->post('fristName')." ".$this->post('lastName');
                $userData['email']          = $this->post('email');
                $userData['password']       =  password_hash($this->post('password'), PASSWORD_DEFAULT);
                $userData['contactNumber']  = $this->post('contactNumber');
                $userData['userType']       = 1;
                $userData['authToken']      =   $authtoken;
                $userData['passToken']      =   $passToken;

                $userId = $this->common_model->insertData('users',$userData);
                if($userId){
                    $userMeta['userId']         = $userId;
                    $data_val['customerId']    = $userId;
                    $data_val1['customerId']    = $userId;
                    $this->common_model->insertData('customerMeta',$userMeta);
                      /*addres*/
                        $this->load->model('customer_model');
                        $this->customer_model->customerAddressManage($data_val);
                        $this->customer_model->customerAddressManage($data_val1);
                    /*addres*/
                     $response = array('status'=>SUCCESS,'message'=>"Customer record added successfully.");
                }else{
                     $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                } 
                  
        }
        $this->response($response);
    }//end function
    public function customerList_post(){
        $this->load->helper('text');
        $this->load->model('customer_model');
        $this->customer_model->set_data(array('userType' =>1));
        $list = $this->customer_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action ='';
        $no++;
        $row = array();
      /*  $row[] = $no;*/
        //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
      $userLink = base_url().'customers/customerDetail/'.encoding($serData->id);
        $row[]  = '<a href="'.$userLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->fullName).'</a>'; 
        $row[]  = display_placeholder_text($serData->email); 
        $row[]  = display_placeholder_text($serData->contactNumber); 
        if($serData->status){
        $row[]  = '<label class="label label-success">'.$serData->statusShow.'</label>';
        }else{ 
        $row[]  = '<label class="label label-danger">'.$serData->statusShow.'</label>'; 
        } 
        $link       = 'javascript:void(0)';
        $action    .= "";
        if($serData->status){

            $action .= '<a href="'.$link.'" onclick="customerStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->id).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
             $action .= '<a href="'.$link.'" onclick="customerStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->id).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
        $userLink = base_url().'customers/customerDetail/'.encoding($serData->id);
        
        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
        $pdfLink = base_url().'customers/customersDetailPdf/'.encoding($serData->id);
        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$pdfLink.'"  class="on-default edit-row table_action" title="Pdf Download" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->customer_model->count_all(),
            "recordsFiltered"   => $this->customer_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    function customerStatus_post(){
        $userId     = decoding($this->post('use'));
        $where      = array('id'=>$userId);
         $dataExist = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            $status = $dataExist->status ?0:1;

             $dataExist = $this->common_model->updateFields('users',array('status'=>$status),$where);
              $showmsg  = ($status==1)? "Customer request is Active" : "Customer request is Inactive";
                $response = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function creditHoldStatus_post(){
        $userId     = decoding($this->post('use'));
        $where      = array('userId'=>$userId);
        $dataExist  = $this->common_model->is_data_exists('customerMeta',$where);
        if($dataExist){
            $status = $dataExist->creditHoldStatus ? 0:1;

             $dataExist=$this->common_model->updateFields('customerMeta',array('creditHoldStatus'=>$status),$where);
              $showmsg  ='Customer has been credit hold changed successfully.';
                $response = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
     
    function customerDelete_post(){
        $userId     = decoding($this->post('use'));
        $where      = array('id'=>$userId,'userType'=>1);
        $dataExist  = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            if(!empty($dataExist->profileImage)){
                $this->load->model('Image_model');
                $this->Image_model->delete_image('uploads/users/',$dataExist->profileImage);
            }
            $dataExist = $this->common_model->deleteData('users',$where);
            $showmsg   = 'Customer has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function

}//End Class 