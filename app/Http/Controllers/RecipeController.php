<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $recipes = Recipe::latest()->paginate(30);

        return view('recipes.index', compact('recipes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('recipes.create');
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
          'name' => 'required',
          'description' => 'required',
          'ingredients' => 'required',
          'instructions' => 'required'
      ]);

      Recipe::create($request->all());

      return redirect()->route('recipes.index')
          ->with('success', 'Recipe created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // get the recipe
      $recipe = recipe::find($id);
       return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $recipe = recipe::find($id);
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
      $request->validate([
        'name' => 'required',
        'description' => 'required',
        'ingredients' => 'required',
        'instructions' => 'required'
     ]);
     $updated = Recipe::where('id', $request->id)
        ->update([
                  'name' => $request->name,
                  'description' => $request->description,
                  'ingredients' => $request->ingredients,
                  'instructions' => $request->instructions,
                  'length' => $request->length,
                  'calories' => $request->calories,
                  'servings' => $request->servings
           ]);

     return redirect()->route('recipes.index')
         ->with('success', 'Recipe updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Recipe $recipe)
    {
      $recipe = Recipe::find($request->id);
      if($recipe){
          Recipe::destroy($request->id);
          return redirect()->route('recipes.index')
              ->with('success', 'Recipe deleted successfully');
      }

      return redirect()->route('recipes.index')
          ->with('error', 'Recipe deletion failed');
    }
}
