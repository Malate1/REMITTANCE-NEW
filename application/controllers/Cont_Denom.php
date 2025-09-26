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

        public function check_manualsrr_exists()
        {
            $manualsrr = $this->input->post('manualsrr');
            

            $exists = $this->Model_Denom->check_manualsrr($manualsrr);

            echo json_encode(['exists' => $exists]);
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
            //$data['result'] = $this->Model_Denom->getDenomData();
            $this->load->view('header');
            $this->load->view('smdenom_ledger');
            $this->load->view('footer');
        }

        public function fetch_ledger_data()
        {
            
            $list = $this->Model_Denom->get_datatables();
            $data = array();

            $today = date('Y-m-d');
            $location = $this->session->userdata('location');
            $bu = $this->session->userdata('bu');

            foreach ($list as $row) {
                $nested = array();

                $nested['date_added'] = $row->date_added;
                $nested['manualsrr'] = $row->manualsrr;
                $nested['total_dc'] = number_format($row->total_dc, 2);
                $nested['total_pdc'] = number_format($row->total_pdc, 2);
                $nested['total_cash'] = number_format($row->total_cash, 2);
                $nested['total_palawan'] = number_format(@$row->total_palawan, 2);
                $nested['total_collection'] = number_format($row->total_collection + @$row->total_palawan, 2);

                if (!in_array($location, ['LDI', 'LDI-CDC', 'LDI-UDC'])) {
                    $nested['total_remittance'] = number_format($row->total_remittance, 2);
                }

                if (in_array($location, ['LDI', 'LDI-CDC', 'LDI-UDC'])) {
                    $nested['total_returns'] = number_format($row->total_returns, 2);
                    $nested['vat_or_wtax'] = in_array($bu, ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI']) 
                        ? number_format($row->wtax, 2) 
                        : number_format($row->vat, 2);
                    $nested['bo'] = number_format($row->bo, 2);
                }

                if (in_array($bu, ['XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'XTRUCK-NETMAN-BPI'])) {
                    $nested['sm_inc'] = number_format($row->sm_inc, 2);
                }

                $nested['status'] = $row->status == "" 
                    ? "<span class='badge badge-danger'>Pending</span>" 
                    : "<span class='badge badge-primary'>{$row->status}</span>";

                // Begin Action buttons
                $actions = '';

                $canEdit = $row->date_added == $today && $row->status == "";
                $isLDI = in_array($location, ['LDI', 'LDI-CDC', 'LDI-UDC']);

                if ($canEdit) {
                    $actions .= "<a title='Modify Denomination' style='color: green;cursor: pointer' href='".base_url('/smdenom_edit/'.$row->denom_id)."'><i class='fas fa-pen fa-lg'></i></a>&nbsp;&nbsp;";
                }

                if (!$isLDI) {
                    $actions .= "<a title='View Denomination' style='color: skyblue;cursor: pointer' data-toggle='modal' data-target='#viewSmDenom' onclick='viewsmdenom_content(\"{$row->denom_id}\")'><i class='fas fa-eye fa-lg'></i></a>&nbsp;&nbsp;";
                } else {
                    $actions .= "<a title='View Denomination2' style='color: skyblue;cursor: pointer' data-toggle='modal' data-target='#viewSmDenomLdi' onclick='viewsmdenom_content_ldi(\"{$row->denom_id}\")'><i class='fas fa-eye fa-lg'></i></a>&nbsp;&nbsp;";
                    $actions .= "<a title='View Checks' style='color: green;cursor: pointer' href='".base_url("/viewsmchecksextruck/{$row->user_id}/{$row->date_added}/{$row->denom_id}")."'><i class='fas fa-pen-alt fa-lg'></i></a>&nbsp;&nbsp;";

                    $bu_excluded = ['OPLAN', 'XTRUCK', 'XTRUCK-NETMAN', 'XTRUCK-MPDI', 'MAS-NETMAN', 'MAS-LDI', 'MAS-MPDI', 'XTRUCK-NETMAN-BPI'];
                    if (!in_array($bu, $bu_excluded) && ($row->dc_pcs != '0' || $row->pdc_pcs != '0')) {
                        $actions .= "<a title='Check Entry' style='color: green;cursor: pointer' href='".base_url("/checkentry/{$row->denom_id}/{$row->date_added}/{$row->user_id}")."'><i class='fas fa-pen-alt fa-lg'></i></a>&nbsp;&nbsp;";
                    }
                }

                if (!empty($row->remarks)) {
                    $actions .= "<a title='Remarks' style='color: orange;cursor: pointer' data-toggle='modal' data-target='#cashierRemarks' onclick='cashier_remarks2(\"{$row->denom_id}\")'><i class='far fa-comment-dots fa-lg'></i></a>&nbsp;&nbsp;";
                }

                $nested['action'] = $actions;

                $data[] = $nested;
            }

            $output = array(
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => $this->Model_Denom->count_all(),
                "recordsFiltered" => $this->Model_Denom->count_filtered(),
                "data" => $data,
            );

            echo json_encode($output);
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
            $location = strtoupper(trim($this->security->xss_clean($this->input->post('location'))));
            $bu = strtoupper(trim($this->security->xss_clean($this->input->post('bu'))));
            $manualsrr = trim($this->security->xss_clean($this->input->post('manualsrr')));

            $requires_manualsrr = (
                ($location === "LDI"     && in_array($bu, ["OPLAN", "XTRUCK", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI", "XTRUCK-NETMAN" , "MAS-NETMAN", "MAS-LDI", "MAS-MPDI"])) ||
                ($location === "LDI-CDC" && in_array($bu, ["OPLAN", "XTRUCK", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI", "XTRUCK-NETMAN" , "MAS-NETMAN", "MAS-LDI", "MAS-MPDI"])) ||
                ($location === "LDI-UDC" && in_array($bu, ["OPLAN", "XTRUCK", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI", "XTRUCK-NETMAN" , "MAS-NETMAN", "MAS-LDI", "MAS-MPDI"]))
            );

            if ($requires_manualsrr && empty($manualsrr)) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Manual SRR is required.'
                ));
                return;
            }
            $denom_id = $this->Model_Denom->save_denom();
            if ($denom_id) {
                echo json_encode(array('status' => 'ok', 'denom_id' => $denom_id));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to save denomination'));
            }
            
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
            //BATCHING
            $result             = $this->Model_Denom->get_collection($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_dc_amt      = $this->Model_Denom->get_collection_dcamt($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_dc_pcs      = $this->Model_Denom->get_collection_dcpcs($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_pdc_amt     = $this->Model_Denom->get_collection_pdcamt($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_pdc_pcs     = $this->Model_Denom->get_collection_pdcpcs($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_return      = $this->Model_Denom->get_collection_return($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_tax         = $this->Model_Denom->get_collection_tax($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_bo          = $this->Model_Denom->get_collection_bo($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_palawan     = $this->Model_Denom->get_collection_palawan_oplan($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_bo_disc     = $this->Model_Denom->get_collection_bo_disc($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_bo_admin    = $this->Model_Denom->get_collection_bo_admin($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_bo_no       = $this->Model_Denom->get_collection_bo_no($this->input->post('id_no'), $this->input->post('ndate'), $this->input->post('batch_no'));
            $result_bo_si_disc  = $this->Model_Denom->get_collection_bo_si_disc($this->input->post('id_no'), $this->input->post('ndate'), $this->input->post('batch_no'));
            $result_cash        = $this->Model_Denom->get_collection_cash($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_return_no   = $this->Model_Denom->get_collection_return_no($this->input->post('id_no'), $this->input->post('ndate'), $this->input->post('batch_no'));
            $result_pay_ids     = $this->Model_Denom->get_collection_pay_ids($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));
            $result_pay_ids_pal = $this->Model_Denom->get_collection_pay_ids_oplan_pal($this->input->post('id_no'),$this->input->post('ndate'), $this->input->post('batch_no'));

        
            // Assuming $result_return_no is an array
            $return_no_values = $result_return_no ? implode(', ', array_column($result_return_no, 'return_no')) : '';

            $bo_no_values = $result_bo_no ? implode(', ', array_column($result_bo_no, 'bo_id')) : '';

            $bo_si_values = $result_bo_si_disc ? implode(', ', array_column($result_bo_si_disc, 'si_docno')) : '';

            $pay_id_values = $result_pay_ids ? implode(', ', array_column($result_pay_ids, 'pay_id')) : '';

            $pay_id_pal_values = $result_pay_ids_pal ? implode(', ', array_column($result_pay_ids_pal, 'pay_id')) : '';
            
            echo json_encode([
                
                // 'total'         => $result->total - $result_palawan->palawan - $result_bo->total_bo,
                'total'         => $result->total - $result_palawan->palawan,
                'total_return'  => $result_return->total_return,
                'total_tax'     => $result_tax->total_tax,
                'total_bo'      => $result_bo->total_bo,
                'total_bo_disc' => $result_bo_disc->total_bo_disc,
                'total_bo_admin' => $result_bo_admin->total_bo_admin,
                'total_bo_cm'   => $result_bo->total_bo - $result_bo_disc->total_bo_disc,
                'dc_amt'        => $result_dc_amt->total_dc_amt,
                'dc_pcs'        => $result_dc_pcs->total_dc_pcs,
                'pdc_amt'       => $result_pdc_amt->total_pdc_amt,
                'cash'          => $result_cash->cash - $result_palawan->palawan,
                'pdc_pcs'       => $result_pdc_pcs->total_pdc_pcs,
                'return_no'     => $return_no_values,
                'bo_id'         => $bo_no_values,
                'pay_id'        => $pay_id_values,
                'palawan'       => $result_palawan->palawan,
                'pay_id_pal'    => $pay_id_pal_values,
                'bo_si'         => $bo_si_values

            ]);

        }

        public function get_collection_xtruck()
        {

            $start = $this->input->post('start');
            $end =  $this->input->post('end');

            $result                 = $this->Model_Denom->get_collection_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_amt          = $this->Model_Denom->get_collection_dcamt_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_amt_ret      = $this->Model_Denom->get_collection_dcamt_return_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_amt_sat      = $this->Model_Denom->get_collection_dcamt_sat($this->input->post('id_no'),$this->input->post('ndate'));

            $result_cash_sat        = $this->Model_Denom->get_collection_cash_sat($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_pcs          = $this->Model_Denom->get_collection_dcpcs_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_dc_pcs_ret      = $this->Model_Denom->get_collection_dcpcs_xtruck_ret($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_amt         = $this->Model_Denom->get_collection_pdcamt_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_amt_ret     = $this->Model_Denom->get_collection_pdcamt_return_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_amt_sat     = $this->Model_Denom->get_collection_pdcamt_sat($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_pcs         = $this->Model_Denom->get_collection_pdcpcs_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pdc_pcs_ret     = $this->Model_Denom->get_collection_pdcpcs_xtruck_ret($this->input->post('id_no'),$this->input->post('ndate'));

            $result_return          = $this->Model_Denom->get_collection_return_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_cash            = $this->Model_Denom->get_collection_cash_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_bo              = $this->Model_Denom->get_collection_bo_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_palawan         = $this->Model_Denom->get_collection_palawan_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_utc             = $this->Model_Denom->get_collection_utc_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pay_ids         = $this->Model_Denom->get_collection_pay_ids_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pay_ids_pal     = $this->Model_Denom->get_collection_pay_ids_xtruck_pal($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pay_ids_utc     = $this->Model_Denom->get_collection_pay_ids_xtruck_utc($this->input->post('id_no'),$this->input->post('ndate'));

            $result_pay_ids_sat     = $this->Model_Denom->get_collection_pay_ids_xtruck_sat($this->input->post('id_no'),$this->input->post('ndate'));

            $result_bo_ids          = $this->Model_Denom->get_collection_bo_ids_xtruck($this->input->post('id_no'),$this->input->post('ndate'));

            $result_inc             = $this->Model_Denom->get_collection_sm_inc($this->input->post('id_no'),$this->input->post('ndate'));

            
            // Assuming $result_return_no is an array
            $sat_cash1 = 0.00;
            $sat_cash2 = 0.00;
             $sat_cash3 = 0.00;
            $final_cash1 = 0.00;
            $final_cash2 = 0.00;
            $cash_adjustment1 = 0.00;
            $cash_adjustment2 = 0.00;

            $total_sat_dc_amt = isset($result_dc_amt_sat->total_sat_dc_amt) ? $result_dc_amt_sat->total_sat_dc_amt : 0.00;
            $total_sat_dc_pcs = isset($result_dc_amt_sat->total_sat_dc_pcs) ? $result_dc_amt_sat->total_sat_dc_pcs : 0;
            $appr_amount = isset($result_dc_amt_sat->appr_amount) ? $result_dc_amt_sat->appr_amount : 0.00;
            $total_sat_pdc_amt = isset($result_pdc_amt_sat->total_sat_pdc_amt) ? $result_pdc_amt_sat->total_sat_pdc_amt : 0.00;
            $total_sat_pdc_pcs = isset($result_pdc_amt_sat->total_sat_pdc_pcs) ? $result_pdc_amt_sat->total_sat_pdc_pcs : 0;
            $appr_amount_pdc = isset($result_pdc_amt_sat->appr_amount) ? $result_pdc_amt_sat->appr_amount : 0.00;

            $inc_balance = isset($result_inc->inc_balance) ? $result_inc->inc_balance : 0.00;

            $pay_id_values = $result_pay_ids ? implode(', ', array_column($result_pay_ids, 'pay_id')) : '';

            $pay_id_sat_values = $result_pay_ids_sat ? implode(', ', array_column($result_pay_ids_sat, 'pay_id')) : '';

            $pay_id_pal_values = $result_pay_ids_pal ? implode(', ', array_column($result_pay_ids_pal, 'pay_id')) : '';

            $pay_id_utc_values = $result_pay_ids_utc ? implode(', ', array_column($result_pay_ids_utc, 'pay_id')) : '';

            $bo_id_values = $result_bo_ids ? implode(', ', array_column($result_bo_ids, 'bo_id')) : '';

            if(isset($result_cash_sat)) {
                $sat_cash3 = floatval($result_cash_sat->appr_amount);
            }
            
            if(isset($total_sat_dc_amt)) {
                $sat_cash1 = floatval($total_sat_dc_amt) - floatval($appr_amount);
            }
            
            if(isset($total_sat_pdc_amt)) {
                $sat_cash2 = floatval($total_sat_pdc_amt) - floatval($appr_amount_pdc);
            }
            
            // For Monday
            $cash = $result_cash->cash + $sat_cash1 + $sat_cash2 - $sat_cash3 - $result_palawan->palawan - $result_utc->utc + $result_bo->bo_cash;
            if($cash < 0){
                $cash_adjustment = 0;
            }else{
                $cash_adjustment = $cash;
            }

            // var_dump($result_pdc_amt->total_pdc_amt);

            echo json_encode([
                
                'total'         => $result->total - $total_sat_dc_amt - $total_sat_pdc_amt + $sat_cash1 + $sat_cash2 + $result_bo->bo_check + $result_bo->bo_cash - $sat_cash3 - $result_palawan->palawan - $result_utc->utc,
                'total_return'  => $result_return->total,
                'dc_amt'        => $result_dc_amt->total_dc_amt     + $result_dc_amt_ret->total_dc_amt_ret   - $total_sat_dc_amt,
                'dc_pcs'        => $result_dc_pcs->total_dc_pcs     + $result_dc_pcs_ret->total_dc_pcs_ret   - $total_sat_dc_pcs,
                'pdc_amt'       => $result_pdc_amt->total_pdc_amt   + $result_pdc_amt_ret->total_pdc_amt_ret - $total_sat_pdc_amt,
                //'pdc_amt'       => $result_pdc_amt->total_pdc_amt - $total_sat_pdc_amt,
                'pdc_pcs'       => $result_pdc_pcs->total_pdc_pcs   + $result_pdc_pcs_ret->total_pdc_pcs_ret - $total_sat_pdc_pcs,
                'cash'          => $cash_adjustment,
                'bo'            => $result_bo->bo_cash + $result_bo->bo_check,
                'inc'           => $inc_balance,
                'inc2'          => $inc_balance,
                'pay_id'        => $pay_id_values,
                'pay_id_sat'    => $pay_id_sat_values,
                'pay_id_pal'    => $pay_id_pal_values,
                'pay_id_utc'    => $pay_id_utc_values,
                'bo_id'         => $bo_id_values,
                'palawan'       => $result_palawan->palawan,
            ]);


            // echo json_encode([
            //     //'total'         => $result->total - $total_sat_dc_amt - $total_sat_pdc_amt + $sat_cash1 + $sat_cash2 + $result_bo->bo_check + $result_bo->bo_cash - $sat_cash3 - $result_palawan->palawan,
            //     'total'         => $result->total - $total_sat_dc_amt - $total_sat_pdc_amt + $sat_cash1 + $sat_cash2 + $result_bo->bo_cash - $sat_cash3,
            //     'total_return'  => $result_return->total,
            //     'dc_amt'        => $result_dc_amt->total_dc_amt     - $total_sat_dc_amt,
            //     'dc_pcs'        => $result_dc_pcs->total_dc_pcs     - $total_sat_dc_pcs,
            //     'pdc_amt'       => $result_pdc_amt->total_pdc_amt   - $total_sat_pdc_amt,
            //     'pdc_pcs'       => $result_pdc_pcs->total_pdc_pcs   - $total_sat_pdc_pcs,
            //     'cash'          => $result_cash->cash + $sat_cash1 + $sat_cash2 - $sat_cash3 ,
            //     'total_cash'    => $result_cash->cash,
            //     'dc_amt_sat'    => $sat_cash1,
            //     'pdc_amt_sat'   => $sat_cash2,
            //     'cash_amt_sat'  => $sat_cash3,
            //     'bo'            => $result_bo->bo_cash,
            //     'inc'           => $inc_balance,
            //     'pay_id'        => $pay_id_values,
            //     'pay_id_sat'    => $pay_id_sat_values,
            //     'bo_id'         => $bo_id_values
                
            // ]);
            //+ $result_bo->bo_cash
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
                <label for="totalcollection">Total Remittance</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalcollection" id="totalcollection" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_collection,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalreturn">Total Returns</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalreturn" id="totalreturn" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_returns,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totaltax">Total W/Tax</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totaltax" id="totaltax" placeholder="0.00" autocomplete="off" value="'.number_format($result->wtax,2).'" readonly>
                </div>
            </div>
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalbo">Total B.O</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalbo" id="totalbo" placeholder="0.00" autocomplete="off" value="'.number_format($result->bo,2).'" readonly>
                </div>
            </div>

            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalinc">SM Incentives <span style="font-style: italic; color: red">(for EXTRUCK only)</span></label>

                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalinc" id="totalinc" placeholder="0.00" autocomplete="off" value="'.number_format($result->sm_inc,2).'" readonly>
                </div>
            </div>
            
            <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
                <div class="form-group col-md-12" style="width:450px">
                <label for="totalpalawan">Total Palawan Cash</label>
                    <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalpalawan" id="totalpalawan" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_palawan,2).'" readonly>
                </div>
            </div>'
            ;

            // <div class="form-row" style="text-align: center;font-weight: 700;font-size: 17px">
            //     <div class="form-group col-md-12" style="width:450px">
            //     <label for="totalcash">Total Accountability</label>
            //         <input type="numeric" style="text-align: center;background-color: white" class="form-control" name="totalremittance" id="totalremittance" placeholder="0.00" autocomplete="off" value="'.number_format($result->total_remittance,2).'" readonly>
            //     </div>
            // </div>
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