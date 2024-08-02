<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class Cont_Bank extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Model_Bank');
        }

        public function index()
        {
            $data['result'] = $this->Model_Bank->getAllData();
            $this->load->view('header');
            $this->load->view('bank', $data);
            $this->load->view('footer');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        public function insertBank()
        {
            if($this->Model_Bank->checkBankCode($this->input->post('code')) == true)
            {
                echo 'exist-code';
                return false;
            }
            if($this->Model_Bank->checkBankName($this->input->post('name')) == true)
            {
                echo 'exist-name';
                return false;
            }
            else
            {
                $this->Model_Bank->insertBank();
                echo 'ok';
            }
        }

        public function updateBank()
        {
            if($this->Model_Bank->checkBankCode2($this->input->post('code'),$this->input->post('id')) == true)
            {
                echo 'exist-code';
                return false;
            }
            if($this->Model_Bank->checkBankName2($this->input->post('name'),$this->input->post('id')) == true)
            {
                echo 'exist-name';
                return false;
            }
            else
            {
                $this->Model_Bank->updateBank($this->input->post('id'));
                echo 'ok';
            }
        }

        public function deleteBank()
        {
            $this->Model_Bank->deleteData($this->input->post('ids'));
        }

        public function addbank_content()
        {
            echo '<div class="alert alert-danger" id="msg" role="alert" style="display: none"></div>';
            echo '<div class="form-group">
                        <label for="code">Bank Code</label>
                        <input type="text" class="form-control" name="code" id="code" autocomplete="off" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Bank Name</label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="bu">Business Unit</label>
                        <select class="form-control" name="bu" id="bu" required>
                            <option value="All">All</option>
                            <option value="UWDG Only">UWDG Only</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bu">Bank Type</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="Other Bank">Other Bank</option>
                            <option value="PNB Bank">PNB Bank</option>
                        </select>
                    </div>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Bank </button>';
        }

        public function editbank_content()
        {
            $row = $this->Model_Bank->getData($_POST['ids']);
            $bu = $row->bu;
            $type = $row->bank_type;
            echo '<div class="alert alert-danger" id="msg" role="alert" style="display: none"></div>';
            echo '<div class="form-group">
                        <label for="code">Bank Code</label>
                        <input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->bank_id.'" required> 
                        <input type="text" class="form-control" name="code" id="code" autocomplete="off" value="'.$row->code.'" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Bank Name</label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off" value="'.$row->name.'" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="bu">Business Unit</label>
                        <select class="form-control" name="bu" id="bu" required>';
                            if($bu == 'All'){$bu3 = 'selected';}else{$bu3 = '';}
                            if($bu == 'UWDG Only'){$bu1 = 'selected';}else{$bu1 = '';}
            echo           '<option value="All" '.$bu3.'>All</option>
                            <option value="UWDG Only" '.$bu1.'>UWDG Only</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bu">Bank Type</label>
                        <select class="form-control" name="type" id="type" required>';
                            if($type == 'Other Bank'){$type3 = 'selected';}else{$type3 = '';}
                            if($type == 'PNB Bank'){$type1 = 'selected';}else{$type1 = '';}
            echo           '<option value="Other Bank" '.$type3.'>Other Bank</option>
                            <option value="PNB Bank" '.$type1.'>PNB Bank</option>
                        </select>
                    </div>
                    <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                    <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Update Bank </button>';
        }
    }
?>