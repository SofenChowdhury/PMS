<?php

namespace App\Http\Controllers\API;

// use Laravel\Passport\Bridge\User;
use App\Models\User;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\RefreshToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class RegisterController extends BaseController
{
    // public function __construct()
    // {
    //    $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }
    public function register(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        // $token = auth('api')->login($user);
        // $token = rand();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        // return $this->createToken($token,$user);
        return $this->sendResponse($success, 'User register successfully.');
    }
    public function login(Request $request)
    {
        // return "login";
        $gmail = "md.rabby.mahmud@gmail.com";
        $name = "sofen";
        $phone = "01719272223";
        $word = $request->email;
        $qry = User::select('email')->where('email', $word)->orWhere('name', $word)->orWhere('phone', $word)->first();
        if($qry != null){
            if(Auth::attempt(['email' => $qry->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('MyApp')->accessToken; 
                $success['name'] =  $user->name;
                return $this->sendResponse($success, 'User login successfully.');
            }else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        DB::table('oauth_access_tokens')
            ->whereUserId($request->user()->id)
            ->delete();
        $data = $request->user();
        return response()->json(['status' => true, 'data' => $data, 'message' => 'Successfully logged out']);
    }
}
