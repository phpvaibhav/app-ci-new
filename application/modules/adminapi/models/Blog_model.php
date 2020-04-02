<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

    //var $table , $column_order, $column_search , $order =  '';
    var $table = 'blogs';
    var $column_order = array('b.blogId','b.title','in.name','u.fullName','b.status'); //set column field database for datatable orderable
    var $column_sel = array('b.blogId','b.title','in.name as instrument','u.fullName','b.status','b.status','(case when (b.status = 0) 
        THEN "Pending" when (b.status = 1) 
        THEN "Approved"  ELSE
        "Unknown" 
        END) as statusShow','(case when (b.image = "") 
            THEN "common_assets/img/avatars/sunny-big.png" ELSE
            concat("uploads/blog/thumb/",b.image) 
            END) as image'); //set column field database for datatable orderable
    var $column_search = array('u.firstName','b.title','u.email','in.name',); //set column field database for datatable searchable 
    var $order = array('b.blogId'=> 'DESC');  // default order
    var $where = array();
    var $group_by = 'b.blogId'; 

    public function __construct(){
        parent::__construct();
    }
    
    public function set_data($where=''){
        $this->where = $where; 
    }

    private function _get_query()
    {
        $sel_fields = array_filter($this->column_sel); 
        $this->db->select($sel_fields);
        $this->db->from('blogs as b');
        $this->db->join('instrument as in','b.instrumentId=in.instrumentId','left');
        $this->db->join('users as u','u.id=b.userId','left');
    
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
            }
            else
            {
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
        } 
        else if(isset($this->order))
        { 
            $order = $this->order; 
            $this->db->order_by(key($order), $order[key($order)]);
        }
       
    }

    function get_list()
    {
        $this->_get_query();
        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        } else{
        	$_POST['length']= isset($_POST['length']) ? $_POST['length'] :10;
        }
        
        
        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start']= $_POST['start'];
        }
         $_POST['start']= isset($_POST['start']) ? $_POST['start']:0;
        $this->db->limit($_POST['length'], $_POST['start']);
        //print_r($_POST);die;
        $query = $this->db->get(); //lq();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all()
    {
        $this->db->from('blogs as b');
        $this->db->join('instrument as in','b.instrumentId=in.instrumentId','left');
        $this->db->join('users as u','u.id=b.userId','left');
        if(!empty($this->where))
            $this->db->where($this->where); 
        return $this->db->count_all_results();
    }
}