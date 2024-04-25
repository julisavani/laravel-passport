<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Categorywiseproduct;
use App\Models\Country;
use App\Models\CountryState;
use App\Models\FavouriteProduct;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomescreenController extends Controller
{
    function navbarmenus() {
        try {
            $navbarArr = Categories::where('parent_id', NULL)->get()->toArray();
            foreach ($navbarArr as $key => $value) {
                $level1 = Categories::where('parent_id', $value['id'])->get()->toArray();
                foreach ($level1 as $k => $v) {
                    $level2 = Categories::where('parent_id', $v['id'])->get()->toArray();
                    foreach ($level2 as $i => $j) {
                        $level3 = Categories::where('parent_id', $j['id'])->get()->toArray();
                        $level2[$i]['level3'] = $level3;
                    }
                    $level1[$k]['level2'] = $level2;
                }
                $navbarArr[$key]['level1'] = $level1;
            }
            return response()->json([
                "success" => true,
                "data" => $navbarArr,
                "status_code" => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "data" => ["message" => $e->getMessage()],
                "status_code" => 500
            ]);
        }
    }

    function productdetail($id) {
        try {
            $product = Products::where('id', $id)->with(['imageGallery'])->first();
            return response()->json([
                "success" => true,
                "data" => $product,
                "status_code" => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "data" => ["message" => $e->getMessage()],
                "status_code" => 500
            ]);
        }

    }
    function getState($country){
        $where = [];
        if($country) $where['country_id'] = $country;
        $state = CountryState::where($where)->get();
        return response()->json([
            "success" => false,
            "data" => $state,
        ]);

    }
    function country(){
        $country = Country::where('id' , 101)->get();
        return response()->json([
            "success" => false,
            "data" => $country,
        ]);
    }
    function addFavourite($id){
        $product = FavouriteProduct::firstOrCreate(['user_id' => Auth::guard('api')->user()->id , 'product_id' => $id ] );
        return response()->json([
            "success" => true,
            "data" => $product,
            "status_code" => 200
        ]);
    }
    function removeFavouriteProduct($id){
       $fav = FavouriteProduct::find($id);
        if($fav){
            $fav->delete();
        }else{
            return response()->json([
                "success" => false,
                "status_code" => 500
            ]);
        }
        return response()->json([
            "success" => true,
            "status_code" => 200
        ]);
    }
    function favouriteList(){
        $product = FavouriteProduct::with('product')->where('user_id', Auth::guard('api')->user()->id )->get();
        return response()->json([
            "success" => true,
            "data" => $product,
            "status_code" => 200
        ]);
    }
    function productlist(Request $request, $slug) {
        try {
            $page = 1;
            if($request->has('page')) {
                $page = $request->page;
            }
            $category_id = Categories::where('slug', $slug)->pluck('id')->toArray()[0];
           
            $products_id = Categorywiseproduct::where('category_id', $category_id)->pluck('product_id')->toArray();
            $products = Products::whereIn('id', $products_id)->skip(($page - 1) * 20)->take(20)->get()->map(function($params){
                if(Auth::check('api')){
                    $fav = FavouriteProduct::where([ 'user_id' => Auth::guard('api')->user()->id , 'product_id' => $params->id ])->first();
                    $params['favourite'] = ($fav) ? true : false;
                }
                $params['favourite'] = false;
                $media_arr = [];
                $media = $params->getMedia("square_wall_product_images");
                foreach ($media as $k => $v) {
                    $media_arr[] = $v->getUrl('medium');
                }
                $params['media_arr'] = $media_arr;
                unset($params['media']);
                return $params;
            });
          
            return response()->json([
                "success" => true,
                "data" => $products,
                "status_code" => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "data" => ["message" => $e->getMessage()],
                "status_code" => 500
            ]);
        }

    }

    function productImageUpload($product_gallery, $collection) {
        try {
            foreach ($product_gallery as $key => $value) {
                $product = Products::find($key);
                foreach ($value as $k => $v) {
                    $product->addMediaFromUrl($v)->toMediaCollection($collection);
                }
            }
            return response()->json([
                "success" => true,
                "message" => "Images uploaded successfully.",
                "status_code" => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "data" => ["message" => $e->getMessage()],
                "status_code" => 500
            ]);
        }

    }


}
