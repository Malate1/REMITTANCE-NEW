<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Payments extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Payments');
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

        public function delete_payment($id)
        {   
            $this->Model_Payments->delete_payment($this->input->post('ids'));
        }

        public function delete_payment_ldi($id)
        {   
            $this->Model_Payments->delete_payment_ldi($this->input->post('ids'));
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

        public function view_cashier_payment_ldi()
        {
            $result = $this->Model_Payments->getPayment($_POST['ids']);
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
                if($result->check_type=="Post Dated Check"){$pdc="checked";}else{$pdc="";}
                if($result->check_type=='Dated Check'){$dc='checked';}else{$dc='';}
            echo '<div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="DC" '.$dc.' value="Dated Check" disabled>
                    <label class="form-check-label" for="DC">Dated Check (DC)</label>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated Check" '.$pdc.' disabled>
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
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bank">Bank</label>
                    <select class="form-control" name="bank" id="bank" disabled>';
                        echo '<option value="'.$result->check_bank.'">'.$result->check_bank ."-". $result->bname.'</option>';
                echo '</select>
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Check Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->pay_amount,2).'" readonly>
                </div>
            </div>';
        }

        public function view_cashier_payment_ldi_ext()
        {
            $result = $this->Model_Payments->getPayment3($_POST['ids']);
            echo '<div class="form-row">
            <div class="form-group col-md-4">
                <label for="code">Code</label>
                <input type="text" class="form-control" style="text-align: center;background-color: white" name="code" id="code" placeholder="Code" value="'.@$result->cus_code.'" readonly>
            </div>
            <div class="form-group col-md-8">
                <label for="name">Name</label>
                <input type="text" class="form-control" style="text-align: center;background-color: white" name="name" id="name" value="'.$result->name.'" readonly>
            </div>
            </div>
            <div class="form-row">';
                if($result->check_type=="Post Dated"){$pdc="checked";}else{$pdc="";}
                if($result->check_type=='Dated'){$dc='checked';}else{$dc='';}
            echo '<div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="DC" '.$dc.' value="Dated" disabled>
                    <label class="form-check-label" for="DC">Dated Check (DC)</label>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="check" id="PDC" value="Post Dated" '.$pdc.' disabled>
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
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="accnum" id="accnum" autocomplete="off" value="'.$result->acc_no.'" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bank">Bank</label>
                    <select class="form-control" name="bank" id="bank" disabled>';
                        echo '<option value="'.$result->check_bank.'">'.$result->check_bank ."-". $result->bname.'</option>';
                echo '</select>
                </div>
                <div class="form-group col-md-6">
                    <label for="amount">Check Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount" id="amount" autocomplete="off" value="'.number_format($result->check_amount,2).'" readonly>
                </div>
            </div>';
        }
    }
?>