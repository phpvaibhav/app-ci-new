<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Teacher extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_admin_service_auth();
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('teacher_model');
          $id = $this->post('id');
       /* if($id):
        $where = array('im.instituteId'=>$id);*/

        $this->teacher_model->set_data();
        $list   = $this->teacher_model->get_list();
        
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
        switch ($serData->joinStatus) {
         
            case 1:
               $row[] = '<label class="label label-danger">'.$serData->joinShow.'</label>';
                break;
            case 0:
               $row[] = '<label class="label label-warning">'.$serData->joinShow.'</label>';
                break;
            
            default:
                  $row[] = '<label class="label label-warning">'.$serData->joinShow.'</label>';
                break;
        }        
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
        $userLink = base_url().'all-detail/'.encoding($serData->id);
        
      //  $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';

        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->id).'" data-url="adminapi/customer/customerDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->teacher_model->count_all(),
            "recordsFiltered"   => $this->teacher_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function 
}//End Class 