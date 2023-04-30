<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    
    public function index(Request $request){
        
        $params['chapter'] = (isset($request['chapter'])) ? $request['chapter'] : 'all';
        $params['test_tik'] = (isset($request['test_tik'])) ? $request['test_tik'] : 'all';
        $params['direction'] = (isset($request['direction'])) ? $request['direction'] : "0";
        $params['orderby'] = (isset($request['orderby'])) ? $request['orderby'] : "id";
        
        // return $params;

        $words = Word::where(function($q) use ($params) {
            
                if($params['chapter']  != 'all'){
                    $q->where('chapter', $params['chapter']);
                }

                if($params['test_tik']  != 'all'){
                    $q->where('test_tik', $params['test_tik']);
                }

        })
        ->orderby($params['orderby'],'ASC')
        // ->inRandomOrder()
        ->paginate(100);

        // return $words->total();
        return view('index',compact(['words','params']));

    }

    

    
    public function search(){

        $words = Word::all();
        return view('search',compact(['words']));
        // return $words;
    }

    public function edit($id){
        // return $id;
        $word = Word::whereId($id)->first();
        return view('edit',compact(['word']));

    }

    public function update(Request $request,$id){
        // return $id;
        // return $id;
        $word = Word::whereId($id)->first();
        $word->update($request->all());

        return back();
    }


    public function changeTik($id){
        $word = Word::findorfail($id);

        $newStatus = ($word->test_tik == 0) ? 1 : 0;
        $word->update([
            'test_tik' => $newStatus,
        ]);


        return response([
            'id' => $id,
            'status' => $newStatus
        ]);
    }

}
