<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\JsonResponse;
use App\Traits\Api\SendResponse;
   
class RegisterController extends Controller
{
	use SendResponse;
    
	public function __construct(
		protected User $user
	) {}
	
	public function register(UserRegisterRequest $request): JsonResponse {
        $input = $request->safe()->except('confirm_password');
        $input['password'] = Hash::make($input['password']);
        $user = $this->user->firstOrCreate($input);
		$success = [
				'token' => $user->createToken('access_token')->plainTextToken,
				'name' => $user->name,
				'email' => $user->email,
			];
        
        return $this->sendResponse($success, 'User registered successfully', 201);
    }
   
    public function login(Request $request): JsonResponse {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success = [
				'token' => $user->createToken('access_token')->plainTextToken,
				'name' => $user->name,
				'email' => $user->email,
			];
            return $this->sendResponse($success, 'User logged in successfully', 200);
        } 
        else{ 
            return $this->sendError('User is unauthorised', [], 401);
        } 
    }
}