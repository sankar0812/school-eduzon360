<?php

namespace App\Http\Controllers;

use App\Models\Bulkclassmessage;
use App\Models\Class_section;
use App\Models\messages;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    //

    public function messageindex()
    {
        $userid = auth()->user()->id;

        $sendermessages = DB::table('messages')
            ->join('staff', 'staff.id', '=', 'messages.receiver_staff')
            ->where(['sender_admin' => $userid, 'mes_delete' => 1])
            ->select('messages.*', 'staff.sf_name as name')
            ->orderBy('id', 'DESC')
            ->get();
        $inboxmessages = DB::table('messages')
            ->join('staff', 'staff.id', '=', 'messages.sender_staff')
            ->where('receiver_admin', $userid)
            ->where('mes_delete', 1)
            ->select('messages.*', 'staff.sf_name as name')
            ->orderBy('id', 'DESC')
            ->get();
        $staffs = Staff::where('sf_delete', 1)->get();
        // return response($visitors);
        return view('message.message', compact('inboxmessages', 'staffs', 'sendermessages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function messagestore(Request $request)
    {

        $attachment =  $request->attachment;

        if ($attachment == '') {

            $attachment = NULL;
            $attachment_path = NULL;
        } else {

            $attachment = time() . '.' . $request->attachment->getClientOriginalName();
            // $profile_path = $request->s_profile->move(public_path('profiles'), $profile);
            $attachmentstore = $request->file('attachment')->storeAs('attachments', $attachment, 'public');
            $attachment_path = '/storage/' . $attachmentstore;
        }


        $post = new messages;

        $post->sender_admin = $request->sender_admin;
        $post->sender_staff = $request->sender_staff;
        $post->sender_student = $request->sender_student;
        $post->receiver_admin = $request->receiver_admin;
        $post->receiver_staff = $request->receiver_staff;
        $post->receiver_student = $request->receiver_student;
        $post->subject = $request->subject;
        $post->message = $request->message;
        $post->attachment = $attachment;
        $post->attachment_path = $attachment_path;
        $post->datetime = date('D, M d,Y  h:i A');
        $post->save();



        return redirect()->back()

            ->with('success', 'Message Send successfully.');
    }


    public function staffmessageindex()
    {
        $userid = auth()->user()->id;

        $sendermessagesstudent = DB::table('messages')
            // ->join('staff', 'staff.id', '=', 'messages.receiver_staff')
            ->join('students', 'students.id', '=', 'messages.receiver_student')
            ->where('messages.sender_staff', $userid)
            ->where('mes_delete', 1)
            ->select('messages.*', 'students.s_name as name', 'students.id', 'messages.id')
            ->orderBy('messages.id', 'DESC')
            ->get();

        // dd($sendermessages);
        $sendermessagesstaff = DB::table('messages')
            ->join('staff', 'staff.login_id', '=', 'messages.receiver_staff')
            // ->join('students', 'students.id', '=', 'messages.receiver_student')
            ->where('messages.sender_staff', $userid)
            ->where('mes_delete', 1)
            ->select('messages.*', 'staff.sf_name as name')
            ->orderBy('messages.id', 'DESC')
            ->get();
        // $inboxmessagesstudent = DB::table('messages')
        //     ->join('students', 'students.id', '=', 'messages.sender_student')
        //     ->where('messages.receiver_staff', $userid)
        //     ->where('mes_delete', 1)
        //     ->select('messages.*', 'students.s_name as name', 'students.id', 'messages.id')
        //     ->orderBy('messages.id', 'DESC')
        //     ->get();
        // $inboxmessagesstaff = DB::table('messages')
        //     ->join('staff', 'staff.login_id', '=', 'messages.sender_staff')
        //     ->where('messages.receiver_staff', $userid)
        //     ->where('mes_delete', 1)
        //     ->select('messages.*', 'staff.sf_name as name')
        //     ->orderBy('messages.id', 'DESC')
        //     ->get();
        // $inboxmessagesadmin = DB::table('messages')
        //     ->join('users', 'users.id', '=', 'messages.sender_admin')
        //     ->where('messages.receiver_staff', $userid)
        //     ->where('mes_delete', 1)
        //     ->select('messages.*', 'users.name', 'users.id')
        //     ->orderBy('messages.id', 'DESC')
        //     ->get();
        $inboxmessages = DB::table('messages')
        ->leftJoin('students', 'students.id', '=', 'messages.sender_student')
        ->leftJoin('staff', 'staff.login_id', '=', 'messages.sender_staff')
        ->leftJoin('users', 'users.id', '=', 'messages.sender_admin')
        ->where('messages.receiver_staff', $userid)
        ->where('mes_delete', 1)
        ->select('messages.id', 'messages.message', 'messages.datetime', 'messages.mes_delete',
            DB::raw('CASE 
                        WHEN students.id IS NOT NULL THEN students.s_name
                        WHEN staff.sf_name IS NOT NULL THEN staff.sf_name
                        WHEN users.name IS NOT NULL THEN users.name
                    END AS name'),
            DB::raw('CASE 
                        WHEN students.id IS NOT NULL THEN "student"
                        WHEN staff.sf_name IS NOT NULL THEN "staff"
                        WHEN users.name IS NOT NULL THEN "admin"
                    END AS sender_type')
        )
        ->orderBy('messages.id', 'DESC')
        ->get();
    // 'inboxmessagesadmin', 'inboxmessagesstudent', 'inboxmessagesstaff', 

        // dd($userid);
        $staffs = Staff::where('sf_delete', 1)
        ->where('login_id', '!=', $userid)
        ->get();
    
        $class = Class_section::where(['c_status' => 1, 'c_delete' => 1])->get();
// dd($staffs);

        $students = Student::where('s_delete', 1)->get();
        // return response($sendermessagesstaff);
        return view('classteacher.message.message', compact('class','inboxmessages','staffs', 'sendermessagesstaff', 'sendermessagesstudent', 'students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function staffmessagestore(Request $request)
    {

        $attachment =  $request->attachment;

        if ($attachment == '') {

            $attachment = NULL;
            $attachment_path = NULL;
        } else {

            $attachment = time() . '.' . $request->attachment->getClientOriginalName();
            // $profile_path = $request->s_profile->move(public_path('profiles'), $profile);
            $attachmentstore = $request->file('attachment')->storeAs('attachments', $attachment, 'public');
            $attachment_path = '/storage/' . $attachmentstore;
        }


        $post = new messages;

        $post->sender_admin = $request->sender_admin;
        $post->sender_staff = $request->sender_staff;
        $post->sender_student = $request->sender_student;
        $post->receiver_admin = $request->receiver_admin;
        $post->receiver_staff = $request->receiver_staff;
        $post->receiver_student = $request->receiver_student;
        $post->subject = $request->subject;
        $post->message = $request->message;
        $post->attachment = $attachment;
        $post->attachment_path = $attachment_path;
        $post->datetime = date('D, M d,Y  h:i A');


        // return response($post);
        $post->save();



        return redirect()->back()

            ->with('success', 'Message Send successfully.');
    }

    public function bulkclassmessage()
    {
        $month = date('m');
        $year = date('Y');
        $shortYear = date('y');

        if ($month >= "06") {
            $fyear = $year . '-' . ($shortYear + 1);
        } else {
            $fyear = ($year - 1) . '-' . $shortYear;
        }

        $class = Class_section::where(['c_status' => 1, 'c_delete' => 1])->get();
        $bulkclass = DB::table('bulkclassmessages')
            ->join('class_sections', 'class_sections.id', '=', 'bulkclassmessages.bcm_classid')
            ->select('class_sections.c_class', 'bulkclassmessages.bcm_message', 'bulkclassmessages.datetime', 'bulkclassmessages.bcm_subject', 'bulkclassmessages.id')
            ->where(['bulkclassmessages.bcm_year' => $fyear, 'bulkclassmessages.bcm_delete' => 1])
            ->orderBy('datetime', 'DESC')
            ->get();

        return view('message.bulkclassmessage', compact('class', 'bulkclass'));
    }

    public function bulkclassmessageadd(Request $request)
    {
        try {
            $month = date('m');
            $year = date('Y');
            $shortYear = date('y');

            if ($month >= "06") {
                $fyear = $year . '-' . ($shortYear + 1);
            } else {
                $fyear = ($year - 1) . '-' . $shortYear;
            }

            $post = new Bulkclassmessage();

            $post->bcm_senderid = $request->sender_admin;
            $post->bcm_classid = $request->receiver_class;
            $post->bcm_subject = $request->subject;
            $post->bcm_message = $request->message;
            $post->bcm_year = $fyear;
            $post->datetime = date('D, M d,Y  h:i A');
            $post->save();

            return redirect()->back()
                ->with('success', 'Message Send successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Send');
        }
    }


    public function bulkclassmessagedelete($id)
    {
        try {
            $bulkclassdelete = Bulkclassmessage::where('id', $id)->update(['bcm_delete' => 0]);

            return redirect()->back()
                ->with('success', 'Message Delete.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Delete');
        }
    }

    public function messagedelete($id)
    {
        try {
            $messagedelete = messages::where('id', $id)->update(['mes_delete' => 0]);

            return redirect()->back()
                ->with('success', 'Message Delete.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not Delete');
        }
    }
}
