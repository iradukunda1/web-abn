<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Merchant;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact-us','HomeController@contact')->name('contact-us');
Route::get('/about-us','HomeController@about')->name('about');
Route::get('/services','HomeController@services')->name('services');

Route::resource('/products', ProductsController::class);


Route::get('/home', 'HomeController@index')->name('home')->middleware('check_redirection');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::middleware('check_is_admin')->group(function () {
            Route::get('/', 'AdminController@index')->name('admin.index');
            Route::resource('/products', 'AdminProductController');
            Route::get('users', 'AdminUserManagementController@users');
            Route::get('users/agents', 'AdminUserManagementController@agents');
            Route::get('/merchants/list', function(){
                $merchants = Merchant::latest()->paginate(30);
                foreach($merchants as $merchant){                        
                    $merchant['agent']= User::where('id',$merchant->registered_by)->first();
                }
                return view('admin.users.merchants.list',compact('merchants'));
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
        });
    });    
    Route::prefix('agent')->group(function () {
        Route::middleware('check_is_agent')->group(function () {
            Route::get('/', 'AgentController@index');     
            Route::get('/agent/organizations/list', 'AgentOrganizationManagement@index');      
            Route::post("/profile/{user}", "AdminUserManagementController@profile");
            Route::get("/profile", "AdminUserManagementController@getProfile");
            Route::resource("/merchants","MerchentsControllerManagement");
            Route::get('/merchant/lists', function () {   
                $merchants = Merchant::where('registered_by',auth()->user()->id)->where('active',1)->paginate(30);             
                return view('agent.merchants.list',compact('merchants'));
            });
            Route::resource('orders','OrderController');
            Route::Apiresource("/api/bussiness/category", "BussinesCategoryController");
            Route::get("/products/list","AdminProductController@agentProducts");
        });
    });
});
Route::get('/products/details/{product}', 'AdminProductController@show');
Route::get("/api/user", function () {
    $user = auth()->user();
    $user->type = $user->roles->first()->name;
    return response(["user" => $user]);
})->middleware("auth");
Route::post("/profile/{user}", "AdminUserManagementController@profile");
Route::get('login', [

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