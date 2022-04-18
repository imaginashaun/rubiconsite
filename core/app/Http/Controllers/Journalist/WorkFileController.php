<?php

namespace App\Http\Controllers\Journalist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JournalistWorkFile;
use Illuminate\Support\Facades\Auth;


class WorkFileController extends Controller
{
    public function __construct()
    {
      $this->activeTemplate = activeTemplate();
    }

    public function videoWork()
    {
        $user = Auth::user();
        $page_title = 'Video Work list';
        $video_file = JournalistWorkFile::whereNotNull('video_file')->where('user_id', $user->id)->paginate(getPaginate());
        return view($this->activeTemplate . 'user.journalist.work_file.video', compact('page_title', 'video_file'));
    }

    public function videoDetails($id)
    {
        $user = Auth::user();
        $page_title = 'Video Details';
        $video_details = JournalistWorkFile::whereNotNull('video_file')->where('id',$id)->where('user_id', $user->id)->firstOrFail();
        return view($this->activeTemplate . 'user.journalist.work_file.video_details', compact('page_title', 'video_details'));
    }

    public function videoDelete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'id' => 'required|exists:journalist_work_files,id',
        ]);
        $video = JournalistWorkFile::whereNotNull('video_file')->where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $video->delete();
        $notify[] = ['success', 'Video File Delete Successfully'];
        return back()->withNotify($notify);
    }

    public function audioWork()
    {
        $user = Auth::user();
        $page_title = 'Audio';
        $audio_file = JournalistWorkFile::whereNotNull('audio_file')->where('user_id', $user->id)->paginate(getPaginate());
        return view($this->activeTemplate . 'user.journalist.work_file.audio', compact('page_title', 'audio_file'));
    }

    public function audioDetails($id)
    {
        $user = Auth::user();
        $page_title = 'Audio Details';
        $audio_details = JournalistWorkFile::whereNotNull('audio_file')->where('id',$id)->where('user_id', $user->id)->firstOrFail();;
        return view($this->activeTemplate . 'user.journalist.work_file.audio_details', compact('page_title', 'audio_details'));
    }

    public function audioDelete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
          'id' => 'required|exists:journalist_work_files,id',
        ]);
        $audio = JournalistWorkFile::whereNotNull('audio_file')->where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $audio->delete();
        $notify[] = ['success', 'Audio File Delete Successfully'];
        return back()->withNotify($notify);
    }

    public function imageWork()
    {
        $user = Auth::user();
        $page_title = 'Images';
        $image_file = JournalistWorkFile::whereNotNull('image')->where('user_id', $user->id)->paginate(getPaginate());
        return view($this->activeTemplate . 'user.journalist.work_file.image', compact('page_title', 'image_file'));
    }

    public function imageDetails($id)
    {
        $user = Auth::user();
        $page_title = 'Video Details';
        $image_details = JournalistWorkFile::whereNotNull('image')->where('id', $id)->where('user_id', $user->id)->firstOrFail();;
        return view($this->activeTemplate . 'user.journalist.work_file.image_details', compact('page_title', 'image_details'));
    }

    public function imageDelete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
          'id' => 'required|exists:journalist_work_files,id',
        ]);
        $image = JournalistWorkFile::whereNotNull('image')->where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $image->delete();
        $notify[] = ['success', 'Image Work Delete Successfully'];
        return back()->withNotify($notify);
    }

    public function blogWork()
    {
        $user = Auth::user();
        $page_title = 'Articles';
        $blog = JournalistWorkFile::whereNotNull('blog_link')->where('user_id', $user->id)->paginate(getPaginate());
        return view($this->activeTemplate . 'user.journalist.work_file.blog', compact('page_title', 'blog'));
    }

    public function blogDetails($id)
    {
        $user = Auth::user();
        $page_title = 'Article Details';
        $blog_details = JournalistWorkFile::whereNotNull('blog_link')->where('id', $id)->where('user_id', $user->id)->firstOrFail();
        return view($this->activeTemplate . 'user.journalist.work_file.blog_details', compact('page_title', 'blog_details'));
    }

    public function blogDelete(Request $request)
    {
        $user = Auth::user();
        $request->validate([
          'id' => 'required|exists:journalist_work_files,id',
        ]);
        $blog = JournalistWorkFile::whereNotNull('blog_link')->where('id',$request->id)->where('user_id', $user->id)->firstOrFail();
        $blog->delete();
        $notify[] = ['success', 'Blog Delete Successfully'];
        return back()->withNotify($notify);
    }

    public function workFile(Request $request)
    {
      	$allRequest = $request->all();
      	if(array_key_exists('video', $allRequest))
      	{
        	$this->videoFileUpload($request);
        	$notify[] = ['success', 'Video Created.'];
        	return back()->withNotify($notify);
      	}
      	elseif(array_key_exists('audio', $allRequest))
        {
    		$this->audioFileUpload($request);
    		$notify[] = ['success', 'Work Audio File Create.'];
   			return back()->withNotify($notify);
      	}
      	elseif(array_key_exists('blog', $allRequest))
      	{
    		$this->blogFileUpload($request);
    		$notify[] = ['success', 'Blog Create.'];
    		return back()->withNotify($notify);
      	}

      	elseif(array_key_exists('images', $allRequest))
      	{
    		$this->imageFileUpload($request);
    		$notify[] = ['success', 'Image Created.'];
    		return back()->withNotify($notify);
      	}
      	else
      	{
      		abort(404);
      	}
    }

    public function workFileUpdate(Request $request)
    {
      	$allRequest = $request->all();
      	if(array_key_exists('video', $allRequest))
      	{
    		$this->videoFileUpdate($request);
    	 	$notify[] = ['success', 'Video Link Updated.'];
    		return back()->withNotify($notify);
      	}
      	elseif(array_key_exists('audio', $allRequest))
      	{
    		$this->audioFileUpdate($request);
    		$notify[] = ['success', 'Audio File Updated.'];
   			return back()->withNotify($notify);
      	}
      	elseif(array_key_exists('blog', $allRequest))
      	{
    		$this->blogFileUpdate($request);
    		$notify[] = ['success', 'Article Updated.'];
    		return back()->withNotify($notify);
      	}

      	elseif(array_key_exists('images', $allRequest))
      	{
    		$this->imageUpdate($request);
    		$notify[] = ['success', 'Image Updated.'];
    		return back()->withNotify($notify);
      	}
      	else
      	{
      		abort(404);
      	}
    }

    public function videoFileUpload($request)
    {
        $user = Auth::user();
      	$request->validate([
            'video' => 'required|in:video',
        	  'title' => 'required|max:250',
        	  'video_link' =>'required|url|max:250',
        	  'descripation' => 'required|max:5000',
            'background_image' => 'required|mimes:jpeg,png,jpg',
      	]);
      	$uploadeVideo = new JournalistWorkFile();
      	$uploadeVideo->user_id = $user->id;
      	$uploadeVideo->title = $request->title;
      	$uploadeVideo->video_file = $request->video_link;
        $path = imagePath()['work_background']['path'];
        $size = imagePath()['work_background']['size'];
        if($request->hasFile('background_image')) {
            try {
                $filename = uploadImage($request->background_image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $uploadeVideo->background_image = $filename;
        }
      	$uploadeVideo->descripation = $request->descripation;
      	$uploadeVideo->save();
        return back();
    }

    public function videoFileUpdate($request)
    {
        $user = Auth::user();
        $request->validate([
            'id' => 'required|exists:journalist_work_files,id',
            'video' => 'required|in:video',
            'title' => 'required|max:250',
            'video_link' =>'required|url|max:250',
            'descripation' => 'required|max:5000',
            'background_image' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $videoUpdate = JournalistWorkFile::where('id', $request->id)->whereNotNull('video_file')->where('user_id', $user->id)->firstOrFail();
        $videoUpdate->user_id = $user->id;
        $videoUpdate->title = $request->title;
        $videoUpdate->video_file = $request->video_link;
        $path = imagePath()['work_background']['path'];
        $size = imagePath()['work_background']['size'];
        if($request->hasFile('background_image')) {
            try {
                $filename = uploadImage($request->background_image, $path, $size, $videoUpdate->background_image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $videoUpdate->background_image = $filename;
        }
        $videoUpdate->descripation = $request->descripation;
        $videoUpdate->status = 0;
        $videoUpdate->update();
        return back();
    }

    public function audioFileUpload($request)
    {
        $user = Auth::user();
      	$request->validate([
          'audio' => 'required|in:audio',
    			'title' => 'required|max:250',
    			'audio_file' => 'required|mimes:mpeg,mpga,mp3,wav',
    			'descripation' => 'required|max:5000'
    		]);
    		$uploadeaudio = new JournalistWorkFile();
    		$uploadeaudio->user_id = $user->id;
    		$uploadeaudio->title = $request->title;
    		if($request->hasFile('audio_file')) {
                $file = $request->audio_file;
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid().'.'.$extension;
                $location = "assets/audio/";
                $file->move($location, $filename);
                $uploadeaudio->audio_file = $filename;
         }
         $uploadeaudio->descripation = $request->descripation;
         $uploadeaudio->save();
         return back();
    }

    public function audioFileUpdate($request)
    {
      $user = Auth::user();
    	$request->validate([
          'audio' => 'required|in:audio',
          'id' => 'required|exists:journalist_work_files,id',
			   'title' => 'required|max:250',
			   'audio_file' => 'mimes:mpeg,mpga,mp3,wav',
			   'descripation' => 'required|max:5000'
  		]);
  		$audioUpdate =JournalistWorkFile::whereNotNull('audio_file')->where('id', $request->id)->where('user_id', $user->id)->firstOrFail();
  		$audioUpdate->user_id = $user->id;
  		$audioUpdate->title = $request->title;
  		if($request->hasFile('audio_file')) {
          $file = $request->audio_file;
          $extension = $file->getClientOriginalExtension();
          $filename = uniqid().'.'.$extension;
          $location = "assets/audio/";
          $file_database = $audioUpdate->audio_file;
          $file_remove = $location . $file_database;
          if (\File::exists($file_remove)) {
                @unlink($file_remove);
          }
          $file->move($location, $filename);
          $audioUpdate->audio_file = $filename;
       }
       $audioUpdate->descripation = $request->descripation;
       $audioUpdate->status = 0;
       $audioUpdate->update();
       return back();
    }

    public function blogFileUpload($request)
    {
        $user = Auth::user();
    	$request->validate([
            'blog' => 'required|in:blog',
			'title' => 'required|max:250',
			'blog_link' =>'required|url',
			'descripation' => 'required|max:5000'
		]);
		$uploadBlog = new JournalistWorkFile();
		$uploadBlog->user_id = $user->id;
		$uploadBlog->title = $request->title;
		$uploadBlog->blog_link = $request->blog_link;
		$uploadBlog->descripation = $request->descripation;
		$uploadBlog->save();
		return back();
    }

    public function blogFileUpdate($request)
    {
        $user = Auth::user();
        $request->validate([
            'blog' => 'required|in:blog',
      	    'id' => 'required|exists:journalist_work_files,id',
  			'title' => 'required|max:250',
  			'blog_link' =>'required|url',
  			'descripation' => 'required|max:3000'
  		]);
  		$blogUpdate =JournalistWorkFile::whereNotNull('blog_link')->where('id', $request->id)->where('user_id', $user->id)->firstOrFail();
  		$blogUpdate->user_id = $user->id;
  		$blogUpdate->title = $request->title;
  		$blogUpdate->blog_link = $request->blog_link;
  		$blogUpdate->descripation = $request->descripation;
      $blogUpdate->status = 0;
  		$blogUpdate->update();
  		return back();
    }

    public function imageFileUpload($request)
    {
        $user = Auth::user();
        $request->validate([
            'images' => 'required|in:images',
      		'title' => 'required|max:250',
      		'image' =>'required|mimes:jpeg,jpg,png,gif|required|max:10000',
      		'descripation' => 'required|max:3000'
      	]);
      	$uploadImage = new JournalistWorkFile;
      	$uploadImage->user_id = $user->id;
      	$uploadImage->title = $request->title;
      	$path = imagePath()['work_image']['path'];
        $size = imagePath()['work_image']['size'];
        if($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $uploadImage->image = $filename;
        }
        $uploadImage->descripation = $request->descripation;
        $uploadImage->save();
        return back();
    }

    public function imageUpdate($request)
    {
        $user = Auth::user();
        $request->validate([
            'images' => 'required|in:images',
            'id' => 'required|exists:journalist_work_files,id',
            'title' => 'required|max:250',
            'image' =>'mimes:jpeg,jpg,png,gif|max:10000',
            'descripation' => 'required|max:3000'
        ]);
        $updateImage =JournalistWorkFile::whereNotNull('image')->where('id', $request->id)->where('user_id', $user->id)->firstOrFail();
        $updateImage->user_id = $user->id;
        $updateImage->title = $request->title;
        $path = imagePath()['work_image']['path'];
        $size = imagePath()['work_image']['size'];
        if($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $updateImage->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $updateImage->image = $filename;
        }
        $updateImage->descripation = $request->descripation;
        $updateImage->status = 0;
        $updateImage->update();
        return back();
    }
}
