<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    
    
    public function index(Request $request){
        
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
        

        $user = Auth::user();

        $words = Word::leftJoin('user_word', function($join) use ($user) {
            $join->on('words.id', '=', 'user_word.word_id')
                 ->where('user_word.user_id', '=', $user->id);
        })
        ->when($params['chapter'] != 'all', function($query) use ($params) {
            return $query->where('chapter', $params['chapter']);
        })
        ->when($params['test_tik'] != 'all', function($query) use ($params, $user) {
            if($params['direction'] == 0){

                if ($params['test_tik'] == 0) {
                    return $query->where(function($subQuery) use ($user) {
                        $subQuery->where(function($q) use ($user) {
                            $q->where('user_word.user_id', $user->id)
                            ->where('user_word.eng_check', 0);
                        })
                        ->orWhereNull('user_word.user_id'); // کلماتی که در جدول پیوت وجود ندارند
                    });
                } else {
                    return $query->where('user_word.user_id', $user->id)
                                ->where('user_word.eng_check', $params['test_tik']);
                }
            }else{
                if ($params['test_tik'] == 0) {
                    return $query->where(function($subQuery) use ($user) {
                        $subQuery->where(function($q) use ($user) {
                            $q->where('user_word.user_id', $user->id)
                            ->where('user_word.per_check', 0);
                        })
                        ->orWhereNull('user_word.user_id'); // کلماتی که در جدول پیوت وجود ندارند
                    });
                } else {
                    return $query->where('user_word.user_id', $user->id)
                                ->where('user_word.per_check', $params['test_tik']);
                }
            }

        })
        ->select('words.*', 'user_word.eng_check', 'user_word.per_check') // انتخاب ستون‌های مورد نظر از هر دو جدول
        ->orderBy($orderBy, $Asc_Desc)
        ->paginate(100);
        
        return view('index',compact(['words','params']));

    }

    

    
    public function search(){
        $words = Word::all();
        return view('search',compact(['words']));
    }

    public function edit($id){

        session(['previous_url' => url()->previous()]);

        $word = Word::whereId($id)->first();
        return view('edit',compact(['word']));

    }

    public function update(Request $request,$id){
   
        session(['edit_url' => url()->current()]);

        $previousUrl = session('previous_url');
        $editUrl = session('edit_url');


        $word = Word::whereId($id)->first();
        $word->update($request->all());

        if ($previousUrl) {
        return redirect($previousUrl);
    } elseif ($editUrl) {
        return redirect($editUrl);
    }
      
    }


    public function changeTik($id,$dir){

        $user = Auth::user();
        $pivotRecord = $user->words()->wherePivot('word_id', $id)->first();

        if ($pivotRecord) {
            if($dir=='en'){
                $newEngCheckValue = $pivotRecord->pivot->eng_check == 1 ? 0 : 1;
                $user->words()->updateExistingPivot($id, ['eng_check' => $newEngCheckValue]);
            }else{
                $newEngCheckValue = $pivotRecord->pivot->per_check == 1 ? 0 : 1;
                $user->words()->updateExistingPivot($id, ['per_check' => $newEngCheckValue]);
            }     
        } else {
            $newEngCheckValue = 1;
            if($dir=='en'){
                $user->words()->attach($id, ['eng_check' => 1]);
            }else{
                $user->words()->attach($id, ['per_check' => 1]);
            }

        }

        return response([
            'id' => $id,
            'status' => $newEngCheckValue,
            'dir'=>$dir
        ]);

    
    }




}
