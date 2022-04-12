<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\Language;
use App\Page;
use App\Storie;
use App\User;
use App\Category;
use App\SupportAttachment;
use App\SupportMessage;
use App\SupportTicket;
use Carbon\Carbon;
use App\Booking;
use App\JournalistWorkFile;
use App\Conversation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;


class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function index(){
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }
        $data['page_title'] = 'Home';
        $data['sections'] = Page::where('tempname',$this->activeTemplate)->where('slug','home')->firstOrFail();
        return view($this->activeTemplate . 'home', $data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search'=>'required'
        ]);
        $page_title = 'Our Journalist';
        $search = $request->search;
        $journalist = User::where('user_type', 'journalist')->where('account_status', 1)->where('status', 1)->where(function($q) use ($search){
            $q->where('address->country', $search)
              ->orWhere('address->city', $search)
              ->orWhere('username', $search);
        })->paginate(getPaginate());
        return view($this->activeTemplate . 'journalist', compact('page_title', 'journalist', 'search'));
    }

    public function journalistSearch(Request $request)
    {
        $request->validate([
            'search'=>'required',
            'searchType' => 'nullable|in:name,city,country'
        ]);
        $searchs = $request->search;
        $page_title = 'Our Journalist ' .$searchs;
        $searchType = $request->searchType;
        $journalist = User::where('user_type', 'journalist')->where('account_status', 1)->where('status', 1);
        if($searchType == 'name')
        {
            $journalist = $journalist->where('username', $searchs);
        }
        elseif($searchType == 'country')
        {
            $journalist = $journalist->where('address->country', $searchs);
        }
        elseif($searchType == 'city')
        {
            $journalist = $journalist->where('address->city', $searchs);
        }
        $journalist = $journalist->paginate(getPaginate());
        return view($this->activeTemplate . 'journalist', compact('page_title', 'journalist', 'searchs'));
    }

    public function stories()
    {
        $page_title = "Stories";
        $stories = Storie::where('status', 1)->with('journalist')->paginate(9);
        return view($this->activeTemplate . 'storie', compact('page_title', 'stories'));
    }

    public function categoryStories($id)
    {
        $page_title = "Category By Stories";
        $stories = Storie::where('category_id', $id)->where('status', 1)->with('journalist')->paginate(9);
        return view($this->activeTemplate . 'storie', compact('page_title', 'stories'));
    }

    public function storyDetails($id,$slug)
    {
        $page_title = "Story Details";
        $categorys = Category::get();
        $recent_story = Storie::latest()->with('journalist')->take(5)->get();
        $story = Storie::where('id', $id)->where('status', 1)->firstOrFail();
        return view($this->activeTemplate . 'story_details', compact('story', 'page_title', 'categorys', 'recent_story'));
    }

    public function profile($username)
    {
        $active_user = Auth::user();
        $page_title = "Journalist Profile";
        $journalist = User::where('username', $username)->where('account_status', 1)->firstOrFail();
        $job_complete = Booking::where('user_id', $journalist->id)->where('status','!=', 0)->where('working_status', 1)->count();
        $job_progress = Booking::where('user_id', $journalist->id)->where('status','!=', 0)->where('working_status', 3)->count();
        $journalist_work = $journalist->journalistWorkFile()->where('status', 1)->paginate(12);
        $conversion = null;
        $ratingGet = null;
        if($active_user)
        {
            $ratingGet = Booking::where('member_id', $active_user->id)->where('status', '!=', 0)->where('user_id', $journalist->id)->first();
            
            $conversion = Conversation::where(function($query) use ($active_user, $journalist){
                $query->orWhere('sender_id', $active_user->id)
                ->orWhere('receiver_id', $active_user->id);
            })->where(function($query2) use ($active_user, $journalist){
                $query2->orWhere('sender_id', $journalist->id)
                ->orWhere('receiver_id', $journalist->id);
            })->first();
        }
        return view($this->activeTemplate . 'profile', compact('journalist', 'journalist_work', 'page_title', 'conversion', 'job_complete', 'job_progress', 'ratingGet'));
    }

    public function journalistWorkDetails($id)
    {
        $page_title = "Work Details";
        $journalist =User::where('user_type', 'journalist')->where('status', 1)->where('featured', 1)->where('account_status', 1)->select('username', 'image', 'designation')->take(6)->get();
        $work_details = JournalistWorkFile::findOrFail($id);
        return view($this->activeTemplate . 'work_details', compact('page_title', 'journalist', 'work_details'));
    }

    public function journalist()
    {
        $page_title = "Our Journalist";
        $journalist = User::where('user_type', 'journalist')->where('account_status', 1)->where('status', 1)->select('id', 'image', 'username', 'address', 'designation')->paginate(getPaginate());
        return view($this->activeTemplate . 'journalist', compact('page_title', 'journalist'));
    }


    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $data['page_title'] = $page->name;
        $data['sections'] = $page;
        return view($this->activeTemplate . 'pages', $data);
    }

    public function footerMenu($slug, $id)
    {
        $data = Frontend::where('id', $id)->where('data_keys', 'footer.element')->firstOrFail();
        $page_title =  $data->data_values->menu_name;
        return view($this->activeTemplate . 'menu', compact('data', 'page_title'));
    }

    public function contact()
    {
        $data['page_title'] = "Contact Us";
        return view($this->activeTemplate . 'contact', $data);
    }


    public function contactSubmit(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();

        $imgs = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'attachments' => [
                'sometimes',
                'max:4096',
                function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                    foreach ($imgs as $img) {
                        $ext = strtolower($img->getClientOriginalExtension());
                        if (($img->getSize() / 1000000) > 2) {
                            return $fail("Images MAX  2MB ALLOW!");
                        }
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg, pdf images are allowed");
                        }
                    }
                    if (count($imgs) > 5) {
                        return $fail("Maximum 5 images can be uploaded");
                    }
                },
            ],
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket->user_id = auth()->id();
        $ticket->name = $request->name;
        $ticket->email = $request->email;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $path = imagePath()['ticket']['path'];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                try {
                    $attachment = new SupportAttachment();
                    $attachment->support_message_id = $message->id;
                    $attachment->image = uploadImage($image, $path);
                    $attachment->save();
                    
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload your ' . $image];
                    return back()->withNotify($notify)->withInput();
                }

            }
        }
        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', $lang);
        return redirect()->back();
    }

    public function blogDetails($id,$slug){
        $blog = Frontend::where('id',$id)->where('data_keys','blog.element')->firstOrFail();
        $page_title = $blog->data_values->title;
        return view($this->activeTemplate.'blogDetails',compact('blog','page_title'));
    }

    public function placeholderImage($size = null){
        if ($size != 'undefined') {
            $size = $size;
            $imgWidth = explode('x',$size)[0];
            $imgHeight = explode('x',$size)[1];
            $text = $imgWidth . '×' . $imgHeight;
        }else{
            $imgWidth = 150;
            $imgHeight = 150;
            $text = 'Undefined Size';
        }
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }


}
