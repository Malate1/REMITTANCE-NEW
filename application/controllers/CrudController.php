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
                // Date and BU filters from GET (for top_salesmen chart)
                $start_date = $this->input->get('start_date') ?: date('Y-m-01');
                $end_date   = $this->input->get('end_date') ?: date('Y-m-t');
                $bu         = $this->input->get('bu');

                // Count today's remittances
                $this->db->from('denomination a');
                $this->db->join('users b', 'a.user_id = b.user_id');
                $this->db->where('a.date_added', date('Y-m-d'));
                $this->db->where('b.location', $this->session->userdata('location'));
                $count_today = $this->db->count_all_results();

                // Count all denominations per location
                $this->db->from('denomination a');
                $this->db->join('users b', 'a.user_id = b.user_id');
                $this->db->where('b.location', $this->session->userdata('location'));
                $total_denom = $this->db->count_all_results();

                // Top Salesmen Chart Data
                $salesmen_data = $this->Crud_Model->get_top_salesmen_by_remittance($start_date, $end_date, $bu);
                $bu_list = $this->Crud_Model->get_all_bu();

                $data = [
                    'remittance_count' => $count_today,
                    'total_denom_count' => $total_denom,
                    'location' => $this->session->userdata('bu'),

                    // For chart
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'selected_bu' => $bu,
                    'salesmen' => $salesmen_data,
                    'bu_list' => $bu_list
                ];

                $this->load->view('dashboard-cashier', $data);
            }
            elseif($this->session->userdata('type')=="Salesman")
            {
                $this->load->view('dashboard-salesman');  
            }
            $this->load->view('footer');
        }

        public function top_salesmen() {
            
            // Get filters from GET (URL or form)
            $start_date = $this->input->get('start_date') ?: date('Y-m-01');
            $end_date = $this->input->get('end_date') ?: date('Y-m-t');
            $bu = $this->input->get('bu'); // Business Unit (optional)
    
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            $data['selected_bu'] = $bu;
    
            $data['salesmen'] = $this->Crud_Model->get_top_salesmen_by_remittance($start_date, $end_date, $bu);
            $data['bu_list'] = $this->Crud_Model->get_all_bu(); // For dropdown
    
            $this->load->view('dashboard-cashier',$data);
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

        public function logs()
        {
            $data['result'] = $this->Crud_Model->getLogs();
            $this->load->view('header');
            $this->load->view('key_logs',$data);
            $this->load->view('footer');
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
                                
                                <option value="LDI">LDI-HO</option>
                               
                                <option value="LDI-CDC">LDI-CDC</option>
                                <option value="LDI-UDC">LDI-UDC</option>
                                <option value="LDI-Parallel">LDI-Parallel</option>
                                

                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loc">Business Unit</label>
                            <select class="form-control" name="loc" id="loc" required>
                                <option value="OPLAN">OPLAN</option>
                                <option value="HORECA">HORECA</option>
                                <option value="FROZEN">FROZEN</option>
                                <option value="3PS">3PS</option>
                                <option value="CVS">CVS</option>
                                <option value="MPDI">MPDI</option>
                                <option value="XTRUCK">XTRUCK-LDI</option>
                                <option value="XTRUCK-NETMAN">XTRUCK-NETMAN</option>
                                <option value="XTRUCK-MPDI">XTRUCK-MPDI</option> 
                                <option value="UNILAB">UNILAB</option>
                                <option value="MAS-LDI">MAS-LDI</option>
                                <option value="MAS-NETMAN">MAS-NETMAN</option>
                                <option value="MAS-MPDI">MAS-MPDI</option>
                                
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
                                
                                
                                $bu2 = ($bu == 'LDI') ? 'selected' : '';
                                $bu3 = ($bu == 'LDI-CDC') ? 'selected' : '';
                                $bu4 = ($bu == 'LDI-UDC') ? 'selected' : '';
                                $bu5 = ($bu == 'LDI-BB') ? 'selected' : '';
                                $bu6 = ($bu == 'LDI-Parallel') ? 'selected' : '';


            echo                '
                                <option value="LDI" '.$bu2.'>LDI-HO</option>
                                

                                <option value="LDI-CDC" '.$bu3.'>LDI-CDC</option>

                                <option value="LDI-UDC" '.$bu4.'>LDI-UDC</option>
                                <option value="LDI-BB" '.$bu5.'>LDI-BB</option>
                                <option value="LDI-Parallel" '.$bu6.'>LDI-Parallel</option>
                                

                                

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="loc">Business Unit</label>
                            <select class="form-control" name="loc" id="loc" required>';
                                if($loc == 'OPLAN'){$oplan = 'selected';}else{$oplan = '';}
                                if($loc == 'HORECA'){$horeca = 'selected';}else{$horeca = '';}
                                if($loc == 'FROZEN'){$frozen = 'selected';}else{$frozen = '';}
                                if($loc == '3PS'){$ps = 'selected';}else{$ps = '';}
                                if($loc == 'MPDI'){$mpdi = 'selected';}else{$mpdi = '';}
                                if($loc == 'CVS'){$cvs = 'selected';}else{$cvs = '';}
                                if($loc == 'XTRUCK'){$xtruck = 'selected';}else{$xtruck = '';}
                                if($loc == 'XTRUCK-NETMAN'){$xtruck_net = 'selected';}else{$xtruck_net = '';}
                                if($loc == 'XTRUCK-MPDI'){$xtruck_mpdi = 'selected';}else{$xtruck_mpdi = '';}
                                if($loc == 'UNILAB'){$unilab = 'selected';}else{$unilab = '';}
                                if($loc == 'MAS-LDI'){$mas = 'selected';}else{$mas = '';}
                                if($loc == 'MAS-NETMAN'){$mas_net = 'selected';}else{$mas_net = '';}
                                if($loc == 'MAS-MPDI'){$mas_mpdi = 'selected';}else{$mas_mpdi = '';}
                                //if($loc == 'WDG'){$wdg = 'selected';}else{$wdg = '';}  <option value="WDG" '.$wdg.'>WDG</option>

            echo                '<option value="HORECA" '.$horeca.'>HORECA</option>
                                <option value="3PS" '.$ps.'>3PS</option>
                                <option value="MPDI" '.$mpdi.'>MPDI</option>
                                <option value="CVS" '.$cvs.'>CVS</option>
                                <option value="FROZEN" '.$frozen.'>FROZEN</option>
                                <option value="OPLAN" '.$oplan.'>OPLAN</option>
                                <option value="XTRUCK" '.$xtruck.'>XTRUCK-LDI</option>
                                <option value="XTRUCK-NETMAN" '.$xtruck_net.'>XTRUCK-NETMAN</option>
                                <option value="XTRUCK-MPDI" '.$xtruck_mpdi.'>XTRUCK-MPDI</option>
                                <option value="UNILAB" '.$unilab.'>UNILAB</option>
                                <option value="MAS-LDI" '.$mas.'>MAS-LDI</option>
                                <option value="MAS-NETMAN" '.$mas_net.'>MAS-NETMAN</option>
                                <option value="MAS-MPDI" '.$mas_mpdi.'>MAS-MPDI</option>
                               
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

            
            $bu2 = ($bu == 'LDI') ? 'selected' : '';
            $bu3 = ($bu == 'LDI-CDC') ? 'selected' : '';
            $bu4 = ($bu == 'LDI-UDC') ? 'selected' : '';
            $bu5 = ($bu == 'LDI-BB') ? 'selected' : '';
            $bu6 = ($bu == 'LDI-Parallel') ? 'selected' : '';

            echo '<h5>Current Location: '.$bu.'</h5><br/>';
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                <div class="form-group">
                    <label for="type">Location</label>
                    <select class="form-control" name="bu" id="bu" required>

                        <option value="LDI" '.$bu2.'>LDI-HO</option>
                        <option value="LDI-CDC" '.$bu3.'>LDI-CDC</option>
                        <option value="LDI-UDC" '.$bu4.'>LDI-UDC</option>
                        <option value="LDI-BB" '.$bu5.'>LDI-BB</option>
                        <option value="LDI-Parallel" '.$bu6.'>LDI-Parallel</option>
                        
                    </select>
                 </div>
                 <button style="float: right" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                 <button type="submit" style="float: right;margin-right: 5px" class="btn btn-primary" name="submit" value="save"> Save Changes </button>';
        }

        public function user_bu()
        {
            $row = $this->Crud_Model->getData($_POST['ids']);
            $bu_loc = $row->bu;

           // if($bu_loc == 'WDG'){$bu_loc1 = 'selected';}else{$bu_loc1 = '';}  <option value="WDG" '.$bu_loc1.'>WDG</option>
            if($bu_loc == 'OPLAN'){$bu_loc2 = 'selected';}else{$bu_loc2 = '';}
            if($bu_loc == 'HORECA'){$bu_loc3 = 'selected';}else{$bu_loc3 = '';}
            if($bu_loc == 'FROZEN'){$bu_loc4 = 'selected';}else{$bu_loc4 = '';}
            if($bu_loc == 'MPDI'){$bu_loc5 = 'selected';}else{$bu_loc5 = '';}
            if($bu_loc == 'CVS'){$bu_loc6 = 'selected';}else{$bu_loc6 = '';}
            if($bu_loc == '3PS'){$bu_loc7 = 'selected';}else{$bu_loc7 = '';} 
            if($bu_loc == 'XTRUCK'){$bu_loc8 = 'selected';}else{$bu_loc8 = '';}
            if($bu_loc == 'XTRUCK-NETMAN'){$bu_loc9 = 'selected';}else{$bu_loc9 = '';}
            if($bu_loc == 'XTRUCK-MPDI'){$bu_loc10 = 'selected';}else{$bu_loc10 = '';}
            if($bu_loc == 'UNILAB'){$bu_loc11 = 'selected';}else{$bu_loc11 = '';}
            if($bu_loc == 'MAS-LDI'){$bu_loc12 = 'selected';}else{$bu_loc12 = '';}
            if($bu_loc == 'MAS-NETMAN'){$bu_loc13 = 'selected';}else{$bu_loc13 = '';}
            if($bu_loc == 'MAS-MPDI'){$bu_loc14 = 'selected';}else{$bu_loc14 = '';}
           
            echo '<h5>Current BU: '.$bu_loc.'</h5><br/>';
            echo '<input type="hidden" class="form-control" name="id" id="id" autocomplete="off" value="'.$row->user_id.'" required>
                <div class="form-group">
                    <label for="type">BU</label>
                    <select class="form-control" name="loc" id="loc" required>
                       
                        <option value="OPLAN" '.$bu_loc2.'>OPLAN</option>
                        <option value="HORECA" '.$bu_loc3.'>HORECA</option>
                        <option value="FROZEN" '.$bu_loc4.'>FROZEN</option>
                        <option value="MPDI" '.$bu_loc5.'>MPDI</option>
                        <option value="CVS" '.$bu_loc6.'>CVS</option>
                        <option value="3PS" '.$bu_loc7.'>3PS</option>
                        <option value="XTRUCK" '.$bu_loc8.'>XTRUCK-LDI</option>
                        <option value="XTRUCK-NETMAN" '.$bu_loc9.'>XTRUCK-NETMAN</option>
                        <option value="XTRUCK-MPDI" '.$bu_loc10.'>XTRUCK-MPDI</option>
                        <option value="UNILAB" '.$bu_loc11.'>UNILAB</option>
                        <option value="MAS-LDI" '.$bu_loc12.'>MAS-LDI</option>
                        <option value="MAS-NETMAN" '.$bu_loc13.'>MAS-NETMAN</option>
                        <option value="MAS-MPDI" '.$bu_loc14.'>MAS-MPDI</option>
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