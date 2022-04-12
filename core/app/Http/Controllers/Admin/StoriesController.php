<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Storie;

class StoriesController extends Controller
{

    public function index()
    {
        $empty_message = "No Data Fouond";
        $page_title = "Journalist All Stories";
        $stories = Storie::latest()->with('category', 'journalist')->paginate(getPaginate());
        return view('admin.storie.index', compact('stories', 'page_title', 'empty_message'));
    }

    public function pending()
    {
        $empty_message = "Pending Storie Not Found";
        $page_title = "Journalist Pending Stories";
        $stories = Storie::where('status', 0)->with('category', 'journalist')->paginate(getPaginate());
        return view('admin.storie.index', compact('stories', 'page_title', 'empty_message'));
    }

    public function approved()
    {
        $empty_message = "Not Data Found";
        $page_title = "Journalist Approved Stories";
        $stories = Storie::where('status', 1)->with('category', 'journalist')->paginate(getPaginate());
        return view('admin.storie.index', compact('stories', 'page_title', 'empty_message'));
    }

    public function detail($id)
    {
        $page_title = "Storie Detail";
        $storie = Storie::where('id', $id)->firstOrFail();
        return view('admin.storie.details', compact('page_title', 'storie'));
    }

    public function approvedBy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:stories,id'
        ]);
        $storie = Storie::where('id', $request->id)->first();
        $storie->status = 1;
        $storie->update();
        $notify[] = ['success', 'Storie Approved Successfully.'];
        return back()->withNotify($notify);
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        $page_title = '';
        $empty_message = 'No search result was found.';
        $stories = Storie::whereHas('journalist', function($q) use ($search){
            $q->where('username', $search);
        })->OrwhereHas('category', function($q) use ($search){
            $q->where('name', 'like', "%$search%");
        });
        switch ($scope) {
            case 'index':
                $page_title .= 'Journalist All Stories Search';
                break;
            case 'approved':
                $page_title .= 'Journalist Approved Stories Search';
                $stories = $stories->where('status', 1);
                break;
            case 'pending':
                $page_title .= 'Journalist Pending Stories Search';
                $stories = $stories->where('status', 0);
                break;
        }
        $stories = $stories->with('category', 'journalist')->paginate(getPaginate());
        $page_title .= ' - ' . $search;
        return view('admin.storie.index', compact('page_title', 'search', 'scope', 'empty_message', 'stories'));
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:stories,id'
        ]);
       $storie = Storie::find($request->id);
       $storie->delete();
       $notify[] = ['success', 'Storie Delete Successfully.'];
       return back()->withNotify($notify);
    }

}
