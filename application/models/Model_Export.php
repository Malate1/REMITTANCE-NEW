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
            $query = $this->db->query('SELECT a.*,b.full_name,b.bu,(a.total_cash+a.total_dc+a.total_pdc) AS total,c.cus_code FROM denomination a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN salesman_customer c ON a.user_id=c.user_id WHERE a.date_added = "'.$dates.'" AND b.location="'.$this->session->userdata('location').'" AND c.status="checked" AND c.collect_date="'.$dates.'"');

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

        public function getIncentivesApplied($user_id) {
            $this->db->select_sum('sm_inc');
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('denomination');

            $result = $query->row();

            // Return the sum of inc_amount for the given sm_code
            return $result->sm_inc;
        }

        public function getIncentivesAppliedLedger($user_id) {
            $this->db->select_sum('inc_used');
            $this->db->where('sm_code', $user_id);
            $query = $this->db->get('salesman_incentives_used');

            $result = $query->row();

            // Return the sum of inc_amount for the given sm_code
            return $result->inc_used;
        }

        public function getUserId($code)
        {
            $query = $this->db->query('SELECT * FROM users WHERE id_no = "'.$code.'"');

            return $query->row();
        }

        // public function paymentldi($sidocno,$pay_type)
        // {
        //     $query = $this->db->query('SELECT * FROM payments_ldi WHERE si_docno = "'.$sidocno.'" AND si_docno!="" AND pay_type= "'.$pay_type.'" AND status4 != "DELETED"');
        //     $result = $query->num_rows();
        //     if($result > 0)
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         return false;
        //     }
        // }

        public function paymentldi($sidocno,$pay_type,$check_no)
        {
            $query = $this->db->query('SELECT * FROM payments_ldi WHERE si_docno = "'.$sidocno.'" AND si_docno!="" AND pay_type= "'.$pay_type.'" AND check_no = "'.$check_no.'" AND status4 != "DELETED" ');
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

        public function paymentldi_xtruck($ref_no,$pay_type)
        {
            $query = $this->db->query('SELECT * FROM payments_xtruck WHERE ref_no = "'.$ref_no.'" AND ref_no!="" AND pay_type= "'.$pay_type.'"');
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

        public function paymentldi_xtruck_sat($order_no,$pay_type,$sidocno,$tran_no)
        {
            $query = $this->db->query('SELECT * FROM payments_satellite WHERE order_no = "'.$order_no.'" AND order_no!="" AND pay_type= "'.$pay_type.'" AND si_docno = "'.$sidocno.'" AND tran_no = "'.$tran_no.'"');
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

        public function returnldi_xtruck($order_no,$pay_type)
        {
            $query = $this->db->query('SELECT * FROM returns_xtruck WHERE order_no = "'.$order_no.'" AND order_no!="" AND tran_type= "'.$pay_type.'"');
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

        public function palawan_xtruck($ref_no)
        {
            $query = $this->db->query('SELECT * FROM payments_palawan WHERE ref_no = "'.$ref_no.'" AND ref_no!="" ');
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

        public function palawan_utc($ref_no)
        {
            $query = $this->db->query('SELECT * FROM payments_underthecup WHERE ref_no = "'.$ref_no.'" AND ref_no!="" ');
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

        public function palawan_oplan($ref_no)
        {
            $query = $this->db->query('SELECT * FROM payments_palawan_op WHERE ref_no = "'.$ref_no.'" AND ref_no!="" ');
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

        public function returnldi_oplan($ref_no, $type)
        {
            $query = $this->db->query('SELECT * FROM bo WHERE ref_no = "'.$ref_no.'" AND ref_no!="" AND type= "'.$type.'"');
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

        // public function sm_inc_xtruck($sm_code,$inc_month)
        // {
        //     $query = $this->db->query('SELECT * FROM salesman_incentives WHERE sm_code = "'.$sm_code.'" AND sm_code!="" AND inc_month= "'.$inc_month.'"');
        //     $result = $query->num_rows();
        //     if($result > 0)
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         return false;
        //     }
        // }

        public function sm_inc_xtruck($sm_code, $inc_month, $inc_amount)
        {
            // Query to check if there is any row with matching sm_code and inc_month
            $query = $this->db->query('SELECT * FROM salesman_incentives WHERE sm_code = ? AND sm_code != "" AND inc_month = ?', array($sm_code, $inc_month));
            $result = $query->result();

            if (count($result) > 0) {
                // If a matching row is found, check if any of these rows have the matching inc_amount
                foreach ($result as $row) {
                    if ($row->inc_amount == $inc_amount) {
                        return true; // There is a row with matching sm_code, inc_month, and inc_amount
                    }
                }
                return false; // There is a row with matching sm_code and inc_month but not inc_amount
            } else {
                return false; // No row with matching sm_code and inc_month
            }
        }

        public function sm_inc_bal_xtruck($sm_code)
        {
            $query = $this->db->query('SELECT * FROM salesman_incentives_bal WHERE sm_code = "'.$sm_code.'" AND sm_code!="" ');
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

        public function get_total_inc($sm_code) {
            $this->db->select_sum('inc_amount');
            $this->db->where('sm_code', $sm_code);
            $query = $this->db->get('salesman_incentives');

            $result = $query->row();

            // Return the sum of inc_amount for the given sm_code
            return $result->inc_amount;
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

        public function insertldixtruck($data)
        {
            $this->db->insert('payments_xtruck', $data);
        }

        public function insertldixtrucksat($data)
        {
            $this->db->insert('payments_satellite', $data);
        }

        public function insertldireturnxtruck($data)
        {
            $this->db->insert('returns_xtruck', $data);
        }

        public function insertpalawanxtruck($data)
        {
            $this->db->insert('payments_palawan', $data);
        }

        public function insertutcxtruck($data)
        {
            $this->db->insert('payments_underthecup', $data);
        }

        public function insertpalawanoplan($data)
        {
            $this->db->insert('payments_palawan_op', $data);
        }
        
        public function insertldireturnoplan($data)
        {
            $this->db->insert('bo', $data);
        }

        public function insertldismincxtruck($data)
        {
            $this->db->insert('salesman_incentives', $data);
        }

        public function insertldismincbalxtruck($data)
        {
            $this->db->insert('salesman_incentives_bal', $data);
        }

        
        public function updatesmincbalxtruck($data) {
           
            $sm_code = $data['sm_code'];
            $inc_balance = $data['inc_balance'];

            
            $this->db->where('sm_code', $sm_code);
            $this->db->update('salesman_incentives_bal', array('inc_balance' => $inc_balance));
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