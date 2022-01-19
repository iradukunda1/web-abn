<?php

use App\Http\Controllers\AdminUserManagementController;
use App\Http\Controllers\DistrictManagerController;
use App\Http\Controllers\ProvinceManagerController;
use App\Http\Controllers\StockManagerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Merchant;
use App\User;
use jeremykenedy\LaravelRoles\Models\Role;

Route::get('/', function () {
    return view('index');
    //return view('welcome');
});

Route::get('/contact-us', 'HomeController@contact')->name('contact-us');
Route::get('/about-us', 'HomeController@about')->name('about');
Route::get('/services', 'HomeController@services')->name('services');

Route::resource('/products', ProductsController::class);
Route::get('/product-detail/{slug}', 'HomeController@productdetail')->name('productdetail');
Route::get('/checkout', 'HomeController@checkout')->name('checkout');
Route::get('/home', 'HomeController@index')->name('home')->middleware('check_redirection');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::middleware('check_is_admin')->group(function () {
            Route::get('/', 'AdminController@index')->name('admin.index');
            Route::resource('/products', 'AdminProductController');
            Route::get('users', 'AdminUserManagementController@users');
            Route::get('users/agents', 'AdminUserManagementController@agents');
            Route::get('user/province', 'AdminUserManagementController@province')->name('user.province');
            Route::get('user/district', 'AdminUserManagementController@district')->name('user.district');
            Route::get('user/province/create', [AdminUserManagementController::class, 'createProvince'])->name('user.province.create');
            Route::get('user/district/create', [AdminUserManagementController::class, 'createDistrict'])->name('user.district.create');
            Route::post('user/province/store', [AdminUserManagementController::class, 'storeProvince'])->name('user.province.store');
            Route::post('user/district/store', [AdminUserManagementController::class, 'storeDistrict'])->name('user.district.store');
            Route::get('/merchants/list', function () {
                $merchants = Merchant::latest()->paginate(30);
                foreach ($merchants as $merchant) {
                    $merchant['agent'] = User::where('id', $merchant->registered_by)->first();
                }
                return view('admin.users.merchants.list', compact('merchants'));
            });
            Route::Apiresource("/api/users", "AdminUserManagementController");
            Route::put('api/user/verify/{user}', 'AdminUserManagementController@verify');
            Route::delete("/api/user/{user}", "AdminUserManagementController@destroy");
            Route::get("/categories", "CategoryController@getCategory");
            Route::Apiresource("/api/category", "CategoryController");
            Route::get("/bussiness/categories", "BussinesCategoryController@getCategory");
            Route::Apiresource("/api/bussiness/category", "BussinesCategoryController");
            Route::get("/product/images/{product}", "AdminProductController@image");
            Route::post("/product/images/{product}", "AdminProductController@storeImages");
            Route::get("/profile", "AdminUserManagementController@getProfile");
            Route::get('/orders/list', 'OrderController@adminList');
            Route::get('/order/{order}', 'OrderController@adminShow');
        });
    });
    Route::prefix('agent')->group(function () {
        Route::middleware('check_is_agent', 'is_profile_completed')->group(function () {
            Route::get('/', 'AgentController@index');
            Route::get('/agent/organizations/list', 'AgentOrganizationManagement@index');
            Route::post("/profile/{user}", "AdminUserManagementController@profile");
            Route::get("/profile", "AdminUserManagementController@getProfile");
            Route::resource("/merchants", "MerchentsControllerManagement");
            Route::get('/merchant/lists', function () {
                $merchants = Merchant::where('registered_by', auth()->user()->id)->where('active', 1)->paginate(30);
                return view('agent.merchants.list', compact('merchants'));
            });
            Route::resource('orders', 'OrderController');
            Route::Apiresource("/api/bussiness/category", "BussinesCategoryController");
            Route::get("/products/list", "AdminProductController@agentProducts");
        });
    });
    Route::prefix('province')->group(function () {
        Route::middleware('reporter_1')->group(function () {
            Route::get('/', [ProvinceManagerController::class, 'index'])->name('province.index');
            Route::get('/agents', 'ProvinceManagerController@agents_list');
            Route::get('/districts-managers', 'ProvinceManagerController@district_managers');
            Route::get('/mechent', [ProvinceManagerController::class, 'mechent_report'])->name('province.mechents');
            Route::get('/request', 'ProvinceManagerController@all_request')->name('province.all_request');
            Route::get('/profile', 'ProvinceManagerController@edit')->name('province.profile');
        });
    });
    Route::prefix('district')->group(function () {
        Route::middleware('reporter_2')->group(function () {
            Route::get('/', [DistrictManagerController::class, 'index'])->name('district.index');
            Route::get('/agent', [DistrictManagerController::class, 'agent_report'])->name('district.agent');
            Route::get('/merchent', [DistrictManagerController::class, 'merchent_report'])->name('district.merchent');
            Route::get('/profile', 'DistrictManagerController@show')->name('district.profile');
            Route::get('/request', [DistrictManagerController::class, 'all_request'])->name('district.request');
        });
    });
    // Route::prefix('customer')->group(function(){
    //     Route::middleware('user')->group(function(){
    //         Route::get('/','HomeController@checkout')->name('checkout');
    //     });

    // });
    Route::get('/complete/profile', 'AgentController@complete_profile');
    Route::post('/complete/profile/store/{user}', 'AgentController@profile_store');
    Route::prefix('/stock')->group(function () {
        Route::get('/', [StockManagerController::class, 'index'])->name('manager.index');
        Route::get('/stockIn', [StockManagerController::class, 'stockIn'])->name('manager.stockIn');
        Route::post('/stockIn/store', [StockManagerController::class, 'stockIn_store'])->name('manager.stockInStore');
        Route::get('/stockInList', [StockManagerController::class, 'stockInList'])->name('manager.stockInList');
        Route::get('/stockOut', [StockManagerController::class, 'stockOut'])->name('manager.stockOut');
        Route::get('/stockOutList', [StockManagerController::class, 'stockOutList'])->name('manager.stockOutList');
        Route::post('/stockout/search/category', [StockManagerController::class, 'Category_Stock'])->name('manager.stockSearch');
        Route::post('stockout/search/product', [StockManagerController::class, 'Search_Product_Stock'])->name('manager.stockSearchProduct');
        Route::post('/stockOut/Store', [StockManagerController::class, 'stockOut_store'])->name('manager.stockOutStore');
        Route::get('/stock/report', [StockManagerController::class, 'report'])->name('manager.report');
        Route::get('/stockIn/edit/{id}', [StockManagerController::class, 'edit'])->name('manager.edit');
        Route::get('stock/profile', [StockManagerController::class, 'profile'])->name('manager.profile');
    });




    Route::get('/complete/profile', 'AgentController@complete_profile');
    Route::post('/complete/profile/store/{user}', 'AgentController@profile_store');
});

Route::get('/order/{order}', 'OrderController@agentShow');

Route::get('/products/details/{product}', 'AdminProductController@show');

Route::get("/api/user", function () {
    $user = auth()->user();
    $user->type = $user->roles->first()->name;
    return response(["user" => $user]);
})->middleware("auth");
Route::post("/profile/{user}", "AdminUserManagementController@profile");
Route::get(
    'login',
    [

        'uses' => 'Auth\LoginController@showLoginForm',
    ]
)->name('login');

Route::post('login', [
    'uses' => 'Auth\LoginController@login',
    'middleware' => 'checkverified',
]);

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('user/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
