<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Student extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_admin_service_auth();
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('student_model');
                        $id = $this->post('id');
      // $where = array('u.roleId'=>4);
       $where = "(`u.roleId`=4 AND `u.roleId`!=1 AND `u.roleId`!=2 AND `u.roleId`!=3 AND `u.roleId`!=5) AND `u.id` NOT IN (SELECT `userId` FROM `institute_student`)";
        $this->student_model->set_data($where);
        $list   = $this->student_model->get_list();
       // lq();
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
        $imageLink   = base_url().$serData->profileImage;
        $row[]      = $no;
        $row[] = '<img src='.$imageLink.' alt="'.$serData->firstName.'" class="img-sm img-rounded" >';
        $row[]      = display_placeholder_text($serData->firstName); 
        $row[]      = display_placeholder_text($serData->lastName); 
        $row[]      = display_placeholder_text($serData->email); 
        $row[]      = display_placeholder_text($serData->contactNumber);   
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

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->id).'" data-url="adminapi/customer/customerStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->id).'" data-url="adminapi/customer/customerStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
        $userLink = base_url().'student-detail/'.encoding($serData->id);
        
        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';

        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->id).'" data-url="adminapi/customer/customerDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->student_model->count_all(),
            "recordsFiltered"   => $this->student_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function 
    function teacherAssign_post(){
         $this->form_validation->set_rules('studentId', 'studentId', 'trim|required');
         $this->form_validation->set_rules('teacherId', 'teacherId', 'trim|required');
         if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
            
        }else{
            $studentId             = decoding($this->post('studentId'));
            $teacherId             = $this->post('teacherId');
            $where              = array('id'=>$studentId);
            $isExist          = $this->common_model->is_data_exists('users',$where);
            if($isExist){
                $data_val['studentId'] = $studentId;
                $assign = $this->common_model->is_data_exists('personal_student_assign_teacher',array('studentId'=>$studentId));
                if($assign){
                   $res= $this->common_model->updateFields('personal_student_assign_teacher',array('teacherId'=>$teacherId),array('studentId'=>$studentId));
                }else{
                  $res= $data_val['teacherId'] = $teacherId;
                   $this->common_model->insertData('personal_student_assign_teacher',$data_val); 
                }
                if($res){
                      $response = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(123));
                }else{
                    $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                }
            }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
            }
        }
        $this->response($response);
    }//End Function
}//End Class 