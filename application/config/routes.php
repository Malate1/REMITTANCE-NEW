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

$route['api/get_data'] 							= 'Cont_Api/get_data';

$route['crudcreate'] 							= 'crudController/crudcreate';
$route['crudupdate'] 							= 'crudController/crudupdate';
$route['cruddelete'] 							= 'crudController/cruddelete';
$route['crudreset'] 							= 'crudController/crudreset';
$route['checkCurrentPassword'] 					= 'crudController/checkCurrentPassword';
$route['checkUsername'] 						= 'crudController/checkUsername';
$route['changeLocation'] 						= 'crudController/changeLocation';
$route['changeBu'] 								= 'rudController/changeBu';
$route['login_validation'] 						= 'Login/login_validation';
$route['edituser_content'] 						= 'crudController/edituser_content';
$route['adduser_content'] 						= 'crudController/adduser_content';
$route['user_password'] 						= 'crudController/user_password';
$route['user_username'] 						= 'crudController/user_username';
$route['user_location'] 						= 'crudController/user_location';
$route['user_bu'] 								= 'crudController/user_bu';

$route['main'] 									= 'crudController/index';
$route['logout'] 								= 'crudController/logout';
$route['user'] 									= 'crudController/user';

$route['banks'] 								= 'Cont_Bank/index';
$route['addbank_content'] 						= 'Cont_Bank/addbank_content';
$route['editbank_content'] 						= 'Cont_Bank/editbank_content';
$route['insertBank'] 							= 'Cont_Bank/insertBank';
$route['updateBank'] 							= 'Cont_Bank/updateBank';
$route['deleteBank'] 							= 'Cont_Bank/deleteBank';
$route['customers'] 							= 'Cont_Customer/index';
$route['upload_file'] 							= 'Cont_Customer/upload_file';
$route['save_customer'] 						= 'Cont_Customer/save_customer';

$route['smdenom'] 								= 'Cont_Denom/index';
$route['save_denom'] 							= 'Cont_Denom/save_denom';
$route['sm_ledger'] 							= 'Cont_Denom/sm_ledger';
$route['smdenom_edit/(:any)'] 					= 'Cont_Denom/smdenom_edit/$1';
$route['update_denom'] 							= 'Cont_Denom/update_denom';
$route['smdenom_view/(:any)'] 					= 'Cont_Denom/view_denom/$1';
$route['delete_denom'] 							= 'Cont_Denom/delete_denom';
$route['cashierdenom'] 							= 'Cont_Denom/cashierdenom';
$route['save_denom_cashier'] 					= 'Cont_Denom/save_denom_cashier';
$route['cashier_ledger'] 						= 'Cont_Denom/cashier_ledger';
$route['cashierdenom_edit/(:any)'] 				= 'Cont_Denom/cashierdenom_edit/$1';
$route['update_denom_cashier'] 					= 'Cont_Denom/update_denom_cashier';
$route['view_sm_denom'] 						= 'Cont_Denom/view_sm_denom';
$route['view_sm_denom_ldi'] 					= 'Cont_Denom/view_sm_denom_ldi';
$route['view_allsm_denom'] 						= 'Cont_Denom/view_allsm_denom';
$route['view_cashier_denom'] 					= 'Cont_Denom/view_cashier_denom';
$route['get_collection'] 						= 'Cont_Denom/get_collection';

$route['cashpay'] = 'Cont_Payments/index';
$route['get_customer'] = 'Cont_Payments/get_customer';
$route['cashier_payment'] = 'Cont_Payments/cashier_payment';
$route['save_cashier_payment'] = 'Cont_Payments/save_cashier_payment';
$route['cashier_date'] = 'Cont_Payments/cashier_date';
$route['cashpaydata/(:any)'] = 'Cont_Payments/cashier_payment_data/$1';
$route['cashieredit/(:any)'] = 'Cont_Payments/cashierpayment_edit/$1';
$route['edit_cashier_payment'] = 'Cont_Payments/edit_cashier_payment';
$route['delete_payment'] = 'Cont_Payments/delete_payment';
$route['view_cashier_payment'] = 'Cont_Payments/view_cashier_payment';

