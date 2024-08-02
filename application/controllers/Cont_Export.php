<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Export extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Export');
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
            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
            $apiEndpoint = "http://172.16.43.195:8081/api/aris/export_aris";
            // $apiEndpoint = "https://distribution.alturush.com/api/aris/export_aris";



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
                echo 'Curl error: ' . curl_error($ch);
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
                for ($i = 0; $i < $tot; $i++) {
                    if ($convert[$i] != "") {
                        $explode = explode("|", $convert[$i]);
                        $size = count($explode);

                        if ($size == 14) {
                            $sm_code = trim($explode[11]);
                            if ($this->Model_Export->checkUserid($sm_code) == false) {
                                $code_flag = 1;
                                var_dump($sm_code);
                            }
                        }
                    }
                }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 14) {

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
                            } else {
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
                            // var_dump($si_docno);
                            $check = $this->Model_Export->paymentldi($si_docno,$pay_type);
                                //var_dump($check);
                            if ($this->Model_Export->paymentldi($si_docno,$pay_type) == false) {

                                //echo 'saved';
                                $data = array(
                                    // 'pay_date' => $this->security->xss_clean($pay_date),
                                    'pay_date' => $this->security->xss_clean(date('Y-m-d')),
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
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
        }


        public function importldireturn_file_test()
        {
           
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
            $apiEndpoint = "http://172.16.43.195:8081/api/aris/export_aris_return";
            // $apiEndpoint = "https://distribution.alturush.com/api/aris/export_aris_return";

            //shell_exec('curl -k' . $apiEndpoint);

            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            
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
                for ($i = 0; $i < $tot; $i++) {
                    if ($convert[$i] != "") {
                        $explode = explode("|", $convert[$i]);
                        $size = count($explode);

                        if ($size == 11) {
                            $sm_code = trim($explode[3]);
                            if ($this->Model_Export->checkUserid($sm_code) == false) {
                                $code_flag = 1;
                                var_dump($sm_code);
                            }
                        }
                    }
                }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 11) {

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
                                
                            } else {
                                $si_docno        = "";
                                $cus_code        = "";
                                $cus_name        = "";
                                $hepe_code       = "";
                                $hepe_name       = "";
                                $sm_code         = "";
                                $sm_name         = "";
                                $si_amount       = "";
                                $return_amount   = "";
                                $si_date         = "";
                                $return_date     = "";
                               
                            }
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
                                    'status' => ''
                                );

                                $this->Model_Export->insertldireturn($data);


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
            // Assuming you have an API endpoint to fetch data
            // $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris?status=Exported&expdateFrom=2022-01-01&expdateTo=2023-12-01";
            $apiEndpoint = "http://172.16.42.155:8001/api/aris/export_aris";
            
            // Make a cURL request to the API endpoint
            $ch = curl_init($apiEndpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            //echo 'API Response: ' . $response;

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
                for ($i = 0; $i < $tot; $i++) {
                    if ($convert[$i] != "") {
                        $explode = explode("|", $convert[$i]);
                        $size = count($explode);

                        if ($size == 14) {
                            $sm_code = trim($explode[11]);
                            if ($this->Model_Export->checkUserid($sm_code) == false) {
                                $code_flag = 1;
                                var_dump($sm_code);
                            }
                        }
                    }
                }

                if ($code_flag == 0) {
                    for ($i = 0; $i < $tot; $i++) {
                        if ($convert[$i] != "") {
                            $explode = explode("|", $convert[$i]);
                            $size = count($explode);

                            if ($size == 14) {

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
                            } else {
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
                            // var_dump($si_docno);
                            $check = $this->Model_Export->paymentldi($si_docno,$pay_type);
                                //var_dump($check);
                            if ($this->Model_Export->paymentldi($si_docno,$pay_type) == false) {

                                //echo 'saved';
                                $data = array(
                                    // 'pay_date' => $this->security->xss_clean($pay_date),
                                    'pay_date' => $this->security->xss_clean(date('Y-m-d')),
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
                } else {
                    echo 'nocode';
                }
                
            }
            // Close the cURL handle
            curl_close($ch);
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