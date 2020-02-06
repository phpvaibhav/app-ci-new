<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institute extends Common_Back_Controller {

    public $data = "";

    function __construct() {
        parent::__construct();
        $this->check_admin_user_session();
    }//End Function

    public function index() { 
        $data['title'] = "Institute";
		$data['front_styles']    = array('common_assets/css/plugins/dataTables/datatables.min.css');
		$data['front_scripts']    = array('common_assets/js/plugins/dataTables/datatables.min.js','common_assets/admin/js/institute.js');
        $this->load->admin_render('institute', $data);
    }//End Function
}//End Class