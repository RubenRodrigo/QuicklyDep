<?php

namespace App\Http\Controllers;

use App\Post;
use App\Establishment;
use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Http\Resources\Post as PostResources;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'showPostVentaAlquiler','showPostFiltroPrecio', 'indexAPI']);
    }

    public function index(Request $request)
    {        
        //Se obtiene el valor de búsqueda
        $query = trim($request->get('search'));

        //Revisamos que el valor de búsqueda contenga un valor para controlar los resultados expuestos:
        if($query==""){
            $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        }else{
            $posts = Post::where('nombre', 'LIKE', '%' . $query . '%')->orderBy('created_at', 'desc')->paginate(6);
        }        

        //Retornamos la vista con los elementos correspondientes a la búsqueda y el valor de la búsqueda:
        return view('posts.index', compact('posts'));
    }

    public function indexAPI(){
        $post = Post::all();
        return PostResources::collection($post);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showPostFiltroPrecio(Request $request)
    {
        //Obtenemos las variables de costes para el filtrado:
        $precio1 = $request->get('precio1');
        $precio2 = $request->get('precio2');

        //Filtramos la información respecto al atributo de precio de los establecimientos:
        $posts = Post::whereHas('establishment', function($q) use ($precio1,$precio2){
            $q->whereBetween('precio', array($precio1, $precio2));
        }
        )->paginate(6);
        if(!is_null($request->get('tipo'))){
            $tipo = $request->get('tipo');
            $posts = Post::whereHas('establishment', function($q) use ($precio1,$precio2){
                $q->whereBetween('precio', array($precio1, $precio2))->where('tipo');
            }
            )->where('tipo', $tipo)->paginate(6);
            return view('posts.index', ['posts'=>$posts,'precio1'=>$precio1,'precio2'=>$precio2,'tipo'=>$tipo]);
        }
        return view('posts.index', ['posts'=>$posts,'precio1'=>$precio1,'precio2'=>$precio2]);

    }

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
        
        $data['post'] = $post;
        $distrito = $data['post']->establishment->distrito;        
        $tipo = $data['post']->tipo;
        
        $data['postsRecomendados'] = 
        $posts = Post::whereHas('establishment', function($q) use ($distrito){
            $q->where('distrito', $distrito);
        }
        )->where('tipo', $tipo)->whereNotIn('_id', [$data['post']->id])->orderBy('created_at', 'desc')->take(3)->get();
        return view('posts.postUnico',['data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */

    // Retorna el post seleccionado y otros 5 post similares
    // segun su distrito y tipo. Estos estan ordenados por su fecha de creacion
    public function show($id)
    {
        $data['post'] = Post::find($id);
        $distrito = $data['post']->establishment->distrito;        
        $tipo = $data['post']->tipo;
        
        $data['postsRecomendados'] = 
        $posts = Post::whereHas('establishment', function($q) use ($distrito){
            $q->where('distrito', $distrito);
        }
        )->where('tipo', $tipo)->whereNotIn('_id', [$data['post']->id])->orderBy('created_at', 'desc')->take(3)->get();
        return view('posts.postUnico',['data'=>$data]);
    }

    // Filtro para ventas y alquiler
    public function showPostVentaAlquiler($tipo, $distrito=null)
    {   
        if(!is_null($distrito)){

            $posts = Post::whereHas('establishment', function($q) use ($distrito){
                $q->where('distrito', $distrito);
            }

            )->where('tipo', $tipo)->orderBy('created_at', 'desc')->paginate(6);


            return view('posts.index', ['posts'=>$posts, 'tipo'=>$tipo]);
        } else {
            
            $posts = Post::where('tipo', $tipo)->orderBy('created_at', 'desc')->paginate(6);
            
            return view('posts.index', ['posts'=>$posts, 'tipo'=>$tipo]);
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
            // // Campos del modelo Post
            'name' => 'max:120',            
            'description'=> 'max:2200',            
            // Campos del modelo Establishement
            'price'=> 'numeric|gt:0',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',            
            'district'=> 'max:120',
            'adress'=> 'max:120',
            // Campos del modelo Feature
            'other'=> 'max:2200'

        ]);
        
        $post_id        = $request->get('post_id');
        $post = Post::find($post_id);
        $establishment = Establishment::find($post->establishment->id);        

        // Campos del modelo Post
        $name           = $request->get('name');        
        $description    = $request->get('description');
        $type           = $request->get('type');

        // Campos del modelo Establishement
        $price          = $request->get('price');
        
        $image = array();
        
        if ($request->file('image1')){
            $imageName1      = $request->file('image1')->store('posts/', 'public');
            $image[] = $imageName1;            
        }
        else{            
            $imageName1      = $establishment->imagen[0];
            $image[] = $imageName1;
            
        }

        if ($request->file('image2')) {
            $imageName2      = $request->file('image2')->store('posts/', 'public');
            $image[] = $imageName2;
        }
        else{
            if (isset($establishment->imagen[1])) {
                $imageName2      = $establishment->imagen[1];
                $image[] = $imageName2;
            }
            
        }

        if ($request->file('image3')) {
            $imageName3      = $request->file('image3')->store('posts/', 'public');
            $image[] = $imageName3;
        }
        else{
            if (isset($establishment->imagen[2])){
                $imageName3      = $establishment->imagen[2];
                $image[] = $imageName3; 
            }                        
            
        }

        if ($request->file('image4')) {
            $imageName4      = $request->file('image4')->store('posts/', 'public');
            $image[] = $imageName4;
        }
        else{            
            if (isset($establishment->imagen[3])) {
                $imageName4      = $establishment->imagen[3];
                $image[] = $imageName4;
            }
            
        }

        if ($request->file('image5')) {
            $imageName5      = $request->file('image5')->store('posts/', 'public');
            $image[] = $imageName5;
        }
        else{            
            if(isset($establishment->imagen[4])){
                $imageName5      = $establishment->imagen[4];
                $image[] = $imageName5; 
            }
            
        }

        
        $city           = $request->get('city');
        $district       = $request->get('district');
        $direccion      = $request->get('adress');        
        
        // Campos del modelo Feature
        $bathroom       = $request->get('bathroom');
        $bedroom        = $request->get('bedroom');
        $garage         = $request->get('garage');
        $pool           = $request->get('pool');
        $other          = $request->get('other');
        
        
        
        $post->nombre = $name;
        $post->descripcion = $description;
        $post->tipo = $type;
        $post->save();
        
        $establishment->pais        = "Perú";
        $establishment->ciudad      = $city;
        $establishment->distrito    = $district;
        $establishment->direccion   = $direccion;        
        $establishment->precio      = $price;
        $establishment->imagen      = $image;
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

        $data['post'] = Post::find($post_id);
        $distrito = $data['post']->establishment->distrito;        
        $tipo = $data['post']->tipo;
        
        $data['postsRecomendados'] = 
        $posts = Post::whereHas('establishment', function($q) use ($distrito){
            $q->where('distrito', $distrito);
        }
        )->where('tipo', $tipo)->whereNotIn('_id', [$data['post']->id])->orderBy('created_at', 'desc')->take(3)->get();

        return view('posts.postUnico',['data'=>$data]);
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
        $posts = Post::where('user_id', '=', $user_id)->orderBy('created_at', 'desc')->get();
        return view('posts.misPosts', compact('posts'));
    }
}
