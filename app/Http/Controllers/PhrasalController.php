<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhrasalVerb;
use Illuminate\Support\Facades\Gate;
use Auth;

class PhrasalController extends Controller
{
    //

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

        $words = PhrasalVerb::leftJoin('phrasal_verb_user', function($join) use ($user) {
            $join->on('phrasal_verbs.id', '=', 'phrasal_verb_user.phrasal_verb_id')
                 ->where('phrasal_verb_user.user_id', '=', $user->id);
        })
        ->when($params['chapter'] != 'all', function($query) use ($params) {
            return $query->where('chapter', $params['chapter']);
        })
        ->when($params['test_tik'] != 'all', function($query) use ($params, $user) {
            if($params['direction'] == 0){

                if ($params['test_tik'] == 0) {
                    return $query->where(function($subQuery) use ($user) {
                        $subQuery->where(function($q) use ($user) {
                            $q->where('phrasal_verb_user.user_id', $user->id)
                            ->where('phrasal_verb_user.eng_check', 0);
                        })
                        ->orWhereNull('phrasal_verb_user.user_id'); // کلماتی که در جدول پیوت وجود ندارند
                    });
                } else {
                    return $query->where('phrasal_verb_user.user_id', $user->id)
                                ->where('phrasal_verb_user.eng_check', $params['test_tik']);
                }
            }else{
                if ($params['test_tik'] == 0) {
                    return $query->where(function($subQuery) use ($user) {
                        $subQuery->where(function($q) use ($user) {
                            $q->where('phrasal_verb_user.user_id', $user->id)
                            ->where('phrasal_verb_user.per_check', 0);
                        })
                        ->orWhereNull('phrasal_verb_user.user_id'); // کلماتی که در جدول پیوت وجود ندارند
                    });
                } else {
                    return $query->where('phrasal_verb_user.user_id', $user->id)
                                ->where('phrasal_verb_user.per_check', $params['test_tik']);
                }
            }

        })
        ->select('phrasal_verbs.*', 'phrasal_verb_user.eng_check', 'phrasal_verb_user.per_check') // انتخاب ستون‌های مورد نظر از هر دو جدول
        ->orderBy($orderBy, $Asc_Desc)
        ->paginate(100);
        // dd($params);
        
        return view('phrasal',compact(['words','params']));


        // $phrasalVerbs = PhrasalVerb::all();
        // return view('phrasal',compact(['phrasalVerbs']));



    }

    public function add(){
        $phrasalVerbs = PhrasalVerb::all();
        return view('add-phrasal',compact(['phrasalVerbs']));
    }

    public function store(Request $request){

        $request->validate([
            'eng'=>'required',
            'per'=>'required',
            'chapter'=>'required|numeric'
        ]);

        if (Gate::allows('create',PhrasalVerb::class)) {
                
            PhrasalVerb::create(array_merge($request->all(), ['test_tik' => '0']));
              return redirect()->route('phrasal.index')->with('success','با موفقیت افزوده شد');

        } else {
                // کاربر اجازه ویرایش ندارد
                abort(403, 'Unauthorized action.');
        } 
    }

    public function edit($id){

        session(['previous_url' => url()->previous()]);

        $word = PhrasalVerb::whereId($id)->first();
        return view('phrasal-edit',compact(['word']));

    }

    public function update(Request $request,$id){
   
        $request->validate([
            'eng'=>'required',
            'per'=>'required',
            'chapter'=>'required|numeric'
        ]);

        $user = Auth::user();
        $word = PhrasalVerb::find($id);
    
        if (Gate::allows('update', $word)) {
                session(['edit_url' => url()->current()]);
                $previousUrl = session('previous_url');
                $editUrl = session('edit_url');
                $word->update($request->all());
                if ($previousUrl) {
                    return redirect($previousUrl);
                }elseif ($editUrl) {
                return redirect($editUrl);
        }
        } else {
                // کاربر اجازه ویرایش ندارد
                abort(403, 'Unauthorized action.');
        }
    
          
    }

    public function changeTik($id,$dir){

    
        $user = Auth::user();
        $pivotRecord = $user->phrasalVerbs()->wherePivot('phrasal_verb_id', $id)->first();
        if ($pivotRecord) {
            if($dir=='en'){
                $newEngCheckValue = $pivotRecord->pivot->eng_check == 1 ? 0 : 1;
                $user->phrasalVerbs()->updateExistingPivot($id, ['eng_check' => $newEngCheckValue]);
            }else{
                $newEngCheckValue = $pivotRecord->pivot->per_check == 1 ? 0 : 1;
                $user->phrasalVerbs()->updateExistingPivot($id, ['per_check' => $newEngCheckValue]);
            }     
        } else {
            $newEngCheckValue = 1;
            if($dir=='en'){
                $user->phrasalVerbs()->attach($id, ['eng_check' => 1]);
            }else{
                $user->phrasalVerbs()->attach($id, ['per_check' => 1]);
            }

        }

        return response([
            'id' => $id,
            'status' => $newEngCheckValue,
            'dir'=>$dir
        ]);

    
    }




}
