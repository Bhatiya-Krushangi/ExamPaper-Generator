<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Question;
use App\Models\Recent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TypeController extends Controller
{

    // public function get_id(Request $request)
    // {
    //     $id = $request->id;
    //     $request->session()->put('id', $id);
    //     return true;
    // }
    public function recent_paper($s_id = null)
    {
        // dd($s_id);
        $id = Auth::user()->id;
        if(!empty($s_id)){
            $id = $s_id;
        }
        $all_user = User::where('status',0)->get();
        $data = Recent::where('user_id',$id)->latest()->get();
        $save_data = [];
        foreach($data as $que => $value)
        {
            $ques = $value->questions;
            $question = explode(',',$ques);
            $qu = Question::whereIn('id',$question)->orderBy('marks', 'asc')->get();
            $save_data[] = $qu;
        }
        // dd($save_data);
            return view('user.recent_paper',compact('all_user','data','save_data','id'));
        
        
    }
    // public function recent_papers()
    // {

    //     $id = session()->get('id');
    //     $user = User::where('id',$id)->first();
    //     $name = $user->name;
    //     // dd($name);
    //     $all_user = User::all();
    //     $data = Recent::where('user_id',$id)->get();
    //     $save_data = [];
    //     foreach($data as $que => $value)
    //     {
    //         $ques = $value->questions;
    //         $question = explode(',',$ques);
    //         $qu = Question::whereIn('id',$question)->get();
    //         $save_data[] = $qu;
    //     }
    //         return view('user.recent_paper',compact('all_user','data','save_data','name'));
        
        
    // }
    public function repeat_view($id)
    {
        $res = Recent::find($id);
        $que = explode(",",$res->questions);
        $record = Question::whereIn('id',$que)->orderBy('marks', 'asc')->get(); 
        // dd($record);
        return view('user.repeat_view',compact('res','record'));
    }
    public function edit_paper($id)
    {
        $res = Recent::find($id);
        $marks = $res->marks;
        $que = explode(",",$res->questions);
        $cnt = count($que);
        $lang = Language::where('status', 0)->get();
        return view('user.que1',compact('lang','id','marks','cnt'));
    }
}
