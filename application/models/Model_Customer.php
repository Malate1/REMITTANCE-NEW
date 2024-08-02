<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Customer extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function checkCustomer($code)
        {
            $query_id = $this->db->query('SELECT * FROM customer WHERE code = "'.$code.'"');
            $result = $query_id->num_rows();
            if($result > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function insertCustomer($data)
        {
            $this->db->insert('customer', $data);
        }
    }
?>