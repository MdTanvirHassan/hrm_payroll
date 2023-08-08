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


// Employee
Route::get('/', 'home@index');
Route::get('/employee','employee@index')->name('employee_list');
Route::get('/add_employee', 'employee@add_employee')->name('employee_add');
Route::post('/add_employee_action', 'employee@store')->name('employee_add_action');
Route::get('/edit_employee/{id}', 'employee@edit_employee')->name('edit_employee');
Route::get('/view_employee/{id}', 'employee@view_employee')->name('view_employee');
Route::post('/update_employee', 'employee@update')->name('update_employee');
Route::get('/employee_delete/{id}', 'employee@destroy')->name('employee_delete');


// Company
Route::get('/company','company@index')->name('company_list');
Route::get('/add_company', 'company@add_company')->name('company_add');
Route::post('/add_company_action', 'company@store')->name('company_add_action');
Route::get('/edit_company/{id}', 'company@edit_company')->name('edit_company');
Route::get('/view_company/{id}', 'company@view_company')->name('view_company');
Route::post('/update_company', 'company@update')->name('update_company');
Route::get('/company_delete/{id}', 'company@destroy')->name('company_delete');


// Designation
Route::get('/designation','designation@index')->name('designation_list');
Route::get('/add_designation', 'designation@add_designation')->name('designation_add');
Route::post('/add_designation_action', 'designation@store')->name('designation_add_action');
Route::get('/edit_designation/{id}', 'designation@edit_designation')->name('edit_designation');
Route::get('/view_designation/{id}', 'designation@view_designation')->name('view_designation');
Route::post('/update_designation', 'designation@update')->name('update_designation');
Route::get('/designation_delete/{id}', 'designation@destroy')->name('designation_delete');


// Departments
Route::get('/department','department@index')->name('department_list');
Route::get('/add_department', 'department@add_department')->name('department_add');
Route::post('/add_department_action', 'department@store')->name('department_add_action');
Route::get('/edit_department/{id}', 'department@edit_department')->name('edit_department');
Route::get('/view_department/{id}', 'department@view_department')->name('view_department');
Route::post('/update_department', 'department@update')->name('update_department');
Route::get('/department_delete/{id}', 'department@destroy')->name('department_delete');


// Banks
Route::get('/bank','bank@index')->name('bank_list');
Route::get('/add_bank', 'bank@add_bank')->name('bank_add');
Route::post('/add_bank_action', 'bank@store')->name('bank_add_action');
Route::get('/edit_bank/{id}', 'bank@edit_bank')->name('edit_bank');
Route::get('/view_bank/{id}', 'bank@view_bank')->name('view_bank');
Route::post('/update_bank', 'bank@update')->name('update_bank');
Route::get('/bank_delete/{id}', 'bank@destroy')->name('bank_delete');


// Shift
Route::get('/shift','shift@index')->name('shift_list');
Route::get('/add_shift', 'shift@add_shift')->name('shift_add');
Route::post('/add_shift_action', 'shift@store')->name('shift_add_action');
Route::get('/edit_shift/{id}', 'shift@edit_shift')->name('edit_shift');
Route::get('/view_shift/{id}', 'shift@view_shift')->name('view_shift');
Route::post('/update_shift', 'shift@update')->name('update_shift');
Route::get('/shift_delete/{id}', 'shift@destroy')->name('shift_delete');


//Leave Types-> Leave-Types
Route::get('/leave','leavetype@index')->name('leave_list');
Route::get('/add_leave', 'leavetype@add_leave')->name('leave_add');
Route::post('/add_leave_action', 'leavetype@store')->name('leave_add_action');
Route::get('/edit_leave/{id}', 'leavetype@edit_leave')->name('edit_leave');
Route::get('/view_leave/{id}', 'leavetype@view_leave')->name('view_leave');
Route::post('/update_leave', 'leavetype@update')->name('update_leave');
Route::get('/leave_delete/{id}', 'leavetype@destroy')->name('leave_delete');


