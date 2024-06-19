<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    
    
    public function index(Request $request){
        

        // $user = Auth::user();
        // dd($user);

        // return $request;
        $Asc_Desc = 'ASC';
        $orderBy = 'id';

        $params['chapter'] = (isset($request['chapter'])) ? $request['chapter'] : 'all';
        $params['test_tik'] = (isset($request['test_tik'])) ? $request['test_tik'] : 'all';
        $params['direction'] = (isset($request['direction'])) ? $request['direction'] : "0";
        
        // $params['orderby'] = (isset($request['orderby'])) ? $request['orderby'] : ["id","desc"];

        if(isset($request['orderby'])){
            if($request['orderby'] == 'idr'){
                $params['orderby'] = "idr";
       
                $Asc_Desc = 'DESC';
            }else{
                $params['orderby'] = "id";
            }
        }else{
            $params['orderby']='id';
        }
        
        if(isset($request['orderby'])){
            switch($request['orderby']){
                case "id":
                 $orderBy = 'id';   
                    break;
                case "idr":
                 $orderBy = 'id';   
                $Asc_Desc = 'DESC';
                    break;
                case "eng":
                 $orderBy = 'eng';   
                    break;
                case "rand":
                 $orderBy = 'rand';   
                    break;
                case "per":
                 $orderBy = 'per';   
 
                    break;
                default:
                $orderBy = 'id'; 
                    
            }
        }
        

        // return $Asc_Desc;

        $words = Word::where(function($q) use ($params) {
            
                if($params['chapter']  != 'all'){
                    $q->where('chapter', $params['chapter']);
                }

                if($params['test_tik']  != 'all'){
                    $q->where('test_tik', $params['test_tik']);
                }

        })
        ->orderby($orderBy,$Asc_Desc)
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
