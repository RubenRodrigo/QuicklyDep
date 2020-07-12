<?php

namespace App\Http\Controllers;

use App\Post;
use App\Adress;
use App\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'showPostVentaPais']);
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
            'name' => 'required:max:120',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description'=> 'required:max:2200',
            'type'=>'not_in:x',
            'price'=> 'required|numeric|gt:0',
            'country'=> 'not_in:x',
            'city'=> 'not_in:x',
            'district'=> 'required',
            'adress'=> 'required'
        ]);
        
        $name      = $request->get('name');        
        $description    = $request->get('description');
        $type = $request->get('type');
        $price = $request->get('price');
        $imageName  = $request->file('image')->store('posts/', 'public');
        $country = $request->get('country');
        $city = $request->get('city');
        $district = $request->get('district');
        $direccion = $request->get('adress');
        
        echo $type . $country . $city;
        
        $post = $request->user()->posts()->create([
            'nombre' => $name,
            'descripcion' => $description,
            'tipo' => $type,
        ]);                
        
        // Embebed Document For establishments
        // $establishment = Establishment::where('pais', '=', $country)->firstOrFail();
        // // $aux = Establishment::find($establishment->)
        // if($establishment->count()==0){
        //     $establishment = Establishment::create([
        //         'pais' => $country,            
        //     ]);
        // }        

        // $establishment->pais = $country;
        // // $establishment->imagen = $imageName;
        // $post->establishment()->save($establishment);

        // Embebed Document For Adress
        $establishment = new Establishment();        
        $establishment->pais = $country;
        $establishment->ciudad = $city;
        $establishment->distrito = $district;
        $establishment->direccion = $direccion;
        $establishment->id_post = $post->id;
        $establishment->precio = $price;
        $establishment->imagen = $imageName;
        $post->establishment()->save($establishment);

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

    public function showPostVentaPais($tipo, $pais=null)
    {   
        if(!is_null($pais)){

            $posts = Post::whereHas('establishment', function($q) use ($pais){
                $q->where('pais', $pais);
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
    public function edit(Post $Post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $Post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $Post)
    {
        //
    }

    // Post Filters
    public function salesFilter(Request $request)
    {
        
    }
}
