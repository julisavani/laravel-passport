<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Models\Products;
use Illuminate\Support\Facades\Route;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin/login', [DashboardController::class, 'login'])->name('login');
Route::post('/login', [DashboardController::class, 'postLogin'])->name('admin.postLogin');
Route::get('/', [DashboardController::class, 'login'])->name('login');
// Route::get('/register', [DashboardController::class, 'register'])->name('admin.register');


Route::group(['middleware' => ['auth:web'], 'as' => 'admin.' , 'prefix' => 'admin'], function ()
{
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get("/", function () {
        return redirect(url("admin/dashboard"));
    })->name('dashboard');
    Route::get("/dashboard", [DashboardController::class , "index"]);
    //order summuery
    Route::get("/orders", [DashboardController::class , "orders"])->name('orders');
    Route::get("/payment-history", [DashboardController::class , "paymentHistory"])->name('payment-history');
    Route::get("/dashboard", [DashboardController::class , "index"]);

    //product
    Route::group(['prefix' => 'category' ], function()
    {
        Route::get("/", [CategoryController::class , "index"])->name('category');
        Route::get("/create", [CategoryController::class , "create"])->name('category.create');
        Route::get("/get", [CategoryController::class , "get"])->name('get');
      
        Route::get("/status-update/{id}", [CategoryController::class, 'Statusupdate']);
        Route::post("/store", [CategoryController::class , "store"])->name('category.store');
    });
    //product
    Route::group(['prefix' => 'product'], function()
    {
        Route::get("/", [ProductController::class , "index"])->name('product');
        Route::get("/create", [ProductController::class , "create"])->name('product.create');
        Route::get("/get-category-data/{id}", [ProductController::class , "getCategory"]);
        Route::get("/get", [ProductController::class , "get"])->name('edit');
        Route::get("/delete/{id}", [ProductController::class , "destroy"])->name('delete');
        Route::get("{id}/edit", [ProductController::class , "edit"])->name('get');
        Route::post("/store", [ProductController::class , "store"])->name('product.store');
    });

    Route::get("test", function () {
    $product_gallery = [
            "17" => [
                "https://sixty13.com/storage/blog/Olive%20Halo%20Ring%20(1).jpg",
                "https://sixty13.com/storage/blog/Olive%20Halo%20Ring%20(3).jpg"
            ],
            "63" => [
                "https://sixty13.com/storage/blog/Oval%20Allure%20Eternity%20Band%20(4).jpg",
                "https://sixty13.com/storage/blog/Oval%20Allure%20Eternity%20Band%20(5).jpg"
            
            ]
        ];

    foreach ($product_gallery as $key => $value) {
        $product = Products::find($key);
        foreach ($value as $k => $v) {
            $product->addMediaFromUrl($v)->toMediaCollection('square_wall_product_images');
        }
    }
});

Route::get('test-2', function () {
    $products = Products::take(1)->get();
    foreach ($products as $key => $value) {
        $model_id = $value->id;
        $medias = Media::where('model_id', $model_id)->get();
        $product = Products::find($model_id);
        foreach ($medias as $k => $v) {
            $product->addMediaFromUrl('https://andor-server.sixty13.com/storage/'.$v->id."/".$v->file_name)->withResponsiveImages()->toMediaCollection($v->collection_name);
            echo "<pre>";
            print_r($product);
        }
        // dd($model_id);
    }
    dd($products);
});
});