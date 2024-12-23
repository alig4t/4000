<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhrasalVerb;
use Illuminate\Support\Facades\Gate;
use Auth;

class PhrasalController extends Controller
{
    //

    public function index(){
        $phrasalVerbs = PhrasalVerb::all();
        return view('phrasal',compact(['phrasalVerbs']));
    }

    public function add(){
        $phrasalVerbs = PhrasalVerb::all();
        return view('add-phrasal',compact(['phrasalVerbs']));
    }

    public function store(Request $request){

        $request->validate([
            'eng'=>'required',
            'per'=>'required',
            'unit'=>'numeric'
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
            'unit'=>'numeric'
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

}
