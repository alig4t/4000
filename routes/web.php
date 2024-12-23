<?php

use App\Models\Word;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

// Route::get('/', function () {
    // return view('welcome');
    // return 'sss';

//    $words=  DB::select('select * from word4');
// //     $length = [];

//    foreach($words as $row){
//         // if(strlen($row->description) > 255){
//         //     return 'error';
//         // }
//         // array_push($length , strlen($row->example));
        
//             // $new = new Words();
//             // $new->eng = $row->eng;
//             // $new->per = $row->per;
//             // $new->chapter = $row->chapter;
//             // $new->unit = $row->unit;
//             // $new->test_tik = $row->tik;
//             // $new->fa_test_tik = $row->fa_tik;
//             // $new->description = $row->description;
//             // $new->example = $row->example;
//             // $new->example_trs = $row->example_trs;
    
//             // $new->save();
        
        

//    }
//     return $length;

    // $words = Words::all();
    // return $words;
// });

Route::get('/words/{id}/edit', 'App\Http\Controllers\HomeController@edit')->name('word.formupdate')->middleware('auth');

Route::patch('/words/{id}/', 'App\Http\Controllers\HomeController@update')->name('word.update')->middleware('auth');

Route::get('/words/{id}/', function($id){
    return redirect()->route('word.formupdate',['id' => $id]);;
});


Route::post('/words/{id}/tik/{dir}', 'App\Http\Controllers\HomeController@changeTik')->middleware('auth');


Route::get('/', 'App\Http\Controllers\HomeController@index')->middleware('auth');




Route::get('/phrasal-verbs', 'App\Http\Controllers\PhrasalController@index')->middleware('auth')->name('phrasal.index');
Route::get('/phrasal-verbs/add', 'App\Http\Controllers\PhrasalController@add')->middleware('auth')->name('phrasal.add');
Route::post('/phrasal', 'App\Http\Controllers\PhrasalController@store')->name('phrasal.store')->middleware('auth');
Route::get('/phrasal/{id}/edit', 'App\Http\Controllers\PhrasalController@edit')->name('phrasal.formupdate')->middleware('auth');
Route::patch('/phrasal/{id}/', 'App\Http\Controllers\PhrasalController@update')->name('phrasal.update')->middleware('auth');




Route::get('/search', 'App\Http\Controllers\HomeController@search')->name('search');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
