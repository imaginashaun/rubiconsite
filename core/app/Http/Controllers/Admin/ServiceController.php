<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    public function index(){
        $page_title = "Service List";
        $empty_message = "Service List Not Found";
        $services = Service::latest()->paginate(getPaginate());
        return view('admin.service.index', compact('services', 'page_title', 'empty_message'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:191',
            'description' => 'required|max:200',
        ]);
        $service = new Service();
        $service->name = $request->name;
        $service->description = $request->description;
        $service->save();
        $notify[] = ['success', 'Service Create Successfully'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
       $request->validate([
            'id' => 'required|exists:services,id',
            'name' => 'required|max:191',
            'description' => 'required|max:200',
        ]);
        $service =Service::find($request->id);
        $service->name = $request->name;
        $service->description = $request->description;
        $service->update();
        $notify[] = ['success', 'Service Update Successfully'];
        return back()->withNotify($notify);
    }
}
