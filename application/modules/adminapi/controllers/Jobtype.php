<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//General service API class 
class Jobtype extends Common_Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->check_admin_service_auth();
    }
    public function createJobType_post(){
        $jobTypeId  = decoding($this->post('jobTypeId'));
        $jobType    = $this->post('jobType');
        $check      = $this->common_model->is_data_exists('jobType',array('jobTypeId !='=> $jobTypeId,'jobType'=> $jobType));

        if($check){
            $this->form_validation->set_rules('jobType', 'jobType', 'trim|required|is_unique[jobType.jobType]', array('is_unique' => 'Job type already exist'));
        }else{
           $this->form_validation->set_rules('jobType', 'jobType', 'trim|required'); 
        } 
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));   
        }else{
            //  pr($this->post());
            $data_val['jobType']        = $this->post('jobType');
            $total_element              = $this->post('total_element');
            $total_element              = !empty($total_element) ? $total_element :0;
            $queData                    = array();
            $queNonDeleteId             = array();
            $j = 0;
            for ($i=0; $i < $total_element ; $i++) { 
                $k                       = $i+1;
                $question                = $this->post('question_'.$k);
                $questionId              = $this->post('questionId_'.$k);
                if(!empty($questionId) && $questionId !=0){
                    $queNonDeleteId[]    = $questionId;
                }
                $questionType            = $this->post('questionType_'.$k);
                $option                  = $this->post('option_'.$k);
                $option1                 = $this->post('option_1_'.$k);
                if(isset($question) && !empty($question)){
                    $queData[$j]['questionId']      = $questionId;
                    $queData[$j]['question']        = $question;
                    $queData[$j]['questionType']    = $questionType;
                    if($questionType !='text'){
                        $queData[$j]['option']      = json_encode(array($option,$option1));
                    }else{
                        $queData[$j]['option']      = "";
                    }
                    $j++;
                } 
            }
                 
            $jobTypeId      = decoding($this->post('jobTypeId'));
            $where          = array('jobTypeId'=>$jobTypeId);               
            $isExist        = $this->common_model->is_data_exists('jobType',$where);
            if($isExist){
                $result     = $this->common_model->updateFields('jobType',$data_val,$where);
                $result     =  $isExist->jobTypeId;
                $jobTypeId  = $result;
                $msg        = "Job type record updated successfully.";
            }else{
                $result     = $this->common_model->insertData('jobType',$data_val);
                $jobTypeId  = $result;
                $msg        = "Job type created successfully.";
            }
            if(!empty($jobTypeId)){
                if(!empty($queNonDeleteId)){
                    $this->common_model->deleteDataJobType('jobTypeQuestions',array('jobTypeId'=>$jobTypeId),$queNonDeleteId);
                }    
                for ($x=0; $x <sizeof($queData) ; $x++) { 
                    $questionData                   = array();
                    $qId                            =  $queData[$x]['questionId'];
                    $questionData['question']       = $queData[$x]['question'];
                    $questionData['type']           = $queData[$x]['questionType'];
                    $questionData['options']        = $queData[$x]['option'];
                    $isQue                          = $this->common_model->is_data_exists('jobTypeQuestions',array('questionId'=>$qId));
                    if($isQue){
                        $this->common_model->updateFields('jobTypeQuestions',$questionData,array('questionId'=>$qId));
                    }else{
                        $questionData['jobTypeId']     = $jobTypeId;
                        $this->common_model->insertData('jobTypeQuestions',$questionData);
                    }
                }
            }
            //$jobId = $this->common_model->insertData('jobs',$data_val);
            if($result){
                $response = array('status'=>SUCCESS,'message'=>$msg);
            }else{
                $response = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));
            }  
        }
        $this->response($response);
    }//end function
    public function jobtypeList_post(){
        $this->load->helper('text');
        $this->load->model('jobtype_model');
        $this->jobtype_model->set_data();
        $list           = $this->jobtype_model->get_list();
        $data           = array();
        $no             = $_POST['start'];
        foreach ($list as $serData) { 
            $action     = '';
            $no++;
            $row        = array();
            $jobLink    = base_url().'jobtype/detail/'.encoding($serData->jobTypeId);
            $row[]      = $no;
            //$row[] = '<img src='.base_url($serData->profileImage).' alt="user profile" style="height:50px;width:50px;" >';
            $row[]      = '<a href="'.$jobLink.'"  class="on-default edit-row table_action">'.display_placeholder_text($serData->jobType).'</a>'; 

            if($serData->status){
                $row[]  = '<label class="label label-success">'.$serData->statusShow.'</label>';
            }else{ 
                $row[]  = '<label class="label label-danger">'.$serData->statusShow.'</label>'; 
            } 
       
            $link       = 'javascript:void(0)';
            $action     .= "";
       
            if($serData->status){
                $action .= '<a href="'.$link.'" onclick="jobTypeStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->jobTypeId).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-check" aria-hidden="true"></i></a>';
            }else{
                $action .= '<a href="'.$link.'" onclick="jobTypeStatus(this);" data-message="You want to change status!" data-useid="'.encoding($serData->jobTypeId).'"  class="on-default edit-row table_action" title="status"><i class="fa fa-times" aria-hidden="true"></i></a>';
            }
            $jobLink    = base_url().'jobtype/detail/'.encoding($serData->jobTypeId);
            $action     .= '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$jobLink.'"  class="on-default edit-row table_action" title="Detail"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            $row[]  = $action;
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->jobtype_model->count_all(),
            "recordsFiltered"   => $this->jobtype_model->count_filtered(),
            "data"              => $data,
        );
        //output to json format
        $this->response($output);
    }//end function 
    function jobTypeStatus_post(){
        $jobTypeId      = decoding($this->post('use'));
        $status         = $this->post('status');
        $where          = array('jobTypeId'=>$jobTypeId);
        $dataExist      = $this->common_model->is_data_exists('jobType',$where);
        if($dataExist){
            $status     = $dataExist->status ? 0:1;
            $dataExist  = $this->common_model->updateFields('jobType',array('status'=>$status),$where);
            $showmsg    = ($status==1) ? "Job type request is Active" : "Job type request is Inactive";
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response    = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function jobTypeDelete_post(){
        $jobTypeId      = decoding($this->post('use'));
        $where          = array('jobTypeId'=>$jobTypeId);
        $dataExist      = $this->common_model->is_data_exists('jobType',$where);
        if($dataExist){ 
            $dataExist  = $this->common_model->deleteData('jobType',$where);
            $showmsg    = "Job type has been deleted successfully.";
            $response   = array('status'=>SUCCESS,'message'=>$showmsg);
        }else{
           $response    = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118));  
        }
        $this->response($response);
    }//end function
    function getQuestions_post(){
        $jobTypeId            = $this->post('jobTypeId');
        $question             = $this->post('question');
        $pendingJob           = $this->post('pendingJob');
        $que                  = !empty($question) ? explode(",",$question):array();
        $questions            =  $this->common_model->getAll('jobTypeQuestions',array('jobTypeId'=>$jobTypeId));
        if($questions){
            $html             = '';
            $colors           = array('info', 'warning','success');
            foreach ($questions as $key => $question) {
                $rand_color   = $colors[array_rand($colors)];
                $html         .= '<div class="col col-md-12"><p class="alert alert-'.$rand_color.'"><label class="checkbox"><input type="checkbox" class="checkbox_question"  name="questionId[]" value="'.$question->questionId.'" '.(in_array($question->questionId,$que) ? 'checked="checked"' :'').(($pendingJob!=0)?'onclick="return false;"':'onclick="funcheck();"').' ><i></i><strong class="txt-color-blueDark">'.$question->question.'</strong></label></p></div>';
            }
            $response   = array('status'=>SUCCESS,'message'=>ResponseMessages::getStatusCodeMessage(118),'data'=>$html);
        }else{
            $response   = array('status'=>FAIL,'message'=>ResponseMessages::getStatusCodeMessage(118), 'data'=>'');  
        }
        $this->response($response);
    }//end fucntion
}//End Class 