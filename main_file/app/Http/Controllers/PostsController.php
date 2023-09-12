<?php

namespace App\Http\Controllers;

use App\DataTables\PostDataTable;
use App\Models\Category;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ReCaptcha\RequestMethod\Post;

class PostsController extends Controller
{
    public function index(PostDataTable $dataTable)
    {
        if (\Auth::user()->can('manage-post')) {
            return $dataTable->render('posts.index');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::user()->can('create-post')) {
            $category = Category::where('tenant_id',tenant('id'))->pluck('name', 'id');
            return  view('posts.create', compact('category'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->can('create-post')) {
            request()->validate([
                'title' => 'required',
                'photo' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'slug' => 'required',

            ]);

            if ($request->hasFile('photo')) {
                $request->validate([
                    'photo' => 'required',
                ]);
                $path = $request->file('photo')->store('posts');
            }

            $post = Posts::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'photo' => $path,
                'short_description' => $request->short_description,
                'slug' => $request->slug
            ]);

            return redirect()->route('blogs.index')->with('success', 'Post Added successfully.');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::user()->can('edit-post')) {
            $posts = Posts::find($id);

            $category = Category::where('tenant_id',tenant('id'))->pluck('name', 'id');
            return  view('posts.edit', compact('posts', 'category'));
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Auth::user()->can('edit-post')) {
            request()->validate([
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'slug' => 'required',
            ]);

            $post = Posts::find($id);
            if ($request->hasFile('photo')) {
                $request->validate([
                    'photo' => 'required',
                ]);
                $path = $request->file('photo')->store('posts');
                $post->photo = $path;
            }
            $post->title = $request->title;
            $post->description = $request->description;
            $post->category_id = $request->category_id;
            $post->short_description = $request->short_description;
            $post->slug = $request->slug;
            $post->save();

            return redirect()->route('blogs.index')->with('success', 'Posts updated successfully');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }


    public function destroy($id)
    {
        if (\Auth::user()->can('delete-post')) {
            $post = Posts::find($id);
            $post->delete();

            return redirect()->route('blogs.index')->with('success', 'Posts Deleted successfully.');
        } else {
            return redirect()->back()->with('failed', __('Permission Denied.'));
        }
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function all_post()
    {
        $categories = Category::all();
        $category = [];
        $category['0'] = __('Select Category');
        foreach ($categories as $cate) {
            $category[$cate->id] = $cate->name;
        }
        $posts = Posts::all();
        return view('posts.view', compact('posts', 'category'));
    }
}
