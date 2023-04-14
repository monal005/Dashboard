<?php

namespace App\Http\Controllers;

use App\Events\Register;
use App\Events\UserVerifyEvent;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmails;
use App\Models\User;
use App\Models\UserRelation;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (request()->ajax()) {
            $user = User::select('*'); // so we can use more than one query
            return datatables()->of($user)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';

                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="view" class="btn btn-warning btn-sm viewPost">viewPost</a>';

                    return $btn;
                })
                ->addColumn('image', function ($row) {


                    $storage = Storage::url($row->image);
                    $img = '<img src="' . $storage . '" height="50"/>';
                    //    dd($img);
                    return $img;
                })
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dashboard_page');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // dd($request->all());
        if (Auth::attempt($request->only('email', 'password'))) {
            // Register::dispatch($user);
            SendEmails::dispatch($user);
            // event(new UserVerifyEvent($user));
            return redirect('dashboard');


        }
        return redirect('login')->withError('Login detials not valid');
    }

    public function login(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        // print_r($request->all());
        if (Auth::attempt($request->only('email', 'password'))) {
            // $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            // $user=Auth::user();
            // $userName=$user->name;
            // $userEmail=$user->email;

            // print_r($userName);
            return redirect('/dashboard');
            // return response()->json(['token' => $token], 200);
            // echo"success";
        }
        else{
            //  echo "error";
            return redirect('login')->with('success','Login details not valid');
            // return response()->json(['error' => 'Unauthorised'], 401);
        }

    }

    public function create()
    {
        //
    }

    public function logout(Request $request)
    {
    $request->session()->flush();
    Auth::logout();
    return redirect('/login');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'image'=>'required'
        ]);

        $image_path = '';
        $UserId = $request->has('id') ? $request->id : '';
        // $name='';
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_path = Storage::disk('public')->put('images', $file);

        }

        $User   =   User::updateOrCreate(
            [
                'id' => $UserId
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make("$request->password") ,
                'image' => $image_path,
            ]
        );

        // $token = $User->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'data'=> $User,
            'status'=>'200',
            'message' => 'success!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $post = User::find($id);
        return Response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->delete();
        return response()->json([
            'data'=> $user,
            'status'=>'200',
            'message' => 'success!'
        ]);
    }

    // public function showRelation(){
    //     $user = UserRelation::with('posts')->get();
    //     return $user;
    // }
}
