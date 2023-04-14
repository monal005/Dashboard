<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Models\Users;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
           $user = Users::select('*');
            return datatables()->of($user)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';

                    $btn = $btn . ' <a href="' .route('view.index', [$row->id]). '" data-toggle="tooltip"  data-id="" data-original-title="Delete" class="btn btn-warning btn-sm viewPost">View Posts</a>';

                    return $btn;
                })
                ->addColumn('image', function ($row) {


                    $storage=Storage::url($row->image);
                    $img = '<img src="'.$storage.'" height="50"/>';
                //    dd($img);
                    return $img;
                })
                ->rawColumns(['action','image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dashboard_page');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'image'=>'required'
        ]);

        // return $request;
        $image_path = '';
        $UserId = $request->has('id') ? $request->id : '';
        // $name='';
        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $image_path = Storage::disk('public')->put('images', $file);

        }

        $User   =   Users::updateOrCreate(
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


}
