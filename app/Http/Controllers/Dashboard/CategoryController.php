<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $categories = Category::paginate(2);
        return view('dashboard.category.index', compact('categories'));    
        return to_route("category.create");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $category = new Category();
        return view ('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
       $data = array_merge($request->all(),['image'=> '']); //solo es para ver que podemos insertar registros.
       Category::create($data);
        return to_route("category.index")->with('status', 'Registro creado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        //
        return view("dashboard.category.show", compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        //
        $categories = Category::pluck('id', 'title');
        return view ('dashboard.category.edit', compact( 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category): RedirectResponse
    {    
        
        $category->update($request->validated());
        return to_route("category.index")->with('status', 'Registro actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return to_route("category.index")->with('status', 'Registro eliminado!');
    }
}
