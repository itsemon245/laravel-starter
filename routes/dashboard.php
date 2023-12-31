<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ClientController;


Route::prefix( 'dashboard' )
    ->middleware( [ 'auth', 'verified' ] )
    ->group( function () {

        Route::get( '/', function () {
            return view( 'dashboard.index' );
        } )->name( 'dashboard' );

        Route::resource( 'client', ClientController::class);
    } );