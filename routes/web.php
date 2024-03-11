<?php

use App\Models\Fees;

// use Response;



use App\Models\Classpromotion;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeesController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SchoolController;

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\StudentController;

// use App\Http\Controllers\ParentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ExamtypeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\TimesallController;
use App\Http\Controllers\VechicleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BloodGroupController;
use App\Http\Controllers\ClassteacherController;
use App\Http\Controllers\CountryStateController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StudentloginController;
use App\Http\Controllers\StudymaterialController;
use App\Http\Controllers\StudentdetailsController;
use App\Http\Controllers\SchoolstaffloginController;

Route::get('/', [AdminController::class, 'login']);

Auth::routes();


//user Routes List
// Route::middleware(['auth', 'user-access:user'])->group(function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

Route::post('get-student-by-class', [ClassController::class, 'getstudent']);
Route::post('get-student-by-class-for-fees', [ClassController::class, 'getstudentbyfees']);
Route::post('get-fees-by-student', [ClassController::class, 'getstudentfees']);
Route::post('get-paidfees-by-student', [ClassController::class, 'getstudentpaidfees']);
Route::post('get-studentold-by-class', [FeesController::class, 'getoldstudent'])->name('getoldstud');
Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('fees.class');
// Route::get('bloodgroups', [BloodGroupController::class, 'index']);
Route::post('bloodgroups/create', [BloodGroupController::class, 'add'])->name('blood.create');
Route::post('get-staff-by-position', [StaffController::class, 'getstaffbyposition']);
Route::post('get-student-class', [StudentdetailsController::class, 'getstudent']);

Route::get('/get-salary-by-staff/{staffId}', [StaffController::class, 'getSalaryDetails']);

// Route::post('bloodgroups/create', [BloodGroupController::class, 'add']);
Route::resource('examtypes', ExamtypeController::class);
Route::resource('subjects', SubjectController::class);

Route::post('get-states-by-country', [CountryStateController::class, 'getState']);
Route::post('getstudentfeebalance', [FeesController::class, 'StudentFeeBalance'])->name('getstudentfeebalance');



