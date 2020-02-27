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
       
        $link = base_url().'institute-detail/'.encoding($serData->instituteId);
        
         $action .= '&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';

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

}//End Class 

