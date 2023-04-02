<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\EstimatedetalController;
use App\Http\Controllers\ReceiveController;
use App\Http\Controllers\ReceivedetalController;
use App\Http\Controllers\BillController;

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
    return view('home');
})->middleware('auth');

Route::get('/reg', function () {
    return view('register');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('clients')->group(function(){
    Route::get('',[ClientController::class, 'index'])->name('clients.index')->middleware('auth');
    Route::get('create',[ClientController::class,'create'])->name('clients.create')->middleware('auth');
    Route::post('',[ClientController::class, 'store'])->name('clients.store')->middleware('auth');
    Route::get('{client}/edit', [ClientController::class, 'edit'])->name('clients.edit')->middleware('auth');
    Route::patch('{client}', [ClientController::class, 'update'])->name('clients.update')->middleware('auth');
    Route::delete('{client}', [ClientController::class, 'destroy'])->name('clients.destroy')->middleware('auth');

    Route::post('searchclient',[ClientController::class, 'searchclient'])->name('clients.searchclient')->middleware('auth');
});

Route::prefix('products')->group(function(){
    Route::get('',[ProductController::class, 'index'])->name('products.index')->middleware('auth');
    Route::get('create',[ProductController::class,'create'])->name('products.create')->middleware('auth');
    Route::post('',[ProductController::class, 'store'])->name('products.store')->middleware('auth');
    Route::get('{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
    Route::patch('{product}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
    Route::delete('{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');

    Route::post('searchproduct',[ProductController::class, 'searchproduct'])->name('products.searchproduct')->middleware('auth');
});

Route::prefix('people')->group(function(){
    Route::get('',[PersonController::class, 'index'])->name('people.index')->middleware('auth');
    Route::get('create',[PersonController::class,'create'])->name('people.create')->middleware('auth');
    Route::post('',[PersonController::class, 'store'])->name('people.store')->middleware('auth');
    Route::get('{person}/edit', [PersonController::class, 'edit'])->name('people.edit')->middleware('auth');
    Route::patch('{person}', [PersonController::class, 'update'])->name('people.update')->middleware('auth');
    Route::delete('{person}', [PersonController::class, 'destroy'])->name('people.destroy')->middleware('auth');

    Route::post('searchperson',[PersonController::class, 'searchperson'])->name('people.searchperson')->middleware('auth');
});

Route::prefix('estimates')->group(function(){
    Route::get('',[EstimateController::class, 'index'])->name('estimates.index')->middleware('auth');
    Route::get('searchindex',[EstimateController::class, 'searchindex'])->name('estimates.searchindex')->middleware('auth');
    Route::get('create',[EstimateController::class,'create'])->name('estimates.create')->middleware('auth');
    Route::post('',[EstimateController::class, 'store'])->name('estimates.store')->middleware('auth');
    Route::get('{estimate}',[EstimateController::class, 'show'])->name('estimates.show')->middleware('auth');
    Route::get('{estimate}/edit', [EstimateController::class, 'edit'])->name('estimates.edit')->middleware('auth');
    Route::patch('{estimate}', [EstimateController::class, 'update'])->name('estimates.update')->middleware('auth');
    Route::delete('{estimate}', [EstimateController::class, 'destroy'])->name('estimates.destroy')->middleware('auth');

    Route::post('{estimate}/confirm', [EstimateController::class, 'confirm'])->name('estimates.confirm')->middleware('auth');
    Route::post('{estimate}/receive', [EstimateController::class, 'receive'])->name('estimates.receive')->middleware('auth');

    Route::get('{estimate}/copy',[EstimateController::class,'copy'])->name('estimates.copy')->middleware('auth');
    Route::post('copycreate',[EstimateController::class, 'copycreate'])->name('estimates.copycreate')->middleware('auth');
});

Route::prefix('estimatedetails')->group(function(){
    Route::get('create/{estimate}',[EstimatedetalController::class,'create'])->name('estimatedetails.create')->middleware('auth');
    Route::post('',[EstimatedetalController::class, 'store'])->name('estimatedetails.store')->middleware('auth');
    Route::get('{estimatedetail}/edit', [EstimatedetalController::class, 'edit'])->name('estimatedetails.edit')->middleware('auth');
    Route::patch('{estimatedetail}', [EstimatedetalController::class, 'update'])->name('estimatedetails.update')->middleware('auth');
    Route::delete('{estimatedetail}', [EstimatedetalController::class, 'destroy'])->name('estimatedetails.destroy')->middleware('auth');
});

Route::prefix('receive')->group(function(){
    Route::get('',[ReceiveController::class, 'index'])->name('receives.index')->middleware('auth');
    Route::get('searchindex',[ReceiveController::class, 'searchindex'])->name('receives.searchindex')->middleware('auth');
    
    Route::get('create',[ReceiveController::class,'create'])->name('receives.create')->middleware('auth');
    Route::post('',[ReceiveController::class, 'store'])->name('receives.store')->middleware('auth');
    Route::get('estimateindex',[ReceiveController::class, 'estimateindex'])->name('receives.estimateindex')->middleware('auth');
    Route::get('{receive}',[ReceiveController::class, 'show'])->name('receives.show')->middleware('auth');
    
    Route::get('{receive}/edit', [ReceiveController::class, 'edit'])->name('receives.edit')->middleware('auth');
    Route::patch('{receive}', [ReceiveController::class, 'update'])->name('receives.update')->middleware('auth');
    Route::delete('{receive}', [ReceiveController::class, 'destroy'])->name('receives.destroy')->middleware('auth');

    Route::post('{receive}/confirm', [ReceiveController::class, 'confirm'])->name('receives.confirm')->middleware('auth');
 
    
    Route::get('{estimate}/create',[ReceiveController::class,'estimatecreate'])->name('receives.estimatecreate')->middleware('auth');
    Route::post('{estimate}',[ReceiveController::class, 'estimatestore'])->name('receives.estimatestore')->middleware('auth');
});


Route::prefix('receivedetails')->group(function(){
    Route::get('create/{receive}',[ReceivedetalController::class,'create'])->name('receivedetails.create')->middleware('auth');
    Route::post('',[ReceivedetalController::class, 'store'])->name('receivedetails.store')->middleware('auth');
    Route::get('{receivedetail}/edit', [ReceivedetalController::class, 'edit'])->name('receivedetails.edit')->middleware('auth');
    Route::patch('{receivedetail}', [ReceivedetalController::class, 'update'])->name('receivedetails.update')->middleware('auth');
    Route::delete('{receivedetail}', [ReceivedetalController::class, 'destroy'])->name('receivedetails.destroy')->middleware('auth');
});

Route::prefix('bills')->group(function(){
    Route::get('',[BillController::class, 'index'])->name('bills.index')->middleware('auth');
    Route::get('searchindex',[BillController::class, 'searchindex'])->name('bills.searchindex')->middleware('auth');
    Route::get('create/{receive}',[BillController::class, 'create'])->name('bills.create')->middleware('auth');
    Route::post('store/{receive}',[BillController::class, 'store'])->name('bills.store')->middleware('auth');
    Route::get('show/{bill}',[BillController::class, 'show'])->name('bills.show')->middleware('auth');
    Route::get('edit/{bill}',[BillController::class, 'edit'])->name('bills.edit')->middleware('auth');
    Route::patch('{bill}',[BillController::class, 'update'])->name('bills.update')->middleware('auth');
    
    Route::post('confirm/{bill}', [BillController::class, 'confirm'])->name('bills.confirm')->middleware('auth');
    Route::post('process/{bill}', [BillController::class, 'process'])->name('bills.process')->middleware('auth');
});