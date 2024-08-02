<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Customer extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Customer');
        }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('customer');
            $this->load->view('footer');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        public function upload_file()
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
                    $newLine = str_replace('"', "", $convert[$i]);
                    $explode = explode("|", $newLine);
                    $size = count($explode);

                    if($size == 9)
					{
						$customer_code = trim($explode[0]);
						$customer_name = trim($explode[1]);
						$first_address = trim($explode[2]);
						$second_address = trim($explode[3]);
						$price_group = trim($explode[4]);
						$payment_term = trim($explode[5]);
						$mother_code = trim($explode[6]);
						$credit_limit = trim($explode[7]);
						$salesman = trim($explode[8]);
					}
					else
					{
						$customer_code = "";
						$customer_name = "";
						$first_address = "";
						$second_address = "";
						$price_group = "";
						$payment_term = "";
						$mother_code = "";
						$credit_limit = "";
						$salesman = "";
                    }
                    
                    if($this->Model_Customer->checkCustomer($customer_code) == false)
                    {
                        $data = array(
                            'code' => $this->security->xss_clean($customer_code),
                            'name' => $this->security->xss_clean($customer_name),
                            'address1' => $this->security->xss_clean($first_address),
                            'address2' => $this->security->xss_clean($second_address),
                            'pricegroup' => $this->security->xss_clean($price_group),
                            'payment_term' => $this->security->xss_clean($payment_term),
                            'mother_code' => $this->security->xss_clean($mother_code),
                            'credit_limit' => $this->security->xss_clean($credit_limit),
                            'salesman' => $this->security->xss_clean($salesman)
                        );

                        $this->Model_Customer->insertCustomer($data);
                    }
                }
            }

            echo 'success';
        }

        public function save_customer()
        {
            $credit = 1;
            if($this->Model_Customer->checkCustomer($this->input->post('codes')) == true)
            {
                echo 'already';
                return false;
            }
            else
            {
                $data = array(
                    'code' => $this->security->xss_clean($this->input->post('codes')),
                    'name' => $this->security->xss_clean($this->input->post('names')),
                    'credit_limit' => $this->security->xss_clean($credit)
                );

                $this->Model_Customer->insertCustomer($data);
            }
        }
    }
?>