<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Institute extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function instituteList_post(){
        $this->load->helper('text');
        $this->load->model('institute_model');
        $this->institute_model->set_data();
        $list   = $this->institute_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
        $imageLink   = base_url().(!empty($serData->logo)? 'uploads/logo/'.$serData->logo : 'common_assets/img/placeholder-logo.png');
        $row[]      = $no;
        $row[] = '<img src='.$imageLink.' alt="'.$serData->name.'" class="img-sm img-rounded" >';
        $row[]      = display_placeholder_text($serData->name); 
        $row[]      = display_placeholder_text($serData->email); 
        $row[]      = display_placeholder_text($serData->phoneNumber); 
        $row[]      = display_placeholder_text($serData->createdBy); 
        switch ($serData->status) {
         
            case 1:
               $row[] = '<label class="label label-success">'.$serData->statusShow.'</label>';
                break;
            case 0:
               $row[] = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                break;
            
            default:
                  $row[] = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                break;
        }
       
            $link      ='javascript:void(0)';
            $action .= "";
       if($serData->status){

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->instituteId).'" data-url="adminapi/institute/instituteStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->instituteId).'" data-url="adminapi/institute/instituteStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
        $link = base_url().'institute-detail/'.encoding($serData->instituteId);
        
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->instituteId).'" data-url="adminapi/institute/instituteDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';

        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->institute_model->count_all(),
            "recordsFiltered"   => $this->institute_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function
        function instituteStatus_post(){
        $userId             = decoding($this->post('id'));
        $where              = array('instituteId'=>$userId);
        $dataExist          = $this->common_model->is_data_exists('institute',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('institute',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function instituteDelete_post(){
        $userId     = decoding($this->post('id'));
        $where      = array('instituteId'=>$userId);
        $dataExist  = $this->common_model->is_data_exists('institute',$where);
        if($dataExist){
            if(!empty($dataExist->profileImage)){
                $this->load->model('Image_model');
                $this->Image_model->delete_image('uploads/logo/',$dataExist->logo);
            }
            $dataExist = $this->common_model->deleteData('institute',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function

}//End Class 

