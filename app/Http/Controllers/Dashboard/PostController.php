<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Models\Category;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //Category::find(1)->posts;

        $posts = Post::paginate(2);
        return view('dashboard.post.index', compact('posts'));

        //return route("post.create");
        //return redirect("/post/create");
        //return redirect()->route("post.create");
        return to_route("post.create");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $categories = Category::pluck('id', 'title');
        $post = new Post();

        //dd($categories); //Para ver si funciona sirve como un var_dum
        return view ('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        //echo request("title);
        // echo request("title");
        //dd($request->all());
       // Post::create($request->all());
       $data = array_merge($request->all(),['image'=> '']); //solo es para ver que podemos insertar registros.
        //dd($data);
       Post::create($data);

        //return route("post");
        //return redirect("/post");
        //return redirect()->route("post");
        return to_route("post.index")->with('status', 'Registro creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        //
        return view("dashboard.post.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        //
        $categories = Category::pluck('id', 'title');
        return view ('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post): RedirectResponse
    {
        //
        $data = $request->validated();
        if (isset($data["image"])){
            $data["image"]=$filename = time().".".$data["image"]->extension();            
            $request->image->move(public_path("image"), $filename);
        }
        
        $post->update($data);
        //$request->session()->flash('status', 'Registro actualizado!');
        return to_route("post.index")->with('status', 'Registro actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        //
        echo "destroy";
        $post->delete();
       return to_route("post.index")->with('status', 'Registro eliminado!');
    }
}