$route['remitdate'] = 'Cont_Cashier_Sm/index';
$route['checkclearingdate'] = 'Cont_Cashier_Sm/checkclearingdate';
$route['smdenomdata/(:any)'] = 'Cont_Cashier_Sm/cashiersm_payment_data/$1';
$route['checkclearing/(:any)/(:any)'] = 'Cont_Cashier_Sm/checkclearing/$1/$2';
$route['approve_sm_denom'] = 'Cont_Cashier_Sm/approve_sm_denom';
$route['approve_sm_denoms'] = 'Cont_Cashier_Sm/approve_sm_denoms';
$route['disapprove_sm_denom'] = 'Cont_Cashier_Sm/disapprove_sm_denom';
$route['checkentry/(:any)/(:any)/(:any)'] = 'Cont_Cashier_Sm/check_entry_sm/$1/$2/$3';
$route['get_customer1'] = 'Cont_Cashier_Sm/get_customer1';
$route['save_sm_payment'] = 'Cont_Cashier_Sm/save_sm_payment';
$route['viewsmchecks/(:num)/(:any)/(:any)'] = 'Cont_Cashier_Sm/view_sm_checks/$1/$2/$3';
$route['get_accname'] = 'Cont_Cashier_Sm/get_accname';
$route['transfer_customer'] = 'Cont_Cashier_Sm/transfer_customer';
$route['transfer_customer2'] = 'Cont_Cashier_Sm/transfer_customer2';
$route['edit_sm_check'] = 'Cont_Cashier_Sm/edit_sm_check';
$route['get_customer2'] = 'Cont_Cashier_Sm/get_customer2';
$route['get_customer3'] = 'Cont_Cashier_Sm/get_customer3';
$route['get_customer4'] = 'Cont_Cashier_Sm/get_customer4';
$route['edit_sm_payment'] = 'Cont_Cashier_Sm/edit_sm_payment';
$route['update_status'] = 'Cont_Cashier_Sm/update_status';
$route['check_remarks'] = 'Cont_Cashier_Sm/check_remarks';
$route['cashier_backdate'] = 'Cont_Cashier_Sm/cashier_backdate';
$route['cashier_remarks'] = 'Cont_Cashier_Sm/cashier_remarks';
$route['cashier_remarks2'] = 'Cont_Cashier_Sm/cashier_remarks2';
$route['save_remarks'] = 'Cont_Cashier_Sm/save_remarks';
$route['save_backdate'] = 'Cont_Cashier_Sm/save_backdate';
$route['save_remarks2'] = 'Cont_Cashier_Sm/save_remarks2';
$route['cashier_remittance'] = 'Cont_Cashier_Sm/cashier_remittance';
$route['save_remittance'] = 'Cont_Cashier_Sm/save_remittance';
$route['accountdate'] = 'Cont_Cashier_Sm/accountdate';
$route['accountreport/(:any)'] = 'Cont_Cashier_Sm/accountreport/$1';
$route['accountrecorddate'] = 'Cont_Cashier_Sm/accountrecorddate';
$route['accountrecord/(:any)'] = 'Cont_Cashier_Sm/accountrecord/$1';
$route['edit_salesman'] = 'Cont_Cashier_Sm/edit_salesman';
$route['save_salesman'] = 'Cont_Cashier_Sm/save_salesman';
$route['cus_tag'] = 'Cont_Cashier_Sm/cus_tag';

$route['printdenom/(:any)'] 				= 'Cont_Cashier_Sm/printdenom/$1';
$route['printdenomldi/(:any)'] 				= 'Cont_Cashier_Sm/printdenomldi/$1';
$route['printalldenom/(:any)'] 				= 'Cont_Cashier_Sm/printalldenom/$1';
$route['printalldenom_LDI/(:any)/(:any)'] 			= 'Cont_Cashier_Sm/printalldenom_LDI/$1/$2';
$route['printalldenom_LDI_cashier/(:any)'] 	= 'Cont_Cashier_Sm/printalldenom_LDI_cashier/$1';
$route['printalldenom_uwdg/(:any)/(:any)'] 	= 'Cont_Cashier_Sm/printalldenom_uwdg/$1/$2';

$route['custagging'] = 'Cont_Cashier_Sm/custagging';
$route['pdcdcdate'] = 'Cont_Cashier_Sm/pdcdcdate';
$route['pdcdcreport/(:any)/(:any)/(:any)'] = 'Cont_Cashier_Sm/pdcdcreport/$1/$2/$3';
$route['pdcdcreport2/(:any)/(:any)/(:any)'] = 'Cont_Cashier_Sm/pdcdcreport2/$1/$2/$3';
$route['pdcdcreport_uwdg/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Cont_Cashier_Sm/pdcdcreport_uwdg/$1/$2/$3/$4/$5/$6';
$route['pdcdcreport2_uwdg/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Cont_Cashier_Sm/pdcdcreport2_uwdg/$1/$2/$3/$4/$5/$6';
$route['upload_payments'] = 'Cont_Cashier_Sm/upload_payments';
$route['colsum'] = 'Cont_Cashier_Sm/colsum';
$route['colsumreport/(:any)'] = 'Cont_Cashier_Sm/colsumreport/$1';


$route['export'] = 'Cont_Export/index';
$route['export_file'] = 'Cont_Export/export_file';
$route['export_file2'] = 'Cont_Export/export_file2';
$route['import'] = 'Cont_Export/import';
$route['import_file'] = 'Cont_Export/import_file';
$route['importldi'] = 'Cont_Export/importldi';
$route['importldi_sm'] = 'Cont_Cashier_Sm/importldi_sm';
// $route['importldi_file'] = 'Cont_Export/importldi_file';
$route['importldi_file'] = 'Cont_Export/importldi_file_test';
$route['importldireturn_file'] = 'Cont_Export/importldireturn_file_test';

$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