//Leave Types-> Full Leaves
Route::get('/full_leave','full_leaves@index')->name('full_leave_list');
Route::get('/add_full_leave', 'full_leaves@add_full_leave')->name('full_leave_add');
Route::post('/add_full_leave_action', 'full_leaves@store')->name('full_leave_add_action');
Route::get('/edit_full_leave/{id}', 'full_leaves@edit_full_leave')->name('edit_full_leave');
Route::get('/view_full_leave/{id}', 'full_leaves@view_full_leave')->name('view_full_leave');
Route::post('/update_full_leave', 'full_leaves@update')->name('update_full_leave');
Route::get('/full_leave_delete/{id}', 'full_leaves@destroy')->name('full_leave_delete');

Route::post('/total_leave_working_days', 'full_leaves@total_leave_working_days')->name('total_leave_working_days');
Route::get('/holiday-count/{from}/{to}/{emId}', 'full_leaves@holidayCount')->name('holidayCount');


// Calender
Route::get('full-calender', [FullCalenderController::class, 'index'])->name('show_calander');

Route::post('full-calender/action', [FullCalenderController::class, 'action'])->name('action_calander');


//Leave Types-> Leave Report 
//Leave Types-> Leave Report -> Daily Leave Report
Route::any('/daily_leave_report_list','daily_leave_report@index')->name('daily_leave_report_list');
Route::get('/searchLeaves', 'daily_leave_report@search')->name('searchLeaves');

Route::any('/daily_half_leave_report_list','daily_half_leave_report@index')->name('daily_half_leave_report_list');
Route::any('/daily_short_leave_report_list','daily_short_leave_report@index')->name('daily_short_leave_report_list');

//Leave Types-> Leave Report -> Leave Register
Route::any('/leave_register_list','leave_register@index')->name('leave_register_list');

//Leave Types-> Leave Report -> monthly Leave Report
Route::get('/monthly_leave_report_list','monthly_leave_report@index')->name('monthly_leave_report_list');
Route::get('/monthly_half_leave_report_list','monthly_half_leave_report@index')->name('monthly_half_leave_report_list');
Route::get('/monthly_short_leave_report_list','monthly_short_leave_report@index')->name('monthly_short_leave_report_list');


// HRM-PAYROLL->Salary
Route::get('/salary','salary@index')->name('salary_list');
Route::get('/add_salary', 'salary@add_salary')->name('salary_add');
Route::post('/add_salary_action', 'salary@store')->name('salary_add_action');
Route::get('/edit_salary/{id}', 'salary@edit_salary')->name('edit_salary');
Route::get('/view_salary/{id}', 'salary@view_salary')->name('view_salary');
Route::post('/update_salary', 'salary@update')->name('update_salary');
Route::get('/salary_delete/{id}', 'salary@destroy')->name('salary_delete');

// HRM-PAYROLL->Salary_Arrear
Route::get('/salary_arrear','salary_arrear@index')->name('salary_arrear_list');
Route::get('/add_salary_arrear', 'salary_arrear@add_salary_arrear')->name('salary_arrear_add');
Route::post('/add_salary_arrear_action', 'salary_arrear@store')->name('salary_arrear_add_action');
Route::get('/edit_salary_arrear/{id}', 'salary_arrear@edit_salary_arrear')->name('edit_salary_arrear');
Route::get('/view_salary_arrear/{id}', 'salary_arrear@view_salary_arrear')->name('view_salary_arrear');
Route::post('/update_salary_arrear', 'salary_arrear@update')->name('update_salary_arrear');
Route::get('/salary_arrear_delete/{id}', 'salary_arrear@destroy')->name('salary_arrear_delete');


// HRM-PAYROLL->absent_payments
Route::get('/absent_payments','absent_payments@index')->name('absent_payments_list');
Route::get('/add_absent_payments', 'absent_payments@add_absent_payments')->name('absent_payments_add');
Route::post('/add_absent_payments_action', 'absent_payments@store')->name('absent_payments_add_action');
Route::get('/edit_absent_payments/{id}', 'absent_payments@edit_absent_payments')->name('edit_absent_payments');
Route::get('/view_absent_payments/{id}', 'absent_payments@view_absent_payments')->name('view_absent_payments');
Route::post('/update_absent_payments', 'absent_payments@update')->name('update_absent_payments');
Route::get('/absent_payments_delete/{id}', 'absent_payments@destroy')->name('absent_payments_delete');

// HRM-PAYROLL->absent_payments
Route::any('/approval_salary_report','approval_salary_report@index')->name('approval_salary_report');


