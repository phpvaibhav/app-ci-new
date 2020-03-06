<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Page extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_admin_service_auth();
        $this->load->model('page_model'); //load image model
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('page_model');
        $this->page_model->set_data();
        $list   = $this->page_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
     
        $row[]      = $no;
        $row[]      = display_placeholder_text($serData->title); 
        $row[]      = display_placeholder_text($serData->slug); 
        //$row[]      = display_placeholder_text((mb_substr($serData->description, 0,100) .((strlen($serData->description) >100) ? '...' : ''))); ; 
    
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

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->pageId).'" data-url="adminapi/page/pageStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->pageId).'" data-url="adminapi/page/pageStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
        $link = base_url().'admin/page/edit/'.encoding($serData->pageId);
        $prelink = base_url().'info-page/'.$serData->slug;
        $linkD = "javascript:void(0)";
        
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>'; 
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$prelink.'" target="_blank"  class="on-default edit-row table_action" title="Pr-view"><i class="fa fa-link" aria-hidden="true"></i></a>';
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$linkD.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->pageId).'" data-url="adminapi/page/pageDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';

        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->page_model->count_all(),
            "recordsFiltered"   => $this->page_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function

    function add_post(){
      
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $pageId                          = $this->post('pageId');
        if(!$pageId):
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[pages.slug]',
            array('is_unique' => 'Page slug already exist')
        );
        endif;
       
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{
			$title                          = $this->post('title');
			$slug                      		= $this->post('slug');
			$description                    = $this->post('description');
			$data_val['title'] 		 		= $title;
			$data_val['slug'] 		 		= $slug;
			$data_val['description'] 		= $description;
            $data_val['meta_title']        = $this->post('meta_title');
            $data_val['meta_keyword']        = $this->post('meta_keyword');
            $data_val['meta_description']        = $this->post('meta_description');
            $pageId  = decoding($pageId);
            $isExist = $this->common_model->is_data_exists('pages',array('pageId'=>$pageId));
            if($isExist){
                 $isExistslug = $this->common_model->is_data_exists('pages',array('pageId  !='=>$pageId,'slug'=>$slug));
                if(!$isExistslug){
                    $result = $this->common_model->updateFields('pages',$data_val,array('pageId'=>$pageId));
                        if($result){
                            $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(123));
                        }else{
                            $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                        }
                }else{
                    $response = array('status'=>FAIL,'message'=>'Page slug already exist,Please check it.');
                }
                 
            }else{
               $result = $this->common_model->insertData('pages',$data_val);
                if($result){
                    $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
                 }else{
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                }
            }  
            
        }
        $this->response($response);
    } //End Function
    function pageStatus_post(){
        $pageId             = decoding($this->post('id'));
        $where              = array('pageId'=>$pageId);
        $dataExist          = $this->common_model->is_data_exists('pages',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('pages',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function pageDelete_post(){
        $pageId     = decoding($this->post('id'));
        $where      = array('pageId'=>$pageId);
        $dataExist  = $this->common_model->is_data_exists('pages',$where);
        if($dataExist){
          
            $dataExist = $this->common_model->deleteData('pages',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 