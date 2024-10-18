<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\ImageUploadRequest;
use Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		return view('user.index');
    }
	
	public function profileIndex()
    {
        return view('user.profile');
    }
	
	public function profilePhotoStore(ImageUploadRequest $request) {
		$profilePhotoName = $request->file('profilephoto')->hashName();
		
		$image = Image::read($request->file('profilephoto'));
		$image->coverDown(120, 120);
		if(!empty(Auth()->user()->photo)&&(Storage::disk('profile-photos')->exists(Auth()->user()->photo)))
			Storage::disk('profile-photos')->delete(Auth()->user()->photo);
		Storage::disk('profile-photos')->put($profilePhotoName, (string) $image->encode());		
		Auth()->user()->update(['photo' => $profilePhotoName]);
		
		return back()->with('success', 'Фото успешно обновлено!');
    }
	
	public function profilePhotoDelete() {
		if(!empty(Auth()->user()->photo)&&(Storage::disk('profile-photos')->exists(Auth()->user()->photo))) {
			Storage::disk('profile-photos')->delete(Auth()->user()->photo);
			Auth()->user()->update(['photo' => null]);
		}
		
		return back()->with('success', 'Фото успешно удалено!');
    }
}
