<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('dashboard');
// });


Route::get('/', 'home@index');
Route::get('/employee','employee@index')->name('employee_list');
Route::get('/add_employee', 'employee@add_employee')->name('employee_add');
Route::post('/add_employee_action', 'employee@store')->name('employee_add_action');
Route::get('/edit_employee/{id}', 'employee@edit_employee')->name('edit_employee');
Route::get('/view_employee/{id}', 'employee@view_employee')->name('view_employee');
Route::post('/update_employee', 'employee@update')->name('update_employee');
Route::get('/employee_delete/{id}', 'employee@destroy')->name('employee_delete');



Route::get('/company','company@index')->name('company_list');
Route::get('/add_company', 'company@add_company')->name('company_add');
Route::post('/add_company_action', 'company@store')->name('company_add_action');
Route::get('/edit_company/{id}', 'company@edit_company')->name('edit_company');
Route::get('/view_company/{id}', 'company@view_company')->name('view_company');
Route::post('/update_company', 'company@update')->name('update_company');
Route::get('/company_delete/{id}', 'company@destroy')->name('company_delete');


Route::get('/designation','designation@index')->name('designation_list');
Route::get('/add_designation', 'designation@add_designation')->name('designation_add');
Route::post('/add_designation_action', 'designation@store')->name('designation_add_action');
Route::get('/edit_designation/{id}', 'designation@edit_designation')->name('edit_designation');
Route::get('/view_designation/{id}', 'designation@view_designation')->name('view_designation');
Route::post('/update_designation', 'designation@update')->name('update_designation');
Route::get('/designation_delete/{id}', 'designation@destroy')->name('designation_delete');


Route::get('/department','department@index')->name('department_list');
Route::get('/add_department', 'department@add_department')->name('department_add');
Route::post('/add_department_action', 'department@store')->name('department_add_action');
Route::get('/edit_department/{id}', 'department@edit_department')->name('edit_department');
Route::get('/view_department/{id}', 'department@view_department')->name('view_department');
Route::post('/update_department', 'department@update')->name('update_department');
Route::get('/department_delete/{id}', 'department@destroy')->name('department_delete');


Route::get('/bank','bank@index')->name('bank_list');
Route::get('/add_bank', 'bank@add_bank')->name('bank_add');
Route::post('/add_bank_action', 'bank@store')->name('bank_add_action');
Route::get('/edit_bank/{id}', 'bank@edit_bank')->name('edit_bank');
Route::get('/view_bank/{id}', 'bank@view_bank')->name('view_bank');
Route::post('/update_bank', 'bank@update')->name('update_bank');
Route::get('/bank_delete/{id}', 'bank@destroy')->name('bank_delete');


Route::get('/shift','shift@index')->name('shift_list');
Route::get('/add_shift', 'shift@add_shift')->name('shift_add');
Route::post('/add_shift_action', 'shift@store')->name('shift_add_action');
Route::get('/edit_shift/{id}', 'shift@edit_shift')->name('edit_shift');
Route::get('/view_shift/{id}', 'shift@view_shift')->name('view_shift');
Route::post('/update_shift', 'shift@update')->name('update_shift');
Route::get('/shift_delete/{id}', 'shift@destroy')->name('shift_delete');


Route::get('/leave','leavetype@index')->name('leave_list');
Route::get('/add_leave', 'leavetype@add_leave')->name('leave_add');
Route::post('/add_leave_action', 'leavetype@store')->name('leave_add_action');
Route::get('/edit_leave/{id}', 'leavetype@edit_leave')->name('edit_leave');
Route::get('/view_leave/{id}', 'leavetype@view_leave')->name('view_leave');
Route::post('/update_leave', 'leavetype@update')->name('update_leave');
Route::get('/leave_delete/{id}', 'leavetype@destroy')->name('leave_delete');

Route::get('/full_leave','full_leaves@index')->name('full_leave_list');
Route::get('/add_full_leave', 'full_leaves@add_full_leave')->name('full_leave_add');
Route::post('/add_full_leave_action', 'full_leaves@store')->name('full_leave_add_action');
Route::get('/edit_full_leave/{id}', 'full_leaves@edit_full_leave')->name('edit_full_leave');
Route::get('/view_full_leave/{id}', 'full_leaves@view_full_leave')->name('view_full_leave');
Route::post('/update_full_leave', 'full_leaves@update')->name('update_full_leave');
Route::get('/full_leave_delete/{id}', 'full_leaves@destroy')->name('full_leave_delete');

Route::post('/total_leave_working_days', 'full_leaves@total_leave_working_days')->name('total_leave_working_days');
Route::get('/holiday-count/{from}/{to}/{emId}', 'full_leaves@holidayCount')->name('holidayCount');


Route::get('full-calender', [FullCalenderController::class, 'index'])->name('show_calander');

Route::post('full-calender/action', [FullCalenderController::class, 'action'])->name('action_calander');





