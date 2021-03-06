<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Customer extends Common_Service_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_service_auth();
        $this->load->model('api_model'); //load image model
    }

    // For Registration 
    function registration_post(){
        $this->form_validation->set_rules('roleId', 'roleId', 'trim|required');
        $this->form_validation->set_rules('instituteId', 'instituteId', 'trim|required');
        
        $this->form_validation->set_rules('firstName', 'first name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('lastName', 'last name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',
            array('is_unique' => 'Email already exist')
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|min_length[10]|max_length[20]');
        
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
            $this->response($response);
        }
        else{
            $email                          = $this->post('email');
            $firstName                      = $this->post('firstName');
            $lastName                       = $this->post('lastName');
            $fullName                       = $firstName." ".$lastName;
            $contact                        = $this->post('contact');
            $roleId                         = $this->post('roleId');
            $instituteId                    = $this->post('instituteId');
            $teacherId                    = $this->post('teacherId');
            $authtoken                      = $this->api_model->generate_token();
            $passToken                      = $this->api_model->generate_token();
            //user info
            $userData['firstName']          =   $firstName;
            $userData['lastName']           =   $lastName;
            $userData['fullName']           =   $fullName;
            $userData['email']              =   $email;
            $userData['roleId']             =   $roleId;
            $userData['contactNumber']      =   $this->post('contact');
            $userData['authToken']          =   $authtoken;
            $userData['password']           =   password_hash($this->post('password'), PASSWORD_DEFAULT);
            $userData['authToken']          =   $authtoken;
            $userData['passToken']          =   $passToken;
            //user info
            //userMeta
            $user_meta = array();
            $assign_meta = array();
            $meta_table ="";
            $assign_table ="";
            $user_meta['instituteId'] = $instituteId;
            $assign_meta['instituteId'] = $instituteId;
            $assign_meta['teacherId']   = $teacherId;
            
            switch ($roleId) {
            	case 2://teacher
            	  $meta_table = 'institute_teacher' ;	
            	  $user_meta['joinStatus'] = 1;	
        		break;
            	case 3://staff
            	  $meta_table = 'institute_staff' ;
            	  $user_meta['joinStatus'] = 1;	
        		break;
            	case 4://student
            	  $meta_table = 'institute_student' ;
            	 $assign_table ="student_assign_teacher";
            	  $user_meta['joinStatus'] = 1;	
                  $user_meta['classId'] = $this->post('classId');

        		break;
            	case 5://paranets
            	  $meta_table = 'institute_parents' ;
            	  $user_meta['joinStatus'] = 1;	
        		break;
            	
            	default:
            		# code...
            		break;
            }
            //userMeta
            // profile pic upload
            $this->load->model('Image_model');
          
            $image = array(); $profileImage = '';
            if (!empty($_FILES['profileImage']['name'])) {
                $folder     = 'users';
                $image      = $this->Image_model->upload_image('profileImage',$folder); //upload media of Seller
                
                //check for error
                if(array_key_exists("error",$image) && !empty($image['error'])){
                    $response = array('status' => FAIL, 'message' => strip_tags($image['error'].'(In user Image)'));
                    $this->response($response);
                }
                //check for image name if present
                if(array_key_exists("image_name",$image)):
                    $profileImage = $image['image_name'];
                endif;
            
            }
            $userData['profileImage']       =   $profileImage;
            $result = $this->api_model->registration($userData);
            if(is_array($result)){

               switch ($result['regType']){
                    case "NR": // Normal registration
                    //check meta
                  	if(!empty($meta_table)){
                  	  $user_meta['userId'] = $result['returnData']->userId;	
                      $this->common_model->insertData($meta_table,$user_meta);
                  	}
                    if(!empty($assign_table) && !empty($teacherId)){
                      $assign_meta['studentId'] = $result['returnData']->userId; 
                      $this->common_model->insertData($assign_table,$assign_meta);
                    }
                    //check meta
                    $response = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(110), 'messageCode'=>'normal_reg','users'=>$result['returnData']);
                    break;
                    case "AE": // User already registered
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(117),'users'=>array());
                    break;
                    default:
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(121),'userDetail'=>array());
                }
             }else{
                $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118),'userDetail'=>array());
            }   
            $this->response($response);
        }
    } //End Function
    function customerStatus_post(){
        $userId             = decoding($this->post('id'));
        $where              = array('id'=>$userId);
        $dataExist          = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('users',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function customerDelete_post(){
        $userId     = decoding($this->post('id'));
        $where      = array('id'=>$userId);
        $dataExist  = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            if(!empty($dataExist->profileImage)){
                $this->load->model('Image_model');
                $this->Image_model->delete_image('uploads/user/',$dataExist->profileImage);
            }
            $dataExist = $this->common_model->deleteData('users',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 