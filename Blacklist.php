<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blacklist extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->library('nativesession');

        if (!isset($_SESSION['emp_id'])) {
            
            redirect('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/hrms/');
        } 
        
        $this->load->model('placement/blacklist_model');
        $this->load->library('upload');
    }

    /*public function fetch_blacklisted() {

        $fetch_data = $this->blacklist_model->fetch_blacklist();
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = '<span style="display:none">'.$row->blacklist_no.'</span><a href="">'.$row->app_id.'</a>';  
            $sub_array[] = $row->name;  
            $sub_array[] = ucwords(strtolower($row->reportedby));  
            $sub_array[] = date("m/d/Y", strtotime($row->date_blacklisted));  
            $sub_array[] = $row->reason;  
            $sub_array[] = '<button id="record_'.$row->blacklist_no.'" class="btn btn-sm btn-secondary record row_select_bgcolor"><i class="fa fa-pencil text-danger"></i> Edit</button>';  
            $data[] = $sub_array;
        } 

        echo json_encode(array("data" => $data));
    }*/

    public function fetch_blacklisted() {

        $fetch_data = $this->blacklist_model->get_blacklist();
        $data = array();  
        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = '<span style="display:none">'.$row->blacklist_no.'</span><a href="'.base_url('placement/page/menu/employee/profile/'.$row->app_id).'" target="_blank">'.$row->app_id.'</a>';  
            $sub_array[] = $row->name;  
            $sub_array[] = ucwords(strtolower($row->reportedby));  
            $sub_array[] = date("m/d/Y", strtotime($row->date_blacklisted));  
            $sub_array[] = $row->reason;  
            $sub_array[] = '<button id="record_'.$row->blacklist_no.'" class="btn btn-sm btn-primary record row_select_bgcolor"><i class="fa fa-pencil"></i> Update</button>';  
            $data[] = $sub_array;  
        }  
        $output = array(  
            "draw"                      =>     intval($_POST["draw"]),  
            "recordsTotal"              =>     $this->blacklist_model->get_all_data(),  
            "recordsFiltered"           =>     $this->blacklist_model->get_filtered_data(),  
            "data"                      =>     $data  
        );  
       echo json_encode($output); 
    }

    public function candidate_for_blacklisted() {

        $data['request'] = "candidate_for_blacklisted";
        $this->load->view('body/placement/modal_response',$data);
    }

    public function browse_names() {

        $data['fetch_data'] = $this->input->post(NULL, TRUE);
        $data['request'] = "browse_names";

        $this->load->view('body/placement/modal_response',$data);
    }

    public function add_blacklist() {

        $fetch_data = $this->input->post(NULL, TRUE);
        $query = $this->blacklist_model->add_blacklist($fetch_data);

        if ($query) {
           
           die("success");

        } else {

            die("failure");
        }
    }

    public function update_blacklist_form() {

        $fetch_data = $this->input->post(NULL, TRUE);
        $data['fetch_data'] = $fetch_data;
        $data['request'] = "update_blacklist_form";

        $this->load->view('body/placement/modal_response',$data);
    }

    public function update_blacklist() {

        $fetch_data = $this->input->post(NULL, TRUE);
        $query = $this->blacklist_model->update_blacklist($fetch_data);

        if ($query) {
           
           die("success");
           
        } else {

            die("failure");
        }
    }
}