<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Fundraiser;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $categoriesNames = array();
        $fundraisersPerCategory = array();
        
        foreach($categories as $category) {
            $fundraisersPerCategory += [$category->id => Fundraiser::where('category_id', $category->id)->count()];
            $categoriesNames += [$category->id => $category->name];
        }

        return view('admin.category.index')->with([
            'categories' => $categories,
            'fundraisersPerCategory' => $fundraisersPerCategory,
            'categoriesNames' => $categoriesNames]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategoryName = $request->categoryName;
        
        $newCategory = new Category();
        $newCategory->name = $newCategoryName;
        $newCategory->save();
        
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit')->with(['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoryId = $request->categoryId;
        $newCategoryName = $request->newCategoryName;

        // Categoria da aggiornare
        $category = Category::find($categoryId);

        // Aggiornamento del nome della categoria
        $category->name = $newCategoryName;
        $category->updated_at = date('Y-m-d h:i.s');
        // Salvataggia della categoria
        $category->save();

        return json_encode([
            'status' => 'success',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // Prima di eliminare la voce aggiorno tutte le refenze nelle raccolte fondi
        $fundraisers = Fundraiser::all()->where('category_id', $id);
        foreach($fundraisers as $fr) {
            $fr->category_id = 1; // Ricadono tutte sulla categoria altro
            $fr->save();
        }

        // Infine elimino la categoria
        $category->delete();

        // Ritorno la route
        return redirect()->route('admin.category.index');
    }
}
