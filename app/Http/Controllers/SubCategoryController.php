<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('name','ASC')->get();
        return view('sub-categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategory::OrderBy('name','ASC')->with('category')->get();
        return response($subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subCategory = SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_name,
            'description' => $request->description
        ]);

        return response([
            'message' => "Sub Category Added Successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory,$id)
    {
        $subCategory = SubCategory::find($id);
        return response($subCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory,$id)
    {
        $subCategory = subCategory::where('id',$id)
        ->update([
            'name' => $request->name,
            'category_id' => $request->category_name,
            'description' => $request->description,
        ]);

        return response([
            'subcategory' => $subCategory,
            'message' => "Sub Category Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory,$id)
    {
        $subcategory = SubCategory::find($id);
        $subcategory->delete();
        return response([
            "message" => "Sub Category Deleted Successfully"
        ]);
    }
}
