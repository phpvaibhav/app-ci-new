<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    //var $table , $column_order, $column_search , $order =  '';
    var $table          = 'users';
    var $column_order   = array('c.id','c.fullName','c.email','c.contactNumber','c.status'); //set column field database for datatable orderable
    var $column_sel     = array('c.id',
        'c.fullName',
        'c.email',
        'c.contactNumber',
        'c.status',
        '(case when (c.status = 0) 
        THEN "Inactive" when (c.status = 1) 
        THEN "Active" ELSE
        "Unknown" 
        END) as statusShow'); //set column field database for datatable orderable
    var $column_search  = array('c.fullName','c.contactNumber'); //set column field database for datatable searchable 
    var $order          = array('c.id' => 'DESC');  // default order
    var $where          = array();
    var $group_by       = 'c.id'; 

    public function __construct(){
        parent::__construct();
    }
    
    public function set_data($where=''){
        $this->where = $where; 
    }//End Function

    private function _get_query()
    {
        $sel_fields = array_filter($this->column_sel); 
        $this->db->select($sel_fields);
        $this->db->from('users as c');
        $i = 0;
        foreach ($this->column_search as $emp) // loop column 
        {
            if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
            $_POST['search']['value'] = $_POST['search']['value'];
        } else
            $_POST['search']['value'] = '';
        if($_POST['search']['value']) // if datatable send POST for search
        {
            if($i===0) // first loop
            {
                $this->db->group_start();
                $this->db->like(($emp), $_POST['search']['value']);
            }else{
                $this->db->or_like(($emp), $_POST['search']['value']);
            }

            if(count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
        }
        $i++;
        }

        if(!empty($this->where))
            $this->db->where($this->where); 

        if(!empty($this->group_by)){
            $this->db->group_by($this->group_by);
        }

        if(isset($_POST['order'])) // here order processing
        { 
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)){ 
            $order = $this->order; 
            $this->db->order_by(key($order),$order[key($order)]);
        }    
    }//End Function
    function get_list()
    {
        $this->_get_query();
        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length'] = '10';
        }else{
        	$_POST['length'] = isset($_POST['length']) ? $_POST['length'] :10;
        }
        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start']  = $_POST['start'];
        }
        $_POST['start']      = isset($_POST['start']) ? $_POST['start']:0;
        $this->db->limit($_POST['length'], $_POST['start']);
        //print_r($_POST);die;
        $query = $this->db->get(); //lq();
        return $query->result();
    }//End Function
    function count_filtered()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }//End Function
    public function count_all()
    {
        $this->db->from($this->table);
        if(!empty($this->where))
            $this->db->where($this->where); 
        return $this->db->count_all_results();
    }//end function
    function customerAddressManage($data){
        $customer_val['latitude']              = $data['latitude'];
        $customer_val['longitude']             = $data['longitude'];
        $customer_val['customerId']            = $data['customerId'];
        $address                               = $this->common_model->is_data_exists('customerAddress',$customer_val);
        if(!$address){
            $customer_val['address']               = $data['address'];
            $customer_val['street']                = $data['street'];
            $customer_val['street2']               = $data['street2'];
            $customer_val['city']                  = $data['city'];
            $customer_val['state']                 = $data['state'];
            $customer_val['zip']                   = $data['zip'];
            $customer_val['country']               = $data['country'];
            $this->common_model->insertData('customerAddress',$customer_val);
        }
        return true;
        /*customer add address*/
    }//end function
}