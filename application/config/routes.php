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
//access routs
$route['default_controller'] = 'access';
//$route['default_controller'] = 'user';
$route['login'] = 'access';
$route['admin-login'] = 'access/user_access';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//user routs
$route['new-user'] = 'admin/new_user';
$route['add-user'] = 'admin/add_user';
$route['user-list'] = 'admin/user_list';
$route['activate-user/(:any)'] = 'admin/activate_user_id/$1';
$route['deactivate-user/(:any)'] = 'admin/deactivate_user_id/$1';
$route['reset-user/(:any)'] = 'admin/re_set_user/$1';
$route['update-user/(:any)'] = 'admin/update_user_id/$1';
$route['reset-password/(:any)'] = 'admin/re_set_password/$1';
$route['update-password/(:any)'] = 'admin/update_user_password/$1';

//menu setup
$route['menu-setup'] = 'admin/menu_list';
$route['add-menu'] = 'admin/save_menu';
$route['edit-menu/(:any)'] = 'admin/edit_menu/$1';
$route['update-menu/(:any)'] = 'admin/update_menu/$1';



////////////////Master Data Setup////////////////////////////
//department setup
$route['department-setup'] = 'admin/department_list';
$route['add-department'] = 'admin/save_department';
$route['edit-department/(:any)'] = 'admin/edit_department/$1';
$route['update-department/(:any)'] = 'admin/update_department/$1';

//chief complaint setup
$route['chief-complaint-setup'] = 'admin/chief_complaint_list';
$route['add-chief-complaint'] = 'admin/save_chief_complaint';
$route['edit-chief-complaint/(:any)'] = 'admin/edit_chief_complaint/$1';
$route['update-chief-complaint/(:any)'] = 'admin/update_chief_complaint/$1';

//examination setup
$route['examination-setup'] = 'admin/examination_list';
$route['add-examination'] = 'admin/save_examination';
$route['edit-examination/(:any)'] = 'admin/edit_examination/$1';
$route['update-examination/(:any)'] = 'admin/update_examination/$1';

//history setup
$route['history-setup'] = 'admin/history_list';
$route['add-history'] = 'admin/save_history';
$route['edit-history/(:any)'] = 'admin/edit_history/$1';
$route['update-history/(:any)'] = 'admin/update_history/$1';

//diagnosis setup
$route['diagnosis-setup'] = 'admin/diagnosis_list';
$route['add-diagnosis'] = 'admin/save_diagnosis';
$route['edit-diagnosis/(:any)'] = 'admin/edit_diagnosis/$1';
$route['update-diagnosis/(:any)'] = 'admin/update_diagnosis/$1';

//investigation type setup
$route['investigation-type-setup'] = 'admin/investigation_type_list';
$route['add-investigation-type'] = 'admin/save_investigation_type';
$route['edit-investigation-type/(:any)'] = 'admin/edit_investigation_type/$1';
$route['update-investigation-type/(:any)'] = 'admin/update_investigation_type/$1';

//investigation setup
$route['investigation-setup'] = 'admin/investigation_list';
$route['add-investigation'] = 'admin/save_investigation';
$route['edit-investigation/(:any)'] = 'admin/edit_investigation/$1';
$route['update-investigation/(:any)'] = 'admin/update_investigation/$1';

//health advice setup
$route['health-advice-setup'] = 'admin/health_advice_list';
$route['add-health-advice'] = 'admin/save_health_advice';
$route['edit-health-advice/(:any)'] = 'admin/edit_health_advice/$1';
$route['update-health-advice/(:any)'] = 'admin/update_health_advice/$1';

//special note setup
$route['special-note-setup'] = 'admin/special_note_list';
$route['add-special-note'] = 'admin/save_special_note';
$route['edit-special-note/(:any)'] = 'admin/edit_special_note/$1';
$route['update-special-note/(:any)'] = 'admin/update_special_note/$1';

//refer setup
$route['refer-setup'] = 'admin/refer_list';
$route['add-refer'] = 'admin/save_refer';
$route['edit-refer/(:any)'] = 'admin/edit_refer/$1';
$route['update-refer/(:any)'] = 'admin/update_refer/$1';

//doses administration setup
$route['doses-administration-setup'] = 'admin/doses_administration_list';
$route['add-doses-administration'] = 'admin/save_doses_administration';
$route['edit-doses-administration/(:any)'] = 'admin/edit_doses_administration/$1';
$route['update-doses-administration/(:any)'] = 'admin/update_doses_administration/$1';

