<?php

use App\Models\Fees;

// use Response;
use Illuminate\Auth\Events\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\VisitorController;

use App\Http\Controllers\ExamtypeController;
use App\Http\Controllers\VechicleController;

// use App\Http\Controllers\ParentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BloodGroupController;
use App\Http\Controllers\ClassteacherController;
use App\Http\Controllers\CountryStateController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StudentloginController;
use App\Http\Controllers\StudentdetailsController;
use App\Http\Controllers\SchoolstaffloginController;
use App\Http\Controllers\MessagesController;
use App\Models\Classpromotion;

Route::get('/', [AdminController::class, 'login']);

Auth::routes();

//user Routes List
// Route::middleware(['auth', 'user-access:user'])->group(function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

Route::post('get-student-by-class', [ClassController::class, 'getstudent']);
Route::post('get-fees-by-student', [ClassController::class, 'getstudentfees']);
Route::post('get-paidfees-by-student', [ClassController::class, 'getstudentpaidfees']);
Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('fees.class');
Route::resource('examtypes', ExamtypeController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('bloodgroups', BloodGroupController::class);
Route::post('get-states-by-country', [CountryStateController::class, 'getState']);

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
    Route::get('accountant/feesform', [FeesController::class, 'feesform']);
    Route::post('accountant/addfess', [FeesController::class, 'addfees'])->name('accountant.feesadd');
    Route::get('accountant/dailyfees', [FeesController::class, 'dailyfees'])->name('accountant.daily');
    Route::post('accountant/previousdayfees', [FeesController::class, 'previousdayfees'])->name('accountant.previousday');
    Route::get('accountant/monthlyfees', [FeesController::class, 'monthlyfees']);
    Route::post('accountant/previousmonthfees', [FeesController::class, 'previousmonthfees'])->name('accountant.previousmonthfees');
    Route::get('accountant/yearlyfees', [FeesController::class, 'yearlyfees']);
    Route::post('accountant/previousyearfees', [FeesController::class, 'previousyearfees'])->name('accountant.previousyearfees');
    Route::get('accountant/paidfees', [FeesController::class, 'paidfees']);
    Route::post('accountant/paidfees', [FeesController::class, 'paidfeesfilter'])->name('accountant.studentfilter');
    // Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('accountant.class');
    // Route::post('get-student-by-class', [FeesController::class, 'getstudent'])->name('accountant.student');

    //invoice fees
    Route::get('accountantinvoice/{student}',  [FeesController::class, 'generateInvoice'])->name('accountantinvoice.generate');
});







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
    Route::resource('students', StudentController::class);

    Route::get('students', [StudentController::class, 'classfilter'])->name('admin.studentclassfilter');


    // Route::get('student/filter', [StudentController::class, 'classfilter']);

    Route::get('admin/newadmissiondetails', [StudentController::class, 'newadmissiondetails'])->name('newstudents.index');
    Route::get('admin/newadmissiondetails/filter', [StudentController::class, 'newadmissiondetailsfilter'])->name('newstudents.yearfilter');
    Route::get('admin/newadmissionedit/{id}', [StudentController::class, 'newadmissionedit'])->name('newstudents.edit');
    Route::get('admin/newadmissionview/{id}', [StudentController::class, 'newadmissionview'])->name('newstudents.show');
    Route::get('admin/newadmission', [StudentController::class, 'newadmission'])->name('students.newstudentadmission');
    Route::post('admin/newadmission/add', [StudentController::class, 'addnewadmission'])->name('students.addnewstudent');
    Route::post('admin/newadmission/status', [StudentController::class, 'newadmissiontoold'])->name('newstudent.status');


    // staff
    Route::resource('staffs', StaffController::class);

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

    Route::get('admin/takeattendance', [StaffController::class, 'takeattendance']);
    Route::get('admin/takeattendance', [StaffController::class, 'takeattendancefilter'])->name('admin.takefilter');
    Route::post('admin/takeattendance', [StaffController::class, 'attendanceinsert'])->name('admin.attendanceinsert');

    Route::get('admin/showattendance', [StaffController::class, 'showattendance']);
    Route::get('admin/showattendance', [StaffController::class, 'filterattendance'])->name('filterAttendance');

    Route::get('admin/staffattendanceedit/{id}', [StaffController::class, 'staffattendanceedit']);
    Route::post('admin/staffattendanceupdate/{id}', [StaffController::class, 'staffattendanceupdate'])->name('admin.attendaneupdate');

    // class & section
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('sections', ClassController::class);
        Route::get('/classedit/{id}', [ClassController::class, 'classedit'])->name('admin.classedit');
        Route::post('/classupdate/{id}', [ClassController::class, 'classupdate'])->name('admin.classupdate');
        Route::get('/class/{id}', [ClassController::class, 'class'])->name('class.status');

        Route::get('/studenttimetable', [ClassController::class, 'studenttimetable']);
        Route::post('/studenttimetable', [ClassController::class, 'studenttimetableinsert'])->name('admin.classtimetable');
        Route::get('/studenttimetablefilter', [ClassController::class, 'studenttimetablefilter'])->name('studenttimetable.filter');
        Route::get('/studenttimetableedit/{id}', [ClassController::class, 'studenttimetableedit'])->name('admin.classtimetableedit');
        Route::post('/studenttimetableupdate/{id}', [ClassController::class, 'studenttimetableupdate'])->name('admin.classtimetableupdate');


        Route::post('/stafftimetable', [ClassController::class, 'stafftimetableinsert'])->name('admin.stafftimetable');
        Route::get('/stafftimetable', [ClassController::class, 'stafftimetable']);
        Route::get('/stafftimetablefilter', [ClassController::class, 'stafftimetablefilter'])->name('stafftimetable.filter');
        Route::get('/stafftimetableedit/{id}', [ClassController::class, 'stafftimetableedit'])->name('admin.stafftimetableedit');
        Route::post('/stafftimetableupdate/{id}', [ClassController::class, 'stafftimetableupdate'])->name('admin.stafftimetableupdate');


        Route::get('/studentpromotion', [ClassController::class, 'studentpromotion']);

        // Classpromotion
        Route::post('/studentpromotiominsert', [ClassController::class, 'promotioninsert'])->name('admin.promotioninsert');
        Route::post('/studentpromotiondelete/{id}', [ClassController::class, 'promotiondelete'])->name('admin.promotiondelete');
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
    Route::get('admin/feesform', [FeesController::class, 'feesform']);
    Route::post('admin/addfess', [FeesController::class, 'addfees'])->name('fees.add');
    Route::get('admin/dailyfees', [FeesController::class, 'dailyfees'])->name('fees.daily');
    Route::post('admin/previousdayfees', [FeesController::class, 'previousdayfees'])->name('fees.previousday');
    Route::get('admin/monthlyfees', [FeesController::class, 'monthlyfees']);
    Route::post('admin/previousmonthfees', [FeesController::class, 'previousmonthfees'])->name('fees.previousmonthfees');
    Route::get('admin/yearlyfees', [FeesController::class, 'yearlyfees']);
    Route::post('admin/previousyearfees', [FeesController::class, 'previousyearfees'])->name('fees.previousyearfees');
    Route::get('admin/paidfees', [FeesController::class, 'paidfees']);
    Route::post('admin/paidfees', [FeesController::class, 'paidfeesfilter'])->name('fees.studentfilter');
    // Route::post('get-class-by-year', [FeesController::class, 'getclass'])->name('fees.class');
    // Route::post('get-studentold-by-class', [FeesController::class, 'getoldstudent']);

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


    Route::get('/marks/index', [ExamController::class, 'markindex']);
    Route::post('/marks/enter', [ExamController::class, 'markcreate']);
    Route::post('/marks/create', [ExamController::class, 'markadd']);
    Route::get('/marks/show', [ExamController::class, 'markshow'])->name('mark.show');
    Route::post('/marks/show', [ExamController::class, 'markshow'])->name('mark.show');

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
    Route::get('admin/message', [MessagesController::class, 'messageindex'])->name('message.index');
    Route::POST('admin/message/add', [MessagesController::class, 'messagestore'])->name('message.add');
    // Route::post('admin/message/update', [MessagesController::class, 'messageupdate'])->name('message.update');

    // adminnotice
    Route::get('/admin/notice', [OrganizationController::class, 'schoolnotice'])->name('notice.index');
    Route::post('admin/notice/add', [OrganizationController::class, 'noticeadd'])->name('enotice.add');
    Route::get('admin/notice/status/{id}/{status}', [OrganizationController::class, 'statusnoticeedit'])->name('enotice.status');
    // Route::get('admin/noticeedit', [OrganizationController::class, 'noticeedit']);

    // school e_news
    Route::get('admin/e_news', [OrganizationController::class, 'schoole_news'])->name('enews.index');
    Route::post('admin/e_news/add', [OrganizationController::class, 'enewsadd'])->name('enews.add');
    Route::get('admin/e_news/status/{id}/{status}', [OrganizationController::class, 'statusenewsedit'])->name('enews.status');
    // Route::get('admin/e_newsedit', [OrganizationController::class, 'e_newsedit']);

    //admin visitor
    Route::get('admin/visitor', [VisitorController::class, 'visitor'])->name('visitor.index');
    Route::post('admin/visitor/add', [VisitorController::class, 'visitoradd'])->name('visitor.add');
    Route::post('admin/visitor/update', [VisitorController::class, 'visitorupdate'])->name('visitor.update');
    // Route::get('admin/visitoredit', [VisitorController::class, 'visitoredit']);

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
    Route::get('classteacher/studentattendanceedit', [ClassteacherController::class, 'studentattendanceedit']);
    Route::get('classteacher/studenttakeattendance', [ClassteacherController::class, 'studenttakeattendance']);
    Route::get('classteacher/studentfilterattendance', [ClassteacherController::class, 'studentfilterattendance']);
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
        Route::resource('sections', ClassController::class);
        Route::get('/classedit/{id}', [ClassController::class, 'classedit'])->name('clerkadmin.classedit');
        Route::post('/classupdate/{id}', [ClassController::class, 'classupdate'])->name('clerkadmin.classupdate');
        Route::get('/class/{id}', [ClassController::class, 'class'])->name('clerkclass.status');

        Route::get('/studenttimetable', [ClassController::class, 'studenttimetable']);
        Route::post('/studenttimetable', [ClassController::class, 'studenttimetableinsert'])->name('clerkadmin.classtimetable');
        Route::get('/studenttimetablefilter', [ClassController::class, 'studenttimetablefilter'])->name('clerkstudenttimetable.filter');
        Route::get('/studenttimetableedit/{id}', [ClassController::class, 'studenttimetableedit'])->name('clerkadmin.classtimetableedit');
        Route::post('/studenttimetableupdate/{id}', [ClassController::class, 'studenttimetableupdate'])->name('clerkadmin.classtimetableupdate');


        Route::post('/stafftimetable', [ClassController::class, 'stafftimetableinsert'])->name('clerkadmin.stafftimetable');
        Route::get('/stafftimetable', [ClassController::class, 'stafftimetable']);
        Route::get('/stafftimetablefilter', [ClassController::class, 'stafftimetablefilter'])->name('clerkstafftimetable.filter');
        Route::get('/stafftimetableedit/{id}', [ClassController::class, 'stafftimetableedit'])->name('clerkadmin.stafftimetableedit');
        Route::post('/stafftimetableupdate/{id}', [ClassController::class, 'stafftimetableupdate'])->name('clerkadmin.stafftimetableupdate');


        Route::get('/studentpromotion', [ClassController::class, 'studentpromotion']);

        // Classpromotion
        Route::post('/studentpromotiominsert', [ClassController::class, 'promotioninsert'])->name('clerkadmin.promotioninsert');
        Route::post('/studentpromotiondelete/{id}', [ClassController::class, 'promotiondelete'])->name('clerkadmin.promotiondelete');
    });

    // adminnotice
    Route::get('clerk/notice', [OrganizationController::class, 'schoolnotice'])->name('clerknotice.index');
    Route::post('clerk/notice/add', [OrganizationController::class, 'noticeadd'])->name('clerkenotice.add');
    Route::get('clerk/notice/status/{id}/{status}', [OrganizationController::class, 'statusnoticeedit'])->name('clerkenotice.status');
    // Route::get('admin/noticeedit', [OrganizationController::class, 'noticeedit']);

    // school e_news
    Route::get('clerk/e_news', [OrganizationController::class, 'schoole_news'])->name('clerkenews.index');
    Route::post('clerk/e_news/add', [OrganizationController::class, 'enewsadd'])->name('clerkenews.add');
    Route::get('clerk/e_news/status/{id}/{status}', [OrganizationController::class, 'statusenewsedit'])->name('clerkenews.status');
    // Route::get('admin/e_newsedit', [OrganizationController::class, 'e_newsedit']);


    // staff
    // Route::resource('clerk/staffs', StaffController::class);

    Route::get('clerk/staffscreate', [StaffController::class, 'create']);
    Route::post('clerk/staffsadd', [StaffController::class, 'store']);
    Route::post('clerk/staffsupdate/{staffsid}', [StaffController::class, 'update']);
    Route::get('clerk/staffedit/{staffsid}', [StaffController::class, 'edit']);
    Route::post('clerk/staffsdelete{staffsid}', [StaffController::class, 'destroy']);
    Route::get('clerk/staffsshow{staffsid}', [StaffController::class, 'show']);


    // Route::get('admin/staffsedit', [StaffController::class, 'staffedit']);
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

    Route::get('clerk/showattendance', [StaffController::class, 'showattendance']);
    Route::get('clerk/showattendance', [StaffController::class, 'filterattendance'])->name('clerkfilterAttendance');

    Route::get('clerk/staffattendanceedit/{id}', [StaffController::class, 'staffattendanceedit']);
    Route::post('clerk/staffattendanceupdate/{id}', [StaffController::class, 'staffattendanceupdate'])->name('clerkadmin.attendaneupdate');

    //student
    Route::get('clerk/students', [StudentController::class, 'index']);
    Route::get('clerk/students', [StudentController::class, 'classfilter'])->name('clerkadmin.studentclassfilter');
    // Route::get('student/filter', [StudentController::class, 'classfilter']);

    Route::get('clerk/studentcreate', [StudentController::class, 'create']);
    Route::post('clerk/studentsadd', [StudentController::class, 'store']);
    Route::post('clerk/studentsupdate/{id}', [StudentController::class, 'update']);
    Route::get('clerk/studentsdelete/{id}', [StudentController::class, 'destroy']);
    Route::get('clerk/studentsedit/{id}', [StudentController::class, 'edit']);
    Route::get('clerk/studentshow/{id}', [StudentController::class, 'show']);

    Route::get('clerk/newadmissiondetails', [StudentController::class, 'newadmissiondetails'])->name('clerknewstudents.index');
    Route::get('clerk/newadmissiondetails/filter', [StudentController::class, 'newadmissiondetailsfilter'])->name('clerknewstudents.yearfilter');
    Route::get('clerk/newadmissionedit/{id}', [StudentController::class, 'newadmissionedit'])->name('clerknewstudents.edit');
    Route::get('clerk/newadmissionview/{id}', [StudentController::class, 'newadmissionview'])->name('clerknewstudents.show');
    Route::get('clerk/newadmission', [StudentController::class, 'newadmission'])->name('clerkstudents.newstudentadmission');
    Route::post('clerk/newadmission/add', [StudentController::class, 'addnewadmission'])->name('clerkstudents.addnewstudent');
    Route::post('clerk/newadmission/status', [StudentController::class, 'newadmissiontoold'])->name('clerknewstudent.status');
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
Route::get('student_login', [StudentdetailsController::class, 'student_login']);
Route::post('student/studenthome', [StudentloginController::class, 'login']);
Route::get('student_login', [StudentloginController::class, 'logout'])->name('student.logout');

Route::group(['middleware' => 'islogin'], function () {
    Route::get('student/studenthome', [StudentdetailsController::class, 'studenthome']);
    Route::get('student/studentattendance', [StudentdetailsController::class, 'studentattendance']);
    Route::get('student/examschedule', [StudentdetailsController::class, 'examschedule']);
    Route::get('student/classtimetable', [StudentdetailsController::class, 'classtimetable']);
    Route::get('student/exammark', [StudentdetailsController::class, 'exammark']);
    Route::get('student/feesdetails', [StudentdetailsController::class, 'feesdetails']);
    Route::get('student/sendmessage', [StudentdetailsController::class, 'sendmessage']);

    // message
    Route::get('student/messages', [StudentdetailsController::class, 'message']);
});
