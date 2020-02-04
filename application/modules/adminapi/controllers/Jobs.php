<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Jobs extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function createJob_post(){
       
        $this->form_validation->set_rules('jobName', 'job name', 'trim|required');
        $this->form_validation->set_rules('jobTypeId', 'jobType', 'trim|required');
        $this->form_validation->set_rules('driverId', 'driver name', 'trim|required');
        $this->form_validation->set_rules('customerId', 'customer name', 'trim|required');
        $this->form_validation->set_rules('startDate', 'startDate', 'trim|required');
        $this->form_validation->set_rules('startTime', 'startTime', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('latitude', 'latitude', 'trim|required|min_length[2]|callback_validate_address');
        $geoFencing = $this->post('geoFencing');
        if($geoFencing){
            $this->form_validation->set_rules('boundary', 'geo fencing area', 'trim|required');   
        }
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors())); 
        }else{
            $data_val['jobName']                = $this->post('jobName');
            $data_val['jobTypeId']              = $this->post('jobTypeId');
            $jobTypeId                          = $this->post('jobTypeId');
            $data_val['driverId']               = $this->post('driverId');
            $data_val['customerId']             = $this->post('customerId');
            $data_val['startDate']              = date("Y-m-d",strtotime($this->post('startDate')));
            $data_val['startTime']              = $this->post('startTime');
            $data_val['address']                = $this->post('address');
            $data_val['street']                 = $this->post('street');
            $data_val['street2']                = $this->post('street2');
            $data_val['city']                   = $this->post('city');
            $data_val['state']                  = $this->post('state');
            $data_val['zip']                    = $this->post('zip');
            $data_val['country']                = $this->post('country');
            $data_val['latitude']               = $this->post('latitude');
            $data_val['longitude']              = $this->post('longitude');  
            $data_val['workPriority']           = $this->post('workPriority'); /*select address customer*/  
            $customer_val['latitude']           = $this->post('latitude');
            $customer_val['longitude']          = $this->post('longitude');
            $customer_val['customerId']         = $this->post('customerId');
            $questionId                         = $this->post('questionId');
            $jobId                              = decoding($this->post('jobId'));
            $parentId                           = decoding($this->post('parentId'));
            $where                              = array('jobId'=>$jobId);
            /*polygon*/
            $boundary                           = $this->input->post('boundary');
            $color                              = $this->input->post('polygonColor');
            $geo_val['points']                  = $boundary ;
            $geo_val['polygonColor']            = $color     ;
            $boundary1                          = array();
            if(!empty($boundary)):
                $pre    = explode("|",$boundary);
                $p      = array_values(array_filter($pre));
                for ($i=0; $i <sizeof($p) ; $i++) { 
                    $test           = explode(",",$p[$i]);
                    if(isset($test[0]) && !empty($test[0]) && isset($test[1]) && !empty($test[1]))
                    $boundary1[]    = $test[1]." ".$test[0];  
                }
                $t                  = explode(",",$p[0]);
                $be                 = $t[1]." ".$t[0];
                array_push($boundary1,$be);
            else:
                   
            endif;
            $boundaryP      = "";
            if(!empty($boundary1)){
                $hf         = implode(',',$boundary1);
                $boundaryP  = "PolygonFromText('POLYGON(($hf))')";
            }
            $geo_val['boundary']        = $boundaryP ;
            $geo_val['geoFencing']      = $geoFencing ;
            /*polygon*/
            $isExist                    = $this->common_model->is_data_exists('jobs',$where);
            $isExistParentId            = $this->common_model->is_data_exists('jobs',array('jobId' =>$parentId));
            if($isExistParentId){
                $data_val['parentId']   = $isExistParentId->jobId;
            }
            $questions                  =  $this->common_model->getAll('jobQuestionAnswer',array('jobId'=>$jobId));
             //delete quetion
            $que        = array();
            foreach ($questions as $key => $question) {
               $que[]   = $question->questionId;
            }
            if(isset($questionId) && !empty($questionId)){
                $array_diff = array_diff($que,$questionId);
                if(!empty($array_diff)){
                    foreach ($array_diff as $key => $value) {
                        $this->common_model->deleteData('jobQuestionAnswer',array('jobId'=>$jobId,'questionId'=>$value));
                    }
                }
            }else{
                $questionId = array();
                $array_diff = array_diff($que,$questionId);
                if(!empty($array_diff)){
                    foreach ($array_diff as $key => $value) {
                        $this->common_model->deleteData('jobQuestionAnswer',array('jobId'=>$jobId,'questionId'=>$value));
                    }
                } 
            }
            //delete quetion
            if($isExist){
                $result = $this->common_model->updateFields('jobs',$data_val,$where);
                $result =  $isExist->jobId;
                $msg    = "Job record updated successfully.";
            }else{
                $result = $this->common_model->insertData('jobs',$data_val);
                $msg    = "Job created successfully.";
            }
            //$jobId = $this->common_model->insertData('jobs',$data_val);
            if($result){
                $this->load->model('job_model');
                $this->job_model->jobPolygonUdpate($geo_val,$result);
                /*customer add address*/
                $address = $this->common_model->is_data_exists('customerAddress',$customer_val);
                if(!$address){
                    $customer_val['address']               = $this->post('address');
                    $customer_val['street']                = $this->post('street');
                    $customer_val['street2']               = $this->post('street2');
                    $customer_val['city']                  = $this->post('city');
                    $customer_val['state']                 = $this->post('state');
                    $customer_val['zip']                   = $this->post('zip');
                    $customer_val['country']               = $this->post('country');
                    $this->common_model->insertData('customerAddress',$customer_val);
                }
                /*customer add address*/
                /*question*/
                if(isset($questionId) && !empty($questionId)){
                    $array_diff = array_diff($que,$questionId);
                    $x          = 0;
                    $queData    = array();
                    foreach ($questionId as $key => $value) {
                       if(!in_array($value,$que)){
                            $queData[$x]['jobId']        =  $result ; 
                            $queData[$x]['jobTypeId']    =  $jobTypeId ;
                            $queData[$x]['questionId']   =  $value ;
                            $x++;
                       }
                    }
                    if(!empty($queData)){
                        $this->common_model->insertBatch('jobQuestionAnswer', $queData);
                    }
                }//endif
                /*question*/
                $response       = array('status'=>SUCCESS,'message'=>$msg);
            }else{
                $response       = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            }  
        }
        $this->response($response);
    }//end function
    public function jobList_post(){
        $this->load->helper('text');
        $this->load->model('job_model');
        $this->job_model->set_data();
        $list   = $this->job_model->get_list();
        $data   = array();
        $no     = $_POST['start'];
        foreach ($list as $serData) { 
            $action     = '';
            $no++;
            $row        = array();
            $jobLink    = base_url().'jobs/jobDetail/'.encoding($serData->jobId);
            $row[]      = $no;
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $row[]      = '<a href="'.$jobLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->jobName).'</a>'; 
            $row[]      = display_placeholder_text($serData->jobType); 
            $row[]      = display_placeholder_text($serData->customerName); 
            $row[]      = display_placeholder_text($serData->driverName); 
            $row[]      = date("d/m/Y",strtotime($serData->startDate));
            //." ".display_placeholder_text($serData->startTime); 
            switch ($serData->workPriority) {
                case 2:
                   $row[]       = '<label class="label label-danger">'.$serData->priority.'</label>';
                    break;
                case 1:
                   $row[]       = '<label class="label label-warning">'.$serData->priority.'</label>';
                    break;
                case 0:
                   $row[]       = '<label class="label label-info">'.$serData->priority.'</label>';
                    break;
                
                default:
                      $row[]    = '<label class="label label-warning">'.$serData->priority.'</label>';
                    break;
            }
            switch ($serData->jobStatus) {
                case 2:
                   $row[]       = '<label class="label label-success">'.$serData->statusShow.'</label>';
                    break;
                case 1:
                   $row[]       = '<label class="label label-danger">'.$serData->statusShow.'</label>';
                    break;
                case 0:
                   $row[]       = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                    break;
                
                default:
                      $row[]    = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                    break;
            }
            $link                = 'javascript:void(0)';
            $action             .= "";
            // $userLink = "javascript:void(0);";
            $action             .= '<a href="'.$jobLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            $pdfLink             = base_url().'jobs/jobDetailPdf/'.encoding($serData->jobId);
            $action             .= '&nbsp;&nbsp;<a href="'.$pdfLink.'"  class="on-default edit-row table_action" title="Pdf Download" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
            $copyLink             = base_url().'jobs/cloneJob/'.encoding($serData->jobId);
            $action             .= '&nbsp;&nbsp;<a href="'.$copyLink.'"  class="on-default edit-row table_action" title="Clone Job"><i class="glyphicon glyphicon-duplicate" aria-hidden="true"></i></a>';
            $row[]  = $action;
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->job_model->count_all(),
            "recordsFiltered"   => $this->job_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format 
        $this->response($output);
    }//end function 
    public function customnerjobList_post(){
        $this->load->helper('text');
        $this->load->model('job_model');
        $this->job_model->set_data(array('j.customerId'=>$this->post('id')));
        $list           = $this->job_model->get_list();
        $data           = array();
        $no             = $_POST['start'];
        foreach ($list as $serData) { 
            $action     = '';
            $no++;
            $row        = array();
            $row[]      = $no;
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $jobLink    = base_url().'jobs/jobDetail/'.encoding($serData->jobId);
            $row[]      = '<a href="'.$jobLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->jobName).'</a>'; 
            $row[]      = display_placeholder_text($serData->jobType); 
           // $row[]      = display_placeholder_text($serData->customerName); 
            $row[]      = display_placeholder_text($serData->driverName); 
            $row[]      = date("d/m/Y",strtotime($serData->startDate));
            ///." ".display_placeholder_text($serData->startTime); 
            switch ($serData->workPriority) {
                case 2:
                   $row[]       = '<label class="label label-danger">'.$serData->priority.'</label>';
                    break;
                case 1:
                   $row[]       = '<label class="label label-warning">'.$serData->priority.'</label>';
                    break;
                case 0:
                   $row[]       = '<label class="label label-info">'.$serData->priority.'</label>';
                    break;
                
                default:
                      $row[]    = '<label class="label label-warning">'.$serData->priority.'</label>';
                    break;
            }
            switch ($serData->jobStatus) {
                case 2:
                   $row[]   = '<label class="label label-success">'.$serData->statusShow.'</label>';
                    break;
                case 1:
                   $row[]   = '<label class="label label-danger">'.$serData->statusShow.'</label>';
                    break;
                case 0:
                   $row[]   = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                    break;
                
                default:
                    $row[]  = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                    break;
            }
            $link           = 'javascript:void(0)';
            $action         .= "";
       
            $userLink       = base_url().'jobs/jobDetail/'.encoding($serData->jobId);
            // $userLink = "javascript:void(0);";
            $action         .= '&nbsp;<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
            $pdfLink        = base_url().'jobs/jobDetailPdf/'.encoding($serData->jobId);
            $action         .= '&nbsp;<a href="'.$pdfLink.'"  class="on-default edit-row table_action" title="Pdf Download" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
            $copyLink             = base_url().'jobs/cloneJob/'.encoding($serData->jobId);
            $action             .= '&nbsp;&nbsp;<a href="'.$copyLink.'"  class="on-default edit-row table_action" title="Clone Job"><i class="glyphicon glyphicon-duplicate" aria-hidden="true"></i></a>';
           
            $row[]          = $action;
            $data[]         = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->job_model->count_all(),
            "recordsFiltered"   => $this->job_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    public function driverjobList_post(){
        $this->load->helper('text');
        $this->load->model('job_model');
        $this->job_model->set_data(array('j.driverId'=>$this->post('id')));
        $list           = $this->job_model->get_list();
        $data           = array();
        $no             = $_POST['start'];
        foreach ($list as $serData) { 
            $action     = '';
            $no++;
            $row        = array();
            $row[]      = $no;
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $jobLink    = base_url().'jobs/jobDetail/'.encoding($serData->jobId);
            $row[]      = '<a href="'.$jobLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->jobName).'</a>'; 
            $row[]      = display_placeholder_text($serData->jobType); 
            $row[]      = display_placeholder_text($serData->customerName); 
          //  $row[]      = display_placeholder_text($serData->driverName); 
            $row[]      = date("d/m/Y",strtotime($serData->startDate));
            //." ".display_placeholder_text($serData->startTime); 
            switch ($serData->workPriority) {
                case 2:
                   $row[]       = '<label class="label label-danger">'.$serData->priority.'</label>';
                    break;
                case 1:
                   $row[]       = '<label class="label label-warning">'.$serData->priority.'</label>';
                    break;
                case 0:
                   $row[]       = '<label class="label label-info">'.$serData->priority.'</label>';
                    break;
                
                default:
                      $row[]    = '<label class="label label-warning">'.$serData->priority.'</label>';
                    break;
            }
            switch ($serData->jobStatus) {
                case 2:
                   $row[]       = '<label class="label label-success">'.$serData->statusShow.'</label>';
                    break;
                case 1:
                   $row[]       = '<label class="label label-danger">'.$serData->statusShow.'</label>';
                    break;
                case 0:
                   $row[]       = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                    break;
                
                default:
                      $row[]    = '<label class="label label-warning">'.$serData->statusShow.'</label>';
                    break;
            }
       
            $link               = 'javascript:void(0)';
            $action             .= "";
       
            $userLink           = base_url().'jobs/jobDetail/'.encoding($serData->jobId);
            // $userLink = "javascript:void(0);";
            $action             .= '<a href="'.$userLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;';
            $pdfLink            = base_url().'jobs/jobDetailPdf/'.encoding($serData->jobId);
            $action             .= '&nbsp;<a href="'.$pdfLink.'"  class="on-default edit-row table_action" title="Pdf Download" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
            $copyLink             = base_url().'jobs/cloneJob/'.encoding($serData->jobId);
            $action              .= '&nbsp;&nbsp;<a href="'.$copyLink.'"  class="on-default edit-row table_action" title="Clone Job"><i class="glyphicon glyphicon-duplicate" aria-hidden="true"></i></a>';
            $row[]              = $action;
            $data[]             = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->job_model->count_all(),
            "recordsFiltered"   => $this->job_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    function jobStatus_post(){
        $jobId          = decoding($this->post('use'));
        $status         = $this->post('status');
        $where          = array('jobId'=>$jobId);
        $dataExist      = $this->common_model->is_data_exists('jobs',$where);
        if($dataExist){
            $dataExist  = $this->common_model->updateFields('jobs',array('jobStatus'=>$status),$where);
            $showmsg    = ($status==2)? "Job has been manually completed successfully." : "Job has been manually  started successfully.";
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response    = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function jobDelete_post(){
        $jobId              = decoding($this->post('use'));
        $where              = array('jobId'=>$jobId);
        $dataExist          = $this->common_model->is_data_exists('jobs',$where);
        if($dataExist){
            $dataExist      = $this->common_model->deleteData('jobs',$where);
            $showmsg        = "Job has been deleted successfully.";
            $response       = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response        = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function validate_address($str)
    {
        if(!empty($str)){
            return true;
        }else{
          $this->form_validation->set_message('validate_address','Please enter valid google place address.');
        return false;  
        }   
    }//end function
}//End Class 