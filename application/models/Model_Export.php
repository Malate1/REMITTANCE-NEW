<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Export extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function checkPayment($dates)
        {
            $query_id = $this->db->query('SELECT a.* FROM payments a INNER JOIN users b ON a.user_id=b.user_id WHERE a.pay_date = "'.$dates.'" AND b.location="'.$this->session->userdata('location').'"');
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

        public function checkDenom($dates)
        {
            $query_id = $this->db->query('SELECT a.* FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added = "'.$dates.'" AND b.location="'.$this->session->userdata('location').'"');
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

        public function getPayments($dates)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,c.name FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date = "'.$dates.'" AND b.location="'.$this->session->userdata('location').'"');

            return $query->result_array();
        }

        public function getDenom($dates)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,(a.total_cash+a.total_dc+a.total_pdc) AS total,c.cus_code FROM denomination a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN salesman_customer c ON a.user_id=c.user_id WHERE a.date_added = "'.$dates.'" AND b.location="'.$this->session->userdata('location').'" AND c.status="checked" AND c.collect_date="'.$dates.'"');

            return $query->result_array();
        }

        public function getCash($dates)
        {
            $query = $this->db->query('SELECT a.date_added,SUM(a.total_cash) AS total_cash FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added = "'.$dates.'" AND b.location="'.$this->session->userdata('location').'"');

            return $query->row();
        }

        public function checkUserid($code)
        {
            $query = $this->db->query('SELECT user_id FROM users WHERE id_no = "'.$code.'"');
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

        public function getUserId($code)
        {
            $query = $this->db->query('SELECT user_id FROM users WHERE id_no = "'.$code.'"');

            return $query->row();
        }

        public function paymentldi($sidocno,$pay_type)
        {
            $query = $this->db->query('SELECT * FROM payments_ldi WHERE si_docno = "'.$sidocno.'" AND si_docno!="" AND pay_type= "'.$pay_type.'"');
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

        public function returnldi($sidocno)
        {
            $query = $this->db->query('SELECT * FROM returns WHERE si_docno = "'.$sidocno.'" AND si_docno!="" ');
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

        public function checkAccount($date,$code)
        {
            $query = $this->db->query('SELECT * FROM salesman_account WHERE sm_code="'.$code.'" AND account_date="'.$date.'"');
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

        public function insertAccount($data)
        {
            $this->db->insert('salesman_account', $data);
        }

        public function insertldipayment($data)
        {
            $this->db->insert('payments_ldi', $data);
        }

        public function insertldireturn($data)
        {
            $this->db->insert('returns', $data);
        }

        public function checkCustomer($date,$customer,$code)
        {
            $query = $this->db->query('SELECT * FROM salesman_customer WHERE sm_code="'.$code.'" AND collect_date="'.$date.'" AND cus_code="'.$customer.'"');
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

        public function insertCustomer($data)
        {
            $this->db->insert('salesman_customer', $data);
        }
    }
?>