<?php

namespace App\Http\Controllers\Journalist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmploymentRequest;
use App\Employment;
use Illuminate\Support\Facades\Auth;


class EmploymentController extends Controller
{

    public function employment()
    {
        $user = Auth::user();
        $page_title = "Employment History";
        $employments = Employment::where('user_id', $user->id)->latest()->get();
        return view(activeTemplate() . 'user.journalist.employment', compact('page_title', 'employments'));
    } 

    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|max:70',
            'designation' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|after:start_date',
        ]);
        $user = Auth::user();
        $employment = new Employment();
        $employment->user_id = $user->id;
        $employment->company = $request->company;
        $employment->city = $request->city;
        $employment->country = $request->country;
        $employment->designation = $request->designation;
        $employment->start_date = $request->start_date;
        $employment->end_date = $request->end_date;
        $employment->save();
        $notify[] = ['success', 'Employment History Add Successfully.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:employments,id',
            'company' => 'required|max:70',
            'designation' => 'required|max:100',
            'city' => 'required|max:100',
            'country' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|after:start_date',
        ]);
        $user = Auth::user();
        $employment =Employment::where('id', $request->id)->where('user_id', $user->id)->firstOrFail();
        $employment->user_id = $user->id;
        $employment->company = $request->company;
        $employment->city = $request->city;
        $employment->country = $request->country;
        $employment->designation = $request->designation;
        $employment->start_date = $request->start_date;
        $employment->end_date = $request->end_date;
        $employment->update();
        $notify[] = ['success', 'Employment History update Successfully.'];
        return back()->withNotify($notify);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'id' => 'required|exists:employments,id',
        ]);
        $employment = Employment::where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $employment->delete();
        $notify[] = ['success', 'Employment History Delete Successfully.'];
        return back()->withNotify($notify);
    }
}
