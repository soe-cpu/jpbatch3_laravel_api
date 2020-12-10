<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Resources\SubcategoryResource;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();

        return response()->json([
            'status' => 'ok',
            'totalResults' => count($subcategories),
            'subcategories' => SubcategoryResource::collection($subcategories)
        ]);

        // return $subcategories
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request)

        // Validation
        $request->validate([
            "name" => 'required',
            "category_id" => 'required', 
        ],[
            "name.required" => "Pleace Enter Brand Name"
        ]);
        // Object Relational Mapping (Eloquent ORM)
        $subcategory = new Subcategory;
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        // redirect
        return new SubategoryResource($subcategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        return response()->json([
            'status' => 'ok',
            'brand' => new BrandResource($brand)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        /// dd($request)

        // Validation
        $request->validate([
            "name" => 'required',
            "category_id" => 'required', 
        ],[
            "name.required" => "Pleace Enter Brand Name"
        ]);
        // Object Relational Mapping (Eloquent ORM)
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        // redirect
        return new SubategoryResource($subcategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return new BrandResource($subcategory);
    }
}
