<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['api/get_data'] 													= 'Cont_Api/get_data';
$route['api/get_data_denom'] 											= 'Cont_Api/get_data_denom';
$route['api/get_data_denom_mpdi'] 										= 'Cont_Api/get_data_denom_mpdi';

$route['crudcreate'] 													= 'crudController/crudcreate';
$route['crudupdate'] 													= 'crudController/crudupdate';
$route['cruddelete'] 													= 'crudController/cruddelete';
$route['crudreset'] 													= 'crudController/crudreset';
$route['checkCurrentPassword'] 											= 'crudController/checkCurrentPassword';
$route['checkUsername'] 												= 'crudController/checkUsername';
$route['changeLocation'] 												= 'crudController/changeLocation';
$route['changeBu'] 														= 'crudController/changeBu';
$route['login_validation'] 												= 'Login/login_validation';
$route['edituser_content'] 												= 'crudController/edituser_content';
$route['adduser_content'] 												= 'crudController/adduser_content';
$route['user_password'] 												= 'crudController/user_password';
$route['user_username'] 												= 'crudController/user_username';
$route['user_location'] 												= 'crudController/user_location';
$route['user_bu'] 														= 'crudController/user_bu';

$route['main'] 															= 'crudController/index';
$route['logout'] 														= 'crudController/logout';
$route['user'] 															= 'crudController/user';
$route['logs'] 															= 'crudController/logs';

$route['banks'] 														= 'Cont_Bank/index';
$route['addbank_content'] 												= 'Cont_Bank/addbank_content';
$route['editbank_content'] 												= 'Cont_Bank/editbank_content';
$route['insertBank'] 													= 'Cont_Bank/insertBank';
$route['updateBank'] 													= 'Cont_Bank/updateBank';
$route['deleteBank'] 													= 'Cont_Bank/deleteBank';

$route['customers'] 													= 'Cont_Customer/index';
$route['upload_file'] 													= 'Cont_Customer/upload_file';
$route['save_customer'] 												= 'Cont_Customer/save_customer';

$route['smdenom'] 														= 'Cont_Denom/index';
$route['save_denom'] 													= 'Cont_Denom/save_denom';
$route['sm_ledger'] 													= 'Cont_Denom/sm_ledger';
$route['smdenom_edit/(:any)'] 											= 'Cont_Denom/smdenom_edit/$1';
$route['update_denom'] 													= 'Cont_Denom/update_denom';
$route['smdenom_view/(:any)'] 											= 'Cont_Denom/view_denom/$1';
$route['delete_denom'] 													= 'Cont_Denom/delete_denom';
$route['cashierdenom'] 													= 'Cont_Denom/cashierdenom';
$route['save_denom_cashier'] 											= 'Cont_Denom/save_denom_cashier';
$route['cashier_ledger'] 												= 'Cont_Denom/cashier_ledger';
$route['cashierdenom_edit/(:any)'] 										= 'Cont_Denom/cashierdenom_edit/$1';
$route['update_denom_cashier'] 											= 'Cont_Denom/update_denom_cashier';
$route['view_sm_denom'] 												= 'Cont_Denom/view_sm_denom';
$route['view_sm_denom_ldi'] 											= 'Cont_Denom/view_sm_denom_ldi';
$route['view_allsm_denom'] 												= 'Cont_Denom/view_allsm_denom';
$route['view_cashier_denom'] 											= 'Cont_Denom/view_cashier_denom';
$route['get_collection'] 												= 'Cont_Denom/get_collection';
$route['get_collection_xtruck'] 										= 'Cont_Denom/get_collection_xtruck';

$route['view_sm_checks_ldi'] 											= 'Cont_Cashier_Sm/view_sm_checks_ldi';
$route['view_sm_pal_ldi'] 											    = 'Cont_Cashier_Sm/view_sm_pal_ldi';

$route['view_sm_inc_ldi'] 											    = 'Cont_Cashier_Sm/view_sm_inc_ldi';
$route['view_sm_inc_used_ldi'] 											= 'Cont_Cashier_Sm/view_sm_inc_used_ldi';


