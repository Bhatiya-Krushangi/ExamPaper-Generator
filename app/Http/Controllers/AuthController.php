<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Question;
use App\Models\Recent;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    public function dashboard()
    {
        $total_lang = count(Language::all());
        $act_lang = count(Language::where('status', 0)->get());
        $deact_lang = count(Language::where('status', 1)->get());

        $lang_id = Language::select('id')->where('status', 0)->get();
        $all_topic = count(Topic::whereIn('language', $lang_id)->get());
        $act_topic = count(Topic::whereIn('language', $lang_id)->where('status', 0)->get());
        $deact_topic = count(Topic::whereIn('language', $lang_id)->where('status', 1)->get());

        $all_user = count(User::all());
        $act_users = User::where('id','!=',Auth::user()->id)->where('status', 0)->get();
        $act_user = count(User::where('status', 0)->get());
        $deact_user = count(User::where('status', 1)->get());
        $qu_paper = Recent::where('user_id', Auth::user()->id)->get();
        $all_exam = count($qu_paper);

        $cnt = [];
        foreach ($act_users as $user) {
            $user_id = $user->id;
            $all = Recent::where('user_id', $user_id)->get();
            $cnt[] = count($all);
        }
        $uniqueCollection = $qu_paper->unique('type');
        $save_data = [];
        $save_que = [];
        foreach ($uniqueCollection as $value) {
            $type = $value->type;
            // dump($type);
            $data = Recent::where('type', $type)->where('user_id', Auth::user()->id)->latest()->get();
            $que_ar = [];
            foreach ($data as $val) {
                $ques = $val->questions;

                $question = explode(',',$ques);
                $qu = Question::whereIn('id',$question)->orderBy('marks', 'asc')->get();
                $que_ar[] = $qu;
            }
            $save_data[] = $data;
            // dump($que_ar);
            $save_que[] = $que_ar;
        }
        // dump($save_que);
        // dd();
        return view('dashboard', compact('total_lang', 'act_lang', 'deact_lang', 'all_topic', 'act_topic', 'deact_topic', 'all_user', 'act_user', 'deact_user', 'all_exam', 'act_users', 'cnt', 'save_data', 'save_que'));
    }
    public function registerpage()
    {
        return view('admin.add_user');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|min:6|max:25|confirmed',
            'role' => 'required',
        ], [
            'name.required' => 'Enter Username',
            'email.required' => 'Enter Email',
            'password.required' => 'Enter Password',
            'role.required' => 'Select Role',
            // 'password_confirmation.required' => 'Enter Confirm Password',
        ]);
        // $password = Crypt::encryptString($request->password);
        // // dd($password);
        User::updateorcreate([
            'id' => $request->id,
        ], [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        return redirect()->route('view.users');
    }
    public function users()
    {
        $user = User::all();
        return view('admin.users', compact('user'));
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ], [
            'email.required' => 'Enter Email',
            'password.required' => 'Enter Password',
        ]);
        
        $user = User::where('email', $request->email)->where('password', $request->password)->where('status', 0)->first();
        // dd($user);
        
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
        Auth::guard()->login($user);
        return redirect()->route('dashboard');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginpage');
    }
    public function delete_user($id)
    {
        $del_id = User::find($id);
        $del_id->status = 1;
        $del_id->save();
        return redirect()->back();
    }
    public function act_user($id)
    {
        $act_id = User::find($id);
        $act_id->status = 0;
        $act_id->save();
        return redirect()->back();
    }
    public function edit_user($id)
    {
        $edit = User::find($id);
        // $pass = Crypt::decryptString($edit->password);
        // dd($pass);
        return view('admin.add_user', compact('edit'));
    }
}
