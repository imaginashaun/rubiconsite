<?php

namespace App\Http\Controllers\Journalist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Storie;
use App\Category;
use Illuminate\Support\Facades\Auth;


class StoriesController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $page_title = "All Stories";
        $stories = Storie::where('user_id', $user->id)->latest()->paginate(getPaginate());
        return view(activeTemplate() . 'user.journalist.stories.index', compact('page_title', 'stories'));
    }

    public function details($id, $slug)
    {
        $page_title = "Stroy Details";
        $storie = Storie::findOrFail($id);
        return view(activeTemplate() . 'user.journalist.stories.details', compact('storie', 'page_title'));
    }

    public function create()
    {
        $page_title = "Add Story";
        $category = Category::select('id', 'name')->get();
        return view(activeTemplate() . 'user.journalist.stories.create', compact('page_title', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:200',
            'description' => 'required|max:5000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $storie = new Storie();
        $storie->user_id =  Auth::user()->id;
        $storie->category_id = $request->category_id;
        $path = imagePath()['stories']['path'];
        $size = imagePath()['stories']['size'];
        if($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, '385x355');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $storie->image = $filename;
        }
        $storie->title = $request->title;
        $storie->description = $request->description;
        $storie->save();
        $notify[] = ['success', 'Stories Create Successfully.'];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = "Update Story";
        $storie = Storie::findOrFail($id);
        $category = Category::select('id', 'name')->get();
        return view(activeTemplate() . 'user.journalist.stories.edit', compact('page_title', 'storie', 'category'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:200',
            'description' => 'required|max:5000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $storie = Storie::where('id',$id)->where('user_id', $user->id)->firstOrFail();
        $storie->user_id =  $user->id;
        $storie->category_id = $request->category_id;
        $path = imagePath()['stories']['path'];
        $size = imagePath()['stories']['size'];
        if($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $storie->image, '385x355');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $storie->image = $filename;
        }
        $storie->title = $request->title;
        $storie->description = $request->description;
        $storie->status = 0;
        $storie->update();
        $notify[] = ['success', 'Stories Update Successfully.'];
        return back()->withNotify($notify);
    }

    public function storieDelete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'id' => 'required|exists:stories,id',
        ]);
        $storie = Storie::where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $storie->delete();
        $notify[] = ['success', 'Stories Delete Successfully.'];
        return back()->withNotify($notify);
    }
}
