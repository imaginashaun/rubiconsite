<?php

namespace App\Http\Controllers\Journalist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\WorkDelivery;
use Illuminate\Support\Facades\Auth;


class WorkDeliveryController extends Controller
{

    public function workDelivery(Request $request)
    {
      $request->validate([
          'order_number' => 'required',
          'file' => 'required|mimes:zip',
          'details' => 'required|max:1000'
      ]);
      $user = Auth::user();
      $booking = Booking::where('order_number', $request->order_number)->first();
      $booking->working_status = 2;
      $booking->update();

      $work_delivery = new WorkDelivery();
      $work_delivery->journalist_id = $user->id;
      $work_delivery->booking_id = $booking->id;
      $work_delivery->details = $request->details;
      $work_delivery->approval_status='Pending Approval';
      if($request->hasFile('file')) {
         $file = $request->file;
         $extension = $file->getClientOriginalExtension();
         $filename = uniqid().'.'.$extension;
         $location = "assets/work_delivery/";
         $file->move($location, $filename);
         $work_delivery->work_file = $filename;
      }
      $work_delivery->save();
      $notify[] = ['success', 'Work File Submit'];
      return back()->withNotify($notify);
    }
}
