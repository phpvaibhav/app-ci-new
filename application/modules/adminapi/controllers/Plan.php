<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Plan extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_admin_service_auth();
     
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('plan_model');
        $this->plan_model->set_data();
        $list   = $this->plan_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
     
        $row[]      = $no;
        $row[]      = display_placeholder_text($serData->title); 
       
        
    
        switch ($serData->planType) {
         
            case 1:
               $row[] = '<label class="label label-success">'.$serData->planShow.'</label>';
                break; 
            case 2:
               $row[] = '<label class="label label-success">'.$serData->planShow.'</label>';
                break;
            case 3:
               $row[] = '<label class="label label-success">'.$serData->planShow.'</label>';
                break;            
            case 4:
               $row[] = '<label class="label label-success">'.$serData->planShow.'</label>';
                break;
            case 0:
               $row[] = '<label class="label label-warning">'.$serData->planShow.'</label>';
                break;
            
            default:
                  $row[] = '<label class="label label-warning">'.$serData->planShow.'</label>';
                break;
        } 
        $row[]      = display_placeholder_text($serData->planFor);        
        $row[]      = display_placeholder_text($serData->price);        
        $row[]      = display_placeholder_text($serData->discount);        
        $row[]      = display_placeholder_text($serData->studentCount);        
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

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->planId).'" data-url="adminapi/plan/planStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->planId).'" data-url="adminapi/plan/planStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
        $link = base_url().'admin/plan/edit/'.encoding($serData->planId);
       
        $linkD = "javascript:void(0)";
        
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>'; 
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$linkD.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->planId).'" data-url="adminapi/plan/planDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';

        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->plan_model->count_all(),
            "recordsFiltered"   => $this->plan_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function

    function add_post(){
      
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('planFor', 'plan for', 'trim|required');
        $this->form_validation->set_rules('planType', 'plan type', 'trim|required');
        $this->form_validation->set_rules('studentCount', 'No. Of students', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_rules('discount', 'discount', 'trim|required');
        $planId                          = $this->post('planId');
      
      
       
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{
			$title                          = $this->post('title');
			//$slug                      		= $this->post('slug');
			$description                    = $this->post('description');
			$data_val['title'] 		 		= $title;
			//$data_val['slug'] 		 		= $slug;
			$data_val['description'] 		    = $description;
            $data_val['planFor']             = $this->post('planFor');
            $data_val['planType']        = $this->post('planType');
            $data_val['studentCount']        = $this->post('studentCount');
            $data_val['price']        = $this->post('price');
            $data_val['discount']        = $this->post('discount');
            $data_val['sort_by']        = $this->post('sort_by');
            $data_val['description']        = $this->post('description');
            $planId  = decoding($planId);
            $isExist = $this->common_model->is_data_exists('membership_plan',array('planId'=>$planId));
            if($isExist){
                 $isExistslug = $this->common_model->is_data_exists('membership_plan',array('planId  !='=>$planId,'planFor'=>$data_val['planFor'],'planType'=>$data_val['planType']));
                if(!$isExistslug){
                    $result = $this->common_model->updateFields('membership_plan',$data_val,array('planId'=>$planId));
                        if($result){
                            $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(123));
                        }else{
                            $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                        }
                }else{
                    $response = array('status'=>FAIL,'message'=>'Page slug already exist,Please check it.');
                }
                 
            }else{
               $result = $this->common_model->insertData('membership_plan',$data_val);
                if($result){
                    $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
                 }else{
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                }
            }  
            
        }
        $this->response($response);
    } //End Function
    function planStatus_post(){
        $pageId             = decoding($this->post('id'));
        $where              = array('planId'=>$pageId);
        $dataExist          = $this->common_model->is_data_exists('membership_plan',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('membership_plan',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function planDelete_post(){
        $pageId     = decoding($this->post('id'));
        $where      = array('planId'=>$pageId);
        $dataExist  = $this->common_model->is_data_exists('membership_plan',$where);
        if($dataExist){
          
            $dataExist = $this->common_model->deleteData('membership_plan',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 