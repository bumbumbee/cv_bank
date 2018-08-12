<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'category' => 'required',
            'file' => 'required'
        ]);

        if ($request->hasFile('file')) {
            // filename with extension
            $fileNameExt = $request->file('file')->getClientOriginalName();
            // just filename
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            //just extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $fileName . '' . time() . '.' . $extension;
            //upload image
            $path = $request->file('file')->storeAs('public/uploads', $fileNameToStore);
        }

        // Create Post
        $post = new Post;
        $post->name = $request->input('name');
        $post->email = $request->input('email');
        $post->category = $request->input('category');
        $post->cv = $fileNameToStore;
        $post->save();

        return redirect('/')->with('success', 'CV uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'category' => 'required'
        ]);

        if ($request->hasFile('file')) {
            // filename with extension
            $fileNameExt = $request->file('file')->getClientOriginalName();
            // just filename
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            //just extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $fileName . '' . time() . '.' . $extension;
            //upload image
            $path = $request->file('file')->storeAs('public/uploads', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->name = $request->input('name');
        $post->email = $request->input('email');
        $post->category = $request->input('category');
        if ($request->hasFile('file')) {
            $post->cv = $fileNameToStore;
        }
        $post->save();

        return redirect('/')->with('success', 'CV updated');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete('public/uploads/' . $post->cv);
        $post->delete();
        return redirect('/')->with('success', 'CV deleted');
    }
}
