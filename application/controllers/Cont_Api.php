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

        // public function get_data() {
        //     $data = $this->Model_Cashier_Sm->get_data();

        //     // Set content type to plain text
        //     $this->output->set_content_type('application/json');

        //     // Output data in | separated format without headers
        //     foreach ($data as $row) {
        //         echo implode('|', (array) $row) . "\n";
        //     }
        // }

        public function get_data() {
            $data = $this->Model_Cashier_Sm->get_data();

            // Convert data to pipe-separated format without headers
            $csv_data = '';
            foreach ($data as $row) {
                $csv_data .= implode('|', (array) $row) . "\n";
            }

            // Set a filename for the downloaded file
            $filename = 'Aris_to_xtruck.txt';

            // Set content type and headers for file download
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . strlen($csv_data));

            // Output the pipe-separated data
            echo $csv_data;
        }

    
        

        

        

        

        
    }
?>