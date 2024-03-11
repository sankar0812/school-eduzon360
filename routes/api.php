<?php

use App\Http\Controllers\Api\ClassteacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FeesController;
use App\Http\Controllers\Api\StudentloginController;
use App\Http\Controllers\Api\StudentdetailsController;
use App\Http\Middleware\IsLoginMiddleware; // Make sure to import the correct middleware
use Spatie\FlareClient\Api;

// Route::post('getstudentfeebalance', [FeesController::class, 'StudentFeeBalance'])->name('getstudentfeebalance');

Route::group(['middleware' => 'checkLoginStatus'], function () {

    Route::post('parent/login', [StudentloginController::class, 'login'])->name('login');


    Route::get('parent/studenthome', [StudentdetailsController::class, 'studenthome']);
    Route::get('parent/studentattendance', [StudentdetailsController::class, 'myattendancefilter'])->name('student.myattendancefilter');
    Route::get('parent/classtimetable', [StudentdetailsController::class, 'classtimetable']);

    Route::get('parent/examyeartype', [StudentdetailsController::class, 'examyeartype'])->name('student.examyeartype');
    Route::get('parent/exammark', [StudentdetailsController::class, 'exammarkfilter'])->name('student.examtablefilter');
    Route::get('parent/examschedule', [StudentdetailsController::class, 'examschedulefilter'])->name('student.examtablefilter');

    Route::get('parent/staff', [StudentdetailsController::class, 'staff'])->name('student.staff');
    Route::get('parent/dailytopic', [StudentdetailsController::class, 'dailytopic'])->name('student.dailytopic');
    Route::get('parent/homework', [StudentdetailsController::class, 'homework']);

    Route::get('parent/StudentFeeBalance', [StudentdetailsController::class, 'feesDetails']);

    Route::get('parent/messages', [StudentdetailsController::class, 'message']);
    Route::post('parent/messageadd', [StudentdetailsController::class, 'messagestore'])->name('studentmessage.add');

    Route::get('parent/studenttransport', [StudentdetailsController::class, 'studenttransport']);

    Route::get('parent/fullexamtype', [StudentdetailsController::class, 'fullexamtype']);

    Route::get('parent/attendancemonth', [StudentdetailsController::class, 'attendancemonth']);

    //  login
    Route::post('parent/loginotpsent', [StudentloginController::class, 'loginotpsent'])->name('loginotpsent');
    Route::post('parent/checkotplogin', [StudentloginController::class, 'checkotplogin'])->name('checkotplogin');

    Route::get('student/subject', [StudentdetailsController::class, 'subject']);

    //homework
    Route::get('student/homework', [StudentdetailsController::class, 'homework']);
    Route::get('student/homework', [StudentdetailsController::class, 'homeworkfilter'])->name('student.homeworkfilter');

    Route::get('student/feesdetails', [StudentdetailsController::class, 'feesdetails']);
    Route::get('student/sendmessage', [StudentdetailsController::class, 'sendmessage']);

    // message
    Route::get('student/messages', [StudentdetailsController::class, 'message']);
    Route::POST('student/message/add', [StudentdetailsController::class, 'messagestore'])->name('studentmessage.add');

    Route::get('student/sendmessage', [StudentdetailsController::class, 'sendmessage']);
});


//staff Routes List
//    Route::middleware(['auth', 'user-access:staff'])->group(function () {

Route::post('classteacher/login', [ClassteacherController::class, 'classteacherlogin']);
Route::get('classteacher/details', [ClassteacherController::class, 'classteacherdetails']);

// dailycontent

Route::get('classteacher/class_subject', [ClassteacherController::class, 'class_subject']);

Route::get('classteacher/dailycontentfilter', [ClassteacherController::class, 'dailycontentfilter']);
Route::post('classteacher/dailycontentadd', [ClassteacherController::class, 'dailycontentadd']);

// home work
// Route::get('classteacher/dailyhomework', [ClassteacherController::class, 'homework']);
Route::get('classteacher/homeworkfilter', [ClassteacherController::class, 'homeworkfilter']);
Route::post('classteacher/homeworkadd', [ClassteacherController::class, 'homeworkadd']);

Route::get('classteacher/dailytimetable', [ClassteacherController::class, 'classteacherdailytimetable']);
Route::get('classteacher/studenttimetable', [ClassteacherController::class, 'studenttimetable']);

Route::get('classteacher/myattendance', [ClassteacherController::class, 'myattendancefilter']);
Route::get('classteacher/staffclass', [ClassteacherController::class, 'staffclass']);
Route::get('classteacher/examtype', [ClassteacherController::class, 'examtype']);
Route::post('classteacher/markadd', [ClassteacherController::class, 'markadd']);
Route::get('classteacher/markshowfilter', [ClassteacherController::class, 'markshowfilter']);

Route::get('classteacher/messages', [ClassteacherController::class, 'message']);
Route::post('classteacher/messageadd', [ClassteacherController::class, 'messagestore'])->name('teachermessage.add');

Route::get('classteacher/stafflist', [ClassteacherController::class, 'stafflist']);
Route::get('classteacher/academicyear', [ClassteacherController::class, 'academicyear']);

