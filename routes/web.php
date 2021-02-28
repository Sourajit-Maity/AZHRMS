<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dasboard');

Route::get('/view-user', [App\Http\Controllers\UsermanagementController::class, 'viewUser'])->middleware('can:isSuperAdmin')->name('view-user');
Route::get('/add-user', [App\Http\Controllers\UsermanagementController::class, 'addUser'])->name('add-user');
Route::get('/submit_user', [App\Http\Controllers\UsermanagementController::class, 'registerUser'])->name('submit_user');
Route::get('/deleteuser/{id}', [App\Http\Controllers\UsermanagementController::class, 'deleteuser'])->name('deleteuser');
Route::get('/edit-user/{id}', [App\Http\Controllers\UsermanagementController::class, 'edituser'])->name('edit-user');
Route::get('/update-user/{id}', [App\Http\Controllers\UsermanagementController::class, 'updateuser'])->name('update-user');
Route::post('update-pass/{id}', [App\Http\Controllers\UsermanagementController::class,'updatePass'])->name('update-pass');

Route::get('/view-role', [App\Http\Controllers\RoleController::class, 'viewrole'])->name('view-role');
Route::get('/add-role', [App\Http\Controllers\RoleController::class, 'addRole'])->name('add-role');
Route::get('/submit_new_role', [App\Http\Controllers\RoleController::class, 'registerRole'])->name('submit_new_role');
Route::get('/deleterole/{id}', [App\Http\Controllers\RoleController::class, 'deleterole'])->name('deleterole');
Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class, 'editRole'])->name('edit-role');
Route::get('/update-role/{id}', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update-role');


Route::get('/view-sub-role', [App\Http\Controllers\SubroleController::class, 'viewsubrole'])->name('view-sub-role');
Route::get('/add-sub-role', [App\Http\Controllers\SubroleController::class, 'addsubrole'])->name('add-sub-role');
Route::get('/submit_role', [App\Http\Controllers\SubroleController::class, 'submitrole'])->name('submit_role');
Route::get('/deletesubrole/{id}', [App\Http\Controllers\SubroleController::class, 'deletesubrole'])->name('deletesubrole');
Route::get('/edit-sub-role/{id}', [App\Http\Controllers\SubroleController::class, 'editsubRole'])->name('edit-sub-role');
Route::get('/update-sub-role/{id}', [App\Http\Controllers\SubroleController::class, 'updatesubrole'])->name('update-sub-role');


Route::resource('/configurations', ConfigurationController::class); 

Route::get('/all-nationality', [App\Http\Controllers\NationalityController::class, 'viewnationality'])->name('all-nationality');
Route::get('/add-nationality', [App\Http\Controllers\NationalityController::class, 'addNationality'])->name('add-nationality');
Route::get('/submit_new_nationality', [App\Http\Controllers\NationalityController::class, 'registerNationality'])->name('submit_new_nationality');
Route::get('/deletenationality/{id}', [App\Http\Controllers\NationalityController::class, 'deletenationality'])->name('deletenationality');
Route::get('/edit-Nationality/{id}', [App\Http\Controllers\NationalityController::class, 'editNationality'])->name('edit-Nationality');
Route::get('/update-Nationality/{id}', [App\Http\Controllers\NationalityController::class, 'updateNationality'])->name('update-Nationality');

Route::get('/all-religion', [App\Http\Controllers\ReligionController::class, 'viewallReligion'])->name('all-religion');
Route::get('/add-religion', [App\Http\Controllers\ReligionController::class, 'addReligion'])->name('add-religion');
Route::get('/submit_new_religion', [App\Http\Controllers\ReligionController::class, 'registerReligion'])->name('submit_new_religion');
Route::get('/deletereligion/{id}', [App\Http\Controllers\ReligionController::class, 'deletereligion'])->name('deletereligion');
Route::get('/edit-Religion/{id}', [App\Http\Controllers\ReligionController::class, 'editReligion'])->name('edit-Religion');
Route::get('/update-Religion/{id}', [App\Http\Controllers\ReligionController::class, 'updateReligion'])->name('update-Religion');


Route::get('/add-leave-period', [App\Http\Controllers\ConfigureController::class, 'addleaveperiod'])->name('add-leave-period');
Route::get('/submit_leave_period', [App\Http\Controllers\ConfigureController::class, 'submitleaveperiod'])->name('submit_leave_period');
Route::get('/view-leave-period', [App\Http\Controllers\ConfigureController::class, 'viewleaveperiod'])->name('view-leave-period');
Route::get('/leave-period/{id}', [App\Http\Controllers\ConfigureController::class, 'editleaveperiod'])->name('leave-period');
Route::get('/submit_leave/{id}', [App\Http\Controllers\ConfigureController::class, 'submitLeave'])->name('submit_leave');
Route::get('/view-leave-type', [App\Http\Controllers\ConfigureController::class, 'viewleavetype'])->name('view-leave-type');
Route::get('/add-leave-type', [App\Http\Controllers\ConfigureController::class, 'addleavetype'])->name('add-leave-type');
Route::get('/submit_leave_type', [App\Http\Controllers\ConfigureController::class, 'submitleavetype'])->name('submit_leave_type');
Route::get('/deleteleavetype/{id}', [App\Http\Controllers\ConfigureController::class, 'deleteleavetype'])->name('deleteleavetype');
Route::get('/edit-leave-type/{id}', [App\Http\Controllers\ConfigureController::class, 'editleavetype'])->name('edit-leave-type');
Route::get('/update-leave-type/{id}', [App\Http\Controllers\ConfigureController::class, 'updateleavetype'])->name('update-leave-type');
Route::get('/view-work-week', [App\Http\Controllers\ConfigureController::class, 'viewworkweek'])->name('view-work-week');
Route::get('/edit-work-week/{id}', [App\Http\Controllers\ConfigureController::class, 'editworkweek'])->name('edit-work-week');
Route::get('/update-work-week/{id}', [App\Http\Controllers\ConfigureController::class, 'updateworkweek'])->name('update-work-week');


Route::get('/view-holiday', [App\Http\Controllers\ConfigureController::class, 'viewholiday'])->name('view-holiday');
Route::get('/add-holiday', [App\Http\Controllers\ConfigureController::class, 'addholiday'])->name('add-holiday');
Route::get('/submit_holiday', [App\Http\Controllers\ConfigureController::class, 'submitholiday'])->name('submit_holiday');
Route::get('/deleteholiday/{id}', [App\Http\Controllers\ConfigureController::class, 'deleteholiday'])->name('deleteholiday');
Route::get('/edit-holiday/{id}', [App\Http\Controllers\ConfigureController::class, 'editholiday'])->name('edit-holiday');
Route::get('/update-holiday/{id}', [App\Http\Controllers\ConfigureController::class, 'updateholiday'])->name('update-holiday');



Route::get('/view-my-leave-entitlement', [App\Http\Controllers\EntitlementController::class, 'viewmyleaveentitlement'])->name('view-my-leave-entitlement');
Route::get('/view-leave-entitlement', [App\Http\Controllers\EntitlementController::class, 'viewleaveentitlement'])->name('view-leave-entitlement');
Route::get('/add-leave-entitlement', [App\Http\Controllers\EntitlementController::class, 'addleaveentitlement'])->name('add-leave-entitlement');
Route::get('/submit_leave_entitlement', [App\Http\Controllers\EntitlementController::class, 'submitleaveentitlement'])->name('submit_leave_entitlement');
Route::get('/deleteleaveentitlement/{id}', [App\Http\Controllers\EntitlementController::class, 'deleteleaveentitlement'])->name('deleteleaveentitlement');
Route::get('/edit-leave-entitlement/{id}', [App\Http\Controllers\EntitlementController::class, 'editleaveentitlement'])->name('edit-leave-entitlement');
Route::get('/update-leave-entitlement/{id}', [App\Http\Controllers\EntitlementController::class, 'updateleaveentitlement'])->name('update-leave-entitlement');



Route::get('/view-employee', [App\Http\Controllers\EmployeeController::class, 'viewemployee'])->name('view-employee');
Route::get('/add-employee', [App\Http\Controllers\EmployeeController::class, 'addemployee'])->name('add-employee');
Route::post('/submit_employee', [App\Http\Controllers\EmployeeController::class, 'submitemployee'])->name('submit_employee.post');
Route::get('/deleteemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'deleteemployee'])->name('deleteemployee');
Route::get('/edit-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployee'])->name('edit-employee');
Route::post('/update-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployee'])->name('update-employee');

