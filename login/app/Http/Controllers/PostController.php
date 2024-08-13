<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        //get posts
        $posts = Post::latest()->paginate(5);
        //render view with posts
        return view('admin.posts.index', compact('posts'));
    }
    
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        //validate form
        $request->validate([
            'foto_mahasiswa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|min:5',
            'nama_mahasiswa' => 'required|min:5'
        ]);

        //upload image
        $image = $request->file('foto_mahasiswa');
        $image->storeAs('public/admin/posts/', $image->hashName());

        //create post
        Post::create([
            'foto_mahasiswa' => $image->hashName(),
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa
        ]);


        //redirect to index
        return redirect()->route('admin/posts')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $post)
    {
        //get product by ID
        $posts = Post::findOrFail($post);
        //render view with Post
        return view('admin.posts.show', compact('post'));
    }

    //UNTUK MENGEDIT DATA
    public function edit($id)
    {   
        $posts = Post::findOrFail($id);
        return view('admin.posts.edit', compact('posts'));
    }

    //UNTUK UPDATE DATA
    public function update(Request $request, $id)
    {
        //validate form
        $posts = Post::findOrFail($id);
        $request->validate([
            'foto_mahasiswa' =>
                'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nim' => 'required|min:5',
            'nama_mahasiswa' => 'required|min:5'
        ]);
        //check if image is uploaded
        if ($request->hasFile('foto_mahasiswa')) {

            //upload new image
            $image = $request->file('foto_mahasiswa');
            $image->storeAs('public/admin/posts/', $image->hashName());

            //delete old image
            Storage::delete('public/admin/posts/' . $posts->image);

            //update post with new image
            $posts->update([
                'foto_mahasiswa' => $image->hashName(),
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa
            ]);
        } else {
            //update post without image
            $posts->update([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama_mahasiswa
            ]);
        }
        //redirect to index
        return redirect()->route('admin/posts')->with(['success' => 'Data Berhasil Diubah!'
        ]);
    }

    //UNTUK MENGHAPUS DATA
    public function destroy($id)
    {
        //get product by ID
        $posts = Post::findOrFail($id);

        //delete image
        Storage::delete('public/admin/posts/'. $posts->image);

        //delete product
        $posts->delete();

        //redirect to index
        return redirect()->route('admin/posts')->with(['success' => 'Data Berhasil Dihapus!']);
    }



}
