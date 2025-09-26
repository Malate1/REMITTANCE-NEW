<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Export extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Export');
            $this->load->model('Model_Cashier_Sm');
        }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('exporting');
            $this->load->view('footer');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        public function import()
        {
            $this->load->view('header');
            $this->load->view('importing');
            $this->load->view('footer');
        }

        public function importldi()
        {
            $this->load->view('header');
            $this->load->view('importingldi');
            $this->load->view('footer');
        }

        public function import_file()
        {
            $filePaths = $_FILES["filenames"]["tmp_name"];

            $data = file_get_contents($filePaths);
            $convert = explode("\n",$data);
            $tot = count($convert);

            if($tot == 0 || $tot < 2)
            {
                if($convert[0] == "")
                {
                    echo 'no-data';
                    return false;
                }
            }

            $file = fopen($filePaths, "r");

            for($i=0;$i<$tot;$i++)
            {
                if($convert[$i] != "")
				{
                    $explode = explode(";", $convert[$i]);
                    $size = count($explode);

                    if($size == 4)
					{
                        $code = trim($explode[0]);
                        $date = trim($explode[1]);
                        $customer = trim($explode[2]);
                        $amount = trim($explode[3]);
                    }
                    else
                    {
                        $code = "";
                        $date = "";
                        $amount = "";
                        $customer = "";
                        $user_id = 0;
                    }
                    if($this->Model_Export->checkUserid($code) == true)
                    {
                        $row = $this->Model_Export->getUserId($code);
                        
                        if($this->Model_Export->checkAccount($date,$code) == false)
                        {
                            $data = array(
                                'account_date' => $this->security->xss_clean($date),
                                'user_id' => $row->user_id,
                                'sm_code' => $this->security->xss_clean($code),
                                'amount' => $this->security->xss_clean($amount)
                            );

                            $this->Model_Export->insertAccount($data);
                        }
                        if($this->Model_Export->checkCustomer($date,$customer,$code) == false)
                        {
                            $data = array(
                                'collect_date' => $this->security->xss_clean($date),
                                'user_id' => $row->user_id,
                                'sm_code' => $this->security->xss_clean($code),
                                'cus_code' => $this->security->xss_clean($customer),
                                'status' => ''
                            );

                            $this->Model_Export->insertCustomer($data);
                        }
                    }
                }
            }

            echo 'success';
        }

        public function importldi_file()
        {
            $filePaths = $_FILES["filenames"]["tmp_name"];

            $data = file_get_contents($filePaths);
            $convert = explode("\n",$data);
            $tot = count($convert);

            if($tot == 0 || $tot < 2)
            {
                if($convert[0] == "")
                {
                    echo 'no-data';
                    return false;
                }
            }

            $file = fopen($filePaths, "r");

            $code_flag = 0;
            for($i=0;$i<$tot;$i++)
            {
                if($convert[$i] != "")
				{
                    $explode = explode("|", $convert[$i]);
                    $size = count($explode);

                    if($size == 14)
					{
                        $sm_code  = trim($explode[10]);
                        if($this->Model_Export->checkUserid($sm_code) == false)
                        {
                            $code_flag = 1;
                        }
                    }
                }
            }

            if($code_flag==0)
            {
                for($i=0;$i<$tot;$i++)
                {
                    if($convert[$i] != "")
                    {
                        $explode = explode("|", $convert[$i]);
                        $size = count($explode);

                        if($size == 14)
                        {
                            
                            $si_docno = trim($explode[0]);
                            $si_date = trim($explode[1]);
                            $pay_date  = trim($explode[2]);
                            $customer = trim($explode[3]);
                            $amount   = trim($explode[4]);
                            $pay_type = trim($explode[5]);
                            $check_no = trim($explode[6]);
                            $due_date = trim($explode[7]);
                            $acc_no   = trim($explode[8]);
                            $acc_name = trim($explode[9]);
                            $bank     = trim($explode[10]);
                            $sm_code  = trim($explode[11]);
                            $ref_no   = trim($explode[12]);
                            $check_type = trim($explode[13]);
                        }
                        else
                        {
                            $si_docno = "";
                            $si_date  = "";
                            $pay_date  = "";
                            $customer = "";
                            $amount   = "";
                            $pay_type = "";
                            $check_no = "";
                            $due_date = "";
                            $acc_no   = "";
                            $acc_name = "";
                            $bank     = "";
                            $sm_code  = "";
                            $ref_no   = "";
                            $check_type = "";
                        }
                        
                        if($this->Model_Export->paymentldi($si_docno) == false)
                        {
                            // $row = $this->Model_Export->getUserId($code);

                            // if($check_type=='Dated Check')
                            // {
                            //     $ctype = 'DC';
                            // }
                            // else
                            // {
                            //     $ctype = 'PDC';
                            // }

                            // $data1 = array(
                            //     'user_id' => $row->user_id,
                            //     'pay_date' => $this->security->xss_clean(date('Y-m-d')),
                            //     'cus_code' => $this->security->xss_clean($customer),
                            //     'type' => $this->security->xss_clean($ctype),
                            //     'check_no' => $this->security->xss_clean($check_no),
                            //     'due_date' => $this->security->xss_clean($due_date),
                            //     'acc_name' => $this->security->xss_clean($acc_name),
                            //     'acc_num' => $this->security->xss_clean($acc_no),
                            //     'bank' => $this->security->xss_clean($bank),
                            //     'amount' => $this->security->xss_clean($amount),
                            //     'entered_by' => $this->session->userdata('user_id'),
                            //     'update_time' => '',
                            //     'datetime' => date("Y-m-d h:i A"),
                            //     ''
                            // );

                            $data = array(
                                // 'pay_date' => $this->security->xss_clean(date('Y-m-d')),
                                'pay_date' => $this->security->xss_clean($pay_date),
                                'si_docno' => $this->security->xss_clean($si_docno),
                                'si_date' => $this->security->xss_clean($si_date),

                                'cus_code' => $this->security->xss_clean($customer),
                                'pay_amount' => $this->security->xss_clean($amount),
                                'pay_type' => $this->security->xss_clean($pay_type),
                                'check_no' => $this->security->xss_clean($check_no),
                                'due_date' => $this->security->xss_clean($due_date),
                                'acc_no' => $this->security->xss_clean($acc_no),
                                'acc_name' => $this->security->xss_clean($acc_name),
                                'check_bank' => $this->security->xss_clean($bank),
                                'sm_code' => $this->security->xss_clean($sm_code),
                                'ref_no' => $this->security->xss_clean($ref_no),
                                'check_type' => $this->security->xss_clean($check_type),
                                'status' => '',
                                'status2' => ''
                            );

                            $this->Model_Export->insertldipayment($data);
                        }
                    }
                }
                echo 'success';
            }
            else
            {
                echo 'nocode';
            }
        }

        public function importldi_file_test()
        {
            $currentDateTime = date('Y-m-d H:i:s');
            $currentTimestamp = time();

            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
            $apiEndpoint = "https://prebooking.ldi.sale/api/aris/export_aris?time=" .$currentTimestamp;

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            echo 'API Response: ' . $response;

            
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
               
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                $code_flag = 0;
                
                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);
                            //echo $size;
                            if ($size == 19 ) {
                            //if ($size == 18 ) {

                                $si_docno = trim($explode[0]);
                                $si_date = trim($explode[1]);
                                $pay_date  = trim($explode[2]);
                                $customer = trim($explode[3]);
                                $amount   = trim($explode[4]);
                                $pay_type = trim($explode[5]);
                                $check_no = trim($explode[6]);
                                $due_date = trim($explode[7]);
                                $acc_no   = trim($explode[8]);
                                $acc_name = trim($explode[9]);
                                $bank     = trim($explode[10]);
                                $jefe_code  = trim($explode[11]);
                                $jefe_name  = trim($explode[12]);
                                $ref_no   = trim($explode[13]);
                                $check_type = trim($explode[14]);
                                $tax_amount = trim($explode[15]);
                                $sm_code = trim($explode[16]);
                                $sm_name = trim($explode[17]);
                                $batch = trim($explode[18]);
                            

                                // ✅ Skip if CHECK with empty check_type
                                if (strtoupper($pay_type) === 'CHECK' && empty($check_type)) {

                                    $log_data = array(
                                        'log_time' => date('Y-m-d H:i:s'),
                                        'si_docno' => $si_docno,
                                        'ref_no' => $ref_no,
                                        'error_type' => 'Check details were not present at the time of import.',
                                        'api_response' => $response  // Save the raw API response
                                    );
                                    $this->db->insert('oplan_payments_import_logs', $log_data);
                                    continue;
                                }
                                $check = $this->Model_Export->paymentldi($si_docno,$pay_type, $check_no);
                                    //var_dump($check);
                                if ($this->Model_Export->paymentldi($si_docno,$pay_type,$check_no) == false) {

                                    //echo 'saved';
                                    $data = array(
                                        'pay_date' => $this->security->xss_clean($pay_date),
                                        // 'pay_date' => $this->security->xss_clean(date('Y-m-d')),
                                        'si_docno' => $this->security->xss_clean($si_docno),
                                        'si_date' => $this->security->xss_clean($si_date),

                                        'cus_code' => $this->security->xss_clean($customer),
                                        'pay_amount' => $this->security->xss_clean($amount),
                                        'pay_type' => $this->security->xss_clean($pay_type),
                                        'check_no' => $this->security->xss_clean($check_no),
                                        'due_date' => $this->security->xss_clean($due_date),
                                        'acc_no' => $this->security->xss_clean($acc_no),
                                        'acc_name' => $this->security->xss_clean($acc_name),
                                        'check_bank' => $this->security->xss_clean($bank),
                                        'jefe_code' => $this->security->xss_clean($jefe_code),
                                        'jefe_name' => $this->security->xss_clean($jefe_name),
                                        'ref_no' => $this->security->xss_clean($ref_no),
                                        'check_type' => $this->security->xss_clean($check_type),
                                        'tax_amount' => $this->security->xss_clean($tax_amount),
                                        'sm_code' => $this->security->xss_clean($sm_code),
                                        'sm_name' => $this->security->xss_clean($sm_name),
                                        'batch' => $this->security->xss_clean($batch),
                                        'status' => '',
                                        'status2' => ''
                                    );

                                    $this->Model_Export->insertldipayment($data);


                                }
                            }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldireturn_file_test()
        {
            $currentDateTime = date('Y-m-d H:i:s');
            $currentTimestamp = time();

            
            $apiEndpoint = "https://prebooking.ldi.sale/api/aris/export_aris_return?time=" . $currentTimestamp;

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
             echo 'API Response: ' . $response;
             echo 'API End point: ' . $apiEndpoint;
            
            if (curl_errno($ch)) {
                 echo 'Curl error: ' . curl_error($ch);
                
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                $code_flag = 0;
                

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);
                            if ($size == 12) {
                            // if ($size == 11) {

                                $si_docno       = trim($explode[0]);
                                $cus_code       = trim($explode[1]);
                                $cus_name       = trim($explode[2]);
                                $hepe_code      = trim($explode[3]);
                                $hepe_name      = trim($explode[4]);
                                $sm_code        = trim($explode[5]);
                                $sm_name        = trim($explode[6]);
                                $si_amount      = trim($explode[7]);
                                $return_amount  = trim($explode[8]);
                                $si_date        = trim($explode[9]);
                                $return_date    = trim($explode[10]);
                                $batch          = trim($explode[11]);
                            

                            // var_dump($si_docno);
                            $check = $this->Model_Export->returnldi($si_docno);
                                //var_dump($check);
                            if ($this->Model_Export->returnldi($si_docno) == false) {

                                //echo 'saved';
                                $data = array(
                                    
                                    //'pay_date' => $this->security->xss_clean(date('Y-m-d')),
                                    'si_docno' => $this->security->xss_clean($si_docno),
                                    'cus_code' => $this->security->xss_clean($cus_code),
                                    'cus_name' => $this->security->xss_clean($cus_name),
                                    'hepe_code' => $this->security->xss_clean($hepe_code),
                                    'hepe_name' => $this->security->xss_clean($hepe_name),
                                    'sm_code' => $this->security->xss_clean($sm_code),
                                    'sm_name' => $this->security->xss_clean($sm_name),
                                    'si_amount' => $this->security->xss_clean($si_amount),
                                    'return_amount' => $this->security->xss_clean($return_amount),
                                    'si_date' => $this->security->xss_clean($si_date),
                                    'return_date' => $this->security->xss_clean($return_date),
                                    'batch' => $this->security->xss_clean($batch),
                                    'status' => ''
                                );

                                $this->Model_Export->insertldireturn($data);


                            }
                        }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtruck_file_test()
        {
             
            $currentDateTime = date('Y-m-d H:i:s');
            $currentTimestamp = time();

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_to_aris?time=". $currentTimestamp;
            

            echo 'API : ' . $apiEndpoint;

            
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            echo 'API Response: ' . $response;
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                $code_flag = 0;
                

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != ""){
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);
                            echo $size;
                            if ($size == 26) {

                                $si_docno       = trim($explode[0]);
                                $pay_date       = trim($explode[1]);
                                $cus_code       = trim($explode[2]);
                                $cus_name       = trim($explode[3]);
                                $pay_amount     = trim($explode[4]);
                                $disc_amount    = trim($explode[5]);
                                $inc_amount     = trim($explode[6]);
                                $deals          = trim($explode[7]);

                                $tax_amount     = trim($explode[8]);
                                $cash_amount    = trim($explode[9]);
                                $check_amount   = trim($explode[10]);

                                $net_amount     = trim($explode[11]);
                                $pay_type       = trim($explode[12]);
                                $check_no       = trim($explode[13]);
                                $due_date       = trim($explode[14]);
                                $acc_no         = trim($explode[15]);
                                $acc_name       = trim($explode[16]);
                                $check_bank     = trim($explode[17]);
                                $sm_code        = trim($explode[18]);
                                $ref_no         = trim($explode[19]);
                                $check_type     = trim($explode[20]);
                                $status         = trim($explode[21]);
                                $sm_type        = trim($explode[22]);
                                $vat_amount     = trim($explode[23]);
                                $vatable        = trim($explode[24]);
                                $nonvatable     = trim($explode[25]);
                                //$pay_date_time  = trim($explode[26]);
                            
                                    
                                $check = $this->Model_Export->paymentldi_xtruck($ref_no,$pay_type);
                                
                                if ($this->Model_Export->paymentldi_xtruck($ref_no,$pay_type) == false) {

                                    
                                    $data = array(
                                        
                                        'pay_date'      => $this->security->xss_clean($pay_date),
                                        'si_docno'      => $this->security->xss_clean($si_docno),
                                        'cus_code'      => $this->security->xss_clean($cus_code),
                                        'cus_name'      => $this->security->xss_clean($cus_name),
                                        'pay_amount'    => $this->security->xss_clean($pay_amount),
                                        'disc_amount'   => $this->security->xss_clean($disc_amount),
                                        'inc_amount'    => $this->security->xss_clean($inc_amount),
                                        'deals'         => $this->security->xss_clean($deals),
                                        'tax_amount'    => $this->security->xss_clean($tax_amount),
                                        'cash_amount'   => $this->security->xss_clean($cash_amount),
                                        'check_amount'  => $this->security->xss_clean($check_amount),
                                        'net_amount'    => $this->security->xss_clean($net_amount),
                                        'vat_amount'    => $this->security->xss_clean($vat_amount),
                                        'vatable'       => $this->security->xss_clean($vatable),
                                        'nonvatable'    => $this->security->xss_clean($nonvatable),
                                        'pay_type'      => $this->security->xss_clean($pay_type),
                                        'check_no'      => $this->security->xss_clean($check_no),
                                        'due_date'      => $this->security->xss_clean($due_date),
                                        'acc_no'        => $this->security->xss_clean($acc_no),
                                        'acc_name'      => $this->security->xss_clean($acc_name),
                                        'check_bank'    => $this->security->xss_clean($check_bank),
                                        'sm_code'       => $this->security->xss_clean($sm_code),
                                        'ref_no'        => $this->security->xss_clean($ref_no),
                                        'check_type'    => $this->security->xss_clean($check_type),
                                        'status'        => $this->security->xss_clean($status),
                                        'sm_type'       => $this->security->xss_clean($sm_type),
                                        'status2'       => ''
                                        // ,
                                        // 'pay_date_time' => $this->security->xss_clean($pay_date_time)
                                    );

                                    $this->Model_Export->insertldixtruck($data);
                                }
                            } //condition if size is correct
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtrucksat_file_test()
        {
            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
            $currentTimestamp = time();
            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_to_aris_satelite_wh?time=". $currentTimestamp;
            //$apiEndpoint = "http://172.16.43.195:8082/api/xtruck/export_to_aris_satelite_wh?time=". $currentTimestamp;
            
             echo 'API : ' . $apiEndpoint;
            // Make a cURL request to the API endpoint
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            echo 'API Response: ' . $response;

            // $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            // echo 'Content Type: ' . $contentType;


            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                // $filePaths = ""; // You need to define $filePaths

                // $file = fopen($filePaths, "r");

                $code_flag = 0;
                // for ($i = 0; $i < $tot; $i++) {
                //     if ($convert[$i] != "") {
                //         $explode = explode("|", $convert[$i]);
                //         $size = count($explode);

                //         if ($size == 17) {
                //             $sm_code = trim($explode[3]);
                //             if ($this->Model_Export->checkUserid($sm_code) == false) {
                //                 $code_flag = 1;
                //                 echo 'yes';
                //             }
                //         }
                //     }
                // }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 20) {

                                $order_no           = trim($explode[0]);
                                $ref_no             = trim($explode[1]);
                                $date_requested     = trim($explode[2]);
                                $sm_code            = trim($explode[3]);
                                $sm_name            = trim($explode[4]);
                                $req_amount         = trim($explode[5]);
                                $appr_amount        = trim($explode[6]);
                                $warehouse          = trim($explode[7]);
                                $pay_type           = trim($explode[8]);
                                $acc_name           = trim($explode[9]);
                                $cus_name           = trim($explode[10]);
                                $acc_no             = trim($explode[11]);
                                $check_no           = trim($explode[12]);
                                $due_date           = trim($explode[13]);
                                $check_bank         = trim($explode[14]);
                                $check_type         = trim($explode[15]);
                                $sm_type            = trim($explode[16]);
                                $cus_code           = trim($explode[17]);
                                $si_docno           = trim($explode[18]);
                                $tran_no            = trim($explode[19]);
                                //$date_requested_time = trim($explode[20]);
                                
                                
                            // } else {
                            //     $order_no           = "";
                            //     $ref_no             = "";
                            //     $date_requested     = "";
                            //     $sm_code            = "";
                            //     $sm_name            = "";
                            //     $req_amount         = "";
                            //     $appr_amount        = "";
                            //     $warehouse          = "";
                            //     $pay_type           = "";
                            //     $acc_name           = "";
                            //     $cus_name           = "";
                            //     $acc_no             = "";
                            //     $check_no           = "";
                            //     $due_date           = "";
                            //     $check_bank         = "";
                            //     $check_type         = "";
                            // }
                            // var_dump($si_docno);
                            $check = $this->Model_Export->paymentldi_xtruck_sat($order_no,$pay_type,$si_docno,$tran_no);
                                //var_dump($check);
                            if ($this->Model_Export->paymentldi_xtruck_sat($order_no,$pay_type,$si_docno,$tran_no) == false) {

                                //echo 'saved';
                                $data = array(
                                    
                                    'order_no'          => $this->security->xss_clean($order_no),
                                    'ref_no'            => $this->security->xss_clean($ref_no),
                                    'date_requested'    => $this->security->xss_clean($date_requested),
                                    'sm_code'           => $this->security->xss_clean($sm_code),
                                    'sm_name'           => $this->security->xss_clean($sm_name),
                                    'req_amount'        => $this->security->xss_clean($req_amount),
                                    'appr_amount'       => $this->security->xss_clean($appr_amount),
                                    'warehouse'         => $this->security->xss_clean($warehouse),
                                    'pay_type'          => $this->security->xss_clean($pay_type),
                                    'acc_name'          => $this->security->xss_clean($acc_name),
                                    'cus_name'          => $this->security->xss_clean($cus_name),
                                    'acc_no'            => $this->security->xss_clean($acc_no),
                                    'check_no'          => $this->security->xss_clean($check_no),
                                    'due_date'          => $this->security->xss_clean($due_date),
                                    'check_bank'        => $this->security->xss_clean($check_bank),
                                    'check_type'        => $this->security->xss_clean($check_type),
                                    'cus_code'          => $this->security->xss_clean($cus_code),
                                    'si_docno'          => $this->security->xss_clean($si_docno),
                                    'tran_no'          => $this->security->xss_clean($tran_no)
                                    // ,
                                    // 'date_requested_time' => $this->security->xss_clean($date_requested_time)
                                    
                                );

                                $this->Model_Export->insertldixtrucksat($data);


                            }
                        }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtruckbo_file_test()
        {
            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
             $currentTimestamp = time();
            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_to_aris_bo?time=". $currentTimestamp;
            // $apiEndpoint = "http://172.16.43.195:8082/api/xtruck/export_to_aris_bo?time=". $currentTimestamp;
             
             echo 'API : ' . $apiEndpoint;
            // Make a cURL request to the API endpoint
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            echo 'API Response: ' . $response;

            // $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            // echo 'Content Type: ' . $contentType;


            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                // $filePaths = ""; // You need to define $filePaths

                // $file = fopen($filePaths, "r");

                $code_flag = 0;
                // for ($i = 0; $i < $tot; $i++) {
                //     if ($convert[$i] != "") {
                //         $explode = explode("|", $convert[$i]);
                //         $size = count($explode);

                //         if ($size == 10) {
                //             $sm_code = trim($explode[4]);
                //             if ($this->Model_Export->checkUserid($sm_code) == false) {
                //                 $code_flag = 1;
                //                 echo 'yes';
                //             }
                //         }
                //     }
                // }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 19) {

                                $order_no           = trim($explode[0]);
                                $posting_date       = trim($explode[1]);
                                // $acc_no             = trim($explode[2]);
                                $cus_code            = trim($explode[2]);
                                $cus_name           = trim($explode[3]);
                                $sm_code            = trim($explode[4]);
                                $bo_amount          = trim($explode[5]);
                                $rep_amount         = trim($explode[6]);
                                $cash_amount        = trim($explode[7]);
                                $tran_type          = trim($explode[8]);
                                $sm_type            = trim($explode[9]);

                                $check_amount       = trim($explode[10]);
                                $check_bank         = trim($explode[11]);
                                $acc_name           = trim($explode[12]);
                                $acc_no             = trim($explode[13]);
                                $check_no           = trim($explode[14]);
                                $due_date           = trim($explode[15]);
                                $check_type         = trim($explode[16]);
                                $si_docno           = trim($explode[17]);
                                $pay_type           = trim($explode[18]);
                                //$posting_date_time  = trim($explode[19]);
                               
                                $check = $this->Model_Export->returnldi_xtruck($order_no,$tran_type);
                                //var_dump($check);
                            if ($this->Model_Export->returnldi_xtruck($order_no,$tran_type) == false) {

                                //echo 'saved';
                                $data = array(
                                    
                                    'order_no'      => $this->security->xss_clean($order_no),
                                    'posting_date'  => $this->security->xss_clean($posting_date),
                                    'cus_code'      => $this->security->xss_clean($cus_code),
                                    'cus_name'      => $this->security->xss_clean($cus_name),
                                    'sm_code'       => $this->security->xss_clean($sm_code),
                                    'bo_amount'     => $this->security->xss_clean($bo_amount),
                                    'rep_amount'    => $this->security->xss_clean($rep_amount),
                                    'cash_amount'   => $this->security->xss_clean($cash_amount),
                                    'tran_type'     => $this->security->xss_clean($tran_type),
                                    'sm_type'       => $this->security->xss_clean($sm_type),
                                    'check_amount'  => $this->security->xss_clean($check_amount),
                                    'check_bank'    => $this->security->xss_clean($check_bank),
                                    'acc_name'      => $this->security->xss_clean($acc_name),
                                    'acc_no'        => $this->security->xss_clean($acc_no),
                                    'check_no'      => $this->security->xss_clean($check_no),
                                    'due_date'      => $this->security->xss_clean($due_date),
                                    'check_type'    => $this->security->xss_clean($check_type),
                                    'si_docno'      => $this->security->xss_clean($si_docno),
                                    'pay_type'      => $this->security->xss_clean($pay_type)
                                    // ,
                                    // 'posting_date_time'  => $this->security->xss_clean($posting_date_time)
                                    
                                );

                                $this->Model_Export->insertldireturnxtruck($data);


                            }
                        }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtruckpalawan_file_test()
        {
            
            // Get the current timestamp
            $currentTimestamp = time();

            // Define the API endpoint with the timestamp parameter
            $apiEndpoint = "http://xtruckweb.alturush.com/api/xtruck/export_palawan_remitance?time=" . $currentTimestamp;
            
            echo 'API: ' . $apiEndpoint . "\n"; // Output the API URL for debugging

            // Initialize a cURL session
            $ch = curl_init($apiEndpoint);

            // Set cURL options
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL host verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

            // Execute the cURL request
            $response = curl_exec($ch);
            echo 'API Response: ' . $response;
            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                $code_flag = 0;
                
                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 6) {

                                $sm_code            = trim($explode[0]);
                                $sm_name            = trim($explode[1]);
                                $ref_no             = trim($explode[2]);
                                $pay_amount         = trim($explode[3]);
                                $date_remitted      = trim($explode[4]);
                                $date_uploaded      = trim($explode[5]);
                                

                                $check = $this->Model_Export->palawan_xtruck($ref_no);
                                //var_dump($check);
                            if ($this->Model_Export->palawan_xtruck($ref_no) == false) {

                                //echo 'saved';
                                $data = array(
                                    
                                    'sm_code'        => $this->security->xss_clean($sm_code),
                                    'sm_name'        => $this->security->xss_clean($sm_name),
                                    'ref_no'         => $this->security->xss_clean($ref_no),
                                    'pay_amount'     => $this->security->xss_clean($pay_amount),
                                    'date_remitted'  => $this->security->xss_clean($date_remitted),
                                    'date_uploaded'  => $this->security->xss_clean($date_uploaded),
                                    
                                    
                                );

                                $this->Model_Export->insertpalawanxtruck($data);

                            }
                        }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtruckutc_file_test()
        {
            // Get the current timestamp
            $currentTimestamp = time();
            $sm_code = $this->input->post('sm_code');
           
            // Define the API endpoint with the timestamp parameter
            //$apiEndpoint = "http://172.16.43.195:8082/api/xtruck/export_under_the_cap?time=" . $currentTimestamp . "&smcode=" . $sm_code;
            $apiEndpoint = "http://xtruckweb.alturush.com/api/xtruck/export_under_the_cap?time=" . $currentTimestamp;
            echo 'API: ' . $apiEndpoint . "\n"; // Output the API URL for debugging

            // Initialize a cURL session
            $ch = curl_init($apiEndpoint);

            // Set cURL options
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL host verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

            // Execute the cURL request
            $response = curl_exec($ch);
            echo 'API Response: ' . $response;
            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                $code_flag = 0;
                
                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 6) {

                                $sm_code            = trim($explode[0]);
                                $sm_name            = trim($explode[1]);
                                $ref_no             = trim($explode[2]);
                                $pay_amount         = trim($explode[3]);
                                $date_remitted      = trim($explode[4]);
                                $date_uploaded      = trim($explode[5]);
                                

                                $check = $this->Model_Export->palawan_utc($ref_no);
                                //var_dump($check);
                                if ($this->Model_Export->palawan_utc($ref_no) == false) {

                                    //echo 'saved';
                                    $data = array(
                                        
                                        'sm_code'        => $this->security->xss_clean($sm_code),
                                        'sm_name'        => $this->security->xss_clean($sm_name),
                                        'ref_no'         => $this->security->xss_clean($ref_no),
                                        'pay_amount'     => $this->security->xss_clean($pay_amount),
                                        'date_remitted'  => $this->security->xss_clean($date_remitted),
                                        'date_uploaded'  => $this->security->xss_clean($date_uploaded),
                                        
                                        
                                    );

                                    $this->Model_Export->insertutcxtruck($data);

                                }
                            }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtruckpalawanoplan_file_test()
        {
            // Get the current timestamp
            $currentTimestamp = time();

            // Define the API endpoint with the timestamp parameter
            $apiEndpoint = "https://prebooking.ldi.sale/api/palawan/exportpalawan?time=" . $currentTimestamp; 
            

            echo 'API: ' . $apiEndpoint . "\n"; // Output the API URL for debugging

            // Initialize a cURL session
            $ch = curl_init($apiEndpoint);

            // Set cURL options
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL host verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

            // Execute the cURL request
            $response = curl_exec($ch);
            echo 'API Response: ' . $response;
            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                $code_flag = 0;
                
                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 7) {

                                $sm_code            = trim($explode[0]);
                                $sm_name            = trim($explode[1]);
                                $ref_no             = trim($explode[2]);
                                $pay_amount         = trim($explode[3]);
                                $date_remitted      = trim($explode[4]);
                                $date_uploaded      = trim($explode[5]);
                                $batch              = trim($explode[6]);
                                

                                $check = $this->Model_Export->palawan_oplan($ref_no);
                                //var_dump($check);
                                if ($this->Model_Export->palawan_oplan($ref_no) == false) {

                                    //echo 'saved';
                                    $data = array(
                                        
                                        'sm_code'        => $this->security->xss_clean($sm_code),
                                        'sm_name'        => $this->security->xss_clean($sm_name),
                                        'ref_no'         => $this->security->xss_clean($ref_no),
                                        'pay_amount'     => $this->security->xss_clean($pay_amount),
                                        'date_remitted'  => $this->security->xss_clean($date_remitted),
                                        'date_uploaded'  => $this->security->xss_clean($date_uploaded),
                                        'batch'         => $this->security->xss_clean($batch)
                                        
                                        
                                    );

                                    $this->Model_Export->insertpalawanoplan($data);

                                }
                            }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldioplanbo_file_test()
        {
            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
            $currentTimestamp = time();
            
            $apiEndpoint = "https://prebooking.ldi.sale/api/aris/getArisBO?time=". $currentTimestamp;
            
             
             echo 'API : ' . $apiEndpoint;
            // Make a cURL request to the API endpoint
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            echo 'API Response: ' . $response;

            // $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            // echo 'Content Type: ' . $contentType;


            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                // $filePaths = ""; // You need to define $filePaths

                // $file = fopen($filePaths, "r");

                $code_flag = 0;
                // for ($i = 0; $i < $tot; $i++) {
                //     if ($convert[$i] != "") {
                //         $explode = explode("|", $convert[$i]);
                //         $size = count($explode);

                //         if ($size == 8) {
                //             $sm_code = trim($explode[0]);
                //             if ($this->Model_Export->checkUserid($sm_code) == false) {
                //                 $code_flag = 1;
                //                 echo 'yes';
                //             }
                //         }
                //     }
                // }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);
                            if ($size == 12) {
                            //if ($size == 11) {

                            $hepe_code          = trim($explode[0]);
                            $hepe_name          = trim($explode[1]);
                            $cus_code           = trim($explode[2]);
                            $cus_name           = trim($explode[3]);
                            $ref_no             = trim($explode[4]);
                            $bo_amount          = trim($explode[5]);
                            $date_approved      = trim($explode[6]);
                            $date_created       = trim($explode[7]);
                            $type               = trim($explode[8]);
                            $created_by         = trim($explode[9]);
                            $si_docno           = trim($explode[10]);
                           $batch              = trim($explode[11]);
                            
                              
                            $check = $this->Model_Export->returnldi_oplan($ref_no, $type);
                                //var_dump($check);
                            if ($this->Model_Export->returnldi_oplan($ref_no, $type) == false) {

                                //echo 'saved';
                                $data = array(
                                    
                                    'hepe_code'         => $this->security->xss_clean($hepe_code),
                                    'hepe_name'         => $this->security->xss_clean($hepe_name),
                                    'cus_code'          => $this->security->xss_clean($cus_code),
                                    'cus_name'          => $this->security->xss_clean($cus_name),
                                    'ref_no'            => $this->security->xss_clean($ref_no),
                                    'bo_amount'         => $this->security->xss_clean($bo_amount),
                                    'date_approved'     => $this->security->xss_clean($date_approved),
                                    'date_created'      => $this->security->xss_clean($date_created),
                                    'type'              => $this->security->xss_clean($type),
                                    'created_by'        => $this->security->xss_clean($created_by),
                                    'si_docno'          => $this->security->xss_clean($si_docno),
                                    'batch'             => $this->security->xss_clean($batch)
                                    
                                );

                                $this->Model_Export->insertldireturnoplan($data);


                            }
                        }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function importldixtrucksminc_file_test()
        {
            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
             $currentTimestamp = time();
            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_to_aris_incetives?time=". $currentTimestamp;
            // $apiEndpoint = "http://172.16.43.195:8082/api/xtruck/export_to_aris_bo?time=". $currentTimestamp;
             
             echo 'API : ' . $apiEndpoint;
            // Make a cURL request to the API endpoint
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            echo 'API Response: ' . $response;

            // $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            // echo 'Content Type: ' . $contentType;


            // Check for cURL errors
            if (curl_errno($ch)) {
                //echo 'Curl error: ' . curl_error($ch);
                // Handle the error appropriately
            } else {
                
                $data = $response;
                $convert = explode("\n", $data);
                $tot = count($convert);

                if ($tot == 0 || $tot < 2) {
                    if ($convert[0] == "") {
                        echo 'no-data';
                        return false;
                    }
                }

                // $filePaths = ""; // You need to define $filePaths

                // $file = fopen($filePaths, "r");

                $code_flag = 0;
                // for ($i = 0; $i < $tot; $i++) {
                //     if ($convert[$i] != "") {
                //         $explode = explode("|", $convert[$i]);
                //         $size = count($explode);

                //         if ($size == 4) {
                //             $sm_code = trim($explode[0]);
                //             if ($this->Model_Export->checkUserid($sm_code) == false) {
                //                 $code_flag = 1;
                //                 echo 'yes';
                //             }
                //         }
                //     }
                // }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 4) {

                                $sm_code            = trim($explode[0]);
                                $inc_month          = trim($explode[1]);
                                $inc_amount         = trim($explode[2]);
                                $sm_type            = trim($explode[3]);
                                
                               
                            //$check = $this->Model_Export->sm_inc_xtruck($sm_code,$inc_month);
                            $check = $this->Model_Export->sm_inc_xtruck($sm_code,$inc_month,$inc_amount);
                            

                                //var_dump($check);
                            if ($check == false) {

                                //echo 'saved';
                                $data = array(
                                    
                                    
                                    'sm_code'    => $this->security->xss_clean($sm_code),
                                    'inc_month'   => $this->security->xss_clean($inc_month),
                                    'inc_amount'    => $this->security->xss_clean($inc_amount)
                                    
                                    
                                );

                                $this->Model_Export->insertldismincxtruck($data);
                            }

                            $check2 = $this->Model_Export->sm_inc_bal_xtruck($sm_code);

                            $user_id            = $this->Model_Export->getUserId($sm_code);
                            
                            $total_inc_amount = $this->Model_Export->get_total_inc($sm_code);
                            $applied = $this->Model_Export->getIncentivesAppliedLedger($sm_code);
                            
                            $inc_balance = floatval($total_inc_amount) - floatval($applied);

                          
                            if ($check2 == false) {

                                //echo 'saved';
                                $data2 = array(
                                    
                                    
                                    'sm_code'    => $this->security->xss_clean($sm_code),
                                    'inc_balance'   => $this->security->xss_clean($inc_balance)
                                    
                                    
                                );

                                $this->Model_Export->insertldismincbalxtruck($data2);
                            }else{
                                $data3 = array(
                                    
                                    
                                    'sm_code'    => $this->security->xss_clean($sm_code),
                                    'inc_balance'   => $inc_balance
                                    
                                    
                                );

                                $this->Model_Export->updatesmincbalxtruck($data3);
                            }


                        }
                        }
                    }
                    echo 'success';
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }

        public function exportldioplanbo_file_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.196.199';
            $connection = 'LDI_AR';
            $username = 'sa';
            $password = 'Corporate_it';

           // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect);  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

            $apiEndpoint = "https://prebooking.ldi.sale/api/aris/getArisBOdirect";
            
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);
            echo 'API : ' . $apiEndpoint;
            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 13) {
                        $ref_id         = trim($explode[0]);
                        $hepe_code      = trim($explode[1]);
                        $hepe_name      = trim($explode[2]);
                        $cus_code       = trim($explode[3]);
                        $cus_name       = trim($explode[4]);
                        $tran_no        = trim($explode[5]);
                        $si_docno       = trim($explode[6]);
                        $amount         = trim($explode[7]);
                        $date_approved  = trim($explode[8]);
                        $date_created   = trim($explode[9]);
                        $type           = trim($explode[10]);
                        $type2          = trim($explode[11]);
                        $final_si       = trim($explode[12]);
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                        $date_created      = !empty($date_created) ? date('Y-m-d H:i:s', strtotime($date_created)) : null;
                        

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $hepe_code      = str_replace("'", "''", $hepe_code);
                        $hepe_name      = str_replace("'", "''", $hepe_name);
                        $cus_code       = str_replace("'", "''", $cus_code);
                        $cus_name       = str_replace("'", "''", $cus_name);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $tran_no        = str_replace("'", "''", $tran_no);
                        $amount         = str_replace("'", "''", $amount);
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        $date_created   = $date_created ? "'" . str_replace("'", "''", $date_created) . "'" : "NULL";
                        $type           = str_replace("'", "''", $type);
                        $type2          = str_replace("'", "''", $type2);
                        $final_si       = str_replace("'", "''", $final_si);

                        $check_query = "SELECT COUNT(*) as cnt FROM pre_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO pre_adj (
                                ref_id,
                                si_no,
                                amount,
                                cus_code,
                                jepe_code,
                                a_type,
                                a_type2,
                                approve_dte,
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$final_si',
                                '$amount',
                                '$cus_code',
                                '$hepe_code',
                                '$type',
                                '$type2',
                                $date_created,
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function exportldioplanreturn_file_test()
        {
            try {
                
               
                $result2 = $this->Model_Cashier_Sm->getSmReturnsForExport();
				
                $result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));

                // $connection = $result3->ar_connection;
                // $username = $result3->db_username;
                // $password = $result3->db_password;

                
               // $connect = odbc_connect($connection, $username, $password);

                $ip_server = '172.16.196.199';
                $connection = 'LDI_AR';
                $username = 'sa';
                $password = 'Corporate_it';

               // @$connect = odbc_connect($connection, $username, $password);
                @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect); 

            //     var_dump($connect);

                foreach($result2 as $row)
                {
                    
                    $ref_id         = str_replace("'", "''", $row['return_no']);
                    $hepe_code       = str_replace("'", "''", $row['hepe_code']);
                    $cus_code   = str_replace("'", "''", $row['cus_code']);
                    $si_docno           = str_replace("'", "''", $row['si_docno']);
                    $amount    = str_replace("'", "''", $row['return_amount']);
                    
                    $date_approved = !empty($row['date_added']) ? "'" . date('Y-m-d H:i:s', strtotime($row['date_added'])) . "'" : "NULL";
                    $type = 'Return';

                    $check_query = "SELECT COUNT(*) as cnt FROM pre_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                    $check_result = odbc_exec($connect, $check_query);
                    $check_row = odbc_fetch_array($check_result);

                    if ($check_row['cnt'] > 0) {
                        echo "Skipping duplicate ref_id: $ref_id<br>";
                        continue; // skip this record
                    }

                    $sql_query = "
                        INSERT INTO pre_adj (
                            ref_id,
                            si_no,
                            amount,
                            cus_code,
                            jepe_code,
                            a_type,
                            approve_dte,
                            stats
                        ) VALUES (
                            '$ref_id',
                            '$si_docno',
                            '$amount',
                            '$cus_code',
                            '$hepe_code',
                            '$type',
                            $date_approved,
                            'Pending'
                        )
                    ";

                    $result = odbc_exec($connect, $sql_query);

                    if (!$result) {
                        echo "Failed to insert record for SI No: $si_docno<br>";
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

        public function exportldi_file_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.196.199';
            $connection = 'LDI_AR';
            $username = 'sa';
            $password = 'Corporate_it';

           // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect);  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_adjustmentTAGB";

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 10) {
                        $ref_id         = trim($explode[0]);
                        $si_docno       = trim($explode[1]);
                        $amount         = trim($explode[2]);
                        $account_code   = trim($explode[3]);
                        $sm_code        = trim($explode[4]);
                        $type           = trim($explode[5]);
                        $date_approved  = trim($explode[6]);
                        $particulars    = trim($explode[7]);
                        $date_from      = trim($explode[8]);
                        $date_to        = trim($explode[9]);
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                        $date_from      = !empty($date_from) ? date('Y-m-d H:i:s', strtotime($date_from)) : null;
                        $date_to        = !empty($date_to) ? date('Y-m-d H:i:s', strtotime($date_to)) : null;

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $amount         = str_replace("'", "''", $amount);
                        $account_code   = str_replace("'", "''", $account_code);
                        $sm_code        = str_replace("'", "''", $sm_code);
                        $type           = str_replace("'", "''", $type);
                        $particulars    = str_replace("'", "''", $particulars);
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        $date_from      = $date_from ? "'" . str_replace("'", "''", $date_from) . "'" : "NULL";
                        $date_to        = $date_to ? "'" . str_replace("'", "''", $date_to) . "'" : "NULL";

                        $check_query = "SELECT COUNT(*) as cnt FROM xtruck_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO xtruck_adj (
                                ref_id,
                                si_no,
                                amount,
                                account_code,
                                sm_code,
                                a_type,
                                approve_dte,
                                particulars,
                                date_from,
                                date_to,
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$si_docno',
                                '$amount',
                                '$account_code',
                                '$sm_code',
                                '$type',
                                $date_approved,
                                '$particulars',
                                $date_from,
                                $date_to,
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function exportldioverage_file_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.196.199';
            $connection = 'LDI_AR';
            $username = 'sa';
            $password = 'Corporate_it';

           // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect);  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_doubleaverageTAGB";

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 7) {
                        $ref_id         = trim($explode[0]);
                        $si_docno       = trim($explode[1]);
                        $amount         = trim($explode[2]);
                       
                        $sm_code        = trim($explode[3]);
                        $type           = trim($explode[4]);
                        $type2          = trim($explode[5]);
                        $date_approved  = trim($explode[6]);
                       
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                       

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $amount         = str_replace("'", "''", $amount);
                       
                        $sm_code        = str_replace("'", "''", $sm_code);
                        $type           = str_replace("'", "''", $type);
                        $type2          = str_replace("'", "''", $type2);
                       
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        

                        $check_query = "SELECT COUNT(*) as cnt FROM xtruck_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO xtruck_adj (
                                ref_id,
                                si_no,
                                amount,
                               
                                sm_code,
                                a_type,
                                type1,
                                approve_dte,
                               
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$si_docno',
                                '$amount',
                               
                                '$sm_code',
                                '$type',
                                '$type2',
                                $date_approved,
                                
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function exportldiprice_file_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.196.199';
            $connection = 'LDI_AR';
            $username = 'sa';
            $password = 'Corporate_it';

           // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect);  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_priceadjustmentTAGB";

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 7) {
                        $ref_id         = trim($explode[0]);
                        $si_docno       = trim($explode[1]);
                        $amount         = trim($explode[2]);
                       
                        $sm_code        = trim($explode[3]);
                        $type           = trim($explode[4]);
                        $type2          = trim($explode[5]);
                        $date_approved  = trim($explode[6]);
                       
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                       

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $amount         = str_replace("'", "''", $amount);
                       
                        $sm_code        = str_replace("'", "''", $sm_code);
                        $type           = str_replace("'", "''", $type);
                        $type2          = str_replace("'", "''", $type2);
                       
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        

                        $check_query = "SELECT COUNT(*) as cnt FROM xtruck_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO xtruck_adj (
                                ref_id,
                                si_no,
                                amount,
                               
                                sm_code,
                                a_type,
                                type1,
                                approve_dte,
                               
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$si_docno',
                                '$amount',
                               
                                '$sm_code',
                                '$type',
                                '$type2',
                                $date_approved,
                                
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function exportldi_file_udc_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.22.4';
            $connection = 'UDC_AR';
            $username = 'udc_conn';
            $password = 'udc_conn'; 


            // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . odbc_errormsg());  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

        

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_adjustmentUBAY";

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 10) {
                        $ref_id         = trim($explode[0]);
                        $si_docno       = trim($explode[1]);
                        $amount         = trim($explode[2]);
                        $account_code   = trim($explode[3]);
                        $sm_code        = trim($explode[4]);
                        $type           = trim($explode[5]);
                        $date_approved  = trim($explode[6]);
                        $particulars    = trim($explode[7]);
                        $date_from      = trim($explode[8]);
                        $date_to        = trim($explode[9]);
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                        $date_from      = !empty($date_from) ? date('Y-m-d H:i:s', strtotime($date_from)) : null;
                        $date_to        = !empty($date_to) ? date('Y-m-d H:i:s', strtotime($date_to)) : null;

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $amount         = str_replace("'", "''", $amount);
                        $account_code   = str_replace("'", "''", $account_code);
                        $sm_code        = str_replace("'", "''", $sm_code);
                        $type           = str_replace("'", "''", $type);
                        $particulars    = str_replace("'", "''", $particulars);
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        $date_from      = $date_from ? "'" . str_replace("'", "''", $date_from) . "'" : "NULL";
                        $date_to        = $date_to ? "'" . str_replace("'", "''", $date_to) . "'" : "NULL";

                        $check_query = "SELECT COUNT(*) as cnt FROM xtruck_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO xtruck_adj (
                                ref_id,
                                si_no,
                                amount,
                                account_code,
                                sm_code,
                                a_type,
                                approve_dte,
                                particulars,
                                date_from,
                                date_to,
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$si_docno',
                                '$amount',
                                '$account_code',
                                '$sm_code',
                                '$type',
                                $date_approved,
                                '$particulars',
                                $date_from,
                                $date_to,
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function exportldioverage_file_udc_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.22.4';
            $connection = 'UDC_AR';
            $username = 'udc_conn';
            $password = 'udc_conn'; 

           // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect);  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_doubleaverageUBAY";

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 7) {
                        $ref_id         = trim($explode[0]);
                        $si_docno       = trim($explode[1]);
                        $amount         = trim($explode[2]);
                       
                        $sm_code        = trim($explode[3]);
                        $type           = trim($explode[4]);
                        $type2          = trim($explode[5]);
                        $date_approved  = trim($explode[6]);
                       
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                       

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $amount         = str_replace("'", "''", $amount);
                       
                        $sm_code        = str_replace("'", "''", $sm_code);
                        $type           = str_replace("'", "''", $type);
                        $type2          = str_replace("'", "''", $type2);
                       
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        

                        $check_query = "SELECT COUNT(*) as cnt FROM xtruck_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO xtruck_adj (
                                ref_id,
                                si_no,
                                amount,
                               
                                sm_code,
                                a_type,
                                type1,
                                approve_dte,
                               
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$si_docno',
                                '$amount',
                               
                                '$sm_code',
                                '$type',
                                '$type2',
                                $date_approved,
                                
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function exportldiprice_file_udc_test()
        {
            //$result3 = $this->Model_Cashier_Sm->getLocation($this->session->userdata('location'));
            $ip_server = '172.16.22.4';
            $connection = 'UDC_AR';
            $username = 'udc_conn';
            $password = 'udc_conn'; 

           // @$connect = odbc_connect($connection, $username, $password);
            @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect);  
            if (!$connect) {
                echo 'Database connection failed.';
                return false;
            }

            $apiEndpoint = "https://xtruckweb.alturush.com/api/xtruck/export_priceadjustmentUBAY";

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
                curl_close($ch);
                return false;
            }

            curl_close($ch);

            echo 'API Response: ' . $response;

            if (empty($response)) {
                echo 'no-data';
                return false;
            }

            $lines = explode("\n", $response);
            if (count($lines) < 2 && empty($lines[0])) {
                echo 'no-data';
                return false;
            }

            foreach ($lines as $line) {
                if (trim($line) != "") {
                    $explode = explode("|", $line);

                    if (count($explode) == 7) {
                        $ref_id         = trim($explode[0]);
                        $si_docno       = trim($explode[1]);
                        $amount         = trim($explode[2]);
                       
                        $sm_code        = trim($explode[3]);
                        $type           = trim($explode[4]);
                        $type2          = trim($explode[5]);
                        $date_approved  = trim($explode[6]);
                       
                       

                        $date_approved  = !empty($date_approved) ? date('Y-m-d H:i:s', strtotime($date_approved)) : null;
                       

                        // Escape single quotes to prevent SQL issues
                        $ref_id         = str_replace("'", "''", $ref_id);
                        $si_docno       = str_replace("'", "''", $si_docno);
                        $amount         = str_replace("'", "''", $amount);
                       
                        $sm_code        = str_replace("'", "''", $sm_code);
                        $type           = str_replace("'", "''", $type);
                        $type2          = str_replace("'", "''", $type2);
                       
                        $date_approved  = $date_approved ? "'" . str_replace("'", "''", $date_approved) . "'" : "NULL";
                        

                        $check_query = "SELECT COUNT(*) as cnt FROM xtruck_adj WHERE ref_id = '$ref_id' and a_type = '$type'";
                        $check_result = odbc_exec($connect, $check_query);
                        $check_row = odbc_fetch_array($check_result);

                        if ($check_row['cnt'] > 0) {
                            echo "Skipping duplicate ref_id: $ref_id<br>";
                            continue; // skip this record
                        }

                        $sql_query = "
                            INSERT INTO xtruck_adj (
                                ref_id,
                                si_no,
                                amount,
                               
                                sm_code,
                                a_type,
                                type1,
                                approve_dte,
                               
                                stats
                            ) VALUES (
                                '$ref_id',
                                '$si_docno',
                                '$amount',
                               
                                '$sm_code',
                                '$type',
                                '$type2',
                                $date_approved,
                                
                                'Pending'
                            )
                        ";

                        $result = odbc_exec($connect, $sql_query);

                        if (!$result) {
                            echo "Failed to insert record for SI No: $si_docno<br>";
                        }
                    }
                }
            }

            odbc_close($connect);

            echo 'success';
        }

        public function updateldipayment_file_test()
        {
            try {
                
                $result2 = $this->Model_Cashier_Sm->getSmPaymentsForUpdate();

                $ip_server = '172.16.196.199';
                $connection = 'LDI_AR';
                $username = 'sa';
                $password = 'Corporate_it';

                // $ip_server = '172.16.22.4';
                // $connection = 'UDC_AR';
                // $username = 'udc_conn';
                // $password = 'udc_conn';

                @$connect = odbc_connect("Driver={SQL Server};Server=$ip_server;Database=$connection;", $username, $password) or die("Connection failed: " . $connect); 

                foreach($result2 as $row)
                {
                    $ref_no        = str_replace("'", "''", $row['ref_no']); 
                    $si_docno      = str_replace("'", "''", $row['si_docno']); 
                    $manualsrr     = str_replace("'", "''", $row['manualsrr']); 
                    // $remitDate     = !empty($row['date_added']) ? date('Y-m-d H:i:s', strtotime($row['date_added'])) : null;
                    // $gross_amount  = str_replace("'", "''", $row['pay_amount']);
                    // $disc_amount   = str_replace("'", "''", $row['disc_amount']);
                    // $tax_amount    = str_replace("'", "''", $row['tax_amount']);

                    // $vatAmount          = str_replace("'", "''", $row['vat_amount']);
                    // $vatableAmount      = str_replace("'", "''", $row['vatable']);
                    // $nonvatableAmount   = str_replace("'", "''", $row['nonvatable']);

                    

                    $sql_query = "
                        UPDATE payments_mw
                        SET 
                            manual_srr = '$manualsrr'
                            

                            
                        WHERE ref_no = '$ref_no' AND si_docno = '$si_docno' and gl_stats = 'EXPORTED'
                    ";

                    $result = odbc_exec($connect, $sql_query);

                    if ($result) {
                        // Optionally update status6 here if needed
                        // $this->Model_Cashier_Sm->updateStatus6($pay_id);
                    } else {
                        // Log error or handle failure
                    }
                }

                odbc_close($connect);


                echo 'yes';
            } catch (Exception $e) {
                // Log any unexpected exceptions
                error_log("Exception: " . $e->getMessage());
                var_dump(@$connection);
            }
        }

        public function export_file()
        {
            $tdate = $this->input->post('datenow');
            if($this->Model_Export->checkPayment($tdate) == false && $this->Model_Export->checkDenom($tdate) == false)
            {
                echo 'nodata';
            }
            else
            {
                $path = 'C:\\'.$this->session->userdata('location').'-RemitTextfile\\';
                if(!file_exists('C:\\'.$this->session->userdata('location').'-RemitTextfile\\'))
                {
                    mkdir($path,0777);
                }

                if($this->Model_Export->checkPayment($tdate) == true)
                {
                    $payment_textfile = $path.'Payments-'.str_replace('-','',$tdate).'.txt';

                    $handle = fopen($payment_textfile, 'w') or die('Cannot open file: '.$payment_textfile);

                    $pay_result = $this->Model_Export->getPayments($tdate);

                    $i = 0;
                    foreach($pay_result as $row)
                    {
                        if($i == 0)
                        {
                            $i = 1;
                            $data =  $row['payment_id'] ."|".$row['user_id']."|".$row['full_name']."|".$row['pay_date']."|".$row['cus_code']."|".$row['name']."|".$row['type']."|".$row['check_no']."|".$row['due_date']."|".$row['acc_name']."|".$row['acc_num']."|".$row['bank']."|".$row['amount'];
                        }
                        else
                        {
                            $data =  "\n".$row['payment_id'] ."|".$row['user_id']."|".$row['full_name']."|".$row['pay_date']."|".$row['cus_code']."|".$row['name']."|".$row['type']."|".$row['check_no']."|".$row['due_date']."|".$row['acc_name']."|".$row['acc_num']."|".$row['bank']."|".$row['amount'];
                        }
                        
                        fwrite($handle, $data);
                    }

                    fclose($handle);
                }

                // if($this->Model_Export->checkDenom($tdate) == true)
                // {
                //     $denom_textfile = $path.'Denom-'.str_replace('-','',$tdate).'.txt';

                //     $handle1 = fopen($denom_textfile, 'w') or die('Cannot open file: '.$denom_textfile);

                //     $denom_result = $this->Model_Export->getDenom($tdate);

                //     $e = 0;
                //     foreach($denom_result as $row2)
                //     {
                //         if($e == 0)
                //         {
                //             $e = 1;
                //             $data = $row2['denom_id']."|".$row2['date_added']."|".$row2['user_id']."|".$row2['full_name']."|".$row2['total_cash']."|".$row2['total_dc']."|".$row2['total_pdc']."|".$row2['total']."|".$row2['cus_code'];
                //         }
                //         else
                //         {
                //             $data = "\n".$row2['denom_id']."|".$row2['date_added']."|".$row2['user_id']."|".$row2['full_name']."|".$row2['total_cash']."|".$row2['total_dc']."|".$row2['total_pdc']."|".$row2['total']."|".$row2['cus_code'];
                //         }

                //         fwrite($handle1, $data);
                //     }

                //     fclose($handle1);
                // }
                if($this->Model_Export->checkDenom($tdate) == true)
                {
                    $cash_textfile = $path.'Cash-'.str_replace('-','',$tdate).'.txt';

                    $handle1 = fopen($cash_textfile, 'w') or die('Cannot open file: '.$cash_textfile);

                    $cash_result = $this->Model_Export->getCash($tdate);

                    $data = $cash_result->date_added."|".$cash_result->total_cash;

                    fwrite($handle1, $data);

                    fclose($handle1);
                }
            }
        }
    }
?>