$route['cashpay'] 														= 'Cont_Payments/index';
$route['get_customer'] 													= 'Cont_Payments/get_customer';
$route['cashier_payment'] 												= 'Cont_Payments/cashier_payment';
$route['save_cashier_payment'] 											= 'Cont_Payments/save_cashier_payment';
$route['cashier_date'] 													= 'Cont_Payments/cashier_date';
$route['cashpaydata/(:any)'] 											= 'Cont_Payments/cashier_payment_data/$1';
$route['cashieredit/(:any)'] 											= 'Cont_Payments/cashierpayment_edit/$1';
$route['edit_cashier_payment'] 											= 'Cont_Payments/edit_cashier_payment';
$route['delete_payment'] 												= 'Cont_Payments/delete_payment';
$route['delete_payment_ldi'] 											= 'Cont_Payments/delete_payment_ldi';
$route['view_cashier_payment'] 											= 'Cont_Payments/view_cashier_payment';
$route['view_cashier_payment_ldi'] 										= 'Cont_Payments/view_cashier_payment_ldi';
$route['view_cashier_payment_ldi_ext'] 									= 'Cont_Payments/view_cashier_payment_ldi_ext';

$route['remitdate']														= 'Cont_Cashier_Sm/index';
$route['checkclearingdate'] 											= 'Cont_Cashier_Sm/checkclearingdate';
$route['admindate'] 											        = 'Cont_Cashier_Sm/admindate';
$route['admindatepal'] 											        = 'Cont_Cashier_Sm/admindatepal';
$route['admindatesat'] 											        = 'Cont_Cashier_Sm/admindatesat';
$route['admindateutc'] 											        = 'Cont_Cashier_Sm/admindateutc';
$route['admindatedenom'] 											    = 'Cont_Cashier_Sm/admindatedenom';
$route['admindateret'] 											        = 'Cont_Cashier_Sm/admindateret';
$route['admindatebo'] 											        = 'Cont_Cashier_Sm/admindatebo';
$route['admindateinc'] 											        = 'Cont_Cashier_Sm/admindateinc';
$route['checkreturned/(:any)/(:any)'] 									= 'Cont_Cashier_Sm/checkreturned/$1/$2';
$route['checkreturnedop/(:any)/(:any)'] 								= 'Cont_Cashier_Sm/checkreturnedop/$1/$2';
// $route['smdenomdata/(:any)'] 											= 'Cont_Cashier_Sm/cashiersm_payment_data/$1';

$route['smdenomdata'] 											        = 'Cont_Cashier_Sm/cashiersm_payment_data';

