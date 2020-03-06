<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Info extends Common_Front_Controller {

  /**
   * load list modal 
   */
  function __Construct(){
    parent::__Construct();
  }

    public function index() { 
        $data['title'] = "Page";
        $slug = $this->uri->segment(2);
        //pr($slug);
        $data['info'] = $this->common_model->getsingle('pages',array('slug'=>$slug));
        if(empty($data['info'])){
          redirect(base_url());
        }
       // if(empty($data['info'])) ? redirect(base_url()):"";
        $this->load->login_render('extra/info', $data);
    }//End Function
}//End Class
?>
