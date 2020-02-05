<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class School extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function schoolList_post(){
        $this->load->helper('text');
        $this->load->model('school_model');
        $this->school_model->set_data();
        $list   = $this->school_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
         $imageLink   = base_url().'company_assets/schoolLogo/'.$serData->schoolLogo;
        $row[]      = $no;
        $row[] = '<img src='.$imageLink.' alt="'.$serData->schoolName.'" class="img-sm img-rounded" >';
        $row[]      = display_placeholder_text($serData->schoolName); 
        $row[]      = display_placeholder_text($serData->schoolEmail); 
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
       
       
       // $userLink = "javascript:void(0);";
        $action .= '<a class="btn btn-success btn-bitbucket btn-outline"><i class="fa fa-eye" aria-hidden="true"></i></a>';   

        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->school_model->count_all(),
            "recordsFiltered"   => $this->school_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function 
}//End Class 

