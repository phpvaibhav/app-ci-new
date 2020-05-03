<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Support extends Common_Service_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_service_auth();
        $this->load->model('support_model'); //load image model
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('support_model');
        $id = $this->post('id');
        $this->support_model->set_data(array('t.userId'=>$id));
        $list   = $this->support_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
     
        $row[]      = $no;
        $row[]      = display_placeholder_text($serData->ticketNumber); 
        $row[]      = display_placeholder_text($serData->title); 
        $row[]      = $serData->userType ? 'Self':'Admin'; 
        $row[]      = display_placeholder_text(date('d-m-Y',strtotime($serData->crd))); 
        switch ($serData->resolved) {
         
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
       if($serData->resolved){

          //  $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->instrumentId).'" data-url="adminapi/instrument/instrumentStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
           /* $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change resolve ticket!" data-id="'.encoding($serData->supportId).'" data-url="apiv1/support/supportStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>&nbsp;&nbsp;|';*/
        }
    
        $linkDetail = base_url()."support-detail-institute/".encoding($serData->supportId);
        
         $action .= '&nbsp;&nbsp;<a href="'.$linkDetail.'"  class="on-default edit-row table_action"><i class="fa fa-eye" aria-hidden="true"></i></a>'; 
        
       /*  $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->supportId).'" data-url="apiv1/support/supportDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';*/

        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->support_model->count_all(),
            "recordsFiltered"   => $this->support_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function

    function add_post(){
      
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('userId', 'user', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $supportId                          = $this->post('supportId');

        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{
			$title                          = $this->post('title');
			$userId                          = $this->post('userId');
			$description                          = $this->post('description');
		
			
			$data_val['title'] 		 		= $title;
			$data_val['userType'] 		 		= 1;
			$data_val['userId'] 		 		= $userId;
			$data_val['message'] 		 		= $description;
			$data_val['ticketNumber'] 		 		= round(111111,999999);
		       // profile pic upload

            $supportId  = decoding($supportId);
            $isExist = $this->common_model->is_data_exists('support_tickets',array('supportId'=>$supportId));
            if($isExist){
         
                    $response = array('status'=>FAIL,'message'=>'Name already exist,Please check it.');
               
                 
            }else{
               $result = $this->common_model->insertData('support_tickets',$data_val);
                if($result){
                    $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
                 }else{
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                }
            }  
            
        }
        $this->response($response);
    } //End Function
    function supportStatus_post(){
        $supportId             = decoding($this->post('id'));
        $where              = array('supportId'=>$supportId);
        $dataExist          = $this->common_model->is_data_exists('support_tickets',$where);
        if($dataExist){
            $status         = $dataExist->resolved ? 0:1;
            $dataExist      = $this->common_model->updateFields('support_tickets',array('resolved'=>$status),$where);
            $showmsg        = ($status==1)? "Resolved" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function supportDelete_post(){
        $supportId     = decoding($this->post('id'));
        $where      = array('supportId'=>$supportId);
        $dataExist  = $this->common_model->is_data_exists('support_tickets',$where);
        if($dataExist){
          
            $dataExist = $this->common_model->deleteData('support_tickets',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
      function supportReply_post(){
        $supportId             = decoding($this->post('supportId'));
        $where              = array('supportId'=>$supportId);
        $dataExist          = $this->common_model->is_data_exists('support_tickets',$where);
        if($dataExist){
            $data_val['supportId'] = $supportId;
            $data_val['message']  = $this->post('message');
            $data_val['userType']  = $this->post('userType');
            $data_val['userId']  = $this->post('userId');
            $lastId      = $this->common_model->insertData('ticket_replies',$data_val);
            if($lastId){
                  $response       = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
            }else{
                $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            }
          
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 