//doses duration setup
$route['doses-duration-setup'] = 'admin/doses_duration_list';
$route['add-doses-duration'] = 'admin/save_doses_duration';
$route['edit-doses-duration/(:any)'] = 'admin/edit_doses_duration/$1';
$route['update-doses-duration/(:any)'] = 'admin/update_doses_duration/$1';

//meal administration setup
$route['meal-administration-setup'] = 'admin/meal_administration_list';
$route['add-meal-administration'] = 'admin/save_meal_administration';
$route['edit-meal-administration/(:any)'] = 'admin/edit_meal_administration/$1';
$route['update-meal-administration/(:any)'] = 'admin/update_meal_administration/$1';


////////////////Master Data Setup////////////////////////////

////////////////Pharmacy Setup////////////////////////////
//manufacturer
$route['new-manufacturer'] = 'admin/manufacturer_entry_form';
$route['save-manufacturer'] = 'admin/save_manufacturer';
$route['manufacturer-list'] = 'admin/manufacturer_list';
$route['edit-manufacturer/(:any)'] = 'admin/edit_manufacturer/$1';
$route['update-manufacturer/(:any)'] = 'admin/update_manufacturer/$1';

//Medicine Type/Dosage
$route['medicine-type'] = 'admin/medicine_type_list';
$route['add-medicine-type'] = 'admin/save_medicine_type';
$route['edit-medicine-type/(:any)'] = 'admin/edit_medicine_type/$1';
$route['update-medicine-type/(:any)'] = 'admin/update_medicine_type/$1';

//Medicine Generic
$route['medicine-generic'] = 'admin/medicine_generic_list';
$route['add-medicine-generic'] = 'admin/save_medicine_generic';
$route['edit-medicine-generic/(:any)'] = 'admin/edit_medicine_generic/$1';
$route['update-medicine-generic/(:any)'] = 'admin/update_medicine_generic/$1';

//Medicine Generic
$route['medicine-generic'] = 'admin/medicine_generic_list';
$route['add-medicine-generic'] = 'admin/save_medicine_generic';
$route['edit-medicine-generic/(:any)'] = 'admin/edit_medicine_generic/$1';
$route['update-medicine-generic/(:any)'] = 'admin/update_medicine_generic/$1';

//medicine setup
$route['medicine-setup'] = 'admin/medicine_list';
$route['add-medicine'] = 'admin/save_medicine';
$route['edit-medicine/(:any)'] = 'admin/edit_medicine/$1';
$route['update-medicine/(:any)'] = 'admin/update_medicine/$1';
////////////////Pharmacy Setup////////////////////////////

////////////////Transaction////////////////////////////
//patient registration
$route['patient-registration'] = 'admin/new_patient';
$route['add-patient'] = 'admin/save_patient';
$route['edit-patient/(:any)'] = 'admin/edit_patient/$1';
$route['update-patient/(:any)'] = 'admin/update_patient/$1';

//patient appointment
$route['patient-appointment'] = 'admin/new_appointment';
$route['add-appointment'] = 'admin/save_appointment';
$route['appointment-entry/(:any)'] = 'admin/appointment_entry_form/$1';
$route['appointment-list'] = 'admin/appointment_list';
$route['patient-appointment-search'] = 'admin/appointment_search';
$route['get-patient'] = 'admin/get_patient_list';

$route['direct-appointment'] = 'admin/direct_appointment_entry';
$route['shift-doctor'] = 'admin/shift_doctor_list';
$route['app-shift-doctor'] = 'admin/app_shift_doctor_list';
$route['doctor-app-list'] = 'admin/doctor_app_list';
$route['add-direct-appointment'] = 'admin/save_direct_appointment';
$route['edit-appointment/(:any)'] = 'admin/edit_direct_appointment/$1';
$route['update-direct-appointment/(:any)'] = 'admin/update_direct_appointment/$1';
$route['delete-appointment/(:any)'] = 'admin/delete_direct_appointment/$1';



$route['patient-vital-entry/(:any)'] = 'admin/patient_vital_entry_form/$1';
$route['add-patient-vital/(:any)'] = 'admin/save_patient_vital/$1';
$route['update-patient-vital/(:any)'] = 'admin/update_patient_vital/$1';



$route['prescription-list'] = 'admin/prescription_list';
$route['view-prescription/(:any)'] = 'admin/view_prescription/$1';
$route['print-prescription/(:any)'] = 'admin/print_prescription/$1';
$route['prescription-files/(:any)'] = 'admin/prescription_files/$1';
$route['add-prescription-file/(:any)'] = 'admin/save_prescription_file/$1';
$route['download/(:any)'] = 'admin/download_prescription_file/$1';
////////////////Transaction////////////////////////////

