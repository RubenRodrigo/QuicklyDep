<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use Validator;
use Image;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.userEdit',['user' => User::find($id) ]);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        
        $usuario->update();

        return redirect('/home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('users.profile', array('user' => User::find($id)) );
    }

    public function update_avatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save('/home/ubuntu/Workplace/Laravel/QuicklyDep/public/storage/posts/' . $filename );

            $user = Auth::user();
            $user->avatar ='posts/' . $filename;
            $user->save();
        }

        return view('users.profile', array('user' => Auth::user()) );
    }

    /*public function destroy(user $user)
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id','=',$user_id)->get();
        foreach ($posts as $post) {
            $post->delete();
        }
        
        $user->delete();
        return redirect('/home');
    }*/
}