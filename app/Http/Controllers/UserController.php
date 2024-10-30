<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use App\Models\User;
use App\Traits\HasProfilePhoto;
use Storage;

class UserController extends Controller
{
	use HasProfilePhoto;
	
	protected $user;
    
	public function __construct() {
		$this->middleware('auth');
		
		$this->middleware( function ($request, $next) {
			$this->user = Auth()->user();
			return $next($request);
		});				
    }

    public function index()
    {
		return view('user.index');
    }
	
	public function profileIndex()
    {
        return view('user.profile');
    }
		
	public function profilePhotoStore(ImageUploadRequest $request) {		
		$image = $this->createProfilePhotoImage($request->file('profilephoto'));
		$profilePhotoName = $this->user->photo ?? $request->file('profilephoto')->hashName();
		$this->saveProfilePhotoFile($profilePhotoName, $image);
		$this->user->update(['photo' => $profilePhotoName]);
		
		return back()->with('success', 'Фото успешно обновлено!');
    }
	
	public function profilePhotoDelete() {
		if($this->profilePhotoExists($this->user->photo)) {
			$this->deleteProfilePhotoFile($this->user->photo);
			$this->user->update(['photo' => null]);
		}
		
		return back()->with('success', 'Фото успешно удалено!');
    }
}
