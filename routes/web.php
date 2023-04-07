<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DaySheetController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\StockController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Auth::routes(['register' => false]);


Route::middleware('auth')->group(function(){

    Route::get('/',[DashBoardController::class,'index']);

    Route::get('/home', [DashBoardController::class,'index']);
    
    // brand start
    Route::prefix('brand')->group(function(){
    
        Route::get('/',function(){
            return view('sv.brand.index');
        
        });
        
        Route::post('/createbrand',[BrandController::class,'create']);
        Route::get('/fetch_brand',[BrandController::class,'fetchbrand']);
        Route::post('/fetchSelectedBrand',[BrandController::class,'fetchselectedbrand']);
        Route::post('/editBrand',[BrandController::class,'editbrand']);
        Route::post('/trash',[BrandController::class,'trash']);
    
    });
    //brand end
    
    // categories start
    Route::prefix('category')->group(function(){
        Route::get('/',function(){
            return view('sv.category.index');
        });
        Route::post('/create_category',[CategoryController::class,'create']);
        Route::get('/fetchCategories',[CategoryController::class,'fetchCategories']);
        Route::post('/fetchSelectedCategories',[CategoryController::class,'fetchSelectedCategories']);
    
        Route::post('/edit_category',[CategoryController::class,'editCategory']);
    
        Route::post('/trash',[CategoryController::class,'trash']);
    
    
    });
    // categories end
    
    //product start
    Route::prefix('product')->group(function(){
        Route::get('/',function(){
            return view('sv.product.index');
        
        });
        Route::get('/add_product',function(){
            return view('sv.product.add_product');
        });
        Route::post('/createProduct',[ProductController::class,'create']);
        Route::get('/fetchProduct',[ProductController::class,'fetchProduct']);
        Route::post('/fetchSelectedProduct ',[ProductController::class,'fetchSelectedProduct']);
        Route::post('/fetchProductData ',[ProductController::class,'fetchProductData']);
        Route::post('/trash ',[ProductController::class,'trash']);
    
        Route::post('/editProduct ',[ProductController::class,'editProduct']);
    
    });
    
    
    // product end
    
    Route::prefix('orders')->group(function(){
    
        Route::get('/add_order',function(){
            return view('sv.order.add_order');
        });
        
        Route::post('/insert_order',[OrderController::class,'create']);
        
        Route::get('/manage',function(){
            return view('sv.order.manage_order');
        });
    
        Route::get('/fetchOrders',[OrderController::class,'fetchOrders']);
    
        Route::post('/removeOrder',[OrderController::class,'removeOrder']);
    
        Route::get('/manage/view_order/{orderId}',[OrderController::class,'viewOrder']);
    
    });
    
    //orders end
    
    //service start
    
    Route::prefix('service')->group(function () {
    
        Route::get('/add_service_type',function(){
            return view('sv.service.add_service_types');
        });
    
        Route::get('/fetchServiceTypes',[ServiceController::class,'fetchServiceTypesData']);
    
        Route::post('/insert_service_type',[ServiceController::class,'insert_service_type']);
    
        
        Route::get('/add_service',function(){
            return view('sv.service.add_service');
        });
        
        Route::post('/fetchSelectedService',[ServiceController::class,'fetchSelectedService']);
        
        Route::get('/fetchService',[ServiceController::class,'fetchService']);
        
        Route::post('/insert_service',[ServiceController::class,'insertService']);
        
        Route::post('/fetchServiceData',[ServiceController::class,'fetchServiceData']);
        
        
        
        Route::get('/manage',function(){
            return view('sv.service.manage_service');
        });
    
        Route::get('/',function(){
            return view('sv.service.manage_service');
        });
    
        Route::get('/manage/view_service/{service_id}',[ServiceController::class,'viewService']);
        
        Route::get('/print/{service_id}',[ServiceController::class,'print']);
    
        Route::post('/trash',[ServiceController::class,'trash']);
    
    });
    //service end
    
    //day sheet
    Route::prefix('daysheet')->group(function () {
    
        Route::get('/',[DaySheetController::class,'index']);
    
        Route::post('/fetchdata',[DaySheetController::class,'fetchdata']);
    
    });
    
    //expense
    Route::prefix('expense')->group(function () {
    
        Route::get('/',function(){
            return view('sv.expense.index');
        
        });
        
        Route::post('/createExpense',[ExpenseController::class,'create']);
        Route::get('/fetchExpense',[ExpenseController::class,'fetchExpense']);
        Route::post('/fetchSelectedBrand',[ExpenseController::class,'fetchselectedbrand']);
        Route::post('/editBrand',[ExpenseController::class,'editbrand']);
        Route::post('/trash',[ExpenseController::class,'trash']);
    
    });
    
    
    
    
    Route::prefix('stock')->group(function () {
    
        Route::get('/',function(){
            return view('sv.stock.index');
        
        });
        
        Route::get('/add_stock',[StockController::class,'add_stock']);
        Route::get('/getStockEntryOptions',[StockController::class,'getStockEntryOptions']);
        Route::post('/insert_stock',[StockController::class,'insertStock']);
        Route::get('/fetchStock',[StockController::class,'fetchStock']);
        Route::post('/trash',[StockController::class,'trash']);
    
    });
});