<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Drivers extends Common_Admin_Controller{    
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function addDriver_post(){
        $userId     = decoding($this->post('cus'));
        $where      = array('id'=>$userId);
        $dataExist  = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        }else{
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',
            array('is_unique' => 'Email already exist')
        );
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
        }
        $this->form_validation->set_rules('fullName', 'full Name', 'trim|required|min_length[2]');
       
        $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|required|min_length[10]|max_length[20]');
        $this->form_validation->set_rules('dob', 'date of birth', 'trim|required');
        $this->form_validation->set_rules('doh', 'date of hire', 'trim|required');
        $this->form_validation->set_rules('licenseNumber', 'license number', 'trim|required');
        $this->form_validation->set_rules('expiryDate', 'license expiry date', 'trim|required');
        $this->form_validation->set_rules('emergencyPersonName', 'emergency person name', 'trim|required');
        $this->form_validation->set_rules('emergencyPersonNumber', 'emergency person number', 'trim|required');
        $this->form_validation->set_rules('latitude', 'latitude', 'trim|required|min_length[2]|callback_validate_address');
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));    
        }else{
            $authtoken                          = $this->common_model->generate_token();
            $passToken                          = $this->common_model->generate_token();
            $userData['fullName']               = $this->post('fullName');
            $userData['email']                  = $this->post('email');
            $userData['password']               =  password_hash($this->post('password'), PASSWORD_DEFAULT);
            $userData['contactNumber']          = $this->post('contactNumber');
            $userData['userType']               = 2;
            $userData['authToken']              =   $authtoken;
            $userData['passToken']              =   $passToken;
            //User meta
            $userMeta['emergencyPersonName']    = $this->post('emergencyPersonName');
            $userMeta['emergencyPersonNumber']  = $this->post('emergencyPersonNumber');
            $userMeta['dob']                    = date("Y-m-d",strtotime($this->post('dob')));
            $userMeta['doh']                    = date("Y-m-d",strtotime($this->post('doh')));
            $userMeta['licenseNumber']          = $this->post('licenseNumber');
            $userMeta['licenseExpiryDate']      = date("Y-m-d",strtotime($this->post('expiryDate')));
            $userMeta['address']                = $this->post('address');
            $userMeta['street']                 = $this->post('street');
            $userMeta['street2']                = $this->post('street2');
            $userMeta['city']                   = $this->post('city');
            $userMeta['state']                  = $this->post('state');
            $userMeta['zip']                    = $this->post('zip');
            $userMeta['country']                = $this->post('country');
            $userMeta['latitude']               = $this->post('latitude');
            $userMeta['longitude']              = $this->post('longitude');
            // profile pic upload
            $this->load->model('Image_model');
            //pr($userMeta);
            $image          = array(); 
            $profileImage   = '';
            if (!empty($_FILES['profileImage']['name'])) {
                $folder     = 'users';
                $image      = $this->Image_model->upload_image('profileImage',$folder); //upload media of Seller
                //check for error
                if(array_key_exists("error",$image) && !empty($image['error'])){
                    $response = array('status' => FAIL, 'message' => strip_tags($image['error'].'(In user Image)'));
                   $this->response($response);die;
                }
                //check for image name if present
                if(array_key_exists("image_name",$image)):
                    $profileImage = $image['image_name'];
                    if(!empty($dataExist->profileImage)){
                        $this->Image_model->delete_image('uploads/users/',$dataExist->profileImage);
                    }     
                endif;
            }
            if(!empty($profileImage)){
                $userData['profileImage']      =  $profileImage;
            }
            //update
            if($dataExist){
                $isemailExist = $this->common_model->is_data_exists('users',array('id !='=>$userId,'email'=> $userData['email']));
                if($isemailExist){
                    $response = array('status'=>FAIL,'message'=>"Email already exist");
                }else{
                    $update     = $this->common_model->updateFields('users',$userData,$where);
                    if($update){
                        $userMeta['userId'] = $userId;
                        $this->common_model->updateFields('driverMeta',$userMeta,array('userId'=>$userId));
                        $response = array('status'=>SUCCESS,'message'=>"Driver record updated successfully.");
                    }else{
                        $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                    } 
                }
               
            }else{
                $userId                 = $this->common_model->insertData('users',$userData);
                if($userId){
                    $userMeta['userId'] = $userId;
                    $this->common_model->insertData('driverMeta',$userMeta);
                    $response = array('status'=>SUCCESS,'message'=>"Driver record added successfully.");
                }else{
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                } 
            }         
        }
        $this->response($response);
    }//end function
    public function driverList_post(){
        $this->load->helper('text');
        $this->load->model('driver_model');
        $this->driver_model->set_data(array('userType' =>2));
        $list               = $this->driver_model->get_list();
        $data               = array();
        $no                 = $_POST['start'];
        foreach ($list as $serData) { 
            $action         = '';
            $no++;
            $row            = array();
            $row[]          = $no;
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $userLink       = base_url().'drivers/driverDetail/'.encoding($serData->id);
            $row[]          = '<a href="'.$userLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->fullName).'</a>'; 
            $row[]          = display_placeholder_text($serData->email); 
            $row[]          = display_placeholder_text($serData->contactNumber); 
            if($serData->status){
                $row[]          = '<label class="label label-success">'.$serData->statusShow.'</label>';
            }else{ 
                $row[]          = '<label class="label label-danger">'.$serData->statusShow.'</label>'; 
            } 
                $link           = 'javascript:void(0)';
                $action         .= "";
            if($serData->status){

                $action         .= '<a href="'.$link.'" onclick="driverStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->id).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-check" aria-hidden="true"></i></a>';
            }else{
                $action         .= '<a href="'.$link.'" onclick="driverStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->id).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-times" aria-hidden="true"></i></a>';
            }
            $userLink           = base_url().'drivers/driverDetail/'.encoding($serData->id);
            $action             .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            $pdfLink            = base_url().'drivers/driverDetailPdf/'.encoding($serData->id);
            $action             .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$pdfLink.'"  class="on-default edit-row table_action" title="Pdf Download" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
            $row[]  = $action;
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->driver_model->count_all(),
            "recordsFiltered"   => $this->driver_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    function driverStatus_post(){
        $userId         = decoding($this->post('use'));
        $where          = array('id'=>$userId);
        $dataExist      = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            $status     = $dataExist->status ?0:1;
            $dataExist  = $this->common_model->updateFields('users',array('status'=>$status),$where);
            $showmsg    = ($status==1)? "Driver request is Active" : "Driver request is Inactive";
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response    = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function creditHoldStatus_post(){
        $userId         = decoding($this->post('use'));
        $where          = array('userId'=>$userId);
        $dataExist      = $this->common_model->is_data_exists('customerMeta',$where);
        if($dataExist){
            $status     = $dataExist->creditHoldStatus ? 0:1;
            $dataExist  = $this->common_model->updateFields('customerMeta',array('creditHoldStatus'=>$status),$where);
            $showmsg    = 'Customer has been credit hold changed successfully.';
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response    = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
     function driverDelete_post(){
        $userId     = decoding($this->post('use'));
        $where      = array('id'=>$userId,'userType'=>2);
        $dataExist  = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            if(!empty($dataExist->profileImage)){
                $this->load->model('Image_model');
                $this->Image_model->delete_image('uploads/users/',$dataExist->profileImage);
            }
            $dataExist      = $this->common_model->deleteData('users',$where);
            $showmsg        = 'Driver has been deleted successfully.';
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response        = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function validate_address($str)
    {
        if(!empty($str)){
            return true;
        }else{
            $this->form_validation->set_message('validate_address','Please enter valid google place address.');
            return false;  
        }    
    }//end function
}//End Class 