Route::get('/addemployeetab', [App\Http\Controllers\EmployeeController::class, 'addemployeetab'])->name('addemployeetab');
Route::get('/edit-employeetab/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeetab'])->name('edit-employeetab');

Route::get('/add-employee/getrole/{id}', [App\Http\Controllers\EmployeeController::class, 'getrole']);
Route::get('/add-employee/getlocation/{id}', [App\Http\Controllers\EmployeeController::class, 'getlocation']);
Route::get('/getlocation/getunit/{id}', [App\Http\Controllers\EmployeeController::class, 'getunit']);

Route::get('/edit-employee/getldlocation/{ld_id}', [App\Http\Controllers\EmployeeController::class, 'getldlocation']);
Route::get('/getldlocation/getldunit/{ld_id}', [App\Http\Controllers\EmployeeController::class, 'getldunit']);

Route::get('/details-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'detailsemployee'])->name('details-employee');;


Route::get('/view-company', [App\Http\Controllers\CompanyGenInfoController::class, 'viewcompany'])->name('view-company');
Route::get('/add-company', [App\Http\Controllers\CompanyGenInfoController::class, 'addcompany'])->name('add-company');
Route::get('/submit_company', [App\Http\Controllers\CompanyGenInfoController::class, 'submitcompany'])->name('submit_company');
Route::get('/deletecompany/{id}', [App\Http\Controllers\CompanyGenInfoController::class, 'deletecompany'])->name('deletecompany');
Route::get('/edit-company/{id}', [App\Http\Controllers\CompanyGenInfoController::class, 'editcompany'])->name('edit-company');
Route::get('/update-company/{id}', [App\Http\Controllers\CompanyGenInfoController::class, 'updatecompany'])->name('update-company');
 
Route::get('/view-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'viewlocation'])->name('view-location');

Route::get('/view-company-location', [App\Http\Controllers\CompanyLocationController::class, 'viewcompanylocation'])->name('view-company-location');
Route::get('/add-company-location', [App\Http\Controllers\CompanyLocationController::class, 'addcompanylocation'])->name('add-company-location');
Route::get('/submit_company_location', [App\Http\Controllers\CompanyLocationController::class, 'submitcompanylocation'])->name('submit_company_location');
Route::get('/deletecompany-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'deletecompanylocation'])->name('deletecompany-location');
Route::get('/edit-company-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'editcompanylocation'])->name('edit-company-location');
Route::get('/update-company-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'updatecompanylocation'])->name('update-company-location');
 

Route::get('/view-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'viewlocationsubunit'])->name('view-location-subunit');

Route::get('/view-company-location-subunit', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'viewcompanylocationsubunit'])->name('view-company-location-subunit');
Route::get('/add-company-location-subunit', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'addcompanylocationsubunit'])->name('add-company-location-subunit');
Route::get('/submit_company_location_subunit', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'submitcompanylocationsubunit'])->name('submit_company_location_subunit');
Route::get('/deletecompany-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'deletecompanylocationsubunit'])->name('deletecompany-location-subunit');
Route::get('/edit-company-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'editcompanylocationsubunit'])->name('edit-company-location-subunit');
Route::get('/update-company-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'updatecompanylocationsubunit'])->name('update-company-location-subunit');


Route::get('/add-info-tab', [App\Http\Controllers\MyinfoController::class, 'addinfotab'])->name('add-info-tab');
Route::post('/my-info-tab-update', [App\Http\Controllers\MyinfoController::class, 'updateinfotab'])->name('my-info-tab-update');





Route::get('/view-workshift', [App\Http\Controllers\WorkshiftController::class, 'viewworkshift'])->name('view-workshift');
Route::get('/add-workshift', [App\Http\Controllers\WorkshiftController::class, 'addworkshift'])->name('add-workshift');
Route::get('/submit_workshift', [App\Http\Controllers\WorkshiftController::class, 'submitworkshift'])->name('submit_workshift');
Route::get('/deleteworkshift/{id}', [App\Http\Controllers\WorkshiftController::class, 'deleteworkshift'])->name('deleteworkshift');
Route::get('/edit-workshift/{id}', [App\Http\Controllers\WorkshiftController::class, 'editworkshift'])->name('edit-workshift');
Route::get('/update-workshift/{id}', [App\Http\Controllers\WorkshiftController::class, 'updateworkshift'])->name('update-workshift');
 

Route::get('/view-education', [App\Http\Controllers\QualificationController::class, 'vieweducation'])->name('view-education');
Route::get('/add-education', [App\Http\Controllers\QualificationController::class, 'addeducation'])->name('add-education');
Route::get('/submit_education', [App\Http\Controllers\QualificationController::class, 'submiteducation'])->name('submit_education');
Route::get('/deleteeducation/{id}', [App\Http\Controllers\QualificationController::class, 'deleteeducation'])->name('deleteeducation');
Route::get('/edit-education/{id}', [App\Http\Controllers\QualificationController::class, 'editeducation'])->name('edit-education');
Route::get('/update-education/{id}', [App\Http\Controllers\QualificationController::class, 'updateeducation'])->name('update-education');
 
Route::get('/view-skills', [App\Http\Controllers\QualificationController::class, 'viewskills'])->name('view-skills');
Route::get('/add-skills', [App\Http\Controllers\QualificationController::class, 'addskills'])->name('add-skills');
Route::get('/submit_skills', [App\Http\Controllers\QualificationController::class, 'submitskills'])->name('submit_skills');
Route::get('/deleteskills/{id}', [App\Http\Controllers\QualificationController::class, 'deleteskills'])->name('deleteskills');
Route::get('/edit-skills/{id}', [App\Http\Controllers\QualificationController::class, 'editskills'])->name('edit-skills');
Route::get('/update-skills/{id}', [App\Http\Controllers\QualificationController::class, 'updateskills'])->name('update-skills');
 

Route::get('/view-employee-type', [App\Http\Controllers\EmployeeTypeController::class, 'viewemployeetype'])->name('view-employee-type');
Route::get('/add-employee-type', [App\Http\Controllers\EmployeeTypeController::class, 'addemployeetype'])->name('add-employee-type');
Route::get('/submit_employee_type', [App\Http\Controllers\EmployeeTypeController::class, 'submitemployeetype'])->name('submit_employee_type');
Route::get('/deleteemployeetype/{id}', [App\Http\Controllers\EmployeeTypeController::class, 'deleteemployeetype'])->name('deleteemployeetype');
Route::get('/edit-employee-type/{id}', [App\Http\Controllers\EmployeeTypeController::class, 'editemployeetype'])->name('edit-employee-type');
Route::get('/update-employee-type/{id}', [App\Http\Controllers\EmployeeTypeController::class, 'updateemployeetype'])->name('update-employee-type');
 

Route::get('/home3', [App\Http\Controllers\EmployeeController::class, 'home3'])->name('home3');
Route::post('file-upload', [App\Http\Controllers\EmployeeController::class, 'fileUploadPost' ])->name('file.upload.post');

Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);

Route::get('importExportView', [App\Http\Controllers\ExcelController::class, 'importExportView']);
Route::get('export', [App\Http\Controllers\ExcelController::class, 'export'])->name('export');
Route::post('import', [App\Http\Controllers\ExcelController::class, 'import'])->name('import');


Route::get('/view-language', [App\Http\Controllers\LanguageController::class, 'viewlanguage'])->name('view-language');
Route::get('/add-language', [App\Http\Controllers\LanguageController::class, 'addlanguage'])->name('add-language');
Route::get('/submit_language', [App\Http\Controllers\LanguageController::class, 'submitlanguage'])->name('submit_language');
Route::get('/deletelanguage/{id}', [App\Http\Controllers\LanguageController::class, 'deletelanguage'])->name('deletelanguage');
Route::get('/edit-language/{id}', [App\Http\Controllers\LanguageController::class, 'editlanguage'])->name('edit-language');
Route::get('/update-language/{id}', [App\Http\Controllers\LanguageController::class, 'updatelanguage'])->name('update-language');
 

Route::get('/view-assets', [App\Http\Controllers\AssetsController::class, 'viewassets'])->name('view-assets');
Route::get('/add-assets', [App\Http\Controllers\AssetsController::class, 'addassets'])->name('add-assets');
Route::get('/submit_assets', [App\Http\Controllers\AssetsController::class, 'submitassets'])->name('submit_assets');
Route::get('/deleteassets/{id}', [App\Http\Controllers\AssetsController::class, 'deleteassets'])->name('deleteassets');
Route::get('/edit-assets/{id}', [App\Http\Controllers\AssetsController::class, 'editassets'])->name('edit-assets');
Route::get('/update-assets/{id}', [App\Http\Controllers\AssetsController::class, 'updateassets'])->name('update-assets');
 



Route::post('/update-employee-info/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeinfo'])->name('update-employee-info');
Route::post('/update-employee-address/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeaddress'])->name('update-employee-address');
Route::post('/update-employee-salary/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeesalary'])->name('update-employee-salary');
Route::post('/update-employee-bank/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeebank'])->name('update-employee-bank');
Route::post('/update-employee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeepromotion'])->name('update-employee-promotion');
Route::post('/update-employee-image/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeimage'])->name('update-employee-image');
Route::post('/update-employee-personal/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeepersonal'])->name('update-employee-personal');
Route::post('/update-employee-teaminfo/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeteaminfo'])->name('update-employee-teaminfo');

