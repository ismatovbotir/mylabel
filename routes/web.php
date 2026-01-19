<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\PlanController;


use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TelegramController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [RouteController::class,'index'])->name('index');

//Route::resource('/telegram',TelegramController::class);
Route::get('/sprt',function(){
    return view('sprt');
});

Route::get('/invoice',function(){
    return view('invoice');
})->name('invoice');

Route::get('/reciept',function(){
    return view('pos');
})->name('pos');

Route::get('/bills/{id}',[OrderController::class,'bill'])->name('order.bill');

Route::get('/offers/{id}',[OfferController::class,'print'])->name('offer.print');



Route::get('/livewire',function(){
    return view('livewire');
});

Route::group(['as'=>'admin.','middleware'=>'auth','prefix'=>'crm'],function(){
    
    Route::get('/',function(){
        return view('welcome');
    });

    Route::group([],function(){
        Route::get('/company/refresh',[CompanyController::class,'refresh'])->name('company.refresh');
        Route::get('/company/{company}/newOrder',[CompanyController::class,'newOrder'])->name('company.newOrder');
        Route::resource('/company',CompanyController::class);
    });
    Route::group([],function(){
        Route::get('/item/refresh',[ItemController::class,'refresh'])->name('item.refresh');
        Route::get('/item/{item}/report',[ItemController::class,'report'])->name('item.report');
        Route::resource('/item',ItemController::class);
    });

    Route::group([],function(){
        //Route::get('/item/refresh',[ItemController::class,'refresh'])->name('item.refresh');

        Route::resource('/user',UserController::class);
    });

    Route::group([],function(){
       
        Route::resource('/bank',BankController::class);
    });
    Route::group([],function(){
       
        Route::resource('/plan',PlanController::class);
    });

    Route::group([],function(){
        Route::get('/order/{id}/bill',[OrderController::class,'bill'])->name('order.bill');
        Route::resource('/order',OrderController::class);
    });

    Route::group([],function(){
        
        Route::resource('/offer',OfferController::class);
    });
    Route::group([],function(){
        
        Route::resource('/delivery',DeliveryController::class);
    });
    Route::group([],function(){
        
        Route::resource('/bill',BillController::class);
    });
    Route::group([],function(){
        Route::resource('/telegram',TelegramController::class);
    });
    Route::group([],function(){
        Route::resource('/task',TaskController::class);
    });





    Route::group([],function(){
       
        Route::get('/reports/company/{stir}',[ReportController::class,'company'])->name('report.company');
    });

   

    



    //Route::resource('/offer',OfferController::class);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
