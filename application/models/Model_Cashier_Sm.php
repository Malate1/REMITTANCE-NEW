<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_Cashier_Sm extends CI_Model {
        public function __construct()
        {
            parent:: __construct();
        }

        public function getBankData()
        {
            if($this->session->userdata('location')=='UWDG')
            {
                $query = $this->db->query('SELECT `code`, `name`  FROM bank ORDER BY name ASC');
                return $query->result_array();
            }
            else
            {
                $query = $this->db->query('SELECT `code2`, `name`  FROM bank WHERE bu="All" ORDER BY name ASC');
                return $query->result_array();
            }
        }

        public function getSmOplan()
        {
           
            $query = $this->db->query('SELECT *  FROM users WHERE bu IN ("OPLAN", "MAS-NETMAN", "MAS-LDI", "MAS-MPDI") and type="JefeDeViaje" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmOplanPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="OPLAN" and type="JefeDeViaje" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmMasLdiPerLocation()
        {
            $loc = $this->session->userdata('location');
            var_dump($loc);
            $query = $this->db->query('SELECT *  FROM users WHERE bu="MAS-LDI" AND type="JefeDeViaje" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmMasNetmanPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="MAS-NETMAN" AND type="JefeDeViaje" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmHorecaPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="HORECA" AND type="JefeDeViaje" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmFrozenPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="FROZEN" AND type="Salesman" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmMpdiPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="MPDI" AND type="Salesman" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmCvsPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="CVS" AND type="Salesman" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmUnilabPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT *  FROM users WHERE bu="UNILAB" AND type="Salesman" and location="'.$loc.'" ORDER BY full_name ASC');
            return $query->result();
        
        }

        public function getSmXtruckPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT * FROM users WHERE bu IN ("XTRUCK", "XTRUCK-NETMAN", "XTRUCK-MPDI", "3PS", "XTRUCK-NETMAN-BPI") AND type="Salesman" and location="'.$loc.'" ORDER BY full_name ASC');
            
            return $query->result();
        }

        public function getSmXtruckDualPerLocation()
        {
            $loc = $this->session->userdata('location');
            $query = $this->db->query('SELECT * FROM users WHERE bu="XTRUCK-MPDI" AND type="Salesman" and location="'.$loc.'" and sm_type = "Dual" ORDER BY full_name ASC');
            
            return $query->result();
        }

        public function getSmXtruck()
        {
            $query = $this->db->query('SELECT * FROM users WHERE bu IN ("XTRUCK", "XTRUCK-NETMAN", "XTRUCK-MPDI", "XTRUCK-NETMAN-BPI") AND type="Salesman" ORDER BY full_name ASC');
            
            return $query->result();
        }


        public function getBankData2()
        {
            if($this->session->userdata('location')=='UWDG')
            {
                $query = $this->db->query('SELECT * FROM bank ORDER BY name ASC');
                return $query->result();
            }
            else
            {
                $query = $this->db->query('SELECT * FROM bank WHERE bu="All" ORDER BY name ASC');
                return $query->result();
            }
        }

        public function get_customer()
        {
            $query = $this->db->query('SELECT * FROM customer ORDER BY code ASC');
            return $query->result_array();
        }

        public function get_customer2()
        {
            $query = $this->db->query('SELECT * FROM customer2 ORDER BY code ASC');
            return $query->result_array();
        }

        public function transfercustomer($code)
        {   
            $query1 = $this->db->query('SELECT * FROM customer WHERE code="'.$code.'"');
            $result = $query1->num_rows();
            if($result < 1)
            {
                $query = $this->db->query('INSERT INTO customer(`code`,`name`,`address1`,`address2`,`pricegroup`,`payment_term`,`mother_code`,`credit_limit`,`salesman`) SELECT `code`,`name`,`address1`,`address2`,`pricegroup`,`payment_term`,`mother_code`,`credit_limit`,`salesman` FROM customer2 WHERE customer2.code="'.$code.'"');
            }
        }

        public function transfercustomertoccd($code)
        {   
            $exists = $this->db
                ->select('1')
                ->from('customer2')
                ->where('code', $code)
                ->get()
                ->num_rows();

            if ($exists < 1) {
                // Transfer customer record from customer to customer2
                $sql = "
                    INSERT INTO customer2 (
                        code, name, address1, address2,
                        pricegroup, payment_term, mother_code,
                        credit_limit, salesman
                    )
                    SELECT 
                        code, name, address1, address2,
                        pricegroup, payment_term, mother_code,
                        credit_limit, salesman
                    FROM customer
                    WHERE code = ?
                ";

                return $this->db->query($sql, [$code]); // returns TRUE on success
            }

            return false; // Customer already exists in customer2
        }

        public function transfercustomer2($code,$name,$addr)
        {
            $data = array(
                'code' => $code,
                'name' => $name,
                'address1' => $addr,
                'address2' => $addr,
                'credit_limit' => 1
            );

            $this->db->insert('customer', $data);
        }
        
        public function getName($code)
        {
            $query = $this->db->query('SELECT code,name FROM customer WHERE code="'.$code.'"');
            return $query->row();
        }

        public function get_accname($acc_code)
        {
            $query = $this->db->query('SELECT DISTINCT acc_name FROM payments WHERE acc_num="'.$acc_code.'"');
            $result = $query->num_rows();
            if($result > 0)
            {
                return $query->row();
            }
            else
            {
                return false;
            }
        }

        public function getSmDenombyDate($date)
        {
            $query = $this->db->query('SELECT a.sm_inc,a.vat,a.bo, a.denom_id,a.user_id,b.full_name,a.total_cash,a.total_returns,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,b.bu,IF(a.status="","Pending",a.status) AS status,
                                    (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date="'.$date.'" AND d.type="DC") AS cashier_dc,
                                    (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date="'.$date.'" AND d.type="PDC") AS cashier_pdc,
                                    (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$date.'" AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,
                                    (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$date.'" AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,
                                    (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_xtruck d WHERE  d.denom_id=a.denom_id) AS wtax,
                                    a.total_collection,a.total_remittance,a.remarks, a.total_srr , a.total_palawan, a.manualsrr, a.status3, a.status4, b.id_no
                                    FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');

            
            return $query->result();
        }

        public function get_datatables()
        {
            $this->_get_datatables_query();

            $length = isset($_POST['length']) ? $_POST['length'] : 10;
            $start  = isset($_POST['start']) ? $_POST['start'] : 0;

            if ($length != -1) {
                $this->db->limit($length, $start);
            }

            return $this->db->get()->result();
        }


        private function _get_datatables_query()
        {
            $date = $this->input->post('date'); // or pass as parameter if needed

            $this->db->select('
                a.sm_inc, a.vat, a.bo, a.denom_id, a.user_id, b.full_name,
                a.total_cash, a.total_returns, a.total_dc, a.total_pdc,
                a.date_added, a.dc_pcs, a.pdc_pcs, b.bu,
                IF(a.status="", "Pending", a.status) AS status,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d 
                    WHERE d.user_id = a.user_id AND d.denom_id = a.denom_id 
                    AND d.pay_date = "'.$date.'" AND d.type = "DC") AS cashier_dc,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d 
                    WHERE d.user_id = a.user_id AND d.denom_id = a.denom_id 
                    AND d.pay_date = "'.$date.'" AND d.type = "PDC") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d 
                    WHERE d.user_id = a.user_id AND d.pay_date = "'.$date.'" 
                    AND d.denom_id = a.denom_id AND d.type = "DC") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d 
                    WHERE d.user_id = a.user_id AND d.pay_date = "'.$date.'" 
                    AND d.denom_id = a.denom_id AND d.type = "PDC") AS cashier_pdcpcs,
                (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_xtruck d 
                    WHERE d.denom_id = a.denom_id) AS wtax,
                a.total_collection, a.total_remittance, a.remarks,
                a.total_srr, a.total_palawan, a.manualsrr,
                a.status3, a.status4, b.id_no
            ');
            $this->db->from('denomination a');
            $this->db->join('users b', 'a.user_id = b.user_id');
            $this->db->where('a.date_added', $date);
            $this->db->where('b.location', $this->session->userdata('location'));

            if (!empty($_POST['search']['value'])) {
                $search = $_POST['search']['value'];
                $this->db->group_start(); // start grouping the OR LIKEs
            
                $this->db->like('a.denom_id', $search);
                $this->db->or_like('a.manualsrr', $search);
                $this->db->or_like('b.id_no', $search);
                $this->db->or_like('b.full_name', $search);
                $this->db->or_like('a.total_cash', $search);
                //$this->db->or_like('a.total_palawan', $search);
                $this->db->or_like('a.total_dc', $search);
                $this->db->or_like('a.total_pdc', $search);
                $this->db->or_like('a.total_collection', $search);
                $this->db->or_like('a.total_remittance', $search);
                $this->db->or_like('a.total_srr', $search);
                // $this->db->or_like('a.total_returns', $search);
                // $this->db->or_like('a.vat', $search);
                // $this->db->or_like('a.wtax', $search);
                // $this->db->or_like('a.bo', $search);
                // $this->db->or_like('a.sm_inc', $search);
                $this->db->or_like('a.status', $search);
            
                $this->db->group_end(); // end grouping
            }
            

            if (isset($_POST['order'])) {
                $this->db->order_by($_POST['columns'][$_POST['order'][0]['column']]['data'], $_POST['order'][0]['dir']);
            } else {
                $this->db->order_by('a.date_added', 'desc'); // Default order
            }

            //log_message('debug', $this->db->last_query());
        }


        public function count_all()
        {
            return $this->db->count_all_results('denomination');
        }

        public function count_filtered()
        {
            $this->_get_datatables_query();
            return $this->db->count_all_results();
        }

        public function getSmDenombyDateSrr($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query('SELECT a.sm_inc,a.vat,a.bo, a.denom_id as srr,a.user_id,b.full_name,a.total_cash,a.total_returns,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,b.bu,IF(a.status="","Pending",a.status) AS status,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date="'.$datefrom.'" AND d.type="DC") AS cashier_dc,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date="'.$datefrom.'" AND d.type="PDC") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$datefrom.'" AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$datefrom.'" AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,
                (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_xtruck d WHERE  d.denom_id=a.denom_id) AS wtax,
                a.total_collection,a.total_remittance,a.remarks, a.total_srr, a.total_palawan, a.manualsrr
                FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added BETWEEN "'.$datefrom.'" AND "'.$dateto.'" AND b.id_no="'.$sm_code.'" ');

            
            return $query->result();
        }

        public function getSmDenombyDateSrrNo($denom_id)
        {
            $query = $this->db->query('SELECT a.sm_inc,a.vat,a.bo, a.denom_id as srr,a.user_id,b.full_name,a.total_cash,a.total_returns,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,b.bu,IF(a.status="","Pending",a.status) AS status,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date=a.date_added AND d.type="DC") AS cashier_dc,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date=a.date_added AND d.type="PDC") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,
                (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_xtruck d WHERE  d.denom_id=a.denom_id) AS wtax,
                a.total_collection,a.total_remittance,a.remarks, a.total_srr, a.total_palawan, a.manualsrr
                FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$denom_id);

            
            return $query->result();
        }

        public function getSmDenombyDateOpSrrNo($denom_id)
        {
            $query = $this->db->query('SELECT a.sm_inc,a.vat,a.bo, a.denom_id as srr,a.user_id,b.full_name,a.total_cash,a.total_returns,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,b.bu,IF(a.status="","Pending",a.status) AS status,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date=a.date_added AND d.type="DC") AS cashier_dc,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date=a.date_added AND d.type="PDC") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,
                (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_ldi d WHERE  d.denom_id=a.denom_id) AS wtax,
                a.total_collection,a.total_remittance,a.remarks, a.total_srr, a.total_palawan
                FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$denom_id);

            
            return $query->result();
        }

        public function getSmDenombyDateSrrOp($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query('SELECT a.sm_inc,a.vat,a.bo, a.denom_id as srr,a.user_id,b.full_name,a.total_cash,a.total_returns,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,b.bu,IF(a.status="","Pending",a.status) AS status,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date="'.$datefrom.'" AND d.type="DC") AS cashier_dc,
                (SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.denom_id=a.denom_id AND d.pay_date="'.$datefrom.'" AND d.type="PDC") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$datefrom.'" AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date="'.$datefrom.'" AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,
                (SELECT IFNULL(SUM(d.tax_amount),0.00) FROM payments_ldi d WHERE  d.denom_id=a.denom_id) AS wtax,
                a.total_collection,a.total_remittance,a.remarks, a.total_srr, a.total_palawan, a.manualsrr
                FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added BETWEEN "'.$datefrom.'" AND "'.$dateto.'" AND b.id_no="'.$sm_code.'"');

            
            return $query->result();
        }

        public function getDueChecks($date,$type)
        {
            if($type=='posted')
            {
                $query = $this->db->query('SELECT a.*,b.name FROM payments a INNER JOIN customer b ON a.cus_code=b.code INNER JOIN users c ON a.entered_by=c.user_id WHERE a.due_date<="'.$date.'" AND c.location="'.$this->session->userdata('location').'" AND a.status!=""');
            }
            else
            {
                $query = $this->db->query('SELECT a.*,b.name FROM payments a INNER JOIN customer b ON a.cus_code=b.code INNER JOIN users c ON a.entered_by=c.user_id WHERE a.due_date<="'.$date.'" AND c.location="'.$this->session->userdata('location').'" AND a.status=""');
            }

            return $query->result();
        }

        public function getSmDenombyDenomId($id)
        {
            $query = $this->db->query('SELECT a.denom_id,a.user_id,b.full_name,a.total_cash,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,IF(a.status="","Pending",a.status) AS status,(SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dc,(SELECT IFNULL(SUM(d.amount),0.00) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdc,(SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="DC") AS cashier_dcpcs,(SELECT IFNULL(COUNT(d.payment_id),0) FROM payments d WHERE d.user_id=a.user_id AND d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.type="PDC") AS cashier_pdcpcs,a.total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$id);
            
            return $query->row();
        }

        public function getSmDenombyDenomIdExt($id)
        {
            $query = $this->db->query('SELECT a.denom_id,a.user_id,b.full_name,a.total_cash,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,IF(a.status="","Pending",a.status) AS status,
                (SELECT IFNULL(SUM(d.check_amount),0.00) FROM payments_xtruck d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Dated") AS cashier_dc,
                (SELECT IFNULL(SUM(d.check_amount),0.00) FROM payments_xtruck d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Post Dated") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.pay_id),0) FROM payments_xtruck d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Dated") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.pay_id),0) FROM payments_xtruck d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Post Dated") AS cashier_pdcpcs,a.total_collection,a.total_remittance FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$id);
            
            return $query->row();
        }

        public function getSmDenombyDenomIdOplan($id)
        {
            $query = $this->db->query('SELECT a.denom_id,a.user_id,b.full_name,a.total_cash,a.total_dc,a.total_pdc,a.date_added,a.dc_pcs,a.pdc_pcs,IF(a.status="","Pending",a.status) AS status,
                (SELECT IFNULL(SUM(d.pay_amount),0.00) FROM payments_ldi d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Dated Check") AS cashier_dc,
                (SELECT IFNULL(SUM(d.pay_amount),0.00) FROM payments_ldi d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Post Dated Check") AS cashier_pdc,
                (SELECT IFNULL(COUNT(d.pay_id),0) FROM payments_ldi d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Dated Check") AS cashier_dcpcs,
                (SELECT IFNULL(COUNT(d.pay_id),0) FROM payments_ldi d WHERE  d.pay_date=a.date_added AND d.denom_id=a.denom_id AND d.check_type="Post Dated Check") AS cashier_pdcpcs,a.total_collection,a.total_remittance FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$id);
            
            return $query->row();
        }
        

        public function approveSmDenom($id)
        {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'approved_by' => $uid,
                'status' => 'Approved'
            );

            $this->db->where('denom_id', $id);
            $this->db->update('denomination', $data);
        }

        

        public function approveSmDenoms($ids) {
            $uid = $this->session->userdata('user_id');
            $data = array(
                'approved_by' => $uid,
                'status' => 'Approved'
            );

            // Modify the query to use where_in for multiple IDs
            $this->db->where_in('denom_id', $ids);
            $this->db->update('denomination', $data);
        }

        public function changeCheckOp($id)
        {
            $query = $this->db->query('SELECT * FROM payments_ldi WHERE pay_id="'.$id.'"');

            if ($query->num_rows() > 0) {
                $row = $query->row(); 
                $pay_amount = $row->pay_amount; 
            } else {
                $pay_amount = 0.00; 
            }

            var_dump($id);

            $data = array(
                'pay_type' => 'CASH',
                'check_no' =>'',
                'due_date' => '',
                'acc_no' => '',
                'acc_name' => '',
                'check_bank' => '',
                'check_type' => ''
               
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_ldi', $data);
        }

        public function changeCheckXt($id) //edit today
        {
            $query = $this->db->query('SELECT * FROM payments_xtruck WHERE pay_id="'.$id.'"');

            if ($query->num_rows() > 0) {
                $row = $query->row(); 
                $cash_amt = $row->check_amount; 
            } else {
                $check_amount = 0.00; 
            }

            var_dump($id);

            $data = array(
                'pay_type' => 'Cash',
                'check_no' =>'',
                'due_date' => '',
                'acc_no' => '',
                'acc_name' => '',
                'check_bank' => '',
                'check_type' => ''
               
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_xtruck', $data);
        }

        

        public function changeCheck($id)
        {
            $query = $this->db->query('SELECT * FROM payments_xtruck WHERE pay_id="'.$id.'"');

            if ($query->num_rows() > 0) {
                $row = $query->row(); // Fetch the first row of the result as an object
                $cash_amt = $row->check_amount; // Access the check_amount column
            } else {
                $cash_amt = 0.00; // Handle cases where no matching record is found
            }

            var_dump($id);

            $data = array(
                'pay_type' => 'Cash',
                'check_amount' => 0.00,
                'cash_amount' => $cash_amt,
                'status5' => '',
                'status2' => '',
                'denom_id' => '00000000',
               
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_xtruck', $data);
        }

        public function deleteCheckOp($id)
        {
            
            $data = array(
                
                'status4' => 'DELETED'
               
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_ldi', $data);
        }

        public function deleteCheckXt($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('pay_id', $id);
                $this->db->delete('payments_xtruck');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deletePalawanXt($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('pay_id', $id);
                $this->db->delete('payments_palawan');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deletePalawanOp($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('pay_id', $id);
                $this->db->delete('payments_palawan_op');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deleteBoOp($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('bo_id', $id);
                $this->db->delete('bo');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deleteSatelliteXt($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('pay_id', $id);
                $this->db->delete('payments_satellite');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deleteUtcXt($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('pay_id', $id);
                $this->db->delete('payments_underthecup');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deleteReturnOp($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('return_no', $id);
                $this->db->delete('returns');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        public function deleteReturnXt($id)
        {
            // Ensure the ID is valid before attempting to delete
            if (!empty($id)) {
                // Delete the record from the payments_ldi table where pay_id matches the given ID
                // var_dump($id);
                // die();
                $this->db->where('bo_id', $id);
                $this->db->delete('returns_xtruck');

                // Check if the deletion was successful
                if ($this->db->affected_rows() > 0) {
                    return true; // Successfully deleted
                } else {
                    return false; // No rows deleted
                }
            }
            return false; // ID was invalid
        }

        


        public function disapproveSmDenom($id)
        {
            $data = array(
                'approved_by' => '0',
                'status' => ''
            );

            $this->db->where('denom_id', $id);
            $this->db->update('denomination', $data);
        }

        public function save_sm_payment()
        {
            $data = array(
                'user_id' => $this->security->xss_clean($this->input->post('userid')),
                'pay_date' => $this->security->xss_clean($this->input->post('date')),
                'cus_code' => $this->security->xss_clean($this->input->post('code')),
                'type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_num' => $this->security->xss_clean($this->input->post('accnum')),
                'bank' => $this->security->xss_clean($this->input->post('bank')),
                'amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'entered_by' => $this->security->xss_clean($this->session->userdata('user_id')),
                'update_time' => "",
                'datetime' => date("Y-m-d h:i A"),
                'denom_id' => $this->security->xss_clean($this->input->post('denomid'))
            );

            $this->db->insert('payments', $data);
        }

        public function selectCheck()
        {
            $check = $this->input->post('checkno');
            $bank = $this->input->post('bank');
            $user = $this->input->post('userid');
            $date = $this->input->post('date');
            $query = $this->db->query('SELECT * FROM payments WHERE check_no="'.$check.'" AND pay_date="'.$date.'" AND bank="'.$bank.'" AND user_id!='.$user);
            $result = $query->num_rows();
            if($result > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function selectCheckLdi()
        {
            $check = $this->input->post('checkno');
            $bank = $this->input->post('bank');
            $user = $this->input->post('userid');
            $date = $this->input->post('date');
            $query = $this->db->query('SELECT * FROM payments_ldi WHERE check_no="'.$check.'" AND pay_date="'.$date.'" AND check_bank="'.$bank.'" ');
            $result = $query->num_rows();
            if($result > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function selectCheckExt()
        {
            $check = $this->input->post('checkno');
            $bank = $this->input->post('bank');
            $user = $this->input->post('userid');
            $date = $this->input->post('date');
            $query = $this->db->query('SELECT * FROM payments_xtruck WHERE check_no="'.$check.'" AND pay_date="'.$date.'" AND check_bank="'.$bank.'" ');
            $result = $query->num_rows();
            if($result > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // public function selectReturn()
        // {
        //     $si_docno = $this->input->post('si_docno');
            
        //     $query = $this->db->query('SELECT * FROM returns WHERE si_docno="'.$si_docno.'"');
        //     $result = $query->num_rows();
        //     if($result > 0)
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         return false;
        //     }
        // }

        // public function selectCheckExt()
        // {
        //     $check = $this->input->post('checkno');
        //     $bank = $this->input->post('bank');
        //     $user = $this->input->post('userid');
        //     $date = $this->input->post('date');
        //     $query = $this->db->query('SELECT * FROM payments_xtruck WHERE check_no="'.$check.'" AND pay_date="'.$date.'" AND check_bank="'.$bank.'" ');
        //     $result = $query->num_rows();
        //     if($result > 0)
        //     {
        //         return true;
        //     }
        //     else
        //     {
        //         return false;
        //     }
        // }

        public function getSmChecks($userid,$paydate,$denomid)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name, c.status 
            FROM payments_ldi a 
            LEFT JOIN customer2 b ON a.cus_code = b.code 
            INNER JOIN denomination c ON a.denom_id = c.denom_id 
               
               
            WHERE (a.pay_type = "CHECK" OR a.pay_type = "CHECK_BULK")
                AND a.denom_id = '.$denomid.'
            GROUP BY a.pay_id');

            //echo $this->db->last_query();
            return $query->result_array();

        }

        public function getSmIncentives($sm_code)
        {
            
            $query = $this->db->query('SELECT *
            FROM salesman_incentives 
            WHERE sm_code = "'.$sm_code.'" 
            ORDER BY inc_id ASC');

            //echo $this->db->last_query();
            return $query->result_array();

        }

        public function getSmIncentivesUsed($sm_code)
        {
            
            $query = $this->db->query('SELECT *
            FROM salesman_incentives_used 
            WHERE sm_code = "'.$sm_code.'" 
            ');

            //echo $this->db->last_query();
            return $query->result_array();

        }

        

        public function getSmPaymentsOp($paydate, $paydate2, $sm_code)
        {
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
                FROM payments_ldi a 
                LEFT JOIN customer b ON a.cus_code = b.code 
                WHERE a.pay_date BETWEEN "'.$paydate.'" AND "'.$paydate2.'" 
                    AND jefe_code = "'.$sm_code.'"
                    AND a.status2 != "FILED"
                    AND a.status4 != "DELETED"
                GROUP BY a.pay_id');

            return $query->result_array();
        }

        public function getSmPaymentsXt($paydate,$paydate2,$sm_code)
        {
            var_dump($paydate);
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
            FROM payments_xtruck a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            
            WHERE a.pay_date BETWEEN "'.$paydate.'" AND "'.$paydate2.'"
                AND sm_code = "'.$sm_code.'"
                 AND a.status2 != "FILED"
                 AND a.status4 != "DELETED"
                
            GROUP BY a.pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtPal($paydate,$paydate2,$sm_code)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_palawan  
            
            
            WHERE date_remitted BETWEEN "'.$paydate.'" AND "'.$paydate2.'"
                AND sm_code = "'.$sm_code.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtPalRef($ref_no)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_palawan  
            
            
            WHERE ref_no = "'.$ref_no.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsOpPal($paydate,$paydate2,$sm_code)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_palawan_op  
            
            
            WHERE date_remitted BETWEEN "'.$paydate.'" AND "'.$paydate2.'"
                AND sm_code = "'.$sm_code.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsOpPalRef($ref_no)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_palawan_op  
            
            
            WHERE ref_no = "'.$ref_no.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtSat($paydate,$paydate2,$sm_code)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_satellite  
            
            
            WHERE date_requested BETWEEN "'.$paydate.'" AND "'.$paydate2.'"
                AND sm_code = "'.$sm_code.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtSatRef($ref_no)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_satellite  
            
            
            WHERE ref_no = "'.$ref_no.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtUtc($paydate,$paydate2,$sm_code)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_underthecup  
            
            
            WHERE date_remitted BETWEEN "'.$paydate.'" AND "'.$paydate2.'"
                AND sm_code = "'.$sm_code.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtUtcRef($ref_no)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM payments_underthecup  
            
            
            WHERE ref_no = "'.$ref_no.'"
                 AND status != "FILED"
                 
                
            GROUP BY pay_id');

            return $query->result_array();

        }

        public function getSmPaymentsOpBo($paydate,$paydate2,$sm_code)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM bo  
            
            
            WHERE date_created BETWEEN "'.$paydate.'" AND "'.$paydate2.'"
                AND hepe_code = "'.$sm_code.'"
                 AND status != "FILED"
                 
                
            GROUP BY bo_id');

            return $query->result_array();

        }

        public function getSmPaymentsOpBoRef($ref_no)
        {
            //var_dump($paydate);
            $query = $this->db->query('SELECT *
            FROM bo  
            
            
            WHERE ref_no = "'.$ref_no.'"
                 AND status != "FILED"
                 
                
            GROUP BY bo_id');

            return $query->result_array();

        }

        public function getSmPaymentsXtIncBal($sm_code)
        {
            $sql = 'SELECT a.*, b.*
                    FROM salesman_incentives_bal a
                    INNER JOIN users b ON a.sm_code = b.id_no
                    WHERE b.status = "Active"';

            // Add sm_code condition only if not "All"
            if ($sm_code !== 'All') {
                $sql .= ' AND a.sm_code = ' . $this->db->escape($sm_code);
            }

            $query = $this->db->query($sql);
            return $query->result_array();
        }



        public function getSmDvSrrXt($datefrom,$dateto,$sm_code)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
                FROM payments_xtruck a 
                -- INNER JOIN denomination c ON a.cus_code = b.code
                LEFT JOIN customer b ON a.cus_code = b.code 
                
                WHERE a.pay_date BETWEEN "'.$datefrom.'" AND "'.$dateto.'"
                AND sm_code = "'.$sm_code.'"
                
                 AND a.status4 != "DELETED" 
                 AND a.status5 != "Returned Old"
                 

                
            GROUP BY a.pay_id
            ORDER BY a.pay_date');
            
            return $query->result_array();

            //  AND a.status2 != "FILED"

        }

        public function getSmDvSrrOp($datefrom,$dateto,$sm_code)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
                FROM payments_ldi a 
                -- INNER JOIN denomination c ON a.cus_code = b.code
                LEFT JOIN customer b ON a.cus_code = b.code 
                
                WHERE a.pay_date BETWEEN "'.$datefrom.'" AND "'.$dateto.'"
                AND jefe_code = "'.$sm_code.'"
                
                 AND a.status4 != "DELETED" 
                 
                 

                
            GROUP BY a.pay_id
            ORDER BY a.pay_date');
            
            return $query->result_array();

            //  AND a.status2 != "FILED"

        }

        public function getSmPaymentsForUpdate()
        {
            
            $query = $this->db->query('SELECT a.*, b.*
                FROM payments_ldi a 
                INNER JOIN denomination b ON a.denom_id = b.denom_id
                
                WHERE a.status = "Uploaded"
                AND a.pay_date >= "2025-05-01"
                ');
            
            return $query->result_array();

            

        }

        public function getSmDvSrrXtInc($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query("
                SELECT b.id_no, SUM(IFNULL(a.sm_inc, 0)) AS inc_used, SUM(IFNULL(a.bo, 0)) AS total_bo_amount
                FROM denomination a 
                LEFT JOIN users b ON a.user_id = b.user_id 
                WHERE a.date_added BETWEEN ? AND ?
                AND b.id_no = ? 
                GROUP BY b.id_no
                ORDER BY a.date_added
            ", [$datefrom, $dateto, $sm_code]);

            return $query->row();
        }

        public function getSmDvSrrXtSat($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(a.appr_amount, 0)) AS total_appr_amount
                FROM payments_satellite a 
                WHERE a.date_requested BETWEEN ? AND ?
                AND a.sm_code = ? 
                AND a.status = 'FILED'
            ", [$datefrom, $dateto, $sm_code]);

            return $query->row(); // Return as an associative array
        }

        public function getSmDvSrrXtPal($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(a.pay_amount, 0)) AS total_pay_amount
                FROM payments_palawan a 
                WHERE a.date_remitted BETWEEN ? AND ?
                AND a.sm_code = ? 
                AND a.status = 'FILED'
            ", [$datefrom, $dateto, $sm_code]);

            return $query->row(); // Return as an associative array
        }

        public function getSmDvSrrOpPal($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(a.pay_amount, 0)) AS total_pay_amount
                FROM payments_palawan_op a 
                WHERE a.date_remitted BETWEEN ? AND ?
                AND a.sm_code = ? 
                AND a.status = 'FILED'
            ", [$datefrom, $dateto, $sm_code]);

            return $query->row(); // Return as an associative array
        }

        public function getSmDvSrrXtUtc($datefrom, $dateto, $sm_code)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(a.pay_amount, 0)) AS total_utc
                FROM payments_underthecup a 
                WHERE a.date_remitted BETWEEN ? AND ?
                AND a.sm_code = ? 
                AND a.status = 'FILED'
            ", [$datefrom, $dateto, $sm_code]);
            
            return $query->row(); // Return as an associative array
        }

        public function getTotalSatelliteByDenomId($denom_id)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(appr_amount, 0)) AS total_satellite
                FROM payments_satellite
                WHERE denom_id = ?
                AND status = 'FILED'
            ", [$denom_id]);

            return $query->row(); // Returns an object containing total_satellite
        }

        public function getTotalPalByDenomId($denom_id)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(pay_amount, 0)) AS total_pal
                FROM payments_palawan
                WHERE denom_id = ?
                AND status = 'FILED'
            ", [$denom_id]);

            return $query->row(); // Returns an object containing total_satellite
        }

        public function getTotalPalOpByDenomId($denom_id)
        {
            $query = $this->db->query("
                SELECT SUM(IFNULL(pay_amount, 0)) AS total_pal
                FROM payments_palawan_op
                WHERE denom_id = ?
                AND status = 'FILED'
            ", [$denom_id]);

            return $query->row(); // Returns an object containing total_satellite
        }



        public function getSmPaymentsOpSi($si)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
            FROM payments_ldi a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            
            WHERE a.si_docno = "'.$si.'" 
                
                 AND a.status2 != "FILED"
                 AND a.status4 != "DELETED"
                
            GROUP BY a.pay_id');

            return $query->result_array();

        }

        public function getSmReturnsOp($datefrom,$dateto,$sm_code)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
            FROM returns a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            WHERE a.return_date BETWEEN "'.$datefrom.'" AND "'.$dateto.'"
                AND hepe_code = "'.$sm_code.'"
                AND a.status2 != "FILED"
                 
                
            GROUP BY a.return_no');

            return $query->result_array();

        }

        public function getSmReturnsOpSi($si)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
            FROM returns a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            
            WHERE a.si_docno = "'.$si.'" 
                
                 AND a.status2 != "FILED"
                 
                
            GROUP BY a.return_no');

            return $query->result_array();

        }

        public function getSmReturnsXt($datefrom,$dateto,$sm_code)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
            FROM returns_xtruck a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            WHERE a.posting_date BETWEEN "'.$datefrom.'" AND "'.$dateto.'"
                AND sm_code = "'.$sm_code.'"
                AND a.status != "FILED"
                 
                
            GROUP BY a.bo_id');

            return $query->result_array();

        }

        public function getSmReturnsXtSi($si)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name
            FROM returns_xtruck a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            
            WHERE a.si_docno = "'.$si.'" 
                
                 AND a.status != "FILED"
                 
                
            GROUP BY a.bo_id');

            return $query->result_array();

        }

        public function getSmReturnsForExport()
        {
            
            $query = $this->db->query('SELECT a.*, b.*
            FROM returns a 
            INNER JOIN denomination b ON a.denom_id = b.denom_id 
            WHERE a.status2 = "FILED" 
            
            -- a.status2 = "FILED"   
                
            GROUP BY a.return_no');

            return $query->result_array();

        }

        public function getSmPaymentsOpFiled($paydate,$sm_code)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name, c.status 
            FROM payments_ldi a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            INNER JOIN denomination c ON a.denom_id = c.denom_id 
                AND a.pay_date = c.date_added 
            
            WHERE a.pay_date = "'.$paydate.'" 
                AND jefe_code = "'.$sm_code.'"
                AND a.status2 = "FILED"
            GROUP BY a.pay_id');

            return $query->result_array();

        }

        
        public function getSmChecksExtruck($userid,$paydate,$denomid)
        {
            
            $query = $this->db->query('SELECT 
                a.*, 
                IFNULL(a.cus_name, "") AS name, 
                c.status,
                CASE 
                    WHEN d.denom_id IS NOT NULL THEN 1 
                    ELSE 0 
                END AS is_satellite
            FROM payments_xtruck a 
            LEFT JOIN customer2 b ON a.cus_code = b.code 
            INNER JOIN denomination c ON a.denom_id = c.denom_id 
            LEFT JOIN payments_satellite d ON a.check_no = d.check_no AND a.acc_no = d.acc_no AND a.check_bank = d.check_bank AND a.denom_id = d.denom_id
            
            WHERE a.pay_type = "Cheque"
                -- AND a.status5 != "Returned"
                AND a.denom_id = "'.$denomid.'"
            GROUP BY a.pay_id
            ');

            //echo $this->db->last_query();
            return $query->result_array();

        }

        public function getSmPalExtruck($userid,$paydate,$denomid)
        {
            
            $query = $this->db->query('SELECT 
                a.*, b.*
               
            FROM payments_palawan a 
            INNER JOIN denomination b ON a.denom_id = b.denom_id 
            
            WHERE  a.denom_id = "'.$denomid.'"
            GROUP BY a.pay_id
            ');

            //echo $this->db->last_query();
            return $query->result_array();

        }

        public function getReturnedChecksExtruck($datefrom, $dateto)
        {
            $query = $this->db->query('SELECT a.*, IFNULL(a.cus_name, "") AS name, c.full_name
                                    FROM payments_xtruck a 
                                    INNER JOIN users c ON a.sm_code = c.id_no
                                    LEFT JOIN customer2 b ON a.cus_code = b.code 
                                    
                                    WHERE a.status5 = "Returned" AND a.pay_date BETWEEN "'.$datefrom.'" AND "'.$dateto.'" 
                                    
                                    GROUP BY a.pay_id
                                    ORDER BY c.full_name');

            //echo $this->db->last_query();
            return $query->result_array();
        }

        public function getReturnedChecksOplan($datefrom, $dateto)
        {
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name, c.full_name
                                    FROM payments_ldi a 
                                    INNER JOIN users c ON a.jefe_code = c.id_no
                                    LEFT JOIN customer2 b ON a.cus_code = b.code 
                                    
                                    WHERE a.status3 = "Returned" AND a.pay_date BETWEEN "'.$datefrom.'" AND "'.$dateto.'" 
                                    
                                    GROUP BY a.pay_id
                                    ORDER BY c.full_name');

            //echo $this->db->last_query();
            return $query->result_array();
        }

        public function getSmChecksLDI($userid,$paydate)
        {
            
            $query = $this->db->query('SELECT a.*, IFNULL(b.name, "") AS name, c.status 
            FROM payments a 
            LEFT JOIN customer b ON a.cus_code = b.code 
            INNER JOIN denomination c ON a.user_id = c.user_id 
                AND a.pay_date = c.date_added 
                AND a.denom_id = c.denom_id 
            WHERE a.pay_date = "'.$paydate.'" 
                AND a.user_id = '.$userid.' 
                
            GROUP BY a.payment_id');



            return $query->result_array();

        }

        public function getUserName($userid)
        {
            $query = $this->db->query('SELECT full_name,bu FROM users WHERE user_id='.$userid);
            
            return $query->row();
        }

        public function getUserNamebyId($id_no)
        {
            // Escaping the input to prevent SQL injection
            $id_no = $this->db->escape($id_no);
            //var_dump($id_no);

            // Use the escaped value in the query
            $query = $this->db->query("SELECT full_name,last_name FROM users WHERE id_no = $id_no");
            
            return $query->row();
        }

        public function getPayment($id)
        {
            $query = $this->db->query('SELECT a.*,b.name FROM payments_ldi a INNER JOIN customer b ON a.cus_code=b.code WHERE a.pay_id='.$id);
            return $query->row();
        }

        public function getReturn($id)
        {
            var_dump($id);
            $query = $this->db->query("SELECT * FROM returns WHERE si_docno = '$id'");
            return $query->row();
        }


        public function getPayment2($id)
        {
            $query = $this->db->query('SELECT a.*,b.name,c.name AS bname FROM payments a INNER JOIN customer b ON a.cus_code=b.code INNER JOIN bank c ON a.bank=c.code2 WHERE a.payment_id='.$id);
            return $query->row();
        }

        public function getPayment3($id)
        {
            $query = $this->db->query('SELECT a.*,b.name,c.name AS bname FROM payments_xtruck a LEFT JOIN customer b ON a.cus_code=b.code INNER JOIN bank c ON a.check_bank=c.code2 WHERE a.pay_id='.$id);
            return $query->row();
        }

        public function getPayment4($id)
        {
            $query = $this->db->query('SELECT a.*,b.* FROM payments_palawan a LEFT JOIN denomination b ON a.denom_id = b.denom_id WHERE a.pay_id='.$id);
            return $query->row();
        }

        public function getPayment5($id)
        {
            $query = $this->db->query('SELECT * FROM denomination  WHERE denom_id='.$id);
            return $query->row();
        }

        public function edit_sm_payment()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_num' => $this->security->xss_clean($this->input->post('accnum')),
                'bank' => $this->security->xss_clean($this->input->post('bank')),
                'amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'update_time' =>  date("h:i A"),
                'datetime' => date("Y-m-d h:i A"),
                'status' => $this->security->xss_clean($this->input->post('checkstatus'))
            );

            $this->db->where('payment_id', $this->input->post('id'));
            $this->db->update('payments', $data);
        }

        public function edit_sm_payment_ldi()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'check_type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_no' => $this->security->xss_clean($this->input->post('accnum')),
                'check_bank' => $this->security->xss_clean($this->input->post('bank')),
                // 'pay_amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                
                'status3' => $this->security->xss_clean($this->input->post('checkstatus'))
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_ldi', $data);

            if($this->input->post('checkstatus') == 'Returned' AND $this->input->post('cur_stat') != 'Returned'){

                $data2 = array(
                
                    'total_dc'          => $this->security->xss_clean(str_replace(",","",$this->input->post('dc_amt'))),
                    'total_pdc'         => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc_amt'))),               
                    'update_time'       => date("h:i A"),
                    'dc_pcs'            => $this->security->xss_clean($this->input->post('dc_pc')),
                    'pdc_pcs'           => $this->security->xss_clean($this->input->post('pdc_pc')),
                    'total_collection'  => $this->security->xss_clean(str_replace(",","",$this->input->post('remittance'))),
                    'total_remittance'  => $this->security->xss_clean(str_replace(",","",$this->input->post('collection')))
                );

                var_dump($data2);

                $this->db->where('denom_id', $this->input->post('denom_id'));
                $this->db->update('denomination', $data2);
            }else{
                var_dump($data);
            }
        }

        public function cash_to_check_payment_ldi()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'check_type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_no' => $this->security->xss_clean($this->input->post('accnum')),
                'check_bank' => $this->security->xss_clean($this->input->post('bank')),
                'pay_amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                
                'pay_type' => 'CHECK'
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_ldi', $data);

        }

        public function cash_to_check_payment_xt() //edit today
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'check_type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_no' => $this->security->xss_clean($this->input->post('accnum')),
                'check_bank' => $this->security->xss_clean($this->input->post('bank')),
                'check_amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'cash_amount' => 0.00,
                'pay_type' => 'Cheque'
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_xtruck', $data);

        }

        public function payment_to_return_op()
        {
            $data = array(
                'si_docno'      => $this->security->xss_clean($this->input->post('si_docno')),
                'cus_code'      => $this->security->xss_clean($this->input->post('cus_code')),
                'cus_name'      => $this->security->xss_clean($this->input->post('cus_name')),
                'hepe_code'     => $this->security->xss_clean($this->input->post('hepe_code')),
                'hepe_name'     => $this->security->xss_clean($this->input->post('hepe_name')),
                'sm_code'       => $this->security->xss_clean($this->input->post('sm_code')),
                'sm_name'       => $this->security->xss_clean($this->input->post('sm_name')),
                'si_amount'     => $this->security->xss_clean(str_replace(",","",$this->input->post('si_amount'))),
                'return_amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('return_amount'))),
                'si_date'       => $this->security->xss_clean($this->input->post('si_date')),
                'return_date'       => $this->security->xss_clean($this->input->post('return_date'))
            );

            // var_dump($this->input->post('id'));
            // die();
            $this->db->insert('returns', $data);

            
            $data2 = array(
                'status4' => 'DELETED'
            );
            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_ldi', $data2);



        }

        public function edit_sm_payment_op()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'check_type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_no' => $this->security->xss_clean($this->input->post('accnum')),
                'check_bank' => $this->security->xss_clean($this->input->post('bank')),
                'pay_amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                
                'status3' => $this->security->xss_clean($this->input->post('checkstatus'))
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_ldi', $data);
        }

        public function edit_sm_payment_tax_op()
        {
            $prev_amount = 0.00;
            $prev_amount = $this->getPayment($this->input->post('id'));
            $tax_amount = $this->security->xss_clean(str_replace(",", "", $this->input->post('tax_amount')));
            $pay_amount = $this->security->xss_clean(str_replace(",", "", $this->input->post('pay_amount2')));

            // var_dump($tax_amount);
            // var_dump($pay_amount);
            // die();

            if($tax_amount !== ''){
                $total_amount = $prev_amount->pay_amount - $tax_amount;
                $data = array(
                    'pay_amount' => $total_amount,
                    'tax_amount' => $this->security->xss_clean(str_replace(",", "", $this->input->post('tax_amount')))
                );
                // var_dump($total_amount);
                // die();

                $this->db->where('pay_id', $this->input->post('id'));
                $this->db->update('payments_ldi', $data);
            }else{
                $total_amount = $prev_amount->pay_amount + $pay_amount;
                $data = array(
                    'pay_amount' => $total_amount
                    
                );
                

                $this->db->where('pay_id', $this->input->post('id'));
                $this->db->update('payments_ldi', $data);
            }
            
        }

        public function selectReturn()
        {
            $si_docno = $this->input->post('si_docno');
            
            $query = $this->db->query('SELECT * FROM returns WHERE si_docno = ?', [$si_docno]);
            return $query->num_rows() > 0;
        }

        public function edit_sm_payment_tax_op_minus()
        {
            $prev_amount = $this->getPayment($this->input->post('id'));
            $pay_amount = $this->security->xss_clean(str_replace(",", "", $this->input->post('pay_amount')));
            $hasReturn = $this->selectReturn();
            $total_amount = $prev_amount->pay_amount - $pay_amount;

            if ($hasReturn) {
                // Update `payments_ldi` table with calculated pay_amount
                $data = ['pay_amount' => $total_amount];
                $this->db->where('pay_id', $this->input->post('id'));
                $this->db->update('payments_ldi', $data);

                // Update `returns` table if `si_docno` exists
                $prev_ret_amount = $this->getReturn($this->input->post('si'));
                $total_return = $prev_ret_amount->return_amount + $pay_amount;
                $data2 = ['return_amount' => $total_return];
                $this->db->where('return_no', $prev_ret_amount->return_no);
                $this->db->update('returns', $data2);
            } elseif ($pay_amount !== '') {
                // Update `payments_ldi` table only if `pay_amount` is set
                $data = ['pay_amount' => $total_amount];
                $this->db->where('pay_id', $this->input->post('id'));
                $this->db->update('payments_ldi', $data);
            } else {
                // Insert new record into `returns` and update `payments_ldi`
                $return_amount = $this->security->xss_clean(str_replace(",", "", $this->input->post('return_amount')));
                $total_amount = $prev_amount->pay_amount - $return_amount;
                
                $data = ['pay_amount' => $total_amount];
                $this->db->where('pay_id', $this->input->post('id'));
                $this->db->update('payments_ldi', $data);

                $data3 = [
                    'si_docno'      => $this->security->xss_clean($this->input->post('si_docno')),
                    'cus_code'      => $this->security->xss_clean($this->input->post('cus_code')),
                    'cus_name'      => $this->security->xss_clean($this->input->post('cus_name')),
                    'hepe_code'     => $this->security->xss_clean($this->input->post('hepe_code')),
                    'hepe_name'     => $this->security->xss_clean($this->input->post('hepe_name')),
                    'sm_code'       => $this->security->xss_clean($this->input->post('sm_code')),
                    'sm_name'       => $this->security->xss_clean($this->input->post('sm_name')),
                    'si_amount'     => $this->security->xss_clean(str_replace(",", "", $this->input->post('si_amount'))),
                    'return_amount' => $this->security->xss_clean(str_replace(",", "", $this->input->post('return_amount'))),
                    'si_date'       => $this->security->xss_clean($this->input->post('si_date')),
                    'return_date'   => $this->security->xss_clean($this->input->post('return_date'))
                ];
                
                $this->db->insert('returns', $data3);
            }
        }

        public function edit_sm_payment_ext()
        {
            $data = array(
                'cus_code' => $this->security->xss_clean($this->input->post('code1')),
                'check_type' => $this->security->xss_clean($this->input->post('check')),
                'check_no' => $this->security->xss_clean($this->input->post('checkno')),
                'due_date' => $this->security->xss_clean($this->input->post('duedate')),
                'acc_name' => $this->security->xss_clean($this->input->post('accname')),
                'acc_no' => $this->security->xss_clean($this->input->post('accnum')),
                'check_bank' => $this->security->xss_clean($this->input->post('bank')),
                'pay_amount' => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                
                'status5' => $this->security->xss_clean($this->input->post('checkstatus'))
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_xtruck', $data);

            if($this->input->post('checkstatus') == 'Returned' AND $this->input->post('cur_stat') != 'Returned'){

                $data2 = array(
                
                    'total_dc'          => $this->security->xss_clean(str_replace(",","",$this->input->post('dc_amt'))),
                    'total_pdc'         => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc_amt'))),               
                    'update_time'       => date("h:i A"),
                    'dc_pcs'            => $this->security->xss_clean($this->input->post('dc_pc')),
                    'pdc_pcs'           => $this->security->xss_clean($this->input->post('pdc_pc')),
                    'total_collection'  => $this->security->xss_clean(str_replace(",","",$this->input->post('remittance'))),
                    'total_remittance'  => $this->security->xss_clean(str_replace(",","",$this->input->post('collection')))
                );

                var_dump($data2);

                $this->db->where('denom_id', $this->input->post('denom_id'));
                $this->db->update('denomination', $data2);
            }else{
                var_dump($data);
            }
           
        }

        public function edit_sm_pal_ext()
        {
            // Clean and update the individual payment record
            $data = array(
                'pay_amount' => $this->security->xss_clean(str_replace(",", "", $this->input->post('amount'))),
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_palawan', $data);

            // Check if denom_id is not "00000000"
            if ($this->input->post('denom_id') != '00000000') {
                $denom_id = $this->input->post('denom_id');

                // Get the sum of all Palawan payments for the given denom_id
                $this->db->select_sum('pay_amount');
                $this->db->where('denom_id', $denom_id);
                $query = $this->db->get('payments_palawan');
                $result = $query->row();

                $total_palawan = $result->pay_amount;

                // Update the denomination table with the calculated total
                $data2 = array(
                    'total_palawan' => $this->security->xss_clean($total_palawan),
                );

                $this->db->where('denom_id', $denom_id);
                $this->db->update('denomination', $data2);
            }
        }

        public function edit_sm_denom_op()
        {
            $denom_id = $this->input->post('denom_id');
            $oldsrr = $this->input->post('msrr');
            $manualsrr = $this->security->xss_clean(str_replace(",", "", $this->input->post('manualsrr')));
            $date_added = $this->security->xss_clean($this->input->post('date_added'));

            
            $data = array(
                'manualsrr' => $manualsrr,
                'date_added' => $date_added,
            );

            $this->db->where('denom_id', $denom_id);
            $this->db->update('denomination', $data);

            
            $result3 = $this->getLocation($this->session->userdata('location'));

            

            $connection = $result3->ar_connection;
            $username = $result3->db_username;
            $password = $result3->db_password;

            $connect = @odbc_connect($connection, $username, $password);
            
            if ($connect) {
                
                if($this->session->userdata('location') == 'LDI-CDC'){
                    $update_query = "
                        UPDATE payments_mw
                        SET manual_srr = '$manualsrr', pay_date = '$date_added'
                        WHERE manual_srr = '$oldsrr'
                    ";

                    $update = odbc_exec($connect, $update_query);

                    if (!$update) {
                        log_message('error', 'ODBC Update failed: ' . odbc_errormsg($connect));
                    }
                }

                odbc_close($connect);
            } else {
                log_message('error', 'ODBC Connection failed: ' . odbc_errormsg());
            }
        }


        


        public function edit_ret_payment_ext()
        {
            $data = array(
                
                'status5' => 'Returned Old'
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_xtruck', $data);

            $data2 = array(
                'pay_date'      => date('Y-m-d'),
                'si_docno'      => $this->security->xss_clean($this->input->post('si')),
                'cus_code'      => $this->security->xss_clean($this->input->post('code1')),
                'cus_name'      => $this->security->xss_clean($this->input->post('name1')),
                'pay_amount'    => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'disc_amount'   => 0.00,
                'inc_amount'    => 0.00,
                'deals'         => 0.00,
                'tax_amount'    => 0.00,
                'cash_amount'   => 0.00,
                'check_amount'  => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'net_amount'    => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'pay_type'      => 'Cheque',
                'check_no'      => $this->security->xss_clean($this->input->post('checkno')),
                'due_date'      => $this->security->xss_clean($this->input->post('duedate')),
                'acc_no'        => $this->security->xss_clean($this->input->post('accnum')),
                'acc_name'      => $this->security->xss_clean($this->input->post('accname')),
                'check_bank'    => $this->security->xss_clean($this->input->post('bank')),
                'sm_code'       => $this->security->xss_clean($this->input->post('sm_code')),
                'sm_type'       => $this->security->xss_clean($this->input->post('sm_type')),
                'ref_no'        => $this->security->xss_clean($this->input->post('ref_no')),
                'check_type'    => $this->security->xss_clean($this->input->post('check')),
                'status'        => 'ORDER',
                'status2'       => '',
                'status3'       => '',
                'status4'       => '',
                'status5'       => 'Returned New',
                'denom_id'      => '00000000'
            );

            
            $this->db->insert('payments_xtruck', $data2);

            //if($this->input->post('checkstatus') == 'Returned' AND $this->input->post('cur_stat') != 'Returned'){

                // $data3 = array(
                
                //     'total_dc'          => $this->security->xss_clean(str_replace(",","",$this->input->post('dc_amt'))),
                //     'total_pdc'         => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc_amt'))),               
                //     'update_time'       => date("h:i A"),
                //     'dc_pcs'            => $this->security->xss_clean($this->input->post('dc_pc')),
                //     'pdc_pcs'           => $this->security->xss_clean($this->input->post('pdc_pc')),
                //     'total_collection'  => $this->security->xss_clean(str_replace(",","",$this->input->post('remittance'))),
                //     'total_remittance'  => $this->security->xss_clean(str_replace(",","",$this->input->post('collection'))),
                    
                // );

                // //var_dump($data2);

                // $this->db->where('denom_id', $this->input->post('denom_id'));
                // $this->db->update('denomination', $data3);
            // }else{
            //     var_dump($data);
            // }
           
        }

        public function edit_ret_payment_op()
        {
            $data = array(
                
                'status3' => 'Returned Old'
            );

            $this->db->where('pay_id', $this->input->post('id'));
            $this->db->update('payments_ldi', $data);

            $data2 = array(
                'pay_date'      => date('Y-m-d'),
                'si_docno'      => $this->security->xss_clean($this->input->post('si')),
                'cus_code'      => $this->security->xss_clean($this->input->post('code1')),
                'si_date'      => $this->security->xss_clean($this->input->post('si_date')),
                'pay_amount'    => $this->security->xss_clean(str_replace(",","",$this->input->post('amount'))),
                'tax_amount'    => 0.00,
                'pay_type'      => 'CHECK',
                'check_no'      => $this->security->xss_clean($this->input->post('checkno')),
                'due_date'      => $this->security->xss_clean($this->input->post('duedate')),
                'acc_no'        => $this->security->xss_clean($this->input->post('accnum')),
                'acc_name'      => $this->security->xss_clean($this->input->post('accname')),
                'check_bank'    => $this->security->xss_clean($this->input->post('bank')),
                'jefe_code'       => $this->security->xss_clean($this->input->post('jefe_code')),
                'jefe_name'       => $this->security->xss_clean($this->input->post('jefe_name')),
                'sm_code'       => $this->security->xss_clean($this->input->post('sm_code')),
                'sm_name'       => $this->security->xss_clean($this->input->post('sm_name')),
                'ref_no'        => $this->security->xss_clean($this->input->post('ref_no')),
                'check_type'    => $this->security->xss_clean($this->input->post('check')),
                'status'        => '',
                'status2'       => '',
                'status4'       => '',
                'status3'       => 'Returned New',
                'denom_id'      => '00000000',
                'batch'         => '1'
            );

            
            $this->db->insert('payments_ldi', $data2);

            //if($this->input->post('checkstatus') == 'Returned' AND $this->input->post('cur_stat') != 'Returned'){

                // $data3 = array(
                
                //     'total_dc'          => $this->security->xss_clean(str_replace(",","",$this->input->post('dc_amt'))),
                //     'total_pdc'         => $this->security->xss_clean(str_replace(",","",$this->input->post('pdc_amt'))),               
                //     'update_time'       => date("h:i A"),
                //     'dc_pcs'            => $this->security->xss_clean($this->input->post('dc_pc')),
                //     'pdc_pcs'           => $this->security->xss_clean($this->input->post('pdc_pc')),
                //     'total_collection'  => $this->security->xss_clean(str_replace(",","",$this->input->post('remittance'))),
                //     'total_remittance'  => $this->security->xss_clean(str_replace(",","",$this->input->post('collection'))),
                    
                // );

                // //var_dump($data2);

                // $this->db->where('denom_id', $this->input->post('denom_id'));
                // $this->db->update('denomination', $data3);
            // }else{
            //     var_dump($data);
            // }
           
        }

        public function getCheckRemarks($id)
        {
            $query = $this->db->query('SELECT remarks FROM payments WHERE payment_id='.$id);
            
            return $query->row();
        }

        public function getRemarks($id)
        {
            $query = $this->db->query('SELECT remarks FROM denomination WHERE denom_id='.$id);
            
            return $query->row();
        }

        public function getSmCollection($id)
        {
            $query = $this->db->query('SELECT total_collection FROM denomination WHERE denom_id='.$id);
            
            return $query->row();
        }

        public function getSmRemittance($id)
        {
            $query = $this->db->query('SELECT total_remittance FROM denomination WHERE denom_id='.$id);
            
            return $query->row();
        }

        public function getSmInc($id)
        {
            $query = $this->db->query('SELECT sm_inc FROM denomination WHERE denom_id='.$id);
            
            return $query->row();
        }

        public function getSmCode($id)
        {
            $query = $this->db->query('SELECT id_no FROM users WHERE user_id='.$id);
            
            return $query->row();
        }

        public function getIncentives($sm_code) {
            $this->db->select_sum('inc_balance');
            $this->db->where('sm_code', $sm_code);
            $query = $this->db->get('salesman_incentives_bal');

            $result = $query->row();

            // Return the sum of inc_amount for the given sm_code
            return $result->inc_balance;
        }
        

        

        public function updateCheckStatus()
        {
            $data = array(
                'status' => $this->security->xss_clean($this->input->post('status'))
            );

            $this->db->where('payment_id', $this->input->post('ids'));
            $this->db->update('payments', $data);
        }

        public function saveRemarks()
        {
            $data = array(
                'remarks' => $this->security->xss_clean($this->input->post('remarks'))
            );

            $this->db->where('denom_id', $this->input->post('denomid'));
            $this->db->update('denomination', $data);
        }

        public function saveIncentives()
        {
            // Clean and validate the input values
            $available_inc = floatval($this->security->xss_clean($this->input->post('inc_balance')));
            $total_collection = floatval($this->security->xss_clean($this->input->post('total_collection')));
            $totalinc = $this->security->xss_clean(str_replace(",","",$this->input->post('totalinc')));

            // Perform subtraction only if both values are numeric
            if (is_numeric($total_collection) && is_numeric($totalinc)) {
                $remaining_balance = $total_collection - $totalinc;
            } else {
                // Handle the case where either input value is not numeric
                $remaining_balance = null; // Or any other appropriate value indicating an error
            }

            if (is_numeric($available_inc) && is_numeric($totalinc)) {
                $remaining_inc = $available_inc - $totalinc;
            } else {
                // Handle the case where either input value is not numeric
                $remaining_inc = null; // Or any other appropriate value indicating an error
            }

            $data = array(
                'sm_inc' => $totalinc,
                'total_collection' => $remaining_balance
            );
            // var_dump($this->security->xss_clean(str_replace(",","",$this->input->post('totalinc'))));
            // die();
            $this->db->where('denom_id', $this->input->post('denomid'));
            $this->db->update('denomination', $data);


            $data2 = array(
                
                'inc_balance' => $remaining_inc
            );

            $this->db->where('sm_code', $this->input->post('sm_code'));
            $this->db->update('salesman_incentives_bal', $data2);

            // Check if sm_code already exists
            $this->db->where('sm_code', $this->input->post('sm_code'));
            $this->db->where('denom_id', $this->input->post('denomid'));
            $query = $this->db->get('salesman_incentives_used');

            if ($query->num_rows() > 0) {
                // If sm_code exists, update the record
                $data3 = array(
                    'inc_used' => $totalinc,
                    'denom_id' => $this->input->post('denomid')
                );
                //$this->db->where('sm_code', $this->input->post('sm_code'));

                $this->db->update('salesman_incentives_used', $data3);
            } else {
                // If sm_code doesn't exist, insert a new record
                $data3 = array(
                    'sm_code' => $this->input->post('sm_code'),
                    'inc_used' => $totalinc,
                    'denom_id' =>$this->input->post('denomid')
                );
                $this->db->insert('salesman_incentives_used', $data3);
            }
        }



        public function saveRemarks2()
        {
            $data = array(
                'remarks' => $this->security->xss_clean($this->input->post('remarks'))
            );

            $this->db->where('payment_id', $this->input->post('paymentid'));
            $this->db->update('payments', $data);
        }

        public function saveRemittance()
        {
            $data = array(
                'total_remittance' => $this->security->xss_clean($this->input->post('totalremittance'))
            );

            $this->db->where('denom_id', $this->input->post('denomid'));
            $this->db->update('denomination', $data);
        }

        public function check_remittance($id)
        {
            $query = $this->db->query('SELECT total_remittance FROM denomination WHERE denom_id='.$id);
            return $query->row();
        }

        public function check_remittances($ids) {
            // Modify the query to use where_in for multiple IDs
            $this->db->select('denom_id, total_remittance');
            $this->db->where_in('denom_id', $ids);
            $query = $this->db->get('denomination');

            // Return the result as an associative array with denom_id as the key
            $result = array();
            foreach ($query->result() as $row) {
                $result[$row->denom_id] = $row->total_remittance;
            }

            return $result;
        }


        public function getRemittanceCollection($id)
        {
            $query = $this->db->query('SELECT total_collection,total_remittance FROM denomination WHERE denom_id='.$id);
            return $query->row();
        }

        public function checkAmount()
        {
            $query = $this->db->query('SELECT IFNULL(SUM(amount),0.00) AS amt FROM payments WHERE user_id='.$this->input->post('userid').' AND pay_date="'.$this->input->post('date').'" AND denom_id='.$this->input->post('denomid').' AND type="'.$this->input->post('check').'"');
            
            return $query->row()->amt;
        }

        public function account($adate)
        {

            $query = $this->db->query('SELECT c.full_name,a.amount,(a.amount*0.75) AS collect,b.total_pdc,b.total_dc,b.total_cash,b.total_collection,(a.amount*0.75)-IF(ISNULL(b.total_collection),0.00,b.total_collection) AS variance,b.total_remittance,a.sm_code FROM salesman_account a LEFT JOIN denomination b ON a.user_id=b.user_id AND a.account_date=b.date_added INNER JOIN users c ON a.user_id=c.user_id WHERE a.account_date = "'.$adate.'" AND c.location="'.$this->session->userdata('location').'"');

            return $query->result();
        }

        public function account2($adate)
        {
            $query = $this->db->query('SELECT c.full_name,IF(ISNULL(a.amount),0.00,a.amount) AS amount,(IF(ISNULL(a.amount),0.00,a.amount)*0.75) AS collect,IF(ISNULL(b.total_collection),0.00,b.total_collection) AS total_collection,(IF(ISNULL(a.amount),0.00,a.amount)*0.75)-IF(ISNULL(b.total_collection),0.00,b.total_collection) AS variance,IF(ISNULL(b.total_remittance),0.00,b.total_remittance) AS total_remittance,a.sm_code,IF(ISNULL(b.expenses_amt),0.00,b.expenses_amt) AS expenses_amt FROM salesman_account a LEFT JOIN denomination b ON a.user_id=b.user_id AND a.account_date=b.date_added INNER JOIN users c ON a.user_id=c.user_id WHERE a.account_date = "'.$adate.'" AND c.location="'.$this->session->userdata('location').'" ');

            return $query->result_array();
        }

        public function colsum($datefrom, $dateto, $sm, $sm_type)
        {
            $loc = $this->session->userdata('location');
            $this->db->select('a.*, b.full_name, b.last_name, b.id_no, b.bu, 
                            (a.amt_1000 + a.amt_500 + a.amt_200 + a.amt_100 + a.amt_50 + a.amt_20) as total_bill, 
                            remarks');
            $this->db->from('denomination a');
            $this->db->join('users b', 'a.user_id = b.user_id');
            $this->db->where('a.date_added >=', $datefrom);
            $this->db->where('a.date_added <=', $dateto);

            // Apply conditions based on `$sm` and `$sm_type`
            if ($sm !== 'All' && ($sm_type === 'XTRUCK' || $sm_type === 'OPLAN')) {
                $this->db->where('b.id_no', $sm);
               // var_dump($sm);
            } elseif ($sm === 'All' && $sm_type === 'XTRUCK') {
                $this->db->where_in('b.bu', ["XTRUCK", "XTRUCK-NETMAN" , "XTRUCK-NETMAN-BPI", "XTRUCK-MPDI", "CVS", "3PS"]);
                $this->db->where('b.location', $loc);
            } else {
                $this->db->where('b.bu', $sm_type);
            }

            $this->db->group_by('a.denom_id');
            $this->db->order_by('a.date_added', 'ASC');

            $query = $this->db->get();

            // Debugging output for the final query
           // echo $this->db->last_query();

            return $query->result();
        }

        public function colsumdual($datefrom, $dateto, $sm, $sm_type, $sm_code2)
        {
            $loc = $this->session->userdata('location');
            $this->db->select('a.sm_code,b.full_name,b.bu,b.sm_code2,b.last_name,a.denom_id, c.*,
                                IFNULL(SUM(a.cash_amount), 0) AS cash_total,
                                IFNULL(SUM(CASE WHEN a.check_type = "Post Dated" THEN a.check_amount ELSE 0 END), 0) AS PDC,
                                IFNULL(SUM(CASE WHEN a.check_type = "Dated" THEN a.check_amount ELSE 0 END), 0) AS DC');
            $this->db->from('payments_xtruck a');
            $this->db->join('users b', 'a.sm_code = b.id_no');
            $this->db->join('denomination c', 'c.denom_id = a.denom_id');
            $this->db->join('payments_satellite d', 'a.sm_code = d.sm_code','left');
            $this->db->where('c.date_added >=', $datefrom);
            $this->db->where('c.date_added <=', $dateto);

            // Apply conditions based on `$sm` and `$sm_type`
            if ($sm !== 'All' && $sm_type !== 'XTRUCK') {
                $this->db->where('b.id_no', $sm);
            } elseif ($sm === 'All' && $sm_type === 'XTRUCK') {
                $this->db->where('b.bu', "XTRUCK-MPDI");
                $this->db->where('b.location', $loc);
            } else {
                // $sm_code2 = 'PE48';

                $this->db->where('b.bu', "XTRUCK-MPDI");
                $this->db->group_start();
                    $this->db->where('b.id_no', $sm);
                    if ($sm_code2) {
                        $this->db->or_where('b.id_no', $sm_code2);
                    }
                $this->db->group_end();
            }

            $this->db->group_by(array('a.sm_code', 'a.denom_id'));
            $this->db->order_by('a.denom_id', 'ASC');

            $query = $this->db->get();

            // Debugging output for the final query
            echo $this->db->last_query();

            return $query->result();
        }

        public function pdcdc($adate,$atype,$adate1)
        {
            
            if($atype == 'BOTH')
            {
                $query = $this->db->query('SELECT a.denom_id, a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount,b.bu FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'"GROUP BY a.payment_id ORDER BY a.denom_id ASC');
            }
            else
            {
                $query = $this->db->query('SELECT a.denom_id, a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount, b.bu FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'"GROUP BY a.payment_id ORDER BY a.denom_id ASC');
            }
            return $query->result();
        }

        public function pdcdc_ldi($adate,$atype,$adate1)
        {
           
            if($atype == 'BOTH')
            {
                $query = $this->db->query('SELECT a.denom_id,  a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.check_type,b.full_name,c.name,a.acc_name,a.acc_no,a.check_bank,a.check_no,a.pay_amount, b.bu FROM payments_ldi a INNER JOIN users b ON a.jefe_code=b.id_no INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND (a.pay_type = "CHECK" OR a.pay_type = "CHECK_BULK")  AND b.location="'.$this->session->userdata('location').'"GROUP BY a.pay_id ORDER BY a.denom_id ASC');
            }
            else
            {
                if($atype == 'PDC'){
                    $atype2 = 'Post Dated Check';
                }else{
                    $atype2 = 'Dated Check';
                }
                $query = $this->db->query('SELECT a.denom_id,  a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.check_type,b.full_name,c.name,a.acc_name,a.acc_no,a.check_bank,a.check_no,a.pay_amount,b.bu FROM payments_ldi a INNER JOIN users b ON a.jefe_code=b.id_no INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND (a.pay_type = "CHECK" OR a.pay_type = "CHECK_BULK") AND b.location="'.$this->session->userdata('location').'" AND a.check_type="'.$atype2.'"GROUP BY a.pay_id ORDER BY a.denom_id ASC');
            }
            return $query->result();
        }

        public function pdcdc_xtruck($adate,$atype,$adate1)
        {
           
            if($atype == 'BOTH')
            {
                // $query = $this->db->query('SELECT a.denom_id,  a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.check_type,b.full_name,c.name,a.acc_name,a.acc_no,a.check_bank,a.check_no,a.pay_amount, a.check_amount, b.bu FROM payments_xtruck a INNER JOIN users b ON a.sm_code=b.id_no INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND (a.pay_type = "Cheque" OR a.pay_type = "CHECK_BULK")  AND b.location="'.$this->session->userdata('location').'"GROUP BY a.pay_id ORDER BY a.denom_id ASC');

                $query = $this->db->query('
                SELECT 
                    a.denom_id,
                    a.pay_date,
                    a.due_date,
                    CONCAT(DATEDIFF(a.due_date, a.pay_date), " Day(s)") AS nodays,
                    CASE 
                        WHEN s.si_docno IS NOT NULL AND a.check_type = "Post Dated" THEN "Post Dated S"
                        WHEN s.si_docno IS NOT NULL AND a.check_type = "Dated" THEN "Dated S"
                        ELSE a.check_type
                    END AS check_type,
                    b.full_name,
                    c.name,
                    a.acc_name,
                    a.acc_no,
                    a.check_bank,
                    a.check_no,
                    a.pay_amount,
                    a.check_amount,
                    b.bu
                FROM 
                    payments_xtruck a
                INNER JOIN 
                    users b ON a.sm_code = b.id_no
                INNER JOIN 
                    customer c ON a.cus_code = c.code
                LEFT JOIN 
                    payments_satellite s ON s.si_docno = a.si_docno
                WHERE 
                    a.pay_date >= "'.$adate1.'" 
                    AND a.pay_date <= "'.$adate.'"  
                    AND a.status5 != "Returned Old"
                    AND (a.pay_type = "Cheque" OR a.pay_type = "CHECK_BULK")  
                    AND b.location = "'.$this->session->userdata('location').'"
                GROUP BY 
                    a.pay_id, a.si_docno
                ORDER BY 
                    a.pay_id ASC
                ');

            }
            else
            {
                if($atype == 'PDC'){
                    $atype2 = 'Post Dated';
                }else{
                    $atype2 = 'Dated';
                }
                // $query = $this->db->query('SELECT a.denom_id,  a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.check_type,b.full_name,c.name,a.acc_name,a.acc_no,a.check_bank,a.check_no,a.pay_amount,b.bu FROM payments_xtruck a INNER JOIN users b ON a.sm_code=b.id_no INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND (a.pay_type = "Cheque" OR a.pay_type = "CHECK_BULK") AND b.location="'.$this->session->userdata('location').'" AND a.check_type="'.$atype2.'"GROUP BY a.pay_id ORDER BY a.denom_id ASC');

                $query = $this->db->query('
                    SELECT 
                        a.denom_id,
                        a.pay_date,
                        a.due_date,
                        CONCAT(DATEDIFF(a.due_date, a.pay_date), " Day(s)") AS nodays,
                        CASE 
                            WHEN s.si_docno IS NOT NULL AND a.check_type = "Post Dated" THEN "Post Dated S"
                            WHEN s.si_docno IS NOT NULL AND a.check_type = "Dated" THEN "Dated S"
                            ELSE a.check_type
                        END AS check_type,
                        b.full_name,
                        c.name,
                        a.acc_name,
                        a.acc_no,
                        a.check_bank,
                        a.check_no,
                        a.check_amount, 
                        b.bu
                    FROM 
                        payments_xtruck a
                    INNER JOIN 
                        users b ON a.sm_code = b.id_no
                    INNER JOIN 
                        customer c ON a.cus_code = c.code
                    LEFT JOIN 
                        payments_satellite s ON s.si_docno = a.si_docno
                    WHERE 
                        a.pay_date >= "' . $adate1 . '" 
                        AND a.pay_date <= "' . $adate . '" 
                        AND a.status5 != "Returned Old"
                        AND (a.pay_type = "Cheque" OR a.pay_type = "CHECK_BULK")  
                        AND b.location = "' . $this->session->userdata('location') . '"
                        AND a.check_type = "' . $atype2 . '"
                    GROUP BY 
                        a.pay_id
                    ORDER BY 
                        a.pay_id ASC
                ');
            }
            return $query->result();
        }

        public function ret_pdcdc_xtruck()
        {
           
            $query = $this->db->query('SELECT a.denom_id,  a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.check_type,b.full_name,c.name,a.acc_name,a.acc_no,a.check_bank,a.check_no,a.pay_amount,b.bu, a.status5 FROM payments_xtruck a INNER JOIN users b ON a.sm_code=b.id_no INNER JOIN customer c ON a.cus_code=c.code WHERE (a.status5 = "Returned" OR a.status5 = "Returned Old" OR a.status5 = "Returned New") AND (a.pay_type = "Cheque" OR a.pay_type = "CHECK_BULK") AND b.location="'.$this->session->userdata('location').'" GROUP BY a.pay_id ORDER BY a.denom_id ASC');
            
            return $query->result();
        }

        public function ret_pdcdc_ldi()
        {
           
            
            $query = $this->db->query('SELECT a.denom_id,  a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.check_type,b.full_name,c.name,a.acc_name,a.acc_no,a.check_bank,a.check_no,a.pay_amount,b.bu FROM payments_ldi a INNER JOIN users b ON a.jefe_code=b.id_no INNER JOIN customer c ON a.cus_code=c.code WHERE (a.pay_type = "CHECKs" OR a.pay_type = "CHECK_BULKs") AND b.location="'.$this->session->userdata('location').'" GROUP BY a.pay_id ORDER BY a.denom_id ASC');
            
            return $query->result();
        }

        public function pdcdc_uwdg($adate,$atype,$adate1,$atype2,$bank,$utype)
        {
            if($atype == 'BOTH')
            {
                if($utype != 'All')
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                }
                else
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                }
            }
            else
            {
                if($utype != 'All')
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" AND b.type="'.$utype.'" ORDER BY a.pay_date ASC');
                    }
                }
                else
                {
                    if($atype2 == 'OtherBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="Other Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'PNBBanks')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND d.bank_type="PNB Bank" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    elseif($atype2 == 'All')
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code INNER JOIN bank d ON a.bank=d.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                    else
                    {
                        $query = $this->db->query('SELECT a.pay_date,a.due_date,CONCAT(DATEDIFF(a.due_date,a.pay_date), " Day(s)") AS nodays,a.type,b.full_name,c.name,a.acc_name,a.acc_num,a.bank,a.check_no,a.amount FROM payments a INNER JOIN users b ON a.user_id=b.user_id INNER JOIN customer c ON a.cus_code=c.code WHERE a.pay_date >= "'.$adate1.'" AND a.pay_date <= "'.$adate.'" AND b.location="'.$this->session->userdata('location').'" AND a.type="'.$atype.'" AND a.bank="'.$bank.'" AND a.status!="Cancelled" ORDER BY a.pay_date ASC');
                    }
                }
            }
            return $query->result();
        }

        public function accountrecord($adate)
        {
            $query = $this->db->query('SELECT a.account_id,a.user_id,b.full_name,a.amount FROM salesman_account a INNER JOIN users b ON a.user_id=b.user_id WHERE a.account_date="'.$adate.'"');
        
            return $query->result_array();
        }

        public function getUsers()
        {
            $query = $this->db->query('SELECT user_id,full_name FROM users WHERE location="'.$this->session->userdata('location').'" AND type="Salesman"');
        
            return $query->result();
        }

        public function getUserCode($id)
        {
            //tiwason
            $query = $this->db->query('SELECT id_no FROM users WHERE user_id = "'.$id.'"');

            return $query->row();
        }

        public function getUserFullName($id)
        {
            //tiwason
            $query = $this->db->query('SELECT full_name FROM users WHERE id_no = "'.$id.'"');

            return $query->row();
        }

        public function updateSm($id,$code)
        {
            $data = array(
                'user_id' => $this->input->post('sm'),
                'sm_code' => $code
            );

            $this->db->where('account_id', $id);
            $this->db->update('salesman_account', $data);
        }

        public function updateSmCustomer($uid,$date,$code)
        {
            $data = array(
                'user_id' => $this->input->post('sm'),
                'sm_code' => $code
            );

            $where = array('user_id' => $uid, 'collect_date' => $date);

            $this->db->where($where);
            $this->db->update('salesman_customer', $data);
        }

        public function getSmAccount($id)
        {
            $query = $this->db->query('SELECT * FROM salesman_account WHERE account_id='.$id);
            
            return $query->row();
        }

        public function getDenom($id)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,b.bu,b.location FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE denom_id='.$id);

            return $query->row();
        }

        public function getAllDenom($date)
        {
            $query = $this->db->query('SELECT a.*,b.full_name,b.last_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="Salesman" AND b.location="'.$this->session->userdata('location').'"');

            return $query->result();
        }

        public function getAllDenomTotal($date)
        {
            $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="Salesman" AND b.location="'.$this->session->userdata('location').'"');
        
            return $query->row();
        }

        public function getAllDenomTotal_ldi($date, $loc)
        {
            if($loc=="All"){
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection,SUM(a.total_palawan) AS total_palawan,b.bu FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }else{
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection,SUM(a.total_palawan) AS total_palawan,b.bu FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.bu="'.$loc.'" AND  b.location="'.$this->session->userdata('location').'"');
            }
           
        
            return $query->row();
        }

        public function getAllDenomTotal_ldi_per_Date($datefrom, $dateto)
        {
            
            $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection,b.bu FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added BETWEEN "'.$datefrom.'" AND "'.$dateto.'" AND b.location = "' . $this->session->userdata('location') . '"  ');
            
            return $query->row();
        }

        public function getAllPalawanTotal_ldi_per_Date($datefrom, $dateto)
        {
            
            $query = $this->db->query('SELECT SUM(c.pay_amount) as total_pal ,b.bu
                                            FROM denomination a 
                                            INNER JOIN users b ON a.user_id=b.user_id 
                                            INNER JOIN payments_palawan c ON a.denom_id = c.denom_id
                                            WHERE c.date_remitted BETWEEN "' . $datefrom . '" AND "' . $dateto . '" 
                                            ');
            
            return $query->row();
        }

        public function getAllDenomTotal_ldi_cashier($date)
        {
            $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,
                                            SUM(a.qty_500) AS qty_500,
                                            SUM(a.qty_200) AS qty_200,
                                            SUM(a.qty_100) AS qty_100,
                                            SUM(a.qty_50) AS qty_50,
                                            SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,
                                            SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,
                                            SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection,b.bu
                                            FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND a.approved_by="'.$this->session->userdata('user_id').'"');
        
            return $query->row();
        }

        public function getAllDenom_ldi($date, $loc)
        {
            if($loc=="All")
            {
                $query = $this->db->query('SELECT DISTINCT b.bu, 
                    CASE 
                        WHEN b.bu = "CVS" THEN "XTRUCK-NETMAN" 
                        WHEN b.bu = "3PS" THEN "XTRUCK" 
                        ELSE b.bu 
                    END AS mapped_bu,  a.*,b.full_name,b.last_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'" ORDER BY mapped_bu, b.bu');
            }else
            {
                $query = $this->db->query('SELECT a.*,b.full_name,b.bu,b.last_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.bu="'.$loc.'" AND b.location="'.$this->session->userdata('location').'"');
            }

            return $query->result();
        }

        public function getAllPalawan_ldi_per_Date($datefrom, $dateto,$bu)
        {
            if($bu != 'all'){
                $query = $this->db->query('SELECT DISTINCT b.bu, 
                    CASE 
                        WHEN b.bu = "CVS" THEN "XTRUCK-NETMAN" 
                        WHEN b.bu = "3PS" THEN "XTRUCK" 
                        ELSE b.bu 
                    END AS mapped_bu,
                    b.last_name,  
                    a.*, c.*,
                    b.full_name, c.pay_amount as total_pal
                FROM denomination a 
                INNER JOIN users b ON a.user_id = b.user_id 
                INNER JOIN payments_palawan c ON a.denom_id = c.denom_id
                WHERE c.date_remitted BETWEEN "' . $datefrom . '" AND "' . $dateto . '"
                    AND b.bu = "' . $bu . '" 
                ORDER BY mapped_bu, b.bu, c.date_remitted DESC
            ');
            }else{
                $query = $this->db->query('SELECT DISTINCT b.bu, 
                    CASE 
                        WHEN b.bu = "CVS" THEN "XTRUCK-NETMAN" 
                        WHEN b.bu = "3PS" THEN "XTRUCK" 
                        ELSE b.bu 
                    END AS mapped_bu,
                    b.last_name,  
                    a.*, c.*,
                    b.full_name, c.pay_amount as total_pal
                FROM denomination a 
                INNER JOIN users b ON a.user_id = b.user_id 
                INNER JOIN payments_palawan c ON a.denom_id = c.denom_id
                WHERE c.date_remitted BETWEEN "' . $datefrom . '" AND "' . $dateto . '"
                    
                ORDER BY mapped_bu, b.bu, c.date_remitted DESC
            ');
            }
            

            return $query->result();
        }

        public function getAllDenom_ldi_per_Date($datefrom, $dateto)
        {
            
            $query = $this->db->query('SELECT DISTINCT b.bu, 
                    CASE 
                        WHEN b.bu = "CVS" THEN "XTRUCK-NETMAN" 
                        WHEN b.bu = "3PS" THEN "XTRUCK" 
                        ELSE b.bu 
                    END AS mapped_bu,
                    b.last_name,  
                    a.*,
                    b.full_name,
                    (a.amt_1000 + a.amt_500 + a.amt_200 + a.amt_100 + a.amt_50 + a.amt_20) as total_bill,
                    remarks
                FROM denomination a 
                INNER JOIN users b 
                    ON a.user_id = b.user_id 
                WHERE a.date_added BETWEEN "' . $datefrom . '" AND "' . $dateto . '"
                    AND b.location = "' . $this->session->userdata('location') . '" 
                ORDER BY mapped_bu, b.bu
            ');

            return $query->result();
        }

        public function getAllDenom_ldi_cashier($date)
        {
            $query = $this->db->query('SELECT DISTINCT b.bu, b.last_name, a.*,b.full_name,b.bu,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks  FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND a.approved_by="'.$this->session->userdata('user_id').'" ORDER BY b.bu');

            return $query->result();
        }

        public function getAllDenom_uwdg($date,$utype)
        {
            if($utype=="All")
            {
                $query = $this->db->query('SELECT a.*,b.full_name,b.last_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }
            else
            {
                $query = $this->db->query('SELECT a.*,b.full_name,b.last_name,(a.amt_1000+a.amt_500+a.amt_200+a.amt_100+a.amt_50+a.amt_20) as total_bill,remarks FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="'.$utype.'" AND b.location="'.$this->session->userdata('location').'"');
            }

            return $query->result();
        }

        public function getAllDenomTotal_uwdg($date,$utype)
        {
            if($utype=="All")
            {
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.location="'.$this->session->userdata('location').'"');
            }
            else
            {
                $query = $this->db->query('SELECT SUM(a.qty_1000) AS qty_1000,SUM(a.qty_500) AS qty_500,SUM(a.qty_200) AS qty_200,SUM(a.qty_100) AS qty_100,SUM(a.qty_50) AS qty_50,SUM(a.qty_20) AS qty_20,(SUM(a.amt_1000)+SUM(a.amt_500)+SUM(a.amt_200)+SUM(a.amt_100)+SUM(a.amt_50)+SUM(a.amt_20)) AS total_bill,SUM(a.total_pdc) as total_pdc,SUM(a.total_dc) AS total_dc,SUM(a.total_coins) AS total_coins,SUM(a.total_collection) AS total_collection FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.date_added="'.$date.'" AND b.type="'.$utype.'" AND b.location="'.$this->session->userdata('location').'"');
            }
        
            return $query->row();
        }

        public function getSmCustomers($dates,$ids)
        {
            $query = $this->db->query('SELECT a.sc_id,a.cus_code,b.name,a.status FROM salesman_customer a LEFT JOIN customer b ON a.cus_code=b.code WHERE a.collect_date="'.$dates.'" AND a.user_id='.$ids);
            
            return $query->result_array();
        }

        public function checktag($ids)
        {
            $query = $this->db->query('SELECT status FROM salesman_customer WHERE sc_id='.$ids);

            return $query->row();
        }

        public function updateStatus($stat,$ids)
        {
            $data = array(
                'status' => $stat
            );

            $this->db->where('sc_id', $ids);
            $this->db->update('salesman_customer', $data);
        }

        public function getBu()
        {
            $query = $this->db->query('SELECT * FROM bu WHERE bu="'.$this->session->userdata('location').'"');

            return $query->row();
        }

        // public function getSmIds($did)
        // {
        //     $query = $this->db->query('SELECT a.date_added,b.id_no FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.denom_id='.$did);
        //     return $query->row();
        // }

        // public function getSmIds($did)
        // {
        //     $query = $this->db->query('SELECT a.date_added,b.id_no,a.denom_id, a.total_cash, a.total_pdc, a.total_dc, a.manualsrr FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.status3 != "Uploaded" and a.denom_id=?',array($did));
        //     return $query->row();
        // }

        public function getSmIds($did)
        {
            $query = $this->db->query('SELECT a.date_added,b.id_no,a.denom_id, a.total_cash, a.total_pdc, a.total_dc, a.sm_inc, a.total_palawan, a.manualsrr FROM denomination a INNER JOIN users b ON a.user_id=b.user_id WHERE a.status3 != "Uploaded" and a.denom_id=?',array($did));
            return $query->row();
        }

        public function getPayments($denom_id,$idno)
        {
            $query = $this->db->query('SELECT * FROM payments_ldi WHERE jefe_code="'.$idno.'" and denom_id = "'.$denom_id.'"');

            return $query->result_array();
        }

        public function getPaymentsInput($pdate,$idno)
        {
            $query = $this->db->query('SELECT * FROM payments WHERE denom_id="'.$idno.'"');

            return $query->result_array();
        }

        public function getPaymentsExt($idno)
        {
            //$query = $this->db->query('SELECT * FROM payments_xtruck WHERE denom_id="'.$idno.'" AND status5 != "Returned" ');

            $this->db->select('*');
            $this->db->from('payments_xtruck');
            $this->db->where('denom_id', $idno);
            $this->db->where('status5 !=', 'Returned');
        
            // Execute the query
            $query = $this->db->get();

            return $query->result_array();
        }

        public function getPaymentsExtDenom($idno)
        {
            $query = $this->db->query('SELECT * FROM payments_xtruck WHERE denom_id="'.$idno.'"');

            return $query->row();
        }

        public function getPaymentsMpdiDenom($idno)
        {
            $query = $this->db->query('SELECT a.*, b.* FROM denomination a INNER JOIN users b on a.user_id=b.user_id  WHERE a.denom_id="'.$idno.'"');

            return $query->row();
        }

        
        public function getPaymentsLdi($idno)
        {
            $query = $this->db->query('SELECT * FROM payments a LEFT JOIN customer b ON a.cus_code=b.code WHERE denom_id="'.$idno.'"');

            return $query->result();
        }

        // public function getPaymentsLdiOplan($idno)
        // {
        //     $query = $this->db->query('SELECT * FROM payments_ldi a INNER JOIN customer2 b ON a.cus_code=b.code WHERE denom_id="'.$idno.'" AND (a.pay_type = "CHECK" OR a.pay_type = "CHECK_BULK")');

        //     return $query->result();
        // }

        public function getPaymentsLdiOplan($idno)
        {
            $query = $this->db->query('SELECT *, IFNULL(SUM(a.pay_amount), 0.00) AS total  FROM payments_ldi a LEFT JOIN customer2 b ON a.cus_code=b.code WHERE  denom_id="'.$idno.'" and a.status3 != "Returned" AND (a.pay_type = "CHECK" OR a.pay_type = "CHECK_BULK") GROUP BY a.check_no') ;

            return $query->result();
        }

        public function getPaymentsLdiExt($idno)
        {
            $query = $this->db->query('SELECT * FROM payments_xtruck a INNER JOIN customer2 b ON a.cus_code=b.code WHERE denom_id="'.$idno.'" AND (a.pay_type = "Cheque" OR a.pay_type = "CHECK_BULK")');

            return $query->result();
        }

        // public function get_data() {
        //     $query = $this->db->query('SELECT b.status,b.si_docno, b.pay_date, b.cus_code, b.cus_name, b.pay_amount, b.disc_amount, b.inc_amount, b.deals, b.net_amount, b.pay_type, b.check_no, b.due_date, b.acc_no, b.acc_name, b.check_bank, b.sm_code, b.ref_no, b.check_type,  b.status2, b.denom_id FROM denomination a INNER JOIN payments_xtruck b on a.denom_id=b.denom_id  WHERE a.status="Approved" AND b.status3 !="Exported" ');
        //     // return $query->result();
        //     $results = $query->result();

        //     foreach ($results as $result) {
        //         $this->db->set('status3', 'Exported');
        //         $this->db->where('si_docno', $result->si_docno); // Assuming si_docno is the primary key
        //         $this->db->update('payments_xtruck');
        //     }
            
        //     return $results;
        // }

        public function get_data() {
            $query = $this->db->query('SELECT b.status,b.si_docno, b.pay_date, b.cus_code, b.cus_name, b.pay_amount, b.disc_amount, b.inc_amount, b.deals, b.tax_amount, b.cash_amount, b.check_amount, b.net_amount,  b.pay_type, b.check_no, b.due_date, b.acc_no, b.acc_name, b.check_bank, b.sm_code, b.ref_no, b.check_type,  b.status2, b.denom_id, b.status5 FROM denomination a INNER JOIN payments_xtruck b on a.denom_id=b.denom_id  WHERE a.status="Approved" AND b.status3 !="Exported" AND b.status5 != "Returned New" ');
            // return $query->result();
            $results = $query->result();

            foreach ($results as $result) {
                $this->db->set('status3', 'Exported');
                $this->db->where('si_docno', $result->si_docno); // Assuming si_docno is the primary key
                $this->db->update('payments_xtruck');
            }
            
            return $results;
        }

        public function get_data2() {
            $query = $this->db->query('SELECT b.tran_type,b.order_no, b.posting_date, b.acc_no, b.cus_name, b.sm_code, b.bo_amount, b.rep_amount, b.cash_amount, b.status, b.denom_id FROM denomination a INNER JOIN returns_xtruck b on a.denom_id=b.denom_id  WHERE a.status="Approved" AND b.status2 !="Exported" ');
            // return $query->result();
            $results = $query->result();

            foreach ($results as $result) {
                $this->db->set('status2', 'Exported');
                $this->db->where('order_no', $result->order_no); // Assuming si_docno is the primary key
                $this->db->update('returns_xtruck');
            }
            
            return $results;
        }

        public function get_data3() {
            $query = $this->db->query('SELECT c.id, c.sm_code, c.denom_id, IFNULL(SUM(a.sm_inc), 0.00) AS totalinc 
                                        FROM denomination a  
                                        INNER JOIN users b ON a.user_id = b.user_id
                                        INNER JOIN salesman_incentives_used c ON a.denom_id = c.denom_id 
                                        WHERE a.status = "Approved" AND c.status != "Exported" AND a.sm_inc !=0.00 AND c.inc_used != 0.00
                                        GROUP BY  a.denom_id');
            // return $query->result();
            $results = $query->result();

            foreach ($results as $result) {
                $this->db->set('status', 'Exported');
                $this->db->where('denom_id', $result->denom_id); 
                $this->db->update('salesman_incentives_used');
            }
            
            return $results;
        }

        public function get_data4() {
            $query = $this->db->query('SELECT  b.id_no, a.denom_id, a.total_remittance , a.total_collection
                                        FROM denomination a  
                                        INNER JOIN users b ON a.user_id = b.user_id
                                       
                                        WHERE a.status = "Approved" AND a.status2 != "Exported"
                                        GROUP BY b.id_no, a.denom_id');
            // return $query->result();
            $results = $query->result();

            foreach ($results as $result) {
                $this->db->set('status2', 'Exported');
                $this->db->where('denom_id', $result->denom_id); // Assuming si_docno is the primary key
                $this->db->update('denomination');
            }
            
            return $results;
        }

        public function getPaymentsHeadExt($denom_id) {
            $query = $this->db->query('SELECT 
				a.total_cash, 
				a.total_pdc, 
				a.total_dc, 
				a.date_added, 
				SUM(b.check_amount) AS check_amount, 
				b.check_type,
				b.denom_id ,
				b.check_no, 
				b.acc_no, 
				b.acc_name, 
				b.check_bank,
				b.pay_type, 
				b.due_date, 
				b.sm_code
			FROM denomination a 
			LEFT JOIN payments_xtruck b 
				ON a.denom_id = b.denom_id
			LEFT JOIN payments_satellite c 
				ON b.denom_id = c.denom_id AND b.si_docno = c.si_docno
			WHERE a.denom_id = "'.$denom_id.'" 
			AND b.pay_type = "Cheque"
			AND c.denom_id IS NULL
			AND a.status3 != "Uploaded"
            AND b.status5 != "Returned"
			GROUP BY b.check_no, b.acc_no, b.acc_name, b.check_bank
			');
    
            // return $query->result();
            $results = $query->result_array();

            
            
            return $results;
        }

		public function getPaymentsHeadPalawan($denom_id) {
            $query = $this->db->query('SELECT 
				a.total_cash, 
				a.total_pdc, 
				a.total_dc, 
				a.date_added, 
				b.* 
			FROM denomination a 
			LEFT JOIN payments_palawan b 
				ON a.denom_id = b.denom_id
			WHERE a.denom_id = "'.$denom_id.'" 
			
			AND a.status4 != "Uploaded"
			GROUP BY b.pay_id
			');
    
            // return $query->result();
            $results = $query->result_array();

            
            
            return $results;
        }

        

        public function get_data_denom($denom_id) {
            $query = $this->db->query('SELECT b.status,b.si_docno, b.pay_date, b.cus_code, b.cus_name, b.pay_amount, b.disc_amount, b.inc_amount, b.deals, b.tax_amount, b.cash_amount, b.check_amount, b.net_amount,  b.pay_type, b.check_no, b.due_date, b.acc_no, b.acc_name, b.check_bank, b.sm_code, b.ref_no, b.check_type,  b.status2, a.manualsrr, b.status5 FROM denomination a INNER JOIN payments_xtruck b on a.denom_id=b.denom_id  WHERE a.denom_id="'.$denom_id.'" ');
            // return $query->result(); AND b.status5 != "Returned New"
            $results = $query->result();

            // foreach ($results as $result) {
            //     $this->db->set('status3', 'Exported');
            //     $this->db->where('si_docno', $result->si_docno); // Assuming si_docno is the primary key
            //     $this->db->update('payments_xtruck');
            // }
            
            return $results;
        }

        public function get_data2_denom($denom_id) {
            $query = $this->db->query('SELECT b.tran_type,b.order_no, b.posting_date, b.acc_no, b.cus_name, b.sm_code, b.bo_amount, b.rep_amount, b.cash_amount, b.status, a.manualsrr FROM denomination a INNER JOIN returns_xtruck b on a.denom_id=b.denom_id  WHERE a.denom_id="'.$denom_id.'" ');
            // return $query->result(); AND b.posting_date = CURDATE()
            $results = $query->result();

            // foreach ($results as $result) {
            //     $this->db->set('status2', 'Exported');
            //     $this->db->where('order_no', $result->order_no); // Assuming si_docno is the primary key
            //     $this->db->update('returns_xtruck');
            // }
            
            return $results;
        }

        public function get_data3_denom($denom_id) {
            $query = $this->db->query('SELECT c.id, c.sm_code, a.manualsrr, IFNULL(SUM(a.sm_inc), 0.00) AS totalinc 
                                        FROM denomination a  
                                        INNER JOIN users b ON a.user_id = b.user_id
                                        INNER JOIN salesman_incentives_used c ON a.denom_id = c.denom_id 
                                        WHERE a.sm_inc !=0.00 AND c.inc_used != 0.00 and a.denom_id="'.$denom_id.'"
                                        GROUP BY  a.denom_id');
            // return $query->result();
            $results = $query->result();

            // foreach ($results as $result) {
            //     $this->db->set('status', 'Exported');
            //     $this->db->where('denom_id', $result->denom_id); 
            //     $this->db->update('salesman_incentives_used');
            // }
            
            return $results;
        }

        // public function get_data4_denom($denom_id) {
        //     $query = $this->db->query('SELECT 
        //             b.id_no, 
        //             a.manualsrr, 
        //             SUM(a.total_remittance + SUM(c.pay_amount)) AS total_remittance, 
        //             SUM(a.total_collection + SUM(c.pay_amount)) AS total_collection 
        //         FROM 
        //             denomination a  
        //         INNER JOIN 
        //             users b 
        //         ON 
        //             a.user_id = b.user_id
        //         LEFT JOIN
        //             payments_palawan c
        //         ON
        //             a.denom_id = c.denom_id
        //         WHERE 
        //             a.status = "Approved" 
        //             AND a.denom_id = "'.$denom_id.'"
        //         GROUP BY 
        //             b.id_no, a.denom_id
        //     ');
    
        //     // return $query->result();
        //     $results = $query->result();

        //     // foreach ($results as $result) {
        //     //     $this->db->set('status2', 'Exported');
        //     //     $this->db->where('denom_id', $result->denom_id); // Assuming si_docno is the primary key
        //     //     $this->db->update('denomination');
        //     // }
            
        //     return $results;
        // }

        public function get_data4_denom_mpdi($denom_id) {
            $query = $this->db->query('SELECT 
                    b.id_no, 
                    a.manualsrr, 
                    SUM(a.total_remittance + a.total_palawan) AS total_remittance, 
                    SUM(a.total_collection + a.total_palawan) AS total_collection 
                FROM 
                    denomination a  
                INNER JOIN 
                    users b 
                ON 
                    a.user_id = b.user_id
                WHERE 
                    a.status = "Approved" 
                    AND a.denom_id = "'.$denom_id.'"
                GROUP BY 
                    b.id_no, a.denom_id
            ');
    
            // return $query->result();
            $results = $query->result();

            // foreach ($results as $result) {
            //     $this->db->set('status2', 'Exported');
            //     $this->db->where('denom_id', $result->denom_id); // Assuming si_docno is the primary key
            //     $this->db->update('denomination');
            // }
            
            return $results;
        }

        public function get_data4_denom($denom_id) {
            $sql = 'SELECT 
                        b.id_no, 
                        a.manualsrr, 
                        (a.total_remittance + IFNULL(c.total_pay, 0)) AS total_remittance, 
                        (a.total_collection + IFNULL(c.total_pay, 0)) AS total_collection 
                    FROM 
                        denomination a  
                    INNER JOIN 
                        users b ON a.user_id = b.user_id
                    LEFT JOIN (
                        SELECT denom_id, SUM(pay_amount) AS total_pay 
                        FROM payments_palawan 
                        GROUP BY denom_id
                    ) c ON a.denom_id = c.denom_id
                    WHERE 
                        a.status = "Approved" 
                        AND a.denom_id = ?
                    GROUP BY 
                        b.id_no, a.manualsrr, a.total_remittance, a.total_collection, c.total_pay';
        
            $query = $this->db->query($sql, array($denom_id));
            return $query->result();
        }
        
        

        public function get_data5_denom($denom_id) {
            $query = $this->db->query('SELECT b.sm_code,b.sm_name, b.ref_no, b.pay_amount, b.date_remitted, b.date_uploaded, b.status, a.manualsrr FROM denomination a INNER JOIN payments_palawan b on a.denom_id=b.denom_id  WHERE a.denom_id="'.$denom_id.'" ');
            // return $query->result(); AND b.posting_date = CURDATE()
            $results = $query->result();

            // foreach ($results as $result) {
            //     $this->db->set('status2', 'Exported');
            //     $this->db->where('order_no', $result->order_no); // Assuming si_docno is the primary key
            //     $this->db->update('returns_xtruck');
            // }
            
            return $results;
        }

        public function get_data6_denom($denom_id) {
            $query = $this->db->query('SELECT b.sm_code,b.sm_name, b.ref_no, b.pay_amount, b.date_remitted, b.date_uploaded, b.status, a.manualsrr FROM denomination a INNER JOIN payments_underthecup b on a.denom_id=b.denom_id  WHERE a.denom_id="'.$denom_id.'" ');
            // return $query->result(); AND b.posting_date = CURDATE()
            $results = $query->result();

            // foreach ($results as $result) {
            //     $this->db->set('status2', 'Exported');
            //     $this->db->where('order_no', $result->order_no); // Assuming si_docno is the primary key
            //     $this->db->update('returns_xtruck');
            // }
            
            return $results;
        }

        public function getReturns($idno)
        {
            $query = $this->db->query('SELECT * FROM returns WHERE hepe_code="'.$idno.'" ');

            return $query->result_array();
        }

        public function getReturnsExt($idno)
        {
            $query = $this->db->query('SELECT * FROM returns_xtruck WHERE sm_code="'.$idno.'" ');

            return $query->result_array();
        }

        public function getLocation($loc)
        {
            $query = $this->db->query('SELECT * FROM locations WHERE location_name="'.$loc.'"');

            return $query->row();
        }

        public function updatePaymentStatus($id)
        {
            $data = array(
                'status' => 'Uploaded'
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_ldi', $data);
        }

        public function updatePaymentStatusInputted($id)
        {
            $data = array(
                'status' => 'Uploaded'
            );

            $this->db->where('payment_id', $id);
            $this->db->update('payments', $data);
        }

        public function updatePaymentStatusExt($id)
        {
            $data = array(
                'status4' => 'Uploaded'
            );

            $this->db->where('pay_id', $id);
            $this->db->update('payments_xtruck', $data);
        }

		public function updatePaymentStatusExtHead($id)
        {
            $data = array(
                'status3' => 'Uploaded'
            );

            $this->db->where('denom_id', $id);
            $this->db->update('denomination', $data);
        }

		public function updatePaymentStatusExtHeadPal($id)
        {
            $data = array(
                'status4' => 'Uploaded'
            );

            $this->db->where('denom_id', $id);
            $this->db->update('denomination', $data);
        }

        public function updatePaymentStatusExtBo($id)
        {
            $data = array(
                'status3' => 'Uploaded'
            );

            $this->db->where('bo_id', $id);
            $this->db->update('returns_xtruck', $data);
        }

        public function updateReturnStatus($id)
        {
            $data = array(
                'status' => 'Uploaded'
            );

            $this->db->where('return_no', $id);
            $this->db->update('returns', $data);
        }

        public function unfileDenomXt($denomid)
        {
            $this->db->where('denom_id', $denomid);
            return $this->db->delete('denomination');
        }

        public function untagDenomXt($denomid)
        {
            $data = [
                'status3' => '',
                'status4' => ''
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('denomination', $data);
        }

        public function updateStatusPayXt($denomid)
        {
            $data = [
                'status2' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('payments_xtruck', $data);
        }

        public function updateStatusSatXt($denomid)
        {
            $data = [
                'status' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('payments_satellite', $data);
        }

        public function updateStatusPalXt($denomid)
        {
            $data = [
                'status' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('payments_palawan', $data);
        }

        public function updateStatusPalOp($denomid)
        {
            $data = [
                'status' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('payments_palawan_op', $data);
        }

        public function updateStatusUtcXt($denomid)
        {
            $data = [
                'status' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('payments_underthecup', $data);
        }

        public function updateStatusRetXt($denomid)
        {
            // Convert $denomid to match the format in the database
            $denomid_str = ltrim($denomid, '0');
            // var_dump($denomid);
            // var_dump($denomid_str);
            // die();
            $data = [
                'status' => '',
                'denom_id' => ''
            ];
            
            $this->db->where('denom_id', $denomid_str);
            return $this->db->update('returns_xtruck', $data);
        }

        public function updateIncentives($denomid)
        {
            // Step 1: Get inc_used and sm_code from salesman_incentives_used by denom_id
            $this->db->select('inc_used, sm_code');
            $this->db->from('salesman_incentives_used');
            $this->db->where('denom_id', $denomid);
            $query = $this->db->get();

            // Check if the row exists
            if ($query->num_rows() > 0) {
                $result = $query->row();
                $inc_used = $result->inc_used;
                $sm_code = $result->sm_code;

                // Step 2: Add inc_used to the inc_balance in salesman_incentives_bal by sm_code
                $this->db->set('inc_balance', "inc_balance + {$inc_used}", false);
                $this->db->where('sm_code', $sm_code);
                $this->db->update('salesman_incentives_bal');

                // Step 3: Delete the row from salesman_incentives_used by denom_id
                $this->db->where('denom_id', $denomid);
                return $this->db->delete('salesman_incentives_used');

            
            }

        }

        public function updateStatusPayOp($denomid)
        {
            $data = [
                'status2' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('payments_ldi', $data);
        }

        public function updateStatusRetOp($denomid)
        {
            $denomid_str = ltrim($denomid, '0');
            $data = [
                'status2' => '',
                'denom_id' => ''
            ];
            $this->db->where('denom_id', $denomid_str);
            return $this->db->update('returns', $data);
        }

        public function updateStatusBoOp($denomid)
        {
            $data = [
                'status' => '',
                'denom_id' => '00000000'
            ];
            $this->db->where('denom_id', $denomid);
            return $this->db->update('bo', $data);
        }
    }
?>