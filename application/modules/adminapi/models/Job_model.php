<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {

    //var $table , $column_order, $column_search , $order =  '';
    var $table          = 'jobs';
    var $column_order   = array('j.jobId','j.jobName','jt.jobType','c.fullName','d.fullName','j.startDate','j.workPriority','j.jobStatus'); //set column field database for datatable orderable
    var $column_sel     = array('j.jobId',
        'j.jobName',
        'j.jobTypeId',
        'j.driverId',
        'c.fullName as customerName',
        'jt.jobType',
        'd.fullName as driverName',
        'j.customerId',
        'j.jobStatus',
        'j.startDate',
        'j.startTime',
        '(case when (j.jobStatus = 0) 
        THEN "Open" when (j.jobStatus = 1) 
        THEN "In-progress" when (j.jobStatus = 2) 
        THEN "Completed" ELSE
        "Unknown" 
        END) as statusShow',
        '(case when (j.workPriority = 0) 
        THEN "L" when (j.workPriority = 1) 
        THEN "M" when (j.workPriority = 2) 
        THEN "H" ELSE
        "Unknown" 
        END) as priority',
        'j.workPriority'); //set column field database for datatable orderable
    var $column_search  = array('j.jobName','d.fullName','c.fullName','jt.jobType'); //set column field database for datatable searchable 
    var $order          = array('j.jobId' => 'DESC');  // default order
    var $where          = array();
    var $group_by       = 'j.jobId'; 

    public function __construct(){
        parent::__construct();
    }
    
    public function set_data($where=''){
        $this->where = $where; 
    }//End function
    private function _get_query()
    {
        $sel_fields = array_filter($this->column_sel); 
        $this->db->select($sel_fields);
        $this->db->from('jobs as j');
        $this->db->join('jobType as jt','j.jobTypeId=jt.jobTypeId');
        $this->db->join('users as c','c.id=j.customerId','left');
        $this->db->join('users as d','d.id=j.driverId','left');
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
            $this->db->order_by(key($order), $order[key($order)]);
        }
       
    }//End function

    function get_list()
    {
        $this->_get_query();
        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        }else{
        	$_POST['length'] = isset($_POST['length']) ? $_POST['length'] :10;
        }
        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start'] = $_POST['start'];
        }
        $_POST['start']     = isset($_POST['start']) ? $_POST['start']:0;
        $this->db->limit($_POST['length'], $_POST['start']);
        //print_r($_POST);die;
        $query = $this->db->get(); //lq();
        return $query->result();
    }//End function
    function count_filtered()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }//End function
    public function count_all()
    {
        // $this->db->from($this->table);
        $this->db->from('jobs as j');
        $this->db->join('jobType as jt','j.jobTypeId=jt.jobTypeId');
        $this->db->join('users as c','c.id=j.customerId','left');
        $this->db->join('users as d','d.id=j.driverId','left');
        if(!empty($this->where))
            $this->db->where($this->where); 
        return $this->db->count_all_results();
    }//End function
    function jobPolygonUdpate($data_val,$id){
        $points         = $data_val['points'];
        $boundary       = $data_val['boundary'];
        $polygonColor   = $data_val['polygonColor'];
        $geoFencing     = $data_val['geoFencing'];
        $sql            = "UPDATE jobs SET `points`='$points',`polygonColor`='$polygonColor',`boundary`=$boundary,`geoFencing`= $geoFencing WHERE jobId=$id";
        $update          = $this->db->query($sql);
        return $update;
    }//end function
}//End Class