<?php

namespace App\Http\Controllers\Journalist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Education;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $page_title = "Educational History";
        $educations = Education::where('user_id', $user->id)->latest()->get();
        return view(activeTemplate() . 'user.journalist.education', compact('page_title', 'educations'));
    } 

    public function store(Request $request)
    {
        $request->validate([
            'school' => 'required|max:70',
            'subject' => 'required|max:70',
            'from_year' => 'required|date_format:Y-m-d',
            'to_year' => 'required|after:from_year'
        ]);
        $user = Auth::user();
        $education = new Education();
        $education->user_id = $user->id;
        $education->school = $request->school;
        $education->subject = $request->subject;
        $education->from_year = $request->from_year;
        $education->to_year = $request->to_year;
        $education->save();
        $notify[] = ['success', 'Education Add Successfully.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:educations,id',
            'school' => 'required|max:70',
            'subject' => 'required|max:70',
            'from_year' => 'required|date_format:Y-m-d',
            'to_year' => 'required|after:from_year'
        ]);
        $user = Auth::user();
        $education = Education::where('user_id', $user->id)->where('id', $request->id)->firstOrFail();
        $education->user_id = $user->id;
        $education->school = $request->school;
        $education->subject = $request->subject;
        $education->from_year = $request->from_year;
        $education->to_year = $request->to_year;
        $education->save();
        $notify[] = ['success', 'Education Add Successfully.'];
        return back()->withNotify($notify);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'id' => 'required|exists:educations,id'
        ]);
        $education = Education::where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $education->delete();
        $notify[] = ['success', 'Education Delete Successfully.'];
        return back()->withNotify($notify);
    }
}
