<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blacklist_model extends CI_Model {

	public $user_access = '';
    public $company = '';
    public $business_unit = '';

    function __construct()
    {
        parent::__construct();
        $this->load->library('nativesession');

        $this->db->select('company_code, bunit_code');
        $query = $this->db->get_where('employee3', array('emp_id' => $_SESSION['emp_id']));
        $row = $query->row_array();
        
        if (($row['company_code'] == "11" && $row['bunit_code'] == "04") || ($row['company_code'] == "11" && $row['bunit_code'] == "05")) {
            
            $this->company = $row['company_code'];
            $this->business_unit = $row['bunit_code'];
        } else {

            $this->company = $row['company_code'];
            $this->business_unit = $row['bunit_code'];
            $this->user_access = 'all';
        }
    }

    public function fetch_blacklist(){

        $query = $this->db->get('blacklist');
        return $query->result();
    }

    var $column_order = array('blacklist_no', 'app_id', 'name', 'date_blacklisted', 'date_added', 'reportedby', 'reason');
    var $search_column = array('blacklist_no', 'app_id', 'name', 'date_blacklisted', 'date_added', 'reportedby', 'reason'); //set column field database for datatable searchable 
    var $order = array('blacklist_no' => 'desc'); // default order 

    private function make_query(){   

        $this->db->from('blacklist');

        $i = 0;
        foreach ($this->search_column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
    
                if(count($this->search_column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
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

    public function get_blacklist(){  
        $this->make_query();  
        if(@$_POST["length"] != -1)  
        {  
            $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();  
    } 

    public function get_filtered_data(){  
        $this->make_query();  
        $query = $this->db->get();  
        return $query->num_rows();  
    }       
      
    public function get_all_data(){  
    
        $this->db->get('blacklist');  
        return $this->db->count_all_results();  
    }

    public function browse_name1($condition){

        $this->db->select('app_id, lastname, firstname, middlename, suffix, appCode');
        $this->db->from('applicant');
        $this->db->where($condition);
        return $this->db->get();
    }

    public function browse_name2($fullname, $fullname2){

        $this->db->select('name');
        $this->db->like('name', $fullname);
        $this->db->or_like('name', $fullname2);
        return $this->db->get('blacklist');
    }

    public function current_status($app_id){

        $this->db->select('current_status');
        return $this->db->get_where('employee3', array('emp_id' => $app_id));
    }

    public function applicant_status($app_code){

        $this->db->select('status');
        return $this->db->get_where('applicants', array('app_code' => $app_code));
    }

    public function add_blacklist($fetch){

        $app_id = trim($fetch['appId']);
        $name = ucwords(strtolower($fetch['appName']));

        if ($fetch['birthday'] == "") {
            
            $birthday = "";
        } else {

            $birthday = date("Y-m-d", strtotime($fetch['birthday']));
        }

        $data = array(
                'app_id' => $app_id,
                'name' => $name,
                'date_blacklisted' => date("Y-m-d", strtotime($fetch['dateBlacklisted'])),
                'date_added' => date("Y-m-d"),
                'reportedby' => $fetch['reportedBy'],
                'reason' => $fetch['reason'],
                'status' => 'blacklisted',
                'staff' => $_SESSION['emp_id'],
                'bday' => $birthday,
                'address' => $fetch['address']
        );

        $query = $this->db->insert('blacklist', $data);

        $set = array(
                'current_status' => 'blacklisted'
        );

        $this->db->set($set);
        $this->db->where('emp_id', $app_id);
        $this->db->update('employee3');

        return $query;
    }

    public function get_blacklist_info($blacklist_no){

        $this->db->select('app_id, name, date_blacklisted, reportedby, reason, bday, address');
        $query = $this->db->get_where('blacklist', array('blacklist_no' => $blacklist_no));
        return $query->row_array();
    }

    public function update_blacklist($fetch){

        if (trim($fetch['birthday']) == "") {
            
            $birthday = "";
        } else {

            $birthday = date("Y-m-d", strtotime($fetch['birthday']));
        }

        $set = array(
                'date_blacklisted' => date("Y-m-d", strtotime($fetch['dateBlacklisted'])),
                'date_added' => date("Y-m-d"),
                'reportedby' => $fetch['reportedBy'],
                'reason' => $fetch['reason'],
                'staff' => $_SESSION['emp_id'],
                'bday' => $birthday,
                'address' => $fetch['address']
        );

        $this->db->set($set);
        $this->db->where('blacklist_no', $fetch['blacklistNo']);
        return $this->db->update('blacklist');
    }
}