<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Enews;
use App\Models\Enotices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrganizationController extends Controller
{
    public function schoolnotice()
    {
        $enotices = Enotices::orderBy('id', 'DESC')
            ->get();


        return view('organization.notice', compact('enotices'));

        // return view('organization.notice');
    }
    public function noticeadd(Request $request)
    {

        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $created_at = new DateTime();
            $time = $created_at->format('H:i');

            $post = new Enotices;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->date = $todayDate;
            $post->time = $time;
            $post->save();

            // return response($post);
            return redirect()->back()->with('success', 'save successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save ');
        }
    }
    public function noticeupdate(Request $request, $id)
    {
        try {
            Enotices::where('id', $id)->update(['title' => $request->title, 'content' => $request->content]);
            // return response($post);
            return redirect()->back()->with('success', 'save successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save ');
        }
    }



    public function noticeedit()
    {
        return view('organization.e_newsedit');
    }
    public function schoole_news()
    {
        $enews = Enews::orderBy('id', 'DESC')
            ->get();
        // return response($visitors);
        return view('organization.e_news', compact('enews'));

        // return view('organization.e_news');
    }
    public function e_newsedit()
    {
        return view('organization.noticeedit');
    }
    public function enewsadd(Request $request)
    {
        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $created_at = new DateTime();
            $time = $created_at->format('H:i');



            $post = new Enews;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->date = $todayDate;
            $post->time = $time;
            if (!empty($request->image)) {
                $image = time() . '.' . $request->image->getClientOriginalName();
                $imagestore = uniqid() . '.' . $image; // Generate a unique filename
                $image_path = $request->image->move('organisation/enews', $imagestore);
            } else {
                $image = null;
                $image_path = null;
            }
            $post->image = $image;
            $post->image_path = $image_path;
            $post->save();

            // return response($post);
            return redirect()->back()->with('success', 'save successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save ');
        }
    }

    public function enewsupdate(Request $request, $id)
    {
        try {
            Enews::where('id', $id)->update(['title' => $request->title, 'content' => $request->content]);
            // return response($post);
            return redirect()->back()->with('success', 'save successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Not save ');
        }
    }

    // public function schoomessage()
    // {
    //     return view('message.message');
    // }
    public function statusenewsedit(Request $request)
    {
        $id = $request->id;

        $post = Enews::find($id);

        $post->status = $request->status;
        $post->save();



        return redirect()->back();
    }
    public function statusnoticeedit(Request $request)
    {
        $id = $request->id;

        $post = Enotices::find($id);

        $post->status = $request->status;
        $post->save();



        return redirect()->back();
    }
}
