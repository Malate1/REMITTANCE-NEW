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

        public function check_manualsrr($manualsrr)
        {
            $this->db->where('manualsrr', $manualsrr);
            $query = $this->db->get('denomination');

            return $query->num_rows() > 0; // Returns TRUE if exists, FALSE otherwise
        }

        public function save_denom()
        {
            $total_collected = 0.00;
            $total_cash = 0.00;
            $total_remit = 0.00;
            $bu = $this->security->xss_clean($this->input->post('bu'));
            $rem = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            $bo = $this->security->xss_clean(str_replace(",","",$this->input->post('totalbo')));
            $tax = $this->security->xss_clean(str_replace(",","",$this->input->post('totaltax')));
            $ret =  $this->security->xss_clean(str_replace(",","",$this->input->post('totalreturns')));
            $inc =  (float)$this->security->xss_clean(str_replace(",","",$this->input->post('totalinc')));
            $srr =  (float)$this->security->xss_clean(str_replace(",","",$this->input->post('totalsrr')));
            $deduct = $bo + $tax;
            
            $user_id = $this->session->userdata('user_id');
            $sm_code = $this->session->userdata('id_no');
            $query = $this->db->query('SELECT max(count) AS denom_count FROM denomination WHERE user_id = ?', array($user_id)
            );
            $row_count = $query->row();
            $denomCount = $row_count->denom_count + 1;

            $formatted_date = date('mdy');
            $series = $formatted_date . $denomCount . '-' . $sm_code;
            // var_dump($bo);
            // die();

            if($this->session->userdata('bu')=='HORECA' || $this->session->userdata('bu')=='FROZEN' || $this->session->userdata('bu')=='MPDI' || $this->session->userdata('bu')=='CVS' || $this->session->userdata('bu')=='3PS' ){
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                //$total_remit = $rem + $ret - $deduct ;
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
            }
            else if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC' && $this->session->userdata('location')!='LDI-UDC' && $this->session->userdata('location')!='LDI-Parallel') {
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            }else{
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection2')));
                //$total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash_ldi')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            }
            
            $data = array(
                'user_id'           => $this->session->userdata('user_id'),
                'date_added'        => $this->security->xss_clean($this->input->post('date')),
                'qty_1000'          => $this->security->xss_clean($this->input->post('qty-1000')),
                'amt_1000'          => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-1000'))),
                'qty_500'           => $this->security->xss_clean($this->input->post('qty-500')),
                'amt_500'           => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-500'))),
                'qty_200'           => $this->security->xss_clean($this->input->post('qty-200')),
                'amt_200'           => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-200'))),
                'qty_100'           => $this->security->xss_clean($this->input->post('qty-100')),
                'amt_100'           => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-100'))),
                'qty_50'            => $this->security->xss_clean($this->input->post('qty-50')),
                'amt_50'            => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-50'))),
                'qty_20'            => $this->security->xss_clean($this->input->post('qty-20')),
                'amt_20'            => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-20'))),
                'total_coins'       => $this->security->xss_clean(str_replace(",","",$this->input->post('coins'))),
                'total_dc'          => $this->security->xss_clean(str_replace(",","",$this->input->post('dc'))),
                'total_pdc'         => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc'))),
                'total_cash'        => $total_cash,
                'update_time'       => "",
                'datetime'          => date("Y-m-d h:i A"),
                'status'            => "",
                'dc_pcs'            => $this->security->xss_clean($this->input->post('dc_pcs')),
                'pdc_pcs'           => $this->security->xss_clean($this->input->post('pdc_pcs')),
                'total_collection'  => $total_collected,
                'total_remittance'  => $total_remit,
                'total_srr'         => !empty($srr) ? $srr : 0,
                'remarks'           => "",
                'expenses'          => $this->security->xss_clean($this->input->post('expenses')),
                'expenses_amt'      => $this->security->xss_clean(str_replace(",","",$this->input->post('expenses_amt'))),
                'total_returns'     => $this->security->xss_clean(str_replace(",","",$this->input->post('totalreturns'))),
                'vat'               => $this->security->xss_clean(str_replace(",","",$this->input->post('totaltax'))),
                'bo'                => $bo,
                'sm_inc'            => $inc,
                'manager_key'       => $this->security->xss_clean($this->input->post('cashierInput')),
                'count'             => $denomCount,
                'series'            => $series,
                'manualsrr'         => $this->security->xss_clean($this->input->post('manualsrr')),
                'total_palawan'     => $this->security->xss_clean(str_replace(",","",$this->input->post('totalpalawan')))
            );

            // var_dump($data);
            // die();

            $pay_id_array = $this->input->post('totalpay_id');
            $pay_id_sat_array = $this->input->post('totalpaysat_id');
            // For Monday
            $pay_id_pal_array = $this->input->post('totalpaypal_id');
            $pay_id_utc_array = $this->input->post('totalpayutc_id');
            $available_inc = (float)$this->security->xss_clean(str_replace(",", "", $this->input->post('totalincentives')));

            
            $this->db->insert('denomination', $data);
            $pay_date = $this->security->xss_clean($this->input->post('date'));
            $status = 'FILED';
            $status2 = 'Uploaded';

            $query = $this->db->query('SELECT LPAD(MAX(denom_id),8,0) AS max_denom FROM denomination');
            $row_denom = $query->row();
            $maxDenomId = $row_denom->max_denom;

            if ($this->session->userdata('bu')=='XTRUCK' OR $this->session->userdata('bu')=='XTRUCK-NETMAN' OR $this->session->userdata('bu')=='XTRUCK-MPDI' OR $this->session->userdata('bu')=='XTRUCK-NETMAN-BPI') {
                $remaining_inc = 0.00;
                if (is_numeric($available_inc)) {
                    $remaining_inc = $available_inc - $inc;
                } else {
                    // Handle the case where either input value is not numeric
                    $remaining_inc = null; // Or any other appropriate value indicating an error
                }

                $data2 = array(
                    
                    'inc_balance' => $remaining_inc
                );

                $this->db->where('sm_code', $this->input->post('sm_code'));
                $this->db->update('salesman_incentives_bal', $data2);

                // Check if sm_code already exists
                $this->db->where('sm_code', $this->input->post('sm_code'));
                $this->db->where('denom_id', $maxDenomId);
                $query = $this->db->get('salesman_incentives_used');

                if ($query->num_rows() > 0) {
                    // If sm_code exists, update the record
                    if($inc > 0){
                        $data3 = array(
                            'inc_used' => $inc,
                            'denom_id' => $this->input->post('denomid')
                        );
                        //$this->db->where('sm_code', $this->input->post('sm_code'));

                        $this->db->update('salesman_incentives_used', $data3);
                    }
                } else {
                    // If sm_code doesn't exist, insert a new record
                    if($inc > 0){
                        $data3 = array(
                            'sm_code' => $this->input->post('sm_code'),
                            'inc_used' => $inc,
                            'denom_id' =>$maxDenomId
                        );
                        $this->db->insert('salesman_incentives_used', $data3);
                    }
                    
                }
            }

            // For Monday
            // updating palawan record 
            if (!empty($pay_id_pal_array)) {

                if($bu != 'OPLAN' && $bu != 'MAS-LDI' && $bu != 'MAS-NETMAN' && $bu != 'MAS-MPDI'){

                    if ($_SESSION['sm_type'] == 'Dual') {
                        $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
                    } else {
                        $where = 'sm_code = "'.$this->db->escape_str($sm_code).'"';
                    }

                    $updateQueryPal = 'UPDATE payments_palawan 
                        SET status = "FILED",
                            denom_id = ' . $maxDenomId . '
                        WHERE ' . $where . '
                        
                        
                        AND pay_id IN ('.$pay_id_pal_array.')';
                }else{
                    $updateQueryPal = 'UPDATE payments_palawan_op 
                        SET status = "FILED",
                            denom_id = ' . $maxDenomId . '
                        WHERE sm_code = "' . $this->session->userdata('id_no') . '" 
                        
                        
                        AND pay_id IN ('.$pay_id_pal_array.')';
                }
             
            $this->db->query($updateQueryPal);
                
            } else {
                
                // echo "No pay_id values provided for update.";
            }

            // updating under the cup record
            if (!empty($pay_id_utc_array)) {
             
                $updateQueryUtc = 'UPDATE payments_underthecup 
                            SET status = "FILED",
                                denom_id = ' . $maxDenomId . '
                            WHERE sm_code = "' . $this->session->userdata('id_no') . '" 
                            
                            
                            AND pay_id IN ('.$pay_id_utc_array.')';

            $this->db->query($updateQueryUtc);
               
            } else {
                
                // echo "No pay_id values provided for update.";
            }

            if (!empty($pay_id_sat_array)) {

                if ($_SESSION['sm_type'] == 'Dual') {
                    $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
                } else {
                    $where = 'sm_code = "'.$this->db->escape_str($sm_code).'"';
                }
             
                $updateQuerySat = 'UPDATE payments_satellite 
                            SET status = "FILED",
                                denom_id = ' . $maxDenomId . '
                            WHERE ' . $where . '  
                            
                            
                            AND pay_id IN ('.$pay_id_sat_array.')';

            $this->db->query($updateQuerySat);
                
                
                
            } else {
                
                // echo "No pay_id values provided for update.";
            }


            if (!empty($pay_id_array)) {

                if($this->session->userdata('bu')=='XTRUCK' OR $this->session->userdata('bu')=='XTRUCK-NETMAN' OR $this->session->userdata('bu')=='XTRUCK-MPDI' OR $this->session->userdata('bu')=='XTRUCK-NETMAN-BPI'){

                    if ($_SESSION['sm_type'] == 'Dual') {
                        $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
                    } else {
                        $where = 'sm_code = "'.$this->db->escape_str($sm_code).'"';
                    }

                    $updateQuery = 'UPDATE payments_xtruck 
                                SET status2 = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE ' . $where . ' 
                                
                                
                                AND pay_id IN ('.$pay_id_array.')';

                $this->db->query($updateQuery);
                }else{
                    $updateQuery = 'UPDATE payments_ldi 
                                SET status2 = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE jefe_code = "' . $this->session->userdata('id_no') . '" 
                                
                                
                                AND pay_id IN ('.$pay_id_array.')';

                $this->db->query($updateQuery);
                }
                
                
            } else {
                
                // echo "No pay_id values provided for update.";
            }

            $bo_id_array = $this->input->post('totalbo_id');
            // var_dump($bo_id_array);
            // die();
            if (!empty($bo_id_array) && ($this->session->userdata('bu')=='XTRUCK' OR $this->session->userdata('bu')=='XTRUCK-NETMAN' OR $this->session->userdata('bu')=='XTRUCK-MPDI' OR $this->session->userdata('bu')=='XTRUCK-NETMAN-BPI')) {

                if ($_SESSION['sm_type'] == 'Dual') {
                    $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
                } else {
                    $where = 'sm_code = "'.$this->db->escape_str($sm_code).'"';
                }

                $updateQuery1 = 'UPDATE returns_xtruck 
                                SET status = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE ' . $where . ' 
                                
                                
                                
                                AND bo_id IN ('.$bo_id_array.')';

                $this->db->query($updateQuery1);
                
            }elseif (!empty($bo_id_array) && ($this->session->userdata('bu')=='OPLAN' OR $this->session->userdata('bu')=='MAS-NETMAN' OR $this->session->userdata('bu')=='MAS-LDI' OR $this->session->userdata('bu')=='MAS-MPDI' )) {
                $updateQuery2 = 'UPDATE bo 
                                SET status = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE hepe_code = "' . $this->session->userdata('id_no') . '" 
                                
                                
                                
                                AND bo_id IN ('.$bo_id_array.')';

                $this->db->query($updateQuery2);

                $bo_si_array = $this->input->post('totalbo_si');
                if(!empty($bo_si_array) && ($this->session->userdata('bu')=='OPLAN' OR $this->session->userdata('bu')=='MAS-NETMAN' OR $this->session->userdata('bu')=='MAS-LDI' OR $this->session->userdata('bu')=='MAS-MPDI' )){

                    if (!is_array($bo_si_array)) {
                        $bo_si_array = explode(',', $bo_si_array);
                    }
                
                    // Sanitize and quote each si_docno
                    // $si_list = array_map(function($si) {
                    //     return $this->db->escape(trim($si));  // trim() to remove any whitespace
                    // }, $bo_si_array);
                
                    // $si_list_str = implode(',', $si_list);
                    // $updateQuerySi = 'UPDATE payments_ldi p
                    //             JOIN bo b ON p.si_docno = b.si_docno
                    //             SET p.pay_amount = p.pay_amount - b.bo_amount
                    //             WHERE p.jefe_code = "' . $this->session->userdata('id_no') . '" 
                    //             AND p.si_docno IN ('.$si_list_str.')';

                                

                    // $this->db->query($updateQuerySi);
                }
                
            } else {
                
                // echo "No returns_no values provided for update.";
            }


            $returns_no_array = $this->input->post('totalreturns_no');
            //var_dump($returns_no_array);
            if (!empty($returns_no_array) && ($this->session->userdata('bu')!='XTRUCK' && $this->session->userdata('bu')!='XTRUCK-NETMAN' && $this->session->userdata('bu')!='XTRUCK-MPDI' OR $this->session->userdata('bu')=='XTRUCK-NETMAN-BPI')) {
                $updateQuery1 = 'UPDATE returns 
                                SET status2 = "FILED",
                                    denom_id = ' . $maxDenomId . '
                                WHERE hepe_code = "' . $this->session->userdata('id_no') . '" 
                                
                                
                                
                                AND return_no IN ('.$returns_no_array.')';

                $this->db->query($updateQuery1);
                
            } else {
                
                // echo "No returns_no values provided for update.";
            }

                $query2 = $this->db->query('SELECT id_no FROM users WHERE user_id = "'.$this->session->userdata('user_id').'"');
                $row2 = $query2->row();

                $query1 = $this->db->query('SELECT * FROM payments_ldi WHERE jefe_code="'.$row2->id_no.'" AND pay_date="'.$pay_date.'" AND pay_type="CHECK"');
                $result = $query1->result_array();

            
            return $maxDenomId;
        }

        public function update_denom()
        {
            if($this->session->userdata('bu')=='HORECA' || $this->session->userdata('bu')=='FROZEN' || $this->session->userdata('bu')=='MPDI' || $this->session->userdata('bu')=='CVS' || $this->session->userdata('bu')=='3PS'){
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                //$total_remit = $rem + $ret - $deduct ;
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
            }
            else if($this->session->userdata('location')!='LDI' && $this->session->userdata('location')!='LDI-CDC' && $this->session->userdata('location')!='LDI-UDC') {
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            }else{
                $total_collected = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcollection2')));
                //$total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash_ldi')));
                $total_cash = $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash')));
                $total_remit = $this->security->xss_clean(str_replace(",","",$this->input->post('totalremittance')));
            }

            $data = array(
                'qty_1000'          => $this->security->xss_clean($this->input->post('qty-1000')),
                'amt_1000'          => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-1000'))),
                'qty_500'           => $this->security->xss_clean($this->input->post('qty-500')),
                'amt_500'           => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-500'))),
                'qty_200'           => $this->security->xss_clean($this->input->post('qty-200')),
                'amt_200'           => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-200'))),
                'qty_100'           => $this->security->xss_clean($this->input->post('qty-100')),
                'amt_100'           => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-100'))),
                'qty_50'            => $this->security->xss_clean($this->input->post('qty-50')),
                'amt_50'            => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-50'))),
                'qty_20'            => $this->security->xss_clean($this->input->post('qty-20')),
                'amt_20'            => $this->security->xss_clean(str_replace(",","",$this->input->post('amount-20'))),
                'total_coins'       => $this->security->xss_clean(str_replace(",","",$this->input->post('coins'))),
                'total_dc'          => $this->security->xss_clean(str_replace(",","",$this->input->post('dc'))),
                'total_pdc'         => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc'))),
                'total_cash'        => $this->security->xss_clean(str_replace(",","",$this->input->post('totalcash'))),
                'update_time'       => date("h:i A"),
                'dc_pcs'            => $this->security->xss_clean($this->input->post('dc_pcs')),
                'pdc_pcs'           => $this->security->xss_clean($this->input->post('pdc_pcs')),
                'total_collection'  => $total_collected,
                'total_remittance'  => $total_remit,
                'expenses'          => $this->security->xss_clean($this->input->post('expenses')),
                'expenses_amt'      => $this->security->xss_clean(str_replace(",","",$this->input->post('expenses_amt'))),
                'vat'               => $this->security->xss_clean(str_replace(",","",$this->input->post('totaltax'))),
                'bo'                => $this->security->xss_clean(str_replace(",","",$this->input->post('totalbo'))),
                'manualsrr'         => $this->security->xss_clean($this->input->post('manualsrr')),
                'total_palawan'     => $this->security->xss_clean(str_replace(",","",$this->input->post('totalpalawan'))),
                'total_returns'     => $this->security->xss_clean(str_replace(",","",$this->input->post('totalreturns'))),
                'total_srr'         => (float)$this->security->xss_clean(str_replace(",","",$this->input->post('totalsrr'))),
            );

            $this->db->where('denom_id', $this->input->post('id'));
            $this->db->update('denomination', $data);
        }

        public function getDenomData()
        {
            
            $query = $this->db->select('a.*, (SELECT IFNULL(SUM(d.tax_amount), 0.00) FROM payments_xtruck d WHERE d.denom_id=a.denom_id) AS wtax')
                  ->from('denomination a')
                  ->where('user_id', $this->session->userdata('user_id'))
                  ->get();

            return $query->result();

        }

        var $column_order = array(null, 'manualsrr', 'total_dc', 'total_pdc' ); 
        var $column_search = array('manualsrr','date_added'); 
        var $order = array('manualsrr' => 'ASC');

        private function _get_datatables_query()
        {
            $this->db->select('a.*')
                ->from('denomination a')
                ->where('a.user_id', $this->session->userdata('user_id'));

            $i = 0;
            foreach ($this->column_search as $item) {
                if ($_POST['search']['value']) {
                    if ($i === 0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_search) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if (isset($_POST['order'])) {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        function get_datatables()
        {
            $this->_get_datatables_query();
            if ($_POST['length'] != -1)
                $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }

        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }

        public function count_all()
        {
            $this->db->from('denomination');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            return $this->db->count_all_results();
        }


        public function getDenom($id)
        {
            // $query = $this->db->query('SELECT a.*,b.full_name , (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_xtruck d WHERE  d.denom_id=a.denom_id) AS wtax FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE denom_id='.$id);
            // return $query->row();

            $query = $this->db->select('a.*, b.full_name')
                  ->select('(SELECT IFNULL(SUM(d.tax_amount), 0.00) FROM payments_xtruck d WHERE d.denom_id=a.denom_id) AS wtax')
                  ->from('denomination a')
                  ->join('users b', 'a.user_id = b.user_id')
                  ->where('denom_id', $id)
                  ->get();

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

        //FOR OPLAN
        //BATCHING
        public function get_collection($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->row();
        }

        public function get_collection_return($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(return_amount),0.00) AS total_return FROM returns WHERE status2 != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->row();
        }

        public function get_collection_tax($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(tax_amount),0.00) AS total_tax FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND  jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->row();
        }

        public function get_collection_bo($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS total_bo FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->row();
        }

        public function get_collection_bo_disc($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS total_bo_disc FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" AND type="Discount" ');
            return $query->row();
        }

        public function get_collection_bo_admin($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS total_bo_admin FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" AND created_by="ADMIN" '); 
            return $query->row();
        }

        public function get_collection_return_no($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT return_no FROM returns WHERE status2 != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->result_array();
        }

        public function get_collection_bo_no($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT bo_id FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->result_array();
        }

        public function get_collection_bo_si_disc($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT si_docno FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" AND created_by="ADMIN"');
            return $query->result_array();
        }

        public function get_collection_pay_ids($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT pay_id FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->result_array();
        }

        public function get_collection_dcamt($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total_dc_amt FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND  jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Dated Check"');
            return $query->row();
        }

        public function get_collection_pdcamt($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total_pdc_amt FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'"  AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Post Dated Check"');
            return $query->row();
        }

        public function get_collection_pdcpcs($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_pdc_pcs FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'"  AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Post Dated Check"');
            return $query->row();
        }

        public function get_collection_dcpcs($id_no,$ndate,$batch)
        {
        
            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_dc_pcs FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Dated Check" ');
            return $query->row();

        }

        public function get_collection_cash($id_no,$ndate, $batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS cash FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code = "'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'"  AND pay_type IN ("CASH", "CASH_BULK")');
            return $query->row();
        }

        public function get_collection_palawan_oplan($id_no,$ndate,$batch)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS palawan FROM payments_palawan_op WHERE status != "FILED" AND sm_code = "'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->row();
        }

        public function get_collection_pay_ids_oplan_pal($id_no,$ndate,$batch)
        {
            $query = $this->db->query('SELECT pay_id FROM payments_palawan_op WHERE status != "FILED" AND sm_code="'.$id_no.'" AND IF(batch = "", "1", batch) = "'.$batch.'" ');
            return $query->result_array();
        }
        

        //CURRENT W/OUT BATCHING
        // public function get_collection($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" ');
        //     return $query->row();
        // }

        // public function get_collection_return($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(return_amount),0.00) AS total_return FROM returns WHERE status2 != "FILED" AND hepe_code="'.$id_no.'" ');
        //     return $query->row();
        // }

        // public function get_collection_tax($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(tax_amount),0.00) AS total_tax FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND  jefe_code="'.$id_no.'" ');
        //     return $query->row();
        // }

        // public function get_collection_bo($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS total_bo FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" ');
        //     return $query->row();
        // }

        // public function get_collection_bo_disc($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS total_bo_disc FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND type="Discount" ');
        //     return $query->row();
        // }

        // public function get_collection_bo_admin($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS total_bo_admin FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND created_by="ADMIN" '); 
        //     return $query->row();
        // }

        // public function get_collection_return_no($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT return_no FROM returns WHERE status2 != "FILED" AND hepe_code="'.$id_no.'" ');
        //     return $query->result_array();
        // }

        // public function get_collection_bo_no($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT bo_id FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" ');
        //     return $query->result_array();
        // }

        // public function get_collection_bo_si_disc($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT si_docno FROM bo WHERE status != "FILED" AND hepe_code="'.$id_no.'" AND created_by="ADMIN"');
        //     return $query->result_array();
        // }

        // public function get_collection_pay_ids($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT pay_id FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'" ');
        //     return $query->result_array();
        // }

        // public function get_collection_dcamt($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total_dc_amt FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND  jefe_code="'.$id_no.'" AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Dated Check"');
        //     return $query->row();
        // }

        // public function get_collection_pdcamt($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total_pdc_amt FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'"  AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Post Dated Check"');
        //     return $query->row();
        // }

        // public function get_collection_dcpcs($id_no,$ndate)
        // {
        
        //     $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_dc_pcs FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'"  AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Dated Check" ');
        //     return $query->row();

        // }

        // public function get_collection_pdcpcs($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_pdc_pcs FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code="'.$id_no.'"  AND pay_type IN ("CHECK", "CHECK_BULK") AND check_type="Post Dated Check"');
        //     return $query->row();
        // }

        // public function get_collection_cash($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS cash FROM payments_ldi WHERE status2 != "FILED" AND status4 != "DELETED" AND jefe_code = "'.$id_no.'"  AND pay_type IN ("CASH", "CASH_BULK")');
        //     return $query->row();
        // }

        // public function get_collection_palawan_oplan($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS palawan FROM payments_palawan_op WHERE status != "FILED" AND sm_code = "'.$id_no.'"');
        //     return $query->row();
        // }

        // public function get_collection_pay_ids_oplan_pal($id_no,$ndate)
        // {
        //     $query = $this->db->query('SELECT pay_id FROM payments_palawan_op WHERE status != "FILED" AND sm_code="'.$id_no.'" ');
        //     return $query->result_array();
        // }


        //FOR EXTRUCK
        public function get_collection_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(net_amount),0.00) AS total FROM payments_xtruck WHERE status2 != "FILED" AND status="ORDER" AND ' . $where);
            return $query->row();
        }

        public function get_collection_return_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS total FROM payments_xtruck WHERE status2 != "FILED" AND status IN ("BOS", "BO-on-panels") AND ' . $where);
            return $query->row();
        }

        public function get_collection_pay_ids_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT pay_id FROM payments_xtruck WHERE status2 != "FILED" AND ' . $where);
            return $query->result_array();
        }

        public function get_collection_pay_ids_xtruck_pal($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT pay_id FROM payments_palawan WHERE status != "FILED" AND ' . $where);
            return $query->result_array();
        }

        public function get_collection_pay_ids_xtruck_utc($id_no,$ndate)
        {
            $query = $this->db->query('SELECT pay_id FROM payments_underthecup WHERE status != "FILED" AND sm_code="'.$id_no.'" ');
            return $query->result_array();
        }

        public function get_collection_pay_ids_xtruck_sat($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT pay_id FROM payments_satellite WHERE status != "FILED" AND ' . $where);
            return $query->result_array();
        }

        public function get_collection_bo_ids_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT bo_id FROM returns_xtruck WHERE status != "FILED" AND ' . $where);
            return $query->result_array();
        }

        public function get_collection_dcamt_xtruck($id_no, $ndate)
        {
            // Query to calculate the total amount, AND due_date BETWEEN DATE_SUB("' . $ndate . '", INTERVAL 6 MONTH) AND "' . $ndate . '"
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT IFNULL(SUM(check_amount), 0.00) AS total_dc_amt 
                FROM payments_xtruck 
                WHERE status2 != "FILED" 
                
                AND pay_type IN ("Cheque", "CHECK_BULK") 
                AND status = "ORDER" 
                AND due_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND DATE_ADD(CURDATE(), INTERVAL 6 DAY)
                AND ' . $where
            );

            $result = $query->row();

            // Update records that were previously tagged as Post Dated
            $this->db->set('check_type', 'Dated');
            $this->db->where('check_type', 'Post Dated');
            $this->db->where('status2 !=', 'FILED');
            $this->db->where($where, null, false); 
            $this->db->where_in('pay_type', ['Cheque', 'CHECK_BULK']);
            $this->db->where('status', 'ORDER');
            // $this->db->where('due_date BETWEEN DATE_SUB("' . $ndate . '", INTERVAL 6 MONTH) AND "' . $ndate . '"');
            $this->db->where('due_date >=', 'DATE_SUB(CURDATE(), INTERVAL 6 MONTH)', false); // 6 months before today
            $this->db->where('due_date <=', 'DATE_ADD(CURDATE(), INTERVAL 6 DAY)', false);    // 6 days after today
            $this->db->update('payments_xtruck');

            return $result;
        }

        public function get_collection_dcamt_return_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(check_amount),0.00) AS total_dc_amt_ret FROM returns_xtruck WHERE status != "FILED"  AND pay_type IN ("Cheque", "CHECK_BULK") AND posting_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) 
                AND DATE_ADD(CURDATE(), INTERVAL 6 DAY) 
                AND ' . $where);
            $result = $query->row();

            // Update records that were previously tagged as Post Dated
            $this->db->set('check_type', 'Dated');
            $this->db->where('check_type', 'Post Dated');
            $this->db->where('status !=', 'FILED');
            $this->db->where($where, null, false); 
            $this->db->where_in('pay_type', ['Cheque', 'CHECK_BULK']);
            
            //$this->db->where('posting_date BETWEEN DATE_SUB("' . $ndate . '", INTERVAL 6 MONTH) AND "' . $ndate . '"');
            $this->db->where('posting_date >=', 'DATE_SUB(CURDATE(), INTERVAL 6 MONTH)', false); // 6 months before today
            $this->db->where('posting_date <=', 'DATE_ADD(CURDATE(), INTERVAL 6 DAY)', false);    // 6 days after today
            $this->db->update('returns_xtruck');

            return $result;
        }

        public function get_collection_dcamt_sat($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(a.sm_code = "'.$_SESSION['id_no'].'" OR a.sm_code = "'.$_SESSION['sm_code2'].'")';
                $where2 = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'a.sm_code = "'.$this->db->escape_str($id_no).'"';
                $where2 = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT IFNULL(SUM(a.check_amount), 0.00) AS total_sat_dc_amt, IFNULL(SUM(appr_amount), 0.00) AS appr_amount, COUNT(DISTINCT b.check_no) AS total_sat_dc_pcs, b.check_no FROM payments_xtruck a INNER JOIN payments_satellite b ON a.check_no = b.check_no AND a.acc_no = b.acc_no AND a.acc_name = b.acc_name AND a.cus_code = b.cus_code AND a.si_docno = b.si_docno  WHERE a.status2 != "FILED" AND b.pay_type IN ("Cheque", "CHECK_BULK") AND b.due_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND DATE_ADD(CURDATE(), INTERVAL 6 DAY)  AND a.status="ORDER"  AND ' . $where);
            
            $result = $query->row();

            // Update records that were previously tagged as Post Dated
            $this->db->set('check_type', 'Dated');
            $this->db->where('check_type', 'Post Dated');
            $this->db->where('status !=', 'FILED');
            $this->db->where($where2, null, false); 
            $this->db->where_in('pay_type', ['Cheque', 'CHECK_BULK']);
            //$this->db->where('due_date BETWEEN DATE_SUB("' . $ndate . '", INTERVAL 6 MONTH) AND "' . $ndate . '"');
            $this->db->where('due_date >=', 'DATE_SUB(CURDATE(), INTERVAL 6 MONTH)', false); // 6 months before today
            $this->db->where('due_date <=', 'DATE_ADD(CURDATE(), INTERVAL 6 DAY)', false);    // 6 days after today
            $this->db->update('payments_satellite');

            return $result;
        }

        public function get_collection_dcpcs_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_dc_pcs FROM payments_xtruck WHERE status2 != "FILED"  AND pay_type IN ("Cheque", "CHECK_BULK") AND due_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND DATE_ADD(CURDATE(), INTERVAL 6 DAY) AND status="ORDER" AND ' . $where);
            return $query->row();

        }

        public function get_collection_dcpcs_xtruck_ret($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_dc_pcs_ret FROM returns_xtruck WHERE status != "FILED" AND pay_type IN ("Cheque", "CHECK_BULK") AND posting_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND DATE_ADD(CURDATE(), INTERVAL 6 DAY) AND ' . $where);
            return $query->row();

        }

        public function get_collection_pdcamt_xtruck($id_no, $ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(check_amount), 0.00) AS total_pdc_amt 
                FROM payments_xtruck 
                WHERE status2 != "FILED" 
                
                AND pay_type IN ("Cheque", "CHECK_BULK") 
                AND status = "ORDER" 
                AND due_date > DATE_ADD(CURDATE(), INTERVAL 6 DAY)
                AND ' . $where
            );
            
            $result = $query->row();

            // Update records that were previously tagged as Dated
            $this->db->set('check_type', 'Post Dated');

            $this->db->where('check_type', 'Dated');
            $this->db->where('status2 !=', 'FILED');
            $this->db->where($where, null, false); 
            $this->db->where_in('pay_type', ['Cheque', 'CHECK_BULK']);
            $this->db->where('status', 'ORDER');
            $this->db->where('due_date >', 'DATE_ADD(CURDATE(), INTERVAL 6 DAY)', false); // Greater than 6 days from today
            $this->db->update('payments_xtruck');

            return $result;
        }

        public function get_collection_pdcamt_return_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(check_amount),0.00) AS total_pdc_amt_ret FROM returns_xtruck WHERE status != "FILED"  AND pay_type IN ("Cheque", "CHECK_BULK") AND posting_date > DATE_ADD(CURDATE(), INTERVAL 6 DAY) AND '. $where);
            $result = $query->row();

            // Update records that were previously tagged as Dated
            $this->db->set('check_type', 'Post Dated');
            $this->db->where('check_type', 'Dated');
            $this->db->where('status !=', 'FILED');
            $this->db->where($where, null, false); 
            $this->db->where_in('pay_type', ['Cheque', 'CHECK_BULK']);
            
            //$this->db->where('posting_date > "' . $ndate . '"');
            $this->db->where('posting_date >', 'DATE_ADD(CURDATE(), INTERVAL 6 DAY)', false); // Greater than 6 days from today
            $this->db->update('returns_xtruck');

            return $result;
        }

        public function get_collection_cash_sat($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT IFNULL(SUM(appr_amount),0.00) as appr_amount FROM payments_satellite WHERE status != "FILED" AND pay_type = "Cash" AND '. $where);
            
            return $query->row();
        }

        public function get_collection_pdcamt_sat($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(a.sm_code = "'.$_SESSION['id_no'].'" OR a.sm_code = "'.$_SESSION['sm_code2'].'")';
                $where2 = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'a.sm_code = "'.$this->db->escape_str($id_no).'"';
                $where2 = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(a.check_amount), 0.00) AS total_sat_pdc_amt, IFNULL(SUM(appr_amount), 0.00) AS appr_amount,COUNT(DISTINCT b.check_no) AS total_sat_pdc_pcs, b.check_no  FROM payments_xtruck a INNER JOIN payments_satellite b ON a.check_no = b.check_no AND a.acc_no = b.acc_no AND a.acc_name = b.acc_name AND a.cus_code = b.cus_code AND a.si_docno = b.si_docno WHERE a.status2 != "FILED" AND b.pay_type IN ("Cheque", "CHECK_BULK") AND  b.due_date > DATE_ADD(CURDATE(), INTERVAL 6 DAY) AND a.status="ORDER" AND '. $where);
            $result = $query->row();

            // Update records that were previously tagged as Dated
            $this->db->set('check_type', 'Post Dated');
            $this->db->where('check_type', 'Dated');
            $this->db->where('status !=', 'FILED');
            $this->db->where($where2, null, false); 
            $this->db->where_in('pay_type', ['Cheque', 'CHECK_BULK']);
            //$this->db->where('due_date > "' . $ndate . '"');
            $this->db->where('due_date >', 'DATE_ADD(CURDATE(), INTERVAL 6 DAY)', false); // Greater than 6 days from today
            $this->db->update('payments_satellite');

            return $result;
        }

        public function get_collection_pdcpcs_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_pdc_pcs FROM payments_xtruck WHERE status2 != "FILED"  AND pay_type IN ("Cheque", "CHECK_BULK") AND due_date > DATE_ADD(CURDATE(), INTERVAL 6 DAY) AND status="ORDER" AND '. $where);
            return $query->row();
        }

        public function get_collection_pdcpcs_xtruck_ret($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT COUNT(DISTINCT check_no) AS total_pdc_pcs_ret FROM returns_xtruck WHERE status != "FILED"  AND pay_type IN ("Cheque", "CHECK_BULK") AND posting_date > DATE_ADD(CURDATE(), INTERVAL 6 DAY) AND '. $where);
            return $query->row();

        }

        public function get_collection_cash_xtruck($id_no,$ndate)
        {
            //AND pay_type IN ("CASH", "CASH_BULK")
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(cash_amount),0.00) AS cash FROM payments_xtruck WHERE status2 != "FILED"  AND status="ORDER" AND '. $where);
            return $query->row();
        }

        public function get_collection_bo_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS bo,IFNULL(SUM(cash_amount),0.00) AS bo_cash, IFNULL(SUM(check_amount),0.00) AS bo_check  FROM returns_xtruck WHERE status != "FILED" AND '. $where);
            return $query->row();

            // $query = $this->db->query('SELECT IFNULL(SUM(bo_amount),0.00) AS bo,IFNULL(SUM(cash_amount),0.00) AS bo_cash  FROM returns_xtruck WHERE status != "FILED" AND sm_code = "'.$id_no.'"');
            // return $query->row();
        }

        public function get_collection_palawan_xtruck($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }

            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS palawan FROM payments_palawan WHERE status != "FILED" AND '. $where);
            return $query->row();
        }

        public function get_collection_utc_xtruck($id_no,$ndate)
        {
            $query = $this->db->query('SELECT IFNULL(SUM(pay_amount),0.00) AS utc FROM payments_underthecup WHERE status != "FILED" AND sm_code = "'.$id_no.'"');
            return $query->row();
        }

        public function get_collection_sm_inc($id_no,$ndate)
        {
            if ($_SESSION['sm_type'] == 'Dual') {
                $where = '(sm_code = "'.$_SESSION['id_no'].'" OR sm_code = "'.$_SESSION['sm_code2'].'")';
            } else {
                $where = 'sm_code = "'.$this->db->escape_str($id_no).'"';
            }
            $query = $this->db->query('SELECT inc_balance  FROM salesman_incentives_bal WHERE '. $where);
            return $query->row();
        }

        

    }
?>