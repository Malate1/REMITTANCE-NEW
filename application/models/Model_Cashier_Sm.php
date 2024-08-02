<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Cashier_Sm extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function getBankData()
        {
            if($this->session->userdata('location')=='UWDG')
            {
                $query = $this->db->query('SELECT `code`, `name`  FROM bank ORDER BY name ASC');
                return $query->result_array();
            }
            else
            {
                $query = $this->db->query('SELECT `code`, `name`  FROM bank WHERE bu="All" ORDER BY name ASC');
                return $query->result_array();
            }
        }

        public function getBankData2()
        {
            if($this->session->userdata('location')=='UWDG')
            {
                $query = $this->db->query('SELECT * FROM bank ORDER BY name ASC');
                return $query->result();
            }
            else
            {
                $query = $this->db->query('SELECT * FROM bank WHERE bu="All" ORDER BY name ASC');
                return $query->result();
            }
        }

        public function get_customer()
        {
            $query = $this->db->query('SELECT * FROM customer ORDER BY code ASC');
            return $query->result_array();
        }

        public function get_customer2()
        {
            $query = $this->db->query('SELECT * FROM customer2 ORDER BY code ASC');
            return $query->result_array();
        }

        public function transfercustomer($code)
        {   
            $query1 = $this->db->query('SELECT * FROM customer WHERE code="'.$code.'"');
            $result = $query1->num_rows();
            if($result < 1)
            {
                $query = $this->db->query('INSERT INTO customer(`code`,`name`,`address1`,`address2`,`pricegroup`,`payment_term`,`mother_code`,`credit_limit`,`salesman`) SELECT `code`,`name`,`address1`,`address2`,`pricegroup`,`payment_term`,`mother_code`,`credit_limit`,`salesman` FROM customer2 WHERE customer2.code="'.$code.'"');
            }
        }

        public function transfercustomer2($code,$name,$addr)
        {
            $data = array(
                'code' => $code,
                'name' => $name,
                'address1' => $addr,
                'address2' => $addr,
                'credit_limit' => 1
            );

            $this->db->insert('customer', $data);
        }
        
        public function getName($code)
        {
            $query = $this->db->query('SELECT code,name FROM customer WHERE code="'.$code.'"');
            return $query->row();
        }

        public function get_accname($acc_code)
        {
            $query = $this->db->query('SELECT DISTINCT acc_name FROM payments WHERE acc_num="'.$acc_code.'"');
            $result = $query->num_rows();
            if($result > 0)
            {
                return $query->row();
            }
            else
            {
                return false;
            }
        }

        public function getSmDenombyDate($date)
        {
            $query = $this->db->query('SELECT a.vat,a.bo, a.denom_id,a.user_id,b.full_name,a.total_cash,a.total_returns,a.total_dc,a.total_pdc,a.date_added,IF(a.status="","Pending",a.status) AS status,(SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$date.'" AND d.type="DC") AS cashier_dc,(SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$date.'" AND d.type="PDC") AS cashier_pdc,a.total_collection,a.total_remittance,a.remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');

            
            return $query->result();
        }

        public function getDueChecks($date,$type)
        {
            if($type=='posted')
            {
                $query = $this->db->query('SELECT a.*,b.name FROM payments a INNER JOIN customer b ON a.cus_code=b.code INNER JOIN users c ON a.entered_by=c.user_id WHERE a.due_date<="'.$date.'" AND c.location="'.$this->session->userdata('location').'" AND a.status!=""');
            }
            else
            {
                $query = $this->db->query('SELECT a.*,b.name FROM payments a INNER JOIN customer b ON a.cus_code=b.code INNER JOIN users c ON a.entered_by=c.user_id WHERE a.due_date<="'.$date.'" AND c.location="'.$this->session->userdata('location').'" AND a.status=""');
            }

            return $query->result();
        }

        public function getSmDenombyDenomId($id)
        {
            $query = $this->db->query('SELECT a.denom_id,a.user_id,b.full_name,a.total_cash,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,IF(a.status="","Pending",a.status) AS status,(SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dc,(SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdc,(SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,(SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,a.total_collection, a.total_remittance FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$id);
            
            return $query->row();
        }

        public function approveSmDenom($id)
        {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'approved_by' => $uid,
                'status' => 'Approved'
            );

            $this->db->where('denom_id', $id);
            $this->db->update('denomination', $data);
        }

        public function approveSmDenoms($ids) {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'approved_by' => $uid,
                'status' => 'Approved'
            );

            // Modify the query to use where_in for multiple IDs
            $this->db->where_in('denom_id', $ids);
            $this->db->update('denomination', $data);
        }


        public function disapproveSmDenom($id)
        {
            $data = array(
                'approved_by' => '0',
                'status' => ''
            );

            $this->db->where('denom_id', $id);
            $this->db->update('denomination', $data);
        }

        public function save_sm_payment()
        {
            $data = array(
                'user_id' => $this->security->xss_clean($this->input->post('userid')),
                'pay_date' => $this->security->xss_clean($this->input->post('date')),
                'cus_code' => $this->security->xss_clean($this->input->post('code')),
                'type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_num' => $this->security->xss_clean($this->input->post('accnum')),
                'bank' => $this->security->xss_clean($this->input->post('bank')),
                'amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'entered_by' => $this->security->xss_clean($this->session->userdata('user_id')),
                'update_time' => "",
                'datetime' => date("Y-m-d h:i A"),
                'denom_id' => $this->security->xss_clean($this->input->post('denomid'))
            );

            $this->db->insert('payments', $data);
        }

        public function selectCheck()
        {
            $check = $this->input->post('checkno');
            $bank = $this->input->post('bank');
            $user = $this->input->post('userid');
            $date = $this->input->post('date');
            $query = $this->db->query('SELECT * FROM payments WHERE check_no="'.$check.'" AND pay_date="'.$date.'" AND bank="'.$bank.'" AND user_id!='.$user);
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

        public function getSmChecks($userid,$paydate,$denomid)
        {
            // $query = $this->db->query('SELECT a.*,IFNULL(b.name,"") AS name,c.status FROM payments a LEFT JOIN customer b ON a.cus_code=b.code INNER JOIN denomination c ON a.user_id=c.user_id AND a.pay_date=c.date_added AND a.denom_id=c.denom_id WHERE a.pay_date="'.$paydate.'" AND a.user_id='.$userid.' AND a.denom_id='.$denomid);

            // return $query->result_array();

                        $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name, c.status 
                        FROM payments a 
                        LEFT JOIN customer b ON a.cus_code = b.code 
                        INNER JOIN denomination c ON a.user_id = c.user_id 
                            AND a.pay_date = c.date_added 
                            AND a.denom_id = c.denom_id 
                        WHERE a.pay_date = "'.$paydate.'" 
                            AND a.user_id = '.$userid.' 
                            AND a.denom_id = '.$denomid.'
                        GROUP BY a.payment_id');

            return $query->result_array();

        }

        public function getSmChecksLDI($userid,$paydate)
        {
            // $query = $this->db->query('SELECT a.*,IFNULL(b.name,"") AS name,c.status FROM payments a LEFT JOIN customer b ON a.cus_code=b.code INNER JOIN denomination c ON a.user_id=c.user_id AND a.pay_date=c.date_added AND a.denom_id=c.denom_id WHERE a.pay_date="'.$paydate.'" AND a.user_id='.$userid.' AND a.denom_id='.$denomid);

            // return $query->result_array();

                        $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name, c.status 
                        FROM payments a 
                        LEFT JOIN customer b ON a.cus_code = b.code 
                        INNER JOIN denomination c ON a.user_id = c.user_id 
                            AND a.pay_date = c.date_added 
                            AND a.denom_id = c.denom_id 
                        WHERE a.pay_date = "'.$paydate.'" 
                            AND a.user_id = '.$userid.' 
                            
                        GROUP BY a.payment_id');

            return $query->result_array();

        }

        public function getUserName($userid)
        {
            $query = $this->db->query('SELECT full_name FROM users WHERE user_id='.$userid);
            
            return $query->row();
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

        public function edit_sm_payment()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_num' => $this->security->xss_clean($this->input->post('accnum')),
                'bank' => $this->security->xss_clean($this->input->post('bank')),
                'amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'update_time' =>  date("h:i A"),
                'datetime' => date("Y-m-d h:i A"),
                'status' => $this->security->xss_clean($this->input->post('checkstatus'))
            );

            $this->db->where('payment_id', $this->input->post('id'));
            $this->db->update('payments', $data);
        }

        public function getCheckRemarks($id)
        {
            $query = $this->db->query('SELECT remarks FROM payments WHERE payment_id='.$id);
            
            return $query->row();
        }

        public function getRemarks($id)
        {
            $query = $this->db->query('SELECT remarks FROM denomination WHERE denom_id='.$id);
            
            return $query->row();
        }

        public function updateCheckStatus()
        {
            $data = array(
                'status' => $this->security->xss_clean($this->input->post('status'))
            );

            $this->db->where('payment_id', $this->input->post('ids'));
            $this->db->update('payments', $data);
        }

        public function saveRemarks()
        {
            $data = array(
                'remarks' => $this->security->xss_clean($this->input->post('remarks'))
            );

            $this->db->where('denom_id', $this->input->post('denomid'));
            $this->db->update('denomination', $data);
        }

        public function saveRemarks2()
        {
            $data = array(
                'remarks' => $this->security->xss_clean($this->input->post('remarks'))
            );

            $this->db->where('payment_id', $this->input->post('paymentid'));
            $this->db->update('payments', $data);
        }
        public function getDateFrom($id)
        {
            $query = $this->db->query('SELECT date_added FROM denomination WHERE denom_id='.$id);
            
            return $query->row();
        }

        public function saveBackdate()
        {
            $max_date = $this->input->post('datef');
            $date_to = $this->input->post('date_to');

            if (strtotime($date_to) <= strtotime($max_date)) {
                $data = array(
                    'date_added' => $this->security->xss_clean($date_to)
                );

                $this->db->where('denom_id', $this->input->post('denomid'));
                $this->db->update('denomination', $data);

                $data2 = array(
                    'pay_date' => $this->security->xss_clean($date_to)
                );

                $this->db->where('denom_id', $this->input->post('denomid'));
                $this->db->update('payments', $data2);
            } else {
                // Handle the case where date_to is greater than max_date
                echo "Error: The 'Date To' must not be greater than the 'Max Date'.";
            }
        }

        public function saveRemittance()
        {
            $data = array(
                'total_remittance' => $this->security->xss_clean($this->input->post('totalremittance'))
            );

            $this->db->where('denom_id', $this->input->post('denomid'));
            $this->db->update('denomination', $data);
        }

        public function check_remittance($id)
        {
            $query = $this->db->query('SELECT total_remittance FROM denomination WHERE denom_id='.$id);
            return $query->row();
        }

        public function check_remittances($ids) {
            // Modify the query to use where_in for multiple IDs
            $this->db->select('denom_id, total_remittance');
            $this->db->where_in('denom_id', $ids);
            $query = $this->db->get('denomination');

            // Return the result as an associative array with denom_id as the key
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->denom_id] = $row->total_remittance;
            }

            return $result;
        }


        public function getRemittanceCollection($id)
        {
            $query = $this->db->query('SELECT total_collection,total_remittance FROM denomination WHERE denom_id='.$id);
            return $query->row();
        }

        public function checkAmount()
        {
            $query = $this->db->query('SELECT IFNULL(SUM(amount),0.00) AS amt FROM payments WHERE user_id='.$this->input->post('userid').' AND pay_date="'.$this->input->post('date').'" AND denom_id='.$this->input->post('denomid').' AND type="'.$this->input->post('check').'"');
            
            return $query->row()->amt;
        }

        public function account($adate)
        {

            $query = $this->db->query('SELECT c.full_name,a.amount,(a.amount*0.75) AS collect,b.total_pdc,b.total_dc,b.total_cash,b.total_collection,(a.amount*0.75)-IF(ISNULL(b.total_collection),0.00,b.total_collection) AS variance,b.total_remittance,a.sm_code FROM salesman_account a LEFT JOIN denomination b ON a.user_id=b.user_id AND a.account_date=b.date_added INNER JOIN users c ON a.user_id=c.user_id WHERE a.account_date = "'.$adate.'" AND c.location="'.$this->session->userdata('location').'"');

            return $query->result();
        }

        public function account2($adate)
        {
            $query = $this->db->query('SELECT c.full_name,IF(ISNULL(a.amount),0.00,a.amount) AS amount,(IF(ISNULL(a.amount),0.00,a.amount)*0.75) AS collect,IF(ISNULL(b.total_collection),0.00,b.total_collection) AS total_collection,(IF(ISNULL(a.amount),0.00,a.amount)*0.75)-IF(ISNULL(b.total_collection),0.00,b.total_collection) AS variance,IF(ISNULL(b.total_remittance),0.00,b.total_remittance) AS total_remittance,a.sm_code,IF(ISNULL(b.expenses_amt),0.00,b.expenses_amt) AS expenses_amt FROM salesman_account a LEFT JOIN denomination b ON a.user_id=b.user_id AND a.account_date=b.date_added INNER JOIN users c ON a.user_id=c.user_id WHERE a.account_date = "'.$adate.'" AND c.location="'.$this->session->userdata('location').'"');

            return $query->result_array();
        }

        public function colsum($adate)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$adate.'" AND b.type="Salesman" AND b.location="'.$this->session->userdata('location').'"');

            return $query->result();
        }

        public function pdcdc($adate,$atype,$adate1)
        {
            // if($atype == 'BOTH')
            // {
            //     $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" ORDER BY a.pay_date ASC');
            // }
            // else
            // {
            //     $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" ORDER BY a.pay_date ASC');
            // }

            if($atype == 'BOTH')
            {
                $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'"GROUP BY a.payment_id ORDER BY a.pay_date ASC');
            }
            else
            {
                $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'"GROUP BY a.payment_id ORDER BY a.pay_date ASC');
            }
            return $query->result();
        }

        public function pdcdc_uwdg($adate,$atype,$adate1,$atype2,$bank,$utype)
        {
            if($atype == 'BOTH')
            {
                if($utype != 'All')
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                }
                else
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                }
            }
            else
            {
                if($utype != 'All')
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                }
                else
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                }
            }
            return $query->result();
        }

        public function accountrecord($adate)
        {
            $query = $this->db->query('SELECT a.account_id,a.user_id,b.full_name,a.amount FROM salesman_account a INNER JOIN users b ON a.user_id=b.user_id WHERE a.account_date="'.$adate.'"');
        
            return $query->result_array();
        }

        public function getUsers()
        {
            $query = $this->db->query('SELECT user_id,full_name FROM users WHERE location="'.$this->session->userdata('location').'" AND type="Salesman"');
        
            return $query->result();
        }

        public function getUserCode($id)
        {
            $query = $this->db->query('SELECT id_no FROM users WHERE user_id = "'.$id.'"');

            return $query->row();
        }

        public function updateSm($id,$code)
        {
            $data = array(
                'user_id' => $this->input->post('sm'),
                'sm_code' => $code
            );

            $this->db->where('account_id', $id);
            $this->db->update('salesman_account', $data);
        }

        public function updateSmCustomer($uid,$date,$code)
        {
            $data = array(
                'user_id' => $this->input->post('sm'),
                'sm_code' => $code
            );

            $where = array('user_id' => $uid, 'collect_date' => $date);

            $this->db->where($where);
            $this->db->update('salesman_customer', $data);
        }

        public function getSmAccount($id)
        {
            $query = $this->db->query('SELECT * FROM salesman_account WHERE account_id='.$id);
            
            return $query->row();
        }

        public function getDenom($id)
        {
            $query = $this->db->query('SELECT a.*,b.full_name FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE denom_id='.$id);

            return $query->row();
        }

        public function getAllDenom($date)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="Salesman" AND b.location="'.$this->session->userdata('location').'"');

            return $query->result();
        }

        public function getAllDenomTotal($date)
        {
            $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="Salesman" AND b.location="'.$this->session->userdata('location').'"');
        
            return $query->row();
        }

        public function getAllDenomTotal_ldi($date, $loc)
        {
            if($loc=="All"){
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }else{
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.bu="'.$loc.'" AND  b.location="'.$this->session->userdata('location').'"');
            }
           
        
            return $query->row();
        }

        public function getAllDenomTotal_ldi_cashier($date)
        {
            $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,
                                            SUM(a.qty_500) AS qty_500,
                                            SUM(a.qty_200) AS qty_200,
                                            SUM(a.qty_100) AS qty_100,
                                            SUM(a.qty_50) AS qty_50,
                                            SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,
                                            SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,
                                            SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection 
                                            FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND a.approved_by="'.$this->session->userdata('user_id').'"');
        
            return $query->row();
        }

        public function getAllDenom_ldi($date, $loc)
        {
            if($loc=="All")
            {
                $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }else
            {
                $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.bu="'.$loc.'" AND b.location="'.$this->session->userdata('location').'"');
            }

            return $query->result();
        }

        public function getAllDenom_ldi_cashier($date)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND a.approved_by="'.$this->session->userdata('user_id').'"');

            return $query->result();
        }

        public function getAllDenom_uwdg($date,$utype)
        {
            if($utype=="All")
            {
                $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }
            else
            {
                $query = $this->db->query('SELECT a.*,b.full_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="'.$utype.'" AND b.location="'.$this->session->userdata('location').'"');
            }

            return $query->result();
        }

        public function getAllDenomTotal_uwdg($date,$utype)
        {
            if($utype=="All")
            {
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }
            else
            {
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="'.$utype.'" AND b.location="'.$this->session->userdata('location').'"');
            }
        
            return $query->row();
        }

        public function getSmCustomers($dates,$ids)
        {
            $query = $this->db->query('SELECT a.sc_id,a.cus_code,b.name,a.status FROM salesman_customer a LEFT JOIN customer b ON a.cus_code=b.code WHERE a.collect_date="'.$dates.'" AND a.user_id='.$ids);
            
            return $query->result_array();
        }

        public function checktag($ids)
        {
            $query = $this->db->query('SELECT status FROM salesman_customer WHERE sc_id='.$ids);

            return $query->row();
        }

        public function updateStatus($stat,$ids)
        {
            $data = array(
                'status' => $stat
            );

            $this->db->where('sc_id', $ids);
            $this->db->update('salesman_customer', $data);
        }

        public function getBu()
        {
            $query = $this->db->query('SELECT * FROM bu WHERE bu="'.$this->session->userdata('location').'"');

            return $query->row();
        }

        public function getSmIds($did)
        {
            $query = $this->db->query('SELECT a.date_added,b.id_no FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$did);
            return $query->row();
        }

        public function getPayments($pdate,$idno)
        {
            $query = $this->db->query('SELECT * FROM payments_ldi WHERE sm_code="'.$idno.'" AND pay_date="'.$pdate.'"');

            return $query->result_array();
        }

        public function get_data() {
            $query = $this->db->get('payments_ldi');
            return $query->result();
        }

        public function getReturns($idno)
        {
            $query = $this->db->query('SELECT * FROM returns WHERE hepe_code="'.$idno.'" ');

            return $query->result_array();
        }

        public function getLocation($loc)
        {
            $query = $this->db->query('SELECT * FROM locations WHERE location_name="'.$loc.'"');

            return $query->row();
        }

        public function updatePaymentStatus($id)
        {
            $data = array(
                'status' => 'Uploaded'
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_ldi', $data);
        }

        public function updateReturnStatus($id)
        {
            $data = array(
                'status' => 'Uploaded'
            );

            $this->db->where('return_no', $id);
            $this->db->update('returns', $data);
        }
    }
?>