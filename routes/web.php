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

Route::get('/view-user', [App\Http\Controllers\UsermanagementController::class, 'viewUser'])->name('view-user');
Route::get('/add-user', [App\Http\Controllers\UsermanagementController::class, 'addUser'])->name('add-user');
Route::get('/submit_user', [App\Http\Controllers\UsermanagementController::class, 'registerUser'])->name('submit_user');
Route::get('/deleteuser/{id}', [App\Http\Controllers\UsermanagementController::class, 'deleteuser'])->name('deleteuser');
Route::get('/edit-user/{id}', [App\Http\Controllers\UsermanagementController::class, 'edituser'])->name('edit-user');
Route::get('/update-user/{id}', [App\Http\Controllers\UsermanagementController::class, 'updateuser'])->name('update-user');


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
Route::resource('/nationality', NationalityController::class); 



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



Route::get('/add-info-tab', [App\Http\Controllers\MyinfoController::class, 'addinfotab'])->name('add-info-tab');






