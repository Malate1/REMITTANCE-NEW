<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Crud_Model extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function get_top_salesmen_by_remittance($start_date, $end_date, $bu = null) {
            $this->db->select('b.id_no, b.full_name, b.bu, b.last_name,
                SUM(a.total_collection + a.total_palawan) AS total_remittance');
            $this->db->from('denomination a');
            $this->db->join('users b', 'a.user_id = b.user_id');
            $this->db->where('a.date_added >=', $start_date);
            $this->db->where('a.date_added <=', $end_date);
            $this->db->where('b.location', $this->session->userdata('location'));
    
            if (!empty($bu)) {
                $this->db->where('b.bu', $bu);
            }
    
            $this->db->group_by('a.user_id');
            $this->db->order_by('total_remittance', 'DESC');
            $this->db->limit(10); // Top 10
    
            return $this->db->get()->result();
        }
    
        public function get_all_bu() {
            $this->db->select('DISTINCT(bu)');
            $this->db->from('users');
            $this->db->order_by('bu', 'ASC');
            return $this->db->get()->result();
        }

        public function insertData() 
        {
            $data = array (
            

                'username'   => $this->security->xss_clean(trim($this->input->post('username'))),
                'password'   => $this->security->xss_clean(md5(trim($this->input->post('password')))),
                'full_name'  => $this->security->xss_clean(trim($this->input->post('fullname'))),
                'location'   => trim($this->input->post('bu')),
                'bu'         => trim($this->input->post('loc')),
                'type'       => trim($this->input->post('type')),
                'status'     => trim($this->input->post('status')),
                'id_no'      => $this->security->xss_clean(trim($this->input->post('idno'))),
                'date_added' => trim($this->input->post('date'))

            );

            // var_dump($data);
            // die();

            $this->db->insert('users', $data);
        }

        public function getAllData()
        {
            $query = $this->db->query('SELECT * FROM users');
            return $query->result();
        }

        public function getLogs()
        {
            $query = $this->db->query('SELECT * FROM denomination a
                    INNER JOIN users b ON a.user_id = b.user_id
                    WHERE a.manager_key != ""

            ');
            return $query->result();
        }

        public function getData($id)
        {
            $query = $this->db->query('SELECT * FROM users WHERE user_id = '.$id);
            return $query->row();
        }

        public function updateData($id)
        {
            $data = array (
                'username' => $this->security->xss_clean($this->input->post('username')),
                'full_name' => $this->security->xss_clean($this->input->post('fullname')),
                'location' => $this->input->post('bu'),
                'bu' => $this->input->post('loc'),
                'type' => $this->input->post('type'),
                'status' => $this->input->post('status'),
                'id_no' => $this->security->xss_clean($this->input->post('idno'))
            );

            $this->db->where('user_id', $id);
            $this->db->update('users', $data);
        }

        public function deleteData($id)
        {
            $this->db->where('user_id', $id);
            $this->db->delete('users');
        }

        public function resetData($id)
        {
            $default_password = '123456';
            $data = array (
                'password' => md5($default_password)
            );

            $this->db->where('user_id', $id);
            $this->db->update('users', $data);
        }

        public function checkUser($name)
        {
            $query = $this->db->query('SELECT * FROM users WHERE username = "'.$name.'"');
            $result = $query->num_rows();
            if($result > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function checkUser2($name,$id)
        {
            $query_id = $this->db->query('SELECT * FROM users WHERE user_id = '.$id);
            $result = $query_id->row();

            if($result->username!=$name)
            {
                $query = $this->db->query('SELECT * FROM users WHERE username = "'.$name.'" AND user_id!='.$id);
                $result = $query->num_rows();
                if($result > 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

        public function checklogin($uname,$pword)
        {
            $query = $this->db->query('SELECT * FROM users WHERE username = "'.$uname.'" AND password = "'.md5($pword).'" and status = "Active"');
            $row = $query->row();
            $result = $query->num_rows();
            if($result > 0)
            {
                $session_data = array(
                    'username' => $row->username,
                    'password' => $row->password,
                    'full_name' => $row->full_name,
                    'user_id' => $row->user_id,
                    'type' => $row->type,
                    'location' => $row->location,
                    'bu' => $row->bu,
                    'id_no' => $row->id_no,
                    'sm_code2' => $row->sm_code2,
                    'sm_type' => $row->sm_type
                );
                
                $this->session->set_userdata($session_data);

                return true;
            }
            else
            {
                return false;
            }
        }

        public function checkpassword($currpass,$id)
        {
            $query_id = $this->db->query('SELECT * FROM users WHERE user_id = '.$id);
            $row = $query_id->row();
            if(md5($currpass) == $row->password)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function changePassword($id)
        {
            $data = array (
                'password' => $this->security->xss_clean(md5($this->input->post('new_password')))
            );
            
            $this->db->where('user_id', $id);
            $this->db->update('users', $data);

            $this->session->unset_userdata('password');

            $session_data = array(
                'password' => md5($this->input->post('new_password'))
            );

            $this->session->set_userdata($session_data);
        }

        public function changeUsername($id)
        {
            $data = array (
                'username' => $this->security->xss_clean($this->input->post('username'))
            );
            
            $this->db->where('user_id', $id);
            $this->db->update('users', $data);

            $this->session->unset_userdata('username');

            $session_data = array(
                'username' => $this->input->post('username')
            );

            $this->session->set_userdata($session_data);
        }

        public function changeLocation($id)
        {
            $data = array (
                'location' => $this->security->xss_clean($this->input->post('bu'))
            );

            $this->db->where('user_id', $id);
            $this->db->update('users', $data);

            $this->session->unset_userdata('location');

            $session_data = array(
                'location' => $this->input->post('bu')
            );

            $this->session->set_userdata($session_data);
        }

        public function changeBu($id)
        {
            $data = array (
                'bu' => $this->security->xss_clean($this->input->post('loc'))
            );

            $this->db->where('user_id', $id);
            $this->db->update('users', $data);

            $this->session->unset_userdata('bu');

            $session_data = array(
                'bu' => $this->input->post('loc')
            );

            $this->session->set_userdata($session_data);
        }
    }
?>