////////////////Report////////////////////////////
$route['report-list'] = 'admin/report_list';
$route['view-report'] = 'admin/view_report';
$route['consultant-patient-report/(:any)/(:any)'] = 'admin/consultant_patient/$1/$2';
$route['consultant-summary-report/(:any)/(:any)'] = 'admin/consultant_patient_summary/$1/$2';
$route['consultant-investigation-report/(:any)/(:any)'] = 'admin/consultant_investigation/$1/$2';
$route['patient-investigation-report/(:any)/(:any)'] = 'admin/patient_investigation/$1/$2';
$route['patient-list-report/(:any)/(:any)'] = 'admin/datewise_patient_list/$1/$2';
$route['patient-type-report/(:any)/(:any)'] = 'admin/datewise_patient_type/$1/$2';

////////////////Report////////////////////////////


//doctor setup
$route['new-doctor'] = 'admin/new_doctor';
$route['save-doctor'] = 'admin/save_doctor';
$route['doctor-list'] = 'admin/doctor_list';
$route['edit-doctor/(:any)'] = 'admin/edit_doctor/$1';
$route['update-doctor/(:any)'] = 'admin/update_doctor/$1';
$route['deactivate-doctor/(:any)'] = 'admin/deactivate_doctor_id/$1';
$route['activate-doctor/(:any)'] = 'admin/activate_doctor_id/$1';
$route['reset-doctor-password/(:any)'] = 'admin/reset_doctor_password/$1';
$route['update-doctor-password'] = 'admin/update_doctor_password';

//template setup
$route['new-template'] = 'admin/new_template';
$route['save-template'] = 'admin/save_template';
$route['template-list'] = 'admin/template_list';
$route['doctorwise-template-list'] = 'admin/doctorwise_template_list';
$route['template-detail/(:any)'] = 'admin/template_detail/$1';
$route['update-template/(:any)'] = 'admin/update_template/$1';
// $route['deactivate-template/(:any)'] = 'admin/deactivate_template_id/$1';
// $route['activate-template/(:any)'] = 'admin/activate_template_id/$1';
// $route['reset-template-password/(:any)'] = 'admin/reset_template_password/$1';
// $route['update-template-password'] = 'admin/update_template_password';

$route['new-doctor-template'] = 'doctor/new_doctor_template';
 $route['save-doctor-template'] = 'doctor/save_doctor_template';
 $route['doctor-template-list'] = 'doctor/doctor_template_list';
 $route['doctor-template-detail/(:any)'] = 'doctor/doctor_template_detail/$1';
 $route['update-doctor-template/(:any)'] = 'doctor/update_doctor_template/$1';

//doctor
$route['sign-out'] = 'doctor/doctor_log_out';
$route['doctor-password/(:any)'] = 'doctor/doctor_password/$1';
$route['update-doctor-password/(:any)'] = 'doctor/update_doctor_password/$1';
$route['doctor-appointment-list'] = 'doctor/doctor_appointment_list';
$route['prescription-entry/(:any)'] = 'doctor/doctor_prescription_entry/$1';
$route['add-prescription-entry/(:any)'] = 'doctor/save_prescription_entry/$1';
$route['patient-prescription/(:any)'] = 'doctor/view_patient_prescription/$1';
$route['doctor-prescription-list'] = 'doctor/doctor_prescription_list';
$route['edit-prescription/(:any)'] = 'doctor/edit_prescription/$1';
$route['update-prescription/(:any)'] = 'doctor/update_prescription/$1';
$route['get-prescription-template'] = 'doctor/get_prescription_template';

$route['home'] = 'user';
$route['patient-login'] = 'user/patient_access';
$route['patient-otp/(:any)'] = 'user/patient_otp_entry/$1';
$route['patient-otp-login/(:any)'] = 'user/patient_otp_signin/$1';
$route['patient-logout'] = 'patient/patient_log_out';

//shift setup
$route['shift-setup'] = 'admin/shift_list';
$route['add-shift'] = 'admin/save_shift';
$route['edit-shift/(:any)'] = 'admin/edit_shift/$1';
$route['update-shift/(:any)'] = 'admin/update_shift/$1';

//schedules setup
$route['schedule-setup'] = 'admin/schedule_list';
$route['get-doctor'] = 'admin/get_doctor_list';
$route['get-doctor-schedule'] = 'admin/get_doctor_schedule';
$route['add-schedule'] = 'admin/save_schedule';
$route['edit-schedule/(:any)'] = 'admin/edit_schedule/$1';
$route['update-schedule/(:any)'] = 'admin/update_schedule/$1';
//$route['shift-schedule'] = 'user/schedule_doctor_list';
//$route['schedule-day'] = 'user/schedule_day_list';


