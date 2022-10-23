<?php

namespace App\Http\Controllers\API;

// use Laravel\Passport\Bridge\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\API\BaseController as BaseController;

class RegisterController extends BaseController
{
    public function __construct()
    {
       $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
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

        // Test if string contains the word 
        // if((strpos($word, $gmail) !== false) || (strpos($word, $name) !== false) || (strpos($word, $phone) !== false)){
        //     return "Word Found!";
        // } else{
        //     return "Word Not Found!";
        // }
        // return $request->email;
        // if($request->email){
        //     return "true";
        // }else{
        //     return "false";
        // }

        // if(Auth::attempt(['email' => $qry->email, 'password' => $request->password])){ 
        //     $user = Auth::user(); 
        //     $success['token'] =  $user->createToken('MyApp')->accessToken; 
        //     $success['name'] =  $user->name;

        //     return $this->sendResponse($success, 'User login successfully.');
        // }else{ 
        //     return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        // } 
    }
}
