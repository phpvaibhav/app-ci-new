<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Classint extends Common_Service_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_service_auth();
    }

    // For Add 
    function add_post(){

        $this->form_validation->set_rules('className', 'class name', 'trim|required');
        $this->form_validation->set_rules('instituteId', 'instituteId', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
            $this->response($response);
        }
        else{
         
            $className                      = $this->post('className');
            $instituteId                       = $this->post('instituteId');
         
     
            $data_val['className']          =   $className;
            $data_val['instituteId']           =   $instituteId;
       
            $lastId = $this->common_model->insertData('institute_classes',$data_val);
            if($lastId){
 				$response = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
             }else{
                $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            }   
            $this->response($response);
        }
    } //End Function
        public function list_post(){
        $this->load->helper('text');
        $this->load->model('classint_model');
        $instituteId = $this->post('id');
        $where = array('instituteId'=>$instituteId);
        $this->classint_model->set_data($where);
        $list   = $this->classint_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
      
        $row[]      = $no;
        $row[]      = display_placeholder_text($serData->className);   
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

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->id).'" data-url="apiv1/classint/classStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->id).'" data-url="apiv1/classint/classStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
      

        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->id).'" data-url="apiv1/classint/classDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->classint_model->count_all(),
            "recordsFiltered"   => $this->classint_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function 
    function classStatus_post(){
        $classId             = decoding($this->post('id'));
        $where              = array('classId'=>$classId);
        $dataExist          = $this->common_model->is_data_exists('institute_classes',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('institute_classes',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function classDelete_post(){
        $classId     = decoding($this->post('id'));
        $where      = array('classId'=>$classId);
        $dataExist  = $this->common_model->is_data_exists('institute_classes',$where);
        if($dataExist){
            $dataExist = $this->common_model->deleteData('institute_classes',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 