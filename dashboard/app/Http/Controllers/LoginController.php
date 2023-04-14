<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    // protected function _registerOrLoginUser($data){
    //     $user = User::where('email',$data->email)->first();
    //       if(!$user){
    //          $user = new User();
    //          $user->name = $data->name;
    //          $user->email = $data->email;
    //          $user->provider_id = $data->id;
    //          $user->avatar = $data->avatar;
    //          $user->save();
    //       }
    //     Auth::login($user);
    //     }



    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback(){

        // $user = Socialite::driver('google')->user();

        //   $this->_registerorLoginUser($user);
        //   return redirect()->route('home');

        //   try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('email', $user->mail)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        // } catch (Exception $e) {
        //     // dd($e->getMessage());
        // }
        }



        public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }



    public function handleFacebookCallback(){

        // $user = Socialite::driver('google')->user();

        //   $this->_registerorLoginUser($user);
        //   return redirect()->route('home');

        //   try {

            $user = Socialite::driver('facebook')->stateless()->user();

            $finduser = User::where('provider_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('dashboard');

            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        // } catch (Exception $e) {
        //     // dd($e->getMessage());
        // }
        }


}
