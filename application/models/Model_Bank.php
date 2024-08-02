<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Bank extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function getAllData()
        {
            $query = $this->db->query('SELECT * FROM bank');
            return $query->result();
        }

        public function checkBankCode($code)
        {
            $query = $this->db->query('SELECT * FROM bank WHERE code = "'.$code.'"');
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

        public function checkBankName($name)
        {
            $query = $this->db->query('SELECT * FROM bank WHERE name="'.$name.'"');
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

        public function checkBankCode2($code,$id)
        {
            $query_id = $this->db->query('SELECT * FROM bank WHERE bank_id = '.$id);
            $result = $query_id->row();

            if($result->code!=$code)
            {
                $query = $this->db->query('SELECT * FROM bank WHERE code = "'.$code.'"');
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

        public function checkBankName2($name,$id)
        {
            $query_id = $this->db->query('SELECT * FROM bank WHERE bank_id = '.$id);
            $result = $query_id->row();

            if($result->name!=$name)
            {
                $query = $this->db->query('SELECT * FROM bank WHERE name="'.$name.'"');
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

        public function insertBank()
        {
            $data = array(
                'code' => $this->security->xss_clean($this->input->post('code')),
                'name' => $this->security->xss_clean($this->input->post('name')),
                'bu'   => $this->security->xss_clean($this->input->post('bu')),
                'bank_type' => $this->security->xss_clean($this->input->post('type'))
            );

            $this->db->insert('bank', $data);
        }

        public function getData($id)
        {
            $query = $this->db->query('SELECT * FROM bank WHERE bank_id = '.$id);
            return $query->row();
        }

        public function updateBank($id)
        {
            $data = array (
                'code' => $this->security->xss_clean($this->input->post('code')),
                'name' => $this->security->xss_clean($this->input->post('name')),
                'bu'   => $this->security->xss_clean($this->input->post('bu')),
                'bank_type' => $this->security->xss_clean($this->input->post('type'))
            );

            $this->db->where('bank_id', $id);
            $this->db->update('bank', $data);
        }

        public function deleteData($id)
        {
            $this->db->where('bank_id', $id);
            $this->db->delete('bank');
        }
    }
?>