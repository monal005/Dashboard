<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\{Image, NewUserModel, Post, UserUsers};
use Illuminate\Support\Facades\DB;
use App\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public $post;
    use CommonTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        // return($user);
        // return Response()->json($post_id);
        $title = "User Post";
        if (request()->ajax()) {
            $post = Post::where('user_id', $user_id)->select('id', 'name');
            // $post = DB::table('posts')->select('id','name','description')->where('user_id','=',$user_id);
            // $post = Users::select('*');
            return datatables()->of($post)
                //  ->rawColumns(['action','image'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('post.index')->with(['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user=Auth::user();
        $user_id=$user->id;
        $user_name=$user->name;
        echo $user->id;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required',

                'image' => 'required'
            ]);

            $UserId = $request->has('id') ? $request->id : '';

            $Post   =   Post::updateOrCreate(
                [
                    'id' => $UserId
                ],
                [
                    'user_id' => 1,
                    'name' => $request->name,


                ]
            );


            $array = [];
            if ($request->hasFile('image')) {


                foreach ($request->file('image') as $file) {
                    $image_path = Storage::disk('public')->put('images', $file);
                    $ar['image'] = $image_path;
                    $ar['posts_id'] = $Post->id;
                    $array[] = $ar;
                }
                Image::insert($array);
            }
            // save post images

            DB::commit();
            return response()->json([
                'data' => $Post,
                'status' => '200',
                'message' => 'success!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'data' => '',
                'status' => '200',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {


        if (request()->ajax()) {
            $post = Post::with('images')->select('id', 'name');
            // $post = Users::select('*');
            return datatables()->of($post)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';


                    return $btn;
                })
                ->addColumn('image', function ($row) {


                    // dd($row->image);
                    // $storage = Storage::url($row->image);
                    // $img = '<img src=" ' . $storage . '" height="50"/>';

                    // return $img;


                    $img = '';
                    $postImage = ($row->images && $row->images->first()) ? $row->images->first()->image_url : "";
                    if ($postImage) {
                        $img = '<img src="' . $postImage . '" height="50"/>';
                    }
                    return $img;
                })
                ->rawColumns(['action', 'image'])

                //  ->rawColumns(['action','image'])

                ->make(true);
        }


        return view('post.view');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::with('images')->find($id);

        // $this->pr( $post->toArray());
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

        $user = Post::with('images')->find($id)->delete();
        return response()->json([
            'data' => $user,
            'status' => '200',
            'message' => 'success!'
        ]);
    }

    public function newRelation(){
        $user = Post::with('newUser')->get();
        // echo "$user";
        return response()->json($user);
    }
}
