<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Cashier_Sm extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Cashier_Sm');
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

        public function checkclearingdate()
        {
            $this->load->view('header');
            $this->load->view('checkclearing_date');
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
            $this->load->view('colsumdate');
            $this->load->view('footer');
        }

        public function colsumreport($date)
        {
            $data['result'] = $date;
            $data['result1'] = $this->Model_Cashier_Sm->colsum($date);
            $data['result3'] = $this->Model_Cashier_Sm->getBu();
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

        public function pdcdcreport($date,$type,$date1)
        {
            $data['result'] = $date;
            $data['result3'] = $date1;
            $data['result1'] = $this->Model_Cashier_Sm->pdcdc($date,$type,$date1);
            $data['result2'] = $type;
            $this->load->view('pdcdc_report', $data);
        }

        public function pdcdcreport2($date,$type,$date1)
        {
            $data['result'] = $date;
            $data['result3'] = $date1;
            $data['result1'] = $this->Model_Cashier_Sm->pdcdc($date,$type,$date1);
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

        public function cashiersm_payment_data($date)
        {
            $data['result'] = $this->Model_Cashier_Sm->getSmDenombyDate($date);
            $data['result2'] = $date;
            $this->load->view('header');
            $this->load->view('cashier_smdenom_ledger', $data);
            $this->load->view('footer');
        }

        // public function upload_payments()
        // {
        //     $denom_id = $this->input->post('ids');
        //     $result = $this->Model_Cashier_Sm->getSmIds($denom_id);
        //     $result2 = $this->Model_Cashier_Sm->getPayments($result->date_added,$result->id_no);
        //     $result4 = $this->Model_Cashier_Sm->getReturns($result->id_no);
        //     $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));

        //     $connection = $result3->ar_connection;
        //     $username = $result3->db_username;
        //     $password = $result3->db_password;

        //     @$connect = odbc_connect($connection, $username, $password);

        //     var_dump($connection, $username, $password);


        //     foreach($result2 as $row)
        //     {
        //         if($row['status']!='Uploaded')
        //         {
                    
        //             $payDate = date('Y-m-d H:i:s', strtotime($row['pay_date']));
        //             $siDate = date('Y-m-d H:i:s', strtotime($row['si_date']));
        //             $dueDate = date('Y-m-d H:i:s', strtotime($row['due_date']));

        //             // Assuming $row['pay_amount'] is a valid numeric value
        //             $payAmount = floatval($row['pay_amount']);

        //             $sql_query = "INSERT INTO payments_mw(
        //                                         pay_date,
        //                                         si_docno,
        //                                         si_date,
        //                                         cus_code,
        //                                         pay_amount,
        //                                         pay_type,
        //                                         check_no,
        //                                         due_date,
        //                                         acc_no,
        //                                         acc_name,
        //                                         check_bank,
        //                                         sm_code,
        //                                         ref_no,
        //                                         check_type,
        //                                         stats,
        //                                         applied_by) 
        //                                         VALUES(
        //                                             '".$payDate."',
        //                                             '".$row['si_docno']."',
        //                                             '".$siDate."',
        //                                             '".$row['cus_code']."',
        //                                             '".$payAmount."',
        //                                             '".$row['pay_type']."',
        //                                             '".$row['check_no']."',
        //                                             '".$dueDate."',
        //                                             '".$row['acc_no']."',
                    
        //                                             '".$row['acc_name']."',
        //                                             '".$row['check_bank']."',
        //                                             '".$row['sm_code']."',
        //                                             '".$row['ref_no']."',
        //                                             '".$row['check_type']."',
        //                                             '',
        //                                             '')";
        //             //odbc_exec($connect,$sql_query);

        //             $result = odbc_exec($connect, $sql_query);

        //             // Check if the query was successful
        //             if ($result) {
        //                 // If successful, update payment status
        //                 $this->Model_Cashier_Sm->updatePaymentStatus($row['pay_id']);
        //             } else {
        //                 // Handle the case where the query fails, you might want to log an error or take other actions
        //                 echo "Error executing query: " . odbc_errormsg($connect);
        //             }
        //         }
        //     }

        //     foreach($result4 as $row2)
        //     {
        //         if($row2['status']!='Uploaded')
        //         {
                    
        //             $retDate    = date('Y-m-d H:i:s', strtotime($row2['return_date']));
        //             $siDate     = date('Y-m-d H:i:s', strtotime($row2['si_date']));

        //             $siAmount   = floatval($row2['si_amount']);
        //             $retAmount  = floatval($row2['si_amount']);
        //             $reason     = 'Return';

        //             $sql_query2 = "INSERT INTO return_mw(
        //                                         retdate,
        //                                         si_docno,
        //                                         si_date,
        //                                         cus_code,
        //                                         cus_name,
        //                                         si_amount,
        //                                         retamount,
        //                                         reason,
        //                                         sman,
        //                                         sm_code,
        //                                         hepe,
        //                                         hepe_code,
        //                                         stats,
        //                                         applied_by) 
        //                                         VALUES(
        //                                             '".$retDate."',
        //                                             '".$row2['si_docno']."',
        //                                             '".$siDate."',
        //                                             '".$row2['cus_code']."',
        //                                             '".$row2['cus_name']."',
        //                                             '".$siAmount."',
        //                                             '".$retAmount."',
        //                                             '".$reason."',
        //                                             '".$row2['sm_code']."',
        //                                             '".$row2['sm_name']."',
        //                                             '".$row2['hepe_code']."',
        //                                             '".$row2['hepe_name']."',
        //                                             '',
        //                                             '')";
        //             //odbc_exec($connect,$sql_query);

        //             $result2 = odbc_exec($connect, $sql_query2);

        //             // Check if the query was successful
        //             if ($result2) {
        //                 // If successful, update payment status
        //                 $this->Model_Cashier_Sm->updateReturnStatus($row2['return_no']);
        //             } else {
        //                 // Handle the case where the query fails, you might want to log an error or take other actions
        //                 echo "Error executing query: " . odbc_errormsg($connect);
        //             }
        //         }
        //     }

        //     // odbc_close($connect);

        //     echo 'yes';
        // }

        public function upload_payments()
        {
            try {
                $denom_id = $this->input->post('ids');
                $result = $this->Model_Cashier_Sm->getSmIds($denom_id);
                $result2 = $this->Model_Cashier_Sm->getPayments($result->date_added,$result->id_no);
                $result4 = $this->Model_Cashier_Sm->getReturns($result->id_no);
                $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));

                $connection = $result3->ar_connection;
                $username = $result3->db_username;
                $password = $result3->db_password;

                @$connect = odbc_connect($connection, $username, $password);

                var_dump($connection, $username, $password);

                foreach($result2 as $row)
                {
                    if($row['status']!='Uploaded')
                    {
                        
                        $payDate = date('Y-m-d H:i:s', strtotime($row['pay_date']));
                        $siDate = date('Y-m-d H:i:s', strtotime($row['si_date']));
                        $dueDate = date('Y-m-d H:i:s', strtotime($row['due_date']));

                        // Assuming $row['pay_amount'] is a valid numeric value
                        $payAmount = floatval($row['pay_amount']);

                        $sql_query = "INSERT INTO payments_mw(
                                                    pay_date,
                                                    si_docno,
                                                    si_date,
                                                    cus_code,
                                                    pay_amount,
                                                    pay_type,
                                                    check_no,
                                                    due_date,
                                                    acc_no,
                                                    acc_name,
                                                    check_bank,
                                                    sm_code,
                                                    ref_no,
                                                    check_type,
                                                    stats,
                                                    applied_by) 
                                                    VALUES(
                                                        '".$payDate."',
                                                        '".$row['si_docno']."',
                                                        '".$siDate."',
                                                        '".$row['cus_code']."',
                                                        '".$payAmount."',
                                                        '".$row['pay_type']."',
                                                        '".$row['check_no']."',
                                                        '".$dueDate."',
                                                        '".$row['acc_no']."',
                        
                                                        '".$row['acc_name']."',
                                                        '".$row['check_bank']."',
                                                        '".$row['sm_code']."',
                                                        '".$row['ref_no']."',
                                                        '".$row['check_type']."',
                                                        '',
                                                        '')";
                        //odbc_exec($connect,$sql_query);

                        $result = odbc_exec($connect, $sql_query);

                        // Check if the query was successful
                        if ($result) {
                            // If successful, update payment status
                            $this->Model_Cashier_Sm->updatePaymentStatus($row['pay_id']);
                        } else {
                            // Handle the case where the query fails, you might want to log an error or take other actions
                            echo "Error executing query: " . odbc_errormsg($connect);
                        }
                    }
                }

                // foreach($result4 as $row2)
                // {
                //     if($row2['status']!='Uploaded')
                //     {
                        
                //         $retDate    = date('Y-m-d H:i:s', strtotime($row2['return_date']));
                //         $siDate     = date('Y-m-d H:i:s', strtotime($row2['si_date']));

                //         $siAmount   = floatval($row2['si_amount']);
                //         // $retAmount  = floatval($row2['return_amount']);
                //         $retAmount = -1 * floatval($row2['return_amount']);

                //         $reason     = 'Return';

                //         $sql_query2 = "INSERT INTO return_mw(
                //                                     retdate,
                //                                     si_docno,
                //                                     si_date,
                //                                     cus_code,
                //                                     cus_name,
                //                                     si_amnt,
                //                                     retamnt,
                //                                     reason,
                //                                     sman,
                //                                     sm_code,
                //                                     hepe,
                //                                     hepe_code,
                //                                     stats,
                //                                     applied_by) 
                //                                     VALUES(
                //                                         '".$retDate."',
                //                                         '".$row2['si_docno']."',
                //                                         '".$siDate."',
                //                                         '".$row2['cus_code']."',
                //                                         '".$row2['cus_name']."',
                //                                         '".$siAmount."',
                //                                         '".$retAmount."',
                //                                         '".$reason."',
                //                                         '".$row2['sm_name']."',
                //                                         '".$row2['sm_code']."',
                //                                         '".$row2['hepe_name']."',
                //                                         '".$row2['hepe_code']."',
                //                                         '',
                //                                         '')";
                //         //odbc_exec($connect,$sql_query);

                //         $result2 = odbc_exec($connect, $sql_query2);

                //         // Check if the query was successful
                //         if ($result2) {
                //             // If successful, update payment status
                //             $this->Model_Cashier_Sm->updateReturnStatus($row2['return_no']);
                //         } else {
                //             // Handle the case where the query fails, you might want to log an error or take other actions
                //             echo "Error executing query: " . odbc_errormsg($connect);
                //         }
                //     }
                // }

                // Close the database connection
                odbc_close($connect);

                echo 'yes';
            } catch (Exception $e) {
                // Log any unexpected exceptions
                error_log("Exception: " . $e->getMessage());
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
            if($row->total_remittance==0)
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

        // public function approve_sm_denoms()
        // {
        //     $remittances = $this->Model_Cashier_Sm->check_remittances($_POST['ids']);

        //     $anyRemittanceZero = false;

        //     foreach ($remittances as $denom_id => $total_remittance) {
        //         if ($total_remittance == 0) {
        //             $anyRemittanceZero = true;
        //         }
        //     }

        //     if ($anyRemittanceZero) {
        //         echo 'zero';
        //     } else {
        //         // Proceed with approval logic
        //         $this->Model_Cashier_Sm->approveSmDenoms($_POST['ids']);
        //         echo 'yes';
        //     }
        // }

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




        public function disapprove_sm_denom()
        {
            $this->Model_Cashier_Sm->disapproveSmDenom($_POST['ids']);
        }

        public function check_entry_sm($id,$date,$userid)
        {
            $data['results'] = $this->Model_Cashier_Sm->getSmChecks($userid,$date,$id);
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

        // public function view_sm_checks()
        // {
        //     $userid     = $this->input->post('userid');
        //     $paydate    = $this->input->post('paydate');
        //     $results    = $this->Model_Cashier_Sm->getSmChecks($userid,$paydate);
        //     $row        = $this->Model_Cashier_Sm->getUserName($userid);
            
        //     echo '<div class="card mb-4">
        //             <div class="card-header">
        //                 <i class="fas fa-table mr-1"></i>
        //                 Payment check(s) of salesman - <b style="font-size: 20px">'.$row->full_name.'</b>
        //                 on <b style="font-size: 20px">'.date("F d, Y", strtotime($paydate)).'</b>
        //             </div>
        //             <div class="card-body">
        //                 <table class="table table-bordered sm_checks" width="100%" cellspacing="0">
        //                     <thead>
        //                         <tr align="center">
        //                             <th>Code</th>
        //                             <th>Name</th>
        //                             <th>Type</th>
        //                             <th>Check No.</th>
        //                             <th>Due Date</th>
        //                             <th>Bank</th>
        //                             <th>Amount</th>
        //                             <th></th>
        //                         </tr>
        //                     </thead>
        //                     <tbody>';
        //                         foreach($results as $row2) {
        //                   echo '<tr>
        //                             <td>'. $row2['cus_code'].'</td>
        //                             <td>'. $row2['name'].'</td>
        //                             <td align="center">'. $row2['type'].'</td>
        //                             <td align="center">'. $row2['check_no'].'</td>
        //                             <td align="center">'. $row2['due_date'].'</td>
        //                             <td align="center">'. $row2['bank'].'</td>
        //                             <td align="right">'. number_format($row2['amount'],2).'</td>';
        //                          if($row2['pay_date']==date('Y-m-d')) {
        //                     echo   '<td align="center">';
        //                             if($row2['status']=="") {
        //                            echo '<a title="Edit Check" style="color: green;cursor: pointer" data-toggle="modal" data-controls-modal="#editSmCheck" data-backdrop="static" data-keyboard="false" data-target="#editSmCheck" onclick=edit_sm_check('.$row2['payment_id'].')><i class="fas fa-pen"></i></a>&nbsp;&nbsp;';
        //                             }
        //                            echo '<a title="View Check" style="color: skyblue;cursor: pointer" onclick=deleteuser_content('.$row2['payment_id'].')><i class="fas fa-eye"></i></a>&nbsp;&nbsp;';
        //                            if($row2['status']=="") {
        //                            echo '<a title="Delete User" style="color: red;cursor: pointer" onclick=deleteuser_content('.$row2['payment_id'].')><i class="fas fa-trash"></i></a>';
        //                             }
        //                     echo   '</td>';
        //                             }
        //                             else
        //                             {
        //                     echo   '<td align="center">
        //                                 <a title="View Check" style="color: skyblue;cursor: pointer" onclick=deleteuser_content('.$row2['payment_id'].')><i class="fas fa-eye"></i></a>
        //                             </td>';
        //                             }
        //                    echo  '</tr>';
        //                         }
        //               echo '</tbody>
        //                 </table>
        //             </div>
        //         </div>';

                
                // <!-- <script>
                //     $('.sm_checks').DataTable( {
                //         "order": [[ 0, "desc" ]]
                //     } );
                // </script> -->        
        // }

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
                        <textarea class="form-control" autocomplete="off" rows="3" id="remarks" name="remarks">'.$result->remarks.'</textarea>
                    </div><br/>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save Remarks</button>';
        }

        public function cashier_backdate()
        {
            
            $date_from = $this->Model_Cashier_Sm->getDateFrom($_POST['ids']);
            $formatted_date = date("F d, Y",strtotime($date_from->date_added));
            $current_date = date('d-m-Y');
            echo '<div class="form-row">

                        <label for="date">Date From</label>
                            
                        
                        <input type="hidden" name="denomid" id="denomid" value="'.$_POST['ids'].'">
                        <input type="hidden" name="datef" id="datef" value="'.$date_from->date_added.'">
                        <input type="text" name="date_from" class="form-control" id="date_from" value="'.$formatted_date.'" readonly><br/>

                        <label for="date">Date To</label>
                           
                        <input type="date" name="date_to" id="date_to" class="form-control" id="date_to" max="'.$date_from->date_added.'"><br/><br>

                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary">Save </button>';
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

        public function save_remarks2()
        {
            $this->Model_Cashier_Sm->saveRemarks2();
        }

        public function save_backdate()
        {
            $this->Model_Cashier_Sm->saveBackdate();
        }

        public function edit_sm_check()
        {
            $result         = $this->Model_Cashier_Sm->getPayment($_POST['ids']);
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
                                    if($row3["code"]==$result->bank){$select="selected";}else{$select="";}
                                    echo '<option value="'.$row3["code"].'" '.$select.'>'.$row3["code"].'-'.$row3["name"].'</option>';
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
    }
?>