Route::get('/addemployee-blood-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeblooddoc'])->name('addemployee-blood-doc');
Route::post('/submit_employee_blood_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeblooddoc'])->name('submit_employee_blood_doc');

Route::get('/addemployee-pan-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployepancard'])->name('addemployee-pan-doc');
Route::post('/submit_employee_pan_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeepancard'])->name('submit_employee_pan_doc');

Route::get('/addemployee-image/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeimage'])->name('addemployee-image');
Route::post('/submit_employee_image/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeimage'])->name('submit_employee_image');


Route::get('/addemployee-assets/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeeassets'])->name('addemployee-assets');
Route::post('/submit_employee_assets/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeassets'])->name('submit_employee_assets');
Route::get('/editemployee-assets/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeeassets'])->name('editemployee-assets');
Route::post('/update-employee-assets/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeassets'])->name('update-employee-assets');
Route::get('/deleteemployeeassets/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeeassets'])->name('deleteemployeeassets');


Route::get('/addemployee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeepromotion'])->name('addemployee-promotion');
Route::post('/submit_employee_promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeepromotion'])->name('submit_employee_promotion');
Route::get('/editemployee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeepromotion'])->name('editemployee-promotion');
Route::post('/update-employee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployepromotion'])->name('update-employee-promotion');
Route::get('/deleteemployeepromotion/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeepromotion'])->name('deleteemployeepromotion');




