<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Models\MultiPic;
use App\Http\Controllers\ContactContoller;
use App\Http\Controllers\ChangePass;



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

Route::get('/', function () {

    $brands = DB::table('brands')->get();         // to get all data
    $abouts = DB::table('home_abouts')->first();  // to get specific row use first() it faster than get()
    $images = MultiPic::all();
    return view('home',compact('brands','abouts','images'));

});


 // to verify the email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');





// category all Route

Route::get('/category/all' , [CategoryController::class , 'AllCat'])->name('all.category');

Route::post('/category/add' , [CategoryController::class , 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}' , [CategoryController::class , 'Edit']);

Route::post('/category/update/{id}' , [CategoryController::class , 'update']);

Route::get('softdelete/category/{id}' , [CategoryController::class , 'SoftDelete']);

Route::get('category/restore/{id}' , [CategoryController::class , 'Restore']);

Route::get('pdelete/category/{id}' , [CategoryController::class , 'Pdelete']);

// brand Route


Route::get('brand/all' , [BrandController::class , 'AllBrand'])->name('all.brand');

Route::post('store/brand' , [BrandController::class , 'StoreBrand'])->name('store.brand');

Route::get('brand/edit/{id}' , [BrandController::class , 'Edit']);

Route::post('brand/update/{id}' , [BrandController::class , 'Update']);

Route::get('brand/delete/{id}' , [BrandController::class , 'Delete']);



//Multi Image

Route::get('multi/image' , [BrandController::class , 'MultiPic'])->name('multi.image');

Route::post('multi/add' , [BrandController::class , 'StoreImage'])->name('store.image');







// Admin All route


Route::get('home/slider' , [HomeController::class , 'HomeSlider'])->name('home.slider');

Route::get('add/slider' , [HomeController::class , 'AddSlider'])->name('add.slider');

Route::post('store/slider' , [HomeController::class , 'StoreSlider'])->name('store.slider');

Route::get('slider/edit/{id}' , [HomeController::class , 'EditSlider']);

Route::post('slider/update/{id}' , [HomeController::class , 'UpdateSlider']);


Route::get('slider/delete/{id}' , [HomeController::class , 'deleteSlider']);



// home All route

Route::get('home/About' , [AboutController::class , 'HomeAbout'])->name('home.about');

Route::get('add/About' , [AboutController::class , 'AddAbout'])->name('add.about');

Route::post('store/About' , [AboutController::class , 'StoreAbout'])->name('store.about');

Route::get('about/edit/{id}' , [AboutController::class , 'EditAbout']);

Route::post('update/homeabout/{id}' , [AboutController::class , 'UpdateAbout']);

Route::get('about/delete/{id}' , [AboutController::class , 'DeleteAbout']);





//portfolio route

Route::get('portfolio' , [AboutController::class , 'Portfolio'])->name('portfolio');






//admin Contact Page Route




Route::get('admin/contact' , [ContactContoller::class , 'AdminContact'])->name('admin.contact');



Route::get('admin/add/contact' , [ContactContoller::class , 'AdminAddContact'])->name('add.contact');


Route::post('admin/store/contact' , [ContactContoller::class , 'AdminStoreContact'])->name('store.contact');



Route::get('contact/edit/{id}' , [ContactContoller::class , 'AdminEditContact']);

Route::post('contact/update/{id}' , [ContactContoller::class , 'AdminUpdateContact']);

Route::get('contact/delete/{id}' , [ContactContoller::class , 'AdminDeleteContact']);

Route::get('admin/message' , [ContactContoller::class , 'AdminMessge'])->name('admin.message');

Route::get('message/delete/{id}' , [ContactContoller::class , 'AdminDeleteMessge']);







//admin Contact Page Route

Route::get('contact' , [ContactContoller::class , 'Contact'])->name('contact');

Route::post('contact/form' , [ContactContoller::class , 'ContactForm'])->name('contact.form');


// change password and user rofile Route


Route::get('user/password' , [ChangePass::class , 'CPassword'])->name('change.password');

Route::post('password/update' , [ChangePass::class , 'UPassword'])->name('password.update');


// user profile

Route::get('user/profile' , [ChangePass::class , 'PUpdate'])->name('profile.update');

Route::post('user/profile/update' , [ChangePass::class , 'UpdateProfile'])->name('update.user.profile');





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all(); // elquount orm
    // $users  = DB::table('users')->get();                    // DataBase Query Builder
     return view('admin.index');
 })->name('dashboard');

 Route::get('user/logout' , [BrandController::class , 'Logout'])->name('user.logout');






