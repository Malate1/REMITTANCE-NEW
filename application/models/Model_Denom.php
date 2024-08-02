<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Denom extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function checkDenom($date)
        {
            $query = $this->db->query('SELECT * FROM denomination WHERE date_added="'.$date.'" AND user_id='.$this->session->userdata('user_id'));
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

        public function save_denom()
        {
            $total_collected = 0.00;
            $total_cash = 0.00;
            $total_remit = 0.00;

            $rem = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            $bo = $this->security->xss_clean(str_replace(",","",$this->input->post('totalbo')));
            $tax = $this->security->xss_clean(str_replace(",","",$this->input->post('totaltax')));
            $ret =  $this->security->xss_clean(str_replace(",","",$this->input->post('totalreturns')));
            $deduct = $bo + $tax;
            
            // var_dump($total_remit);
            // die();

            if($this->session->userdata('bu')=='HORECA' || $this->session->userdata('bu')=='FROZEN' || $this->session->userdata('bu')=='MPDI' || $this->session->userdata('bu')=='CVS' || $this->session->userdata('bu')=='3PS'){
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                //$total_remit = $rem + $ret - $deduct ;
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
            }
            else if($this->session->userdata('location')!='LDI') {
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            }else{
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection2')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash_ldi')));
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            }
            
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'date_added' => $this->security->xss_clean($this->input->post('date')),
                'qty_1000' => $this->security->xss_clean($this->input->post('qty-1000')),
                'amt_1000' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-1000'))),
                'qty_500' => $this->security->xss_clean($this->input->post('qty-500')),
                'amt_500' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-500'))),
                'qty_200' => $this->security->xss_clean($this->input->post('qty-200')),
                'amt_200' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-200'))),
                'qty_100' => $this->security->xss_clean($this->input->post('qty-100')),
                'amt_100' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-100'))),
                'qty_50' => $this->security->xss_clean($this->input->post('qty-50')),
                'amt_50' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-50'))),
                'qty_20' => $this->security->xss_clean($this->input->post('qty-20')),
                'amt_20' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-20'))),
                'total_coins' => $this->security->xss_clean(str_replace(",","",$this->input->post('coins'))),
                'total_dc' => $this->security->xss_clean(str_replace(",","",$this->input->post('dc'))),
                'total_pdc' => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc'))),
                'total_cash' => $total_cash,
                'update_time' => "",
                'datetime' => date("Y-m-d h:i A"),
                'status' => "",
                'dc_pcs' => $this->security->xss_clean($this->input->post('dc_pcs')),
                'pdc_pcs' => $this->security->xss_clean($this->input->post('pdc_pcs')),
                'total_collection' => $total_collected,
                'total_remittance' => $total_remit,
                'remarks' => "",
                'expenses' => $this->security->xss_clean($this->input->post('expenses')),
                'expenses_amt' => $this->security->xss_clean(str_replace(",","",$this->input->post('expenses_amt'))),
                'total_returns' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalreturns'))),
                'vat' => $this->security->xss_clean(str_replace(",","",$this->input->post('totaltax'))),
                'bo' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalbo')))
            );

            // var_dump($data);
            // die();

            $this->db->insert('denomination', $data);
            $pay_date = $this->security->xss_clean($this->input->post('date'));
            $status = 'FILED';
            $status2 = 'Uploaded';

            $query = $this->db->query('SELECT LPAD(MAX(denom_id),8,0) AS max_denom FROM denomination');
            $row_denom = $query->row();


            $maxDenomId = $row_denom->max_denom;
            $pay_id_array = $this->input->post('totalpay_id');
            var_dump($pay_id_array);
            if (!empty($pay_id_array)) {
                // Convert the array values to integers for security
                //$pay_id_array = array_map('intval', $pay_id_array);

                $updateQuery = 'UPDATE payments_ldi 
                                SET status2 = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE sm_code = "' . $this->session->userdata('id_no') . '" 
                                
                                
                                AND pay_id IN ('.$pay_id_array.')';

                $this->db->query($updateQuery);
                
            } else {
                // Handle the case where $pay_id_array is empty, AND status2 = "' . $status . '", AND status != "' . $status2 . '" , AND pay_date = "' . $pay_date . '" AND return_date = "' . $pay_date . '" 
                // You may want to display an error or take appropriate action
                echo "No pay_id values provided for update.";
            }


            $returns_no_array = $this->input->post('totalreturns_no');
            var_dump($returns_no_array);
            if (!empty($returns_no_array)) {
                // Convert the array values to integers for security
                //$returns_no_array = array_map('intval', $returns_no_array);

                $updateQuery1 = 'UPDATE returns 
                                SET status2 = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE hepe_code = "' . $this->session->userdata('id_no') . '" 
                                
                                
                                
                                AND return_no IN ('.$returns_no_array.')';

                $this->db->query($updateQuery1);
                
            } else {
                // Handle the case where $returns_no_array is empty
                // You may want to display an error or take appropriate action
                echo "No returns_no values provided for update.";
            }



            

            $query2 = $this->db->query('SELECT id_no FROM users WHERE user_id = "'.$this->session->userdata('user_id').'"');
            $row2 = $query2->row();

            $query1 = $this->db->query('SELECT * FROM payments_ldi WHERE sm_code="'.$row2->id_no.'" AND pay_date="'.$pay_date.'" AND pay_type="CHECK"');
            $result = $query1->result_array();

            if($query1->num_rows() > 0)
            {
                foreach($result as $row3)
                {
                    if($row3['status2']=='FILED')
                    {
                        $data3 = array('denom_id' => $row_denom->max_denom);

                        $this->db->where('user_id', $this->session->userdata('user_id'));
                        $this->db->where('pay_date', $row3['pay_date']);
                        $this->db->update('payments', $data3);
                    }
                    else
                    {
                        if($row3['check_type']=='Dated Check')
                        {
                            $ctype = 'DC';
                        }
                        else
                        {
                            $ctype = 'PDC';
                        }

                        $data1 = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'pay_date' => $this->security->xss_clean($row3['pay_date']),
                            'cus_code' => $this->security->xss_clean($row3['cus_code']),
                            'type' => $this->security->xss_clean($ctype),
                            'check_no' => $this->security->xss_clean($row3['check_no']),
                            'due_date' => $this->security->xss_clean($row3['due_date']),
                            'acc_name' => $this->security->xss_clean($row3['acc_name']),
                            'acc_num' => $this->security->xss_clean($row3['acc_no']),
                            'bank' => $this->security->xss_clean($row3['check_bank']),
                            'amount' => $this->security->xss_clean($row3['pay_amount']),
                            'entered_by' => 0,
                            'update_time' => '',
                            'datetime' => date("Y-m-d h:i A"),
                            'denom_id' => $row_denom->max_denom,
                            'status' => '',
                            'remarks' => ''
                        );

                        $this->db->insert('payments', $data1);

                        $data2 = array('status2' => 'filed');

                        $this->db->where('pay_id', $row3['pay_id']);
                        $this->db->update('payments_ldi', $data2);
                    }
                }
            }
        }

        public function update_denom()
        {
            $data = array(
                'qty_1000' => $this->security->xss_clean($this->input->post('qty-1000')),
                'amt_1000' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-1000'))),
                'qty_500' => $this->security->xss_clean($this->input->post('qty-500')),
                'amt_500' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-500'))),
                'qty_200' => $this->security->xss_clean($this->input->post('qty-200')),
                'amt_200' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-200'))),
                'qty_100' => $this->security->xss_clean($this->input->post('qty-100')),
                'amt_100' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-100'))),
                'qty_50' => $this->security->xss_clean($this->input->post('qty-50')),
                'amt_50' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-50'))),
                'qty_20' => $this->security->xss_clean($this->input->post('qty-20')),
                'amt_20' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-20'))),
                'total_coins' => $this->security->xss_clean(str_replace(",","",$this->input->post('coins'))),
                'total_dc' => $this->security->xss_clean(str_replace(",","",$this->input->post('dc'))),
                'total_pdc' => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc'))),
                'total_cash' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash'))),
                'update_time' => date("h:i A"),
                'dc_pcs' => $this->security->xss_clean($this->input->post('dc_pcs')),
                'pdc_pcs' => $this->security->xss_clean($this->input->post('pdc_pcs')),
                'total_collection' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection'))),
                'total_remittance' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance'))),
                'expenses' => $this->security->xss_clean($this->input->post('expenses')),
                'expenses_amt' => $this->security->xss_clean(str_replace(",","",$this->input->post('expenses_amt'))),
                'vat' => $this->security->xss_clean(str_replace(",","",$this->input->post('totaltax'))),
                'bo' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalbo')))
            );

            $this->db->where('denom_id', $this->input->post('id'));
            $this->db->update('denomination', $data);
        }

        public function getDenomData()
        {
            $query = $this->db->query('SELECT * FROM denomination WHERE user_id='.$this->session->userdata('user_id'));
            return $query->result();
        }

        public function getDenom($id)
        {
            $query = $this->db->query('SELECT a.*,b.full_name FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE denom_id='.$id);
            return $query->row();
        }

        public function getAllDenom($dates)
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT IFNULL(SUM(qty_1000),0) AS qty1000,IFNULL(SUM(amt_1000),0.00) AS amt1000,IFNULL(SUM(qty_500),0) AS qty500,IFNULL(SUM(amt_500),0.00) AS amt500,IFNULL(SUM(qty_200),0) AS qty200,IFNULL(SUM(amt_200),0.00) AS amt200,IFNULL(SUM(qty_100),0) AS qty100,IFNULL(SUM(amt_100),0.00) AS amt100,IFNULL(SUM(qty_50),0) AS qty50,IFNULL(SUM(amt_50),0.00) AS amt50,IFNULL(SUM(qty_20),0) AS qty20,IFNULL(SUM(amt_20),0.00) AS amt20,IFNULL(SUM(total_coins),0.00) AS totalcoins,IFNULL(SUM(total_dc),0.00) AS totaldc,IFNULL(SUM(total_pdc),0.00) AS totalpdc,IFNULL(SUM(total_cash),0.00) AS totalcash,IFNULL(SUM(dc_pcs),0) AS dcpcs,IFNULL(SUM(pdc_pcs),0) AS pdcpcs,IFNULL(SUM(total_collection),0) AS totalcollection,IFNULL(SUM(total_remittance),0) AS totalremittance FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$dates.'" AND b.location="'.$loc.'"');
            return $query->row();
        }

        public function delete_denom($id)
        {
            $this->db->where('denom_id', $id);
            $this->db->delete('denomination');
        }

        public function save_denom_cashier()
        {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'date_added' => $this->security->xss_clean($this->input->post('date')),
                'qty_1000' => $this->security->xss_clean($this->input->post('qty-1000')),
                'amt_1000' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-1000'))),
                'qty_500' => $this->security->xss_clean($this->input->post('qty-500')),
                'amt_500' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-500'))),
                'qty_200' => $this->security->xss_clean($this->input->post('qty-200')),
                'amt_200' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-200'))),
                'qty_100' => $this->security->xss_clean($this->input->post('qty-100')),
                'amt_100' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-100'))),
                'qty_50' => $this->security->xss_clean($this->input->post('qty-50')),
                'amt_50' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-50'))),
                'qty_20' => $this->security->xss_clean($this->input->post('qty-20')),
                'amt_20' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-20'))),
                'total_coins' => $this->security->xss_clean($this->input->post('coins')),
                'total_dc' => 0.00,
                'total_pdc' => 0.00,
                'total_cash' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash'))),
                'update_time' => "",
                'datetime' => date("Y-m-d h:i A"),
                'status' => ""
            );

            $this->db->insert('denomination', $data);
        }

        public function update_denom_cashier()
        {
            $data = array(
                'qty_1000' => $this->security->xss_clean($this->input->post('qty-1000')),
                'amt_1000' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-1000'))),
                'qty_500' => $this->security->xss_clean($this->input->post('qty-500')),
                'amt_500' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-500'))),
                'qty_200' => $this->security->xss_clean($this->input->post('qty-200')),
                'amt_200' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-200'))),
                'qty_100' => $this->security->xss_clean($this->input->post('qty-100')),
                'amt_100' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-100'))),
                'qty_50' => $this->security->xss_clean($this->input->post('qty-50')),
                'amt_50' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-50'))),
                'qty_20' => $this->security->xss_clean($this->input->post('qty-20')),
                'amt_20' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-20'))),
                'total_coins' => $this->security->xss_clean($this->input->post('coins')),
                'total_cash' => $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash'))),
                'update_time' => date("h:i A")
            );

            $this->db->where('denom_id', $this->input->post('id'));
            $this->db->update('denomination', $data);
        }

        public function get_collection($id_no,$ndate)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total FROM payments_ldi WHERE status2 != "FILED" AND sm_code="'.$id_no.'" AND pay_date="'.$ndate.'"');
            return $query->row();
        }

        public function get_collection_return($id_no,$ndate)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(return_amount),0.00) AS total_return FROM returns WHERE status2 != "FILED" AND hepe_code="'.$id_no.'" AND return_date="'.$ndate.'"');
            return $query->row();
        }

        public function get_collection_return_no($id_no,$ndate)
        {
            $query = $this->db->query('SELECT return_no FROM returns WHERE status2 != "FILED" AND hepe_code="'.$id_no.'" AND return_date="'.$ndate.'"');
            return $query->result_array();
        }

        public function get_collection_pay_ids($id_no,$ndate)
        {
            $query = $this->db->query('SELECT pay_id FROM payments_ldi WHERE status2 != "FILED" AND sm_code="'.$id_no.'" AND pay_date="'.$ndate.'"');
            return $query->result_array();
        }

        public function get_collection_dcamt($id_no,$ndate)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total_dc_amt FROM payments_ldi WHERE status2 != "FILED" AND  sm_code="'.$id_no.'" AND pay_date="'.$ndate.'"AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Dated Check"');
            return $query->row();
        }

        public function get_collection_dcpcs($id_no,$ndate)
        {
            // $query = $this->db->query('SELECT IFNULL(COUNT(pay_id),0) AS total_dc_pcs FROM payments_ldi WHERE status2 != "FILED" AND sm_code="'.$id_no.'" AND pay_date="'.$ndate.'" AND pay_type="CHECK" AND check_type="Dated Check"');
            // return $query->row();

            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_dc_pcs FROM payments_ldi WHERE status2 != "FILED" AND sm_code="'.$id_no.'" AND pay_date="'.$ndate.'" AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Dated Check" ');
            return $query->row();

//             SELECT COUNT(DISTINCT check_no) AS total_dc_pcs
// FROM payments_ldi
// WHERE status2 != 'filed'
//     AND sm_code = 'HEPE-01'
//     AND pay_date = '2024-01-09'
//     AND pay_type = 'CHECK'
//     AND check_type = 'Dated Check';

        }

        public function get_collection_pdcamt($id_no,$ndate)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total_pdc_amt FROM payments_ldi WHERE status2 != "FILED" AND sm_code="'.$id_no.'" AND pay_date="'.$ndate.'" AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Post Dated Check"');
            return $query->row();
        }

        public function get_collection_pdcpcs($id_no,$ndate)
        {
            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_pdc_pcs FROM payments_ldi WHERE status2 != "FILED" AND sm_code="'.$id_no.'" AND pay_date="'.$ndate.'" AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Post Dated Check"');
            return $query->row();
        }
        public function get_collection_cash($id_no,$ndate)
        {

            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS cash FROM payments_ldi WHERE status2 != "FILED" AND sm_code = "'.$id_no.'" AND pay_date = "'.$ndate.'" AND pay_type IN ("CASH", "CASH_BULK")');
            return $query->row();
        }

        

    }
?>