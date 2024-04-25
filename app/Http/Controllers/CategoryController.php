<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.index');
    }
    function get(Request $request) {
        $data = $request->all();
        $product = Categories::with('parent')->skip($data['skip'] == NULL || $data['skip'] == "null" ? 0 : $data['skip'])->take($data['take'])->orderBy('id' , 'DESC')->get();
        $total = Categories::get()->count();
        return [ 'data' => $product , '__count' => $total ];
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Categories::all();
        return view('admin.category.create' , compact('category'));
    }
    public function Statusupdate(Request $request)
    {
        $category = Categories::find($request->id);
        $category->Status = ($category->status == 0) ? 1 : 0 ;
        $category->save();
        return response()->json([
            "success" => true,
        ] , 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validator = $request->validate(
            [
                'name' => 'required',
                'slug' => 'required',
                'parent_id' => 'required',
                'is_filterable' => 'required',
            ]);
            $data = $request->all();
            Categories::create($data);
            return redirect(route('admin.category'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
