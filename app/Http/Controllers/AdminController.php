<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //languages

    public function lang()
    {
        $lang = Language::where('status',0)->get();
        $all_lang = Language::all();
        return view('admin.lang',compact('lang','all_lang'));
    }
    public function add_lang()
    {
        return view('admin.add_lang');
    }
    public function store_lang(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'language' => 'required',
        ],[
            'language.required' => 'Enter language name',
        ]);

        Language::updateorcreate([
            'id' => $request->id,
        ],[
            'user_id' => $user_id,
            'language' => $request->language,
        ]);

        return redirect()->route('view.lang');
    }
    public function delete_lang($id)
    {
        $del_id = Language::find($id);
        // dd($del_id);
        $del_id->status=1;
        $del_id->save();
        return redirect()->back();
    }
    public function act_lang($id)
    {
        $act_id = Language::find($id);
        $act_id->status=0;
        $act_id->save();
        return redirect()->back();
    }
    public function edit_lang($id)
    {
        $edit = Language::find($id);
        return view('admin.add_lang',compact('edit'));
    }

    //topics

    public function topics()
    {
        $lang_id = Language::select('id')->where('status',0)->get();
        // dd($lang_id);
        $topic = Topic::whereIn('language',$lang_id)->where('status',0)->get();
        $all_topic = Topic::whereIn('language',$lang_id)->get();
        return view('admin.topics',compact('topic','all_topic'));
    }
    public function add_topic()
    {
        $lang = Language::where('status',0)->get();
        return view('admin.add_topics',compact('lang'));
    }
    public function store_topic(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'language' => 'required',
            'topic' => 'required',
        ],[
            'language.required' => 'Select Language',
            'topic.required' => 'Enter Topic',
        ]);

        Topic::updateorcreate([
            'id' => $request->id,
        ]
        ,[
            'user_id' => $user_id,
            'language' => $request->language,
            'topic' => $request->topic,
        ]);
        return redirect()->route('view.topics');
    }
    public function delete_topic($id)
    {
        $del_id = Topic::find($id);
        $del_id->status=1;
        $del_id->save();
        return redirect()->back();
    }
    public function act_topic($id)
    {
        $act_id = Topic::find($id);
        $act_id->status=0;
        $act_id->save();
        return redirect()->back();
    }
    public function edit_topic($id)
    {
        $lang = Language::where('status',0)->get();
        $edit = Topic::find($id);
        return view('admin.add_topics',compact('lang','edit'));
    }

}