Route::middleware(['web', 'checkLoginStatus'])->group(function () {
    //accountant Routes List
    Route::middleware(['auth', 'user-access:accountant'])->group(function () {

        Route::get('/accountant/home', [HomeController::class, 'accountanthome'])->name('accountant.home');
        Route::get('accountant/school_info', [AdminController::class, 'school_info']);
        // school expense
        Route::get('accountant/enterexpense', [ExpenseController::class, 'enterexpense']);
        Route::post('accountant/enterexpense', [ExpenseController::class, 'expenseadd'])->name('accountant.add');
        Route::get('accountant/expenseedit/{id}', [ExpenseController::class, 'expenseedit'])->name('accountant.edit');
        Route::post('accountant/expenseupdate', [ExpenseController::class, 'expenseupdate'])->name('accountant.update');
        Route::get('accountant/monthlyexpense', [ExpenseController::class, 'monthlyexpense']);
        Route::get('accountant/dailyexpense', [ExpenseController::class, 'dailyexpense'])->name('accountant.daily');
        Route::post('accountant/previousexpense', [ExpenseController::class, 'previousexpense'])->name('accountant.previous');
        Route::post('accountant/previousmonth', [ExpenseController::class, 'previousmonth'])->name('accountant.previousmonth');
        Route::post('accountant/previousyear', [ExpenseController::class, 'previousyear'])->name('accountant.previousyear');
        Route::get('accountant/yearlyexpense', [ExpenseController::class, 'yearlyexpense']);


        // fees
        // Route::post('get-student-by-class', [ClassController::class, 'getstudent']);
        // Route::post('get-fees-by-student', [ClassController::class, 'getstudentfees']);
        // Route::post('get-paidfees-by-student', [ClassController::class, 'getstudentpaidfees']);
        // Route::get('accountant/feesform', [FeesController::class, 'feesform']);
        // Route::post('accountant/addfess', [FeesController::class, 'addfees'])->name('accountant.feesadd');
        // Route::get('accountant/dailyfees', [FeesController::class, 'dailyfees'])->name('accountant.daily');
        // Route::post('accountant/previousdayfees', [FeesController::class, 'previousdayfees'])->name('accountant.previousday');
        // Route::get('accountant/monthlyfees', [FeesController::class, 'monthlyfees']);
        // Route::post('accountant/previousmonthfees', [FeesController::class, 'previousmonthfees'])->name('accountant.previousmonthfees');
        // Route::get('accountant/yearlyfees', [FeesController::class, 'yearlyfees']);
        // Route::post('accountant/previousyearfees', [FeesController::class, 'previousyearfees'])->name('accountant.previousyearfees');
        // Route::get('accountant/paidfees', [FeesController::class, 'paidfees']);
        // Route::post('accountant/paidfees', [FeesController::class, 'paidfeesfilter'])->name('accountant.studentfilter');
        // Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('accountant.class');
        // Route::post('get-student-by-class', [FeesController::class, 'getstudent'])->name('accountant.student');



        // fees

        Route::get('accountant/feesform', [FeesController::class, 'feesform'])->name('accountantfee-structure.index');
        Route::get('accountant/paidfees', [FeesController::class, 'paidfees']);
        Route::get('accountant/fee-structure', [FeesController::class, 'feesform'])->name('accountantfee-structure.index');
        Route::get('accountant/fee-structure/create-edit/{id?}', [FeesController::class, 'edit'])->name('accountantfee-structure.create_edit');
        Route::post('accountant/fee-structure/store', [FeesController::class, 'store'])->name('accountantfee-structure.store');
        Route::post('accountant/fee-structure/update/{id}', [FeesController::class, 'update'])->name('accountantfee-structure.update');
        // Route::post('/fee-structure/store', [FeesController::class, 'store'])->name('fee-structure.store');
        Route::post('accountant/fee-collection/store', [FeesController::class, 'feescollection'])->name('accountantfeescollection.store');
        Route::post('accountant/paidfees', [FeesController::class, 'paidfeesfilter'])->name('accountantfees.studentfilter');


        Route::post('accountant/export', [ExcelController::class, 'export'])->name('accountantfees.export');
        Route::post('accountant/import', [ExcelController::class, 'import'])->name('accountantfees.import');


        // Route::get('/fee-structure', [FeesController::class, 'index'])->name('fee-structure.index');
        // Route::get('/fee-structure/create-edit/{id?}', [FeesController::class, 'createEdit'])->name('fee-structure.create_edit');
        // Route::post('/fee-structure/store', [FeesController::class, 'store'])->name('fee-structure.store');
        // Route::put('/fee-structure/update/{id}', [FeesController::class, 'update'])->name('fee-structure.update');





        //invoice fees
        Route::get('accountantinvoice/{student}',  [FeesController::class, 'generateInvoice'])->name('accountantinvoice.generate');
    });



    // Route::get('/vechicleexpense', [VechicleController::class, 'vechicleexpense']);
    // Route::get('/vehicledetails', [VechicleController::class, 'vehicledetails']);
    // Route::get('/vehicledetailsedit', [VechicleController::class, 'vehicledetailsedit']);
    // Route::get('/studentlist', [VechicleController::class, 'studentlist']);
    // Route::get('/vehicleexpenseedit', [VechicleController::class, 'vehicleexpenseedit']);

    // Route::get('/stockdetails', [StockController::class, 'stockdetails']);
    // Route::get('/stockpurchase', [StockController::class, 'stockpurchase']);
    // Route::get('/stockreturn', [StockController::class, 'stockreturn']);
    // Route::get('/stockusage', [StockController::class, 'stockusage']);
    // Route::get('/returndetails', [StockController::class, 'returndetails']);


    // fees
    // Route::post('get-student-by-class', [ClassController::class, 'getstudent']);
    // Route::post('get-fees-by-student', [ClassController::class, 'getstudentfees']);
    // Route::post('get-paidfees-by-student', [ClassController::class, 'getstudentpaidfees']);

    // routes/web.php

    // Route::post('admin/export', [ExcelController::class, 'export'])->name('fees.export');
    // Route::post('admin/import', [ExcelController::class, 'import'])->name('fees.import');
    // Route::get('admin/studentexport', [ExcelController::class, 'studentexport'])->name('fees.studentexport');
    // Route::post('admin/studentimport', [ExcelController::class, 'studentimport'])->name('fees.studentimport');




    // Route::post('admin/addfess', [FeesController::class, 'addfees'])->name('fees.add');
    // Route::get('admin/dailyfees', [FeesController::class, 'dailyfees'])->name('fees.daily');
    // Route::post('admin/previousdayfees', [FeesController::class, 'previousdayfees'])->name('fees.previousday');
    // Route::get('admin/monthlyfees', [FeesController::class, 'monthlyfees']);
    // Route::post('admin/previousmonthfees', [FeesController::class, 'previousmonthfees'])->name('fees.previousmonthfees');
    // Route::get('admin/yearlyfees', [FeesController::class, 'yearlyfees']);
    // Route::post('admin/previousyearfees', [FeesController::class, 'previousyearfees'])->name('fees.previousyearfees');
    // Route::get('admin/paidfees', [FeesController::class, 'paidfees']);
    // Route::post('admin/paidfees', [FeesController::class, 'paidfeesfilter'])->name('fees.studentfilter');
    // Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('fees.class');



    // fees
    // Route::get('admin/feesform', [FeesController::class, 'feesform']);
    // Route::get('/fee-structure', [FeesController::class, 'feesform'])->name('fee-structure.index');
    // Route::get('/fee-structure/create-edit/{id?}', [FeesController::class, 'edit'])->name('fee-structure.create_edit');
    // Route::post('/fee-structure/store', [FeesController::class, 'store'])->name('fee-structure.store');
    // Route::post('/fee-structure/update/{id}', [FeesController::class, 'update'])->name('fee-structure.update');
    // Route::post('/fee-structure/store', [FeesController::class, 'store'])->name('fee-structure.store');
    // Route::post('/fee-collection/store', [FeesController::class, 'feescollection'])->name('feescollection.store');





    //Admin Routes List
    Route::middleware(['auth', 'user-access:admin'])->group(function () {

        Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

        //   school information
        Route::get('admin/school_info', [AdminController::class, 'school_info']);
        Route::post('admin/school_info', [AdminController::class, 'adminitrativeadd'])->name('admin.adminitrative');
        Route::post('admin/schoolinfo/add', [AdminController::class, 'schoolinfoadd'])->name('admin.schollinfo');
        // admin login
        Route::get('admin/adminloginlist', [AdminController::class, 'adminlogin']);
        Route::post('admin/adminloginlist', [AdminController::class, 'adminregister'])->name('admin.register');

        Route::get('admin/adminloginedit/{id}', [AdminController::class, 'adminloginedit']);

        Route::post('admin/schoolupdate', [AdminController::class, 'schoolinfoupdate'])->name('admin.schollinfoupdate');
        Route::get('admin/administrativedetails', [AdminController::class, 'administrativeview']);
        Route::get('admin/schoolinfoedit/{id}', [AdminController::class, 'schoolinfoedit']);
        Route::get('admin/administrativeedit/{id}', [AdminController::class, 'administrativeedit']);
        Route::post('admin/school_info/{id}', [AdminController::class, 'adminitrativeedit'])->name('admin.adminitrativeedit');

        //student
        // Route::resource('students', StudentController::class);

        Route::get('students', [StudentController::class, 'classfilter'])->name('admin.studentclassfilter');
        Route::post('students', [StudentController::class, 'store'])->name('students.store');
        Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
        Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');
        Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');

        Route::post('studentstransfer/{student}', [StudentController::class, 'studenttransfer'])->name('students.transfer');
        Route::post('studentcompleted/{student}', [StudentController::class, 'studentcompleted'])->name('students.completed');

        Route::get('staffs', [StaffController::class, 'index'])->name('staffs.index');
        Route::post('staffs', [StaffController::class, 'store'])->name('staffs.store');
        Route::get('staffs/create', [StaffController::class, 'create'])->name('staffs.create');
        Route::get('staffs/{staff}', [StaffController::class, 'show'])->name('staffs.show');
        Route::post('staffs/{staff}', [StaffController::class, 'update'])->name('staffs.update');
        Route::delete('staffs/{staff}', [StaffController::class, 'destroy'])->name('staffs.destroy');
        Route::get('staffs/{staff}/edit', [StaffController::class, 'edit'])->name('staffs.edit');



        // Route::get('students', [StudentController::class, 'classfilter'])->name('admin.studentclassfilter');


        // Route::get('student/filter', [StudentController::class, 'classfilter']);

        Route::get('admin/newadmissiondetails', [StudentController::class, 'newadmissiondetails'])->name('newstudents.index');
        Route::get('admin/newadmissiondetails/filter', [StudentController::class, 'newadmissiondetailsfilter'])->name('newstudents.yearfilter');
        Route::get('admin/newadmissionedit/{id}', [StudentController::class, 'newadmissionedit'])->name('newstudents.edit');
        Route::get('admin/newadmissionview/{id}', [StudentController::class, 'newadmissionview'])->name('newstudents.show');
        Route::get('admin/newadmission', [StudentController::class, 'newadmission'])->name('students.newstudentadmission');
        Route::post('admin/newadmission/add', [StudentController::class, 'addnewadmission'])->name('students.addnewstudent');
        Route::post('admin/newadmission/status', [StudentController::class, 'newadmissiontoold'])->name('newstudent.status');

        // Route::post('bloodgroups/create', [BloodGroupController::class, 'add'])->name('blood.create');
        // staff
        // Route::resource('staffs', StaffController::class);
        // Route::resource('bloodgroups', BloodGroupController::class);

        // Route::get('admin/staffsedit', [StaffController::class, 'staffedit']);
        Route::get('admin/staffsdetails', [StaffController::class, 'staffdetails']);
        Route::get('admin/staffsdetails', [StaffController::class, 'positiondetails'])->name('admin.positionfilter');
        // Route::get('staffs', [StaffController::class, 'index'])->name('staffs.index');

        //     Route::get('staffs', [StaffController::class, 'index'])->name('staffs.index');

        // Route::get('staffs/position', [StaffController::class, 'positiondetails'])->name('admin.positiond');
        Route::get('/staffsalary', [StaffController::class, 'staffsalary']);
        Route::post('/salaryadd', [StaffController::class, 'salaryadd']);
        Route::post('/staffsalary/filter', [StaffController::class, 'staffsalaryfilter'])->name('salary.filter');
        Route::get('/staffsalaryedit/{staff_id}/{date}', [StaffController::class, 'staffsalaryedit']);
        Route::post('/staffsalaryupdate/{staff_id}', [StaffController::class, 'salaryupdate'])->name('salary.update');
        Route::get('/staffsalaryview', [StaffController::class, 'staffsalaryview']);
        Route::get('admin/staffattendance', [StaffController::class, 'staffattendance']);
        Route::get('admin/staffattendance', [StaffController::class, 'todayfilter'])->name('admin.todayfilter');

        Route::get('admin/staffmonthlycount', [StaffController::class, 'staffmonthlycount']);
        Route::get('admin/staffmonthlycount', [StaffController::class, 'staffmonthlycountfilter'])->name('admin.monthlycountfilter');



        Route::get('admin/takeattendance', [StaffController::class, 'takeattendance']);
        Route::get('admin/takeattendance', [StaffController::class, 'takeattendancefilter'])->name('admin.takefilter');
        Route::post('admin/takeattendance', [StaffController::class, 'attendanceinsert'])->name('admin.attendanceinsert');



        Route::get('admin/showattendance', [StaffController::class, 'showattendance']);
        Route::get('admin/showattendance', [StaffController::class, 'filterattendance'])->name('filterAttendance');

        // Route::get('admin/monthlycount', [StaffController::class, 'monthlycount']);
        // Route::get('admin/monthlycount', [StaffController::class, 'monthlycountfilter'])->name('admin.monthlyfilter');

        Route::get('admin/staffattendanceedit/{id}', [StaffController::class, 'staffattendanceedit']);
        Route::post('admin/staffattendanceupdate/{id}', [StaffController::class, 'staffattendanceupdate'])->name('admin.attendaneupdate');

        // class & section
        Route::group(['prefix' => 'admin'], function () {

            // Transport
            Route::get('transport', [VechicleController::class, 'index'])->name('transport.index');
            Route::post('transport/vehicleadd', [VechicleController::class, 'vehiclesadd'])->name('vehicle.add');
            Route::post('transport/routeadd', [VechicleController::class, 'routesadd'])->name('route.add');
            Route::post('transport/assignvehicle', [VechicleController::class, 'assignvehicleadd'])->name('assignvehicle.add');
            Route::post('transport/update', [VechicleController::class, 'transportupdate'])->name('transport.update');
            Route::get('route', [VechicleController::class, 'routeindex'])->name('route.index');
            Route::get('route/status/{id}/{status}', [VechicleController::class, 'routestatus'])->name('route.status');
            Route::get('assignvehicle/status/{id}/{status}', [VechicleController::class, 'assignvehiclestatus'])->name('assignvehicle.status');
            Route::get('vehicle/status/{id}/{status}', [VechicleController::class, 'vehiclestatus'])->name('vehicle.status');
            Route::post('vehicle/update', [VechicleController::class, 'vehicleupdate'])->name('vehicle.update');
            Route::post('route/update/{id}', [VechicleController::class, 'routeupdate'])->name('route.update');
            Route::post('assignvehicle/update', [VechicleController::class, 'assignvehicleupdate'])->name('assignvehicle.update');


            // Route::resource('sections', ClassController::class);

            Route::get('sections', [ClassController::class, 'index'])->name('sections.index');
            Route::post('sections', [ClassController::class, 'store'])->name('sections.store');
            Route::get('sections/create', [ClassController::class, 'create'])->name('sections.create');
            Route::get('sections/{section}', [ClassController::class, 'show'])->name('sections.show');
            Route::put('sections/{section}', [ClassController::class, 'update'])->name('sections.update');
            Route::delete('sections/{section}', [ClassController::class, 'destroy'])->name('sections.destroy');
            Route::get('sections/{section}/edit', [ClassController::class, 'edit'])->name('sections.edit');



            Route::get('/classedit/{id}', [ClassController::class, 'classedit'])->name('admin.classedit');
            Route::post('/classupdate/{id}', [ClassController::class, 'classupdate'])->name('admin.classupdate');
            Route::get('/class/{id}', [ClassController::class, 'class'])->name('class.status');

            Route::get('/studenttimetable', [ClassController::class, 'studenttimetable']);
            Route::post('/studenttimetable', [ClassController::class, 'studenttimetableinsert'])->name('admin.classtimetable');
            Route::get('/studenttimetablefilter', [ClassController::class, 'studenttimetablefilter'])->name('studenttimetable.filter');
            Route::get('/studenttimetableedit/{id}', [ClassController::class, 'studenttimetableedit'])->name('admin.classtimetableedit');
            Route::post('/studenttimetableupdate/{id}', [ClassController::class, 'studenttimetableupdate'])->name('admin.classtimetableupdate');


            //assign class staff
            Route::get('/assignclass_staff', [ClassController::class, 'assignclassstaff']);
            Route::post('/assignclass_staff', [ClassController::class, 'classstaffadd'])->name('admin.class_staff');
            Route::get('/assignclass_staff_edit/{id}', [ClassController::class, 'assignclassstaffedit'])->name('admin.assignclass_staff_edit');
            Route::post('/assignclass_staff_update/{id}', [ClassController::class, 'assignclassstaffupdate'])->name('admin.class_staffupdate');
            Route::get('/assignclass_staff_delete/{subassignid}', [ClassController::class, 'assignclassstaffdelete']);

            Route::post('/stafftimetable', [ClassController::class, 'stafftimetableinsert'])->name('admin.stafftimetable');
            Route::get('/stafftimetable', [ClassController::class, 'stafftimetable']);
            Route::get('/stafftimetablefilter', [ClassController::class, 'stafftimetablefilter'])->name('stafftimetable.filter');
            Route::get('/stafftimetableedit/{id}', [ClassController::class, 'stafftimetableedit'])->name('admin.stafftimetableedit');
            Route::post('/stafftimetableupdate/{id}', [ClassController::class, 'stafftimetableupdate'])->name('admin.stafftimetableupdate');

            Route::get('/classteacheredit/{id}', [ClassController::class, 'classteacheredit'])->name('admin.classteacheredit');
            Route::post('/classteacherupdate/{id}', [ClassController::class, 'classteacherupdate'])->name('admin.classteacherupdate');

            Route::get('/studentpromotion', [ClassController::class, 'studentpromotion']);

            // Classpromotion
            Route::post('/studentpromotiominsert', [ClassController::class, 'promotioninsert'])->name('admin.promotioninsert');
            Route::post('/studentpromotiondelete', [ClassController::class, 'promotiondelete'])->name('admin.promotiondelete');
        });

        // exam
        Route::get('admin/index', [ExamController::class, 'markindex']);
        Route::get('admin/marks/enter', [ExamController::class, 'markcreate']);
        Route::post('admin/marks/create', [ExamController::class, 'markaddinsert'])->name('admin.create');
        Route::get('admin/marks/show', [ExamController::class, 'markshow']);
        Route::get('admin/marks/show', [ExamController::class, 'markshowfilter'])->name('admin.marks.show');
        Route::get('admin/edit/{markid}', [ExamController::class, 'markedit']);

        Route::get('admin/dailyexam/edit/{markid}', [ExamController::class, 'dailymarkedit']);
        Route::post('admin/marks/update/{markid}', [ExamController::class, 'markupdate'])->name('admin.update');

        // Route::get('/vechicleexpense', [VechicleController::class, 'vechicleexpense']);
        // Route::get('/vehicledetails', [VechicleController::class, 'vehicledetails']);
        // Route::get('/vehicledetailsedit', [VechicleController::class, 'vehicledetailsedit']);
        // Route::get('/studentlist', [VechicleController::class, 'studentlist']);
        // Route::get('/vehicleexpenseedit', [VechicleController::class, 'vehicleexpenseedit']);

        // Route::get('/stockdetails', [StockController::class, 'stockdetails']);
        // Route::get('/stockpurchase', [StockController::class, 'stockpurchase']);
        // Route::get('/stockreturn', [StockController::class, 'stockreturn']);
        // Route::get('/stockusage', [StockController::class, 'stockusage']);
        // Route::get('/returndetails', [StockController::class, 'returndetails']);


        // fees
        // Route::post('get-student-by-class', [ClassController::class, 'getstudent']);
        // Route::post('get-fees-by-student', [ClassController::class, 'getstudentfees']);
        // Route::post('get-paidfees-by-student', [ClassController::class, 'getstudentpaidfees']);
        // Route::post('admin/addfess', [FeesController::class, 'addfees'])->name('fees.add');
        // Route::get('admin/dailyfees', [FeesController::class, 'dailyfees'])->name('fees.daily');
        // Route::post('admin/previousdayfees', [FeesController::class, 'previousdayfees'])->name('fees.previousday');
        // Route::get('admin/monthlyfees', [FeesController::class, 'monthlyfees']);
        // Route::post('admin/previousmonthfees', [FeesController::class, 'previousmonthfees'])->name('fees.previousmonthfees');
        // Route::get('admin/yearlyfees', [FeesController::class, 'yearlyfees']);
        // Route::post('admin/previousyearfees', [FeesController::class, 'previousyearfees'])->name('fees.previousyearfees');
        // Route::get('admin/paidfees', [FeesController::class, 'paidfees']);
        // Route::post('admin/paidfees', [FeesController::class, 'paidfeesfilter'])->name('fees.studentfilter');
        // Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('fees.class');

        Route::get('admin/feesform', [FeesController::class, 'feesform']);
        Route::get('admin/paidfees', [FeesController::class, 'paidfees']);
        Route::get('admin/fee-structure', [FeesController::class, 'feesform'])->name('adminfee-structure.index');
        Route::get('admin/fee-structure/create-edit/{id?}', [FeesController::class, 'edit'])->name('adminfee-structure.create_edit');
        Route::post('admin/fee-structure/store', [FeesController::class, 'store'])->name('adminfee-structure.store');
        Route::post('admin/fee-structure/update/{id}', [FeesController::class, 'update'])->name('adminfee-structure.update');
        // Route::post('admin/fee-structure/store', [FeesController::class, 'store'])->name('adminfee-structure.store');
        Route::post('admin/fee-collection/store', [FeesController::class, 'feescollection'])->name('adminfeescollection.store');
        Route::post('admin/paidfees', [FeesController::class, 'paidfeesfilter'])->name('adminfees.studentfilter');

        Route::post('admin/export', [ExcelController::class, 'export'])->name('adminfees.export');
        Route::post('admin/import', [ExcelController::class, 'import'])->name('adminfees.import');
        Route::get('admin/studentexport', [ExcelController::class, 'studentexport'])->name('admin.studentexport');
        Route::post('admin/studentimport', [ExcelController::class, 'studentimport'])->name('admin.studentimport');

        Route::get('admin/studentattendance', [ClassteacherController::class, 'studentattendance']);
        Route::get('admin/studentattendance', [ClassteacherController::class, 'studentattendancefilter'])->name('admin.studentdetailfilter');
        Route::get('admin/studenttakeattendance', [ClassteacherController::class, 'studenttakeattendance']);
        Route::get('admin/studenttakeattendance', [ClassteacherController::class, 'takeattendancefilter'])->name('admin.attendancetakefilter');
        Route::post('admin/studenttakeattendanceinsert', [ClassteacherController::class, 'takeattendanceinsert'])->name('admin.attendancetakeinsert');
        Route::get('admin/studentattendanceedit', [ClassteacherController::class, 'studentattendanceedit']);
        Route::get('admin/studentfilterattendance', [ClassteacherController::class, 'studentfilterattendance']);
        Route::get('admin/studentfilterattendance', [ClassteacherController::class, 'monthattendancefilter'])->name('admin.monthattendancefilter');

        Route::get('admin/monthlycount', [ClassteacherController::class, 'monthlycount']);
        Route::get('admin/monthlycount', [ClassteacherController::class, 'monthlycountfilter'])->name('admin.monthlycountfilter');


        //invoice fees
        Route::get('invoice/{student}',  [FeesController::class, 'generateInvoice'])->name('invoice.generate');


        Route::get('/offlineexam', [ExamController::class, 'offlineexam']);
        Route::get('/onlineexam', [ExamController::class, 'onlineexam']);
        Route::get('/offlineexamedit/{id}', [ExamController::class, 'offlineexamedit']);
        Route::get('/offlinetimetable', [ExamController::class, 'offlinetimetable']);
        Route::post('/examadd', [ExamController::class, 'examadd'])->name('admin.examadd');
        Route::get('/offlinetimetable', [ExamController::class, 'offlinetimetablefilter'])->name('exam.timetablefilter');
        Route::get('rowexamdelete/{id}', [ExamController::class, 'rowexamdelete']);
        Route::post('examupdate/{examid}', [ExamController::class, 'examupdate']);





        Route::get('examresult', [ExamController::class, 'examresult']);


        //mail
        Route::get('/mail', function () {
            return view('mail');
        });

        //school staff and student login
        Route::get('admin/staffloginlist', [SchoolstaffloginController::class, 'stafflogindetails']);
        Route::get('admin/staffloginedit/{id}', [SchoolstaffloginController::class, 'staffloginedit'])->name('admin.staffloginedit');
        Route::post('admin/staffloginupdate/{id}', [SchoolstaffloginController::class, 'staffloginupdate'])->name('admin.staffloginupdate');
        Route::get('admin/stafflogindelete/{id}', [SchoolstaffloginController::class, 'stafflogindelete'])->name('admin.stafflogindelete');
        Route::post('admin/staffregister', [SchoolstaffloginController::class, 'staffregister'])->name('staff.register');
        Route::get('admin/staffloginlist/{id}', [SchoolstaffloginController::class, 'loginstauts'])->name('login.status');
        Route::get('admin/studentloginlist', [SchoolstaffloginController::class, 'studentlogindetails']);
        Route::get('admin/studentloginlist', [SchoolstaffloginController::class, 'studentloginfilter'])->name('student.filters');
        Route::get('admin/studentloginstatus/{id}', [SchoolstaffloginController::class, 'studentloginstatus'])->name('student.status');



        // school expense
        Route::get('admin/enterexpense', [ExpenseController::class, 'enterexpense']);
        Route::post('admin/enterexpense', [ExpenseController::class, 'expenseadd'])->name('expense.add');
        Route::get('admin/expenseedit/{id}', [ExpenseController::class, 'expenseedit'])->name('expense.edit');
        Route::post('admin/expenseupdate', [ExpenseController::class, 'expenseupdate'])->name('expense.update');
        Route::get('admin/monthlyexpense', [ExpenseController::class, 'monthlyexpense']);
        Route::get('admin/dailyexpense', [ExpenseController::class, 'dailyexpense'])->name('expense.daily');
        Route::post('admin/previousexpense', [ExpenseController::class, 'previousexpense'])->name('expense.previous');
        Route::post('admin/previousmonth', [ExpenseController::class, 'previousmonth'])->name('expense.previousmonth');
        Route::post('admin/previousyear', [ExpenseController::class, 'previousyear'])->name('expense.previousyear');
        Route::get('admin/yearlyexpense', [ExpenseController::class, 'yearlyexpense']);

        // admin message
        // Route::get('/admin/message', [OrganizationController::class, 'schoomessage']);
        Route::get('admin/message', [MessagesController::class, 'messageindex']);
        Route::POST('admin/message/add', [MessagesController::class, 'messagestore'])->name('admin.staffmessage');
        Route::get('admin/bulkmessage', [MessagesController::class, 'bulkclassmessage']);
        Route::POST('admin/bulkmessage/add', [MessagesController::class, 'bulkclassmessageadd'])->name('admin.bulkclassmessage');
        Route::get('admin/messagedelete/{id}', [MessagesController::class, 'messagedelete']);
        Route::get('admin/bulkclassdelete/{id}', [MessagesController::class, 'bulkclassmessagedelete']);

        // Route::post('admin/message/update', [MessagesController::class, 'messageupdate'])->name('message.update');

        // adminnotice
        Route::get('/admin/notice', [OrganizationController::class, 'schoolnotice'])->name('notice.index');
        Route::post('admin/notice/add', [OrganizationController::class, 'noticeadd'])->name('enotice.add');
        Route::get('admin/notice/status/{id}/{status}', [OrganizationController::class, 'statusnoticeedit'])->name('enotice.status');
        Route::post('admin/notice/update/{id}', [OrganizationController::class, 'noticeupdate'])->name('enotice.update');
        // Route::get('admin/noticeedit', [OrganizationController::class, 'noticeedit']);

        // school e_news
        Route::get('admin/e_news', [OrganizationController::class, 'schoole_news'])->name('enews.index');
        Route::post('admin/e_news/add', [OrganizationController::class, 'enewsadd'])->name('enews.add');
        Route::get('admin/e_news/status/{id}/{status}', [OrganizationController::class, 'statusenewsedit'])->name('enews.status');
        Route::post('admin/e_news/update/{id}', [OrganizationController::class, 'enewsupdate'])->name('enews.update');
        // Route::get('admin/e_newsedit', [OrganizationController::class, 'e_newsedit']);

        //admin visitor
        Route::get('admin/visitor', [VisitorController::class, 'visitor'])->name('visitor.index');
        Route::post('admin/visitor/add', [VisitorController::class, 'visitoradd'])->name('visitor.add');
        Route::post('admin/visitor/update', [VisitorController::class, 'visitorupdate'])->name('visitor.update');
        // Route::get('admin/visitoredit', [VisitorController::class, 'visitoredit']);



        Route::get('admin/time', [TimesallController::class, 'timeview']);

        Route::get('admin/classtimeedit/{id}', [TimesallController::class, 'classtimeedit']);
        Route::get('admin/examtimeedit/{id}', [TimesallController::class, 'examtimeedit']);

        Route::post('admin/classtimeadd', [TimesallController::class, 'classtimeadd']);
        Route::post('admin/classtimeupdate/{id}', [TimesallController::class, 'classtimeupdate']);
        Route::post('admin/examtimeupdate/{id}', [TimesallController::class, 'examtimeupdate']);

        //report
        Route::get('admin/completedstudents', [ReportController::class, 'completedstudents']);
        Route::get('admin/completedstudents', [ReportController::class, 'completedstudentsfilter'])->name('admin.studentcompletedfilter');
        Route::get('admin/transferstudents', [ReportController::class, 'transferstudents']);
        Route::get('admin/transferstudents', [ReportController::class, 'transferstudentsfilter'])->name('admin.studenttransferfilter');
        
        Route::get('admin/getClassAttendance', [ReportController::class, 'getClassAttendance']);
        Route::get('admin/getClassAttendanceReport', [ReportController::class, 'getClassAttendanceReport'])->name('admin.classattendance');
        Route::get('admin/studentscount', [ReportController::class, 'getClasswiseCounts']);
      
        Route::get('admin/getstudentreport', [ReportController::class, 'getstudentroute']);
        Route::get('admin/getstudentinaroute', [ReportController::class, 'getstudentinaroute'])->name('admin.studentinaroute');
        Route::get('admin/getvehiclereport', [ReportController::class, 'getVehiclesReport']);

        Route::get('admin/getstaffreport', [ReportController::class, 'getStaffreport']);
        Route::get('admin/staffsdetailsreport', [ReportController::class, 'getStaffreport'])->name('admin.getStaffreport');

        Route::get('admin/getfeesreport', [ReportController::class, 'getfeesReport']);
        Route::get('admin/feesdetailsreport', [ReportController::class, 'getfeesReport'])->name('admin.getfeesReport');

        // Route::get('admin/classMarksReport', [ReportController::class, 'classMarksReport']);

        // dailycontent
        Route::get('admin/dailycontent', [StudymaterialController::class, 'dailycontent']);
        Route::get('admin/dailycontent', [StudymaterialController::class, 'dailycontentfilter'])->name('admin.dailycontentfilter');
        Route::post('admin/dailycontentadd', [StudymaterialController::class, 'dailycontentadd']);
        Route::get('admin/dailycontentview/{viewid}', [StudymaterialController::class, 'dailycontentview']);

        // home work
        Route::get('admin/homework', [StudymaterialController::class, 'homework']);
        Route::get('admin/homework', [StudymaterialController::class, 'homeworkfilter'])->name('admin.homeworkfilter');
        Route::post('admin/homeworkadd', [StudymaterialController::class, 'homeworkadd']);
    });

    //staff Routes List
    Route::middleware(['auth', 'user-access:staff'])->group(function () {
        // Route::get('/classteacher/home', [HomeController::class, 'classteacherHome'])->name('manager.home');
        Route::get('/classteacher/home', [HomeController::class, 'classteacherHome'])->name('staff.home');
        // Route::get('classteacher/inbox', [ClassteacherController::class, 'classteacherinbox']);
        // Route::get('classteacher/sent', [ClassteacherController::class, 'classteachersent']);
        Route::get('classteacher/message', [MessagesController::class, 'staffmessageindex'])->name('staffmessage.index');
        Route::POST('classteacher/message/add', [MessagesController::class, 'staffmessagestore'])->name('staffmessage.add');
        Route::get('classteacher/dailytimetable', [ClassteacherController::class, 'classteacherdailytimetable']);
        Route::get('classteacher/studenttimetable', [ClassteacherController::class, 'studenttimetable']);
        Route::get('classteacher/studenttimetable', [ClassteacherController::class, 'studenttimetablefilter'])->name('staff.timetablefilter');
        Route::get('classteacher/studentattendance', [ClassteacherController::class, 'studentattendance']);
        Route::get('classteacher/studentattendance', [ClassteacherController::class, 'studentattendancefilter'])->name('classteacher.studentdetailfilter');
        Route::get('classteacher/studenttakeattendance', [ClassteacherController::class, 'studenttakeattendance']);
        Route::get('classteacher/studenttakeattendance', [ClassteacherController::class, 'takeattendancefilter'])->name('classteacher.attendancetakefilter');
        Route::post('classteacher/studenttakeattendanceinsert', [ClassteacherController::class, 'takeattendanceinsert'])->name('classteacher.attendancetakeinsert');
        Route::get('classteacher/studentattendanceedit', [ClassteacherController::class, 'studentattendanceedit']);
        Route::get('classteacher/studentfilterattendance', [ClassteacherController::class, 'studentfilterattendance']);
        Route::get('classteacher/studentfilterattendance', [ClassteacherController::class, 'monthattendancefilter'])->name('classteacher.monthattendancefilter');


        Route::get('classteacher/monthlycount', [ClassteacherController::class, 'monthlycount']);
        Route::get('classteacher/monthlycount', [ClassteacherController::class, 'monthlycountfilter'])->name('classteacher.monthlycountfilter');

        //staff attendance view
        Route::get('classteacher/myattendance', [ClassteacherController::class, 'myattendance']);
        Route::get('classteacher/myattendance', [ClassteacherController::class, 'myattendancefilter'])->name('classteacher.myattendancemonth');

        //  staff login
        Route::get('classteacher/studentdetailslist', [ClassteacherController::class, 'studentdetailslist']);
        Route::get('classteacher/studentdetailslist', [ClassteacherController::class, 'studentdetailslistfilter'])->name('classteacher.studentclassfilter');
        Route::get('classteacher/status/{id}', [ClassteacherController::class, 'studentstatus']);
        Route::get('classteacher/studentdetailsview/{id}', [ClassteacherController::class, 'studentdetailsview']);

        // dailycontent
        Route::get('classteacher/dailycontent', [StudymaterialController::class, 'dailycontent']);
        Route::get('classteacher/dailycontent', [StudymaterialController::class, 'dailycontentfilter'])->name('classteacher.dailycontentfilter');
        Route::post('classteacher/dailycontentadd', [StudymaterialController::class, 'dailycontentadd']);
        Route::get('classteacher/dailycontentview/{viewid}', [StudymaterialController::class, 'dailycontentview']);

        // home work
        Route::get('classteacher/dailyhomework', [StudymaterialController::class, 'homework']);
        Route::get('classteacher/dailyhomework', [StudymaterialController::class, 'homeworkfilter'])->name('classteacher.homeworkfilter');
        Route::post('classteacher/homeworkadd', [StudymaterialController::class, 'homeworkadd']);

        // exam
        Route::get('classteacher/index', [ExamController::class, 'markindex']);
        Route::get('marks/enter', [ExamController::class, 'markcreate']);
        Route::post('marks/create', [ExamController::class, 'markaddinsert'])->name('classteacher.create');
        Route::get('/marks/show', [ExamController::class, 'markshow']);
        Route::get('/marks/show', [ExamController::class, 'markshowfilter'])->name('marks.show');
        Route::get('classteacher/edit/{markid}', [ExamController::class, 'markedit']);
        Route::get('dailyexam/edit/{markid}', [ExamController::class, 'dailymarkedit']);
        Route::post('marks/update/{markid}', [ExamController::class, 'markupdate'])->name('classteacher.update');
    });


    //clerk Routes List
    Route::middleware(['auth', 'user-access:clerk'])->group(function () {

        Route::get('clerk/home', [HomeController::class, 'clerkHome'])->name('clerk.home');
        Route::get('clerk/school_info', [AdminController::class, 'school_info']);
        //school staff and student login
        Route::get('clerk/staffloginlist', [SchoolstaffloginController::class, 'stafflogindetails']);
        Route::get('clerk/staffloginedit/{id}', [SchoolstaffloginController::class, 'staffloginedit'])->name('clerkadmin.staffloginedit');
        Route::post('clerk/staffloginupdate/{id}', [SchoolstaffloginController::class, 'staffloginupdate'])->name('clerkadmin.staffloginupdate');
        Route::get('clerk/stafflogindelete/{id}', [SchoolstaffloginController::class, 'stafflogindelete'])->name('clerkadmin.stafflogindelete');
        Route::post('clerk/staffregister', [SchoolstaffloginController::class, 'staffregister'])->name('clerkstaff.register');
        Route::get('clerk/staffloginlist/{id}', [SchoolstaffloginController::class, 'loginstauts'])->name('clerklogin.status');
        Route::get('clerk/studentloginlist', [SchoolstaffloginController::class, 'studentlogindetails']);
        Route::get('clerk/studentloginlist', [SchoolstaffloginController::class, 'studentloginfilter'])->name('clerkstudent.filters');
        Route::get('clerk/studentloginstatus/{id}', [SchoolstaffloginController::class, 'studentloginstatus'])->name('clerkstudent.status');


        // class & section
        Route::group(['prefix' => 'clerk'], function () {
            // Route::resource('sections', ClassController::class);
            Route::get('/classedit/{id}', [ClassController::class, 'classedit'])->name('clerkadmin.classedit');
            Route::post('/classupdate/{id}', [ClassController::class, 'classupdate'])->name('clerkadmin.classupdate');
            Route::get('/class/{id}', [ClassController::class, 'class'])->name('clerkclass.status');

            Route::get('/studenttimetable', [ClassController::class, 'studenttimetable']);
            Route::post('/studenttimetable', [ClassController::class, 'studenttimetableinsert'])->name('clerkadmin.classtimetable');
            Route::get('/studenttimetablefilter', [ClassController::class, 'studenttimetablefilter'])->name('clerkstudenttimetable.filter');
            Route::get('/studenttimetableedit/{id}', [ClassController::class, 'studenttimetableedit'])->name('clerkadmin.classtimetableedit');
            Route::post('/studenttimetableupdate/{id}', [ClassController::class, 'studenttimetableupdate'])->name('clerkadmin.classtimetableupdate');

            Route::get('/classteacheredit/{id}', [ClassController::class, 'classteacheredit'])->name('clerkadmin.classteacheredit');
            Route::post('/classteacherupdate/{id}', [ClassController::class, 'classteacherupdate'])->name('clerkadmin.classteacherupdate');

            Route::post('/stafftimetable', [ClassController::class, 'stafftimetableinsert'])->name('clerkadmin.stafftimetable');
            Route::get('/stafftimetable', [ClassController::class, 'stafftimetable']);
            Route::get('/stafftimetablefilter', [ClassController::class, 'stafftimetablefilter'])->name('clerkstafftimetable.filter');
            Route::get('/stafftimetableedit/{id}', [ClassController::class, 'stafftimetableedit'])->name('clerkadmin.stafftimetableedit');
            Route::post('/stafftimetableupdate/{id}', [ClassController::class, 'stafftimetableupdate'])->name('clerkadmin.stafftimetableupdate');


            Route::get('/studentpromotion', [ClassController::class, 'studentpromotion']);

            // Classpromotion
            Route::post('/studentpromotiominsert', [ClassController::class, 'promotioninsert'])->name('clerkadmin.promotioninsert');
            Route::post('/studentpromotiondelete', [ClassController::class, 'promotiondelete'])->name('clerkadmin.promotiondelete');

            //report
            Route::get('/completedstudents', [ReportController::class, 'completedstudents']);
            Route::get('/completedstudents', [ReportController::class, 'completedstudentsfilter'])->name('clerkstudent.studentcompletedfilter');
            Route::get('/transferstudents', [ReportController::class, 'transferstudents']);
            Route::get('/transferstudents', [ReportController::class, 'transferstudentsfilter'])->name('clerkstudent.studenttransferfilter');
            Route::get('/getClassAttendance', [ReportController::class, 'getClassAttendance']);
            Route::get('/getClassAttendanceReport', [ReportController::class, 'getClassAttendanceReport'])->name('clerkstudent.classattendance');

            Route::get('/studentscount', [ReportController::class, 'getClasswiseCounts']);

            Route::get('/getstudentreport', [ReportController::class, 'getstudentroute']);
            Route::get('/getstudentinaroute', [ReportController::class, 'getstudentinaroute'])->name('clerkstudent.studentinaroute');
    
            Route::get('/getvehiclereport', [ReportController::class, 'getVehiclesReport']);

            Route::get('/getstaffreport', [ReportController::class, 'getStaffreport']);
            Route::get('/staffsdetailsreport', [ReportController::class, 'getStaffreport'])->name('clerkadmin.getStaffreport');

            Route::get('/getfeesreport', [ReportController::class, 'getfeesReport']);
            Route::get('/feesdetailsreport', [ReportController::class, 'getfeesReport'])->name('clerkadmin.getfeesReport');
    

            //assign class staff
            Route::get('/assignclass_staff', [ClassController::class, 'assignclassstaff']);
            Route::post('/assignclass_staff', [ClassController::class, 'classstaffadd'])->name('clerk.class_staff');
            Route::get('/assignclass_staff_edit/{id}', [ClassController::class, 'assignclassstaffedit'])->name('clerk.assignclass_staff_edit');
            Route::post('/assignclass_staff_update/{id}', [ClassController::class, 'assignclassstaffupdate'])->name('clerk.class_staffupdate');
            Route::get('/assignclass_staff_delete/{subassignid}', [ClassController::class, 'assignclassstaffdelete']);

            // Transport
            Route::get('transport', [VechicleController::class, 'index'])->name('clerk.transport.index');
            Route::post('transport/vehicleadd', [VechicleController::class, 'vehiclesadd'])->name('clerk.vehicle.add');
            Route::post('transport/routeadd', [VechicleController::class, 'routesadd'])->name('clerk.route.add');
            Route::post('transport/assignvehicle', [VechicleController::class, 'assignvehicleadd'])->name('clerk.assignvehicle.add');
            Route::post('transport/update', [VechicleController::class, 'transportupdate'])->name('clerk.transport.update');
            Route::get('route', [VechicleController::class, 'routeindex'])->name('clerk.route.index');
            Route::get('route/status/{id}/{status}', [VechicleController::class, 'routestatus'])->name('clerk.route.status');
            Route::get('assignvehicle/status/{id}/{status}', [VechicleController::class, 'assignvehiclestatus'])->name('clerk.assignvehicle.status');
            Route::get('vehicle/status/{id}/{status}', [VechicleController::class, 'vehiclestatus'])->name('clerk.vehicle.status');
            Route::post('vehicle/update', [VechicleController::class, 'vehicleupdate'])->name('clerk.vehicle.update');
            Route::post('route/update/{id}', [VechicleController::class, 'routeupdate'])->name('clerk.route.update');
            Route::post('assignvehicle/update', [VechicleController::class, 'assignvehicleupdate'])->name('clerk.assignvehicle.update');
        });

        // adminnotice
        Route::get('clerk/notice', [OrganizationController::class, 'schoolnotice'])->name('clerknotice.index');
        Route::post('clerk/notice/add', [OrganizationController::class, 'noticeadd'])->name('clerkenotice.add');
        Route::get('clerk/notice/status/{id}/{status}', [OrganizationController::class, 'statusnoticeedit'])->name('clerkenotice.status');
        Route::post('clerk/notice/update/{id}', [OrganizationController::class, 'noticeupdate'])->name('clerkenotice.update');
        // Route::get('admin/noticeedit', [OrganizationController::class, 'noticeedit']);

        // school e_news
        Route::get('clerk/e_news', [OrganizationController::class, 'schoole_news'])->name('clerkenews.index');
        Route::post('clerk/e_news/add', [OrganizationController::class, 'enewsadd'])->name('clerkenews.add');
        Route::get('clerk/e_news/status/{id}/{status}', [OrganizationController::class, 'statusenewsedit'])->name('clerkenews.status');
        Route::post('clerk/e_news/update{id}', [OrganizationController::class, 'enewsupdate'])->name('clerkenews.update');
        // Route::get('admin/e_newsedit', [OrganizationController::class, 'e_newsedit']);


        // staff
        Route::get('clerk/staffs', [StaffController::class, 'index'])->name('clerkstaffs.index');
        Route::post('clerkstaffs', [StaffController::class, 'store'])->name('clerkstaffs.store');
        Route::get('clerk/staffs/create', [StaffController::class, 'create'])->name('clerkstaffs.create');
        Route::get('clerkstaffs/{staff}', [StaffController::class, 'show'])->name('clerkstaffs.show');
        Route::put('clerk/staffs/{staff}', [StaffController::class, 'update'])->name('clerkstaffs.update');
        Route::delete('clerk/staffs/{staff}', [StaffController::class, 'destroy'])->name('clerkstaffs.destroy');
        Route::get('clerk/staffs/{staff}/edit', [StaffController::class, 'edit'])->name('clerkstaffs.edit');

        Route::get('clerk/staffsdetails', [StaffController::class, 'staffdetails']);
        Route::get('clerk/staffsdetails', [StaffController::class, 'positiondetails'])->name('clerkadmin.positionfilter');
        Route::get('clerk/staffsalary', [StaffController::class, 'staffsalary']);
        Route::post('clerk/salaryadd', [StaffController::class, 'salaryadd']);
        Route::post('clerk/staffsalary/filter', [StaffController::class, 'staffsalaryfilter'])->name('clerksalary.filter');
        Route::get('clerk/staffsalaryedit/{staff_id}/{date}', [StaffController::class, 'staffsalaryedit']);
        Route::post('clerk/staffsalaryupdate/{staff_id}', [StaffController::class, 'salaryupdate'])->name('clerksalary.update');
        Route::get('clerk/staffsalaryview', [StaffController::class, 'staffsalaryview']);
        Route::get('clerk/staffattendance', [StaffController::class, 'staffattendance']);
        Route::get('clerk/staffattendance', [StaffController::class, 'todayfilter'])->name('clerkadmin.todayfilter');

        Route::get('clerk/takeattendance', [StaffController::class, 'takeattendance']);
        Route::get('clerk/takeattendance', [StaffController::class, 'takeattendancefilter'])->name('clerkadmin.takefilter');
        Route::post('clerk/takeattendance', [StaffController::class, 'attendanceinsert'])->name('clerkadmin.attendanceinsert');

        Route::get('clerk/staffmonthlycount', [StaffController::class, 'staffmonthlycount']);
        Route::get('clerk/staffmonthlycount', [StaffController::class, 'staffmonthlycountfilter'])->name('clerk.monthlycountfilter');


        Route::get('clerk/showattendance', [StaffController::class, 'showattendance']);
        Route::get('clerk/showattendance', [StaffController::class, 'filterattendance'])->name('clerkfilterAttendance');


        // Route::get('clerk/monthlycount', [StaffController::class, 'monthlycount']);
        // Route::get('clerk/monthlycount', [StaffController::class, 'monthlycountfilter'])->name('clerk.monthlyfilter');

        Route::get('clerk/staffattendanceedit/{id}', [StaffController::class, 'staffattendanceedit']);
        Route::post('clerk/staffattendanceupdate/{id}', [StaffController::class, 'staffattendanceupdate'])->name('clerkadmin.attendaneupdate');


        Route::get('clerk/newadmissiondetails', [StudentController::class, 'newadmissiondetails'])->name('clerknewstudents.index');
        Route::get('clerk/newadmissiondetails/filter', [StudentController::class, 'newadmissiondetailsfilter'])->name('clerknewstudents.yearfilter');
        Route::get('clerk/newadmissionedit/{id}', [StudentController::class, 'newadmissionedit'])->name('clerknewstudents.edit');
        Route::get('clerk/newadmissionview/{id}', [StudentController::class, 'newadmissionview'])->name('clerknewstudents.show');
        Route::get('clerk/newadmission', [StudentController::class, 'newadmission'])->name('clerkstudents.newstudentadmission');
        Route::post('clerk/newadmission/add', [StudentController::class, 'addnewadmission'])->name('clerkstudents.addnewstudent');
        Route::post('clerk/newadmission/status', [StudentController::class, 'newadmissiontoold'])->name('clerknewstudent.status');


        //student
        Route::get('clerk/students', [StudentController::class, 'classfilter'])->name('clerkstudent.studentclassfilter');
        Route::post('clerk/students', [StudentController::class, 'store'])->name('clerkstudents.store');
        Route::get('clerk/students/create', [StudentController::class, 'create'])->name('clerkstudents.create');
        Route::get('clerk/students/{student}', [StudentController::class, 'show'])->name('clerkstudents.show');
        Route::put('clerk/students/{student}', [StudentController::class, 'update'])->name('clerkstudents.update');
        Route::delete('clerk/students/{student}', [StudentController::class, 'destroy'])->name('clerkstudents.destroy');
        Route::get('clerk/students/{student}/edit', [StudentController::class, 'edit'])->name('clerkstudents.edit');


        Route::get('clerk/studentexport', [ExcelController::class, 'studentexport'])->name('clerk.studentexport');
        Route::post('clerk/studentimport', [ExcelController::class, 'studentimport'])->name('clerk.studentimport');


        Route::post('clerk/studentstransfer/{student}', [StudentController::class, 'studenttransfer'])->name('clerkstudents.transfer');
        Route::post('clerk/studentcompleted/{student}', [StudentController::class, 'studentcompleted'])->name('clerkstudents.completed');

        // clerk
        Route::get('clerk/message', [MessagesController::class, 'messageindex']);
        Route::POST('clerk/message/add', [MessagesController::class, 'messagestore'])->name('clerk.staffmessage');
        Route::get('clerk/bulkmessage', [MessagesController::class, 'bulkclassmessage']);
        Route::POST('clerk/bulkmessage/add', [MessagesController::class, 'bulkclassmessageadd'])->name('clerk.bulkclassmessage');
        Route::get('clerk/messagedelete/{id}', [MessagesController::class, 'messagedelete']);
        Route::get('clerk/bulkclassdelete/{id}', [MessagesController::class, 'bulkclassmessagedelete']);

        //sections
        Route::get('clerk/sections', [ClassController::class, 'index'])->name('clerksections.index');
        Route::post('clerk/sections', [ClassController::class, 'store'])->name('clerksections.store');
        Route::get('clerk/sections/create', [ClassController::class, 'create'])->name('clerksections.create');
        Route::get('clerk/sections/{section}', [ClassController::class, 'show'])->name('clerksections.show');
        Route::put('clerk/sections/{section}', [ClassController::class, 'update'])->name('clerksections.update');
        Route::delete('clerk/sections/{section}', [ClassController::class, 'destroy'])->name('clerksections.destroy');
        Route::get('clerk/sections/{section}/edit', [ClassController::class, 'edit'])->name('clerksections.edit');

        Route::get('clerk/offlineexam', [ExamController::class, 'offlineexam']);
        Route::get('clerk/onlineexam', [ExamController::class, 'onlineexam']);
        Route::get('clerk/offlineexamedit/{id}', [ExamController::class, 'offlineexamedit']);
        Route::get('clerk/offlinetimetable', [ExamController::class, 'offlinetimetable']);
        Route::post('clerk/examadd', [ExamController::class, 'examadd'])->name('clerk.examadd');
        Route::get('clerk/offlinetimetable', [ExamController::class, 'offlinetimetablefilter'])->name('clerkexam.timetablefilter');
        Route::get('clerk/rowexamdelete/{id}', [ExamController::class, 'rowexamdelete']);
        Route::post('clerk/examupdate/{examid}', [ExamController::class, 'examupdate']);
    });

    //frontoffice Routes List
    Route::middleware(['auth', 'user-access:frontoffice'])->group(function () {

        Route::get('frontoffice/home', [HomeController::class, 'frontofficeHome'])->name('frontoffice.home');
        Route::get('frontoffice/school_info', [AdminController::class, 'school_info']);
        //admin visitor
        Route::get('frontoffice/visitor', [VisitorController::class, 'visitor'])->name('frontofficevisitor.index');
        Route::post('frontoffice/visitor/add', [VisitorController::class, 'visitoradd'])->name('frontofficevisitor.add');
        Route::post('frontoffice/visitor/update', [VisitorController::class, 'visitorupdate'])->name('frontofficevisitor.update');
        // Route::get('admin/visitoredit', [VisitorController::class, 'visitoredit']);

    });


    // parent or student
    Route::get('student_login', [StudentloginController::class, 'student_login']);
    Route::post('student/studenthome', [StudentloginController::class, 'login'])->name('student.studenthome');
    Route::get('student_login', [StudentloginController::class, 'logout'])->name('student.logout');

    Route::group(['middleware' => 'islogin'], function () {
        Route::get('student/studenthome', [StudentdetailsController::class, 'studenthome']);
        Route::get('student/studentattendance', [StudentdetailsController::class, 'studentattendance']);
        Route::get('student/studentattendance', [StudentdetailsController::class, 'myattendancefilter'])->name('student.myattendancefilter');
        Route::get('student/classtimetable', [StudentdetailsController::class, 'classtimetable']);

        Route::get('student/examschedule', [StudentdetailsController::class, 'examschedule']);
        Route::get('student/examschedule', [StudentdetailsController::class, 'examschedulefilter'])->name('student.examtablefilter');

        Route::get('student/exammark', [StudentdetailsController::class, 'exammark']);
        Route::get('student/exammark', [StudentdetailsController::class, 'exammarkfilter'])->name('student.exammarkfilter');


        // DAILYCONTECT
        Route::get('student/dailytopic', [StudentdetailsController::class, 'dailytopicshow']);
        Route::post('student/dailytopic', [StudentdetailsController::class, 'dailytopic'])->name('student.dailytopic');
        Route::get('student/dailytopic', [StudentdetailsController::class, 'dailytopicfilter'])->name('student.dailytopicfilter');
        Route::get('student/subject', [StudentdetailsController::class, 'subject']);

        //homework
        Route::get('student/homework', [StudentdetailsController::class, 'homework']);
        Route::get('student/homework', [StudentdetailsController::class, 'homeworkfilter'])->name('student.homeworkfilter');

        Route::get('student/feesdetails', [StudentdetailsController::class, 'feesdetails']);
        Route::get('student/sendmessage', [StudentdetailsController::class, 'sendmessage']);

        // message
        Route::get('student/messages', [StudentdetailsController::class, 'message']);
        Route::POST('student/message/add', [StudentdetailsController::class, 'messagestore'])->name('studentmessage.add');

        Route::get('student/staff', [StudentdetailsController::class, 'staff'])->name('student.staff');
    });
});
