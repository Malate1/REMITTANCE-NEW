<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Denom extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Denom');
        }

        public function index()
        {
            $this->load->view('header');
            $this->load->view('smdenom');
            $this->load->view('footer');
        }
    
        public function smdenom_edit($id)
        {
            $data['result'] = $this->Model_Denom->getDenom($id);
            $display = 'Allow';
            $data['locate'] = $display;
            $this->load->view('header', $data);
            $this->load->view('smdenom-edit',$data);
            $this->load->view('footer');
        }

        public function sm_ledger()
        {
            $data['result'] = $this->Model_Denom->getDenomData();
            $this->load->view('header');
            $this->load->view('smdenom_ledger',$data);
            $this->load->view('footer');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        public function save_denom()
        {
            // if($this->Model_Denom->checkDenom($this->input->post('date'))==true)
            // {
            //     echo 'exist';
            // }
            // else
            // {
                $this->Model_Denom->save_denom();
                echo 'ok';
            // }
        }

        public function update_denom()
        {
            $this->Model_Denom->update_denom();
        }

        public function view_denom($id)
        {
            $data['result'] = $this->Model_Denom->getDenom($id);
            $this->load->view('header');
            $this->load->view('smdenom-view',$data);
            $this->load->view('footer');
        }

        public function delete_denom($id)
        {
            $this->Model_Denom->delete_denom($this->input->post('ids'));
        }

        public function cashierdenom()
        {
            $this->load->view('header');
            $this->load->view('cashierdenom');
            $this->load->view('footer');
        }

        public function save_denom_cashier()
        {
            // if($this->Model_Denom->checkDenom($this->input->post('date'))==true)
            // {
            //     echo 'exist';
            // }
            // else
            // {
                $this->Model_Denom->save_denom_cashier();
                echo 'ok';
            // }
        }

        public function cashier_ledger()
        {
            $data['result'] = $this->Model_Denom->getDenomData();
            $this->load->view('header');
            $this->load->view('cashierdenom_ledger',$data);
            $this->load->view('footer');
        }

        public function cashierdenom_edit($id)
        {
            $data['result'] = $this->Model_Denom->getDenom($id);
            $this->load->view('header');
            $this->load->view('cashierdenom-edit',$data);
            $this->load->view('footer');
        }

        public function update_denom_cashier()
        {
            $this->Model_Denom->update_denom_cashier();
        }

        public function get_collection()
        {
            $result = $this->Model_Denom->get_collection($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_amt = $this->Model_Denom->get_collection_dcamt($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_pcs = $this->Model_Denom->get_collection_dcpcs($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_amt = $this->Model_Denom->get_collection_pdcamt($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_pcs = $this->Model_Denom->get_collection_pdcpcs($this->input->post('id_no'),$this->input->post('ndate'));

            $result_return = $this->Model_Denom->get_collection_return($this->input->post('id_no'),$this->input->post('ndate'));

            $result_cash = $this->Model_Denom->get_collection_cash($this->input->post('id_no'),$this->input->post('ndate'));

            $result_return_no = $this->Model_Denom->get_collection_return_no($this->input->post('id_no'), $this->input->post('ndate'));

            $result_pay_ids = $this->Model_Denom->get_collection_pay_ids($this->input->post('id_no'),$this->input->post('ndate'));
            

            // Assuming $result_return_no is an array
            $return_no_values = $result_return_no ? implode(', ', array_column($result_return_no, 'return_no')) : '';

            $pay_id_values = $result_pay_ids ? implode(', ', array_column($result_pay_ids, 'pay_id')) : '';

            echo json_encode([
                'total' => $result->total,
                'total_return' => $result_return->total_return,
                'dc_amt' => $result_dc_amt->total_dc_amt,
                'dc_pcs' => $result_dc_pcs->total_dc_pcs,
                'pdc_amt' => $result_pdc_amt->total_pdc_amt,
                'cash' => $result_cash->cash,
                'pdc_pcs' => $result_pdc_pcs->total_pdc_pcs,
                'return_no' => $return_no_values,
                'pay_id' => $pay_id_values
            ]);

        }

        public function view_allsm_denom()
        {
            $result = $this->Model_Denom->getAllDenom($_POST['dates']);
            echo '<div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-1000" id="qty-1000" value="'.$result->qty1000.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="amount-1000">Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="'.number_format($result->amt1000,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control"style="text-align: center;background-color: white" name="qty-500" id="qty-500" value="'.$result->qty500.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="'.number_format($result->amt500,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-200" id="qty-200" value="'.$result->qty200.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="'.number_format($result->amt200,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-100" id="qty-100" value="'.$result->qty100.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="'.number_format($result->amt100,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-50" id="qty-50" value="'.$result->qty50.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="'.number_format($result->amt50,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-20" id="qty-20" value="'.$result->qty20.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="'.number_format($result->amt20,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12">
                    <label for="coins">Total Coins</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="coins" id="coins" value="'.number_format($result->totalcoins,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4">
                    <label for="dc">Total DC</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="dc" id="dc" value="'.number_format($result->totaldc,2).'" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="dc_pcs">Pcs.</label>
                    <input type="text" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="dc_pcs" id="dc_pcs" value="'.$result->dcpcs.'" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="pdc">Total PDC</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="pdc" id="pdc" value="'.number_format($result->totalpdc,2).'" readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="pdc_pcs">Pcs.</label>
                    <input type="text" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="pdc_pcs" id="pdc_pcs" value="'.$result->pdcpcs.'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12">
                <label for="totalcash">Total Cash</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="'.number_format($result->totalcash,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12">
                <label for="totalcash">Total Remittance</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->totalcollection,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12">
                <label for="totalcash">Total Collection</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->totalremittance,2).'" readonly>
                </div>
            </div>';
        }

        public function view_sm_denom()
        {
            $result = $this->Model_Denom->getDenom($_POST['ids']);
            echo '<input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" placeholder="denom_id" value="'.$result->denom_id.'">
            <h5>'.$result->full_name.' (SRR No. '.$_POST['ids'].')</h5>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-1000" id="qty-1000" value="'.$result->qty_1000.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <label for="amount-1000">Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="'.number_format($result->amt_1000,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control"style="text-align: center;background-color: white" name="qty-500" id="qty-500" value="'.$result->qty_500.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="'.number_format($result->amt_500,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-200" id="qty-200" value="'.$result->qty_200.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="'.number_format($result->amt_200,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-100" id="qty-100" value="'.$result->qty_100.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="'.number_format($result->amt_100,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-50" id="qty-50" value="'.$result->qty_50.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="'.number_format($result->amt_50,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-20" id="qty-20" value="'.$result->qty_20.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="'.number_format($result->amt_20,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                    <label for="coins">Total Coins</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="coins" id="coins" value="'.number_format($result->total_coins,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Cash</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_cash,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4" style="width:225px">
                    <label for="dc">Total DC</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="dc" id="dc" value="'.number_format($result->total_dc,2).'" readonly>
                </div>
                <div class="form-group col-md-2" style="width:225px">
                    <label for="dc_pcs">Pcs.</label>
                    <input type="text" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="dc_pcs" id="dc_pcs" value="'.$result->dc_pcs.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:225px">
                    <label for="pdc">Total PDC</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="pdc" id="pdc" value="'.number_format($result->total_pdc,2).'" readonly>
                </div>
                <div class="form-group col-md-2" style="width:225px">
                    <label for="pdc_pcs">Pcs.</label>
                    <input type="text" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="pdc_pcs" id="pdc_pcs" value="'.$result->pdc_pcs.'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Remittance</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_collection,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Collection</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_remittance,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Expenses Amount</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->expenses_amt,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Expenses Details</label>
                <textarea class="form-control" id="expenses" name="expenses" autocomplete="off" rows="3" style="background-color: white" readonly>'.$result->expenses.'</textarea>
                </div>
            </div>'
            ;
        }

        public function view_sm_denom_ldi()
        {
            $result = $this->Model_Denom->getDenom($_POST['ids']);
            echo '<input type="hidden" class="form-control" style="text-align: center;background-color: white" name="denom_id" id="denom_id" placeholder="denom_id" value="'.$result->denom_id.'">
            <h5>'.$result->full_name.' (SRR No. '.$_POST['ids'].')</h5>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-1000" id="qty-1000" value="'.$result->qty_1000.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <label for="amount-1000">Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="'.number_format($result->amt_1000,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control"style="text-align: center;background-color: white" name="qty-500" id="qty-500" value="'.$result->qty_500.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="'.number_format($result->amt_500,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-200" id="qty-200" value="'.$result->qty_200.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="'.number_format($result->amt_200,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-100" id="qty-100" value="'.$result->qty_100.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="'.number_format($result->amt_100,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-50" id="qty-50" value="'.$result->qty_50.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="'.number_format($result->amt_50,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4" style="width:100px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4" style="width:150px">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center;background-color: white" name="qty-20" id="qty-20" value="'.$result->qty_20.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:200px">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="'.number_format($result->amt_20,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                    <label for="coins">Total Coins</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="coins" id="coins" value="'.number_format($result->total_coins,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Cash</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_cash,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4" style="width:225px">
                    <label for="dc">Total DC</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="dc" id="dc" value="'.number_format($result->total_dc,2).'" readonly>
                </div>
                <div class="form-group col-md-2" style="width:225px">
                    <label for="dc_pcs">Pcs.</label>
                    <input type="text" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="dc_pcs" id="dc_pcs" value="'.$result->dc_pcs.'" readonly>
                </div>
                <div class="form-group col-md-4" style="width:225px">
                    <label for="pdc">Total PDC</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="pdc" id="pdc" value="'.number_format($result->total_pdc,2).'" readonly>
                </div>
                <div class="form-group col-md-2" style="width:225px">
                    <label for="pdc_pcs">Pcs.</label>
                    <input type="text" min="1" step="1" class="form-control" style="text-align: center;background-color: white" name="pdc_pcs" id="pdc_pcs" value="'.$result->pdc_pcs.'" readonly>
                </div>
            </div>

            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Accountability</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalremittance" id="totalremittance" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_remittance,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Remittance</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_collection,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Returns</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalreturn" id="totalreturn" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_returns,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total W/Tax</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totaltax" id="totaltax" placeholder="0.00" autocomplete="off" value="'.number_format($result->vat,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total B.O</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalbo" id="totalbo" placeholder="0.00" autocomplete="off" value="'.number_format($result->bo,2).'" readonly>
                </div>
            </div>'
            ;
        }

        public function view_cashier_denom()
        {
            $result = $this->Model_Denom->getDenom($_POST['ids']);
            echo '<input type="hidden" class="form-control" style="text-align: center;background-color: white" name="id" id="id" placeholder="id" value="'.$result->denom_id.'">
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <label for="note-1000">Notes</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-1000" id="note-1000" placeholder="1000" value="1000" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label for="qty-1000">Quantity</label>
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center" name="qty-1000" id="qty-1000" value="'.$result->qty_1000.'">
                </div>
                <div class="form-group col-md-4">
                    <label for="amount-1000">Amount</label>
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-1000" id="amount-1000" placeholder="0.00" value="'.number_format($result->amt_1000,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-500" id="note-500" placeholder="500" value="500" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center" name="qty-500" id="qty-500" value="'.$result->qty_500.'">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-500" id="amount-500" placeholder="0.00" value="'.number_format($result->amt_500,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-200" id="note-200" placeholder="200" value="200" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center" name="qty-200" id="qty-200" value="'.$result->qty_200.'">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-200" id="amount-200" placeholder="0.00" value="'.number_format($result->amt_200,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-100" id="note-100" placeholder="100" value="100" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center" name="qty-100" id="qty-100" value="'.$result->qty_100.'">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-100" id="amount-100" placeholder="0.00" value="'.number_format($result->amt_100,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-50" id="note-50" placeholder="50" value="50" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center" name="qty-50" id="qty-50" value="'.$result->qty_50.'">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-50" id="amount-50" placeholder="0.00" value="'.number_format($result->amt_50,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 20px">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="note-20" id="note-20" placeholder="20" value="20" readonly>
                </div>
                <div class="form-group col-md-4">
                    <input autocomplete="off" type="number" class="form-control" style="text-align: center" name="qty-20" id="qty-20" value="'.$result->qty_20.'">
                </div>
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" style="text-align: center;background-color: white" name="amount-20" id="amount-20" placeholder="0.00" value="'.number_format($result->amt_20,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-4">
                    <label for="coins">Total Coins</label>
                    <input autocomplete="off" type="text" class="form-control" style="text-align: center;background-color: white" name="coins" id="coins" value="'.number_format($result->total_coins,2).'">
                </div>
                <div class="form-group col-md-8">
                    <label for="totalcash">Total Cash</label>
                    <input type="text" style="text-align: center;background-color: white" class="form-control" name="totalcash" id="totalcash" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_cash,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalcash">Total Collection</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_collection,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:550px">
                <label for="totalcash">Expenses</label>
                <textarea class="form-control" id="expenses" name="expenses" autocomplete="off" rows="3" style="background-color: white" readonly>'.$result->expenses.'</textarea>
                </div>
            </div>';
        }
    }
?>