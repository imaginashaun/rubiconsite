<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JournalistWorkFile;

class WorkController extends Controller
{
    
    public function video()
    {
    	$page_title = "Journalist Videos Work List";
    	$empty_message = "No Data Found";
    	$videos = JournalistWorkFile::whereNotNull('video_file')->latest()->paginate(getPaginate());
    	return view('admin.work.video', compact('page_title', 'empty_message', 'videos'));
    }

    public function videoDetail($id)
    {
        $page_title = "Journalist Video Work Detail";
        $video = JournalistWorkFile::whereNotNull('video_file')->where('id', $id)->firstOrFail();
        return view('admin.work.video_detail', compact('page_title', 'video'));
    }

    public function videoApprovedBy(Request $request)
    {
    	$request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $videos = JournalistWorkFile::find($request->id);
        $videos->status = 1;
        $videos->save();
        $notify[] = ['success', 'Video Approved Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function videoDelete(Request $request)
    {
    	$request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $videos = JournalistWorkFile::find($request->id);
        $videos->delete();
        $notify[] = ['success', 'Video Delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }


    public function audio()
    {
    	$page_title = "Journalist Audios Work List";
    	$empty_message = "No Data Found";
    	$audios = JournalistWorkFile::whereNotNull('audio_file')->latest()->paginate(getPaginate());
    	return view('admin.work.audio', compact('page_title', 'empty_message', 'audios'));
    }

    public function audioDetail($id)
    {
        $page_title = "Journalist audio Work Detail";
        $audio = JournalistWorkFile::whereNotNull('audio_file')->where('id', $id)->firstOrFail();
        return view('admin.work.audio_detail', compact('page_title', 'audio'));
    }

    public function audioApprovedBy(Request $request)
    {
    	$request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $videos = JournalistWorkFile::find($request->id);
        $videos->status = 1;
        $videos->save();
        $notify[] = ['success', 'Audio Approved Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function audioDelete(Request $request)
    {
    	$request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $videos = JournalistWorkFile::find($request->id);
        $videos->delete();
        $notify[] = ['success', 'Audio Delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function blog()
    {
    	$page_title = "Journalist Blogs Work List";
    	$empty_message = "No Data Found";
    	$blogs = JournalistWorkFile::whereNotNull('blog_link')->latest()->paginate(getPaginate());
    	return view('admin.work.blog', compact('page_title', 'empty_message', 'blogs'));
    }

    public function blogDetail($id)
    {
        $page_title = "Journalist Blog Detail";
        $blog = JournalistWorkFile::whereNotNull('blog_link')->where('id', $id)->firstOrFail();
        return view('admin.work.blog_detail', compact('page_title', 'blog'));
    }

    public function blogApprovedBy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $blogs = JournalistWorkFile::find($request->id);
        $blogs->status = 1;
        $blogs->save();
        $notify[] = ['success', 'Blog Approved Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function blogDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $blogs = JournalistWorkFile::find($request->id);
        $blogs->delete();
        $notify[] = ['success', 'Blog Delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
    
    public function image()
    {
    	$page_title = "Journalist Images Work List";
    	$empty_message = "No Data Found";
    	$images = JournalistWorkFile::whereNotNull('image')->latest()->paginate(getPaginate());
    	return view('admin.work.image', compact('page_title', 'empty_message', 'images'));
    }

    public function imageDetail($id)
    {
        $page_title = "Journalist Image Detail";
        $ima = JournalistWorkFile::whereNotNull('image')->where('id', $id)->firstOrFail();
        return view('admin.work.image_detail', compact('page_title', 'ima'));
    }

    public function imageApprovedBy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $images = JournalistWorkFile::find($request->id);
        $images->status = 1;
        $images->save();
        $notify[] = ['success', 'Image Approved Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function imageDelete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:journalist_work_files,id'
        ]);
        $images = JournalistWorkFile::find($request->id);
        $images->delete();
        $notify[] = ['success', 'Image Delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
