<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\BrandResource;
class BrandController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return response()->json([
            'status' => 'ok',
            'totalResults' => count($brands),
            'brands' => BrandResource::collection($brands)
        ]);

        // return BrandResource::collection($brands); // array
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
            "name" => "required|min:5",
            "photo" => "required|mimes:jpeg,bmp,png", // a.jpg
        ]);

        // file upload
        if($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // brandimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('itemimg', $fileName, 'public');

            $path = '/storage/'.$filePath;
        }

        // store
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->photo = $path;
        $brand->save();

        // redirect
        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return response()->json([
            'status' => 'ok',
            'brand' => new BrandResource($brand)
        ]);
        
        // return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        // dd($request)

        // Validation
        $request->validate([
            "name" => "required|min:5",
            "photo" => "required|mimes:jpeg,bmp,png", // a.jpg
        ]);

        // file upload
        if($request->file()) {
            // 624872374523_a.jpg
            $fileName = time().'_'.$request->photo->getClientOriginalName();

            // brandimg/624872374523_a.jpg
            $filePath = $request->file('photo')->storeAs('itemimg', $fileName, 'public');

            $path = '/storage/'.$filePath;
        }else{
            $path = $request->oldphoto;
        }

        // store
        $brand->name = $request->name;
        $brand->photo = $path;
        $brand->save();

        // redirect
        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return new BrandResource($brand);
    }
}
