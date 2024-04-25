<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Categorywiseproduct;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Product;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('admin.product.index');
    }
    function get(Request $request) {
        $data = $request->all();
        $product = Products::skip($data['skip'] == NULL || $data['skip'] == "null" ? 0 : $data['skip'])->take($data['take'])->orderBy('id' , 'DESC')->get()->map(function($params){
            $media_arr = [];
            $media = $params->getMedia("square_wall_product_images");
            foreach ($media as $k => $v) {
                $media_arr[] = $v->getUrl('medium');
            }
            $params['media_arr'] = $media_arr;
            unset($params['media']);
            return $params;
        });
        $total = Products::get()->count();
        return [ 'data' => $product , '__count' => $total ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Categories::where('parent_id', NULL)->get();
        $navbarArr = Categories::where('parent_id', NULL)->get()->toArray();
        foreach ($navbarArr as $key => $value) {
            $level1 = Categories::where('parent_id', $value['id'])->get()->toArray();
            foreach ($level1 as $k => $v) {
                $level2 = Categories::where('parent_id', $v['id'])->get()->toArray();
                foreach ($level2 as $i => $j) {
                    $level3 = Categories::where('parent_id', $j['id'])->get()->toArray();
                    $level2[$i]['level3'] = $level3;
                    foreach ($level3 as $q => $l) {
                        $level3 = Categories::where('parent_id', $l['id'])->get()->toArray();
                        $level2[$i]['level3'][$q]['go-back'] = count($level3);
                    }
                  }
                $level1[$k]['level2'] = $level2;
            }
            $navbarArr[$key]['level1'] = $level1;
        }
        $type=1;
        return view('admin.product.create' , compact('navbarArr' , 'type' ,'category'));
    }
   

    public function getCategory($id , Request $request){
            $product = $request->product_id;
            $categoryId = [];
            if($product){
                $categoryId = Categorywiseproduct::where('product_id' , $product )->pluck('category_id')->toArray();
            }
            $level1 = Categories::where('parent_id', $id)->get()->toArray();
            foreach ($level1 as $k => $v) {
                $level2 = Categories::where('parent_id', $v['id'])->get()->toArray();
                foreach ($level2 as $i => $j) {
                    $level3 = Categories::where('parent_id', $j['id'])->get()->toArray();
                    $level2[$i]['level3'] = $level3;
                    foreach ($level3 as $q => $l) {
                        $level3 = Categories::where('parent_id', $l['id'])->get()->toArray();
                        $level2[$i]['level3'][$q]['go-back'] = count($level3);
                    }
                  }
                $level1[$k]['level2'] = $level2;
            }
           
            return view('admin.product.category-data' , compact('level1' , 'categoryId'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    //    dd($request->file('preview_image'));
        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            // 'image' => 'required',
            // 'preview_image' => 'required',
            // 'caption' => 'required',
            'product_price' => 'required',
            'category' => 'required',
        ]);
        $data = $request->all();
        if($validator->fails()){
            return response()->json(['success' => false, "error" => $this->validationMessage($validator->errors()->toArray())], 422);
        }
        if($data['id'] != ""){
            Products::where( 'id' , $data['id'])->update(['title' => $data['title'] , 'category_id' => $data['category'] , 'item_detail' => json_encode($request['item-detail']) , 'diamond_detail' =>  json_encode($request['center-diamond']) , 'side_diamond_detail' => json_encode($request['side-diamond']) , 'product_price' => $data['product_price']]);
            $categoryArr = explode("," , $data['category_arr']);
            Categorywiseproduct::where('product_id' ,  $data['id'])->delete();
            if(count($categoryArr) > 0){
                foreach($categoryArr as $arr){
                    if($arr != "")  Categorywiseproduct::create([ 'category_id' => $arr , 'product_id' => $data['id'] ]);
                }
            }
            $product = Products::find( $data['id']);
            if($request->has('image')){
                $media = Media::where([ 'model_id' =>  $data['id'] , 'collection_name' => 'square_wall_product_images'])->get();
                foreach ($media as $k => $v) {
                    $file = storage_path('app/public/'.$v->id);
                    File::deleteDirectory($file);
                }
                Media::where([ 'model_id' =>  $data['id'] , 'collection_name' => 'square_wall_product_images'])->delete();
                foreach($request->file('image') as $key => $Val) {
                    $product->addMedia($Val)->toMediaCollection('square_wall_product_images');
                }
            }
            // dd($request->has('preview_image'));
            if($request->has('preview_image')){
                $media = Media::where([ 'model_id' =>  $data['id'] , 'collection_name' => 'product_gallery'])->get();
                foreach ($media as $k => $v) {
                    $file = storage_path('app/public/'.$v->id);
                    File::deleteDirectory($file);
                }
                Media::where([ 'model_id' =>  $data['id'] , 'collection_name' => 'product_gallery'])->delete();
                foreach($request->file('preview_image') as $key => $Val) {
                    $product->addMedia($Val)->toMediaCollection('product_gallery' );
                }
            }
            
        }else{
            $product = Products::insertGetId(['title' => $data['title'] , 'category_id' => $data['category'] , 'item_detail' => json_encode($request['item-detail']) , 'diamond_detail' =>  json_encode($request['center-diamond']) , 'side_diamond_detail' => json_encode($request['side-diamond']) , 'product_price' => $data['product_price']]);
            $categoryArr = explode("," , $data['category_arr']);
            foreach($categoryArr as $arr){
                Categorywiseproduct::create([ 'category_id' => $arr , 'product_id' => $product ]);
            }
            if($request->has('image')){
                $product = Products::find($product);
                foreach($request->file('image') as $key => $Val) {
                    $product->addMedia($Val)->toMediaCollection('square_wall_product_images');
                }
            }
           
            if($request->has('preview_image')){
                foreach($request->file('preview_image') as $key => $Val) {
                    $product->addMedia($Val)->toMediaCollection('product_gallery');
                }
            }
        }
      
       
        return response()->json(['success' => true, 'data' => ['message' => 'Customer stored successfully']], 200);
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
        $category = Categories::where('parent_id', NULL)->get();
        $navbarArr = Categories::where('parent_id', NULL)->get()->toArray();
        foreach ($navbarArr as $key => $value) {
            $level1 = Categories::where('parent_id', $value['id'])->get()->toArray();
            foreach ($level1 as $k => $v) {
                $level2 = Categories::where('parent_id', $v['id'])->get()->toArray();
                foreach ($level2 as $i => $j) {
                    $level3 = Categories::where('parent_id', $j['id'])->get()->toArray();
                    $level2[$i]['level3'] = $level3;
                    foreach ($level3 as $q => $l) {
                        $level3 = Categories::where('parent_id', $l['id'])->get()->toArray();
                        $level2[$i]['level3'][$q]['go-back'] = count($level3);
                    }
                  }
                $level1[$k]['level2'] = $level2;
            }
            $navbarArr[$key]['level1'] = $level1;
        }
        $type= 2;
        $product = Products::find($id);
        $data['product'] = $product;
        $media_arr = [];
        $media = Media::where('model_id' , $id);
        $media_arr = [];
        $media = $product->getMedia("square_wall_product_images");
        $media_arr = [];
        foreach ($media as $k => $v) {
            $media_arr[] = $v->getUrl('medium');
        }
        $data['media_arr'] = $media_arr;
        $pmedia = $product->getMedia("product_gallery");
        $preview_media_arr = [];
        foreach ($pmedia as $k => $v) {
            $preview_media_arr[] = $v->getUrl('thumb');
        }
        $data['preview_media_arr'] = $preview_media_arr;
        $data['category_arr'] =  Categorywiseproduct::where('product_id' , $id)->pluck('category_id');
        return view('admin.product.create' , compact('navbarArr' , 'category' , 'type' , 'data'));
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
        try {
            $product = Products::find($id);
            $media = Media::where([ 'model_id' =>  $id , 'collection_name' => 'square_wall_product_images'])->get();
                foreach ($media as $k => $v) {
                    $file = storage_path('app/public/'.$v->id);
                    File::deleteDirectory($file);
                }
            $pmedia = Media::where([ 'model_id' =>  $id , 'collection_name' => 'product_gallery'])->get();
            foreach ($pmedia as $k => $v) {
                $file = storage_path('app/public/'.$v->id);
                File::deleteDirectory($file);
            }
            Media::where([ 'model_id' =>  $id ])->delete();
            Categorywiseproduct::where('product_id' ,  $id)->delete();
                
            $product->delete();
            return response()->json(['success' => true,'message' => 'Product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['message' => $e->getMessage()]], 500);
        }
    }
}
