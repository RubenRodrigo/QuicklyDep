<?php

namespace App\Http\Controllers;

use App\Post;
use App\Establishment;
use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'showPostVentaAlquiler']);
    }

    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // Campos del modelo Post
            'name' => 'required:max:120',            
            'description'=> 'required:max:2200',
            'type'=>'not_in:x',
            // Campos del modelo Establishement
            'price'=> 'required|numeric|gt:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',            
            'city'=> 'not_in:x',
            'district'=> 'required',
            'adress'=> 'required',
            // Campos del modelo Feature
            'bathroom' => 'not_in:x',
            'bedroom' => 'not_in:x',
            'garage' => 'not_in:x',
            'pool' => 'not_in:x',            
        ]);

        // Campos del modelo Post
        $name           = $request->get('name');        
        $description    = $request->get('description');
        $type           = $request->get('type');

        // Campos del modelo Establishement
        $price          = $request->get('price');
        $image = array();            
        $imageName      = $request->file('image')->store('posts/', 'public');
        $image[] = $imageName;
        if ($request->file('image1')) {
            $imageName1      = $request->file('image1')->store('posts/', 'public');
            $image[] = $imageName1;
        }
        if ($request->file('image2')) {
            $imageName2      = $request->file('image2')->store('posts/', 'public');
            $image[] = $imageName2;
        }
        if ($request->file('image3')) {
            $imageName3      = $request->file('image3')->store('posts/', 'public');
            $image[] = $imageName3;
        }
        if ($request->file('image4')) {
            $imageName4      = $request->file('image4')->store('posts/', 'public');
            $image[] = $imageName4;
        }
        if ($request->file('image5')) {
            $imageName5      = $request->file('image5')->store('posts/', 'public');
            $image[] = $imageName5;
        }
        if ($request->file('image6')) {
            $imageName6      = $request->file('image6')->store('posts/', 'public');
            $image[] = $imageName6;
        }
        if ($request->file('image7')) {
            $imageName7      = $request->file('image7')->store('posts/', 'public');
            $image[] = $imageName7;
        }
        // $image = array();
        // foreach ($request->file('image') as $imageName){
        //     $imageFile = $imageName->store('posts/', 'public');;
        //     // Storage::disk('public')->putFile('posts/', $imageFile);
        //     $image[] = $imageFile;
        // }
        // dd($image);

        $city           = $request->get('city');
        $district       = $request->get('district');
        $direccion      = $request->get('adress');

        // Campos del modelo Feature
        $bathroom       = $request->get('bathroom');
        $bedroom        = $request->get('bedroom');
        $garage         = $request->get('garage');
        $pool           = $request->get('pool');
        $other          = $request->get('other');
        
        // echo $type . $country . $city;
        
        $post = $request->user()->posts()->create([
            'nombre'        => $name,
            'descripcion'   => $description,
            'tipo'          => $type,
        ]);                
        
        $establishment = new Establishment();   
        $establishment->pais        = "Perú";             
        $establishment->ciudad      = $city;
        $establishment->distrito    = $district;
        $establishment->direccion   = $direccion;
        $establishment->id_post     = $post->id;
        $establishment->precio      = $price;
        $establishment->imagen      = $image;
        $post->establishment()->save($establishment);
        
        $feature = new Feature();
        $feature->baños         = $bathroom;
        $feature->dormitorios   = $bedroom;
        $feature->garage        = $garage;
        $feature->piscina       = $pool;
        $feature->otros         = $other;
        $establishment->features()->save($feature);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.postUnico',['post' => Post::find($id)]);
    }

    // Filtro para ventas y alquiler
    public function showPostVentaAlquiler($tipo, $distrito=null)
    {   
        if(!is_null($distrito)){

            $posts = Post::whereHas('establishment', function($q) use ($distrito){
                $q->where('distrito', $distrito);
            }
            )->where('tipo', $tipo)->paginate(5);

            return view('posts.index', compact('posts'));
        } else {
            
            $posts = Post::where('tipo', $tipo)->paginate(5);
            
            return view('posts.index', compact('posts'));
        }        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        if (Auth::user()) {
            $post = Post::find($post_id);               
            return view('posts.editPost')->withPost($post);
            if($post){
                return view('posts.editPost')->withPost($post);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            // Campos del modelo Post
            'name' => 'required:max:120',            
            'description'=> 'required:max:2200',
            // 'type'=>'not_in:x',
            // Campos del modelo Establishement
            'price'=> 'required|numeric|gt:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'country'=> 'not_in:x',
            // 'city'=> 'not_in:x',
            'district'=> 'required',
            'adress'=> 'required',
            // Campos del modelo Feature
            // 'bathroom' => 'not_in:x',
            // 'bedroom' => 'not_in:x',
            // 'garage' => 'not_in:x',
            // 'pool' => 'not_in:x',            
        ]);
        
        // Campos del modelo Post
        $name           = $request->get('name');        
        $description    = $request->get('description');
        $type           = $request->get('type');

        // Campos del modelo Establishement
        $price          = $request->get('price');
        $imageName      = $request->file('image')->store('posts/', 'public');
        $city           = $request->get('city');
        $district       = $request->get('district');
        $direccion      = $request->get('adress');
        $post_id        = $request->get('post_id');
        
        // Campos del modelo Feature
        $bathroom       = $request->get('bathroom');
        $bedroom        = $request->get('bedroom');
        $garage         = $request->get('garage');
        $pool           = $request->get('pool');
        $other          = $request->get('other');

        $post = Post::find($post_id);
        $post->nombre = $name;
        $post->descripcion = $description;
        $post->tipo = $type;
        $post->save();

        $establishment = Establishment::find($post->establishment->id);        
        $establishment->pais        = "Perú";
        $establishment->ciudad      = $city;
        $establishment->distrito    = $district;
        $establishment->direccion   = $direccion;        
        $establishment->precio      = $price;
        $establishment->imagen      = $imageName;
        $establishment->save();

        $features = $establishment->features;
        foreach ($features as $feature) {
            $feature->baños         = $bathroom;
            $feature->dormitorios   = $bedroom;
            $feature->garage        = $garage;
            $feature->piscina       = $pool;
            $feature->otros         = $other;
            $feature->save();
        }        

        return view('posts.postUnico',['post' => Post::find($post_id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        $establishment = Establishment::where('id_post', $id)->firstOrFail();
        $establishment->delete();

        return redirect('/');
    }

    // Publicaciones por usuario
    public function userPosts()
    {
        $user_id = Auth::id();        
        $posts = Post::where('user_id', '=', $user_id)->get();
        return view('posts.misPosts', compact('posts'));
    }
}
