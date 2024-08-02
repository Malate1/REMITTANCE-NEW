<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Payments extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Payments');
            $this->load->model('Model_Cashier_Sm');
        }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('cashier_customer');
            $this->load->view('footer');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        public function get_customer()
        {
            $fetch_data = $this->Model_Payments->get_customer();
            if(count($fetch_data) > 0){
                foreach($fetch_data as $p):
                    $code = $p['code'];
                    $name = $p['name'];
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

        public function cashier_payment()
        {   
            // $data['result'] = $this->Model_Payments->getName($code);
            $data['result1'] = $this->Model_Payments->getBankData();
            $this->load->view('header');
            $this->load->view('cashier_payment', $data);
            $this->load->view('footer');
        }

        public function save_cashier_payment()
        {
            if($this->Model_Payments->selectCheck() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Payments->save_cashier_payment();
                echo 'ok';
            }
        }

        public function cashier_date()
        {
            $this->load->view('header');
            $this->load->view('cashier_ledger_date');
            $this->load->view('footer');
        }

        public function cashier_payment_data($date)
        {
            $data['result'] = $this->Model_Payments->getPaymentbyDate($date);
            $data['result2'] = $date;
            $this->load->view('header');
            $this->load->view('cashierpayment_ledger', $data);
            $this->load->view('footer');
        }

        public function cashierpayment_edit($id)
        {
            $data['result'] = $this->Model_Payments->getPayment($id);
            $data['result1'] = $this->Model_Payments->getBankData();
            $this->load->view('header');
            $this->load->view('cashier_payment-edit',$data);
            $this->load->view('footer');
        }

        public function edit_cashier_payment()
        {
            if($this->Model_Payments->selectCheck() == true)
            {
                echo 'exist';
            }
            else
            {
                $this->Model_Payments->edit_cashier_payment();
                echo 'ok';
            }
        }

        // public function delete_payment($id)
        // {   
        //     $this->Model_Payments->delete_payment($this->input->post('ids'));
        // }

        public function delete_payment()
        {   
            $collection = 0.00;
            $remittance = 0.00;

            $dc_amt = 0.00;
            $pdc_amt = 0.00;

            $result = $this->Model_Cashier_Sm->getSmDenombyDenomId($this->input->post('denomid'));
            $result2 = $this->Model_Payments->getPayment($this->input->post('ids'));

            $collection = $result->total_remittance - $result2->amount;
            $remittance = $result->total_collection - $result2->amount;
            $dc_pc      = ($result2->type == 'DC') ? ($result->dc_pcs - 1) : $result->dc_pcs;
            $pdc_pc     = ($result2->type == 'PDC') ? ($result->pdc_pcs - 1) : $result->pdc_pcs;

            $dc_amt     = ($result2->type == 'DC') ? ($result->total_dc - $result2->amount) : $result->total_dc;
            $pdc_amt    = ($result2->type == 'PDC') ? ($result->total_pdc - $result2->amount) : $result->total_pdc;

            var_dump($collection, $remittance, $dc_pc, $pdc_pc, $dc_amt, $pdc_amt);
            //var_export($result);
            //var_export($result2);
            //die();

            $this->Model_Payments->edit_sm_payment($collection, $remittance, $dc_pc, $pdc_pc, $dc_amt, $pdc_amt, $this->input->post('denomid'));
            $this->Model_Payments->delete_payment($this->input->post('ids'));

        }

        public function view_cashier_payment()
        {
            $result = $this->Model_Payments->getPayment2($_POST['ids']);
            echo '<div class="form-row">
            <div class="form-group col-md-4">
                <label for="code">Code</label>
                <input type="text" class="form-control" style="text-align: center;background-color: white" name="code" id="code" placeholder="Code" value="'.$result->cus_code.'" readonly>
            </div>
            <div class="form-group col-md-8">
                <label for="name">Name</label>
                <input type="text" class="form-control" style="text-align: center;background-color: white" name="name" id="name" value="'.$result->name.'" readonly>
            </div>
            </div>
            <div class="form-row">';
                if($result->type=="PDC"){$pdc="checked";}else{$pdc="";}
                if($result->type=='DC'){$dc='checked';}else{$dc='';}
            echo '<div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="DC" '.$dc.' value="DC" disabled>
                    <label class="form-check-label" for="DC">Dated Check (DC)</label>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="PDC" value="PDC" '.$pdc.' disabled>
                    <label class="form-check-label" for="PDC">Post Dated Check (PDC)</label>
                </div>
            </div><br/>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="checkno">Check No.</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="checkno" id="checkno" autocomplete="off" value="'.$result->check_no.'" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="duedate">Check Date</label>
                    <input type="date" class="form-control" style="text-align: center;background-color: white" name="duedate" id="duedate" autocomplete="off" value="'.$result->due_date.'" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="accname">Account Name</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accname" id="accname" autocomplete="off" value="'.$result->acc_name.'" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="accnum">Account Number</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_num.'" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bank">Bank</label>
                    <select class="form-control" name="bank" id="bank" disabled>';
                        echo '<option value="'.$result->bank.'">'.$result->bank ."-". $result->bname.'</option>';
                echo '</select>
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Check Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->amount,2).'" readonly>
                </div>
            </div>';
        }
    }
?>