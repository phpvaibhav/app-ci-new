<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Tutorial extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_admin_service_auth();
        $this->load->model('tutorial_model'); //load image model
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('tutorial_model');
        $this->tutorial_model->set_data();
        $list   = $this->tutorial_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
     
        $row[]      = $no;
        $imageLink   = $serData->image;
     
       
        $row[]      = display_placeholder_text($serData->title); 
        $row[]      = display_placeholder_text($serData->type); 
          
        $row[] = '<a href='.$imageLink.' target="_blank" alt="'.$serData->title.'" > click Here</a>';
        $row[]      = display_placeholder_text((mb_substr($serData->description, 0,100) .((strlen($serData->description) >100) ? '...' : ''))); ;
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

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->tutorialId).'" data-url="adminapi/tutorial/tutorialStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->tutorialId).'" data-url="adminapi/tutorial/tutorialStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
    
        $link = "javascript:void(0)";
        
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="Edit" data-id="'.encoding($serData->tutorialId).'" data-title="'.$serData->title.'" data-image="'.$serData->image.'"  data-type="'.$serData->type.'" data-description="'.$serData->description.'" onclick="editAction(this);"><i class="fa fa-edit" aria-hidden="true"></i></a>'; 
        
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->tutorialId).'" data-url="adminapi/tutorial/tutorialDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';

        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->tutorial_model->count_all(),
            "recordsFiltered"   => $this->tutorial_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function

    function add_post(){
      
        //$this->form_validation->set_rules('title', 'title', 'trim|required');
        $tutorialId                          = $this->post('tutorialId');
      /*  if(!$tutorialId):
            $this->form_validation->set_rules('name', 'name', 'trim|required|is_unique[instrument.name]',
            array('is_unique' => 'Page name already exist')
        );
        else:
             $this->form_validation->set_rules('name', 'name', 'trim|required');
        endif;*/
         $this->form_validation->set_rules('title', 'title', 'trim|required');
         $this->form_validation->set_rules('roleType', 'roleType', 'trim|required');
         $this->form_validation->set_rules('image', 'image', 'trim|required');
           $this->form_validation->set_rules('description', 'description', 'trim|required');
            
            
       
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{
			$title                          = $this->post('title');
            $roleType                          = $this->post('roleType');
            $description                          = $this->post('description');
            $image                          = $this->post('image');
		
			
			$data_val['title'] 		 		= $title;
            $data_val['type']              = $roleType;
            $data_val['image']              = $image;
            $data_val['description']              = $description;
		       // profile pic upload
            $this->load->model('Image_model');
          
            $image = array(); $imagepath = '';
            if (!empty($_FILES['image']['name'])) {
                $folder     = 'tutorial';
                $image      = $this->Image_model->upload_image('image',$folder); //upload media of Seller
                
                //check for error
                if(array_key_exists("error",$image) && !empty($image['error'])){
                    $response = array('status' => FAIL, 'message' => strip_tags($image['error'].'(In user Image)'));
                    $this->response($response);
                }
                //check for image name if present
                if(array_key_exists("image_name",$image)):
                    $imagepath = $image['image_name'];
                endif;
            
            }
            if(!empty($imagepath)){
                $data_val['image']       =   $imagepath;
            }
            

            $tutorialId  = decoding($tutorialId);
            $isExist = $this->common_model->is_data_exists('tutorial',array('tutorialId'=>$tutorialId));
          //  lq();
            if($isExist){
                /* $isExistslug = $this->common_model->is_data_exists('instrument',array('instrumentId  !='=>$instrumentId,'name'=>$name));
                if(!$isExistslug){*/
                    if(!empty($imagepath)){
                        if(!empty($isExist->image)){
                            $this->Image_model->delete_image('uploads/tutorial/',$isExist->image);
                        }
                        
                    }
                    
                    $result = $this->common_model->updateFields('tutorial',$data_val,array('tutorialId'=>$tutorialId));
                        if($result){
                            $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(123));
                        }else{
                            $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                        }
                /*}else{
                    $response = array('status'=>FAIL,'message'=>'Name already exist,Please check it.');
                }*/
                 
            }else{
               $result = $this->common_model->insertData('tutorial',$data_val);
                if($result){
                    $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
                 }else{
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                }
            }  
            
        }
        $this->response($response);
    } //End Function
    function tutorialStatus_post(){
        $tutorialId             = decoding($this->post('id'));
        $where              = array('tutorialId'=>$tutorialId);
        $dataExist          = $this->common_model->is_data_exists('tutorial',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('tutorial',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function tutorialDelete_post(){
        $tutorialId     = decoding($this->post('id'));
        $where      = array('tutorialId'=>$tutorialId);
        $dataExist  = $this->common_model->is_data_exists('tutorial',$where);
        if($dataExist){
          
            $dataExist = $this->common_model->deleteData('tutorial',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 