$route['smpaymentdataopsi/(:any)'] 										= 'Cont_Cashier_Sm/cashiersm_payment_dataopsi/$1';
$route['smpaymentdataop/(:any)/(:any)/(:any)'] 							= 'Cont_Cashier_Sm/cashiersm_payment_dataop/$1/$2/$3';
$route['smpaymentdataxt/(:any)/(:any)/(:any)'] 							= 'Cont_Cashier_Sm/cashiersm_payment_dataxt/$1/$2/$3';
$route['smpaymentdataxtsi/(:any)'] 							            = 'Cont_Cashier_Sm/cashiersm_payment_dataxtsi/$1';
$route['smpaymentdataxtpal/(:any)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/cashiersm_payment_dataxtpal/$1/$2/$3';
$route['smpaymentdataxtpalref/(:any)'] 									= 'Cont_Cashier_Sm/cashiersm_payment_dataxtpalref/$1';
$route['smpaymentdataoppal/(:any)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/cashiersm_payment_dataoppal/$1/$2/$3';
$route['smpaymentdataoppalref/(:any)'] 									= 'Cont_Cashier_Sm/cashiersm_payment_dataoppalref/$1';
$route['smpaymentdataxtsat/(:any)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/cashiersm_payment_dataxtsat/$1/$2/$3';
$route['smpaymentdataxtsatref/(:any)'] 									= 'Cont_Cashier_Sm/cashiersm_payment_dataxtsatref/$1';
$route['smpaymentdataxtutc/(:any)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/cashiersm_payment_dataxtutc/$1/$2/$3';
$route['smpaymentdataxtutcref/(:any)'] 									= 'Cont_Cashier_Sm/cashiersm_payment_dataxtutcref/$1';
$route['smpaymentdataopbo/(:any)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/cashiersm_payment_dataopbo/$1/$2/$3';
$route['smpaymentdataopboref/(:any)'] 									= 'Cont_Cashier_Sm/cashiersm_payment_dataopboref/$1';
$route['smpaymentdataxtinc/(:any)'] 									= 'Cont_Cashier_Sm/cashiersm_payment_dataxtinc/$1';


//$route['get_cashier_sm_data_ajax/(:any)']                               = 'Cont_Cashier_Sm/get_cashier_sm_data_ajax/$1';
$route['get_cashier_sm_data_ajax']                                      = 'Cont_Cashier_Sm/get_cashier_sm_data_ajax';
$route['fetch_ledger_data']                                             = 'Cont_Denom/fetch_ledger_data';


$route['smreturndataopsi/(:any)'] 										= 'Cont_Cashier_Sm/cashiersm_return_dataopsi/$1';
$route['smreturndataop/(:any)/(:any)/(:any)'] 							= 'Cont_Cashier_Sm/cashiersm_return_dataop/$1/$2/$3';

$route['smreturndataxtsi/(:any)'] 										= 'Cont_Cashier_Sm/cashiersm_return_dataxtsi/$1';
$route['smreturndataxt/(:any)/(:any)/(:any)'] 							= 'Cont_Cashier_Sm/cashiersm_return_dataxt/$1/$2/$3';

$route['smdenomdataxt/(:any)/(:any)/(:any)'] 						    = 'Cont_Cashier_Sm/cashiersm_payment_dataxtsrr/$1/$2/$3';
$route['smdenomdataxtsrr/(:any)'] 									    = 'Cont_Cashier_Sm/cashiersm_payment_dataxtsrrno/$1';

$route['smdenomdataop/(:any)/(:any)/(:any)'] 						    = 'Cont_Cashier_Sm/cashiersm_payment_dataopsrr/$1/$2/$3';
$route['smdenomdataopsrr/(:any)'] 									    = 'Cont_Cashier_Sm/cashiersm_payment_dataopsrrno/$1';

$route['dvsrrop/(:any)/(:any)/(:any)'] 							        = 'Cont_Cashier_Sm/dvsrr_op/$1/$2/$3';
$route['dvsrrxt/(:any)/(:any)/(:any)'] 							        = 'Cont_Cashier_Sm/dvsrr_xt/$1/$2/$3';

$route['checkclearing/(:any)/(:any)'] 									= 'Cont_Cashier_Sm/checkclearing/$1/$2';
$route['change_check'] 												    = 'Cont_Cashier_Sm/change_check';
$route['change_check_op'] 												= 'Cont_Cashier_Sm/change_check_op';
$route['change_check_xt'] 												= 'Cont_Cashier_Sm/change_check_xt';
$route['update_inc_xt'] 												= 'Cont_Cashier_Sm/update_inc_xt';
$route['delete_check_op'] 												= 'Cont_Cashier_Sm/delete_check_op';
$route['delete_check_xt'] 												= 'Cont_Cashier_Sm/delete_check_xt';
$route['delete_ret_op'] 												= 'Cont_Cashier_Sm/delete_ret_op';
$route['delete_ret_xt'] 												= 'Cont_Cashier_Sm/delete_ret_xt';
$route['delete_palawan_xt'] 											= 'Cont_Cashier_Sm/delete_palawan_xt';
$route['delete_palawan_op'] 											= 'Cont_Cashier_Sm/delete_palawan_op';
$route['delete_bo_op'] 											        = 'Cont_Cashier_Sm/delete_bo_op';
$route['delete_satellite_xt'] 											= 'Cont_Cashier_Sm/delete_satellite_xt';
$route['delete_utc_xt'] 											    = 'Cont_Cashier_Sm/delete_utc_xt';
$route['unfile_denom_xt'] 											    = 'Cont_Cashier_Sm/unfile_denom_xt';
$route['unfile_denom_op'] 											    = 'Cont_Cashier_Sm/unfile_denom_op';
$route['untag_denom_xt'] 											    = 'Cont_Cashier_Sm/untag_denom_xt';
$route['approve_sm_denom'] 												= 'Cont_Cashier_Sm/approve_sm_denom';
$route['approve_sm_denoms'] 											= 'Cont_Cashier_Sm/approve_sm_denoms';
$route['disapprove_sm_denom'] 											= 'Cont_Cashier_Sm/disapprove_sm_denom';
$route['delete_payments_op'] 											= 'Cont_Cashier_Sm/delete_payments_op';
$route['checkentry/(:any)/(:any)/(:any)']								= 'Cont_Cashier_Sm/check_entry_sm/$1/$2/$3';
$route['get_customer1'] 												= 'Cont_Cashier_Sm/get_customer1';
$route['save_sm_payment'] 												= 'Cont_Cashier_Sm/save_sm_payment';
$route['viewsmchecks/(:num)/(:any)/(:any)'] 							= 'Cont_Cashier_Sm/view_sm_checks/$1/$2/$3';
$route['viewsmchecksextruck/(:num)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/view_sm_checks_extruck/$1/$2/$3';
$route['viewsmpalextruck/(:num)/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/view_sm_pal_extruck/$1/$2/$3';

$route['get_accname'] 													= 'Cont_Cashier_Sm/get_accname';
$route['transfer_customer'] 											= 'Cont_Cashier_Sm/transfer_customer';
$route['transfer_customer2'] 											= 'Cont_Cashier_Sm/transfer_customer2';
$route['transfer_customer_to_ccd'] 										= 'Cont_Cashier_Sm/transfer_customer_to_ccd';
$route['edit_sm_check'] 												= 'Cont_Cashier_Sm/edit_sm_check';
$route['edit_sm_check_ldi'] 											= 'Cont_Cashier_Sm/edit_sm_check_ldi';
$route['edit_sm_check_ldi_op'] 											= 'Cont_Cashier_Sm/edit_sm_check_ldi_op';
$route['edit_sm_check_ldi_xt'] 											= 'Cont_Cashier_Sm/edit_sm_check_ldi_xt';
$route['edit_sm_palawan_ldi_xt'] 										= 'Cont_Cashier_Sm/edit_sm_palawan_ldi_xt';
$route['edit_sm_denom_ldi_op'] 										    = 'Cont_Cashier_Sm/edit_sm_denom_ldi_op';
$route['edit_sm_check_ldi_tax_op'] 										= 'Cont_Cashier_Sm/edit_sm_check_ldi_tax_op';
$route['edit_sm_check_ldi_tax_op_minus'] 								= 'Cont_Cashier_Sm/edit_sm_check_ldi_tax_op_minus';

$route['edit_sm_check_ext'] 											= 'Cont_Cashier_Sm/edit_sm_check_ext';
$route['edit_ret_check_ext'] 											= 'Cont_Cashier_Sm/edit_ret_check_ext';
$route['cash_to_check_op'] 											    = 'Cont_Cashier_Sm/cash_to_check_op';
$route['cash_to_check_xt'] 											    = 'Cont_Cashier_Sm/cash_to_check_xt';

$route['edit_ret_check_op'] 											= 'Cont_Cashier_Sm/edit_ret_check_op';

$route['pay_to_ret_op'] 											    = 'Cont_Cashier_Sm/pay_to_ret_op';
$route['payment_to_return_op'] 											= 'Cont_Cashier_Sm/payment_to_return_op';

$route['ret_to_pay_op'] 											    = 'Cont_Cashier_Sm/ret_to_pay_op';
$route['return_to_payment_op'] 											= 'Cont_Cashier_Sm/return_to_payment_op';

$route['get_customer2'] 												= 'Cont_Cashier_Sm/get_customer2';
$route['get_customer3'] 												= 'Cont_Cashier_Sm/get_customer3';
$route['get_customer4'] 												= 'Cont_Cashier_Sm/get_customer4';
$route['get_customer5'] 												= 'Cont_Cashier_Sm/get_customer5';
$route['edit_sm_payment'] 												= 'Cont_Cashier_Sm/edit_sm_payment';
$route['edit_sm_payment_ldi'] 											= 'Cont_Cashier_Sm/edit_sm_payment_ldi';
$route['edit_sm_payment_ext'] 											= 'Cont_Cashier_Sm/edit_sm_payment_ext';
$route['edit_sm_pal_ext'] 											    = 'Cont_Cashier_Sm/edit_sm_pal_ext';
$route['edit_sm_denom_op'] 											    = 'Cont_Cashier_Sm/edit_sm_denom_op';
$route['edit_sm_payment_op'] 											= 'Cont_Cashier_Sm/edit_sm_payment_op';
$route['edit_sm_payment_tax_op'] 										= 'Cont_Cashier_Sm/edit_sm_payment_tax_op';
$route['edit_sm_payment_tax_op_minus'] 									= 'Cont_Cashier_Sm/edit_sm_payment_tax_op_minus';
$route['edit_ret_payment_ext'] 											= 'Cont_Cashier_Sm/edit_ret_payment_ext';
$route['edit_ret_payment_op'] 											= 'Cont_Cashier_Sm/edit_ret_payment_op';
$route['cash_to_check_payment_ldi'] 									= 'Cont_Cashier_Sm/cash_to_check_payment_ldi';
$route['cash_to_check_payment_xt'] 									    = 'Cont_Cashier_Sm/cash_to_check_payment_xt';

$route['update_status'] 												= 'Cont_Cashier_Sm/update_status';
$route['check_remarks'] 												= 'Cont_Cashier_Sm/check_remarks';
$route['cashier_remarks'] 												= 'Cont_Cashier_Sm/cashier_remarks';
$route['cashier_remarks2'] 												= 'Cont_Cashier_Sm/cashier_remarks2';

$route['sm_incentives'] 												= 'Cont_Cashier_Sm/sm_incentives';
$route['sm_incentives_edit'] 											= 'Cont_Cashier_Sm/sm_incentives_edit';
$route['save_incentives'] 												= 'Cont_Cashier_Sm/save_incentives';
$route['save_remarks'] 													= 'Cont_Cashier_Sm/save_remarks';
$route['save_remarks2'] 												= 'Cont_Cashier_Sm/save_remarks2';
$route['cashier_remittance'] 											= 'Cont_Cashier_Sm/cashier_remittance';
$route['save_remittance'] 												= 'Cont_Cashier_Sm/save_remittance';
$route['accountdate'] 													= 'Cont_Cashier_Sm/accountdate';
$route['accountreport/(:any)'] 											= 'Cont_Cashier_Sm/accountreport/$1';
$route['accountrecorddate'] 											= 'Cont_Cashier_Sm/accountrecorddate';
$route['accountrecord/(:any)'] 											= 'Cont_Cashier_Sm/accountrecord/$1';
$route['edit_salesman'] 												= 'Cont_Cashier_Sm/edit_salesman';
$route['save_salesman'] 												= 'Cont_Cashier_Sm/save_salesman';
$route['cus_tag'] 														= 'Cont_Cashier_Sm/cus_tag';

$route['printdenom/(:any)'] 											= 'Cont_Cashier_Sm/printdenom/$1';
$route['printdenomldi/(:any)'] 											= 'Cont_Cashier_Sm/printdenomldi/$1';
$route['printalldenom/(:any)'] 											= 'Cont_Cashier_Sm/printalldenom/$1';
$route['printalldenom_LDI/(:any)/(:any)'] 								= 'Cont_Cashier_Sm/printalldenom_LDI/$1/$2';
$route['printalldenom_LDI_cashier/(:any)'] 								= 'Cont_Cashier_Sm/printalldenom_LDI_cashier/$1';
$route['printallpalawan_LDI_per_Date/(:any)/(:any)/(:any)'] 			= 'Cont_Cashier_Sm/printallpalawan_LDI_per_Date/$1/$2/$3';
$route['printalldenom_LDI_per_Date/(:any)/(:any)'] 						= 'Cont_Cashier_Sm/printalldenom_LDI_per_Date/$1/$2';
$route['printalldenom_LDI_per_Date_Excel/(:any)/(:any)'] 				= 'Cont_Cashier_Sm/printalldenom_LDI_per_Date_Excel/$1/$2';
$route['printalldenom_uwdg/(:any)/(:any)'] 								= 'Cont_Cashier_Sm/printalldenom_uwdg/$1/$2';

$route['custagging'] 													= 'Cont_Cashier_Sm/custagging';
$route['pdcdcdate'] 													= 'Cont_Cashier_Sm/pdcdcdate';
$route['retpdcdcreport'] 							                    = 'Cont_Cashier_Sm/retpdcdcreport';
$route['pdcdcreport/(:any)/(:any)/(:any)'] 								= 'Cont_Cashier_Sm/pdcdcreport/$1/$2/$3';
$route['pdcdcreport2/(:any)/(:any)/(:any)'] 							= 'Cont_Cashier_Sm/pdcdcreport2/$1/$2/$3';
$route['pdcdcreport_uwdg/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'Cont_Cashier_Sm/pdcdcreport_uwdg/$1/$2/$3/$4/$5/$6';
$route['pdcdcreport2_uwdg/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] 	= 'Cont_Cashier_Sm/pdcdcreport2_uwdg/$1/$2/$3/$4/$5/$6';
$route['upload_payments'] 												= 'Cont_Cashier_Sm/upload_payments';
$route['upload_payments_inputted'] 										= 'Cont_Cashier_Sm/upload_payments_inputted';
$route['upload_payments_xtruck'] 										= 'Cont_Cashier_Sm/upload_payments_xtruck';
$route['upload_payments_xtruck_udc'] 									= 'Cont_Cashier_Sm/upload_payments_xtruck_udc';
$route['upload_payments_xtruck_big'] 									= 'Cont_Cashier_Sm/upload_payments_xtruck_big';
$route['colsum'] 														= 'Cont_Cashier_Sm/colsum';
$route['colsumdual'] 													= 'Cont_Cashier_Sm/colsumdual';
$route['dvsrrsum'] 														= 'Cont_Cashier_Sm/dvsrrsum';
$route['colsumdaterange'] 												= 'Cont_Cashier_Sm/colsumdaterange';
$route['palawandaterange'] 												= 'Cont_Cashier_Sm/palawandaterange';
$route['retdaterange'] 												    = 'Cont_Cashier_Sm/retdaterange';
$route['colsumreportop/(:any)/(:any)/(:any)/(:any)'] 					= 'Cont_Cashier_Sm/colsumreportop/$1/$2/$3/$4';
$route['colsumreportopexcel/(:any)/(:any)/(:any)/(:any)'] 				= 'Cont_Cashier_Sm/colsumreportopexcel/$1/$2/$3/$4';
$route['colsumreportmpdi/(:any)/(:any)/(:any)/(:any)'] 					= 'Cont_Cashier_Sm/colsumreportmpdi/$1/$2/$3/$4';
$route['colsumreportxt/(:any)/(:any)/(:any)/(:any)'] 					= 'Cont_Cashier_Sm/colsumreportxt/$1/$2/$3/$4';


$route['export'] 														= 'Cont_Export/index';
$route['export_file'] 													= 'Cont_Export/export_file';
$route['export_file2'] 													= 'Cont_Export/export_file2';
$route['import'] 														= 'Cont_Export/import';
$route['import_file'] 													= 'Cont_Export/import_file';
$route['importldi'] 													= 'Cont_Export/importldi';
$route['importldi_sm'] 													= 'Cont_Cashier_Sm/importldi_sm';
$route['importldi_file'] 												= 'Cont_Export/importldi_file_test';
$route['importldireturn_file'] 											= 'Cont_Export/importldireturn_file_test';
$route['importldixtruck_file'] 											= 'Cont_Export/importldixtruck_file_test';
$route['importldixtrucksat_file'] 										= 'Cont_Export/importldixtrucksat_file_test';
$route['importldixtruckbo_file'] 										= 'Cont_Export/importldixtruckbo_file_test';
$route['importldixtrucksminc_file'] 									= 'Cont_Export/importldixtrucksminc_file_test';
$route['importldibo_file'] 									            = 'Cont_Export/importldioplanbo_file_test';

$route['importldipalawan_file'] 									    = 'Cont_Export/importldixtruckpalawan_file_test';
$route['importldiutc_file'] 									        = 'Cont_Export/importldixtruckutc_file_test';
$route['importldipalawanoplan_file'] 									= 'Cont_Export/importldixtruckpalawanoplan_file_test';

$route['exportldi_sm'] 													= 'Cont_Cashier_Sm/exportldi_sm';
$route['exportldi_file'] 												= 'Cont_Export/exportldi_file_test';
$route['exportldiudc_file'] 											= 'Cont_Export/exportldi_file_udc_test';

$route['exportldioverage_file'] 										= 'Cont_Export/exportldioverage_file_test';
$route['exportldioverageudc_file'] 										= 'Cont_Export/exportldioverage_file_udc_test';

$route['exportldiprice_file'] 										    = 'Cont_Export/exportldiprice_file_test';
$route['exportldipriceudc_file'] 										= 'Cont_Export/exportldiprice_file_udc_test';

$route['exportldioplanbo_file'] 										= 'Cont_Export/exportldioplanbo_file_test';
$route['exportldioplanreturn_file'] 									= 'Cont_Export/exportldioplanreturn_file_test';
$route['updateldipayment_file'] 									    = 'Cont_Export/updateldipayment_file_test';

$route['default_controller'] 											= 'Login';
$route['404_override'] 													= '';
$route['translate_uri_dashes'] 											= FALSE;
