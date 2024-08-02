<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Payments extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function getBankData()
        {
            $query = $this->db->query('SELECT * FROM bank ORDER BY name ASC');
            return $query->result();
        }

        public function get_customer()
        {
            $query = $this->db->query('SELECT * FROM customer ORDER BY code ASC');
            return $query->result_array();
        }

        public function getName($code)
        {
            $query = $this->db->query('SELECT code,name FROM customer WHERE code="'.$code.'"');
            return $query->row();
        }

        public function save_cashier_payment()
        {
            $data = array(
                'user_id' => $this->security->xss_clean($this->session->userdata('user_id')),
                'pay_date' => $this->security->xss_clean($this->input->post('date')),
                'cus_code' => $this->security->xss_clean($this->input->post('code')),
                'type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_num' => $this->security->xss_clean($this->input->post('accnum')),
                'bank' => $this->security->xss_clean($this->input->post('bank')),
                'amount' => $this->security->xss_clean($this->input->post('amount')),
                'entered_by' => $this->security->xss_clean($this->session->userdata('user_id')),
                'update_time' => "",
                'datetime' => date("Y-m-d h:i A")
            );

            $this->db->insert('payments', $data);
        }

        public function getPaymentbyDate($date)
        {
            $query = $this->db->query('SELECT a.payment_id,a.cus_code,b.name,a.type,a.check_no,a.amount,a.pay_date FROM payments a INNER JOIN customer b ON a.cus_code=b.code WHERE a.pay_date="'.$date.'" AND a.user_id='.$this->session->userdata('user_id'));
            return $query->result();
        }

        public function getPayment($id)
        {
            $query = $this->db->query('SELECT a.*,b.name FROM payments a INNER JOIN customer b ON a.cus_code=b.code WHERE a.payment_id='.$id);
            return $query->row();
        }

        public function getPayment2($id)
        {
            $query = $this->db->query('SELECT a.*,b.name,c.name AS bname FROM payments a INNER JOIN customer b ON a.cus_code=b.code INNER JOIN bank c ON a.bank=c.code WHERE a.payment_id='.$id);
            return $query->row();
        }

        public function edit_cashier_payment()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code')),
                'type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_num' => $this->security->xss_clean($this->input->post('accnum')),
                'bank' => $this->security->xss_clean($this->input->post('bank')),
                'amount' => $this->security->xss_clean($this->input->post('amount')),
                'update_time' =>  date("h:i A"),
                'datetime' => date("Y-m-d h:i A"),
                'denom_id' => $this->security->xss_clean($this->input->post('denomid'))
            );

            $this->db->where('payment_id', $this->input->post('id'));
            $this->db->update('payments', $data);
        }

        public function edit_sm_payment($collection, $remittance, $dc_pc, $pdc_pc, $dc_amt, $pdc_amt,$denomid)
        {
            $data = array(
                
                'total_dc' => $this->security->xss_clean(str_replace(",","",$dc_amt)),
                'total_pdc' => $this->security->xss_clean(str_replace(",","",$pdc_amt)),               
                'update_time' => date("h:i A"),
                'dc_pcs' => $this->security->xss_clean($dc_pc),
                'pdc_pcs' => $this->security->xss_clean($pdc_pc),
                'total_collection' => $this->security->xss_clean(str_replace(",","",$remittance)),
                'total_remittance' => $this->security->xss_clean(str_replace(",","",$collection))
                
            );

            $this->db->where('denom_id', $denomid);
            $this->db->update('denomination', $data);
        }

        public function delete_payment($id)
        {
            $this->db->where('payment_id', $id);
            $this->db->delete('payments');
        }

        public function selectCheck()
        {
            $check = $this->input->post('checkno');
            $bank = $this->input->post('bank');
            $user = $this->session->userdata('user_id');
            $query = $this->db->query('SELECT * FROM payments WHERE check_no="'.$check.'" AND bank="'.$bank.'" AND user_id!='.$user);
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
?>