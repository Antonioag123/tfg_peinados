<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaypalController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

///////////////////////////////
// PRIVILEGE
// Middleware('can:isAdmin') lo hago para que solo pueda acceder el admin
Route::get('/privilege', [RoleController::class, 'index'])->name('privilege.index')->middleware('can:isAdmin');
Route::get('/privilege/create', [RoleController::class, 'create'])->name('privilege.create')->middleware('can:isAdmin');
Route::post('/privilege/store',[RoleController::class,'store'])->name('privilege.store')->middleware('can:isAdmin');
Route::get('/privilege/{user}/edit',[RoleController::class,'edit'])->name('privilege.edit')->middleware('can:isAdmin');
Route::put('/privilege/update/{user}',[RoleController::class,'update'])->name('privilege.update')->middleware('can:isAdmin');
Route::get('/privilege/show/{user}',[RoleController::class,'show'])->name('privilege.show')->middleware('can:isAdmin');
Route::delete('/privilege/destroy/{user}',[RoleController::class,'destroy'])->name('privilege.destroy')->middleware('can:isAdmin');
///////////////////////////////

///////////////////////////////
// SCHEDULE
Route::resource('/schedule',ScheduleController::class);
//  Lo tengo que llamar distinto porque sino da problemas
Route::get('/events/list',[ScheduleController::class,'event_list'])->name('event.list')->middleware('can:isAdmin');
Route::get('/events/{id}/edit',[ScheduleController::class,'event_edit'])->name('event.edit')->middleware('can:isAdmin');
Route::put('/event/update/{id}',[ScheduleController::class,'event_update'])->name('event.update')->middleware('can:isAdmin');

///////////////////////////////

///////////////////////////////
// Products
Route::resource('/products',ProductController::class);
Route::post('/products/addProduct/{id}',[ProductController::class,'addProduct'])->name('products.addProduct');
///////////////////////////////

///////////////////////////////
// Carts
Route::get('/cart/listar',[ProductController::class,'listar_productos'])->name('cart.listar');
Route::delete('/delete_product_cart',[ProductController::class,'deleteProductCart'])->name('delete.product.cart');
///////////////////////////////


////////////////////////////////////////
// Paypal
Route::post('/paypal',[PaypalController::class,'paypal'])->name('paypal');
Route::get('/success',[PaypalController::class,'success'])->name('success');
Route::get('/cancel',[PaypalController::class,'cancel'])->name('cancel');
///////////////////////////////////////


///////////////////////////////////////
// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