Route::get('/addemployee-skills/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeeskills'])->name('addemployee-skills');
Route::post('/submit_employee_skills/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeskills'])->name('submit_employee_skills');
Route::get('/editemployee-skills/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeeskills'])->name('editemployee-skills');
Route::post('/update-employee-skills/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeskills'])->name('update-employee-skills');
Route::get('/deleteemployeeskills/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeeskills'])->name('deleteemployeeskills');


Route::get('/addemployee-language/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeelanguage'])->name('addemployee-language');
Route::post('/submit_employee_language/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeelanguage'])->name('submit_employee_language');
Route::get('/editemployee-language/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeelanguage'])->name('editemployee-language');
Route::post('/update-employee-language/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeelanguage'])->name('update-employee-language');
Route::get('/deleteemployeelanguage/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeelanguage'])->name('deleteemployeelanguage');

Route::get('/addemployee-education/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeeeducation'])->name('addemployee-education');
Route::post('/submit_employee_education/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeeducation'])->name('submit_employee_education');
Route::get('/editemployee-education/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeeeducation'])->name('editemployee-education');
Route::post('/update-employee-education/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeeducation'])->name('update-employee-education');
Route::get('/deleteemployeeeducation/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeeeducation'])->name('deleteemployeeeducation');


Route::get('/view-state', [App\Http\Controllers\StateController::class, 'viewstate'])->name('view-state');
Route::get('/add-state', [App\Http\Controllers\StateController::class, 'addstate'])->name('add-state');
Route::get('/submit_state', [App\Http\Controllers\StateController::class, 'submitstate'])->name('submit_state');
Route::get('/deletestate/{id}', [App\Http\Controllers\StateController::class, 'deletestate'])->name('deletestate');
Route::get('/edit-state/{id}', [App\Http\Controllers\StateController::class, 'editstate'])->name('edit-state');
Route::get('/update-state/{id}', [App\Http\Controllers\StateController::class, 'updatestate'])->name('update-state');

