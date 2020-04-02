<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Blog extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
  		$this->check_admin_service_auth();
       $this->load->model('blog_model'); //load image model
    }
    public function list_post(){
        $this->load->helper('text');
        $this->load->model('blog_model');
        $this->blog_model->set_data();
        $list   = $this->blog_model->get_list();
        
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
        $action = '';
        $no++;
        $row        = array();
     
        $row[]      = $no;
        $imageLink   = base_url().$serData->image;
     
        $row[] = '<img src='.$imageLink.' alt="'.$serData->title.'" class="img-sm img-rounded" >';
        $row[]      = display_placeholder_text($serData->title); 
        $row[]      = display_placeholder_text($serData->instrument); 
        $row[]      = (display_placeholder_text($serData->fullName)=='NA') ? 'Admin' : display_placeholder_text($serData->fullName); 
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

            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->blogId).'" data-url="adminapi/blog/blogStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a>';
        }else{
            $action .= '<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to change status!" data-id="'.encoding($serData->blogId).'" data-url="adminapi/blog/blogStatus" data-list="1"  class="on-default edit-row table_action" title="Status"><i class="fa fa-times" aria-hidden="true"></i></a>';
        }
    
        $link = "javascript:void(0)";
        $editlink =base_url().'admin/blog/edit/'.encoding($serData->blogId);
        
        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$editlink.'"  class="on-default edit-row table_action" title="Edit" ><i class="fa fa-edit" aria-hidden="true"></i></a>'; 
        
        
        $userLink = base_url().'admin/blog/detail/'.encoding($serData->blogId);
        
        $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
         $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'" onclick="confirmAction(this);" data-message="You want to delete this record!" data-id="'.encoding($serData->blogId).'" data-url="adminapi/blog/blogDelete" data-list="1"  class="on-default edit-row table_action" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
        $row[]  = $action;
        $data[] = $row;

        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->blog_model->count_all(),
            "recordsFiltered"   => $this->blog_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
       
        $this->response($output);
    }//end function

    function add_post(){
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('instrumentId', 'instrument', 'trim|required');
        $blogId                          = $this->post('blogId');
        if(!$blogId):
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required|is_unique[blogs.slug]',
        array('is_unique' => 'Page slug already exist')
        );
        endif;
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{

			$title                          = $this->post('title');
            $slug                          = $this->post('slug');
            $instrumentId                          = $this->post('instrumentId');
            $description                          = $this->post('description');
		
			
			$data_val['title'] 		 		= $title;
            $data_val['slug']              = $slug;
            $data_val['instrumentId']              = $instrumentId;
            $data_val['description']              = $description;
		       // profile pic upload
            $this->load->model('Image_model');
          
            $image = array(); $imagepath = '';
            if (!empty($_FILES['image']['name'])) {
                $folder     = 'blog';
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
              //  pr($image);
            
            }
            if(!empty($imagepath)){
                $data_val['image']       =   $imagepath;
            }
            

            $blogId  = decoding($blogId);
            $isExist = $this->common_model->is_data_exists('blogs',array('blogId'=>$blogId));
            if($isExist){
                 $isExistslug = $this->common_model->is_data_exists('blogs',array('blogId  !='=>$blogId,'slug'=>$slug));
                if(!$isExistslug){
                    if(!empty($imagepath)){
                        if(!empty($isExist->image)){
                            $this->Image_model->delete_image('uploads/blog/',$isExist->image);
                        }
                        
                    }
                    
                    $result = $this->common_model->updateFields('blogs',$data_val,array('blogId'=>$blogId));
                        if($result){
                            $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(123));
                        }else{
                            $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                        }
                }else{
                    $response = array('status'=>FAIL,'message'=>'Slug already exist,Please check it.');
                }
                 
            }else{
               $result = $this->common_model->insertData('blogs',$data_val);
                if($result){
                    $response  = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(122));
                 }else{
                    $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
                }
            }  
            
        }
        $this->response($response);
    } //End Function
    function blogStatus_post(){
        $blogId             = decoding($this->post('id'));
        $where              = array('blogId'=>$blogId);
        $dataExist          = $this->common_model->is_data_exists('blogs',$where);
        if($dataExist){
            $status         = $dataExist->status ? 0:1;
            $dataExist      = $this->common_model->updateFields('blogs',array('status'=>$status),$where);
            $showmsg        = ($status==1)? "Active" : "Inactive";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function blogDelete_post(){
        $blogId     = decoding($this->post('id'));
        $where      = array('blogId'=>$blogId);
        $dataExist  = $this->common_model->is_data_exists('blogs',$where);
        if($dataExist){
          
            $dataExist = $this->common_model->deleteData('blogs',$where);
            $showmsg   = 'Record has been deleted successfully.';
            $response  = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response  = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
}//End Class 