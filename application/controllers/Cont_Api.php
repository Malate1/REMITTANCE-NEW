<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Api extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
           
            $this->load->model('Model_Cashier_Sm');
        }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('smdenom');
            $this->load->view('footer');
        }

        public function get_data() {
            $data = $this->Model_Cashier_Sm->get_data();
            $data2 = $this->Model_Cashier_Sm->get_data2();
            $data3 = $this->Model_Cashier_Sm->get_data3();
            $data4 = $this->Model_Cashier_Sm->get_data4();

            // Convert data to pipe-separated format without headers
            $csv_data = '';

            // Append data from first query
            foreach ($data as $row) {
                $csv_data .= implode('|', (array) $row) . "\n";
            }

            // Append an empty line
            // $csv_data .= "\n";

            // Append data from second query
            foreach ($data2 as $row) {
                $csv_data .= implode('|', (array) $row) . "\n";
            }

            // Append data from third query
            $previous_date = null;
            $previous_sm_code = null;
            $previous_amount = null;
            $label = 'INCENTIVES';

            foreach ($data3 as $row) {
                $current_date = date('Y-m-d');
                $current_sm_code = $row->sm_code;
                $current_amount = $row->totalinc;
                
                // Check if current row has the same date, sm_code, and amount as the previous row
                if ($current_date === $previous_date && $current_sm_code === $previous_sm_code && $current_amount === $previous_amount) {
                    $csv_data = ''; // Reset $csv_data to empty
                } else {
                    // Concatenate the current date with the row data
                    $csv_data .= $label . '|' .$current_date . '|' . implode('|', (array) $row) . "\n";
                }
    
                
                $previous_date = $current_date;
                $previous_sm_code = $current_sm_code;
                $previous_amount = $current_amount;
            }

            
            $prev_denom = null;
            $prev_sm_code = null;
            $prev_amount = null;
            $label2 = 'REMITTANCE';

            foreach ($data4 as $row) {
                $cur_denom = $row->denom_id;
                $cur_sm_code = $row->id_no;
                $cur_amount = $row->total_remittance;
                
                // Check if cur row has the same date, sm_code, and amount as the previous row
                if ($cur_denom === $prev_denom && $cur_sm_code === $prev_sm_code && $cur_amount === $prev_amount) {
                    $csv_data = ''; // Reset $csv_data to empty
                } else {
                    // Concatenate the cur date with the row data
                    $csv_data .= $label2 . '|' . implode('|', (array) $row) . "\n";
                }
    
                
                $prev_denom = $cur_denom;
                $prev_sm_code = $cur_sm_code;
                $prev_amount = $cur_amount;
            }



            // Set a filename for the downloaded file
            $filename = 'Aris_to_xtruck.txt';

            // Set content type and headers for file download
            header('Content-Type: application/json'); // Change content type to text/plain for a .txt file
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($csv_data));

            // Output the pipe-separated data
            echo $csv_data;
            exit();
        }

        public function get_data_denom() {
            // Decode the JSON input
            $json_input = file_get_contents('php://input'); // Get raw POST data
            $data_denom = json_decode($json_input, true); // Decode it to an associative array

            // Access the ids
            $denom_id = $data_denom['ids'];
            
            $data = $this->Model_Cashier_Sm->get_data_denom($denom_id);
            $data2 = $this->Model_Cashier_Sm->get_data2_denom($denom_id);
            $data3 = $this->Model_Cashier_Sm->get_data3_denom($denom_id);
            $data4 = $this->Model_Cashier_Sm->get_data4_denom($denom_id);
            $data5 = $this->Model_Cashier_Sm->get_data5_denom($denom_id);
            $data6 = $this->Model_Cashier_Sm->get_data6_denom($denom_id);
            // Convert data to pipe-separated format without headers
            $csv_data = '';

            // Append data from first query
            foreach ($data as $row) {
                $csv_data .= implode('|', (array) $row) . "\n";
            }

            // Append an empty line
            // $csv_data .= "\n";

            // Append data from second query
            foreach ($data2 as $row) {
                $csv_data .= implode('|', (array) $row) . "\n";
            }

            // Append data from third query
            $previous_date = null;
            $previous_sm_code = null;
            $previous_amount = null;
            $label = 'INCENTIVES';

            foreach ($data3 as $row) {
                $current_date = date('Y-m-d');
                $current_sm_code = $row->sm_code;
                $current_amount = $row->totalinc;
                
                // Check if current row has the same date, sm_code, and amount as the previous row
                if ($current_date === $previous_date && $current_sm_code === $previous_sm_code && $current_amount === $previous_amount) {
                    $csv_data = ''; // Reset $csv_data to empty
                } else {
                    // Concatenate the current date with the row data
                    $csv_data .= $label . '|' .$current_date . '|' . implode('|', (array) $row) . "\n";
                }
    
                
                $previous_date = $current_date;
                $previous_sm_code = $current_sm_code;
                $previous_amount = $current_amount;
            }

            
            $prev_denom = null;
            $prev_sm_code = null;
            $prev_amount = null;
            $prev_amount2 = null;

            $label2 = 'REMITTANCE';

            foreach ($data4 as $row) {
                $cur_denom = $row->manualsrr;
                $cur_sm_code = $row->id_no;
                $cur_amount = $row->total_remittance;
                $cur_amount2 = $row->total_collection;

                $sm_code_data = $this->db->query('SELECT * FROM users WHERE id_no = "'.$cur_sm_code.'"');
                $result_sm = $sm_code_data->row();
                
                // Special handling if sm_type is Dual
                if ($result_sm->sm_type === 'Dual') {
                    // Get total net_amount from payments_xtruck for secondary code
                    $query = $this->db->query('SELECT IFNULL(SUM(net_amount), 0.00) AS total_secondary FROM payments_xtruck WHERE sm_code = "'.$result_sm->sm_code2.'" and denom_id = "'.$denom_id.'"');
                    $result = $query->row();

                    $query_sat = $this->db->query('SELECT IFNULL(SUM(appr_amount), 0.00) AS total_satsecondary FROM payments_satellite WHERE sm_code = "'.$result_sm->sm_code2.'" and denom_id = "'.$denom_id.'"');
                    $result_sat = $query_sat->row();
                    $secondary_total = (float) $result->total_secondary - $result_sat->total_satsecondary;

                    // First line: Main code with adjusted amounts
                    $adjusted_remit = $cur_amount - $secondary_total;
                    $adjusted_coll = $cur_amount2 - $secondary_total;
                    $csv_data .= $label2 . '|' . $cur_sm_code . '|' . $cur_denom . '|' . $adjusted_remit . '|' . $adjusted_coll . "\n";

                    // Second line: Secondary code with its amounts
                    $csv_data .= $label2 . '|' . $result_sm->sm_code2 . '|' . $cur_denom . '|' . $secondary_total . '|' . $secondary_total . "\n";
                } else {
                    // Check if row is duplicate
                    if (
                        $cur_denom === $prev_denom &&
                        $cur_sm_code === $prev_sm_code &&
                        $cur_amount === $prev_amount &&
                        $cur_amount2 === $prev_amount2
                    ) {
                        $csv_data = ''; // skip
                    } else {
                        $csv_data .= $label2 . '|' . implode('|', (array) $row) . "\n";
                    }
                }

                $prev_denom = $cur_denom;
                $prev_sm_code = $cur_sm_code;
                $prev_amount = $cur_amount;
                $prev_amount2 = $cur_amount2;
            }

            // Append data from fifth query
            
            $label3 = 'PALAWAN';

            foreach ($data5 as $row) {
                
                // Concatenate the current date with the row data
                $csv_data .= $label3 . '|' . implode('|', (array) $row) . "\n";
                
                
            }

            // Append data from sixth query
            
            $label4 = 'UNDERTHECUP';

            foreach ($data6 as $row) {
                
                // Concatenate the current date with the row data
                $csv_data .= $label4 . '|' . implode('|', (array) $row) . "\n";
                
                
            }

            

            // Set a filename for the downloaded file
            $sm_data = $this->Model_Cashier_Sm->getPaymentsExtDenom($denom_id);

            @$sm_code = $sm_data->sm_code;
            $sm_name =$this->Model_Cashier_Sm->getUserFullName($sm_code);
            $sm_fullname = $sm_name->full_name;
            
            $date_today = date('Ymd'); // Format the date as YYYYMMDD

            // Create the filename dynamically
            $filename2 = $sm_code . '_' . $sm_fullname . '_' . $date_today . '.txt';
            // var_dump($filename2);

            // Set content type and headers for file download
            header('Content-Type: application/json'); // Change content type to text/plain for a .txt file
            header('Content-Disposition: attachment; filename="' . $filename2 . '"');
            header('Content-Length: ' . strlen($csv_data));

            // Output the pipe-separated data
            echo $csv_data;
            exit();
        }

        public function get_data_denom_mpdi() {
            // Decode the JSON input
            $json_input = file_get_contents('php://input'); // Get raw POST data
            $data_denom = json_decode($json_input, true); // Decode it to an associative array

            // Access the ids
            $denom_id = $data_denom['ids'];
            
            $data4 = $this->Model_Cashier_Sm->get_data4_denom_mpdi($denom_id);
            
            // Convert data to pipe-separated format without headers
            $csv_data = '';

            $prev_denom = null;
            $prev_sm_code = null;
            $prev_amount = null;
            $prev_amount2 = null;
            $label2 = 'REMITTANCE';

            foreach ($data4 as $row) {
                $cur_denom = $row->manualsrr;
                $cur_sm_code = $row->id_no;
                $cur_amount = $row->total_remittance;
                $cur_amount2 = $row->total_collection;
                
                // Check if cur row has the same date, sm_code, and amount as the previous row
                if ($cur_denom === $prev_denom && $cur_sm_code === $prev_sm_code && $cur_amount === $prev_amount && $cur_amount2 === $prev_amount2) {
                    $csv_data = ''; // Reset $csv_data to empty
                } else {
                    // Concatenate the cur date with the row data
                    $csv_data .= $label2 . '|' . implode('|', (array) $row) . "\n";
                }
    
                
                $prev_denom = $cur_denom;
                $prev_sm_code = $cur_sm_code;
                $prev_amount = $cur_amount;
                $prev_amount2 = $cur_amount2;
            }


            // Set a filename for the downloaded file
            @$sm_data = $this->Model_Cashier_Sm->getPaymentsMpdiDenom($denom_id);

            $sm_code = $sm_data->id_no;
            
            //$sm_name =$this->Model_Cashier_Sm->getUserFullName($sm_code);
            $sm_fullname = $sm_data->full_name;
            
            $date_today = date('Ymd'); // Format the date as YYYYMMDD

            // Create the filename dynamically
            $filename2 = $sm_code . '_' . $sm_fullname . '_' . $date_today . '.txt';
            // var_dump($filename2);

            // Set content type and headers for file download
            header('Content-Type: application/json'); // Change content type to text/plain for a .txt file
            header('Content-Disposition: attachment; filename="' . $filename2 . '"');
            header('Content-Length: ' . strlen($csv_data));

            // Output the pipe-separated data
            echo $csv_data;
            exit();
        }

        
    }
?>