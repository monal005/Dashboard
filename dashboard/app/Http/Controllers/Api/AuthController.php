<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $customMessages = [

        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->getMessageBag()->first()], 402);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $request->image,
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $user = Auth::user();
          
            return response()->json(['name'=>$user,'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    
    public function showDetails()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }



}