Route::get('/view-district', [App\Http\Controllers\DistrictController::class, 'viewdistrict'])->name('view-district');
Route::get('/add-district', [App\Http\Controllers\DistrictController::class, 'adddistrict'])->name('add-district');
Route::get('/submit_district', [App\Http\Controllers\DistrictController::class, 'submitdistrict'])->name('submit_district');
Route::get('/deletedistrict/{id}', [App\Http\Controllers\DistrictController::class, 'deletedistrict'])->name('deletedistrict');
Route::get('/edit-district/{id}', [App\Http\Controllers\DistrictController::class, 'editdistrict'])->name('edit-district');
Route::get('/update-district/{id}', [App\Http\Controllers\DistrictController::class, 'updatedistrict'])->name('update-district');

Route::get('/view-country', [App\Http\Controllers\CountryController::class, 'viewcountry'])->name('view-country');
Route::get('/add-country', [App\Http\Controllers\CountryController::class, 'addcountry'])->name('add-country');
Route::get('/submit_country', [App\Http\Controllers\CountryController::class, 'submitcountry'])->name('submit_country');
Route::get('/deletecountry/{id}', [App\Http\Controllers\CountryController::class, 'deletecountry'])->name('deletecountry');
Route::get('/edit-country/{id}', [App\Http\Controllers\CountryController::class, 'editcountry'])->name('edit-country');
Route::get('/update-country/{id}', [App\Http\Controllers\CountryController::class, 'updatecountry'])->name('update-country');



   
Route::get('/leave', [App\Http\Controllers\LeaveController::class, 'index'])->name('leave');
Route::get('/leave/create', [App\Http\Controllers\LeaveController::class, 'create'])->name('leave.create');
Route::post('/leave/store', [App\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');
Route::get('/leave/search', [App\Http\Controllers\LeaveController::class, 'search'])->name('leave.search');
Route::get('/leave/approve/{id}', [App\Http\Controllers\LeaveController::class, 'approve'])->name('leave.approve');
Route::get('/leave/paid/{id}', [App\Http\Controllers\LeaveController::class, 'paid'])->name('leave.paid');


Route::post('/total-leave', [App\Http\Controllers\AllleaveController::class, 'allleave'])->name('total-leave');
Route::get('/view-all-leave', [App\Http\Controllers\AllleaveController::class, 'viewleaves'])->name('view-all-leave');



