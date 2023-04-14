<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\BlogsImages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $post = Blogs::with('images')->select('id','title','description');
            // $post = Users::select('*');
            return datatables()->of($post)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';


                    return $btn;
                })
                ->addColumn('image', function ($row) {

                    $img = '';
                    $postImage = ($row->images && $row->images->first()) ? $row->images->first()->image_url : "";
                    if ($postImage) {
                        $img = '<img src="' . $postImage . '" height="50"/>';
                    }
                    else{
                        $img='';
                    }
                    // return $row->images->first();
                    return $img;
                })
                ->rawColumns(['action', 'image'])

                //  ->rawColumns(['action','image'])

                ->make(true);
        }

$data = User::all();
        return view('layouts.blogs',['data'=>$data]);
    }

    public function edit(string $id)
    {
        $post = Blogs::with('images')->find($id);
        // echo $post;
        // $this->pr( $post->toArray());
        return Response()->json($post);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'title' => 'required',
                'description'=>'required',
                'image' => 'required'
            ]);

            $UserId = $request->has('id') ? $request->id : '';

            $Post   =   Blogs::updateOrCreate(
                [
                    'id' => $UserId
                ],
                [
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'description'=>$request->description


                ]
            );


            $array = [];
            if ($request->hasFile('image')) {


                foreach ($request->file('image') as $file) {
                    $image_path = Storage::disk('public')->put('images', $file);
                    $ar['image'] = $image_path;
                    $ar['blogs_id'] = $Post->id;
                    $array[] = $ar;
                }
                BlogsImages::insert($array);
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

    public function tenant($amt,$n){
        $result = $amt/$n;
        return $result;

    }

    







}
