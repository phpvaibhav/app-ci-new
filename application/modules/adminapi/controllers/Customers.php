<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Customers extends Common_Admin_Controller{  
    public function __construct(){
        parent::__construct();

        $this->check_admin_service_auth();
    }
    public function addCustomer_post(){
        $userId     = decoding($this->post('cus'));
        $where      = array('id'=>$userId);
        $dataExist  = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        }else{
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]',
            array('is_unique' => 'Email already exist'));
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[20]');
        }  
        $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|required|min_length[10]|max_length[20]');
        $this->form_validation->set_rules('fullName', 'full Name', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('latitude', 'latitude', 'trim|required|min_length[2]|callback_validate_address');
        $this->form_validation->set_rules('latitude1', 'billing latitude', 'trim|required|min_length[2]|callback_validate_billaddress');

        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));       
        }else{
            $authtoken                  = $this->common_model->generate_token();
            $passToken                  = $this->common_model->generate_token();
            $userData['fullName']       = $this->post('fullName');
            $userData['email']          = $this->post('email');
            $userData['password']       =  password_hash($this->post('password'), PASSWORD_DEFAULT);
            $userData['contactNumber']  = $this->post('contactNumber');
            $userData['userType']       = 1;
            $userData['authToken']      =   $authtoken;
            $userData['passToken']      =   $passToken;
            //User meta
            $userMeta['address']        = $this->post('address');
            $userMeta['street']         = $this->post('street');
            $userMeta['street2']        = $this->post('street2');
            $userMeta['city']           = $this->post('city');
            $userMeta['state']          = $this->post('state');
            $userMeta['zip']            = $this->post('zip');
            $userMeta['country']        = $this->post('country');
            $userMeta['latitude']       = $this->post('latitude');
            $userMeta['longitude']      = $this->post('longitude');
            $userMeta['billAddress']    = $this->post('address1');
            $userMeta['billStreet']     = $this->post('street1');
            $userMeta['billStreet2']    = $this->post('street21');
            $userMeta['billCity']       = $this->post('city1');
            $userMeta['billState']      = $this->post('state1');
            $userMeta['billZip']        = $this->post('zip1');
            $userMeta['billCountry']    = $this->post('country1');
            $userMeta['billLatitude']   = $this->post('latitude1');
            $userMeta['billLongitude']  = $this->post('longitude1');
            //data_val
            $data_val['address']        = $this->post('address');
            $data_val['street']         = $this->post('street');
            $data_val['street2']        = $this->post('street2');
            $data_val['city']           = $this->post('city');
            $data_val['state']          = $this->post('state');
            $data_val['zip']            = $this->post('zip');
            $data_val['country']        = $this->post('country');
            $data_val['latitude']       = $this->post('latitude');
            $data_val['longitude']      = $this->post('longitude');
            $data_val1['address']       = $this->post('address1');
            $data_val1['street']        = $this->post('street1');
            $data_val1['street2']       = $this->post('street21');
            $data_val1['city']          = $this->post('city1');
            $data_val1['state']         = $this->post('state1');
            $data_val1['zip']           = $this->post('zip1');
            $data_val1['country']       = $this->post('country1');
            $data_val1['latitude']      = $this->post('latitude1');
            $data_val1['longitude']     = $this->post('longitude1');
                
            if($dataExist){
                 $isemailExist          = $this->common_model->is_data_exists('users',array('id !='=>$userId,'email'=> $userData['email']));
                 if($isemailExist){
                     $response          = array('status'=>FAIL,'message'=>"Email already exist");
                 }else{
                    $update             = $this->common_model->updateFields('users',$userData,$where);
                    if($update){
                        $userMeta['userId']         = $userId;
                        $data_val['customerId']     = $userId;
                        $data_val1['customerId']    = $userId;
                        $this->common_model->updateFields('customerMeta',$userMeta,array('userId'=>$userId));
                    /*addres*/
                        $this->load->model('customer_model');
                        $this->customer_model->customerAddressManage($data_val);
                        $this->customer_model->customerAddressManage($data_val1);
                    /*addres*/
                    $response           = array('status'=>SUCCESS,'message'=>"Customer record updated successfully.");
                    }else{
                    $response           = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                    } 
                }
               
            }else{
                $userId                 = $this->common_model->insertData('users',$userData);
                if($userId){
                    $userMeta['userId']         = $userId;
                    $data_val['customerId']     = $userId;
                    $data_val1['customerId']    = $userId;
                    $this->common_model->insertData('customerMeta',$userMeta);
                    /*addres*/
                        $this->load->model('customer_model');
                        $this->customer_model->customerAddressManage($data_val);
                        $this->customer_model->customerAddressManage($data_val1);
                    /*addres*/
                    $response                 = array('status'=>SUCCESS,'message'=>"Customer record added successfully.");
                }else{
                    $response                 = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                } 
            }       
        }
        $this->response($response);
    }//end function
    public function customerList_post(){
        $this->load->helper('text');
        $this->load->model('customer_model');
        $this->customer_model->set_data(array('userType' =>1));
        $list           = $this->customer_model->get_list();
        $data           = array();
        $no             = $_POST['start'];
        foreach ($list as $serData) { 
            $action     = '';
            $no++;
            $row        = array();
            /*  $row[] = $no;*/
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $userLink   = base_url().'customers/customerDetail/'.encoding($serData->id);
            $row[]      = '<a href="'.$userLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->fullName).'</a>'; 
            $row[]      = display_placeholder_text($serData->email); 
            $row[]      = display_placeholder_text($serData->contactNumber); 
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

        $output     = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->customer_model->count_all(),
            "recordsFiltered"   => $this->customer_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    function customerStatus_post(){
        $userId             = decoding($this->post('use'));
        $where              = array('id'=>$userId);
        $dataExist          = $this->common_model->is_data_exists('users',$where);
        if($dataExist){
            $status         = $dataExist->status ?0:1;
            $dataExist      = $this->common_model->updateFields('users',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Customer request is Active" : "Customer request is Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function creditHoldStatus_post(){
        $userId             = decoding($this->post('use'));
        $where              = array('userId'=>$userId);
        $dataExist          = $this->common_model->is_data_exists('customerMeta',$where);
        if($dataExist){
            $status         = $dataExist->creditHoldStatus ? 0:1;
            $dataExist      = $this->common_model->updateFields('customerMeta',array('creditHoldStatus'=>$status),$where);
            $showmsg        = 'Customer has been credit hold changed successfully.';
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
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
    function getPreviousAddress_post(){
        $customerId     = $this->post('customerId');  
        $where          = array('customerId'=>$customerId);
        $addresses      = $this->common_model->getAll('customerAddress',$where,'addressId','desc');
        if($addresses){
            $data       = "";
            foreach ($addresses as $key => $address) {
                $data .= '<label class="radio setAddessLocation" onclick="radio_fun(this);" >';
                $data .= '<i class="fa fa-map-marker" aria-hidden="true"></i> <input type="radio" class="hideradio" latitude="'.$address->latitude.'" longitude="'.$address->longitude.'" street="'.$address->street.'" street2="'.$address->street2.'" city="'.$address->city.'" state="'.$address->state.'" zip="'.$address->zip.'" country="'.$address->country.'"  name="address_location" value="'.$address->address.'"/> '.$address->address;
                $data .= '</label>';
            }
            $showmsg  = 'Record found.';
            $response = array('status'=>SUCCESS,'message'=>$showmsg,'address'=>$data);
        }else{
            $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
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
    function validate_billaddress($str)
    {
        if(!empty($str)){
            return true;
        }else{
            $this->form_validation->set_message('validate_billaddress','Please enter valid google place billing address.');
            return false;  
        }
    }//end function
}//End Class 