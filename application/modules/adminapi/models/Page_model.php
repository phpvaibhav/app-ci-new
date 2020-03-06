<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model {
       
    //var $table , $column_order, $column_search , $order =  '';
    var $table = 'pages';
    var $column_order = array('pageId','title','slug','description','status'); //set column field database for datatable orderable
    var $column_sel = array('pageId','title','slug','description','status','(case when (status = 0) 
        THEN "Inactive" when (status = 1) 
        THEN "Active" ELSE
        "Unknown" 
        END) as statusShow'); //set column field database for datatable orderable

    var $column_search = array('title'); //set column field database for datatable searchable 
    var $order = array('pageId' => 'desc');  // default order
    var $where = array();
    var $group_by = 'pageId'; 

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
        $this->db->from($this->table);
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
        $this->db->from($this->table);
         if(!empty($this->where))
            $this->db->where($this->where); 
        return $this->db->count_all_results();
    }

    public function userDetails($data){
    	$this->db->select('*');
    	$this->db->from($this->table);
    	$this->db->where(array('id'=>$data['id']));
    	$query = $this->db->get();
    	return $query->row();
    }

}