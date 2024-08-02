<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Manila');

    class CrudController extends CI_Controller {
        public function __construct()
        {
            parent:: __construct();
            $this->check_session();
            $this->load->model('Crud_Model');
        }

        public function index()
        {
            $this->load->view('header');
            if($this->session->userdata('type')=="Cashier")
            {
                $this->load->view('dashboard-cashier');
            }
            elseif($this->session->userdata('type')=="Salesman")
            {
                $this->load->view('dashboard-salesman');
            }
            $this->load->view('footer');
        }

        public function logout()
        {
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('password');
            $this->session->unset_userdata('full_name');
            redirect('login');
        }

        private function check_session()
        {
            if(!$this->session->userdata('username'))
            {
                redirect('login');
            }
        }

        public function crudcreate()
        {
            if($this->Crud_Model->checkUser($this->input->post('username')) == true)
            {
                echo 'try';
            }
            else
            {
                $this->Crud_Model->insertData();
                // redirect('user');
            }
        }

        public function crudupdate()
        {
            if($this->Crud_Model->checkUser2($this->input->post('username'),$this->input->post('id')) == true)
            {
                echo 'try';
            }
            else
            {
                $this->Crud_Model->updateData($this->input->post('id'));
                // redirect('user');
            }
        }

        public function checkUsername()
        {
            if($this->Crud_Model->checkUser2($this->input->post('username'),$this->input->post('id')) == true)
            {
                echo "wrong";
            }
            else
            {
                $this->Crud_Model->changeUsername($this->input->post('id'));
                echo "okay";
            }
        }

        public function changeLocation()
        {
            $this->Crud_Model->changeLocation($this->input->post('id'));
            echo 'okay';
            // echo $this->session->userdata('location');
        }

        public function changeBu()
        {
            $this->Crud_Model->changeBu($this->input->post('id'));
            echo 'okay';
            // echo $this->session->userdata('location');
        }

        public function checkCurrentPassword()
        {
            if($this->Crud_Model->checkpassword($this->input->post('current_password'),$this->input->post('id')) == true)
            {
                $this->Crud_Model->changePassword($this->input->post('id'));
                echo 'okay';
            }
            else
            {
                echo 'wrong';
            }
        }

        public function cruddelete()
        {
            $this->Crud_Model->deleteData($this->input->post('ids'));
            // redirect('user');
        }

        public function crudreset()
        {
            $this->Crud_Model->resetData($this->input->post('ids'));
            // redirect('user');
        }
        
        public function user()
        {
            $data['result'] = $this->Crud_Model->getAllData();
            $this->load->view('header');
            $this->load->view('user',$data);
            $this->load->view('footer');
        }

        public function adduser_content()
        {
            echo '<div class="alert alert-danger" id="msg" role="alert" style="display: none">Username already exist!</div>';
            echo '<div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" autocomplete="off" placeholder="Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="idno">Navision Salesman Code</label>
                            <input type="text" class="form-control" name="idno" id="idno" autocomplete="off" placeholder="Navision Salesman Code" required>
                        </div>
                        <div class="form-group">
                            <label for="bu">Location</label>
                            <select class="form-control" name="bu" id="bu" required>
                                <option value="WDG">WDG</option>
                                <option value="UWDG">UWDG</option>
                                <option value="WDG-CDC">WDG-CDC</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loc">Business Unit</label>
                            <select class="form-control" name="loc" id="loc" required>
                               
                                <option value="WDG">WDG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">User Type</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="Salesman">Salesman</option>
                                <option value="JefeDeViaje">JefeDeViaje</option>
                                <option value="Walk-In">Walk-In</option>
                                <option value="OtherCharges">OtherCharges</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">User Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <input type="hidden" value="'.date('m/d/y').'" class="form-control" name="date" id="date" autocomplete="off">
                        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save User </button>';

                        // <option value="LDI-XTRUCK">LDI-XTRUCK</option>
                        // <option value="LDI-FROZEN">LDI-FROZEN</option>
                        // <option value="LDI-MPDI">LDI-MPDI</option>
                        // <option value="LDI-CVS">LDI-CVS</option>
                        // <option value="LDI-3PS">LDI-3PS</option>
        }

        public function edituser_content()
        {
            $row = $this->Crud_Model->getData($_POST['ids']);
            $bu = $row->location;
            $loc = $row->bu;
            $type = $row->type;
            $stat = $row->status;
            echo '<div class="alert alert-danger" id="msg" role="alert" style="display: none">Username already exist!</div>';
            echo '<div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                            <input type="text" class="form-control" name="fullname" id="fullname" autocomplete="off" value="'.$row->full_name.'" placeholder="Full Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="'.$row->username.'" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="idno">Navision Salesman Code</label>
                            <input type="text" class="form-control" name="idno" id="idno" autocomplete="off" value="'.$row->id_no.'" placeholder="Navision Salesman Code" required>
                        </div>
                        <div class="form-group">
                            <label for="bu">Location</label>
                            <select class="form-control" name="bu" id="bu" required>';
                                if($bu == 'WDG'){$bu3 = 'selected';}else{$bu3 = '';}
                                if($bu == 'UWDG'){$bu1 = 'selected';}else{$bu1 = '';}
                                // if($bu == 'LDI'){$bu2 = 'selected';}else{$bu2 = '';}
                                

                                // if($bu == 'LDI-CDC'){$bu6 = 'selected';}else{$bu6 = '';}

                                // if($bu == 'LDI-XTRUCK'){$bu5 = 'selected';}else{$bu5 = '';}
                                // if($bu == 'LDI-FROZEN'){$bu7 = 'selected';}else{$bu7 = '';}
                                // if($bu == 'LDI-MPDI'){$bu8 = 'selected';}else{$bu8 = '';}
                                // if($bu == 'LDI-CVS'){$bu9 = 'selected';}else{$bu9 = '';}
                                // if($bu == 'LDI-3PS'){$bu10 = 'selected';}else{$bu10 = '';}

                                // <option value="LDI-XTRUCK" '.$bu5.'>LDI-XTRUCK</option>
                                // <option value="LDI-FROZEN" '.$bu7.'>LDI-FROZEN</option>
                                // <option value="LDI-MPDI" '.$bu8.'>LDI-MPDI</option>
                                // <option value="LDI-CVS" '.$bu9.'>LDI-CVS</option>
                                // <option value="LDI-3PS" '.$bu10.'>LDI-3PS</option>

                                // <option value="LDI" '.$bu2.'>LDI-HO</option><option value="LDI-CDC" '.$bu6.'>LDI-CDC</option>

                                if($bu == 'WDG-CDC'){$bu4 = 'selected';}else{$bu4 = '';}
            echo                '<option value="WDG" '.$bu3.'>WDG</option>
                                <option value="UWDG" '.$bu1.'>UWDG</option>
                                
                                

                                <option value="WDG-CDC" '.$bu4.'>WDG-CDC</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loc">Business Unit</label>
                            <select class="form-control" name="loc" id="loc" required>';
                                // if($loc == 'OPLAN'){$oplan = 'selected';}else{$oplan = '';}
                                // if($loc == 'HORECA'){$horeca = 'selected';}else{$horeca = '';}
                                // if($loc == 'FROZEN'){$frozen = 'selected';}else{$frozen = '';}
                                // if($loc == '3PS'){$ps = 'selected';}else{$ps = '';}
                                // if($loc == 'MPDI'){$mpdi = 'selected';}else{$mpdi = '';}
                                // if($loc == 'CVS'){$cvs = 'selected';}else{$cvs = '';}
                                // if($loc == 'XTRUCK'){$xtruck = 'selected';}else{$xtruck = '';}
                                if($loc == 'WDG'){$wdg = 'selected';}else{$wdg = '';}

            echo                '
                                <option value="WDG" '.$wdg.'>WDG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type">User Type</label>
                            <select class="form-control" name="type" id="type" required>';
                                if($type == 'Admin'){$admin = 'selected';}else{$admin = '';}
                                if($type == 'Salesman'){$sm = 'selected';}else{$sm = '';}
                                if($type == 'Cashier'){$cash = 'selected';}else{$cash = '';}
                                if($type == 'JefeDeViaje'){$jdv = 'selected';}else{$jdv = '';}
                                if($type == 'Walk-In'){$wi = 'selected';}else{$wi = '';}
                                if($type == 'OtherCharges'){$oc = 'selected';}else{$oc = '';}
            echo                '<option value="Salesman" '.$sm.'>Salesman</option>
                                <option value="JefeDeViaje" '.$jdv.'>JefeDeViaje</option>
                                <option value="Walk-In" '.$wi.'>Walk-In</option>
                                <option value="OtherCharges" '.$oc.'>OtherCharges</option>
                                <option value="Cashier" '.$cash.'>Cashier</option>
                                <option value="Admin" '.$admin.'>Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">User Status</label>
                            <select class="form-control" name="status" id="status" value="'.$row->status.'" required>';
                                if($stat == 'Active'){$stat1 = 'selected';}else{$stat1 = '';}
                                if($stat == 'Inactive'){$stat2 = 'selected';}else{$stat2 = '';}
            echo               '<option value="Active" '.$stat1.'>Active</option>
                                <option value="Inactive" '.$stat2.'>Inactive</option>
                            </select>
                        </div>
                        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Update User </button>';
        }

        public function user_password()
        {
            $row = $this->Crud_Model->getData($_POST['ids']);

            echo '<div class="alert alert-danger" id="msg" role="alert" style="display: none"></div>';
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                        <div class="form-group">
                            <label for="password">Current Password <i style="font-size: 13px;color: blue">(Enter your current password to change it.)</i></label>
                            <input type="password" class="form-control" name="current_password" id="current_password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" required>
                        </div>
                        <input type="hidden" value="'.date('m/d/y').'" class="form-control" name="date" id="date" autocomplete="off">
                        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
        }

        public function user_location()
        {
            $row = $this->Crud_Model->getData($_POST['ids']);
            $bu = $row->location;

            if($bu == 'WDG'){$bu3 = 'selected';}else{$bu3 = '';}
            if($bu == 'UWDG'){$bu1 = 'selected';}else{$bu1 = '';}
            if($bu == 'WDG-CDC'){$bu4 = 'selected';}else{$bu4 = '';}
            
            echo '<h5>Current Location: '.$bu.'</h5><br/>';
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                <div class="form-group">
                    <label for="type">Location</label>
                    <select class="form-control" name="bu" id="bu" required>
                        <option value="WDG" '.$bu3.'>WDG</option>
                        <option value="UWDG" '.$bu1.'>UWDG</option>
                        <option value="WDG-CDC" '.$bu4.'>WDG-CDC</option>
                    </select>
                 </div>
                 <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                 <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
        }

        public function user_bu()
        {
            $row = $this->Crud_Model->getData($_POST['ids']);
            $bu_loc = $row->bu;

            if($bu_loc == 'WDG'){$bu_loc1 = 'selected';}else{$bu_loc1 = '';}
            
           
            echo '<h5>Current BU: '.$bu_loc.'</h5><br/>';
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                <div class="form-group">
                    <label for="type">BU</label>
                    <select class="form-control" name="loc" id="loc" required>
                        <option value="WDG" '.$bu_loc1.'>WDG</option>
                       
                    </select>
                 </div>
                 <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                 <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
        }

        public function user_username()
        {
            $row = $this->Crud_Model->getData($_POST['ids']);

            echo '<div class="alert alert-danger" id="msg" role="alert" style="display: none"></div>';
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" value="'.$row->username.'" required>
                        </div>
                        <input type="hidden" value="'.date('m/d/y').'" class="form-control" name="date" id="date" autocomplete="off">
                        <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                        <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
        }
    }
?>