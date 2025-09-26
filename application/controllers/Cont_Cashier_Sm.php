<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Cashier_Sm extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Cashier_Sm');
            $this->load->model('Model_Export');
        }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('cashiersm_date');
            $this->load->view('footer');
        }

        
        public function importldi_sm()
        {
            $this->load->view('header');
            $this->load->view('importingldi');
            $this->load->view('footer');
        }

        public function exportldi_sm()
        {
            $this->load->view('header');
            $this->load->view('exportingldi');
            $this->load->view('footer');
        }

        public function checkclearingdate()
        {
            $this->load->view('header');
            $this->load->view('checkclearing_date');
            $this->load->view('footer');
        }

        public function admindate()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplan();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date',$data);
            $this->load->view('footer');
        }

        public function admindatepal()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplan();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_palawan',$data);
            $this->load->view('footer');
        }

        public function admindatesat()
        {
            $this->load->view('header');
            
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_satellite',$data);
            $this->load->view('footer');
        }

        public function admindateutc()
        {
            $this->load->view('header');
            
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_utc',$data);
            $this->load->view('footer');
        }

        public function admindatedenom()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplan();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_denom',$data);
            $this->load->view('footer');
        }

        public function admindateret()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplan();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_ret',$data);
            $this->load->view('footer');
        }

        public function admindatebo()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplan();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_bo',$data);
            $this->load->view('footer');
        }

        public function admindateinc()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplan();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruck();
            $this->load->view('admin_date_inc',$data);
            $this->load->view('footer');
        }

        public function accountdate()
        {
            $this->load->view('header');
            $this->load->view('cashier_accountdate');
            $this->load->view('footer');
        }

        public function colsum()
        {
            $this->load->view('header');
            $data['oplan']      = $this->Model_Cashier_Sm->getSmOplanPerLocation();
            $data['xtruck']     = $this->Model_Cashier_Sm->getSmXtruckPerLocation();
            $data['mas_ldi']    = $this->Model_Cashier_Sm->getSmMasLdiPerLocation();
            $data['mas_netman'] = $this->Model_Cashier_Sm->getSmMasNetmanPerLocation();
            $data['horeca']     = $this->Model_Cashier_Sm->getSmHorecaPerLocation();
            $data['frozen']     = $this->Model_Cashier_Sm->getSmFrozenPerLocation();
            $data['mpdi']       = $this->Model_Cashier_Sm->getSmMpdiPerLocation();
            $data['cvs']        = $this->Model_Cashier_Sm->getSmCvsPerLocation();
            $data['unilab']     = $this->Model_Cashier_Sm->getSmUnilabPerLocation();
            
            $this->load->view('colsumdate',$data);
            $this->load->view('footer');
        }

        public function colsumdual()
        {
            $this->load->view('header');
            
            $data['xtruck']     = $this->Model_Cashier_Sm->getSmXtruckDualPerLocation();
            $data['oplan']      = $this->Model_Cashier_Sm->getSmOplanPerLocation();
           // $data['xtruck']     = $this->Model_Cashier_Sm->getSmXtruckPerLocation();
            $data['mas_ldi']    = $this->Model_Cashier_Sm->getSmMasLdiPerLocation();
            $data['mas_netman'] = $this->Model_Cashier_Sm->getSmMasNetmanPerLocation();
            $data['horeca']     = $this->Model_Cashier_Sm->getSmHorecaPerLocation();
            $data['frozen']     = $this->Model_Cashier_Sm->getSmFrozenPerLocation();
            $data['mpdi']       = $this->Model_Cashier_Sm->getSmMpdiPerLocation();
            $data['cvs']        = $this->Model_Cashier_Sm->getSmCvsPerLocation();
            $data['unilab']     = $this->Model_Cashier_Sm->getSmUnilabPerLocation();
            
            $this->load->view('colsumdualdate',$data);
            $this->load->view('footer');
        }

        public function dvsrrsum()
        {
            $this->load->view('header');
            $data['oplan'] = $this->Model_Cashier_Sm->getSmOplanPerLocation();
            $data['xtruck'] = $this->Model_Cashier_Sm->getSmXtruckPerLocation();
            $this->load->view('dvsrrdate',$data);
            $this->load->view('footer');
        }

        public function colsumdaterange()
        {
            $this->load->view('header');
            $this->load->view('colsumdaterange');
            $this->load->view('footer');
        }

        public function palawandaterange()
        {
            $this->load->view('header');
            $this->load->view('palawan_date');
            $this->load->view('footer');
        }

        public function retdaterange()
        {
            $this->load->view('header');
            $this->load->view('retdaterange');
            $this->load->view('footer');
        }

        public function colsumreportop($datefrom,$dateto,$sm,$sm_type)
        {
            $data['datefrom'] = $datefrom;
            $data['dateto'] = $dateto;
            $data['sm'] = $sm;
            var_dump($sm);
            $data['result1'] = $this->Model_Cashier_Sm->colsum($datefrom,$dateto,$sm,$sm_type);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            $data['full_name'] = $this->Model_Cashier_Sm->getUserNamebyId($sm);
            $this->load->view('colsum_report', $data);
        }

        public function colsumreportopexcel($datefrom,$dateto,$sm,$sm_type)
        {
            $data['datefrom'] = $datefrom;
            $data['dateto'] = $dateto;
            $data['sm'] = $sm;
            $data['result1'] = $this->Model_Cashier_Sm->colsum($datefrom,$dateto,$sm,$sm_type);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            $data['full_name'] = $this->Model_Cashier_Sm->getUserNamebyId($sm);
            $this->load->view('colsum_report_excel', $data); 
        }

        public function colsumreportmpdi($datefrom,$dateto,$sm,$sm_type)
        {
            $data['datefrom'] = $datefrom;
            $data['dateto'] = $dateto;
            $data['sm'] = $sm;
            $sm_code2 = null;
            $sm_code2_row = $this->db->get_where('users', ['id_no' => $sm])->row();
            if ($sm_code2_row) {
                $sm_code2 = $sm_code2_row->sm_code2;
            }

            // var_dump($sm_code2);
            // die();
            $data['result1'] = $this->Model_Cashier_Sm->colsumdual($datefrom,$dateto,$sm,$sm_type,$sm_code2);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            $data['full_name'] = $this->Model_Cashier_Sm->getUserNamebyId($sm);
            $this->load->view('colsum_mpdi_report', $data);
        }

        public function colsumreportxt($datefrom,$dateto,$sm,$sm_type)
        {
            $data['datefrom'] = $datefrom;
            $data['dateto'] = $dateto;
            $data['sm'] = $sm;
            $data['sm_type'] = $sm_type;
            var_dump($sm_type);
            $data['result1'] = $this->Model_Cashier_Sm->colsum($datefrom,$dateto,$sm,$sm_type);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            $data['full_name'] = $this->Model_Cashier_Sm->getUserNamebyId($sm);
            $this->load->view('colsum_report', $data);
        }

        public function accountreport($date)
        {
            $data['result'] = $date;
            $data['result1'] = $this->Model_Cashier_Sm->account($date);
            $results = $this->Model_Cashier_Sm->account2($date);
            $this->load->view('accountability_report', $data);

            // $date1 = strtotime($date);
            // $datetime1 = date("Y-m-d", $date1);

            // $connection = 'ODBC_WDG_AR';
            // $username = 'sa';
            // $password = 'Corporate_it';

            // @$connect = odbc_connect($connection, $username, $password);

            // foreach($results as $row)
            // {
            //     $so = ($row['total_collection'] + $row['expenses_amt']) - $row['total_remittance'];
                
            //     if($so > 0)
            //     {
            //         $over = $so;
            //         $short = 0.00;
            //     }
            //     elseif($so < 0)
            //     {
            //         $over = 0.00;
            //         $short = $so;
            //     }
            //     else
            //     {
            //         $over = 0.00;
            //         $short = 0.00;
            //     }

            //     $query2 = "SELECT * FROM collections WHERE sm_code='".$row['sm_code']."' AND collect_date='".$datetime1."'";
            //     $res = odbc_exec($connect, $query2);

            //     if(odbc_num_rows($res) > 0)
            //     {
            //         $query1 = "UPDATE collections SET amount_to_collect=".$row['amount'].",required_collect=".$row['collect'].",collect_amount=".$row['total_collection'].",actual_amount=".$row['total_remittance'].",short_amount=".$short.",over_amount=".$over." WHERE sm_code='".$row['sm_code']."' AND collect_date='".$datetime1."'";
            //         odbc_exec($connect, $query1);
            //     }
            //     else
            //     {
            //         $query1 = "INSERT INTO collections (sm_code,collect_date,amount_to_collect,required_collect,collect_amount,actual_amount,short_amount,over_amount) VALUES('".$row['sm_code']."','".$datetime1."',".$row['amount'].",".$row['collect'].",".$row['total_collection'].",".$row['total_remittance'].",".$short.",".$over.")";
            //         odbc_exec($connect, $query1);
            //     }
            // }

            // odbc_close($connect);
        }

        public function pdcdcdate()
        {
            $data['result1'] = $this->Model_Cashier_Sm->getBankData2();
            $this->load->view('header');
            if($this->session->userdata('location')=='UWDG')
            {
                $this->load->view('cashier_pdcdcdate-uwdg',$data);
            }
            else
            {
                $this->load->view('cashier_pdcdcdate');
            }
            $this->load->view('footer');
        }

        public function retpdcdcreport()
        {
            $data['result3'] = date('Y-m-d');
            $data['result4'] = $this->Model_Cashier_Sm->ret_pdcdc_ldi();
            $data['result5'] = $this->Model_Cashier_Sm->ret_pdcdc_xtruck();
            //$data['result2'] = $type;
            $this->load->view('ret_pdcdc_report', $data);
        }

        public function pdcdcreport($date,$type,$date1)
        {
            //$memory_limit = ini_get('memory_limit');
			ini_set('memory_limit','1G');
			// ini_set('max_execution_time', 0);

            $data['result'] = $date;
            $data['result3'] = $date1;
            $data['result1'] = $this->Model_Cashier_Sm->pdcdc($date,$type,$date1);
            $data['result4'] = $this->Model_Cashier_Sm->pdcdc_ldi($date,$type,$date1);
            $data['result5'] = $this->Model_Cashier_Sm->pdcdc_xtruck($date,$type,$date1);
            $data['result2'] = $type;
            $this->load->view('pdcdc_report', $data);
        }

        public function pdcdcreport2($date,$type,$date1)
        {
            $data['result'] = $date;
            $data['result3'] = $date1;
            $data['result1'] = $this->Model_Cashier_Sm->pdcdc($date,$type,$date1);
            $data['result4'] = $this->Model_Cashier_Sm->pdcdc_ldi($date,$type,$date1);
            $data['result5'] = $this->Model_Cashier_Sm->pdcdc_xtruck($date,$type,$date1);
            $data['result2'] = $type;
            $this->load->view('pdcdc_report2', $data);
        }

        public function pdcdcreport_uwdg($date,$type,$date1,$type2,$bank,$utype)
        {
            $data['result'] = $date;
            $data['result3'] = $date1;
            $data['result1'] = $this->Model_Cashier_Sm->pdcdc_uwdg($date,$type,$date1,$type2,$bank,$utype);
            $data['result2'] = $type;
            $data['result4'] = $bank;
            $data['result5'] = $type2;
            $this->load->view('pdcdc_report', $data);
        }

        public function pdcdcreport2_uwdg($date,$type,$date1,$type2,$bank,$utype)
        {
            $data['result'] = $date;
            $data['result3'] = $date1;
            $data['result1'] = $this->Model_Cashier_Sm->pdcdc_uwdg($date,$type,$date1,$type2,$bank,$utype);
            $data['result2'] = $type;
            $data['result4'] = $bank;
            $data['result5'] = $type2;
            $this->load->view('pdcdc_report2', $data);
        }

        public function accountrecorddate()
        {
            $this->load->view('header');
            $this->load->view('cashier_accountrecorddate');
            $this->load->view('footer');
        }

        public function accountrecord($date)
        {
            $data['result'] = $date;
            $data['result1'] = $this->Model_Cashier_Sm->accountrecord($date);
            $this->load->view('header');
            $this->load->view('accountability_record', $data);
            $this->load->view('footer');
        }

        public function edit_salesman()
        {
            $result = $this->Model_Cashier_Sm->getUsers();
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$_POST['ids'].'" required>';
            echo '<select class="form-control" name="sm" id="sm" required>';
                echo '<option></option>';
            foreach($result as $row)
            {
                echo '<option value="'.$row->user_id.'">'.$row->full_name.'</option>';
            }
            echo '</select><br/>';
            echo '<button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>';
            echo '<button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
        }

        public function save_salesman()
        {
            $row = $this->Model_Cashier_Sm->getUserCode($this->input->post('sm'));
            $row1 = $this->Model_Cashier_Sm->getSmAccount($this->input->post('id'));

            $uid = $row1->user_id;
            $date = $row1->account_date;

            $this->Model_Cashier_Sm->updateSmCustomer($uid,$date,$row->id_no);
            $this->Model_Cashier_Sm->updateSm($this->input->post('id'),$row->id_no);
            echo 'okay';
        }

        public function cus_tag()
        {   
            echo '<p style="font-size:11px"><i>Check the checkbox if the customer has payment in this date of accountability of salesman.</i></p>';
            $results = $this->Model_Cashier_Sm->getSmCustomers($this->input->post('dates'),$this->input->post('ids'));
            echo '<table class="table table-bordered compact">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Code</th>';
            echo '<th>Name</th>';
            echo '<th></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach($results as $row) {
                echo '<tr>';
                echo '<td>'.$row['cus_code'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td style="text-align:center"><input type="checkbox" '.$row['status'].' onclick="customer_check('.$row['sc_id'].')"></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }

        public function custagging()
        {
            $row = $this->Model_Cashier_Sm->checktag($this->input->post('ids'));
            
            if($row->status=='checked')
            {
                $status='';
                $this->Model_Cashier_Sm->updateStatus($status,$this->input->post('ids'));
            }
            else
            {
                $status='checked';
                $this->Model_Cashier_Sm->updateStatus($status,$this->input->post('ids'));
            }
        }

        public function printdenom($ids)
        {
            $data['result'] = $this->Model_Cashier_Sm->getDenom($ids);
            // $this->load->view('header');
            $this->load->view('print_denom', $data);
            // $this->load->view('footer');
        }

        public function printdenomldi($ids)
        {
            $data['result'] = $this->Model_Cashier_Sm->getDenom($ids);
            $data['result2'] = $this->Model_Cashier_Sm->getPaymentsLdi($ids);
            $data['result3'] = $this->Model_Cashier_Sm->getPaymentsLdiOplan($ids);
            $data['result4'] = $this->Model_Cashier_Sm->getPaymentsLdiExt($ids);
            
            // $this->load->view('header');
            $this->load->view('print_denom_ldi', $data);
            // $this->load->view('footer');
        }

        public function printalldenom($dates)
        {
            $data['result'] = $dates;
            $data['result1'] = $this->Model_Cashier_Sm->getAllDenom($dates);
            $data['result2'] = $this->Model_Cashier_Sm->getAllDenomTotal($dates);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_alldenom', $data);
            // $this->load->view('footer');
        }

        public function printalldenom_LDI($dates,$loc)
        {
            $data['result'] = $dates;
            $data['result4'] = $loc;
            $data['result1'] = $this->Model_Cashier_Sm->getAllDenom_ldi($dates,$loc);
            $data['result2'] = $this->Model_Cashier_Sm->getAllDenomTotal_ldi($dates,$loc);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_alldenom', $data);
            // $this->load->view('footer');
        }

        public function printalldenom_LDI_cashier($dates)
        {
            $data['result'] = $dates;
            $data['result1'] = $this->Model_Cashier_Sm->getAllDenom_ldi_cashier($dates);
            $data['result2'] = $this->Model_Cashier_Sm->getAllDenomTotal_ldi_cashier($dates);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_alldenom', $data);
            // $this->load->view('footer');
        }

        public function printallpalawan_LDI_per_Date($datefrom, $dateto,$loc)
        {
            $data['result']   = $datefrom;
            $data['dateto']     = $dateto;
            $data['loc']     = $loc;
            //var_dump($loc);
            $data['result1'] = $this->Model_Cashier_Sm->getAllPalawan_ldi_per_Date($datefrom,$dateto,$loc);
            $data['result2'] = $this->Model_Cashier_Sm->getAllPalawanTotal_ldi_per_Date($datefrom,$dateto);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_allpalawan', $data);
            // $this->load->view('footer');
        }

        public function printalldenom_LDI_per_Date($datefrom, $dateto)
        {
            $data['result']   = $datefrom;
            $data['dateto']     = $dateto;
            $data['result1'] = $this->Model_Cashier_Sm->getAllDenom_ldi_per_Date($datefrom,$dateto);
            $data['result2'] = $this->Model_Cashier_Sm->getAllDenomTotal_ldi_per_Date($datefrom,$dateto);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_alldenom', $data);
            // $this->load->view('footer');
        }

        public function printalldenom_LDI_per_Date_Excel($datefrom, $dateto)
        {
            $data['result']   = $datefrom;
            $data['dateto']     = $dateto;
            $data['result1'] = $this->Model_Cashier_Sm->getAllDenom_ldi_per_Date($datefrom,$dateto);
            $data['result2'] = $this->Model_Cashier_Sm->getAllDenomTotal_ldi_per_Date($datefrom,$dateto);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_alldenom_excel', $data);
            // $this->load->view('footer');
        }

        public function printalldenom_uwdg($dates,$utype)
        {
            $data['result'] = $dates;
            $data['result4'] = $utype;
            $data['result1'] = $this->Model_Cashier_Sm->getAllDenom_uwdg($dates,$utype);
            $data['result2'] = $this->Model_Cashier_Sm->getAllDenomTotal_uwdg($dates,$utype);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
            // $this->load->view('header');
            $this->load->view('print_alldenom', $data);
            // $this->load->view('footer');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        // public function cashiersm_payment_data($date)
        // {
        //     $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDate($date);
            
        //     $data['result2'] = $date;
        //     $display = 'Allow';
        //     $data['locate'] = $display;
        //     $this->load->view('header',$data);
        //     $this->load->view('cashier_smdenom_ledger', $data);
        //     $this->load->view('footer');
        // }

        public function cashiersm_payment_data()
        {
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_ledger', $data);
            $this->load->view('footer');
        }

        // public function get_cashier_sm_data_ajax($date)
        // {
        //     $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDate($date);
        //     $this->load->view('sm_ledger_tbody', $data); 
        //     //$this->load->view('footer');
        // }

        public function get_cashier_sm_data_ajax()
        {
            $list = $this->Model_Cashier_Sm->get_datatables(); // handles search, limit, offset
            $data = [];
            foreach ($list as $row) {
                $denom_id = $row->denom_id;
                $total_satellite = $this->Model_Cashier_Sm->getTotalSatelliteByDenomId($denom_id);
                $total_pal = in_array($this->session->userdata('bu'), ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-NETMAN-BPI', 'XTRUCK-MPDI'])
                    ? $this->Model_Cashier_Sm->getTotalPalByDenomId($denom_id)
                    : $this->Model_Cashier_Sm->getTotalPalOpByDenomId($denom_id);

                $checkbox = '';
                if ($row->status == 'Pending' && $row->total_remittance != 0) {
                    $checkbox = '<input type="checkbox" name="selected_denom[]" value="' . $denom_id . '">';
                }

                $rem_amt = ($row->total_collection + @$total_pal->total_pal + $row->sm_inc) - ($row->total_remittance + @$total_pal->total_pal);
                if ($rem_amt > 0) {
                    $rem_diff = 'Over (' . number_format(abs($rem_amt), 2) . ')';
                } elseif ($rem_amt < 0) {
                    $rem_diff = 'Short (' . number_format(abs($rem_amt), 2) . ')';
                } else {
                    $rem_diff = 'None';
                }

                $actions = '<a title="View Denomination2" style="color: black; cursor: pointer" data-toggle="modal" data-target="#viewSmDenomLdi"
                    onclick="viewsmdenom_content_ldi(\'' . $row->denom_id . '\')">
                    <i class="fas fa-dollar-sign fa-lg"></i></a>&nbsp;&nbsp;';

                if ($row->status == 'Pending') {
                    $manualsrr_empty = empty(trim($row->manualsrr));
                    $manualsrr_required_for = ["XTRUCK", "XTRUCK-NETMAN", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI"];
                    $requires_manualsrr = in_array($row->bu, $manualsrr_required_for);

                    $invalid = (
                        ($row->dc_pcs != '0' && $row->cashier_dcpcs == '0') ||
                        ($row->pdc_pcs != '0' && $row->cashier_pdcpcs == '0') ||
                        ($row->dc_pcs != $row->cashier_dcpcs) ||
                        ($row->pdc_pcs != $row->cashier_pdcpcs) ||
                        ($row->total_dc != $row->cashier_dc) ||
                        ($row->total_pdc != $row->cashier_pdc)
                    ) && !in_array($row->bu, ['OPLAN', 'XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI', 'MAS-NETMAN', 'MAS-MPDI', 'MAS-LDI']);

                    if ($invalid || ($requires_manualsrr && $manualsrr_empty)) {
                        $actions .= '<a title="Approve Disabled" class="disabled-link" style="color: #4967B4; cursor: not-allowed;"><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;';
                    } else {
                        $actions .= '<a title="Approve" class="enabled-link" style="color: #4967B4; cursor: pointer;"
                            onclick="approve_sm_denomldi(\'' . $row->denom_id . '\')"><i class="far fa-thumbs-up fa-lg"></i></a>&nbsp;&nbsp;';
                    }

                    if ($invalid) {
                        $actions .= '<a title="Check Entry" style="color: green; cursor: pointer"
                            href="' . base_url('/checkentry/' . $row->denom_id . '/' . $row->date_added . '/' . $row->user_id) . '">
                            <i class="fas fa-pen-alt fa-lg"></i></a>&nbsp;&nbsp;';
                    } 
                    // else {
                    //     $actions .= '<a title="Disapprove" style="color: red; cursor: pointer"
                    //         onclick="disapprove_sm_denom(\'' . $row->denom_id . '\')"><i class="far fa-thumbs-down fa-lg"></i></a>&nbsp;&nbsp;';
                    // }
                }else {
                    if($row->date_added == date('Y-m-d')  )
                    $actions .= '<a title="Disapprove" style="color: red; cursor: pointer"
                        onclick="disapprove_sm_denom(\'' . $row->denom_id . '\')"><i class="far fa-thumbs-down fa-lg"></i></a>&nbsp;&nbsp;';
                }

                if ($row->bu == 'OPLAN' || $row->bu == 'MAS-LDI' || $row->bu == 'MAS-NETMAN' || $row->bu == 'MAS-MPDI' ) {
                    $actions .= '<a title="View Checks" style="color: orange; cursor: pointer"
                        href="' . base_url('/viewsmchecks/' . $row->user_id . '/' . $row->date_added . '/' . $row->denom_id) . '">
                        <i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                }

                if (in_array($row->bu, ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI'])) {
                    $actions .= '<a title="View Checks" style="color: orange; cursor: pointer"
                        data-toggle="modal" data-target="#viewSmChecksLdi"
                        onclick="viewsmchecks_content_ldi(\'' . $row->user_id . ',' . $row->date_added . ',' . $row->denom_id . '\')">
                        <i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';

                    $actions .= '<a title="View Palawan" style="color: #17a2b8; cursor: pointer"
                        data-toggle="modal" data-target="#viewSmPalLdi"
                        onclick="viewsmpal_content_ldi(\'' . $row->user_id . ',' . $row->date_added . ',' . $row->denom_id . '\')">
                        <i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                }

                $actions .= '<a title="Remarks" style="color: #A074C4; cursor: pointer" data-toggle="modal" data-target="#cashierRemarks"
                    onclick="cashier_remarks(\'' . $row->denom_id . '\')">' .
                    ($row->remarks == '' ? '<i class="far fa-comment fa-lg"></i>' : '<i class="fas fa-comment"></i>') .
                    '</a>&nbsp;&nbsp;';

                if ($row->status == 'Approved') {
                    $actions .= '<a title="Print" style="color: #17a2b8; cursor: pointer"
                        onclick="print_denomldi(\'' . $row->denom_id . '\')"><i class="fas fa-print fa-lg"></i></a>&nbsp;&nbsp;';

                    if ($row->bu == 'OPLAN' || $row->bu == 'MAS-LDI' || $row->bu == 'MAS-NETMAN' || $row->bu == 'MAS-MPDI') {
                        $manualsrr = $row->manualsrr;
                        $isValidManualsrr = !empty($manualsrr) && preg_match('/^\d+$/', $manualsrr);
                        if ($isValidManualsrr) {
                            $upload_color = ($row->status3 == '' && $row->status4 == '') ? 'orange' : '#17a2b8';
                            $actions .= '<a title="Upload2" style="color: ' . $upload_color . '; cursor: pointer"
                                onclick="upload_payments(\'' . $row->denom_id . '\')"><i class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;';
                        } else {
                            $actions .= '<a title="Upload Disabled" style="color: gray; cursor: not-allowed" onclick="return false;">
                                <i class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;';
                        }
                    }

                    if (in_array($row->bu, ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI'])) {
                        $actions .= '<a title="Download Payments" style="color: green; cursor: pointer"
                            onclick="download_payments_xtruck(\'' . $row->denom_id . '\')"><i class="fas fa-download fa-lg"></i></a>&nbsp;&nbsp;';

                        $upload_func = ($this->session->userdata('location') == 'LDI-UDC') ? 'upload_payments_xtruck_udc' : 'upload_payments_xtruck';
                        $upload_color = ($row->status3 == '' && $row->status4 == '') ? 'orange' : '#17a2b8';
                        $actions .= '<a title="Upload2" style="color: ' . $upload_color . '; cursor: pointer"
                            onclick="' . $upload_func . '(\'' . $row->denom_id . '\')"><i class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;';
                    }

                    if ($row->bu == 'MPDI') {
                        $actions .= '<a title="Upload4" style="color: green; cursor: pointer"
                            onclick="download_payments_mpdi(\'' . $row->denom_id . '\')"><i class="fas fa-download fa-lg"></i></a>&nbsp;&nbsp;';
                    }

                    if ($row->user_id == '325') {
                        $actions .= '<a title="Upload5" style="color: orange; cursor: pointer"
                            onclick="upload_payments_xtruck_big(\'' . $row->denom_id . '\')"><i class="fas fa-upload fa-lg"></i></a>&nbsp;&nbsp;';
                    }
                }


                $data[] = [
                    "checkbox" => $checkbox,
                    "denom_id" => $row->denom_id,
                    "manualsrr" => $row->manualsrr,
                    "salesman" => $row->id_no . ' - ' . $row->full_name,
                    "total_cash" => number_format($row->total_cash, 2),
                    "total_pal" => number_format(@$total_pal->total_pal, 2),
                    "total_dc" => number_format($row->total_dc, 2),
                    "total_pdc" => number_format($row->total_pdc, 2),
                    "total_collection" => number_format($row->total_collection, 2),
                    "coll_plus_pal" => number_format($row->total_collection + @$total_pal->total_pal, 2),
                    "remit_plus_pal" => number_format($row->total_remittance + @$total_pal->total_pal, 2),
                    "satellite" => in_array($this->session->userdata('bu'), ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI'])
                    ? number_format(@$total_satellite->total_satellite, 2)
                    : '0.00',
                    "total_srr" => number_format($row->total_srr, 2),
                    "returns" => number_format($row->total_returns, 2),
                    "tax" => in_array($this->session->userdata('bu'), ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI'])
                                ? number_format($row->wtax, 2)
                                : number_format($row->vat, 2),
                    "bo" => number_format($row->bo, 2),
                    "sm_inc" => in_array($this->session->userdata('bu'), ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI'])
                    ? number_format($row->sm_inc, 2)
                    : '0.00',
                    "rem_diff" => $rem_diff,
                    "status" => '<span class="badge badge-' . ($row->status == 'Pending' ? 'danger' : 'primary') . '">' . $row->status . '</span>',
                    "actions" => $actions

                    
                ];

                
            }

            echo json_encode([
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => $this->Model_Cashier_Sm->count_all(),
                "recordsFiltered" => $this->Model_Cashier_Sm->count_filtered(),
                "data" => $data
            ]);
        }


        public function cashiersm_payment_dataxtsrr($datefrom,$dateto,$sm_code)
        {
            $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDateSrr($datefrom,$dateto,$sm_code);
            $data['result2'] = $datefrom;
            $data['result3'] = $dateto;
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_ledger_admin', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtsrrno($denom_id)
        {
            $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDateSrrNo($denom_id);
            // $data['result2'] = $datefrom;
            // $data['result3'] = $dateto;

            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_ledger_admin', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataopsrr($datefrom,$dateto,$sm_code)
        {
            $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDateSrrOp($datefrom,$dateto,$sm_code);
            $data['result2'] = $datefrom;
            $data['result3'] = $dateto;
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_ledger_admin', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataopsrrno($denom_id)
        {
            $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDateSrrOpNo($denom_id);
            // $data['result2'] = $datefrom;
            // $data['result3'] = $dateto;

            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_ledger_admin', $data);
            $this->load->view('footer');
        }

        public function dvsrr_op($datefrom,$dateto,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmDvSrrOp($datefrom,$dateto,$sm_code);
            $data['palawan'] = $this->Model_Cashier_Sm->getSmDvSrrOpPal($datefrom,$dateto,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $datefrom;
            $data['result3'] = $dateto;
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('dvsrr_op', $data);
            $this->load->view('footer');
        }

        public function dvsrr_xt($datefrom,$dateto,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmDvSrrXt($datefrom,$dateto,$sm_code);
            $data['incentives'] = $this->Model_Cashier_Sm->getSmDvSrrXtInc($datefrom,$dateto,$sm_code);
            $data['satellite'] = $this->Model_Cashier_Sm->getSmDvSrrXtSat($datefrom,$dateto,$sm_code);
            $data['palawan'] = $this->Model_Cashier_Sm->getSmDvSrrXtPal($datefrom,$dateto,$sm_code);
            $data['utc'] = $this->Model_Cashier_Sm->getSmDvSrrXtUtc($datefrom,$dateto,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['sm'] = $sm_code;
            $data['result2'] = $datefrom;
            $data['result3'] = $dateto;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('dvsrr_xt', $data);
            // $this->load->view('footer');
        }

        public function cashiersm_payment_dataop($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsOp($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_payments_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxt($date,$date2,$sm_code)
        {   
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXt($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtpal($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtPal($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_palawan_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtpalref($ref)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtPalRef($ref);
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_palawan_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataoppal($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsOpPal($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_palawan_payments_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataoppalref($ref)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsOpPalRef($ref);
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_palawan_payments_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtsat($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtSat($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_satellite_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtsatref($ref)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtSatRef($ref);
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_satellite_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtutc($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtUtc($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_utc_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataxtutcref($ref)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtUtcRef($ref);
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_utc_payments_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataopbo($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsOpBo($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            $data['result3'] = $date2;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_bo_payments_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataopboref($ref)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsOpBoRef($ref);
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_bo_payments_op', $data);
            $this->load->view('footer');
        }

        
        public function cashiersm_payment_dataxtinc($sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsXtIncBal($sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_inc_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_payment_dataopsi($si)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmPaymentsOpSi($si);
            //$data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            //$data['result2'] = $date;
            //$data['pay_stat'] = $pay_stat;
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_payments_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_return_dataop($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmReturnsOp($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_returns_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_return_dataopsi($si)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmReturnsOpSi($si);
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_returns_op', $data);
            $this->load->view('footer');
        }

        public function cashiersm_return_dataxt($date,$date2,$sm_code)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmReturnsXt($date,$date2,$sm_code);
            $data['row']        = $this->Model_Cashier_Sm->getUserNamebyId($sm_code);
            $data['result2'] = $date;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_returns_xt', $data);
            $this->load->view('footer');
        }

        public function cashiersm_return_dataxtsi($si)
        {   
            
            $data['result'] = $this->Model_Cashier_Sm->getSmReturnsXtSi($si);
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_smdenom_returns_xt', $data);
            $this->load->view('footer');
        }

        public function upload_payments()
        {
            try {
                $denom_id = $this->input->post('ids');
                // var_dump($denom_id);
                // die();
                $result = $this->Model_Cashier_Sm->getSmIds($denom_id);
                // var_dump($result->id_no);
                if (!$result) {
					echo 'done_prebooking';
    				exit;
						
				}
                $result2 = $this->Model_Cashier_Sm->getPayments($denom_id,$result->id_no);
                $result4 = $this->Model_Cashier_Sm->getReturns($result->id_no);
                $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));

                

                $connection = $result3->ar_connection;
                $username = $result3->db_username;
                $password = $result3->db_password;

                @$connect = odbc_connect($connection, $username, $password);

                //var_dump($connection, $username, $password);

                

                foreach ($result2 as $row) {
                    //if ($row['status'] != 'Uploaded' && $row['status3'] != 'Returned' && $result->manualsrr != '') {
                        $payAmount = floatval($row['pay_amount']);
                        $taxAmount = floatval($row['tax_amount']);
                        // Check if si_docno already exists
                        $check_query = "SELECT COUNT(*) AS count FROM payments_mw WHERE si_docno = '".$row['si_docno']."' and pay_type = '".$row['pay_type']."' and pay_amount = '".$payAmount."'";
                        $check_result = odbc_exec($connect, $check_query);
                        $exists = odbc_fetch_array($check_result)['count'];
    
                        if ($exists == 0) {
                            
                            $siDate = date('Y-m-d H:i:s', strtotime($row['si_date']));
                            
                            $dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                            $remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
                            $act_name = str_replace("'", "''", $row['acc_name']);
    
                            if($row['check_type'] == 'Dated Check'){
    
                                $check = 'DC';
                            }elseif($row['check_type'] == 'Post Dated Check'){
                                $check = 'PDC';
                            }else{
                                $check = '';
                            }
    
                            // Assuming $row['pay_amount'] is a valid numeric value
                            
                            if($row['si_docno'] != ''){
                                $sql_query = "INSERT INTO payments_mw(
                                    manual_srr,
                                    pay_date,
                                    si_docno,
                                    si_date,
                                    cus_code,
                                    pay_amount,
                                    tax_amt,
                                    pay_type,
                                    check_no,
                                    due_date,
                                    acc_no,
                                    acc_name,
                                    check_bank,
                                    jefe_code,
                                    sm_code,
                                    sm_name,
                                    ref_no,
                                    check_type,
                                    stats,
                                    tax_status,
                                    applied_by,
                                    gl_stats) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$remitDate."',
                                    '".$row['si_docno']."',
                                    '".$siDate."',
                                    '".$row['cus_code']."',
                                    '".$payAmount."',
                                    '".$taxAmount."',
                                    '".$row['pay_type']."',
                                    '".$row['check_no']."',
                                    '".$dueDate."',
                                    '".$row['acc_no']."',
                                    '".$row['acc_name']."',
                                    '".$row['check_bank']."',
                                    '".$row['jefe_code']."',
                                    '".$row['sm_code']."',
                                    '".$row['sm_name']."',
                                    '".$row['ref_no']."',
                                    '".$check."',
                                    '',
                                    'Pending',
                                    '',
                                    'F')";
    
                                $result_query = odbc_exec($connect, $sql_query);
                            }else{
                                // For CHECK
                                if($row['pay_type'] == 'CHECK' || $row['pay_type'] == 'CHECK_BULK'){
                                    $sql_query5 = "INSERT INTO payments_mw_bulk(
                                        manual_srr,
                                        cus_code,
                                        remit_date,
                                        pay_type,
                                        chk_type,
                                        amt,
                                        due_date,
                                        or_no,
                                        check_no,
                                        act_name,
                                        act_no,
                                        bank,
                                        stats,
                                        gl_stats,
                                        tax_amt,
                                        tax_status
                                        ) 
                                        VALUES(
                                            '".$result->manualsrr."',
                                            '".$row['cus_code']."',
                                            '".$remitDate."',
                                            '".$row['pay_type']."',
                                            '".$check."',
                                            '".$row['pay_amount']."',
                                            '".$dueDate."',
                                            '".$row['denom_id']."',
                                            '".$row['check_no']."',
                                            '".$act_name."',  
                                            '".$row['acc_no']."',
                                            '".$row['check_bank']."'
                                            ,'Pending','F','".$taxAmount."','Pending'
                                        )";
                
                                    $result_check = odbc_exec($connect, $sql_query5);
                                }else{
                                    //For CASH
                                    
    
                                    $sql_query6 = "INSERT INTO payments_mw_bulk(
                                        manual_srr,
                                        cus_code,
                                        remit_date,
                                        pay_type,
                                        amt,
                                        stats,
                                        gl_stats,
                                        tax_amt,
                                        tax_status
                                        ) 
                                        VALUES(
                                            '".$result->manualsrr."',
                                            '".$row['cus_code']."',
                                            '".$remitDate."',
                                            'CASH_BULK',
                                            '".$row['pay_amount']."',
                                            'Pending','F','".$taxAmount."','Pending'
                                        )";
    
                                    $result_cash = odbc_exec($connect, $sql_query6);
                                }
                            }
                            
    
                            // Check if the query was successful
                            if ($result_query) {
                                // If successful, update payment status
                                $this->Model_Cashier_Sm->updatePaymentStatus($row['pay_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query: " . odbc_errormsg($connect);
                            }
                        } elseif($exists == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "Already exists SI. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                            $remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
                            $update_query_cheque = "
                                UPDATE payments_mw
                                SET manual_srr = '".$result->manualsrr."', pay_date = '$remitDate'
                                WHERE si_docno = '".$row['si_docno']."' 
                                and pay_type = '".$row['pay_type']."' and pay_amount = '".$payAmount."'
                            ";

                            $update_cheque = odbc_exec($connect, $update_query_cheque);
                        }else{
                            echo "Warning: Multiple matching SI records found. Please review.";
                        }
                    //}
                }

                

                // Close the database connection
                odbc_close($connect);

                echo 'yes';
            } catch (Exception $e) {
                // Log any unexpected exceptions
                error_log("Exception: " . $e->getMessage());
            }
        }

        public function upload_payments_xtruck()
        {
            try {
                $denom_id = $this->input->post('ids');
                $result = $this->Model_Cashier_Sm->getSmIds($denom_id);
                $result2 = $this->Model_Cashier_Sm->getPaymentsExt($denom_id);
				$result4 = $this->Model_Cashier_Sm->getPaymentsHeadExt($denom_id);
				$result5 = $this->Model_Cashier_Sm->getPaymentsHeadPalawan($denom_id);
                $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
                $total_pal = $this->Model_Cashier_Sm->getTotalPalByDenomId($denom_id);
				if (!$result) {
					echo 'done';
    				exit;
						
				}

                $connection = $result3->ar_connection;
                $username = $result3->db_username;
                $password = $result3->db_password;

                $connect = odbc_connect($connection, $username, $password);

            
                foreach($result2 as $row)
                {
                   
                    if($row['status4']!='Uploaded')
                    {

                        if($row['check_type'] == 'Dated'){

                            $check = 'DC';
                        }elseif($row['check_type'] == 'Post Dated'){
                            $check = 'PDC';
                        }else{
                            $check = '';
                        }
                        // $payDate = date('Y-m-d H:i:s', strtotime($row['pay_date']));
                        // $dueDate = date('Y-m-d H:i:s', strtotime($row['due_date']));

						$remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
						$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                        $payDate = !empty($row['pay_date']) ? date('Y-m-d H:i:s', strtotime($row['pay_date'])) : null;


                        //Assuming $row['pay_amount'] is a valid numeric value
                        $payAmount = str_replace(',', '', number_format(floatval($row['net_amount']), 2, '.', ''));
                        $cashAmount = number_format(floatval($row['cash_amount']), 2, '.', '');
                        $taxAmount = number_format(floatval($row['tax_amount']), 2, '.', '');
                        $dealsAmount = number_format(floatval($row['deals']), 2, '.', '');
                        $incAmount = number_format(floatval($row['inc_amount']), 2, '.', '');
                        $discAmount = number_format(floatval($row['disc_amount']), 2, '.', '');
                        $siAmount = number_format(floatval($row['pay_amount']), 2, '.', '');
                        $chequeAmount = number_format(floatval($row['check_amount']), 2, '.', '');
						$act_name = str_replace("'", "''", $row['acc_name']);

                        $vatAmount = number_format(floatval($row['vat_amount']), 2, '.', '');
                        $vatableAmount = number_format(floatval($row['vatable']), 2, '.', '');
                        $nonvatableAmount = number_format(floatval($row['nonvatable']), 2, '.', '');


                        $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck WHERE si_docno = '".$row['si_docno']."' and manual_srr = '".$result->manualsrr."' and ref_no = '".$row['ref_no']."' and pay_type = '".$row['pay_type']."' ";
                        $check_result = odbc_exec($connect, $check_query);
                        $exists = odbc_fetch_array($check_result)['count'];
    
                        if ($exists == 0) {
                            $sql_query_line = "INSERT INTO payment_xtruck(
                                manual_srr,
                                pay_date,
                                remit_date,
                                sm_code,
                                si_docno,
                                si_date,
                                cus_code,
                                cash_amt,
                                check_amt,
                                pay_amt,
                                gross_amt,
                                pay_type,
                                check_type,
                                check_no,
                                acc_no,
                                acc_name,
                                due_date,
                                check_bank,
                                ref_no,
                                tax_amt,
                                disc_amt,
                                vat_amt,
                                vatable,
                                nonvatable,
                                stats,
                                applied_by,
                                gl_stats) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$payDate."',
                                    '".$remitDate."',
                                    '".$row['sm_code']."',
                                    '".$row['si_docno']."',
                                    
                                    '".$payDate."',
                                    '".$row['cus_code']."',
                                    ".$cashAmount.",
                                    ".$chequeAmount.",
                                    ".$payAmount.",
                                    ".$siAmount.",
                                    '".$row['pay_type']."',
                                    '".$check."',
                                    '".$row['check_no']."',
                                    '".$row['acc_no']."',
                                    '".$act_name."',
                                    '".$dueDate."',
                                    '".$row['check_bank']."',
                                    '".$row['ref_no']."',
                                    ".$taxAmount.",
                                    ".$discAmount.",
                                    ".$vatAmount.",
                                    ".$vatableAmount.",
                                    ".$nonvatableAmount.",
                                    'Pending',
                                    '','')";

                            $result2 = odbc_exec($connect, $sql_query_line);
                            
                            if ($result2) {
                                // If successful, update payment status
                                $this->Model_Cashier_Sm->updatePaymentStatusExt($row['pay_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query xt: " . odbc_errormsg($connect);
                            }
                        } elseif($exists == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "SI Doc No " . $row['si_docno'] . " already exists. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExt($row['pay_id']);

                            $update_query_payments = "
                                UPDATE payment_xtruck
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE si_docno = '".$row['si_docno']."' and pay_type = '".$row['pay_type']."'
                            ";

                            $update_payments = odbc_exec($connect, $update_query_payments);
                        } else {
                            echo "Warning: Multiple matching payments records found. Please review.";
                        }
                    }
                }
				//for cheque payments
				if($result->total_pdc != 0 || $result->total_dc != 0) {

					foreach($result4 as $row){

						if($row['check_type'] == 'Dated'){

                            $check = 'DC';
                        }elseif($row['check_type'] == 'Post Dated'){
                            $check = 'PDC';
                        }else{
                            $check = '';
                        }
						$remitDate = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
						$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                        $chequeAmount = number_format(floatval($row['check_amount']), 2, '.', '');

						$act_name = str_replace("'", "''", $row['acc_name']);

                        $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$row['sm_code']."' and check_no = '".$row['check_no']."'  and pay_type = '".$check."' and amt = '".$chequeAmount."' ";
                        //var_dump($check_query);
                        $check_result = odbc_exec($connect, $check_query);
                        //var_dump($check_result);
                        $exists_check = odbc_fetch_array($check_result)['count'];
                        //var_dump($exists_check);
                        //die();
                        if ($exists_check == 0) {
                            $sql_query_cheque = "INSERT INTO payment_xtruck_head(
                                manual_srr,
                                cus_code,
                                remit_date,
                                pay_type,
                                amt,
                                due_date,
                                or_no,
                                check_no,
                                act_name,
                                act_no,
                                bank,
                                stats,
                                gl_stats
                                ) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$row['sm_code']."',
                                    '".$remitDate."',
                                    '".$check."',
                                    ".$row['check_amount'].",
                                    '".$dueDate."',
                                    '".$row['denom_id']."',
                                    '".$row['check_no']."',
                                    '".$act_name."',  
                                    '".$row['acc_no']."',
                                    '".$row['check_bank']."'
                                    ,'Pending','F'
                                )";
        
                            $result_check = odbc_exec($connect, $sql_query_cheque);

                            if ($result_check) {
                                // If successful, update payment status
                                $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query: " . odbc_errormsg($connect);
                            }
                        }elseif($exists_check == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "Already exists cheque. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                            $update_query_cheque = "
                                UPDATE payment_xtruck_head
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE cus_code = '".$row['sm_code']."' 
                                and pay_type = '".$check."' and amt = '".$chequeAmount."'
                            ";

                            $update_cheque = odbc_exec($connect, $update_query_cheque);
                        }else{
                            echo "Warning: Multiple matching cheque records found. Please review.";
                        }
					}

				}

                //for salesman incentives
                if($result->sm_inc != 0) {

					$remitDate = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
                    //$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                    $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$result->id_no."' and pay_type = 'INCENTIVES' and amt = '".$result->sm_inc."' ";
                    $check_result = odbc_exec($connect, $check_query);
                    $exists_incentives = odbc_fetch_array($check_result)['count'];

                    if ($exists_incentives == 0) {
                        $sql_query_inc = "INSERT INTO payment_xtruck_head(
                            manual_srr,
                            cus_code,
                            remit_date,
                            pay_type,
                            amt,
                            stats,
                            gl_stats
                            
                            
                            ) 
                            VALUES(
                                '".$result->manualsrr."',
                                '".$result->id_no."',
                                '".$remitDate."',
                                'INCENTIVES',
                                '".$result->sm_inc."',
                                'Pending', 'F'
                                )";

                        $result_inc = odbc_exec($connect, $sql_query_inc);
                    }elseif($exists_incentives == 1) {
                        // Optionally log or handle the case where si_docno already exists
                        echo "Already exists incentives. Skipping insert.";
                        $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                        $update_query_cheque = "
                                UPDATE payment_xtruck_head
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE cus_code = '".$result->id_no."' 
                                and pay_type = 'INCENTIVES' 
                                and amt = '".$result->sm_inc."'
                            ";

                            $update_cheque = odbc_exec($connect, $update_query_cheque);
                    }else{
                        echo "Warning: Multiple matching incentives records found. Please review.";
                    }

				}

				// for PALAWAN payments
                if ($total_pal->total_pal != 0) {
                    foreach($result5 as $row){

                        $payAmount = str_replace(',', '', number_format(floatval($row['pay_amount']), 2, '.', ''));
                        $remitDate = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
                        $dueDate = !empty($row['date_remitted']) ? date('Y-m-d H:i:s', strtotime($row['date_remitted'])) : null;

                        $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$row['sm_code']."' and pay_type = 'PALAWAN' and amt = '".$payAmount."'  and remit_date = '".$remitDate."' and or_no = '".$row['ref_no']."' ";
                        $check_result = odbc_exec($connect, $check_query);
                        $exists_palawan = odbc_fetch_array($check_result)['count'];

                        if ($exists_palawan == 0) {

                            $sql_query_pal = "INSERT INTO payment_xtruck_head(
                                manual_srr,
                                cus_code,
                                remit_date,
                                pay_type,
                                amt,
                                due_date,
                                or_no,
                                check_no,
                                act_name,
                                act_no,
                                bank,
                                stats,
                                gl_stats
                                ) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$row['sm_code']."',
                                    '".$remitDate."',
                                    'PALAWAN',
                                    ".$payAmount.",
                                    '".$dueDate."',
                                    '".$row['ref_no']."',
                                    '',
                                    '',
                                    '',
                                    '',
                                    'Pending', 'F'
                                    )";

                            $result_check_pal = odbc_exec($connect, $sql_query_pal);

                            if ($result_check_pal) {
                                // If successful, update payment status '".$row['ref_no']."',
                                $this->Model_Cashier_Sm->updatePaymentStatusExtHeadPal($row['denom_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query: " . odbc_errormsg($connect);
                            }
                        }elseif($exists_palawan == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "Already exists palawan. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHeadPal($row['denom_id']);
                            $update_query_palawan = "
                                UPDATE payment_xtruck_head
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE cus_code = '".$row['sm_code']."'
                                AND pay_type = 'PALAWAN'
                                AND amt = '".$payAmount."'
                            ";

                            $update_palawan = odbc_exec($connect, $update_query_palawan);
                        }else{
                            echo "Warning: Multiple matching palawan records found. Please review.";
                        }
                    }
                }

                if($result->total_cash != 0){
                    // for CASH payments
                    $remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
                    // var_dump($remitDate);
                    // die();
                    $dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;

                    $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$result->id_no."' and pay_type = 'CASH' and amt = '".$result->total_cash."' ";
                    $check_result = odbc_exec($connect, $check_query);
                    $exists_cash = odbc_fetch_array($check_result)['count'];

                    if ($exists_cash == 0) {
                        $sql_query_cash = "INSERT INTO payment_xtruck_head(
                            manual_srr,
                            cus_code,
                            remit_date,
                            pay_type,
                            amt,
                            stats,
                            gl_stats
                            
                            
                            ) 
                            VALUES(
                                '".$result->manualsrr."',
                                '".$result->id_no."',
                                '".$remitDate."',
                                'CASH',
                                '".$result->total_cash."',
                                'Pending', 'F'
                                )";

                        $result_cash = odbc_exec($connect, $sql_query_cash);

                        if ($result_cash) {
                            // If successful, update payment status
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                        } else {
                            // Handle the case where the query fails, you might want to log an error or take other actions
                            echo "Error executing query: " . odbc_errormsg($connect);
                        }
                    }elseif($exists_cash == 1) {
                        // Optionally log or handle the case where si_docno already exists
                        echo "Already exists cash. Skipping insert.";
                        $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                        $update_query_cash = "
                            UPDATE payment_xtruck_head
                            SET manual_srr = '".$result->manualsrr."'
                            WHERE cus_code = '".$result->id_no."'
                            AND pay_type = 'CASH'
                            AND amt = '".$result->total_cash."'
                        ";

                        $update_cash = odbc_exec($connect, $update_query_cash);


                    } else{
                        echo "Warning: Multiple matching records found. Please review.";
                    }
                }
				
                // Close the database connection
                odbc_close($connect);

                echo 'yes';
            } catch (Exception $e) {
                // Log any unexpected exceptions
                error_log("Exception: " . $e->getMessage());
                var_dump(@$connection);
            }
        }

        public function upload_payments_xtruck_udc()
        {
            try {
                $denom_id = $this->input->post('ids');
                $result = $this->Model_Cashier_Sm->getSmIds($denom_id);
                $result2 = $this->Model_Cashier_Sm->getPaymentsExt($denom_id);
				$result4 = $this->Model_Cashier_Sm->getPaymentsHeadExt($denom_id);
				$result5 = $this->Model_Cashier_Sm->getPaymentsHeadPalawan($denom_id);
                $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
                // $connection = '172.16.22.4';
                // $username = 'udc_conn';
                // $password = 'udc_conn';

                // @$connect = odbc_connect($connection, $username, $password);

                $ip_server = '172.16.22.4';
                $connection = 'UDC_AR';
                $username = 'udc_conn';
                $password = 'udc_conn';

               // @$connect = odbc_connect($connection, $username, $password);
                @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect); 

                if (!$connect) {
                    die("Connection failed: " . odbc_errormsg());
                }
                //var_dump($connect);

                if (!$result) {
					echo 'done';
    				exit;
						
				}

                foreach($result2 as $row)
                {
                   
                    if($row['status4']!='Uploaded')
                    {

                        if($row['check_type'] == 'Dated'){

                            $check = 'DC';
                        }elseif($row['check_type'] == 'Post Dated'){
                            $check = 'PDC';
                        }else{
                            $check = '';
                        }
                        // $payDate = date('Y-m-d H:i:s', strtotime($row['pay_date']));
                        // $dueDate = date('Y-m-d H:i:s', strtotime($row['due_date']));

						$remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
						$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                        $payDate = !empty($row['pay_date']) ? date('Y-m-d H:i:s', strtotime($row['pay_date'])) : null;


                        //Assuming $row['pay_amount'] is a valid numeric value
                        $payAmount = str_replace(',', '', number_format(floatval($row['net_amount']), 2, '.', ''));
                        $cashAmount = number_format(floatval($row['cash_amount']), 2, '.', '');
                        $taxAmount = number_format(floatval($row['tax_amount']), 2, '.', '');
                        $dealsAmount = number_format(floatval($row['deals']), 2, '.', '');
                        $incAmount = number_format(floatval($row['inc_amount']), 2, '.', '');
                        $discAmount = number_format(floatval($row['disc_amount']), 2, '.', '');
                        $siAmount = number_format(floatval($row['pay_amount']), 2, '.', '');
                        $chequeAmount = number_format(floatval($row['check_amount']), 2, '.', '');
						$act_name = str_replace("'", "''", $row['acc_name']);

                        $vatAmount = number_format(floatval($row['vat_amount']), 2, '.', '');
                        $vatableAmount = number_format(floatval($row['vatable']), 2, '.', '');
                        $nonvatableAmount = number_format(floatval($row['nonvatable']), 2, '.', '');


                        $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck WHERE si_docno = '".$row['si_docno']."' and manual_srr = '".$result->manualsrr."' and pay_type = '".$row['pay_type']."' ";
                        $check_result = odbc_exec($connect, $check_query);
                        $exists = odbc_fetch_array($check_result)['count'];
    
                        if ($exists == 0) {
                            $sql_query_line = "INSERT INTO payment_xtruck(
                                manual_srr,
                                pay_date,
                                remit_date,
                                sm_code,
                                si_docno,
                                si_date,
                                cus_code,
                                cash_amt,
                                check_amt,
                                pay_amt,
                                gross_amt,
                                pay_type,
                                check_type,
                                check_no,
                                acc_no,
                                acc_name,
                                due_date,
                                check_bank,
                                ref_no,
                                tax_amt,
                                disc_amt,
                                vat_amt,
                                vatable,
                                nonvatable,
                                stats,
                                applied_by,
                                gl_stats) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$payDate."',
                                    '".$remitDate."',
                                    '".$row['sm_code']."',
                                    '".$row['si_docno']."',
                                    
                                    '".$payDate."',
                                    '".$row['cus_code']."',
                                    ".$cashAmount.",
                                    ".$chequeAmount.",
                                    ".$payAmount.",
                                    ".$siAmount.",
                                    '".$row['pay_type']."',
                                    '".$check."',
                                    '".$row['check_no']."',
                                    '".$row['acc_no']."',
                                    '".$act_name."',
                                    '".$dueDate."',
                                    '".$row['check_bank']."',
                                    '".$row['ref_no']."',
                                    ".$taxAmount.",
                                    ".$discAmount.",
                                    ".$vatAmount.",
                                    ".$vatableAmount.",
                                    ".$nonvatableAmount.",
                                    'Pending',
                                    '','')";

                            $result2 = odbc_exec($connect, $sql_query_line);
                            
                            if ($result2) {
                                // If successful, update payment status
                                $this->Model_Cashier_Sm->updatePaymentStatusExt($row['pay_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query: " . odbc_errormsg($connect);
                            }
                        } elseif($exists == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "SI Doc No " . $row['si_docno'] . " already exists. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExt($row['pay_id']);

                            $update_query_payments = "
                                UPDATE payment_xtruck
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE si_docno = '".$row['si_docno']."' and pay_type = '".$row['pay_type']."'
                            ";

                            $update_payments = odbc_exec($connect, $update_query_payments);
                        } else {
                            echo "Warning: Multiple matching payments records found. Please review.";
                        }
                    }
                }
				//for cheque payments
				if($result->total_pdc != 0 || $result->total_dc != 0) {

					foreach($result4 as $row){

						if($row['check_type'] == 'Dated'){

                            $check = 'DC';
                        }elseif($row['check_type'] == 'Post Dated'){
                            $check = 'PDC';
                        }else{
                            $check = '';
                        }
						$remitDate = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
						$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                        $chequeAmount = number_format(floatval($row['check_amount']), 2, '.', '');

						$act_name = str_replace("'", "''", $row['acc_name']);

                        $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$row['sm_code']."' and check_no = '".$row['check_no']."'  and pay_type = '".$check."' and amt = '".$chequeAmount."' ";
                        //var_dump($check_query);
                        $check_result = odbc_exec($connect, $check_query);
                        //var_dump($check_result);
                        $exists_check = odbc_fetch_array($check_result)['count'];
                        //var_dump($exists_check);
                        //die();
                        if ($exists_check == 0) {
                            $sql_query_cheque = "INSERT INTO payment_xtruck_head(
                                manual_srr,
                                cus_code,
                                remit_date,
                                pay_type,
                                amt,
                                due_date,
                                or_no,
                                check_no,
                                act_name,
                                act_no,
                                bank,
                                stats,
                                gl_stats
                                ) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$row['sm_code']."',
                                    '".$remitDate."',
                                    '".$check."',
                                    ".$row['check_amount'].",
                                    '".$dueDate."',
                                    '".$row['denom_id']."',
                                    '".$row['check_no']."',
                                    '".$act_name."',  
                                    '".$row['acc_no']."',
                                    '".$row['check_bank']."'
                                    ,'Pending','F'
                                )";
        
                            $result_check = odbc_exec($connect, $sql_query_cheque);

                            if ($result_check) {
                                // If successful, update payment status
                                $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query: " . odbc_errormsg($connect);
                            }
                        }elseif($exists_check == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "Already exists cheque. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                            $update_query_cheque = "
                                UPDATE payment_xtruck_head
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE cus_code = '".$row['sm_code']."' 
                                and pay_type = '".$check."' and amt = '".$chequeAmount."'
                            ";

                            $update_cheque = odbc_exec($connect, $update_query_cheque);
                        }else{
                            echo "Warning: Multiple matching cheque records found. Please review.";
                        }
					}

				}

                //for salesman incentives
                if($result->sm_inc != 0) {

					$remitDate = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
                    //$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;
                    $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$result->id_no."' and pay_type = 'INCENTIVES' and amt = '".$result->sm_inc."' ";
                    $check_result = odbc_exec($connect, $check_query);
                    $exists_incentives = odbc_fetch_array($check_result)['count'];

                    if ($exists_incentives == 0) {
                        $sql_query_inc = "INSERT INTO payment_xtruck_head(
                            manual_srr,
                            cus_code,
                            remit_date,
                            pay_type,
                            amt,
                            stats,
                            gl_stats
                            
                            
                            ) 
                            VALUES(
                                '".$result->manualsrr."',
                                '".$result->id_no."',
                                '".$remitDate."',
                                'INCENTIVES',
                                '".$result->sm_inc."',
                                'Pending', 'F'
                                )";

                        $result_inc = odbc_exec($connect, $sql_query_inc);
                    }elseif($exists_incentives == 1) {
                        // Optionally log or handle the case where si_docno already exists
                        echo "Already exists incentives. Skipping insert.";
                        $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                        $update_query_cheque = "
                                UPDATE payment_xtruck_head
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE cus_code = '".$result->id_no."' 
                                and pay_type = 'INCENTIVES' 
                                and amt = '".$result->sm_inc."'
                            ";

                            $update_cheque = odbc_exec($connect, $update_query_cheque);
                    }else{
                        echo "Warning: Multiple matching incentives records found. Please review.";
                    }

				}

				// for PALAWAN payments
                if ($result->total_palawan != 0) {
                    foreach($result5 as $row){

                        $payAmount = str_replace(',', '', number_format(floatval($row['pay_amount']), 2, '.', ''));
                        $remitDate = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
                        $dueDate = !empty($row['date_remitted']) ? date('Y-m-d H:i:s', strtotime($row['date_remitted'])) : null;

                        $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$row['sm_code']."' and pay_type = 'PALAWAN' and amt = '".$payAmount."'  and remit_date = '".$remitDate."' ";
                        $check_result = odbc_exec($connect, $check_query);
                        $exists_palawan = odbc_fetch_array($check_result)['count'];

                        if ($exists_palawan == 0) {

                            $sql_query_pal = "INSERT INTO payment_xtruck_head(
                                manual_srr,
                                cus_code,
                                remit_date,
                                pay_type,
                                amt,
                                due_date,
                                or_no,
                                check_no,
                                act_name,
                                act_no,
                                bank,
                                stats,
                                gl_stats
                                ) 
                                VALUES(
                                    '".$result->manualsrr."',
                                    '".$row['sm_code']."',
                                    '".$remitDate."',
                                    'PALAWAN',
                                    ".$payAmount.",
                                    '".$dueDate."',
                                    '".$row['ref_no']."',
                                    '',
                                    '',
                                    '',
                                    '',
                                    'Pending', 'F'
                                    )";

                            $result_check_pal = odbc_exec($connect, $sql_query_pal);

                            if ($result_check_pal) {
                                // If successful, update payment status '".$row['ref_no']."',
                                $this->Model_Cashier_Sm->updatePaymentStatusExtHeadPal($row['denom_id']);
                            } else {
                                // Handle the case where the query fails, you might want to log an error or take other actions
                                echo "Error executing query: " . odbc_errormsg($connect);
                            }
                        }elseif($exists_palawan == 1) {
                            // Optionally log or handle the case where si_docno already exists
                            echo "Already exists palawan. Skipping insert.";
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHeadPal($row['denom_id']);
                            $update_query_palawan = "
                                UPDATE payment_xtruck_head
                                SET manual_srr = '".$result->manualsrr."'
                                WHERE cus_code = '".$row['sm_code']."'
                                AND pay_type = 'PALAWAN'
                                AND amt = '".$payAmount."'
                            ";

                            $update_palawan = odbc_exec($connect, $update_query_palawan);
                        }else{
                            echo "Warning: Multiple matching palawan records found. Please review.";
                        }
                    }
                }

                if($result->total_cash != 0){
                    // for CASH payments
                    $remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
                    // var_dump($remitDate);
                    // die();
                    $dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;

                    $check_query = "SELECT COUNT(*) AS count FROM payment_xtruck_head WHERE cus_code = '".$result->id_no."' and pay_type = 'CASH' and amt = '".$result->total_cash."' ";
                    $check_result = odbc_exec($connect, $check_query);
                    $exists_cash = odbc_fetch_array($check_result)['count'];

                    if ($exists_cash == 0) {
                        $sql_query_cash = "INSERT INTO payment_xtruck_head(
                            manual_srr,
                            cus_code,
                            remit_date,
                            pay_type,
                            amt,
                            stats,
                            gl_stats
                            
                            
                            ) 
                            VALUES(
                                '".$result->manualsrr."',
                                '".$result->id_no."',
                                '".$remitDate."',
                                'CASH',
                                '".$result->total_cash."',
                                'Pending', 'F'
                                )";

                        $result_cash = odbc_exec($connect, $sql_query_cash);

                        if ($result_cash) {
                            // If successful, update payment status
                            $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                        } else {
                            // Handle the case where the query fails, you might want to log an error or take other actions
                            echo "Error executing query: " . odbc_errormsg($connect);
                        }
                    }elseif($exists_cash == 1) {
                        // Optionally log or handle the case where si_docno already exists
                        echo "Already exists cash. Skipping insert.";
                        $this->Model_Cashier_Sm->updatePaymentStatusExtHead($row['denom_id']);
                        $update_query_cash = "
                            UPDATE payment_xtruck_head
                            SET manual_srr = '".$result->manualsrr."'
                            WHERE cus_code = '".$result->id_no."'
                            AND pay_type = 'CASH'
                            AND amt = '".$result->total_cash."'
                        ";

                        $update_cash = odbc_exec($connect, $update_query_cash);


                    } else{
                        echo "Warning: Multiple matching records found. Please review.";
                    }
                }
				
                // Close the database connection
                odbc_close($connect);

                echo 'yes';
            } catch (Exception $e) {
                // Log any unexpected exceptions
                error_log("Exception: " . $e->getMessage());
            }
        }

        public function upload_payments_xtruck_big()
        {
            try {
                $denom_id = $this->input->post('ids');
                $result = $this->Model_Cashier_Sm->getSmIds($denom_id);
                // $result2 = $this->Model_Cashier_Sm->getPaymentsExt($denom_id);
				// $result4 = $this->Model_Cashier_Sm->getPaymentsHeadExt($denom_id);
				// $result5 = $this->Model_Cashier_Sm->getPaymentsHeadPalawan($denom_id);
                $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));

				if (!$result) {
					echo 'done';
    				exit;
						
				}

                $connection = $result3->ar_connection;
                $username = $result3->db_username;
                $password = $result3->db_password;

                $connect = odbc_connect($connection, $username, $password);

                if($result->total_cash != 0){
                    // for CASH payments
                    $remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
                    // var_dump($remitDate);
                    // die();
                    //$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;

                    $sql_query_cash = "INSERT INTO payment_xtruck_head(
                        manual_srr,
                        cus_code,
                        remit_date,
                        pay_type,
                        amt,
                        stats
                        
                        
                        ) 
                        VALUES(
                            '".$result->manualsrr."',
                            '".$result->id_no."',
                            '".$remitDate."',
                            'CASH',
                            '".$result->total_cash."',
                            'Pending'
                            )";

                    $result_cash = odbc_exec($connect, $sql_query_cash);

                    if ($result_cash) {
                        // If successful, update payment status
                        $this->Model_Cashier_Sm->updatePaymentStatusExtHead($denom_id);
                    } else {
                        // Handle the case where the query fails, you might want to log an error or take other actions
                        echo "Error executing query: " . odbc_errormsg($connect);
                    }
                }

                if($result->total_palawan != 0){
                    // for PALAWAN payments
                    $remitDate = !empty($result->date_added) ? date('Y-m-d H:i:s', strtotime($result->date_added)) : null;
                    // var_dump($remitDate);
                    // die();
                    //$dueDate = !empty($row['due_date']) ? date('Y-m-d H:i:s', strtotime($row['due_date'])) : null;

                    $sql_query_palawan = "INSERT INTO payment_xtruck_head(
                        manual_srr,
                        cus_code,
                        remit_date,
                        pay_type,
                        amt,
                        stats
                        
                        
                        ) 
                        VALUES(
                            '".$result->manualsrr."',
                            '".$result->id_no."',
                            '".$remitDate."',
                            'PALAWAN',
                            '".$result->total_palawan."',
                            'Pending'
                            )";

                    $result_pal = odbc_exec($connect, $sql_query_palawan);

                    if ($result_pal) {
                        // If successful, update payment status
                        $this->Model_Cashier_Sm->updatePaymentStatusExtHead($denom_id);
                    } else {
                        // Handle the case where the query fails, you might want to log an error or take other actions
                        echo "Error executing query: " . odbc_errormsg($connect);
                    }
                }
				
                // Close the database connection
                odbc_close($connect);

                echo 'yes';
            } catch (Exception $e) {
                // Log any unexpected exceptions
                error_log("Exception: " . $e->getMessage());
                var_dump(@$connection);
            }
        }

        public function checkclearing($date,$type)
        {
            $data['result'] = $this->Model_Cashier_Sm->getDueChecks($date,$type);
            $data['result2'] = $date;
            $this->load->view('header');
            $this->load->view('check_clearing_ledger', $data);
            $this->load->view('footer');
        }
        
        public function approve_sm_denom()
        {
            $row = $this->Model_Cashier_Sm->check_remittance($_POST['ids']);
            if($row->total_remittance==0 && $row->total_palawan != 0)
            {
                echo 'none';
            }
            else
            {
                $uid = $this->session->userdata('user_id');
                $this->Model_Cashier_Sm->approveSmDenom($_POST['ids']);
                echo 'yes';
                //var_dump($uid);
            }
        }

        public function change_check()
        {
            
                
            $this->Model_Cashier_Sm->changeCheck($_POST['ids']);
            echo 'yes';
            //var_dump($uid);
            
        }

        public function approve_sm_denoms()
        {
            $selectedIds = $_POST['ids'];
            $remittances = $this->Model_Cashier_Sm->check_remittances($selectedIds);

            $approvedCount = 0;

            foreach ($selectedIds as $denom_id) {
                // If the remittance is greater than 0, approve the denomination
                if ($remittances[$denom_id] > 0) {
                    $this->Model_Cashier_Sm->approveSmDenom($denom_id);
                    $approvedCount++;
                }
            }

            if ($approvedCount > 0) {
                // Provide a response indicating the number of denominations that were approved
                $response = array(
                    // 'message' => "$approvedCount/" . count($selectedIds) . " Salesman denomination successfully approved!",
                    'message' => "Salesman denomination successfully approved!",
                    'success' => true
                );
            } else {
                $response = array(
                    'message' => 'zero',
                    'success' => false
                );
            }

            // Output the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function delete_payments_op()
        {
            $selectedIds = $_POST['ids'];
            
            $deletedCount = 0;

            foreach ($selectedIds as $pay_id) {
                
                $this->Model_Cashier_Sm->deleteCheckOp($pay_id);
                $deletedCount++;
                
            }

            if ($deletedCount > 0) {
                // Provide a response indicating the number of denominations that were approved
                $response = array(
                    // 'message' => "$approvedCount/" . count($selectedIds) . " Salesman denomination successfully approved!",
                    'message' => "Salesman payment/s successfully deleted!",
                    'success' => true
                );
            } else {
                $response = array(
                    'message' => 'zero',
                    'success' => false
                );
            }

            // Output the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function disapprove_sm_denom()
        {
            $this->Model_Cashier_Sm->disapproveSmDenom($_POST['ids']);
        }

        public function check_entry_sm($id,$date,$userid)
        {
            $data['results'] = $this->Model_Cashier_Sm->getSmChecksLDI($userid,$date,$id);
            // getSmChecksLDI
            $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDenomId($id);
            $data['result1'] = $this->Model_Cashier_Sm->getBankData2();
            $data['result2'] = $date;
            $data['result3'] = $id;
            $this->load->view('header');
            $this->load->view('cashier_checkentry', $data);
            $this->load->view('footer');
        }

        public function get_customer1()
        {
            $fetch_data = $this->Model_Cashier_Sm->get_customer();
            if(count($fetch_data) > 0){
                foreach($fetch_data as $p):
                    $code = $p['code'];
                    $name = $p['name'];
                    if(strpos($name,"'")!="")
                    {
                        $name = str_replace("'",'',$name);
                    }
                    // $id	 = base64_encode($this->encrypt->encode($p['hid']));
                    $btn = '<a><button class="btn btn-outline-info btn-sm" type="button" id="selectcustomer"
                                aria-haspopup="true" aria-expanded="false" onclick=\'selected_customer("'.$code.'","'.$name.'")\'>
                                Select
                              </button></a>';
                    $arr['data'][] = array(
                    'code'			=> $p['code'],
                    'name' 			=> $p['name'],
                    'address1'		=> $p['address1'],
                    'action'		=> $btn
                );
                endforeach;
            }
            else{
                $arr['data'][] = array(
                    'code'			=> 'No record',
                    'name' 			=> '',
                    'address1'		=> '',
                    'action'		=> ''
                );
            }
            echo json_encode($arr);
        }

        public function get_customer2()
        {
            $fetch_data = $this->Model_Cashier_Sm->get_customer();
            if(count($fetch_data) > 0){
                foreach($fetch_data as $p):
                    $code = $p['code'];
                    $name = $p['name'];
                    if(strpos($name,"'")!="")
                    {
                        $name = str_replace("'",'',$name);
                    }
                    // $id	 = base64_encode($this->encrypt->encode($p['hid']));
                    $btn = '<a><button class="btn btn-outline-info btn-sm" type="button" id="selectcustomer"
                                aria-haspopup="true" aria-expanded="false" onclick=\'selected_customer2("'.$code.'","'.$name.'")\'>
                                Select
                              </button></a>';
                    $arr['data'][] = array(
                    'code'			=> $p['code'],
                    'name' 			=> $p['name'],
                    'address1'		=> $p['address1'],
                    'action'		=> $btn
                );
                endforeach;
            }
            else{
                $arr['data'][] = array(
                    'code'			=> 'No record',
                    'name' 			=> '',
                    'address1'		=> '',
                    'action'		=> ''
                );
            }
            echo json_encode($arr);
        }

        public function get_customer3()
        {
            $fetch_data = $this->Model_Cashier_Sm->get_customer2();
            if(count($fetch_data) > 0){
                foreach($fetch_data as $p):
                    $code = $p['code'];
                    $name = $p['name'];
                    if(strpos($name,"'")!="")
                    {
                        $name = str_replace("'",'',$name);
                    }
                    // $id	 = base64_encode($this->encrypt->encode($p['hid']));
                    $btn = '<a><button class="btn btn-outline-info btn-sm" type="button" id="selectcustomer"
                                aria-haspopup="true" aria-expanded="false" onclick=\'selected_customer3("'.$code.'","'.$name.'")\'>
                                Select
                              </button></a>';
                    $arr['data'][] = array(
                    'code'			=> $p['code'],
                    'name' 			=> $p['name'],
                    'address1'		=> $p['address1'],
                    'action'		=> $btn
                );
                endforeach;
            }
            else{
                $arr['data'][] = array(
                    'code'			=> 'No record',
                    'name' 			=> '',
                    'address1'		=> '',
                    'action'		=> ''
                );
            }
            echo json_encode($arr);
        }

        public function get_customer4()
        {
            // $fetch_data = $this->Model_Cashier_Sm->get_customer3();
            $connection = 'ODBC_WDG_AR';
            $username = 'sa';
            $password = 'Corporate_it';

            @$connect = odbc_connect($connection, $username, $password);

            $sql_cus = "SELECT TOP 15135 cus_code,REPLACE(REPLACE(REPLACE(REPLACE(cus_name,'¥','N'),'¤','n'),'&','AND'),'  ',' '),REPLACE(REPLACE(cus_addr1,'¤',''),'¥','') FROM customer ORDER BY cus_count ASC";
            // $sql_cus = "SELECT TOP 5319 cus_code,cus_prccd,cus_addr1 FROM customer ORDER BY cus_code ASC";
            $result_sql = odbc_exec($connect, $sql_cus);
            if(odbc_num_rows($result_sql) > 0){
                while(odbc_fetch_row($result_sql)){
                    $code = odbc_result($result_sql, 1);
                    $name = odbc_result($result_sql, 2);
                    $addr = odbc_result($result_sql, 3);
                    if(strpos($name,"'")!="")
                    {
                        $name = str_replace("'",'',$name);
                    }
                    if(strpos($addr,"'")!="")
                    {
                        $addr = str_replace("'",'',$addr);
                        $addr = str_replace(",",'',$addr);
                    }
                    // $id	 = base64_encode($this->encrypt->encode($p['hid']));
                    $btn = '<a><button class="btn btn-outline-info btn-sm" type="button" id="selectcustomer"
                                aria-haspopup="true" aria-expanded="false" onclick=\'selected_customer4("'.$code.'","'.$name.'","'.$addr.'")\'>
                                Select
                              </button></a>';
                    $arr['data'][] = array(
                    'code'			=> odbc_result($result_sql, 1),
                    'name' 			=> odbc_result($result_sql, 2),
                    'address1'		=> odbc_result($result_sql, 3),
                    'action'		=> $btn
                );
                }
            }
            else{
                $arr['data'][] = array(
                    'code'			=> 'No record',
                    'name' 			=> '',
                    'address1'		=> '',
                    'action'		=> ''
                );
            }
            echo json_encode($arr);
        }

        public function get_customer5()
        {
            $fetch_data = $this->Model_Cashier_Sm->get_customer();
            if(count($fetch_data) > 0){
                foreach($fetch_data as $p):
                    $code = $p['code'];
                    $name = $p['name'];
                    if(strpos($name,"'")!="")
                    {
                        $name = str_replace("'",'',$name);
                    }
                    // $id	 = base64_encode($this->encrypt->encode($p['hid']));
                    $btn = '<a><button class="btn btn-outline-info btn-sm" type="button" id="selectcustomer"
                                aria-haspopup="true" aria-expanded="false" onclick=\'selected_customer_to_ccd("'.$code.'","'.$name.'")\'>
                                Select
                              </button></a>';
                    $arr['data'][] = array(
                    'code'			=> $p['code'],
                    'name' 			=> $p['name'],
                    'address1'		=> $p['address1'],
                    'action'		=> $btn
                );
                endforeach;
            }
            else{
                $arr['data'][] = array(
                    'code'			=> 'No record',
                    'name' 			=> '',
                    'address1'		=> '',
                    'action'		=> ''
                );
            }
            echo json_encode($arr);
        }

        public function save_sm_payment()
        {
            $chk_amt = abs($this->Model_Cashier_Sm->checkAmount()) + abs(str_replace(",","",$this->input->post('amount')));
            // echo $this->input->post('amount');
            // echo '<br/>';
            // echo $this->Model_Cashier_Sm->checkAmount();
            // echo '<br/>';
            // echo $this->input->post('pdcamt');
            // echo '<br/>';
            // echo 'okay';
            // echo $chk_amt;
            if($this->Model_Cashier_Sm->selectCheck() == true)
            {
                echo 'exist';
            }
            elseif($this->input->post('check') == 'DC' && round(abs($chk_amt),2) > abs($this->input->post('dcamt')))
            {
                echo 'DC';
            }
            elseif($this->input->post('check') == 'PDC' && round(abs($chk_amt),2) > abs($this->input->post('pdcamt')))
            {
                echo 'PDC';
            }
            else
            {
                $this->Model_Cashier_Sm->save_sm_payment();
                echo 'ok';
            }
        }

        public function edit_sm_payment()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheck() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_payment();
                echo 'ok';
            }
        }

        public function edit_sm_payment_ldi()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckLdi() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_payment_ldi();
                echo 'ok';
            }
        }

        public function edit_sm_payment_ext()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckExt() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_payment_ext();
                echo 'ok';
            }
        }

        public function edit_sm_pal_ext()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckExt() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_pal_ext();
                echo 'ok';
            }
        }

        public function edit_sm_denom_op()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckExt() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_denom_op();
                echo 'ok';
            }
        }

        public function cash_to_check_payment_ldi()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckLdi() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->cash_to_check_payment_ldi();
                echo 'ok';
            }
        }

        public function cash_to_check_payment_xt() //edit today
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckExt() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->cash_to_check_payment_xt();
                echo 'ok';
            }
        }

        public function payment_to_return_op()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectReturn() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->payment_to_return_op();
                echo 'ok';
            }
        }

        public function edit_sm_payment_op()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckLdi() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_payment_op();
                echo 'ok';

            }
        }

        public function edit_sm_payment_tax_op()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckLdi() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_payment_tax_op();
                echo 'ok';

            }
        }

        public function edit_sm_payment_tax_op_minus()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckLdi() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_sm_payment_tax_op_minus();
                echo 'ok';

            }
        }

        public function edit_ret_payment_ext()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckExt() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_ret_payment_ext();
                echo 'ok';

            }
        }

        public function edit_ret_payment_op()
        {
            // echo '<script>alert('.$this->input->post('checkno').');</script>';
            if($this->Model_Cashier_Sm->selectCheckLdi() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Cashier_Sm->edit_ret_payment_op();
                echo 'ok';

            }
        }

        public function checkreturned($datefrom,$dateto)
        {   
            
            $data['results']    = $this->Model_Cashier_Sm->getReturnedChecksExtruck($datefrom, $dateto);
            $data['row']        = 'XTRUCK';
            
            $data['result2'] = $datefrom;
            $data['result3'] = $dateto;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_returned_checks',$data);
            $this->load->view('footer');
        }

        public function checkreturnedop($datefrom,$dateto)
        {   
            
            $data['results']    = $this->Model_Cashier_Sm->getReturnedChecksOplan($datefrom, $dateto);
            $data['row']        = 'OPLAN';
            
            $data['result2'] = $datefrom;
            $data['result3'] = $dateto;
            
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header',$data);
            $this->load->view('cashier_returned_checks',$data);
            $this->load->view('footer');
        }

        public function view_sm_checks($userid,$paydate,$id)
        {
            $data['userid']     = $userid;
            $data['paydate']    = $paydate;
            $data['results']    = $this->Model_Cashier_Sm->getSmChecks($userid,$paydate,$id);
            $data['row']        = $this->Model_Cashier_Sm->getUserName($userid);
            $data['result3']    = $id;
            $this->load->view('header');
            $this->load->view('cashier_smdenom_checks', $data);
            $this->load->view('footer');
        }

        public function view_sm_checks_extruck($userid,$paydate,$id)
        {
            $data['userid']     = $userid;
            $data['paydate']    = $paydate;
            $data['results']    = $this->Model_Cashier_Sm->getSmChecksExtruck($userid,$paydate,$id);
            $data['row']        = $this->Model_Cashier_Sm->getUserName($userid);
            $data['result3']    = $id;
            $this->load->view('header');
            $this->load->view('cashier_smdenom_checks', $data);
            $this->load->view('footer');
        }

        public function view_sm_pal_extruck($userid,$paydate,$id)
        {
            $data['userid']     = $userid;
            $data['paydate']    = $paydate;
            $data['results']    = $this->Model_Cashier_Sm->getSmPalExtruck($userid,$paydate,$id);
            $data['row']        = $this->Model_Cashier_Sm->getUserName($userid);
            $data['result3']    = $id;
            $this->load->view('header');
            $this->load->view('cashier_smdenom_pal', $data);
            $this->load->view('footer');
        }

        public function transfer_customer()
        {
            $this->Model_Cashier_Sm->transfercustomer($this->input->post('code'));

            echo 'okay';
        }

        public function transfer_customer2()
        {
            $this->Model_Cashier_Sm->transfercustomer2($this->input->post('code'),$this->input->post('name'),$this->input->post('addr'));

            echo 'okay';
        }

        public function transfer_customer_to_ccd()
        {
            $code = $this->input->post('code');

            if (empty($code)) {
                echo json_encode(['status' => 'error', 'message' => 'Customer code is required.']);
                return;
            }

            $result = $this->Model_Cashier_Sm->transferCustomerToCCD($code); // Ensure model method name matches

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Customer transferred successfully.']);
            } else {
                echo json_encode(['status' => 'info', 'message' => 'Customer already exists on CCD.']);
            }
        }


        public function get_accname()
        {
            $row = $this->Model_Cashier_Sm->get_accname($this->input->post('acc_code'));

            if($this->Model_Cashier_Sm->get_accname($this->input->post('acc_code'))==false)
            {
                echo 'none';
            }
            else
            {
                echo $row->acc_name;
            }
        }

        

        public function cashier_remittance()
        {
            $result = $this->Model_Cashier_Sm->getRemittanceCollection($_POST['ids']);
            echo '
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Total Remittance: </label>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="hidden" min="0.1" step="any" class="form-control" style="background-color: white" name="totalcollection" id="totalcollection" value="'.$result->total_collection.'">
                        <label style="font-weight: bold">₱ '.number_format($result->total_collection,2).'</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <input type="checkbox" id="chkcollect" name="chkcollect" onclick=remittance_check(this.checked)> Same amount of Total Remittance
                    </div>
                </div>
                <div class="form-row">
                    <input type="hidden" name="denomid" id="denomid" value="'.$_POST['ids'].'">
                    <div class="form-group col-md-4">
                        <label>Total Collection: </label>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="number" min="0.1" step="any" class="form-control" style="background-color: white" name="totalremittance" id="totalremittance" value="'.$result->total_remittance.'">
                    </div>
                </div>
                <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Remittance</button>';
        }

        public function view_sm_checks_ldi()
        {
            
            $ids = $this->input->post('ids');
            list($user_id, $date_added, $denom_id) = explode(',', $ids);
            $results = $this->Model_Cashier_Sm->getSmChecksExtruck($user_id, $date_added, $denom_id);
            $user = $this->Model_Cashier_Sm->getUserName($user_id);

            echo '<div class="table-responsive">
            <table class="table sm_checks compact" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Check No.</th>';
                        
                        if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") { 
                            echo'<th>Check Status</th>
                            <th>Satellite</th>';
                        }
                        echo'<th>Due Date</th>
                        <th>Bank</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach($results as $row2) { 
                    echo'<tr>
                        <td>'.$row2['cus_code'].'</td>
                        <td>'.$row2['name'].'</td>
                        <td align="center">'.$row2['check_type'].'</td>
                        <td align="center">'.$row2['check_no'].'</td>';
                        
                        if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") { 
                           echo '<td align="center">';
                            
                                $badgeClass = ($row2['status5'] == 'Returned') ? 'badge-danger' : 'badge-success';
                                echo '<span class="badge ' . $badgeClass . '">' . $row2['status5'] . '</span>
                           
                            </td>

                            <td align="center">';
                                if ($row2['is_satellite'] == 1) { 
                                    echo '<span class="badge badge-info">Satellite</span>';
                                } 
                            echo'</td>';
                        } 
                        echo '<td align="center">'.$row2['due_date'].'</td>
                        <td align="center">'.$row2['check_bank'].'</td>';
                      
                    if($user->bu !="XTRUCK" && $user->bu !="XTRUCK-NETMAN" && $user->bu !="XTRUCK-MPDI" && $user->bu !="XTRUCK-NETMAN-BPI") { 
                         echo '<td align="right">'.number_format($row2['pay_amount'],2).'</td>';
                    } else { 
                        echo '<td align="right">'.number_format($row2['check_amount'],2).'</td>';
                    } 
                   
                    if($row2['pay_date']==date('Y-m-d')) { 
                        echo '<td align="center">';
                        if($row2['status']=="") { 
                            if($user->bu =="OPLAN") {
                                echo '<a title="Edit Check" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" 
                                data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_check('.$row2['pay_id'].', \'' . $denom_id . '\')"><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';

                                echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierPaymentModal" onclick=viewcashierpayment_content_ldi('.$row2['pay_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            }
                            if(($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI" ) && $row2['status5'] != 'Returned') {
                           
                                echo '<a title="Edit Check2" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_check_ext('.$row2['pay_id'].', \'' . $denom_id . '\')"><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';

                                

                                echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierPaymentModal" onclick=viewcashierpayment_content_ldi_ext('.$row2['pay_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            }
                        }else{
                            if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") {
                               

                                echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierPaymentModal" onclick=viewcashierpayment_content_ldi_ext('.$row2['pay_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            }
                        } 
                        
                        
                    echo '</td>';
                    }else { 
                    echo '<td align="center">';
                        if($row2['status']=="") { 
                            if($user->bu =="OPLAN") {
                                echo '<a title="Edit Check" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_check('.$row2['pay_id'].', \'' . $denom_id . '\')"><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';

                                echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierPaymentModal" onclick=viewcashierpayment_content_ldi('.$row2['pay_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            }
                            if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") {
                               
                                    echo '<a title="Edit Check2" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_check_ext('.$row2['pay_id'].', \'' . $denom_id . '\')"><i class="fas fa-pen fa-lg"></i></a>&nbsp;&nbsp;';
                               
                                

                                echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierPaymentModal" onclick=viewcashierpayment_content_ldi_ext('.$row2['pay_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            }
                        }else{
                            if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") {
                                
                                echo '<a title="View Check" style="color: skyblue;cursor: pointer" data-toggle="modal" data-target="#viewCashierPaymentModal" onclick=viewcashierpayment_content_ldi_ext('.$row2['pay_id'].')><i class="fas fa-eye fa-lg"></i></a>&nbsp;&nbsp;';
                            }
                        }  
                          
                    echo '</td>'; 
                    } 
                    echo '</tr>'; 
                } 
                    echo '</tbody>
            </table>';
            echo '<script>
                

                
            $(document).ready(function() {
                $("#dataTable").DataTable( {
                    "order": [[ 0, "desc" ]]
                } );

                $("#viewCashierPaymentModal").on("show.bs.modal", function () {
                    $("#viewSmChecksLdi").modal("hide");
                });

                $("#viewCashierPaymentModal").on("hidden.bs.modal", function () {
                    $("#viewSmChecksLdi").modal("show");
                });

                
                
                
            } );
            </script>';
          
        
 
        }

        public function view_sm_pal_ldi()
        {
            
            $ids = $this->input->post('ids');
            list($user_id, $date_added, $denom_id) = explode(',', $ids);
            $results = $this->Model_Cashier_Sm->getSmPalExtruck($user_id, $date_added, $denom_id);
            $user = $this->Model_Cashier_Sm->getUserName($user_id);

            

            echo '<div class="table-responsive">
            <table class="table sm_checks compact" id="dataTablePal" width="100%" cellspacing="0">
                <thead>
                    <tr align="center">
                    <th>Date</th>
                    <th>Code</th>
                    <th>Name</th>
                    
                    <th>Ref. No</th>
                    
                    <th> Amount</th>
                    
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach($results as $row2) { 
                    echo'<tr>
                        <td>'.$row2['date_remitted'].'</td>
                        <td>'.$row2['sm_code'].'</td>
                        <td >'.$row2['sm_name'].'</td>
                        <td >'.$row2['ref_no'].'</td>
                        <td align="right">'.number_format($row2['pay_amount'],2).'</td>';
                        
                        if($row2['date_added']==date('Y-m-d')) { 
                            echo '<td align="center">';
                            if($row2['status']=="") { 
                                
                                if(($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI" )) {

                                    echo '<a title="Edit Check" style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_palawan_ldi_xt('.$row2['pay_id'].', \'' . $user_id . '\')"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;';

                                   
                                }
                            }else{
                                if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") {
                                    

                                    echo '<a title="Edit Check" style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_palawan_ldi_xt('.$row2['pay_id'].', \'' . $user_id . '\')"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;';
                                }
                            } 
                            
                           
                        echo '</td>';
                        }else { 
                        echo '<td align="center">';
                            if($row2['status']=="") { 
                                
                                if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") {
                                   
                                    echo '<a title="Edit Check" style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_palawan_ldi_xt('.$row2['pay_id'].', \'' . $user_id . '\')"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;';

                                    
                                }
                            }else{
                                if($user->bu =="XTRUCK" || $user->bu =="XTRUCK-NETMAN" || $user->bu =="XTRUCK-MPDI" || $user->bu =="XTRUCK-NETMAN-BPI") {
                                    
                                    echo '<a title="Edit Check" style="color: orange;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick="edit_sm_palawan_ldi_xt('.$row2['pay_id'].', \'' . $user_id . '\')"><i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;';
                                }
                            }  
                              
                        echo '</td>'; 
                        } 
                    echo '</tr>'; 
                } 
                    echo '</tbody>
            </table>';
            echo '<script>
                

                
            $(document).ready(function() {
                $("#dataTablePal").DataTable( {
                    "order": [[ 0, "desc" ]]
                } );

               
                $("#editSmCheck").on("show.bs.modal", function () {
                    $("#viewSmPalLdi").modal("hide");
                });

                $("#editSmCheck").on("hidden.bs.modal", function () {
                    $("#viewSmPalLdi").modal("show");
                });

                
                
                
            } );
            </script>';
          
        
 
        }

        public function view_sm_inc_ldi()
        {
            
            $ids = $this->input->post('ids');
            
            $results    = $this->Model_Cashier_Sm->getSmIncentives($ids);
            $results2   = $this->Model_Cashier_Sm->getSmIncentivesUsed($ids);
            $total_used = $this->Model_Export->getIncentivesAppliedLedger($ids);
            $total      = $this->Model_Export->get_total_inc($ids);
            $user_id    = $this->Model_Export->getUserId($ids);
            
            echo '<p><strong>Salesman:</strong> ' .$user_id->full_name. '</p>';
            echo '<p><strong>Total Incentives:</strong> ' . number_format($total, 2) . '</p>';
            echo '<p><strong>Total Incentives Used:</strong> ' . number_format($total_used, 2) . '</p>';

            // Tabs
            echo '
            <ul class="nav nav-tabs" id="incTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="incentives-tab" data-toggle="tab" href="#incentives" role="tab" aria-controls="incentives" aria-selected="true">Incentives</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="used-tab" data-toggle="tab" href="#used" role="tab" aria-controls="used" aria-selected="false">Incentives Used</a>
                </li>
            </ul>

            <div class="tab-content" id="incTabsContent">
                
                <div class="tab-pane fade show active" id="incentives" role="tabpanel" aria-labelledby="incentives-tab">
                    <div class="table-responsive mt-3">
                        <table class="table sm_checks compact" id="dataTableInc" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th>Month ID</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>';
                                foreach ($results as $row2) {
                                    echo '<tr>';
                                    echo '<td align="center">' . $row2['inc_id'] . '</td>';
                                    echo '<td align="center">' . $row2['inc_month'] . '</td>';
                                    echo '<td align="center">' . number_format($row2['inc_amount'], 2) . '</td>';
                                    echo '</tr>';
                                }
                        echo '</tbody>
                        </table>
                    </div>
                </div>

            
                <div class="tab-pane fade" id="used" role="tabpanel" aria-labelledby="used-tab">
                    <div class="table-responsive mt-3">
                        <table class="table sm_checks compact" id="dataTableIncUsed" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th>Denom No.</th>
                                    <th>Amount</th>
                                    
                                </tr>
                            </thead>
                            <tbody>';
                                foreach ($results2 as $row2) {
                                    echo '<tr>';
                                    echo '<td align="center">' . $row2['denom_id'] . '</td>';
                                    echo '<td align="center">' . number_format($row2['inc_used'], 2) . '</td>';
                                    
                                    echo '</tr>';
                                }
                        echo'</tbody>
                        </table>
                    </div>
                </div>
            </div>';

            
            echo '<script>
            $(document).ready(function() {
                $("#dataTableInc").DataTable({
                    "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        {
                            "targets": 0,
                            "visible": false,
                            "searchable": false
                        }
                    ]
                });

                $("#dataTableIncUsed").DataTable({
                    "order": [[ 0, "desc" ]]
                });

                
                $(\'a[data-toggle="tab"]\').on("shown.bs.tab", function (e) {
                    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
                });
            });
            </script>';

 
        }

        public function save_remittance()
        {
            if($this->input->post('totalremittance') > $this->input->post('totalcollection'))
            {
                echo 'over';
            }
            else
            {
                $this->Model_Cashier_Sm->saveRemittance();
                echo 'ok';
            }
        }

        public function update_status()
        {
            $this->Model_Cashier_Sm->updateCheckStatus();
        }

        public function check_remarks()
        {
            $result = $this->Model_Cashier_Sm->getCheckRemarks($_POST['ids']);
            echo '<div class="form-row">
                        <input type="hidden" name="paymentid" id="paymentid" value="'.$_POST['ids'].'">
                        <textarea class="form-control" autocomplete="off" rows="3" id="remarks" name="remarks">'.$result->remarks.'</textarea>
                    </div><br/>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Remarks</button>';
        }

        public function cashier_remarks()
        {
            $result = $this->Model_Cashier_Sm->getRemarks($_POST['ids']);
            echo '<div class="form-row">
                        <input type="hidden" name="denomid" id="denomid" value="'.$_POST['ids'].'">
                        <textarea class="form-control" autocomplete="off" maxlength="30" rows="3" id="remarks" name="remarks">'.$result->remarks.'</textarea>
                    </div><br/>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Remarks</button>';
        }

        public function sm_incentives()
        {
            $sm_code            = $this->Model_Cashier_Sm->getSmCode($_POST['user_id']);
            $total_collection   = $this->Model_Cashier_Sm->getSmCollection($_POST['ids']);
            $result             = $this->Model_Cashier_Sm->getIncentives($sm_code->id_no);
            //var_dump($result);

            echo '<div  class="form-row">
                    <input type="hidden" name="denomid" id="denomid" value="'.$_POST['ids'].'">
                    <input type="hidden" name="total_collection" id="total_collection" value="'.$total_collection->total_collection.'">
                    <input type="hidden" name="sm_code" id="sm_code" value="'.$sm_code->id_no.'">
                    <input type="hidden" name="inc_balance" id="inc_balance" value="'.$result.'">
                        <label for="totalinc">Enter Salesman Incentive <p style="font-weight: bold; font-style: italic; color: red">(Available Incentives: '.number_format($result,2).')</p></label>
                            
                            <input type="text" min="0.0" max="'.$result.'" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalinc" id="totalinc" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" >

                            <span id="error-msg" style="color: red; display: none;">Error: Input value exceeds maximum available incentives or exceeds the total collection.</span>
                    </div><br> 
                    <button style="float: right; margin-top: 20px;" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button id="submit-btn" type="submit" style="float: right;margin-right: 5px;margin-top: 20px;" class="btn btn-primary">Add Incentives</button>';

                    echo '<script>
                    $(document).ready(function() {
                        $("input#totalinc").keyup(function(event) {


                            // skip for arrow keys
                            if(event.which >= 37 && event.which <= 40){
                                event.preventDefault();
                            }

                            var max = '.$result.';
                            var max2 = '.$total_collection->total_collection.';
                            var value = $(this).val().replace(/,/g, ""); // Remove commas from input value
                            var parsedValue = parseFloat(value);
                            if (isNaN(parsedValue)) {
                                parsedValue = 0; // Set to 0 if input cannot be parsed as a number
                            }
                            if (parsedValue > max || parsedValue > max2) {
                                $("#error-msg").show();
                                $("#submit-btn").prop("disabled", true);
                            } else {
                                $("#error-msg").hide();
                                $("#submit-btn").prop("disabled", false);
                            }
                            $(this).val(numberWithCommas(parsedValue)); // Reapply commas to the value
                                });
                            });
                  </script>';
        }

        public function sm_incentives_edit()
        {
            $sm_code            = $this->Model_Cashier_Sm->getSmCode($_POST['user_id']);
            $total_collection   = $this->Model_Cashier_Sm->getSmCollection($_POST['ids']);
            $total_remittance   = $this->Model_Cashier_Sm->getSmRemittance($_POST['ids']);
            $result             = $this->Model_Cashier_Sm->getIncentives($sm_code->id_no);
            $inc                = $this->Model_Cashier_Sm->getSmInc($_POST['ids']);
            $bal = $result + $inc->sm_inc;  
            //var_dump($result);

            echo '<div  class="form-row">
                    <input type="hidden" name="denomid" id="denomid" value="'.$_POST['ids'].'">
                    <input type="hidden" name="total_collection" id="total_collection" value="'.$total_remittance->total_remittance.'">
                    <input type="hidden" name="sm_code" id="sm_code" value="'.$sm_code->id_no.'">
                    <input type="hidden" name="inc_balance" id="inc_balance" value="'.$bal.'">
                        <label for="totalinc">Enter Salesman Incentive <p style="font-weight: bold; font-style: italic; color: red">(Available Incentives: '.number_format($bal,2).')</p></label>
                            
                            <input type="text" min="0.0" max="'.$result.'" step="any" class="form-control" autocomplete="off" style="text-align: center;background-color: white; font-weight: bold;" name="totalinc" id="totalinc" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46" value="'.$inc->sm_inc.'">

                            <span id="error-msg" style="color: red; display: none;">Error: Input value exceeds maximum available incentives or exceeds the total collection.</span>
                    </div><br> 
                    <button style="float: right; margin-top: 20px;" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button id="submit-btn" type="submit" style="float: right;margin-right: 5px;margin-top: 20px;" class="btn btn-primary">Edit Incentives</button>';

                    echo '<script>
                    $(document).ready(function() {
                        $("input#totalinc").keyup(function(event) {


                            // skip for arrow keys
                            if(event.which >= 37 && event.which <= 40){
                                event.preventDefault();
                            }

                            var max = '.$bal.';
                            var max2 = '.$total_remittance->total_remittance.';
                            var value = $(this).val().replace(/,/g, ""); // Remove commas from input value
                            var parsedValue = parseFloat(value);
                            if (isNaN(parsedValue)) {
                                parsedValue = 0; // Set to 0 if input cannot be parsed as a number
                            }
                            if (parsedValue > max || parsedValue > max2) {
                                $("#error-msg").show();
                                $("#submit-btn").prop("disabled", true);
                            } else {
                                $("#error-msg").hide();
                                $("#submit-btn").prop("disabled", false);
                            }
                            $(this).val(numberWithCommas(parsedValue)); // Reapply commas to the value
                                });
                            });
                  </script>';
        }

        public function cashier_remarks2()
        {
            $result = $this->Model_Cashier_Sm->getRemarks($_POST['ids']);
            echo '<div class="form-row">
                        <input type="hidden" name="denomid" id="denomid" value="'.$_POST['ids'].'">
                        <textarea class="form-control" style="background-color:white" autocomplete="off" rows="3" id="remarks" name="remarks" readonly>'.$result->remarks.'</textarea>
                    </div><br/>';
                    // <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    // <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Remarks</button>
        }

        public function save_remarks()
        {
            $this->Model_Cashier_Sm->saveRemarks();
        }

        public function save_incentives()
        {
            $this->Model_Cashier_Sm->saveIncentives();
        }

        public function save_remarks2()
        {
            $this->Model_Cashier_Sm->saveRemarks2();
        }

        public function edit_sm_check_ldi()
        {
            $result         = $this->Model_Cashier_Sm->getPayment2($_POST['ids']);
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.$result->payment_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="userid" id="userid" autocomplete="off" value="'.$result->user_id.'" required>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->type=='PDC'){$pdc='checked';}else{$pdc='';}
                    if($result->type=='DC'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="DC" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="PDC" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Check Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_num.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.$result->amount.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank">Check Status</label>
                            <select class="form-control" name="checkstatus" id="checkstatus">
                                <option value=""></option>';
                                if($result->status!=''){$stat='selected';}else{$stat='';}
                    echo       '<option value="Cancelled" '.$stat.'>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
        ?>
            <script>
                $('#edit_sm_payment').on("submit", function(e){
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating payment?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_payment',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Payment successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }
                    }
                    );
            });
            </script>        
        <?php
        }

        public function edit_sm_check_ext()
        {
            $result = $this->Model_Cashier_Sm->getPayment3($_POST['ids']);
            $collection = 0.00;
            $remittance = 0.00;

            $dc_amt = 0.00;
            $pdc_amt = 0.00;

            $result_denom = $this->Model_Cashier_Sm->getSmDenombyDenomIdExt($this->input->post('denomid'));

            $collection = $result_denom->total_remittance - $result->check_amount;
            $remittance = $result_denom->total_collection - $result->check_amount;
            $dc_pc      = ($result->check_type == 'Dated') ? ($result_denom->dc_pcs - 1) : $result_denom->dc_pcs;
            $pdc_pc     = ($result->check_type == 'Post Dated') ? ($result_denom->pdc_pcs - 1) : $result_denom->pdc_pcs;

            $dc_amt     = ($result->check_type == 'Dated') ? ($result_denom->total_dc - $result->check_amount) : $result_denom->total_dc;
            $pdc_amt    = ($result->check_type == 'Post Dated') ? ($result_denom->total_pdc - $result->check_amount) : $result_denom->total_pdc;

            // $data = [
            //     'collection' => $collection,
            //     'remittance' => $remittance,
            //     'dc_pc' => $dc_pc,
            //     'pdc_pc' => $pdc_pc,
            //     'dc_amt' => $dc_amt,
            //     'pdc_amt' => $pdc_amt,
            //     'cur_stat' => $result->status5,

            // ];

            // var_export($data);


            //var_dump($collection, $remittance, $dc_pc, $pdc_pc, $dc_amt, $pdc_amt);
            //var_export($result);
            //var_export($result2);
            //die();

            
           
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>

                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="collection" id="collection" autocomplete="off" value="'.@$collection.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="remittance" id="remittance" autocomplete="off" value="'.@$remittance.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="dc_pc" id="dc_pc" autocomplete="off" value="'.@$dc_pc.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="pdc_pc" id="pdc_pc" autocomplete="off" value="'.@$pdc_pc.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="dc_amt" id="dc_amt" autocomplete="off" value="'.@$dc_amt.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="pdc_amt" id="pdc_amt" autocomplete="off" value="'.@$pdc_amt.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" autocomplete="off" value="'.@$result_denom->denom_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cur_stat" id="cur_stat" autocomplete="off" value="'.@$result->status5.'" required>


                            
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->check_type=='Post Dated'){$pdc='checked';}else{$pdc='';}
                    if($result->check_type=='Dated'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Check Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->check_amount, 2, '.', '').'" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="check_stat">Check Status</label>';
                                $isDisabled = ($result->status5 == 'Returned') ? 'disabled' : '';
                        echo   '<select class="form-control" name="checkstatus" id="checkstatus" '.$isDisabled.' >
                                <option value=""></option>';
                                    $selectedCleared = ($result->status5 == 'Cleared') ? 'selected' : '';
                                    $selectedReturned = ($result->status5 == 'Returned') ? 'selected' : '';
                        echo   '<option value="Cleared" '.$selectedCleared.'>Cleared</option>
                                <option value="Returned" '.$selectedReturned.'>Returned</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" id="reason-row" style="display: none;">
                        <div class="form-group col-md-12">
                            <label for="ret_reason">Reason for Return</label>
                            <select class="form-control" name="ret_reason" id="ret_reason">
                                <option value=""></option>
                                <option value="Over PDC">Over PDC</option>
                                <option value="Incorrect amount in words">Incorrect amount in words</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" id="other-reason-row" style="display: none;">
                        <div class="form-group col-md-12">
                            <label for="other_reason">Please specify:</label>
                            <input type="text" class="form-control" name="other_reason" id="other_reason" placeholder="Enter reason">
                        </div>
                    </div>


                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
                ?>

                
                <script>
                    $('#edit_sm_payment3').on("submit", function(e){
                    var formData = new FormData($(this)[0]);
                    e.preventDefault();
                    var flag = 0;
                    swal({
                        title: "Proceed updating payment?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                        },
                        
                        function(isConfirm) {
                            if(isConfirm)
                            {
                                $.ajax({
                                url: baseurl + 'edit_sm_payment_ext',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                error: function() {
                                    alert('yes');
                                },
                                success: function(data) {
                                    if(data=='exist')
                                    {
                                        swal({
                                            title: "Check no. is already used by another Salesman or Cashier!",
                                            type: "error",
                                            showCancelbutton: false,
                                            closeModal: false
                                        });
                                    }  
                                    else
                                    {
                                        $("#editSmCheck").modal("hide");
                                        swal({
                                            title: "Payment successfully updated!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                window.location.reload();
                                            }
                                        }
                                        );
                                    }
                                }
                            });
                            }
                        }
                        );
                });

                $(document).ready(function() {
                    // Show or hide the Reason for Return based on Check Status
                    $('#checkstatus').on('change', function() {
                        if ($(this).val() === 'Returned') {
                            $('#reason-row').show(); // Show the reason dropdown
                        } else {
                            $('#reason-row').hide(); // Hide the reason dropdown and the 'Others' input
                            $('#other-reason-row').hide();
                            $('#ret_reason').val(''); // Reset reason dropdown
                        }
                    });

                    // Show or hide the input field based on the Reason for Return selection
                    $('#ret_reason').on('change', function() {
                        if ($(this).val() === 'Others') {
                            $('#other-reason-row').show(); // Show the input field for custom reason
                        } else {
                            $('#other-reason-row').hide(); // Hide the input field
                            $('#other_reason').val(''); // Clear the input
                        }
                    });

                    // If the status is already Returned, show the reason on page load
                    if ($('#checkstatus').val() === 'Returned') {
                        $('#reason-row').show();
                    }
                });

                </script>        

        <?php
        }

        public function edit_sm_check_ldi_op()
        {
            $result         = $this->Model_Cashier_Sm->getPayment($_POST['ids']);
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>

                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->check_type=='Post Dated Check'){$pdc='checked';}else{$pdc='';}
                    if($result->check_type=='Dated Check'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated Check" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated Check" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Due Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->pay_amount, 2, '.', '').'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank">Check Status</label>
                            <select class="form-control" name="checkstatus" id="checkstatus">
                                <option value=""></option>';
                                if($result->status!=''){$stat='selected';}else{$stat='';}
                        echo       '<option value=""></option>
                        <option value="Returned" '.$stat.'>Returned</option>
                            </select>
                        </div>
                    </div>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save OPLAN Payment</button>
                </form>';
            ?>
            <script>
                $('#edit_sm_payment3').on("submit", function(e){
                $("#editSmCheck").modal("hide");
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating OPLAN payment?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_payment_op',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Payment successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }else{
                            $("#editSmCheck").modal("show");
                        }
                    }
                    );
            });
            </script>        
        <?php
        }

        public function edit_sm_check_ldi_xt()
        {
            $result         = $this->Model_Cashier_Sm->getPayment3($_POST['ids']);
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>

                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if(@$result->check_type=='Post Dated'){$pdc='checked';}else{$pdc='';}
                    if(@$result->check_type=='Dated'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Due Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->pay_amount, 2, '.', '').'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank">Check Status</label>
                            <select class="form-control" name="checkstatus" id="checkstatus">
                                <option value=""></option>';
                                if($result->status!=''){$stat='selected';}else{$stat='';}
                        echo       '
                        <option value="Returned" '.$stat.'>Returned</option>
                            </select>
                        </div>
                    </div>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save XTRUCK Payment</button>
                </form>';
            ?>
            <script>
                $('#edit_sm_payment3').on("submit", function(e){
                $("#editSmCheck").modal("hide");
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating XTRUCK payment?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_payment_ext',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Payment successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }else{
                            $("#editSmCheck").modal("show");
                        }
                    }
                    );
            });
            </script>        
        <?php
        }

        public function edit_sm_denom_ldi_op()
        {
            $result         = $this->Model_Cashier_Sm->getPayment5($_POST['srr']);
            
            echo '<form method="post" id="edit_sm_payment3">
                    
                   
                    <div class="form-row">
                       
                        <div class="form-group col-md-12">
                            <label for="manualsrr">SRR No.</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="msrr" id="msrr" autocomplete="off" value="'.$result->manualsrr.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" autocomplete="off" value="'.$_POST['srr'].'" required>
                            <label for="manualsrr">Manual SRR No.</label>
                            <input type="text"  class="form-control" style="text-align: center;background-color: white" name="manualsrr" id="manualsrr" autocomplete="off" value="'.$result->manualsrr.'" required>

                            <label for="date_added">Remit Date</label>
                            <input type="text"  class="form-control" style="text-align: center;background-color: white" name="date_added" id="date_added" autocomplete="off" value="'.$result->date_added.'" required> 

                        </div>
                    </div>
                    
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save</button>
                </form>';
            ?>
            <script>

                function isValidSRRFormat(value) {
                    const pattern = /^\d+$/; // Matches one or more digits (e.g., 123, 456789)
                    return pattern.test(value);
                }

                function cleanSRR(value) {
                    return value.replace(/,/g, '');
                }


                $("#manualsrr").on("keyup", function () {
                    //var manualsrr = $(this).val().trim();
                    var manualsrr = cleanSRR($("#manualsrr").val().trim())

                    if (manualsrr !== "") {
                        if (!isValidSRRFormat(manualsrr)) {
                            swal({
                                title: "SRR must be numbers only.",
                                type: "warning"
                            });
                            return;
                        }

                        $.ajax({
                            url: "<?= base_url('Cont_Denom/check_manualsrr_exists') ?>",
                            type: "POST",
                            data: { manualsrr: manualsrr },
                            dataType: "json",
                            success: function (response) {
                                if (response.exists) {
                                    swal({
                                        title: "The SRR No. is already in use. Please enter a different one!",
                                        type: "error"
                                    });
                                    $("#manualsrr").val("").focus();
                                }
                            },
                            error: function () {
                                alert("Error checking SRR No. Please try again.");
                            }
                        });
                    }
                });

                $('#edit_sm_payment3').on("submit", function(e){
                $("#editSmCheck").modal("hide");
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating denomination?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_denom_op',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Denomination successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }else{
                            $("#editSmCheck").modal("show");
                        }
                    }
                    );
            });
            </script>        
        <?php
        }
        
        public function edit_sm_palawan_ldi_xt()
        {
            $result         = $this->Model_Cashier_Sm->getPayment4($_POST['ids']);
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    
                   
                    <div class="form-row">
                       
                        <div class="form-group col-md-12">
                            <label for="amount">Palawan Amount</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" autocomplete="off" value="'.$_POST['denomid'].'" required>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->pay_amount, 2, '.', '').'" required>
                        </div>
                    </div>
                    
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save XTRUCK Palawan</button>
                </form>';
            ?>
            <script>
                $('#edit_sm_payment3').on("submit", function(e){
                $("#editSmCheck").modal("hide");
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating XTRUCK Palawan payment?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_pal_ext',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Palawan payment successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }else{
                            $("#editSmCheck").modal("show");
                        }
                    }
                    );
            });
            </script>        
        <?php
        }

        public function pay_to_ret_op()
        {
            $result = $this->Model_Cashier_Sm->getPayment($this->input->post('ids'));
            @$hepe_name =$this->Model_Cashier_Sm->getUserNamebyId($result->sm_code);
            
            //$bank_result    = $this->Model_Cashier_Sm->getBankData();
             echo'
                <form method="post" id="edit_sm_payment3">
                    
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="si">SI No.</label>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cus_code" id="cus_code" autocomplete="off" value="'.$result->cus_code.'" readonly>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cus_name" id="cus_name" autocomplete="off" value="'.@$result->name.'" readonly>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hepe_code" id="hepe_code" autocomplete="off" value="'.$result->sm_code.'" readonly>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hepe_name" id="hepe_name" autocomplete="off" value="'.$hepe_name->full_name.'" readonly>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="si_docno" id="si_docno" autocomplete="off" value="'.$result->si_docno.'" readonly> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="si_date">SI Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="si_date" id="si_date" autocomplete="off" value="'.$result->si_date.'" readonly>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="return_date">Return Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="return_date" id="return_date" autocomplete="off" value="'.$result->pay_date.'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="amount">Return Amount</label>
                        <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="return_amount" id="return_amount" autocomplete="off" value="'.number_format($result->pay_amount, 2, '.', '').'" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sm_code">Salesman Code</label>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="sm_code" id="sm_code" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sm_name">Salesman Name</label>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="sm_name" id="sm_name" autocomplete="off"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="si_amount">SI Amount</label>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" placeholder="0.00" style="text-align: center;background-color: white;" name="si_amount" id="si_amount" oninput="formatSIAmount()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                        <div id="error-message3" style="color: red;"></div>
                    </div>
                </div>

                <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                <button id="saveButton" type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment as Return</button>
            </form>';
                ?>
                    <script>
                        $('#edit_sm_payment3').on("submit", function(e){
                        $("#editSmCheck").modal("hide");
                        var formData = new FormData($(this)[0]);
                        e.preventDefault();
                        var flag = 0;
                        swal({
                            title: "Are you sure to convert this PAYMENT to RETURNED?",
                            text: "",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonClass: "btn-success",
                            cancelButtonText: "No",
                            confirmButtonText: "Yes",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            showLoaderOnConfirm: true
                            },
                            
                            function(isConfirm) {
                                if(isConfirm)
                                {
                                    $.ajax({
                                    url: baseurl + 'payment_to_return_op',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    error: function() {
                                        alert('yes');
                                    },
                                    success: function(data) {
                                        if(data=='exist')
                                        {
                                            swal({
                                                title: "Sales Invoice No. already exists in return!",
                                                type: "error",
                                                showCancelbutton: false,
                                                closeModal: false
                                            });
                                        }  
                                        else
                                        {
                                            $("#editSmCheck").modal("hide");
                                            swal({
                                                title: "Payment successfully converted as RETURNED!",
                                                type: "success",
                                                showCancelbutton: false,
                                                closeModal: false
                                            },
                                            function(isok) {
                                                if(isok){
                                                    window.location.reload();
                                                }
                                            }
                                            );
                                        }
                                    }
                                });
                                }else{
                                    $("#editSmCheck").modal("show");
                                }
                            }
                            );
                    });
                    </script>   
                    
                    <script>
                        function formatSIAmount() {
                            var inputElement = document.getElementById("si_amount");
                            var errorMessageElement = document.getElementById("error-message3");
                            var saveButton = document.getElementById("saveButton");
                            var inputValue = inputElement.value;

                            // Check if the input contains any invalid characters
                            if (/[^0-9.,]/.test(inputValue)) {
                                // Display an error message
                                errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                                saveButton.disabled = true;
                            } else {
                                // Remove the error message if the input is valid
                                errorMessageElement.textContent = "";

                                // Remove any characters other than numbers and periods (keep periods for decimals)
                                var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                                // Split the cleaned value into the integer and decimal parts
                                var parts = cleanedValue.split(".");
                                var integerPart = parts[0];
                                var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                                // Format the integer part with commas
                                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                // Combine the formatted integer part with the decimal part
                                var formattedValue = integerPart + decimalPart;

                                // Update the input field with the formatted value
                                inputElement.value = formattedValue;

                                saveButton.disabled = false;
                            }
                        }


                    </script>
                <?php
        }

        public function ret_to_pay_op()
        {
            $result = $this->Model_Cashier_Sm->getReturnOplan($this->input->post('ids'));
            @$hepe_name =$this->Model_Cashier_Sm->getUserNamebyId($result->sm_code);
            
            //$bank_result    = $this->Model_Cashier_Sm->getBankData();
             echo'
                <form method="post" id="edit_sm_payment3">
                    
            <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="si">SI No.</label>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->return_no.'" required>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cus_code" id="cus_code" autocomplete="off" value="'.$result->cus_code.'" readonly>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cus_name" id="cus_name" autocomplete="off" value="'.@$result->name.'" readonly>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hepe_code" id="hepe_code" autocomplete="off" value="'.$result->hepe_code.'" readonly>
                        <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hepe_name" id="hepe_name" autocomplete="off" value="'.$$result->hepe_name.'" readonly>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="si_docno" id="si_docno" autocomplete="off" value="'.$result->si_docno.'" readonly> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="si_date">SI Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="si_date" id="si_date" autocomplete="off" value="'.$result->si_date.'" readonly>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="return_date">Return Date</label>
                        <input type="date" class="form-control" style="text-align: center;background-color: white" name="return_date" id="return_date" autocomplete="off" value="'.$result->return_date.'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="amount">Return Amount</label>
                        <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="return_amount" id="return_amount" autocomplete="off" value="'.number_format($result->pay_amount, 2, '.', '').'" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="sm_code">Salesman Code</label>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="sm_code" id="sm_code" autocomplete="off" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sm_name">Salesman Name</label>
                        <input type="text" class="form-control" style="text-align: center;background-color: white" name="sm_name" id="sm_name" autocomplete="off"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="si_amount">SI Amount</label>
                        <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" placeholder="0.00" style="text-align: center;background-color: white;" name="si_amount" id="si_amount" oninput="formatSIAmount()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                        <div id="error-message3" style="color: red;"></div>
                    </div>
                </div>

                <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                <button id="saveButton" type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment as Return</button>
            </form>';
                ?>
                    <script>
                        $('#edit_sm_payment3').on("submit", function(e){
                        $("#editSmCheck").modal("hide");
                        var formData = new FormData($(this)[0]);
                        e.preventDefault();
                        var flag = 0;
                        swal({
                            title: "Are you sure to convert this RETURN to PAYMENT?",
                            text: "",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonClass: "btn-success",
                            cancelButtonText: "No",
                            confirmButtonText: "Yes",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            showLoaderOnConfirm: true
                            },
                            
                            function(isConfirm) {
                                if(isConfirm)
                                {
                                    $.ajax({
                                    url: baseurl + 'return_to_payment_op',
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    error: function() {
                                        alert('yes');
                                    },
                                    success: function(data) {
                                        if(data=='exist')
                                        {
                                            swal({
                                                title: "Sales Invoice No. already exists in return!",
                                                type: "error",
                                                showCancelbutton: false,
                                                closeModal: false
                                            });
                                        }  
                                        else
                                        {
                                            $("#editSmCheck").modal("hide");
                                            swal({
                                                title: "Return successfully converted as PAYMENT!",
                                                type: "success",
                                                showCancelbutton: false,
                                                closeModal: false
                                            },
                                            function(isok) {
                                                if(isok){
                                                    window.location.reload();
                                                }
                                            }
                                            );
                                        }
                                    }
                                });
                                }else{
                                    $("#editSmCheck").modal("show");
                                }
                            }
                            );
                    });
                    </script>   
                    
                    <script>
                        function formatSIAmount() {
                            var inputElement = document.getElementById("si_amount");
                            var errorMessageElement = document.getElementById("error-message3");
                            var saveButton = document.getElementById("saveButton");
                            var inputValue = inputElement.value;

                            // Check if the input contains any invalid characters
                            if (/[^0-9.,]/.test(inputValue)) {
                                // Display an error message
                                errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                                saveButton.disabled = true;
                            } else {
                                // Remove the error message if the input is valid
                                errorMessageElement.textContent = "";

                                // Remove any characters other than numbers and periods (keep periods for decimals)
                                var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                                // Split the cleaned value into the integer and decimal parts
                                var parts = cleanedValue.split(".");
                                var integerPart = parts[0];
                                var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                                // Format the integer part with commas
                                integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                // Combine the formatted integer part with the decimal part
                                var formattedValue = integerPart + decimalPart;

                                // Update the input field with the formatted value
                                inputElement.value = formattedValue;

                                saveButton.disabled = false;
                            }
                        }


                    </script>
                <?php
        }

        public function edit_sm_check_ldi_tax_op()
        {
            $result         = $this->Model_Cashier_Sm->getPayment($_POST['ids']);
            $bank_result    = $this->Model_Cashier_Sm->getBankData();

            
            
            echo '<form method="post" id="edit_sm_payment3">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tax-tab" data-toggle="tab" href="#tax" role="tab" aria-controls="tax" aria-selected="true">Tax</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
                        </li>
                    </ul><br>

                    <div class="tab-content" id="myTabContent">      
                        <div class="tab-pane fade show active" id="tax" role="tabpanel" aria-labelledby="tax-tab">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                <p style="color:red;"><i>Current Tax Amount: '.@$result->tax_amount.' </i></p>
                                    <label for="tax">Enter tax amount to add</label>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>
                                    
                                    <input type="text" min="0.0" max="'.$result->pay_amount.'" step="any" class="form-control" style="text-align: center;background-color: white" name="tax_amount"id="tax_amount" placeholder="0.00" autocomplete="off" oninput="formatSIAmount(); validateTaxAmount('.$result->pay_amount.')" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                                    <div id="error-message3" style="color: red;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="tax">Enter payment amount to add</label>
                                    
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" >
                                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" placeholder="0.00" style="text-align: center;background-color: white;" name="pay_amount2" id="pay_amount2" oninput="formatSIAmount2()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                                    <div id="error-message3" style="color: red;"></div>
                                </div>
                            </div>
                        </div>

                        
                    

                    </div>

                    
                   
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button id="saveButton" type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Amount</button>
                </form>';
        ?>
            <script>
                $('#edit_sm_payment3').on("submit", function(e){
                $("#editSmCheck").modal("hide");
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating OPLAN payment?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_payment_tax_op',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Payment successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }else{
                            $("#editSmCheck").modal("show");
                        }
                    }
                    );
            });
            </script> 
            
            <script>
                function formatSIAmount() {
                    var inputElement = document.getElementById("tax_amount");
                    var errorMessageElement = document.getElementById("error-message3");
                    var saveButton = document.getElementById("saveButton");
                    var inputValue = inputElement.value;

                    // Check if the input contains any invalid characters
                    if (/[^0-9.,]/.test(inputValue)) {
                        // Display an error message
                        errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                        saveButton.disabled = true;
                    } else {
                        // Remove the error message if the input is valid
                        errorMessageElement.textContent = "";

                        // Remove any characters other than numbers and periods (keep periods for decimals)
                        var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                        // Split the cleaned value into the integer and decimal parts
                        var parts = cleanedValue.split(".");
                        var integerPart = parts[0];
                        var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                        // Format the integer part with commas
                        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        // Combine the formatted integer part with the decimal part
                        var formattedValue = integerPart + decimalPart;

                        // Update the input field with the formatted value
                        inputElement.value = formattedValue;

                        saveButton.disabled = false;
                    }
                }

                function formatSIAmount2() {
                    var inputElement = document.getElementById("pay_amount2");
                    var errorMessageElement = document.getElementById("error-message3");
                    var saveButton = document.getElementById("saveButton");
                    var inputValue = inputElement.value;

                    // Check if the input contains any invalid characters
                    if (/[^0-9.,]/.test(inputValue)) {
                        // Display an error message
                        errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                        saveButton.disabled = true;
                    } else {
                        // Remove the error message if the input is valid
                        errorMessageElement.textContent = "";

                        // Remove any characters other than numbers and periods (keep periods for decimals)
                        var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                        // Split the cleaned value into the integer and decimal parts
                        var parts = cleanedValue.split(".");
                        var integerPart = parts[0];
                        var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                        // Format the integer part with commas
                        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        // Combine the formatted integer part with the decimal part
                        var formattedValue = integerPart + decimalPart;

                        // Update the input field with the formatted value
                        inputElement.value = formattedValue;

                        saveButton.disabled = false;
                    }
                }

                function validateTaxAmount(maxValue) {
                    let stringWithCommas = document.getElementById('tax_amount').value;
                    let stringWithoutCommas = stringWithCommas.replace(/,/g, '');
                    const taxAmount = parseFloat(stringWithoutCommas);

                    console.log(taxAmount);

                    if (taxAmount > maxValue) {
                        document.getElementById('error-message3').textContent = 'tax amount cannot exceed ' + maxValue;
                        document.getElementById('tax_amount').value = maxValue.toFixed(2); // Set it to the max value
                    } else {
                        document.getElementById('error-message3').textContent = ''; // Clear the error message
                    }
                }

            </script>
        <?php
        }

        public function edit_sm_check_ldi_tax_op_minus()
        {
            $result         = $this->Model_Cashier_Sm->getPayment($_POST['ids']);
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            @$hepe_name     =$this->Model_Cashier_Sm->getUserNamebyId($result->sm_code);
            $showReturnTab  = $this->Model_Cashier_Sm->selectReturn();
            //<p style="color:red;"><i>Current Tax Amount: '.@$result->tax_amount.' </i></p> 
            
            echo'<form method="post" id="edit_sm_payment3">
                    
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="true">Payment</a>
                        </li>
                        ';

                        if ($showReturnTab) {
                            echo '<li class="nav-item">
                                    <a class="nav-link" id="return-tab" data-toggle="tab" href="#return" role="tab" aria-controls="return" aria-selected="false">Payment w/ Return</a>
                                </li>';
                        }

                        echo '

                        <li class="nav-item">
                            <a class="nav-link" id="return2-tab" data-toggle="tab" href="#return2" role="tab" aria-controls="return" aria-selected="false">Payment w/out Return</a>
                        </li>
                    </ul><br>

                    <div class="tab-content" id="myTabContent">      
                        <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="tax">Enter amount to deduct</label>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="type" id="type" value="payment" >
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" >
                                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" placeholder="0.00" style="text-align: center;background-color: white;" name="pay_amount" id="pay_amount" oninput="formatSIAmount()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46"> 
                                    <div id="error-message3" style="color: red;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="return" role="tabpanel" aria-labelledby="return-tab">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="tax">Enter amount to deduct to payment and add to return</label>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="type" id="type" value="return" >
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="si" id="si" autocomplete="off" value="'.@$result->si_docno.'" >
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" >
                                    <input type="text" min="0.0" step="any" class="form-control" autocomplete="off" placeholder="0.00" style="text-align: center;background-color: white;" name="pay_amount2" id="pay_amount2" oninput="formatSIAmount2()" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                                    <div id="error-message3" style="color: red;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="return2" role="tabpanel" aria-labelledby="return2-tab">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="si">SI No.</label>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" >
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="type" id="type" autocomplete="off" value="return2" readonly>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cus_code" id="cus_code" autocomplete="off" value="'.$result->cus_code.'" readonly>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cus_name" id="cus_name" autocomplete="off" value="'.@$result->name.'" readonly>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hepe_code" id="hepe_code" autocomplete="off" value="'.$result->sm_code.'" readonly>
                                    <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="hepe_name" id="hepe_name" autocomplete="off" value="'.@$hepe_name->full_name.'" readonly>
                                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="si_docno" id="si_docno" autocomplete="off" value="'.$result->si_docno.'" readonly> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="si_date">SI Date</label>
                                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="si_date" id="si_date" autocomplete="off" value="'.$result->si_date.'" readonly>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="return_date" id="return_date" autocomplete="off" value="'.$result->pay_date.'" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="amount">Return Amount</label>
                                    <input type="text" min="0.0" max="'.$result->pay_amount.'" step="any" class="form-control" style="text-align: center;background-color: white" name="return_amount"id="return_amount" placeholder="0.00" autocomplete="off" oninput="formatReturnAmount(); validateReturnAmount('.$result->pay_amount.')" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                                    <div id="error-message3" style="color: red;"></div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="sm_code">Salesman Code</label>
                                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="sm_code" id="sm_code" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sm_name">Salesman Name</label>
                                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="sm_name" id="sm_name" autocomplete="off">
                                </div>
                            </div>

                            

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="si_amount">SI Amount</label>
                                    

                                    <input type="text" min="0.0" max="'.$result->pay_amount.'" step="any" class="form-control" style="text-align: center;background-color: white" name="si_amount"id="si_amount" placeholder="0.00" autocomplete="off" oninput="formatSIAmount3(); validateSIAmount('.$result->pay_amount.')" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode === 46">
                                    <div id="error-message3" style="color: red;"></div>
                                </div>
                            </div>
                        </div>
                    

                    </div>
                    
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button id="saveButton" type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Amount</button>
                </form>';

        ?>
            <script>
                $('#edit_sm_payment3').on("submit", function(e){
                $("#editSmCheck").modal("hide");
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                var flag = 0;
                swal({
                    title: "Proceed updating OPLAN payment?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                    },
                    
                    function(isConfirm) {
                        if(isConfirm)
                        {
                            $.ajax({
                            url: baseurl + 'edit_sm_payment_tax_op_minus',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(data) {
                                if(data=='exist')
                                {
                                    swal({
                                        title: "Check no. is already used by another Salesman or Cashier!",
                                        type: "error",
                                        showCancelbutton: false,
                                        closeModal: false
                                    });
                                }  
                                else
                                {
                                    $("#editSmCheck").modal("hide");
                                    swal({
                                        title: "Payment successfully updated!",
                                        type: "success",
                                        showCancelbutton: false,
                                        closeModal: false
                                    },
                                    function(isok) {
                                        if(isok){
                                            window.location.reload();
                                        }
                                    }
                                    );
                                }
                            }
                        });
                        }else{
                            $("#editSmCheck").modal("show");
                        }
                    }
                    );
            });
            </script> 
            
            <script>
                function formatSIAmount() {
                    var inputElement = document.getElementById("pay_amount");
                    var errorMessageElement = document.getElementById("error-message3");
                    var saveButton = document.getElementById("saveButton");
                    var inputValue = inputElement.value;

                    // Check if the input contains any invalid characters
                    if (/[^0-9.,]/.test(inputValue)) {
                        // Display an error message
                        errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                        saveButton.disabled = true;
                    } else {
                        // Remove the error message if the input is valid
                        errorMessageElement.textContent = "";

                        // Remove any characters other than numbers and periods (keep periods for decimals)
                        var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                        // Split the cleaned value into the integer and decimal parts
                        var parts = cleanedValue.split(".");
                        var integerPart = parts[0];
                        var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                        // Format the integer part with commas
                        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        // Combine the formatted integer part with the decimal part
                        var formattedValue = integerPart + decimalPart;

                        // Update the input field with the formatted value
                        inputElement.value = formattedValue;

                        saveButton.disabled = false;
                    }
                }

                function formatSIAmount2() {
                    var inputElement = document.getElementById("pay_amount2");
                    var errorMessageElement = document.getElementById("error-message3");
                    var saveButton = document.getElementById("saveButton");
                    var inputValue = inputElement.value;

                    // Check if the input contains any invalid characters
                    if (/[^0-9.,]/.test(inputValue)) {
                        // Display an error message
                        errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                        saveButton.disabled = true;
                    } else {
                        // Remove the error message if the input is valid
                        errorMessageElement.textContent = "";

                        // Remove any characters other than numbers and periods (keep periods for decimals)
                        var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                        // Split the cleaned value into the integer and decimal parts
                        var parts = cleanedValue.split(".");
                        var integerPart = parts[0];
                        var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                        // Format the integer part with commas
                        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        // Combine the formatted integer part with the decimal part
                        var formattedValue = integerPart + decimalPart;

                        // Update the input field with the formatted value
                        inputElement.value = formattedValue;

                        saveButton.disabled = false;
                    }
                }

                function formatSIAmount3() {
                    var inputElement = document.getElementById("si_amount");
                    var errorMessageElement = document.getElementById("error-message3");
                    var saveButton = document.getElementById("saveButton");
                    var inputValue = inputElement.value;

                    // Check if the input contains any invalid characters
                    if (/[^0-9.,]/.test(inputValue)) {
                        // Display an error message
                        errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                        saveButton.disabled = true;
                    } else {
                        // Remove the error message if the input is valid
                        errorMessageElement.textContent = "";

                        // Remove any characters other than numbers and periods (keep periods for decimals)
                        var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                        // Split the cleaned value into the integer and decimal parts
                        var parts = cleanedValue.split(".");
                        var integerPart = parts[0];
                        var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                        // Format the integer part with commas
                        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        // Combine the formatted integer part with the decimal part
                        var formattedValue = integerPart + decimalPart;

                        // Update the input field with the formatted value
                        inputElement.value = formattedValue;

                        saveButton.disabled = false;
                    }
                }

                function formatReturnAmount() {
                    var inputElement = document.getElementById("return_amount");
                    var errorMessageElement = document.getElementById("error-message3");
                    var saveButton = document.getElementById("saveButton");
                    var inputValue = inputElement.value;

                    // Check if the input contains any invalid characters
                    if (/[^0-9.,]/.test(inputValue)) {
                        // Display an error message
                        errorMessageElement.textContent = "Invalid input. Please enter only numbers, commas, and periods.";
                        saveButton.disabled = true;
                    } else {
                        // Remove the error message if the input is valid
                        errorMessageElement.textContent = "";

                        // Remove any characters other than numbers and periods (keep periods for decimals)
                        var cleanedValue = inputValue.replace(/[^0-9.]/g, '');

                        // Split the cleaned value into the integer and decimal parts
                        var parts = cleanedValue.split(".");
                        var integerPart = parts[0];
                        var decimalPart = parts[1] !== undefined ? "." + parts[1].slice(0, 2) : "";

                        // Format the integer part with commas
                        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                        // Combine the formatted integer part with the decimal part
                        var formattedValue = integerPart + decimalPart;

                        // Update the input field with the formatted value
                        inputElement.value = formattedValue;

                        saveButton.disabled = false;
                    }
                }
                

                function validateReturnAmount(maxValue) {
                    let stringWithCommas = document.getElementById('return_amount').value;
                    let stringWithoutCommas = stringWithCommas.replace(/,/g, '');
                    const returnAmount = parseFloat(stringWithoutCommas);

                    console.log(returnAmount);

                    if (returnAmount > maxValue) {
                        document.getElementById('error-message3').textContent = 'Return amount cannot exceed ' + maxValue;
                        document.getElementById('return_amount').value = maxValue.toFixed(2); // Set it to the max value
                    } else {
                        document.getElementById('error-message3').textContent = ''; // Clear the error message
                    }
                }

                function validateSIAmount(maxValue) {
                    let stringWithCommas = document.getElementById('si_amount').value;
                    let stringWithoutCommas = stringWithCommas.replace(/,/g, '');
                    const siAmount = parseFloat(stringWithoutCommas);
                    
                    console.log(siAmount);
                    if (siAmount > maxValue) {
                        document.getElementById('error-message3').textContent = 'SI amount cannot exceed ' + maxValue;
                        document.getElementById('si_amount').value = maxValue.toFixed(2); // Set it to the max value
                    } else {
                        document.getElementById('error-message3').textContent = ''; // Clear the error message
                    }
                }

            </script>
        <?php
        }

        public function change_check_op()
        {
             
            $this->Model_Cashier_Sm->changeCheckOp($_POST['ids'],$_POST['denomid']);
            echo 'yes';
            //var_dump($uid);
            
        }

        public function change_check_xt() //edit today
        {
             
            $this->Model_Cashier_Sm->changeCheckXt($_POST['ids'],$_POST['denomid']);
            echo 'yes';
            //var_dump($uid);
            
        }

        public function update_inc_xt() 
        {
             
            $check2 = $this->Model_Export->sm_inc_bal_xtruck($_POST['ids']);

            $user_id            = $this->Model_Export->getUserId($_POST['ids']);
            
            $total_inc_amount = $this->Model_Export->get_total_inc($_POST['ids']);

            $applied = $this->Model_Export->getIncentivesAppliedLedger($_POST['ids']);
            
            $inc_balance = floatval($total_inc_amount) - floatval($applied);

            // var_dump($_POST['ids']);
            // var_dump($total_inc_amount);
            // var_dump($applied);
            // var_dump($inc_balance);
            // die();
            if ($check2 == false) {

                //echo 'saved';
                $data2 = array(
                    
                    
                    'sm_code'    => $this->security->xss_clean($_POST['ids']),
                    'inc_balance'   => $this->security->xss_clean($inc_balance)
                    
                    
                );

                $this->Model_Export->insertldismincbalxtruck($data2);
            }else{
                $data3 = array(
                    
                    
                    'sm_code'    => $this->security->xss_clean($_POST['ids']),
                    'inc_balance'   => $inc_balance
                    
                    
                );

                $this->Model_Export->updatesmincbalxtruck($data3);
            }
            echo 'yes';
            //var_dump($uid);
            
        }

        

        public function delete_check_op()
        {
             
            $this->Model_Cashier_Sm->deleteCheckOp($_POST['ids'],$_POST['denomid']);
            echo 'yes';
            //var_dump($uid);
            
        }

        public function delete_check_xt() 
        {
            
                
            $result = $this->Model_Cashier_Sm->deleteCheckXt($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_palawan_xt() 
        {
            
                
            $result = $this->Model_Cashier_Sm->deletePalawanXt($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_palawan_op() 
        {
            
            $result = $this->Model_Cashier_Sm->deletePalawanOp($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_bo_op() 
        {
            
            $result = $this->Model_Cashier_Sm->deleteBoOp($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_satellite_xt() 
        {
            
            $result = $this->Model_Cashier_Sm->deleteSatelliteXt($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_utc_xt() 
        {
            
            $result = $this->Model_Cashier_Sm->deleteUtcXt($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_ret_op() 
        {
            
                
            $result = $this->Model_Cashier_Sm->deleteReturnOp($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function delete_ret_xt() 
        {
            
                
            $result = $this->Model_Cashier_Sm->deleteReturnXt($_POST['ids']);
            
            // Check the result of the deletion
            if ($result) {
                echo 'yes';
            } else {
                echo 'Failed to delete the record(s).';
            }
            
        }

        public function unfile_denom_xt() 
        {
            $denomid = $this->input->post('srr_no');
            // var_dump($denomid);
            // die();

            $result1 = $this->Model_Cashier_Sm->unfileDenomXt($denomid);
            $result2 = $this->Model_Cashier_Sm->updateStatusPayXt($denomid);
            $result3 = $this->Model_Cashier_Sm->updateStatusSatXt($denomid);
            $result4 = $this->Model_Cashier_Sm->updateStatusPalXt($denomid);
            $result5 = $this->Model_Cashier_Sm->updateStatusRetXt($denomid);
            $result6 = $this->Model_Cashier_Sm->updateIncentives($denomid);
            $result7 = $this->Model_Cashier_Sm->updateStatusUtcXt($denomid);


            // Check if all operations are successful
            if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7) {
                echo 'yes';
            } else {
                echo 'Failed to unfile denomination and update statuses.';
            }
        }

        
        public function untag_denom_xt() 
        {
            $denomid = $this->input->post('srr_no');
            // var_dump($denomid);
            // die();

            $result1 = $this->Model_Cashier_Sm->untagDenomXt($denomid);
            


            // Check if all operations are successful
            if ($result1) {
                echo 'yes';
            } else {
                echo 'Failed to untag denomination and update statuses.';
            }
        }
        

        public function unfile_denom_op() 
        {
            $denomid = $this->input->post('srr_no');
            // var_dump($denomid);
            // die();

            $result1 = $this->Model_Cashier_Sm->unfileDenomXt($denomid);
            $result2 = $this->Model_Cashier_Sm->updateStatusPayOp($denomid);
            // $result3 = $this->Model_Cashier_Sm->updateStatusSatXt($denomid);
            $result4 = $this->Model_Cashier_Sm->updateStatusPalOp($denomid);
            $result5 = $this->Model_Cashier_Sm->updateStatusRetOp($denomid);
            $result6 = $this->Model_Cashier_Sm->updateStatusBoOp($denomid);


            // Check if all operations are successful
            // if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6) {
            if ($result1 && $result2 && $result4 && $result5 && $result6) {
                echo 'yes';
            } else {
                echo 'Failed to unfile denomination and update statuses.';
            }
        }

        

        public function cash_to_check_op()
        {
            $result = $this->Model_Cashier_Sm->getPayment($this->input->post('ids'));
            
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>

                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->check_type=='Post Dated Check'){$pdc='checked';}else{$pdc='';}
                    if($result->check_type=='Dated Check'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated Check" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated Check" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Due Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->pay_amount, 2, '.', '').'" readonly>
                        </div>
                    </div>

                    

                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
                ?>
                <script>
                    $('#edit_sm_payment3').on("submit", function(e){
                    $("#editSmCheck").modal("hide");
                    var formData = new FormData($(this)[0]);
                    e.preventDefault();
                    var flag = 0;
                    swal({
                        title: "Are you sure to convert this CASH payment to CHECK?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                        },
                        
                        function(isConfirm) {
                            if(isConfirm)
                            {
                                $.ajax({
                                url: baseurl + 'cash_to_check_payment_ldi',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                error: function() {
                                    alert('yes');
                                },
                                success: function(data) {
                                    if(data=='exist')
                                    {
                                        swal({
                                            title: "Check no. is already used by another Salesman or Cashier!",
                                            type: "error",
                                            showCancelbutton: false,
                                            closeModal: false
                                        });
                                    }  
                                    else
                                    {
                                        $("#editSmCheck").modal("hide");
                                        swal({
                                            title: "Payment successfully updated!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                window.location.reload();
                                            }
                                        }
                                        );
                                    }
                                }
                            });
                            }else{
                                $("#editSmCheck").modal("show");
                            }
                        }
                        );
                });
                </script>        

        <?php
        }

        public function cash_to_check_xt()
        {
            $result = $this->Model_Cashier_Sm->getPayment3($this->input->post('ids'));
            
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>

                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if(@$result->check_type=='Post Dated'){$pdc='checked';}else{$pdc='';}
                    if(@$result->check_type=='Dated'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Due Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->cash_amount, 2, '.', '').'" readonly>
                        </div>
                    </div>

                    

                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
                ?>
                <script>
                    $('#edit_sm_payment3').on("submit", function(e){
                    $("#editSmCheck").modal("hide");
                    var formData = new FormData($(this)[0]);
                    e.preventDefault();
                    var flag = 0;
                    swal({
                        title: "Are you sure to convert this CASH payment to CHECK?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                        },
                        
                        function(isConfirm) {
                            if(isConfirm)
                            {
                                $.ajax({
                                url: baseurl + 'cash_to_check_payment_xt',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                error: function() {
                                    alert('yes');
                                },
                                success: function(data) {
                                    if(data=='exist')
                                    {
                                        swal({
                                            title: "Check no. is already used by another Salesman or Cashier!",
                                            type: "error",
                                            showCancelbutton: false,
                                            closeModal: false
                                        });
                                    }  
                                    else
                                    {
                                        $("#editSmCheck").modal("hide");
                                        swal({
                                            title: "Payment successfully updated!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                window.location.reload();
                                            }
                                        }
                                        );
                                    }
                                }
                            });
                            }else{
                                $("#editSmCheck").modal("show");
                            }
                        }
                        );
                });
                </script>        

        <?php
        }

        public function edit_ret_check_ext()
        {
            $result = $this->Model_Cashier_Sm->getPayment3($_POST['ids']);
            $collection = 0.00;
            $remittance = 0.00;

            $dc_amt = 0.00;
            $pdc_amt = 0.00;

            $result_denom = $this->Model_Cashier_Sm->getSmDenombyDenomIdExt($this->input->post('denomid'));

            $collection = $result_denom->total_remittance - $result->check_amount;
            $remittance = $result_denom->total_collection - $result->check_amount;
            $dc_pc      = ($result->check_type == 'Dated') ? ($result_denom->dc_pcs - 1) : $result_denom->dc_pcs;
            $pdc_pc     = ($result->check_type == 'Post Dated') ? ($result_denom->pdc_pcs - 1) : $result_denom->pdc_pcs;

            $dc_amt     = ($result->check_type == 'Dated') ? ($result_denom->total_dc - $result->check_amount) : $result_denom->total_dc;
            $pdc_amt    = ($result->check_type == 'Post Dated') ? ($result_denom->total_pdc - $result->check_amount) : $result_denom->total_pdc;

        
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="si" id="si" autocomplete="off" value="'.@$result->si_docno.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="sm_code" id="sm_code" autocomplete="off" value="'.@$result->sm_code.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="sm_type" id="sm_type" autocomplete="off" value="'.@$result->sm_type.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="ref_no" id="ref_no" autocomplete="off" value="'.@$result->ref_no.'" required>

                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="collection" id="collection" autocomplete="off" value="'.@$collection.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="remittance" id="remittance" autocomplete="off" value="'.@$remittance.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="dc_pc" id="dc_pc" autocomplete="off" value="'.@$dc_pc.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="pdc_pc" id="pdc_pc" autocomplete="off" value="'.@$pdc_pc.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="dc_amt" id="dc_amt" autocomplete="off" value="'.@$dc_amt.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="pdc_amt" id="pdc_amt" autocomplete="off" value="'.@$pdc_amt.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" autocomplete="off" value="'.@$result_denom->denom_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cur_stat" id="cur_stat" autocomplete="off" value="'.@$result->status5.'" required>


                            
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->check_type=='Post Dated'){$pdc='checked';}else{$pdc='';}
                    if($result->check_type=='Dated'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Check Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->check_amount, 2, '.', '').'" required>
                        </div>
                    </div>

                    

                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
                ?>
                <script>
                    $('#edit_sm_payment3').on("submit", function(e){
                    var formData = new FormData($(this)[0]);
                    e.preventDefault();
                    var flag = 0;
                    $("#editSmCheck").modal("hide");
                    swal({
                        title: "Proceed updating returned check payment?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                        },
                        
                        function(isConfirm) {
                            if(isConfirm)
                            {
                                $.ajax({
                                url: baseurl + 'edit_ret_payment_ext',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                error: function() {
                                    alert('yes');
                                },

                                
                                success: function(data) {
                                    if(data=='exist')
                                    {
                                        swal({
                                            title: "Check no. is already used by another Salesman or Cashier!",
                                            type: "error",
                                            showCancelbutton: false,
                                            closeModal: false
                                        });
                                    }  
                                    else
                                    {
                                        $("#editSmCheck").modal("hide");
                                        swal({
                                            title: "Payment successfully updated!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                window.location.reload();
                                            }
                                        }
                                        );
                                    }
                                }
                            });
                            }else{
                                $("#editSmCheck").modal("show");
                            }
                        }
                        );
                });
                </script>  
                <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank">Check Status</label>';
                                $isDisabled = ($result->status5 == 'Returned') ? 'disabled' : '';
                        echo   '<select class="form-control" name="checkstatus" id="checkstatus" '.$isDisabled.' >
                                <option value=""></option>';
                                    $selectedCleared = ($result->status5 == 'Cleared') ? 'selected' : '';
                                    $selectedReturned = ($result->status5 == 'Returned') ? 'selected' : '';
                        echo   '<option value="Cleared" '.$selectedCleared.'>Cleared</option>
                                <option value="Returned" '.$selectedReturned.'>Returned</option>
                            </select>
                        </div>
                    </div>       -->

        <?php
        }

        public function edit_ret_check_op()
        {
            $result = $this->Model_Cashier_Sm->getPayment($_POST['ids']);
           

        
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment3">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.@$result->pay_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="si" id="si" autocomplete="off" value="'.@$result->si_docno.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="sm_code" id="sm_code" autocomplete="off" value="'.@$result->sm_code.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="sm_name" id="sm_name" autocomplete="off" value="'.@$result->sm_name.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="jefe_code" id="jefe_code" autocomplete="off" value="'.@$result->jefe_code.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="jefe_name" id="jefe_name" autocomplete="off" value="'.@$result->jefe_name.'" required>

                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="si_date" id="si_date" autocomplete="off" value="'.@$result->si_date.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="ref_no" id="ref_no" autocomplete="off" value="'.@$result->ref_no.'" required>

                            


                            
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.@$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.@$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->check_type=='Post Dated Check'){$pdc='checked';}else{$pdc='';}
                    if($result->check_type=='Dated Check'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated Check" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated Check" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Check Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->check_amount, 2, '.', '').'" required>
                        </div>
                    </div>

                    

                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
                ?>
                <script>
                    $('#edit_sm_payment3').on("submit", function(e){
                    var formData = new FormData($(this)[0]);
                    e.preventDefault();
                    var flag = 0;
                    $("#editSmCheck").modal("hide");
                    swal({
                        title: "Proceed updating OPLAN returned check payment?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                        },
                        
                        function(isConfirm) {
                            if(isConfirm)
                            {
                                $.ajax({
                                url: baseurl + 'edit_ret_payment_op',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                error: function() {
                                    alert('yes');
                                },

                                
                                success: function(data) {
                                    if(data=='exist')
                                    {
                                        swal({
                                            title: "Check no. is already used by another Salesman or Cashier!",
                                            type: "error",
                                            showCancelbutton: false,
                                            closeModal: false
                                        });
                                    }  
                                    else
                                    {
                                        $("#editSmCheck").modal("hide");
                                        swal({
                                            title: "Payment successfully updated!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                window.location.reload();
                                            }
                                        }
                                        );
                                    }
                                }
                            });
                            }else{
                                $("#editSmCheck").modal("show");
                            }
                        }
                        );
                });
                </script>  
                <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank">Check Status</label>';
                                $isDisabled = ($result->status5 == 'Returned') ? 'disabled' : '';
                        echo   '<select class="form-control" name="checkstatus" id="checkstatus" '.$isDisabled.' >
                                <option value=""></option>';
                                    $selectedCleared = ($result->status5 == 'Cleared') ? 'selected' : '';
                                    $selectedReturned = ($result->status5 == 'Returned') ? 'selected' : '';
                        echo   '<option value="Cleared" '.$selectedCleared.'>Cleared</option>
                                <option value="Returned" '.$selectedReturned.'>Returned</option>
                            </select>
                        </div>
                    </div>       -->

        <?php
        }

        public function edit_sm_check()
        {
            $result         = $this->Model_Cashier_Sm->getPayment($_POST['ids']);

            // $result = $this->Model_Cashier_Sm->getPayment3($_POST['ids']);
            $collection = 0.00;
            $remittance = 0.00;

            $dc_amt = 0.00;
            $pdc_amt = 0.00;

            $result_denom = $this->Model_Cashier_Sm->getSmDenombyDenomIdOplan($this->input->post('denomid'));

            $collection = $result_denom->total_remittance - $result->pay_amount;
            $remittance = $result_denom->total_collection - $result->pay_amount;
            $dc_pc      = ($result->check_type == 'Dated Check') ? ($result_denom->dc_pcs - 1) : $result_denom->dc_pcs;
            $pdc_pc     = ($result->check_type == 'Post Dated Check') ? ($result_denom->pdc_pcs - 1) : $result_denom->pdc_pcs;

            $dc_amt     = ($result->check_type == 'Dated Check') ? ($result_denom->total_dc - $result->pay_amount) : $result_denom->total_dc;
            $pdc_amt    = ($result->check_type == 'Post Dated Check') ? ($result_denom->total_pdc - $result->pay_amount) : $result_denom->total_pdc;

            
            $bank_result    = $this->Model_Cashier_Sm->getBankData();
            echo '<form method="post" id="edit_sm_payment2">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="code">Code</label>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" autocomplete="off" value="'.$result->pay_id.'" required>

                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="collection" id="collection" autocomplete="off" value="'.@$collection.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="remittance" id="remittance" autocomplete="off" value="'.@$remittance.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="dc_pc" id="dc_pc" autocomplete="off" value="'.@$dc_pc.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="pdc_pc" id="pdc_pc" autocomplete="off" value="'.@$pdc_pc.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="dc_amt" id="dc_amt" autocomplete="off" value="'.@$dc_amt.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="pdc_amt" id="pdc_amt" autocomplete="off" value="'.@$pdc_amt.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" autocomplete="off" value="'.@$result_denom->denom_id.'" required>
                            <input type="hidden" class="form-control" style="text-align: center;background-color: white" name="cur_stat" id="cur_stat" autocomplete="off" value="'.@$result->status3.'" required>
                            
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="code1" id="code1" value="'.$result->cus_code.'" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="name1" id="name1" autocomplete="off" value="'.$result->name.'" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name"></label>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-controls-modal="#customerModal2" data-backdrop="static" data-keyboard="false" data-target="#customerModal2" onclick=customer_masterfile2()>Select Customer</button>
                        </div>
                    </div>
                    <div class="form-row">';
                    if($result->check_type=='Post Dated Check'){$pdc='checked';}else{$pdc='';}
                    if($result->check_type=='Dated Check'){$dc='checked';}else{$dc='';}
                echo   '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="DC" value="Dated Check" '.$dc.' required>
                            <label class="form-check-label" for="DC">Dated Check (DC)</label>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated Check" '.$pdc.' required>
                            <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="checkno">Check No.</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duedate">Check Date</label>
                            <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="accname">Account Name</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="accnum">Account Number</label>
                            <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="bank">Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                <option></option>';
                                // foreach($bank_result as $row3) {
                                //     if($row3["code"]==$result->check_bank){$select="selected";}else{$select="";}
                                //     echo '<option value="'.$row3["code"].'" '.$select.'>'.$row3["code"].'-'.$row3["name"].'</option>';
                                // }
                                foreach($bank_result as $row3) {
                                    if($row3["code2"]==$result->check_bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code2"].'" '.$select.'>'.$row3["code2"].'-'.$row3["name"].'</option>';
                                }
                    echo   '</select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amount">Check Amount</label>
                            <input type="number" min="0.1" step="any" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.$result->pay_amount.'" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="bank">Check Status</label>';
                                $isDisabled = ($result->status3 == 'Returned') ? 'disabled' : '';
                        echo   '<select class="form-control" name="checkstatus" id="checkstatus" '.$isDisabled.' >
                                <option value=""></option>';
                                    $selectedCleared = ($result->status3 == 'Cleared') ? 'selected' : '';
                                    $selectedReturned = ($result->status3 == 'Returned') ? 'selected' : '';
                        echo   '<option value="Cleared" '.$selectedCleared.'>Cleared</option>
                                <option value="Returned" '.$selectedReturned.'>Returned</option>
                            </select>
                        </div>
                    </div>

                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Payment</button>
                </form>';
                ?>
                <script>
                    $('#edit_sm_payment2').on("submit", function(e){
                    var formData = new FormData($(this)[0]);
                    e.preventDefault();
                    var flag = 0;
                    swal({
                        title: "Proceed updating payment?",
                        text: "",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        cancelButtonText: "No",
                        confirmButtonText: "Yes",
                        closeOnConfirm: false,
                        closeOnCancel: true,
                        showLoaderOnConfirm: true
                        },
                        
                        function(isConfirm) {
                            if(isConfirm)
                            {
                                $.ajax({
                                url: baseurl + 'edit_sm_payment_ldi',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                error: function() {
                                    alert('yes');
                                },
                                success: function(data) {
                                    if(data=='exist')
                                    {
                                        swal({
                                            title: "Check no. is already used by another Salesman or Cashier!",
                                            type: "error",
                                            showCancelbutton: false,
                                            closeModal: false
                                        });
                                    }  
                                    else
                                    {
                                        $("#editSmCheck").modal("hide");
                                        swal({
                                            title: "Payment successfully updated!",
                                            type: "success",
                                            showCancelbutton: false,
                                            closeModal: false
                                        },
                                        function(isok) {
                                            if(isok){
                                                window.location.reload();
                                            }
                                        }
                                        );
                                    }
                                }
                            });
                            }
                        }
                        );
                });
                </script>        

        <?php
        }
    }
?>