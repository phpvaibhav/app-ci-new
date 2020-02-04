<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Vehicles extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function addVehicle_post(){
       
        $this->form_validation->set_rules('year', 'year', 'trim|required');
        $this->form_validation->set_rules('model', 'model', 'trim|required');
        $this->form_validation->set_rules('plate', 'plate', 'trim|required');
        $this->form_validation->set_rules('vin', 'vin', 'trim|required');
        $this->form_validation->set_rules('manufacturer', 'manufacturer', 'trim|required');
        $this->form_validation->set_rules('state', 'state', 'trim|required');
        $this->form_validation->set_rules('color', 'color', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));    
        }else{
          
			$data_val['year']       	= $this->post('year');
			$data_val['model']       	= $this->post('model');
			$data_val['plate']       	= $this->post('plate');
			$data_val['vin']       		= $this->post('vin');
			$data_val['manufacturer']   = $this->post('manufacturer');
			$data_val['state']      	= $this->post('state');
			$data_val['color']       	= $this->post('color');
			$vehicleId                  = decoding($this->post('vid'));
			$where                      = array('vehicleId'=>$vehicleId);
        	$isExist                    = $this->common_model->is_data_exists('vehicles',$where);
        	if($isExist){
        		$result                 = $this->common_model->updateFields('vehicles',$data_val,$where);
        		$msg                    = "Vehicle record updated successfully.";
        	}else{
        		$result                 = $this->common_model->insertData('vehicles',$data_val);
        		$msg                    = "Vehicle record added successfully.";
        	}
            if($result){
                $response              = array('status'=>SUCCESS,'message'=>$msg);
            }else{
                $response              = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            }        
        }
        $this->response($response);
    }//end function 
    public function addHistory_post(){
       
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('date', 'date', 'trim|required');
        $this->form_validation->set_rules('vehicleId', 'vehicle', 'trim|required');
        $hid = decoding($this->post('hid'));
        if($hid==0):
            if (empty($_FILES['attachment']['name'])) {
                $this->form_validation->set_rules('attachment', 'attachment', 'trim|required');
            }
        endif;
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{   
            $vehicleId                  = decoding($this->post('vehicleId'));
            $historyId                  = decoding($this->post('hid'));
            $data_val['vjobTypeId']     = $this->post('type');
            $data_val['date']           =  date('Y-m-d',strtotime($this->post('date')));
            $data_val['vehicleId']      = $vehicleId;
            //   pr($data_val);
            if (!empty($_FILES['attachment']['name'])) {
                $this->load->library('s3');
                $this->load->model('s3_model');
                $attachmentType         = $_FILES['attachment']['type'];
                $imageType              = explode("/",$attachmentType);
                $attachmentname         = $_FILES['attachment']['name'];
                $attachmentsize         = $_FILES['attachment']['size'];
                $attachmenttmp          = $_FILES['attachment']['tmp_name'];
                $attachmentext          = $this->s3_model->getExtension($attachmentname);
                $uploadFor              = "vehicles";
                //Rename image name.
                $actual_image_attachment = time().".".$attachmentext;
                    if($this->s3->putObjectFile($attachmenttmp, BUCKETNAME , $uploadFor.'/'.$actual_image_attachment, S3::ACL_PUBLIC_READ))
                    {
                        $data_val['attachment']         = $actual_image_attachment;
                        $data_val['fileType']           = isset($imageType[0]) ?$imageType[0]:'image';;
                    }
            }
            $where      = array('historyId'=>$historyId);
            $isExist    = $this->common_model->is_data_exists('vehicleHistory',$where);
            if($isExist){
                if(isset($data_val['attachment']) && !empty($data_val['attachment'])){
                 $this->s3_model->deleteImg($uploadFor,$isExist->attachment);
                }
                $result     = $this->common_model->updateFields('vehicleHistory',$data_val,$where);
                $msg        = "Vehicle history record updated successfully.";
            }else{
                $result     = $this->common_model->insertData('vehicleHistory',$data_val);                    
                $msg        = "Vehicle history added successfully.";
            }
            if($result){
                $response   = array('status'=>SUCCESS,'message'=>$msg);
            }else{
                $response   = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            } 
        }
        $this->response($response);
    }//end function  
    public function assignDriver_post(){
       
        $this->form_validation->set_rules('driverId', 'driverId', 'trim|required');
        $this->form_validation->set_rules('assignDate', 'assign date', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
        }else{
      		$vehicleId                  = decoding($this->post('vid'));
			$data_val['driverId']       = $this->post('driverId');
			$data_val['assignDate']     = date("Y-m-d",strtotime($this->post('assignDate')));
			$where                      = array('vehicleId'=>$vehicleId);
            $this->common_model->updateFields('assignVehicle',array('driverId'=>0),array('driverId'=>$data_val['driverId']));
        	$isExist                    = $this->common_model->is_data_exists('vehicles',$where);
            if($isExist){
            	$assignExist            = $this->common_model->is_data_exists('assignVehicle',$where);
                if($assignExist){
            		$result             = $this->common_model->updateFields('assignVehicle',$data_val,$where);
            		$msg                = "Vehicle assign driver successfully.";
            	}else{
            		$data_val['vehicleId']        = $vehicleId;
            		$result                       = $this->common_model->insertData('assignVehicle',$data_val);
            		$msg                          = "Vehicle assign driver successfully.";
            	}
                $response    = array('status'=>SUCCESS,'message'=>$msg);
            }else{
                $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            }  
        }
        $this->response($response);
    }//end function
    public function vehilceList_post(){
        $this->load->helper('text');
        $this->load->model('vehicle_model');
        $this->vehicle_model->set_data();
        $list       = $this->vehicle_model->get_list();
        $data       = array();
        $no         = $_POST['start'];
        foreach ($list as $serData) { 
            $action = '';
            $no++;
            $row    = array();
            $row[]  = $no;
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $link   = base_url().'vehicles/vehicleDetail/'.encoding($serData->vehicleId);
            $row[]  = '<a href="'.$link.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->year).'</a>'; 
            $row[]  = display_placeholder_text($serData->manufacturer); 
            $row[]  = display_placeholder_text($serData->model); 
            $row[]  = display_placeholder_text($serData->vin); 
            $row[]  = display_placeholder_text($serData->plate); 
            $row[]  = display_placeholder_text($serData->color); 
            $row[]  = display_placeholder_text($serData->state); 
            $row[]  = display_placeholder_text($serData->fullName); 
            if($serData->status){
            $row[]  = '<label class="label label-success">'.$serData->statusShow.'</label>';
            }else{ 
            $row[]  = '<label class="label label-danger">'.$serData->statusShow.'</label>'; 
            } 
            $link    = 'javascript:void(0)';
            $action .= "";
            if($serData->status){
                $action .= '<a href="'.$link.'" onclick="vehilceStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->vehicleId).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-check" aria-hidden="true"></i></a>';
            }else{
                $action .= '<a href="'.$link.'" onclick="vehilceStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->vehicleId).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-times" aria-hidden="true"></i></a>';
            }
            $link           = base_url().'vehicles/vehicleDetail/'.encoding($serData->vehicleId);
            $action         .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            $row[]  = $action;
            $data[] = $row;

        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->vehicle_model->count_all(),
            "recordsFiltered"   => $this->vehicle_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function     
    public function vehilceHistoryList_post(){
        $vehicleId = decoding($this->post('vid'));
        $this->load->helper('text');
        $this->load->model('vehiclehistory_model');
        $this->vehiclehistory_model->set_data(array('v.vehicleId'=>$vehicleId));
        $list   = $this->vehiclehistory_model->get_list();
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
            $action = '';
            $no++;
            $row    = array();
            /*  $row[] = $no;*/
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $row[] = display_placeholder_text(date('d/m/Y',strtotime($serData->date)));
            $row[] = display_placeholder_text($serData->type); 
        
            $attachmentUrl  = S3VEHICLE_URL.$serData->attachment; 
            if($serData->fileType=='image'){
                $attachment = '<img src="'.S3VEHICLE_URL.$serData->attachment.'" width="100" height="100">';   
            }else{
                $attachment = '<img src="'.base_url().'backend_assets/img/attachment/attachment.jpeg" width="100" height="100">'; 
            }
            $row[] = display_placeholder_text('<a href="'.S3VEHICLE_URL.$serData->attachment.'" target="_blank" title="">'.$attachment.'</a>');      
            $link    = 'javascript:void(0)';
            $action .= "";
            $link    = 'javascript:void(0);';
            $action .= '&nbsp;&nbsp;<a href="'.$link.'" onclick="editHistory(this)"  class="on-default edit-row table_action" data-typeid="'.$serData->vjobTypeId.'" data-hid="'.encoding($serData->historyId).'" data-filetypeid="'.$serData->fileType.'" data-attachmentid="'.$attachmentUrl.'" data-dateid="'.date('d-m-Y',strtotime($serData->date)).'" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>';
            $action .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$link.'"  class="on-default edit-row table_action" title="delete" onclick="vehilceHistoryDelete(this);" data-message="Are you sure want to delete this vehicle history." data-vhid="'.encoding($serData->historyId).'"><i class="fa fa-trash" aria-hidden="true"></i></a>';
            $row[]  = $action;
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->vehiclehistory_model->count_all(),
            "recordsFiltered"   => $this->vehiclehistory_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    function vehilceStatus_post(){
        $vehicleId      = decoding($this->post('use'));
        $where          = array('vehicleId'=>$vehicleId);
        $dataExist      = $this->common_model->is_data_exists('vehicles',$where);
        if($dataExist){
            $status     = $dataExist->status ?0:1;
            $dataExist  = $this->common_model->updateFields('vehicles',array('status'=>$status),$where);
            $showmsg    = ($status==1)? "Vehicle request is Active" : "Vehicle request is Inactive";
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
 	function vehicleDelete_post(){
        $vehicleId      = decoding($this->post('use'));
        $where          = array('vehicleId'=>$vehicleId);
        $dataExist      = $this->common_model->is_data_exists('vehicles',$where);
        if($dataExist){   
            $dataExist  = $this->common_model->deleteData('vehicles',$where);
            $this->deleteImg('deficiency',$img[0]['file']);
            $showmsg    = 'Vehicle has been deleted successfully.';
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response    = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function vehilceHistoryDelete_post(){
        $historyId  = decoding($this->post('use'));
        $where      = array('historyId'=>$historyId);
        $dataExist  = $this->common_model->is_data_exists('vehicleHistory',$where);
        if($dataExist){
              
            $delete     = $this->common_model->deleteData('vehicleHistory',$where);
            $this->load->library('s3');
            $this->load->model('s3_model');
            $uploadFor  = "vehicles";
            $this->s3_model->deleteImg($uploadFor,$dataExist->attachment);
            $showmsg    = 'Vehicle history has been deleted successfully.';
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
            $response   = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function vehilceLatlong_post(){
        $latlong    = array();
        $this->load->model('vehicle_model');
        $driverId   = $this->post('driverId');
        $latlong    = $this->vehicle_model->vehilceLatlong($driverId);
        $response   = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(200),'data'=>$latlong);  
        $this->response($response);
    }//end function
}//End Class 