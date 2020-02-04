<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model {

    //var $table , $column_order, $column_search , $order =  '';
    var $table          = 'vehicles';
    var $column_order   = array('v.vehicleId','v.year','v.manufacturer','v.model','v.vin','v.plate','v.color','v.state','v.status','d.fullName'); //set column field database for datatable orderable
    var $column_sel     = array('v.vehicleId',
        'v.year',
        'v.manufacturer',
        'v.model',
        'v.vin',
        'v.plate',
        'v.color',
        'v.state',
        'v.status',
        '(case when (v.status = 0) 
        THEN "Inactive" when (v.status = 1) 
        THEN "Active" ELSE
        "Unknown" 
        END) as statusShow',
        'd.fullName'); //set column field database for datatable orderable
    var $column_search = array('v.year','v.manufacturer','v.model','v.vin','v.plate','v.color','v.state','d.fullName'); //set column field database for datatable searchable 
    var $order          = array('v.vehicleId' => 'DESC');  // default order
    var $where          = array();
    var $group_by       = 'v.vehicleId'; 

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
        $this->db->from('vehicles as v');
        $this->db->join('assignVehicle as av','av.vehicleId = v.vehicleId','left');
        $this->db->join('users as d','d.id = av.driverId','left');
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
        }else if(isset($this->order))
        { 
            $order = $this->order; 
            $this->db->order_by(key($order), $order[key($order)]);
        }
       
    }//End function

    function get_list()
    {
        $this->_get_query();
        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']        = '10';
        } else{
        	$_POST['length']       = isset($_POST['length']) ? $_POST['length'] :10;
        }

        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start']     = $_POST['start'];
        }
        $_POST['start']         = isset($_POST['start']) ? $_POST['start']:0;
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
        $this->db->from($this->table);
        if(!empty($this->where))
            $this->db->where($this->where); 
        return $this->db->count_all_results();
    }//End function
    function vehilceLatlong($driverId =''){
        $array =array();
        $this->db->select('v.vehicleId,
            v.year,
            v.manufacturer,
            v.model,
            v.vin,
            v.plate,
            v.color,
            v.state,
            v.status,
            d.fullName,
            d.id as driverId,
            d.fullName,
            d.latitude,
            d.longitude');
        $this->db->from('vehicles as v');
        
        $this->db->join('assignVehicle as av','av.vehicleId = v.vehicleId','left');
        $this->db->join('users as d','d.id = av.driverId','left');
        $this->db->where(array('d.latitude !='=>0.00000000,'d.longitude !='=>0.00000000,'v.status'=>1));
        !empty($driverId) ? $this->db->where(array('d.id'=>$driverId)):"";
        !empty($driverId) ? $this->db->limit(1) :"";
        $sql = $this->db->get();
       
        if($sql->num_rows()){
            $array =  !empty($driverId) ? $sql->row_array(): $sql->result();
            if(empty($driverId)){
                foreach ($array as $ky => $v) {
                   $array[$ky]->driverLink  = 'drivers/driverDetail/'.encoding($v->driverId);
                   $array[$ky]->vehicleLink = 'vehicles/vehicleDetail/'.encoding($v->vehicleId);
                   $array[$ky]->assignJob   = $this->assignJob($v->driverId);
                //   $array[$ky]->currentAddress = $this->common_model->geolocationaddress($v->latitude,$v->longitude);
                }
            }else{
                $array['driverLink']    = 'drivers/driverDetail/'.encoding($array['driverId']);
                $array['vehicleLink']   = 'vehicles/vehicleDetail/'.encoding($array['vehicleId']);
                 
                  // $array['currentAddress'] = $this->common_model->geolocationaddress($v['latitude'],$v['longitude']); 
            }
        }
       //pr($array);
        return $array;
    }//End FUnction
    function assignJob($driverId){
        $where = array('d.id'=>$driverId,'j.jobStatus !='=>2);
        $this->db->select('j.jobId,
            j.jobName,
            (case when (j.jobStatus = 0) 
            THEN "Open" when (j.jobStatus = 1) 
            THEN "In Progress" when (j.jobStatus = 2) 
            THEN "Completed" ELSE
            "Unknown" 
            END) as statusShow,
            (case when (j.jobStatus = 0) 
            THEN "blue" when (j.jobStatus = 1) 
            THEN "orange" when (j.jobStatus = 2) 
            THEN "green" ELSE
            "Unknown" 
            END) as statusColor');
        $this->db->from('jobs as j');
        $this->db->join('jobType as jt','j.jobTypeId=jt.jobTypeId');
        $this->db->join('users as c','c.id=j.customerId','left');
        $this->db->join('users as d','d.id=j.driverId','left');
        !empty($where) ? $this->db->where($where) :"";
        $this->db->order_by('DATE(j.upd)','desc');
        $sql = $this->db->get();
        if($sql->num_rows()):
            $data = $sql->result();
            foreach ($data as $e => $u) {
                $data[$e]->jobLink = base_url().'jobs/jobDetail/'.encoding($u->jobId);
            }
            // pr($data);
            return $data;
        endif;
        return array();
    }//end function1
}//End class