Route::post('classteacher/attendanceadd', [ClassteacherController::class, 'attendanceinsert']);
Route::get('classteacher/monthattendancefilter', [ClassteacherController::class, 'monthattendancefilter']);
Route::get('classteacher/dashboardattendance', [ClassteacherController::class, 'dashboardattendance']);

    // // Route::get('/classteacher/home', [HomeController::class, 'classteacherHome'])->name('manager.home');
    // Route::get('/classteacher/home', [HomeController::class, 'classteacherHome'])->name('staff.home');
    // // Route::get('classteacher/inbox', [ClassteacherController::class, 'classteacherinbox']);
    // // Route::get('classteacher/sent', [ClassteacherController::class, 'classteachersent']);
    // Route::get('classteacher/message', [MessagesController::class, 'staffmessageindex'])->name('staffmessage.index');
    // Route::POST('classteacher/message/add', [MessagesController::class, 'staffmessagestore'])->name('staffmessage.add');
    // Route::get('classteacher/dailytimetable', [ClassteacherController::class, 'classteacherdailytimetable']);
    // Route::get('classteacher/studenttimetable', [ClassteacherController::class, 'studenttimetable']);
    // Route::get('classteacher/studenttimetable', [ClassteacherController::class, 'studenttimetablefilter'])->name('staff.timetablefilter');
    // Route::get('classteacher/studentattendance', [ClassteacherController::class, 'studentattendance']);
    // Route::get('classteacher/studentattendance', [ClassteacherController::class, 'studentattendancefilter'])->name('classteacher.studentdetailfilter');
    // Route::get('classteacher/studenttakeattendance', [ClassteacherController::class, 'studenttakeattendance']);
    // Route::get('classteacher/studenttakeattendance', [ClassteacherController::class, 'takeattendancefilter'])->name('classteacher.attendancetakefilter');
    // Route::post('classteacher/studenttakeattendanceinsert', [ClassteacherController::class, 'takeattendanceinsert'])->name('classteacher.attendancetakeinsert');
    // Route::get('classteacher/studentattendanceedit', [ClassteacherController::class, 'studentattendanceedit']);
    // Route::get('classteacher/studentfilterattendance', [ClassteacherController::class, 'studentfilterattendance']);
    // Route::get('classteacher/studentfilterattendance', [ClassteacherController::class, 'monthattendancefilter'])->name('classteacher.monthattendancefilter');


    // Route::get('classteacher/monthlycount', [ClassteacherController::class, 'monthlycount']);
    // Route::get('classteacher/monthlycount', [ClassteacherController::class, 'monthlycountfilter'])->name('classteacher.monthlycountfilter');

    // //staff attendance view
    // Route::get('classteacher/myattendance', [ClassteacherController::class, 'myattendance']);
    // Route::get('classteacher/myattendance', [ClassteacherController::class, 'myattendancefilter'])->name('classteacher.myattendancemonth');

    // //  staff login
    // Route::get('classteacher/studentdetailslist', [ClassteacherController::class, 'studentdetailslist']);
    // Route::get('classteacher/studentdetailslist', [ClassteacherController::class, 'studentdetailslistfilter'])->name('classteacher.studentclassfilter');
    // Route::get('classteacher/status/{id}', [ClassteacherController::class, 'studentstatus']);
    // Route::get('classteacher/studentdetailsview/{id}', [ClassteacherController::class, 'studentdetailsview']);

    // // dailycontent
    // Route::get('classteacher/dailycontent', [StudymaterialController::class, 'dailycontent']);
    // Route::get('classteacher/dailycontent', [StudymaterialController::class, 'dailycontentfilter'])->name('classteacher.dailycontentfilter');
    // Route::post('classteacher/dailycontentadd', [StudymaterialController::class, 'dailycontentadd']);
    // Route::get('classteacher/dailycontentview/{viewid}', [StudymaterialController::class, 'dailycontentview']);

    // // home work
    // Route::get('classteacher/dailyhomework', [StudymaterialController::class, 'homework']);
    // Route::get('classteacher/dailyhomework', [StudymaterialController::class, 'homeworkfilter'])->name('classteacher.homeworkfilter');
    // Route::post('classteacher/homeworkadd', [StudymaterialController::class, 'homeworkadd']);

    // // exam
    // Route::get('classteacher/index', [ExamController::class, 'markindex']);
    // Route::get('marks/enter', [ExamController::class, 'markcreate']);
    // Route::post('marks/create', [ExamController::class, 'markaddinsert'])->name('classteacher.create');
    // Route::get('/marks/show', [ExamController::class, 'markshow']);
    // Route::get('/marks/show', [ExamController::class, 'markshowfilter'])->name('marks.show');
    // Route::get('classteacher/edit/{markid}', [ExamController::class, 'markedit']);
    // Route::get('dailyexam/edit/{markid}', [ExamController::class, 'dailymarkedit']);
    // Route::post('marks/update/{markid}', [ExamController::class, 'markupdate'])->name('classteacher.update');
// });
